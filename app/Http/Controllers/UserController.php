<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Country;
use App\Models\Notification;
use App\Models\SubscriptionPlan;
use App\Models\Objective;
use App\Models\Measure;

use App\Classes\Slim;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Mail;
use File;
use Socialite;
use SocialiteProviders;
class UserController extends Controller
{
	

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	//protected $loginPath = 'admin/login';

	public function __construct()
    {
       Parent::__construct();
<<<<<<< Updated upstream
		$this->middleware('auth', ['except' => ['resizeProfileImageGoogle', 'resizeProfileImage', 'profile', 'resizeProfileImageFacebook', 'verifyMail', 'findOrCreateUser', 'redirectToProvider', 'handleProviderCallback', 'admin_login', 'admin_register', 'login', 'register', 'forgot_password', 'resetpassword', 'admin_forgot_password']]);
    }
	
=======
		$this->middleware('auth', ['except' => ['resizeProfileImageGoogle', 'resizeProfileImage', 'profile', 'resizeProfileImageFacebook', 'verifyMail', 'findOrCreateUser', 'redirectToProvider', 'handleProviderCallback', 'admin_login', 'admin_register', 'home','features_strategy_development','features_alignment_target_initiative','features_progress_tracking_and_insights','features_collaboration','alignya_process','blog','contact','login', 'register', 'forgot_password', 'resetpassword', 'admin_forgot_password','checkemailexist']]);
	}
