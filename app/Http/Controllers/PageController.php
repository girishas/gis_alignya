<?php
namespace App\Http\Controllers;

use App\User;

use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use App\Models\Page;
use App\Models\Contact;
use Mail;
use File;

class PageController extends Controller
{
	public function __construct()
    {
       Parent::__construct();
       $this->middleware('auth', ['except' => ['admin_login', 'testmail', 'contactus', 'login', 'index']]);
    }
	
	public function testmail(){
		$admin_email	= "noreply@chameleon.love"; 
		$site_name 		= "Streamer Studio";
		
		$name			= "Krishan Kothari";
					$email			= "krishan.kothari@gmail.com"; 
					$user_message	= "This is testmail"; 
		
		$message        = "Streamer Studio Test Mail"; //str_replace(array('{NAME}', '{EMAIL}', '{MESSAGE}', '{SITE}'), array($name, $email, $user_message, $site_name), $mail_data['content']);
			
			$subject        = "Streamer Studio Test Mail"; //str_replace(array('{SITE}'), array($site_name), $mail_data['subject']);
			Mail::send('frontend.my_email', array('data'=>$message), function($message) use ($admin_email, $subject, $site_name){ 
					$message->from($admin_email, $site_name);
					$message->to($admin_email, $site_name)->subject($subject);
				});
			echo "Success"; die;
	
	}
	
	public function contactus(){
		$results = array();
		
		if($this->request->isMethod('post')){
			$validator = Contact::validate($this->request->all());
			if ( $validator->fails() ) {
				$results  = array('type' => 'danger', 'message' => getLabels('message_not_sent'));
			} else {
				$contact                = Contact::Create($this->request->all());
				$mail_data  			= getEmailTemplate('contact_us_admin');
				if($contact and $mail_data){
					$name			= $contact->name;
					$email			= $contact->email; 
					$user_message	= $contact->message; 
					$admin_email	= config('constants.SITE_EMAIL'); 
					$site_name 		= config('constants.SITE_TITLE');
					if($mail_data and $email){
						$message        = str_replace(array('{NAME}', '{EMAIL}', '{MESSAGE}', '{SITE}'), array($name, $email, $user_message, $site_name), $mail_data['content']);
						$subject        = str_replace(array('{SITE}'), array($site_name), $mail_data['subject']);
						Mail::send('frontend.my_email', array('data'=>$message), function($message) use ($admin_email, $subject, $site_name){ 
								$message->from($admin_email, $site_name);
								$message->to($admin_email, $site_name)->subject($subject);
							});
					}
					
					$results  = array('type' => 'success', 'message' =>  getLabels("message_sent"));
				}else{
					$results  = array('type' => 'danger', 'message' => getLabels('something_wrong_try_again'));
				}
			}
			
			return json_encode($results);
		}
		return view('landingpage/index');
	}
	
	
	
	public function index(){
		$data = array();
		return view('landingpage/index', compact('data'));
	}
	
	
	public function page_not_found(){
		$page_title = config("constants.SITE_TITLE");
		return view('frontend/pages/page_not_found', compact('page_title'));
	}
	
	
	
