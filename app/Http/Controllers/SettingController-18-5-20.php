<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Language;
use App\Models\Badges;
use App\Models\Labels;
use App\Models\PageImage;
use App\Models\Testimonial;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Input;

use App\Classes\Slim;

use Mail;
use File;
use PDF;
Class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct()
    {
       Parent::__construct();
       $this->middleware('auth', ['except' => ['admin_login', 'login', 'system_lang']]);
    }

	
	public function system_lang(){
		if ($this->request->isMethod('post')) {
			$lang  = $this->request->lang;
			$language  = Language::where('id', $lang)->first(array('name', 'code', 'icon'))->toArray();
			$this->request->session()->put('lang', $language);
			$this->request->session()->put('selected_lang', $language['code']);
			return json_encode(array("type" => "success", "header" => view('frontend/layouts/header')->render(), "navigation" => view('frontend/layouts/navigation')->render()));
		}
	}
	
	
    public function admin_update(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$page_title = getLabels('application_settings');
		if ($this->request->isMethod('post')) {
			$validator = Setting::validate($this->request->all());
            if ($validator->fails()) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('settings_saved_errors')]);
            }else{
				$dataArr = $this->request->all();
				foreach($dataArr as $key => $val){
					Setting::where('slug', $key)->update(array('value' => $val));
				}
				return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'settings'), 'message' => getLabels('settings_updated_successfully')]);
			}	
		}
		
		$data = Setting::orderBy('id')->get();
		return view('frontend/settings/admin_update',compact('data', 'page_title'));
	}
	
	
	public function admin_languages(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		if($this->request->session()->has('lsearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('lsearch');
		}else{
			$this->request->session()->forget('lsearch');
		}
		
		$data  = Language::sortable();
		
		if(! empty($_POST)){
			if(isset($_POST['name']) and $_POST['name'] !=''){
				$name = $_POST['name'];
				$this->request->session()->put('lsearch.name', $name);
				$data = $data->whereRaw('languages.name like ?', "%{$name}%");
			}
			
			if(isset($_POST['status']) and $_POST['status'] !=''){
				$status = $_POST['status'];
				$this->request->session()->put('lsearch.status', $status);
				$data = $data->where('languages.status', $status);
			}
		}else{
			$this->request->session()->forget('lsearch');
		}

		$data  = $data->paginate(config('constants.PAGINATION'));
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$page_title = getLabels('Languages');
		return view('frontend/settings/admin_languages',compact('data', 'page_title'));
	}
	
	
	public function admin_language_status($id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data			 = Language::find($id);
		$status          = $data->status == 1?0:1;
		$update 		 = $data->update(array('status' => $status));
		if($update){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'languages'), "message" => getLabels('status_changed_successfully'));
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'languages'), "message" => getLabels('status_not_updated'));
		}
		return json_encode($results);
	}
	
	
	
	public function admin_add_language(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = array();
		
		$page_title = getLabels('add_new_language');
		
		if($this->request->isMethod('post')){
			$validator = Language::validate($this->request->all());
		
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('language_saved_errors')]);
			} else {
				$formData = $this->request->except('icon');

				if ( $this->request->icon){
					// Pass Slim's getImages the name of your file input, and since we only care about one image, use Laravel's head() helper to get the first element
					$image = head(Slim::getImages('icon'));

					// Grab the ouput data (data modified after Slim has done its thing)
					if ( isset($image['output']['data']) ){
						// Original file name
						$name = $image['output']['name'];

						// Base64 of the image
						$dataImage = $image['output']['data'];

						// Server path
						$path = base_path() . '/public/upload/language/';

						// Save the file to the server
						$file = Slim::saveFile($dataImage, $name, $path);
						
						$formData['icon'] 	= $file['name'];
						// Get the absolute web path to the image
						//$imagePath = asset('tmp/' . $file['name']);
					}
				}
				
				$language  = Language::create($formData);
				if($language){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'languages'), 'message' => getLabels('language_saved_successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'languages'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		return view('frontend/settings/admin_add',compact('data', 'page_title'));
	}


	public function admin_edit_language($id = null){ 
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data   = Language::find($id);
		$page_title = getLabels('update_language');
		
		if($this->request->isMethod('post')){
			$validator = Language::validate($this->request->all(), $id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('language_saved_errors')]);
			} else {
				$formData = $this->request->except('icon');
				
				if ( $this->request->icon){
					// Pass Slim's getImages the name of your file input, and since we only care about one image, use Laravel's head() helper to get the first element
					$image = head(Slim::getImages('icon'));

					// Grab the ouput data (data modified after Slim has done its thing)
					if ( isset($image['output']['data']) ){
						// Original file name
						$name = $image['output']['name'];

						// Base64 of the image
						$dataImage = $image['output']['data'];

						// Server path
						$path = base_path() . '/public/upload/language/';

						// Save the file to the server
						$file = Slim::saveFile($dataImage, $name, $path);
						if($id and $data->icon !="" and file_exists('public/language/'. $data->icon)){
							unlink('public/upload/language/'. $data->icon);
						}
						$formData['icon'] 	= $file['name'];
					}
				}
				
				$language  = $data->update($formData);
				if($language){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'languages'), 'message' => getLabels('language_saved_successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'languages'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/settings/admin_edit', compact('data', 'id', 'page_title'));
	}
		
		public function admin_remove_languages($id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = language::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'languages'), "message" => getLabels('languages_removed_successfully'));
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'languages'), "message" => getLabels('language_not_removed'));
		}
		return json_encode($results);
	}

	 	
			public function admin_badges(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		if($this->request->session()->has('bsearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('bsearch');
		}else{
			$this->request->session()->forget('bsearch');
		}
		
		$data  = Badges::sortable();
		
		if(! empty($_POST)){
			if(isset($_POST['title']) and $_POST['title'] !=''){
				$title = $_POST['title'];
				$this->request->session()->put('bsearch.title', $title);
				$data = $data->whereRaw('badges.title like ?', "%{$title}%");
			}
			
			if(isset($_POST['status']) and $_POST['status'] !=''){
				$status = $_POST['status'];
				$this->request->session()->put('bsearch.status', $status);
				$data = $data->where('badges.status', $status);
			}
		}else{
			$this->request->session()->forget('bsearch');
		}

		$data  = $data->paginate(config('constants.PAGINATION'));
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$page_title = 'Badges';
		return view('frontend/badges/admin_badges',compact('data', 'page_title'));
	}
			
			public function admin_badges_status($id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data			 = Badges::find($id);
		$status          = $data->status == 1?0:1;
		$update 		 = $data->update(array('status' => $status));
		if($update){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'badges'), "message" => getLabels('status_changed_successfully'));
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'badges'), "message" => getLabels('status_not_updated'));
		}
		return json_encode($results);
	}

		public function admin_add_badges(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = array();
		
		$page_title = "Add New Badges";
		
		if($this->request->isMethod('post')){
			$validator = Badges::validate($this->request->all());
	
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('badges_saved_errors')]);
			} else {
				$formData = $this->request->except('image');
				//echo "<pre>";print_r($formData);die;
				if ( $this->request->image){
					// Pass Slim's getImages the name of your file input, and since we only care about one image, use Laravel's head() helper to get the first element
					$image = head(Slim::getImages('image'));

					// Grab the ouput data (data modified after Slim has done its thing)
					if ( isset($image['output']['data']) ){
						// Original file name
						$name = $image['output']['name'];

						// Base64 of the image
						$dataImage = $image['output']['data'];

						// Server path
						$path = base_path() . '/public/upload/badges/';

						// Save the file to the server
						$file = Slim::saveFile($dataImage, $name, $path);
						
						$formData['image'] 	= $file['name'];
						// Get the absolute web path to the image
						//$imagePath = asset('tmp/' . $file['name']);
					}
				}

				$badges  = Badges::create($formData);
				if($badges){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'badges'), 'message' => getLabels('badge_saved_successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'badges'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/badges/admin_add',compact('data', 'page_title'));
	}


	public function admin_edit_badges($id = null){ 
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data   = Badges::find($id);
		$page_title = "Update Badges";
		
		if($this->request->isMethod('post')){
			$validator = Badges::validate($this->request->all(), $id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('badges_saved_errors')]);
			} else {
				$formData = $this->request->except('image');
				
				if ( $this->request->image){
					// Pass Slim's getImages the name of your file input, and since we only care about one image, use Laravel's head() helper to get the first element
					$image = head(Slim::getImages('image'));

					// Grab the ouput data (data modified after Slim has done its thing)
					if ( isset($image['output']['data']) ){
						// Original file name
						$name = $image['output']['name'];

						// Base64 of the image
						$dataImage = $image['output']['data'];

						// Server path
						$path = base_path() . '/public/upload/badges';

						// Save the file to the server
						$file = Slim::saveFile($dataImage, $name, $path);
						if($id and $data->image !="" and file_exists('public/upload/badges'. $data->image)){
							unlink('public/upload/badges'. $data->image);
						}
						$formData['image'] 	= $file['name'];
					}
				}
				
				$badge  = $data->update($formData);
				if($badge){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'badges'), 'message' => getLabels('badge_saved_successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'badges'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/badges/admin_edit', compact('data', 'id',  'page_title'));
	}
		
		public function admin_remove_badges($id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = Badges::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'badges'), "message" => getLabels('badges_removed_successfully'));
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'badges'), "message" => getLabels('badge_not_removed'));
		}
		return json_encode($results);
	}



	public function admin_labels(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		if($this->request->session()->has('labelsearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('labelsearch');
		}else{
			$this->request->session()->forget('labelsearch');
		}
		
		$data  = Labels::sortable();

		if(! empty($_POST)){
			if(isset($_POST['label_key']) and $_POST['label_key'] !=''){
				$label_key = $_POST['label_key'];
				$this->request->session()->put('labelsearch.label_key', $label_key);
				$data = $data->whereRaw('labels.label_key like ?', "%{$label_key}%");
			}
			
			if(isset($_POST['label_text']) and $_POST['label_text'] !=''){
				$label_text = $_POST['label_text'];
				$this->request->session()->put('labelsearch.label_text', $label_text);
				$data = $data->where(function($query) use($label_text) { $query->where('labels.label_text_en', 'like',"%". $label_text."%")->orWhere('labels.label_text_fr', 'like', "%". $label_text."%")->orWhere('labels.label_text_sp', 'like', "%". $label_text."%"); });
			}
		}else{
			$this->request->session()->forget('labelsearch');
		}

		$data  = $data->select('labels.*')->orderBy('labels.created_at', 'desc')->paginate(config('constants.PAGINATION'));

		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$page_title = 'Labels';
		return view('frontend/labels/admin_labels',compact('data', 'page_title'));
	}
	 	

	public function admin_add_labels(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = array();
		
		$page_title = "Add labels";
		
		if($this->request->isMethod('post')){
			$validator = Labels::validate($this->request->all());
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('label_saved_errors')]);
			} else {
				$formData = $this->request->all();
				
				$label  = Labels::create($formData);
				if($label){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'labels'), 'message' => getLabels('label_saved_successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'labels'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/labels/admin_add', compact('data', 'page_title'));
	}
	
	
	public function admin_edit_labels($id = null){ 
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data   = Labels::find($id);
		$page_title = getLabels("update_label");
		if($this->request->isMethod('post')){
			$validator = Labels::validate($this->request->all(), $id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('label_saved_errors')]);
			} else {
				$formData              	= $this->request->all();

				$label  = $data->update($formData);
				if($label){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'labels'), 'message' => getLabels('label_saved_successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'labels'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/labels/admin_edit', compact('data', 'id',  'page_title'));
	}

		public function admin_remove_labels($id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = labels::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'labels'), "message" => 'Label has been removed successfully.');
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'labels'), "message" => 'Label could not be removed, please try again.');
		}
		return json_encode($results);
	}
			

	public function admin_page_images(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		if($this->request->session()->has('psearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('psearch');
		}else{
			$this->request->session()->forget('psearch');
		}
		
		$data  = PageImage::sortable();
		
		if(! empty($_POST)){
			if(isset($_POST['slug']) and $_POST['slug'] !=''){
				$slug = $_POST['slug'];
				$this->request->session()->put('psearch.slug', $slug);
				$data = $data->whereRaw('page_images.slug like ?', "%{$slug}%");
			}
			
			if(isset($_POST['status']) and $_POST['status'] !=''){
				$status = $_POST['status'];
				$this->request->session()->put('psearch.status', $status);
				$data = $data->where('page_images.status', $status);
			}
		}else{
			$this->request->session()->forget('psearch');
		}

		$data  = $data->paginate(config('constants.PAGINATION'));
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$page_title = getLabels("Page_Images");
		return view('frontend/page_images/admin_page_images',compact('data', 'page_title'));
	}	

		public function admin_page_images_status($id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data			 = PageImage::find($id);
		$status          = $data->status == 1?0:1;
		$update 		 = $data->update(array('status' => $status));
		if($update){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'page_images'), "message" => getLabels('status_changed_successfully'));
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'page_images'), "message" => getLabels('status_not_updated'));
		}
		return json_encode($results);
	}
	


	public function admin_add_page_images(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = array();
		
		$page_title = getLabels("add_new_page_images");
		
		if($this->request->isMethod('post')){
			$validator = PageImage::validate($this->request->all());
	
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('page_image_saved_errors')]);
			} else {
				$formData = $this->request->except('image');
				//echo "<pre>";print_r($formData);die;
				if ( $this->request->image){
					// Pass Slim's getImages the name of your file input, and since we only care about one image, use Laravel's head() helper to get the first element
					$image = head(Slim::getImages('image'));

					// Grab the ouput data (data modified after Slim has done its thing)
					if ( isset($image['output']['data']) ){
						// Original file name
						$name = $image['output']['name'];

						// Base64 of the image
						$dataImage = $image['output']['data'];

						// Server path
						$path = base_path() . '/public/upload/page_images/';

						// Save the file to the server
						$file = Slim::saveFile($dataImage, $name, $path);
						
						$formData['image'] 	= $file['name'];
						// Get the absolute web path to the image
						//$imagePath = asset('tmp/' . $file['name']);
					}
				}
				
				
				
				 $formData['status'] = $this->request->get('status');
				 //echo "<pre>";print_r($formData);die;



				$user  = PageImage::create($formData);
				if($user){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'page_images'), 'message' => getLabels('page_image_saved_successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'page_images'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		
		
		return view('frontend/page_images/admin_add_page_images',compact('data', 'page_title'));
	}

	public function admin_edit_page_images($id = null){ 
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data   = PageImage::find($id);
		$page_title = getLabels("update_page_images");
		
		if($this->request->isMethod('post')){
			$validator = PageImage::validate($this->request->all(), $id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('page_image_saved_errors')]);
			} else {
				$formData = $this->request->except('image');
				
				if ( $this->request->image){
					// Pass Slim's getImages the name of your file input, and since we only care about one image, use Laravel's head() helper to get the first element
					$image = head(Slim::getImages('image'));

					// Grab the ouput data (data modified after Slim has done its thing)
					if ( isset($image['output']['data']) ){
						// Original file name
						$name = $image['output']['name'];

						// Base64 of the image
						$dataImage = $image['output']['data'];

						// Server path
						$path = base_path() . '/public/upload/page_images';

						// Save the file to the server
						$file = Slim::saveFile($dataImage, $name, $path);
						if($id and $data->image !="" and file_exists('public/upload/page_images'. $data->image)){
							unlink('public/upload/page_images'. $data->image);
						}
						$formData['image'] 	= $file['name'];
						// dd($formData);
						// Get the absolute web path to the image
						//$imagePath = asset('tmp/' . $file['name']);
					}
				}
				
				$formData['status'] = $this->request->get('status');
				// echo "<pre>";print_r($formData);die;

				$user  = $data->update($formData);
				if($user){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'page_images'), 'message' => getLabels('page_image_saved_successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'page_images'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/page_images/admin_edit_page_images', compact('data', 'id', 'page_title'));
	}
		
	public function admin_remove_page_images($id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = PageImage::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'page_images'), "message" => getLabels('page_image_removed'));
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'page_images'), "message" => getLabels('page_image_not_removed'));
		}
		return json_encode($results);
	}


		public function admin_testimonials(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		if($this->request->session()->has('tsearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('tsearch');
		}else{
			$this->request->session()->forget('tsearch');
		}
		
		$data  = Testimonial::sortable();
		
		if(! empty($_POST)){
			if(isset($_POST['name']) and $_POST['name'] !=''){
				$name = $_POST['name'];
				$this->request->session()->put('tsearch.name', $name);
				$data = $data->whereRaw('testimonials.name like ?', "%{$name}%");
			}
			
			if(isset($_POST['status']) and $_POST['status'] !=''){
				$status = $_POST['status'];
				$this->request->session()->put('tsearch.status', $status);
				$data = $data->where('testimonials.status', $status);
			}
		}else{
			$this->request->session()->forget('tsearch');
		}

		$data  = $data->paginate(config('constants.PAGINATION'));
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$page_title = getLabels("Testimonials");
		return view('frontend/testimonials/admin_testimonials',compact('data', 'page_title'));
	}	

		public function admin_add_testimonials(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = array();
		
		$page_title = getLabels("add_new_testimonials");
		
		if($this->request->isMethod('post')){
			$validator = Testimonial::validate($this->request->all());
	
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('testimonial_not_saved')]);
			} else {
				$formData = $this->request->except('image');
				//echo "<pre>";print_r($formData);die;
				if ( $this->request->image){
					// Pass Slim's getImages the name of your file input, and since we only care about one image, use Laravel's head() helper to get the first element
					$image = head(Slim::getImages('image'));

					// Grab the ouput data (data modified after Slim has done its thing)
					if ( isset($image['output']['data']) ){
						// Original file name
						$name = $image['output']['name'];

						// Base64 of the image
						$dataImage = $image['output']['data'];

						// Server path
						$path = base_path() . '/public/upload/testimonials/';

						// Save the file to the server
						$file = Slim::saveFile($dataImage, $name, $path);
						
						$formData['image'] 	= $file['name'];
						// Get the absolute web path to the image
						//$imagePath = asset('tmp/' . $file['name']);
					}
				}
				
				
				
				 $formData['status'] = $this->request->get('status');
				 //echo "<pre>";print_r($formData);die;



				$user  = Testimonial::create($formData);
				if($user){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'testimonials'), 'message' => getLabels('testimonial_saved_successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'testimonials'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		
		
		return view('frontend/testimonials/admin_add_testimonials',compact('data', 'page_title'));
	}

	public function admin_edit_testimonials($id = null){ 
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data   = Testimonial::find($id);
		$page_title = getLabels("update_testimonials");
		
		if($this->request->isMethod('post')){
			$validator = Testimonial::validate($this->request->all(), $id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('testimonial_not_saved')]);
			} else {
				$formData = $this->request->except('image');
				
				if ( $this->request->image){
					// Pass Slim's getImages the name of your file input, and since we only care about one image, use Laravel's head() helper to get the first element
					$image = head(Slim::getImages('image'));

					// Grab the ouput data (data modified after Slim has done its thing)
					if ( isset($image['output']['data']) ){
						// Original file name
						$name = $image['output']['name'];

						// Base64 of the image
						$dataImage = $image['output']['data'];

						// Server path
						$path = base_path() . '/public/upload/testimonials';

						// Save the file to the server
						$file = Slim::saveFile($dataImage, $name, $path);
						if($id and $data->image !="" and file_exists('public/upload/testimonials'. $data->image)){
							unlink('public/upload/testimonials'. $data->image);
						}
						$formData['image'] 	= $file['name'];
						// dd($formData);
						// Get the absolute web path to the image
						//$imagePath = asset('tmp/' . $file['name']);
					}
				}
				
				$formData['status'] = $this->request->get('status');
				// echo "<pre>";print_r($formData);die;

				$user  = $data->update($formData);
				if($user){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'testimonials'), 'message' => getLabels('testimonial_saved_successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'testimonials'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/testimonials/admin_edit_testimonials', compact('data', 'id', 'page_title'));
	}

	public function admin_remove_testimonials($id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = Testimonial::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'testimonials'), "message" => getLabels('testimonials_removed_successfully'));
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'testimonials'), "message" => getLabels('testimonials_not_removed'));
		}
		return json_encode($results);
	}
	
	public function admin_testimonials_status($id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data			 = Testimonial::find($id);
		$status          = $data->status == 1?0:1;
		$update 		 = $data->update(array('status' => $status));
		if($update){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'testimonials'), "message" => getLabels('status_changed_successfully'));
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'testimonials'), "message" => getLabels('status_not_updated'));
		}
		return json_encode($results);
	}

	public function admin_faqs(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		if($this->request->session()->has('qsearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('qsearch');
		}else{
			$this->request->session()->forget('qsearch');
		}
		
		$data  = Faq::sortable();
		
		if(! empty($_POST)){
			if(isset($_POST['slug']) and $_POST['slug'] !=''){
				$slug = $_POST['slug'];
				$this->request->session()->put('qsearch.slug', $slug);
				$data = $data->whereRaw('faqs.slug like ?', "%{$slug}%");
			}			

			if(isset($_POST['question']) and $_POST['question'] !=''){
				$question = $_POST['question'];
				$this->request->session()->put('qsearch.question', $question);
				$data = $data->where(function($query) use($question)  {
							$query->where('question_en', 'like', "%".$question."%")->orwhere('question_sp', 'like', "%".$question."%")->orwhere('question_fr', 'like', "%".$question."%");
						});
			}
		}else{
			$this->request->session()->forget('qsearch');
		}

		$data  = $data->paginate(config('constants.PAGINATION'));
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$page_title = getLabels("Faqs");
		return view('frontend/faqs/admin_faqs',compact('data', 'page_title'));
	}

	public function admin_add_faqs(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = array();
		
		$page_title = getLabels("add_faqs");
		if($this->request->isMethod('post')){
			$validator = Faq::validate($this->request->all());
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('faq_saved_errors')]);
			} else {
				$formData = $this->request->all();
				
				$page  = Faq::create($formData);
				if($page){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'faqs'), 'message' => getLabels('faq_saved')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'faqs'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/faqs/admin_add_faqs', compact('data', 'page_title'));
	}

	public function admin_edit_faqs($id = null){ 
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data   = Faq::find($id);
		$page_title = getLabels("update_faqs");
		if($this->request->isMethod('post')){
			$validator = Faq::validate($this->request->all(), $id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('faq_saved_errors')]);
			} else {
				$formData = $this->request->all();

				$user  = $data->update($formData);
				if($user){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'faqs'), 'message' => getLabels('faq_saved')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'faqs'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/faqs/admin_edit_faqs', compact('data', 'id',  'page_title'));
	}

	public function admin_remove($id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = Faq::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'faqs'), "message" => getLabels('faq_removed'));
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'faqs'), "message" => getLabels('faq_not_removed'));
		}
		return json_encode($results);
	}

}



?>