>>>>>>> Stashed changes
	
	public function home(){
		$page_title = "Home";
		return view('frontend.users.home', compact('page_title'));
	}
	public function features_strategy_development(){
		$page_title = "Home";
		return view('frontend.users.features_strategy_development', compact('page_title'));
	}
	public function features_alignment_target_initiative(){
		$page_title = "Home";
		return view('frontend.users.features_alignment_target_initiative', compact('page_title'));
	}
	public function features_progress_tracking_and_insights(){
		$page_title = "Home";
		return view('frontend.users.features_progress_tracking_and_insights', compact('page_title'));
	}
	public function features_collaboration(){
		$page_title = "Home";
		return view('frontend.users.features_collaboration', compact('page_title'));
	}
	public function alignya_process(){
		$page_title = "Home";
		return view('frontend.users.alignya_process', compact('page_title'));
	}
	public function blog(){
		$page_title = "Home";
		return view('frontend.users.blog', compact('page_title'));
	}
	public function contact(){
		$page_title = "Home";
		return view('frontend.users.contact', compact('page_title'));
	}
	
	
	public function verifyMail(){
		$has_key =  $this->request->get('q');
		$mes = '';
		$user_check = User::where('varify_hash',$has_key)->count();

		if($user_check){
			$user_check_verifyed = User::where(['varify_hash'=>$has_key,'varify_account'=>0])->count();
        
			if($user_check_verifyed){
                $userdata   = User::where(['varify_hash'=>$has_key,'varify_account'=>0])->first();
                $useremail =    $userdata->email;
                $created_date = $userdata->created_at;
                $created_timestemp = strtotime($created_date);
                $created_timestemp_addseven = strtotime('+7 day', $created_timestemp);
                $currenttimestemp   =   strtotime('now');
                
				if($created_timestemp_addseven < $currenttimestemp){
					return redirect('login')->with('errormessage', getLabels('verification_link_expired'));
				}else{
					User::where('varify_hash', $has_key)->update(array('varify_account' =>1, 'status' =>1));
					return redirect('login')->with('message', getLabels('email_address_confirmed'));
				}
			}else{
				return redirect('login')->with('errormessage', getLabels('account_already_verified'));
			}
		}else{
			return redirect('login')->with('errormessage', getLabels('invalid_url'));
		}
	}	
	
	

	public function register(){
		$page_title = getLabels('register');
		if ($this->request->isMethod('post')) {
			$validator = User::register($this->request->all());
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('profile_not_registered')]);
			}else{
				$data                = $this->request->except('password');
				$data['password']    = Hash::make($this->request->get('password'));
				$data['role_id']     = 2;
				$data['status']      = 0;
				$user = User::create($data);
				
				if($user){
					$last_id = $user->id;
					$uniq_username = User::createUsername($last_id);
					$varify_hash = base64_encode($last_id.$uniq_username);
					User::where('id', $user->id)->update(array('varify_hash'=>$varify_hash ));
					
					$mail_data  	=     getEmailTemplate('user-registration'); //DB::table('templates')->where('slug', '=', 'user-registration')->first();
					if($mail_data){
						$usr_name       = $user->first_name." ".$user->last_name;
						$email          = $user->email; 
						$link           = config('constants.SITE_URL').'verify-mail?q='.$varify_hash;                       
						$site_name      = config('constants.SITE_TITLE');
						$admin_email    = config('constants.SITE_EMAIL'); 
						$message        = str_replace(array('{NAME}', '{EMAIL}', '{LINK}', '{SITE}'), array($usr_name, $email, $link, $site_name), $mail_data['content']);
						$subject        = str_replace(array('{SITE}'), array($site_name), $mail_data['subject']);
						//return view('frontend.my_email')->with('data',$message);
						Mail::send('frontend.my_email', array('data'=>$message), function($message) use ($subject,$usr_name,$email, $site_name, $admin_email){
							$message->from($admin_email, $site_name);
							$message->to($email, $usr_name)->subject($subject);
						}); 
						return response()->json(array("type" => "success", "url" => url('login'), "message" => getLabels('registered_successfully')));
					}
				}
			}
		}
		
		return view('frontend.users.register', compact('page_title'));
	}
	
	public function account(){
		$page_title = "Account";
		return view('frontend.users.account', compact('page_title'));
	}
	
	
	public function forgot_password(){
		$page_title = getLabels("forgot_password");
		if($this->request->isMethod('post')){
			$validator = User::validate_forgot_pass($this->request->all());
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('provide_valid_registered_email')]);
			} else {
				$email = $this->request->get("email");
				$usr_data  = (array)DB::table('users')->where('email', $email)->whereIn('role_id', [1,2])->first();
				
				if($usr_data){
					$mail_data  	= getEmailTemplate('forgot_password'); //DB::table('templates')->where('slug', '=', 'forgot_password')->first();
					if($mail_data){
						$number =   rand(0,100000);
                    
                        $varify_hash    =   base64_encode($usr_data['id'].$usr_data['uniq_username'].time());
                        User::where('id', $usr_data['id'])->update(array('varify_hash'=>$varify_hash ));
                        $usr_name       = $usr_data['first_name']." ".$usr_data['last_name'];
                        $email          = $usr_data['email']; 
                        $link           = config('constants.SITE_URL').'resetpassword/'.$number.'?q='.$varify_hash; 
                        $site_name      = config('constants.SITE_TITLE');
                        $admin_email    = config('constants.SITE_EMAIL'); 
                        
						if($email){
							$message        = str_replace(array('{NAME}','{LINK}', '{SITE}'), array($usr_name, $link, $site_name),  $mail_data['content']);
							$subject        = str_replace(array('{SITE}'), array($site_name), $mail_data['subject']);
							//return view('frontend.my_email')->with('data',$message);
							Mail::send('frontend.my_email', array('data'=>$message), function($message) use ($subject,$usr_name,$email, $site_name, $admin_email){
								$message->from($admin_email, $site_name);
								$message->to($email, $usr_name)->subject($subject);
							}); 
						}
						return response()->json(array("type" => "success", "url" => url('login'), "message" => getLabels('email_sent_recover_pwd')));
					}
				}else{
					return response()->json(array("type" => "error", "url" => url('login'), "message" => getLabels('email_not_exist')));
				}
			}
		}
		return view('frontend.users.forgot_password', compact('page_title'));
	}
	
	
	
	public function resetpassword($prefix=null,$verify_key=null){
		$page_title = getLabels("reset_password");
		if($this->request->get('q')){
			$hash = $this->request->get('q');
			if(Auth::check()){
				return redirect('dashboard');
			}else{
				$user_detail = User::where('varify_hash',$hash)->first(['updated_at','email']);
				
				if(!empty($user_detail)){
					$update 			=   $user_detail->updated_at;
					$update_strto 		= strtotime('+24 hour', strtotime($update));
					$current_time   	= time();
					if($current_time > $update_strto){
						return response()->json(array("type" => "error", "message" =>  getLabels('reset_password_link_expired')));
					}
					if($this->request->isMethod('post')){
						$validator = User::admin_changepassword($this->request->all());

						if ($validator->fails()) {	
							return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('password_not_changed')]);
						}else {
							$password = Hash::make($this->request->get('new_password'));
							User::where('varify_hash', $hash)->update(array('password'=>$password));
							//$message =  'The password for ('.$user_detail->email.') has been successfully changed.  You can login now';
							$message =  str_replace(array('{EMAIL}'), array($user_detail->email), getLabels('password_changed_successfully'));
							return response()->json(array("type" => "success", "url" => url('login'), "message" => $message));
						}
					}
				}
				return view('frontend.users.resetpassword',['page_title'=>$page_title, 'prefix'=>$prefix, 'hash'=>$hash]);
			}
		}
	}
	
	
	
	
	public function login(){
		$page_title = getLabels('login');
		
		/* 
		if (Auth::check())
		{ 
			if(Auth::User()->role_id == 1 or Auth::User()->role_id == 2){
				return redirect('admin/dashboard');
			}else{
				return redirect('/admin/logout');
			}
		} */
		if(Auth::check()){
			if(!$this->request->ajax()){
				return redirect("dashboard");
			}
		}
		if($this->request->isMethod('post')){
			
			$url_prefix = ($this->request->route()->getPrefix() == env('ADMIN_PREFIX'))?env('ADMIN_PREFIX').'/':'';
			
			$validation = User::validate_login($this->request->all());

			if ($validation->fails()) {	
				return json_encode(array("status" => "error", "message" => getLabels('credentials_not_valid')));
			}else {
				$credentials = array('email' => $this->request->get('email'), 'password' => $this->request->get('password2'),'status' =>1 );
			
				if (Auth::attempt($credentials, true)) {
					
					if(Auth::user()->role_id == 1 and $url_prefix !=""){
						return json_encode(array("status" => "success", "header" => view('frontend/layouts/header')->render(), "navigation" => view('frontend/layouts/navigation')->render()));
					}elseif(Auth::user()->role_id == 2 and $url_prefix ==""){
						return json_encode(array("status" => "success", "header" => view('frontend/layouts/header')->render(), "navigation" => view('frontend/layouts/navigation')->render()));
					}else{
						Auth::logout();
						return json_encode(array("status" => "error", "message" => getLabels('credentials_not_valid')));
					} 
				}else {	
					return json_encode(array("status" => "error",  "message" => getLabels('incorrect_username_pwd')));	
				}
			}
		}
		
		return view('frontend.users.login', compact('page_title'));
	}
	
	
	
	
	public function dashboard(){
		$page_title = getLabels('Dashboard');
		$objectives_count = Objective::count();
		$measure_count = Measure::where('category_type',1)->count();
		$initiative_count = Measure::where('category_type',2)->count();
		$kpi_count = Measure::where('category_type',3)->count();
		return view('frontend.users.dashboard', compact('page_title','objectives_count','measure_count','initiative_count','kpi_count'));
	}
	
	
	public function logout(){
		Auth::logout();
	}
	
	
	public function admin_index($role_id = null){
		$page_title  = getLabels("Members");
		
		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}
		
		$data  = User::sortable()->where('users.role_id', $role_id)->leftjoin('countries', 'countries.id', '=', 'users.country_id');
		
		if(! empty($_POST)){
			if(isset($_POST['first_name']) and $_POST['first_name'] !=''){
				$first_name = $_POST['first_name'];
				$this->request->session()->put('usearch.first_name', $first_name);
				$data = $data->whereRaw('concat(users.first_name," ",users.last_name) like ?', "%{$first_name}%");
			}
			if(isset($_POST['email']) and $_POST['email'] !=''){
				$email = $_POST['email'];
				$this->request->session()->put('usearch.email', $email);
				$data = $data->where('users.email',  $email);
			}
			if(isset($_POST['status']) and $_POST['status'] !=''){
				$status = $_POST['status'];
				$this->request->session()->put('usearch.status', $status);
				$data = $data->where('users.status', $status);
			}
		}else{
			$this->request->session()->forget('usearch');
		}
		
		
		$data  = $data->select('users.*', 'countries.name as country')->orderBy('users.created_at', 'desc')->paginate(config('constants.PAGINATION'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$page_title  = getLabels("Members");
		return view('frontend/users/admin_index', compact('data','role_id','page_title'));
	}
	
	
	public function admin_status($role_id = null, $id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$user			 = User::find($id);
		$status          = $user->status == 1?0:1;
		$userUpdate 	 = $user->update(array('status' => $status));
		
		if($userUpdate){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'users'), "message" => getLabels('status_changed_successfully'));
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'users'), "message" => getLabels('status_not_updated'));
		}
		return json_encode($results);
	}
	
	
	
	
	public function admin_add(){
		
		$data = array();
		
		$page_title = getLabels("Add New Member");
		$countries  = Country::where('status', 1)->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
		if($this->request->isMethod('post')){
			$validator = User::validate($this->request->all());
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('member_not_saved_errors')]);
			} else {
				$formData              	= $this->request->except('password','photo', 'cover_photo');
				$formData['password'] 	= Hash::make($this->request->get('password'));
				if ( $this->request->photo){
					// Pass Slim's getImages the name of your file input, and since we only care about one image, use Laravel's head() helper to get the first element
					$image = head(Slim::getImages('photo'));

					// Grab the ouput data (data modified after Slim has done its thing)
					if ( isset($image['output']['data']) ){
						// Original file name
						$name = $image['output']['name'];

						// Base64 of the image
						$dataImage = $image['output']['data'];

						// Server path
						$path = base_path() . '/public/upload/users/profile-photo/';

						// Save the file to the server
						$file = Slim::saveFile($dataImage, $name, $path);
						
						$formData['photo'] 	= $file['name'];
						// Get the absolute web path to the image
						//$imagePath = asset('tmp/' . $file['name']);
					}
				}
				
				if ( $this->request->cover_photo){
					$image = head(Slim::getImages('cover_photo'));

					if ( isset($image['output']['data']) ){
						$name = $image['output']['name'];
						$dataImage = $image['output']['data'];
						$path = base_path() . '/public/upload/users/cover_photo/';

						// Save the file to the server
						$file = Slim::saveFile($dataImage, $name, $path);
						
						$formData['cover_photo'] 	= $file['name'];
					}
				}  
				
				$formData['role_id']	= 2;
				$formData['status']	= 1;
				$formData['block_ip_end'] = $_SERVER['REMOTE_ADDR'];
				$user  = User::create($formData);
				if($user){
					$uniq_username = User::createUsername($user->id);
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'members'), 'message' => getLabels('Member Saved Successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'members'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/users/admin_add', compact('data', 'countries', 'page_title'));
	}
	
	
	
	public function admin_edit($id = null){ 
		
		$data   = User::find($id);
		$uniq_username_old  = !empty($data->uniq_username)?$data->uniq_username:"";
		$page_title = getLabels("Update Member");
		$countries  = Country::where('status', 1)->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
		if($this->request->isMethod('post')){
			$validator = User::validate($this->request->all(), $id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('user_not_saved_errors')]);
			} else {
				$formData              	= $this->request->except('password','photo', 'cover_photo');
				
				if ( $this->request->photo){
					// Pass Slim's getImages the name of your file input, and since we only care about one image, use Laravel's head() helper to get the first element
					$image = head(Slim::getImages('photo'));

					// Grab the ouput data (data modified after Slim has done its thing)
					if ( isset($image['output']['data']) ){
						// Original file name
						$name = $image['output']['name'];

						// Base64 of the image
						$dataImage = $image['output']['data'];

						// Server path
						$path = base_path() . '/public/upload/users/profile-photo/';

						// Save the file to the server
						$file = Slim::saveFile($dataImage, $name, $path);
						if($id and $data->photo !="" and file_exists('public/upload/users/profile-photo/'. $data->photo)){
							unlink('public/upload/users/profile-photo/'. $data->photo);
						}
						$formData['photo'] 	= $file['name'];
						// Get the absolute web path to the image
						//$imagePath = asset('tmp/' . $file['name']);
					}
				}
				
				if ( $this->request->cover_photo){
					$image = head(Slim::getImages('cover_photo'));

					if ( isset($image['output']['data']) ){
						$name = $image['output']['name'];
						$dataImage = $image['output']['data'];
						$path = base_path() . '/public/upload/users/cover_photo/';

						// Save the file to the server
						$file = Slim::saveFile($dataImage, $name, $path);
						if($id and $data->cover_photo !="" and file_exists('public/upload/users/cover_photo/'. $data->cover_photo)){
							unlink('public/upload/users/cover_photo/'. $data->cover_photo);
						}
						$formData['cover_photo'] 	= $file['name'];
					}
				} 
				
				$user  = $data->update($formData);
				if($user){
					if(!empty($formData['uniq_username']) and ($uniq_username_old != $formData['uniq_username'])){
						changeuniqusername($uniq_username_old, $formData['uniq_username']);
					}
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'members'), 'message' => getLabels('Member Update Successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'members'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/users/admin_edit', compact('data', 'id', 'countries', 'page_title'));
	}
	
	
	
	
	public function profile($username = null){
	
		$data  = DB::table('users')->leftjoin('countries', 'countries.id', '=', 'users.country_id')->where('users.uniq_username', $username)->where('users.status', 1)->first(array('users.*', 'countries.name as country_name'));
		$page_title = $data->first_name." ".$data->last_name;
		
		return view('frontend.users.profile', compact('page_title', 'data', 'following', 'followers', 'posts', 'myfollowers', 'plans'));
	}
	
	
	
	
	public function admin_delete_photo(){
		if($this->request->ajax()){
			$user_id  	 = $this->request->user_id;
			$image_type  = $this->request->image_type;
			$User  		 = User::find($user_id);
			if($image_type == "photo"){
				if($User and $User->photo !="" and file_exists('public/upload/users/profile-photo/'.$User->photo)){
					unlink('public/upload/users/profile-photo/'.$User->photo);
					$User->update(array("photo" => $User->photo));
				}
			}
			if($image_type == "cover_photo"){
				if($User and $User->cover_photo !="" and file_exists('public/upload/users/cover_photo/'.$User->cover_photo)){
					unlink('public/upload/users/cover_photo/'.$User->cover_photo);
					$User->update(array("cover_photo" => $User->cover_photo));
				}
			}
			return response()->json(['type' => 'success']);
		}
	}
	
	// public function update_profile($username = null){ 
		
	// 	$id = Auth::id();
	// 	$data   = User::find($id);
	// 	$uniq_username_old  = !empty($data->uniq_username)?$data->uniq_username:"";
	// 	$page_title = getLabels("update_my_profile");
	// 	$countries  = Country::where('status', 1)->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
	// 	if($this->request->isMethod('post')){
	// 		$validator = User::validateMy($this->request->all(), $id);
			
	// 		if ( $validator->fails() ) {
	// 			return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('profile_not_updated')]);
	// 		} else {
	// 			$formData              	= $this->request->except('password','photo', 'cover_photo');
				
	// 			if ( $this->request->photo){
	// 				// Pass Slim's getImages the name of your file input, and since we only care about one image, use Laravel's head() helper to get the first element
	// 				$image = head(Slim::getImages('photo'));

	// 				// Grab the ouput data (data modified after Slim has done its thing)
	// 				if ( isset($image['output']['data']) ){
	// 					// Original file name
	// 					$name = $image['output']['name'];

	// 					// Base64 of the image
	// 					$dataImage = $image['output']['data'];

	// 					// Server path
	// 					$path = base_path() . '/public/upload/users/profile-photo/';

	// 					// Save the file to the server
	// 					$file = Slim::saveFile($dataImage, $name, $path);
	// 					if($id and $data->photo !="" and file_exists('public/upload/users/profile-photo/'. $data->photo)){
	// 						unlink('public/upload/users/profile-photo/'. $data->photo);
	// 					}
	// 					$formData['photo'] 	= $file['name'];
	// 					// Get the absolute web path to the image
	// 					//$imagePath = asset('tmp/' . $file['name']);
	// 				}
	// 			}
				
	// 			if ( $this->request->cover_photo){
	// 				$image = head(Slim::getImages('cover_photo'));

	// 				if ( isset($image['output']['data']) ){
	// 					$name = $image['output']['name'];
	// 					$dataImage = $image['output']['data'];
	// 					$path = base_path() . '/public/upload/users/cover_photo/';

	// 					// Save the file to the server
	// 					$file = Slim::saveFile($dataImage, $name, $path);
	// 					if($id and $data->cover_photo !="" and file_exists('public/upload/users/cover_photo/'. $data->cover_photo)){
	// 						unlink('public/upload/users/cover_photo/'. $data->cover_photo);
	// 					}
	// 					$formData['cover_photo'] 	= $file['name'];
	// 				}
	// 			}
	// 			if(!empty($formData['payout_email']) && !empty($formData['street_1']) && !empty($formData['city']) && !empty($formData['state']) && !empty($formData['country_id'])){
	// 				$formData['is_complete_profile'] = 1;
	// 			}else{
	// 				$formData['is_complete_profile'] = 0;
	// 			}
				
	// 			$user  = $data->update($formData);
				
	// 			if($user){
	// 				if(!empty($formData['uniq_username']) and ($uniq_username_old != $formData['uniq_username'])){
	// 					changeuniqusername($uniq_username_old, $formData['uniq_username']);
	// 				}
	// 				$u_prefix = "";
	// 				if(Auth::User()->role_id == 1){
	// 					$u_prefix  =  env('ADMIN_PREFIX');
	// 				}
	// 				return response()->json(['type' => 'success', 'url'=> url($u_prefix, Auth::User()->uniq_username), 'message' => getLabels('profile_updated_successfully')]);
	// 			}else{
	// 				return response()->json(['type' => 'error', 'url'=> url($u_prefix, Auth::User()->uniq_username), 'message' => getLabels('something_wrong_try_again')]);
	// 			}
	// 		}
	// 	}
	// 	$total_followers  = Follower::where('user_id', Auth::id())->orWhere('to_user_id', Auth::id())->count();
	// 	return view('frontend/users/update_profile', compact('data', 'id', 'countries', 'page_title', 'total_followers', $total_followers));
	// }

	public function update_profile(){
		$page_title = getLabels("update_profile");
		return view('frontend/users/update_profile',compact('page_title'));
	}
	
	
	
	
	public function change_password($uniq_username = null){
		if($this->request->ajax()){
			$id = Auth::id();
			$users =  User::find($id);
		
			if ($this->request->isMethod('post')) {            
			   $validator = User::change_password($this->request->all());
				
				if ( $validator->fails() ) {
					return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('password_saved_errors')]);
				} else {
					$password = Hash::make($this->request->get('new_password'));
					$data = array('password' => $password);
					$action =   $users->update($data);
					if($action){
						return response()->json(['type' => 'success', 'url'=>'close_modal', 'message' => getLabels('password_changed')]);
					}else{
						return response()->json(['type' => 'error', 'url'=>'close_modal', 'message' => getLabels('something_wrong_try_again')]);
					}
				}
			}
		}
	}
	
	public function search(){
		$page_title  = getLabels("people");
		$first_name = $this->request->query('q');
		
		if($first_name == ""){
			$first_name = $this->request->session()->get('search_q');
		}else{
			$this->request->session()->put('search_q', $first_name);
		}
		
		$data  = User::where('users.role_id', 2)->where('users.status', 1)->where('users.id', '!=', Auth::id())->leftjoin('countries', 'countries.id', '=', 'users.country_id');
		if($first_name){
			$data = $data->whereRaw('concat(users.first_name," ",users.last_name) like ?', "%{$first_name}%");
		}
		
		$data  = $data->select('users.*', 'countries.name as country')->orderBy('users.created_at', 'desc')->paginate(config('constants.PAGINATION'));
		$following  = Follower::where('user_id', Auth::id())->pluck('to_user_id')->toArray();
		$follower   = Follower::where('to_user_id', Auth::id())->pluck('user_id')->toArray();
		if(isset($_GET['q']) and $_GET['q']){
			$data->appends(array('q' => $_GET['q']))->links();
		}
		return view('frontend/users/search', compact('data', 'page_title', 'following', 'follower'));
	}
	
	
	
	public function admin_changepassword($uniq_username = null){
		$page_title = getLabels("Change_Password");
		$data =  User::where('uniq_username', $uniq_username)->first();
		if($this->request->ajax() and Auth::User()->role_id == 1){
			if ($this->request->isMethod('post')) {            
			   $validator = User::admin_changepassword($this->request->all());
				
				if ( $validator->fails() ) {
					return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('password_saved_errors')]);
				} else {
					$password = Hash::make($this->request->get('new_password'));
					$dataForm = array('new_password' => $password);
					$action =   $data->update($dataForm);
					if($action){
						return response()->json(['type' => 'success', 'url'=>url(env('ADMIN_PREFIX'), 'users'), 'message' => getLabels('password_changed')]);
					}else{
						return response()->json(['type' => 'error', 'url'=>url(env('ADMIN_PREFIX'), 'users'), 'message' => getLabels('something_wrong_try_again')]);
					}
				}
			}
		}
		return view('frontend/users/admin_changepassword', compact('data', 'page_title'));
	}
	
	
	
	
	
	
	
	
	
	/************************************************Social Logins *********************************************************************************/
	public function redirectToProvider($provider){
       return Socialite::driver($provider)->redirect();
    }
	
	
	public function handleProviderCallback($provider){
		$user = Socialite::driver($provider)->user();
		//pr($user); die;
		$authUser = $this->findOrCreateUser($user, $provider);
	 
		Auth::login($authUser, true);
		$page_title  = "Callback";
		$response = json_encode(['header' => view('frontend/layouts/header')->render(), 'navigation' => view('frontend/layouts/navigation')->render()]);
		return view('frontend/users/handleProviderCallback', compact('page_title', 'response'));
	}
	
	
	
	public function findOrCreateUser($user, $provider){
		if(isset($user->email)){
			$authUser = User::where('email', $user->email)->first();
		}else{
			$authUser = User::where('provider_id', $user->id)->first(); 
		}
		// Register New user
		if ($authUser) {
			return $authUser;
		}

		$file_name ='';
		$gender = 1;

		$first_name = 'Stremer';
		$last_name = 'Studio';
		
		if($provider =='linkedin'){  
			if($user->avatar_original){          
				$file_name = $this->resizeProfileImage($user->avatar_original);         
			}
			$first_name = $user->name;
		}
		
		if($provider =='twitter'){  
			if($user->avatar_original){          
				$file_name = $this->resizeProfileImage($user->avatar_original,1);           
			}
		}

		if($provider =='discord'){  
			if($user->avatar_original){          
				$file_name = $this->resizeProfileImage($user->avatar_original,1);           
			}
		}

		if($provider =='steam'){ 
			if($user->avatar){          
				$file_name = $this->resizeProfileImage($user->avatar,1);           
			}
		   $first_name = $user->nickname;
		}

		if($provider =='mixer'){ 
			if($user->avatar){          
				$file_name = $this->resizeProfileImage($user->avatar,1);           
			}
			$first_name = $user->username;
		}


		if($provider =='instagram'){  
			if($user->avatar){           
				$file_name = $this->resizeProfileImage($user->avatar);          
			}
		}

		if($provider =='facebook'){  
			if($user->avatar_original){          
				$file_name = $this->resizeProfileImageFacebook($user->avatar_original);         
			}
		}

		if($provider =='github'){  
			if($user->avatar){  
				$url =$user->avatar;
				//https://avatars1.githubusercontent.com/u/7098612?v=4
				$name = substr($url, strrpos($url, '/') + 1);

				$name = explode('?', $name );
				$name = $name[0];
				$name = $name.'.jpeg';

				$file_name = $this->resizeProfileImageGoogle($user->avatar,$name);
				User::where('provider_id', $user->id)->update(array("photo" => $file_name));
			}
		}

		if($provider =='bitbucket'){  
			if($user->avatar){  
				$name = $user->id.'.jpg';
				$image_path = str_replace('32', '300', $user->avatar);           
				$file_name = $this->resizeProfileImageGoogle($image_path, $name);
				User::where('provider_id', $user->id)->update(array("photo" => $name));
			}
		}

		if($provider =='google'){ 
			if($user->avatar_original){  
				$name = $user->id.'.jpg';
				$file_name = $this->resizeProfileImageGoogle($user->avatar_original, $name);
				User::where('provider_id', $user->id)->update(array("photo" => $name));
			}
		}

		if($provider =='facebook' || $provider =='google'){
			  if(isset($user->user['gender'])){
				if($user->user['gender'] == 'female'){
					$gender = 0;
				}
			}
		}

		if($provider =='facebook' || $provider =='twitter' || $provider =='google' || $provider =='github' || $provider =='vkontakte' || $provider =='instagram' || $provider =='bitbucket' || $provider =='discord'){
			$names = explode(' ', $user->name);
			if(isset($names[0])){           
				$first_name =$names[0];
			}
			if(isset($names[1])){           
				$last_name =$names[1];
			}
		}
	   
		$str = 'streamer';
		if($user->name){
			$str = $user->name;
		}else{
			$str = $first_name.$last_name;
		}
		
		

		

		$data = User::create([
			'first_name'     => $first_name,
			'last_name'     => $last_name,
			'email'    => isset($user->email)?$user->email:'',
			'provider' => $provider,
			'provider_id' => $user->id,
			//'username' => md5($user->id),
			/* 'password' =>$password_d,
			'varify_hash'=>$varify_hash,
			'uniq_username'=>$uniq_username, */
			'varify_account'=>isset($user->email)?1:0,
			'status'=>1,
			'role_id'=>2,
			'photo'=>$file_name,
			'gender'=>$gender
		]);
		$uniq_username  = User::createUsername($data->id);
		
		$varify_hash = base64_encode($user->id.$uniq_username);

		$password = md5($user->id.$uniq_username);

		$password_d = Hash::make($password);
		
		User::where('id', $data->id)->update(array('password' => $password_d, 'varify_hash' => $varify_hash));

		$mail_data  	= getEmailTemplate('streamer-studio-social-login');
		if($mail_data && isset($user->email)){
			$usr_name       = $first_name." ".$last_name;
			$email          = $user->email; 
			$link           = config('constants.SITE_URL'); 

			$site_name      = config('constants.SITE_TITLE');
			$admin_email    = config('constants.SITE_EMAIL'); 
			$helplink           = config('constants.SITE_URL').'help';
			$privacy_policy = config('constants.SITE_EMAIL').'privacy_policy'; 
			$about_us   = config('constants.SITE_EMAIL').'about_us';
			$message        = str_replace(array('{NAME}', '{SITE}', '{PASSWORD}'), array($usr_name, $site_name, $password), $mail_data['content']);
			$subject        = str_replace(array('{SITE}'), array($site_name), $mail_data['subject']);
			Mail::send('frontend.my_email', array('data'=>$message), function($message) use ($subject,$usr_name,$email, $site_name, $admin_email){
				$message->from($admin_email, $site_name);
				$message->to($email, $usr_name)->subject($subject);
			}); 
		}

		return  $data;
	}
	
	
	
	
	public function resizeProfileImageGoogle($url,$name){
        $file_name = $name;
		$ext = 'jpeg';      
		$contents = file_get_contents($url);
		$uploadfile = 'public/upload/users/profile-photo/'.$file_name; 
        $upload =file_put_contents($uploadfile, $contents);
		list($width, $height) = getimagesize($uploadfile);
		
		$quality_jpg = config('constants.Image_QUALITY');
		$quality_png = config('constants.Image_QUALITY_PNG');
		
		//Saving thumb
        $thumb_height   = $thumb_width  = config('constants.USER_THUMB_WIDTH');
		
		$quality = config('constants.Image_QUALITY');
            
		$image = imagecreatefromstring(file_get_contents($uploadfile));
		$image_thumb = imagecreatetruecolor($thumb_width, $thumb_height);
		imagecopyresampled($image_thumb, $image, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
		// Output
             
		if($ext == 'png'){
			imagepng($image_thumb, 'public/upload/users/profile-photo/thumb/'. $file_name, $quality_png);
		}else{
			imagejpeg($image_thumb, 'public/upload/users/profile-photo/thumb/'. $file_name,$quality_jpg); 
		}
            //Saving medium
		$medium_height  =  $medium_width    = config('constants.USER_MEDIUM_WIDTH');
		
		$image = imagecreatefromstring(file_get_contents($uploadfile));
		$image_medium = imagecreatetruecolor($medium_width, $medium_height);
		imagecopyresampled($image_medium, $image, 0, 0, 0, 0, $medium_width, $medium_height, $width, $height);
		// Output
		if($ext == 'png'){
			imagepng($image_medium, 'public/upload/users/profile-photo/medium/'. $file_name, $quality_png);
		}else{
			imagejpeg($image_medium, 'public/upload/users/profile-photo/medium/'. $file_name, $quality_jpg); 
		}

		/* saveOverFTPUserImage('users/profile-photo/large', $file_name); //Move large files on hubscure.co
		saveOverFTPUserImage('users/profile-photo/medium', $file_name); //Move medium files on hubscure.co
		saveOverFTPUserImage('users/profile-photo/thumb', $file_name); //Move thumb files on hubscure.co */

		return $file_name;
	}

	
	
	public function resizeProfileImage($url,$extainsion=false){
        $file_name = '';
		$contents = file_get_contents($url);
		$name = substr($url, strrpos($url, '/') + 1);

		if(!$extainsion){
			$file_name = $name.'.jpeg';
			$ext = 'jpeg';
		}else{
			$file_name = $name;
			$ext = pathinfo($file_name,PATHINFO_EXTENSION);
		}

        $uploadfile = 'public/upload/users/profile-photo/'.$file_name;
		$upload =file_put_contents($uploadfile, $contents);
		list($width, $height) = getimagesize($uploadfile);

		$quality_jpg = config('constants.Image_QUALITY');
		$quality_png = config('constants.Image_QUALITY_PNG');

            
		//Saving thumb
		$thumb_height   = $thumb_width  = config('constants.USER_THUMB_WIDTH');

		$quality = config('constants.Image_QUALITY');
		
		$image = imagecreatefromstring(file_get_contents($uploadfile));
		$image_thumb = imagecreatetruecolor($thumb_width, $thumb_height);
		imagecopyresampled($image_thumb, $image, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
		// Output
		 
		if($ext == 'png'){
			imagepng($image_thumb, 'public/upload/users/profile-photo/thumb/'. $file_name, $quality_png);
		}else{
			imagejpeg($image_thumb, 'public/upload/users/profile-photo/thumb/'. $file_name,$quality_jpg); 
		}
		//Saving medium
		$medium_height  =  $medium_width    = config('constants.USER_MEDIUM_WIDTH');
		
		$image = imagecreatefromstring(file_get_contents($uploadfile));
		$image_medium = imagecreatetruecolor($medium_width, $medium_height);
		imagecopyresampled($image_medium, $image, 0, 0, 0, 0, $medium_width, $medium_height, $width, $height);
		// Output
		if($ext == 'png'){
			imagepng($image_medium, 'public/upload/users/profile-photo/medium/'. $file_name, $quality_png);
		}else{
			imagejpeg($image_medium, 'public/upload/users/profile-photo/medium/'. $file_name, $quality_jpg); 
		}

		/* saveOverFTPUserImage('users/profile-photo/large', $file_name); //Move large files on hubscure.co
		saveOverFTPUserImage('users/profile-photo/medium', $file_name); //Move medium files on hubscure.co
		saveOverFTPUserImage('users/profile-photo/thumb', $file_name); //Move thumb files on hubscure.co
		*/
		return $file_name;
	}

	
	public function resizeProfileImageFacebook($url,$extainsion=false){
		$file_name = '';
		$contents = file_get_contents($url);

		$url = explode('.com', $url);
		$url = explode('/', $url[1]);

		
		$name = $url[2];            

		if(!$extainsion){
			$file_name = $name.'.jpeg';
			$ext = 'jpeg';
		}else{
			$file_name = $name;
			$ext = pathinfo($file_name,PATHINFO_EXTENSION);
		}
		
		$uploadfile = 'public/upload/users/profile-photo/'.$file_name;

        $upload =file_put_contents($uploadfile, $contents);
		list($width, $height) = getimagesize($uploadfile);

		$quality_jpg = config('constants.Image_QUALITY');
		$quality_png = config('constants.Image_QUALITY_PNG');

        //Saving thumb
        $thumb_height   = $thumb_width  = config('constants.USER_THUMB_WIDTH');
		$quality = config('constants.Image_QUALITY');
            
		$image = imagecreatefromstring(file_get_contents($uploadfile));
		$image_thumb = imagecreatetruecolor($thumb_width, $thumb_height);
		imagecopyresampled($image_thumb, $image, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
        
		// Output
             
		if($ext == 'png'){
			imagepng($image_thumb, 'public/upload/users/profile-photo/thumb/'. $file_name, $quality_png);
		}else{
			imagejpeg($image_thumb, 'public/upload/users/profile-photo/thumb/'. $file_name,$quality_jpg); 
		}
        //Saving medium
        $medium_height  =  $medium_width    = config('constants.USER_MEDIUM_WIDTH');
            
		$image = imagecreatefromstring(file_get_contents($uploadfile));
		$image_medium = imagecreatetruecolor($medium_width, $medium_height);
		imagecopyresampled($image_medium, $image, 0, 0, 0, 0, $medium_width, $medium_height, $width, $height);
		// Output
		if($ext == 'png'){
			imagepng($image_medium, 'public/upload/users/profile-photo/medium/'. $file_name, $quality_png);
		}else{
			imagejpeg($image_medium, 'public/upload/users/profile-photo/medium/'. $file_name, $quality_jpg); 
		}

		/*
 		saveOverFTPUserImage('users/profile-photo/large', $file_name); //Move large files on hubscure.co
		saveOverFTPUserImage('users/profile-photo/medium', $file_name); //Move medium files on hubscure.co
		saveOverFTPUserImage('users/profile-photo/thumb', $file_name); //Move thumb files on hubscure.co
		*/
       return $file_name;
	}
}