	public function admin_index(){
		$page_title = "Page Manager";
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		if($this->request->session()->has('pagesearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('pagesearch');
		}else{
			$this->request->session()->forget('pagesearch');
		}
		$data  = Page::sortable();
		
		if(! empty($_POST)){
			if(isset($_POST['title']) and $_POST['title'] !=''){
				$title = $_POST['title'];
				$this->request->session()->put('pagesearch.title', $title);
				$data = $data->where(function($query) use($title)  {
							$query->where('title_en', 'like', $title."%")->orwhere('title_sp', 'like', $title."%")->orwhere('title_fr', 'like', $title."%");
						});
			}
			if(isset($_POST['status']) and $_POST['status'] !=''){
				$status = $_POST['status'];
				$this->request->session()->put('pagesearch.status', $status);
				$data = $data->where('pages.status', $status);
			}
		}else{
			$this->request->session()->forget('pagesearch');
		}
		
		$data  = $data->orderBy('updated_at', 'DESC')->paginate(config('constants.PAGINATION'));
		return view('frontend/pages/admin_index', compact('data', 'page_title'));
	}
	
	
	
	public function admin_add(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = array();
		
		$page_title = "Add New Page";
		if($this->request->isMethod('post')){
			$validator = Page::validate($this->request->all());
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('page_saved_errors')]);
			} else {
				$formData              	= $this->request->all();
				
				$page  = Page::create($formData);
				if($page){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'pages'), 'message' =>  getLabels('page_saved_successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'pages'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/pages/admin_add', compact('data', 'page_title'));
	}
	
	
	public function admin_edit($slug = null, $lid = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = Page::where('slug', $slug)->first();
		
		$page_title = "Update Page : ".$data->title;
		if($this->request->isMethod('post')){
			$validator = Page::validate($this->request->all(), $data->id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('page_saved_errors')]);
			} else {
				$formData              	= $this->request->all();
				$page  = $data->update($formData);
				if($page){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'pages'), 'message' =>  getLabels('page_saved_successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'pages'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/pages/admin_edit', compact('data', 'page_title'));
	}
	
	
	
	public function admin_status($id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data			 = Page::find($id);
		$status          = $data->status == 1?0:1;
		$update 		 = $data->update(array('status' => $status));
		if($update){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'pages'), "message" => getLabels('status_changed_successfully'));
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'pages'), "message" => getLabels('status_not_updated'));
		}
		return json_encode($results);
	}
	
	public function admin_remove($id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data			 = Page::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'pages'), "message" => getLabels('page_removed'));
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'pages'), "message" => getLabels('page_not_removed'));
		}
		return json_encode($results);
	}
	
	
	
	public function getEmojisFromFiels($filename="smileys"){
		$html ="";
		$file_name= $filename.'.text'; 
		$file_handle = fopen('smileyes/'.$file_name, "r");
		
		while (!feof($file_handle)) {
			$line = fgets($file_handle);
			$html .=$line;
		}
		fclose($file_handle);
		$data = explode(',', $html);
		
		return $data;
	}
	
	
	
	public function getemojis(){
		$icons =  ["smiley","smileys","activity", "animals", "flags","food","objects","symbols","travel"];
		foreach ($icons as $key => $value) {		
			$directory = base_path('public/upload/emoji/32/'.$value);
			$images = glob($directory . "/*.png");
			foreach($images as $image)
			{
				$exp = explode("/",$image);
				//$img_array[] = 'https://hubscure-caaf.kxcdn.com/public/upload/emoji/32/'.$type ."/".end($exp);
				$img_array[$value][] = url('public/upload/emoji/32')."/".$value ."/".end($exp);
			}
		}
		$file_data = $img_array;
		//echo "<pre>"; print_r($data); die;
		$view = view('frontend/posts/emoji_popup',compact('file_data'))->render();
		return response()->json(['html'=>$view]);
		
		//return \Response::json($file_data);
	}
	
	
	
	public function getgifs(){
		$limit = 5;
		$offset = 0;
		$search = false;
		if($this->request->isMethod('post')){
			$keyword = "q=";
			if($this->request->has('keyword')){
				if($this->request->get('keyword') !=''){
					$search =true;
				}
				$input_keyword['q'] = $this->request->get('keyword');

				if($input_keyword['q']){
					$keyword =http_build_query($input_keyword);      	 	
				}         	
			}
			$offset = $this->request->get('offset');
		}
		$url = "http://api.giphy.com/v1/gifs/trending?api_key=B2yiQDQXG76bArQMduEm027ahKYEEYoA&limit=6&offset=".$offset."";
		if($search){
			$url = "http://api.giphy.com/v1/gifs/search?".$keyword."&api_key=B2yiQDQXG76bArQMduEm027ahKYEEYoA&limit=6&offset=".$offset."";		
		}

		$data =	 file_get_contents($url);
		//echo "<pre>"; print_r($data); die;
		return $data;
	}

}
