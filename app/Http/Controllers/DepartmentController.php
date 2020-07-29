<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Country;
use App\Models\Template;
use App\Models\Teams;
use App\Models\Department;
use App\Models\TeamsMembers;
use App\Models\GoalCycles;
use App\Models\Objective;
use App\Models\Plans;
use App\Models\Theme;
use App\Models\Perspective;
use App\Models\DepartmentMember;
use App\Models\Follower;
use App\Models\Post;
use App\Models\Notification;
use App\Models\Scorecard;
use App\Models\Measure;
use App\Models\Company;
use App\Models\SubscriptionPlan;
use App\Models\Subscription;

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
class DepartmentController extends Controller
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
		$this->middleware('auth', ['except' => ['resizeProfileImageGoogle', 'resizeProfileImage', 'profile', 'resizeProfileImageFacebook', 'verifyMail', 'findOrCreateUser', 'redirectToProvider', 'handleProviderCallback', 'admin_login', 'admin_register', 'login', 'register', 'forgot_password', 'resetpassword', 'admin_forgot_password']]);
    }
	
	
	public function admin_index($id=null){
		$page_title  = getLabels("Departments");
		if($this->request->isMethod('post')){
			//pr($this->request->all());
			$validator = Department::validate($this->request->all());
			
			if ( $validator->fails() ) {
				return redirect()->back()->with('errormessageadd',getLabels('department_not_saved_errors'))->withErrors($validator->errors());
			} else {
			
				$formData = $this->request->except('member_ids','department_head');
				$formData['status'] = 1;
				$formData['company_id'] = Auth::User()->company_id;
				if($id){
					$u_data = Department::find($id);
					$updatedepartment = $u_data->update($formData);
				}else{
					$adddepartment = Department::create($formData);
				}
				if($this->request->get('member_ids')){
					if($id){
						$prev_members = DepartmentMember::where('department_id',$id)->where('is_head',0)->get();
						if(!empty($prev_members)){
							$deletedepartment = DepartmentMember::where('department_id',$id)->where('is_head',0)->delete();
						}
					}
					$member_ids = $this->request->get('member_ids');
					foreach ($member_ids as $key => $value) {
						$departmentmembers = array();
						$departmentmembers['member_id'] = $value;
						if($id){
							$departmentmembers['department_id'] = $id;
						}else{
							$departmentmembers['department_id'] = $adddepartment->id;
						}
						$departmentmembers['is_head'] = 0;
						DepartmentMember::create($departmentmembers);
					}
				}
				if($this->request->get('department_head')){
					if($id){
						$prev_members = DepartmentMember::where('department_id',$id)->where('is_head',1)->get();
						if(!empty($prev_members)){
							$deletedepartment = DepartmentMember::where('department_id',$id)->where('is_head',1)->delete();
						}
					}
					$departmentmembers = array();
					$departmentmembers['member_id'] = $this->request->get('department_head');
					if($id){
						$departmentmembers['department_id'] = $id;
					}else{
						$departmentmembers['department_id'] = $adddepartment->id;
					}
					$departmentmembers['is_head'] = 1;
					DepartmentMember::create($departmentmembers);
					Objective::where('department_id',$id)->update(array('owner_user_id'=>$this->request->get('department_head')));
					Measure::where('measure_department_id',$id)->update(array('owner_user_id'=>$this->request->get('department_head')));
				}
			}
			return redirect()->back();
		}
		if($id){
			$parent_department = Department::where('company_id',Auth::User()->company_id)->where('id',$id)->orderBy('id','asc')->first();
		}else{
			$parent_department = Department::where('company_id',Auth::User()->company_id)->orderBy('id','asc')->first();
		}
		if(!empty($parent_department)){
			$hod = DepartmentMember::leftjoin('users','users.id','=','al_department_member.member_id')->where('al_department_member.department_id',$parent_department->id)->where('al_department_member.is_head',1)->select('users.first_name','users.last_name','users.designation','users.id','users.photo','users.id as selected_user_id')->first();
			$members = DepartmentMember::leftjoin('users','users.id','=','al_department_member.member_id')->where('al_department_member.department_id',$parent_department->id)->where('al_department_member.is_head',0)->select('users.first_name','users.last_name','users.designation','users.photo')->get();
			$members_pluck = DepartmentMember::leftjoin('users','users.id','=','al_department_member.member_id')->where('al_department_member.department_id',$parent_department->id)->where('al_department_member.is_head',0)->select('users.first_name','users.last_name','users.designation','users.id')->pluck('users.id','users.first_name');
			//pr($members_pluck->toArray());
		}
		$all_members = User::select(DB::raw('CONCAT_WS(" ",first_name,last_name) as full_name'),'id')->whereIn('role_id',array(5,2))->where('company_id',Auth::User()->company_id)->pluck('full_name','id');
		
		$department_head = User::select(DB::raw('CONCAT_WS(" ",first_name,last_name) as full_name'),'id')->whereIn('role_id',array(3,2))->where('company_id',Auth::User()->company_id)->pluck('full_name','id');
		$departments = Department::where('status',1)->where('company_id',Auth::User()->company_id)->pluck("department_name","id");
		$data  = Department::where('company_id',Auth::User()->company_id)->where('parent_department_id',null)->get();
		if(isset($hod)){
			$objectives = Objective::where('company_id',Auth::User()->company_id)->where('owner_user_id',$hod->selected_user_id)->get();
		}else{
			$objectives = array();
		}
		$page_title  = getLabels("Departments");
		return view('frontend/departments/department', compact('data','role_id','page_title','parent_department','hod','members','departments','all_members','id','members_pluck','department_head','objectives'));
	}
	
	
	public function admin_status($role_id = null, $id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$user			 = User::find($id);
		$status          = $user->status == 1?0:1;
		$userUpdate 	 = $user->update(array('status' => $status));
		
		if($userUpdate){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'teams'), "message" => getLabels('status_changed_successfully'));
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'teams'), "message" => getLabels('status_not_updated'));
		}
		return json_encode($results);
	}
	
	
	
	
	public function admin_add($id=null){
		
		$data = array();
		$Parentdepartments = Department::pluck('department_name','id');
		if(!empty($Parentdepartments)){
			$Parentdepartments = $Parentdepartments->toArray();
		}
		$page_title = getLabels("Add New Department");
		$members  = User::select(DB::raw("CONCAT_WS(', ',first_name,designation) AS name"),'id')->where('role_id', 2)->orderBy('id', 'desc')->pluck('name', 'id')->toArray();
		if($this->request->isMethod('post')){
			$validator = Department::validate($this->request->all());
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('department_not_saved_errors')]);
			} else {
				$formData  = $this->request->except('department_members','department_head');
				if($this->request->get('parent_department_id') > 0){
					$parentdepartmentDetail = Department::where('id',$this->request->get('parent_department_id'))->first();
					$formData['parent_level'] = $parentdepartmentDetail->parent_level + 1;
				}
				$members_id = $this->request->get('department_members');
				$head_id = $this->request->get('department_head');
				$formData['status']	= 1;
				$department  = Department::create($formData);
				if(!empty($members_id)){
					$member_arr = array();
					foreach ($members_id as $key => $value) {
						$member_arr['department_id'] = $department->id;
						$member_arr['member_id'] = $value;
						$member_arr['is_head'] = 0;
						DepartmentMember::create($member_arr);
					}
				}

				if(!empty($head_id)){
					$member_arr = array();
					$member_arr['department_id'] = $department->id;
					$member_arr['member_id'] = $head_id;
					$member_arr['is_head'] = 1;
					DepartmentMember::create($member_arr);					
				}
				if($department){
					return response()->json(['type' => 'success', 'url'=> url( 'departments'), 'message' => getLabels('Department Saved Successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url( 'departments'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/departments/admin_add', compact('data', 'members', 'page_title','Parentdepartments'));
	}
	
	
	
	public function admin_edit($id = null){ 
		
		$data   = Department::find($id);
		$page_title = getLabels("Update Department");
		$Parentdepartments = Department::where('id','!=',$id)->pluck('department_name','id');
		if(!empty($Parentdepartments)){
			$Parentdepartments = $Parentdepartments->toArray();
		}
		if($this->request->isMethod('post')){
			$validator = Department::validate($this->request->all(), $id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('department_not_saved_errors')]);
			} else {
				$formData  = $this->request->except('department_members','department_head');
				if($this->request->get('parent_department_id') > 0){
					$parentdepartmentDetail = Department::where('id',$this->request->get('parent_department_id'))->first();
					$formData['parent_level'] = $parentdepartmentDetail->parent_level + 1;
				}
				$members_id = $this->request->get('department_members');
				$head_id = $this->request->get('department_head');
				$formData['status']	= 1;
				$department  = $data->update($formData);
				if(!empty($members_id)){
					$delete = DepartmentMember::where('department_id',$id)->where('is_head',0)->delete();
					$member_arr = array();
					foreach ($members_id as $key => $value) {
						$member_arr['department_id'] = $id;
						$member_arr['member_id'] = $value;
						$member_arr['is_head'] = 0;
						DepartmentMember::create($member_arr);
					}
				}

				if(!empty($head_id)){
					$delete = DepartmentMember::where('department_id',$id)->where('is_head',1)->delete();
					$member_arr = array();
					$member_arr['department_id'] = $id;
					$member_arr['member_id'] = $head_id;
					$member_arr['is_head'] = 1;
					DepartmentMember::create($member_arr);					
				}
				if($department){
					return response()->json(['type' => 'success', 'url'=> url('departments'), 'message' => getLabels('Department Update Successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url('departments'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		$members  = User::select(DB::raw("CONCAT_WS(' ',first_name,last_name) AS name"),'id')->where('role_id', 2)->orderBy('id', 'desc')->pluck('name', 'id')->toArray();
		$selected_members = DepartmentMember::where('department_id',$id)->where('is_head',0)->pluck('member_id','id');
		$department_head = DepartmentMember::where('department_id',$id)->where('is_head',1)->first();
		if(!empty($selected_members)){
			$selected_members = $selected_members->toArray();
		}
		return view('frontend/departments/admin_edit', compact('data', 'id', 'members', 'page_title','selected_members','Parentdepartments','department_head'));
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
	
	public function update_profile($username = null){ 
		
		$id = Auth::id();
		$data   = User::find($id);
		$uniq_username_old  = !empty($data->uniq_username)?$data->uniq_username:"";
		$page_title = getLabels("update_my_profile");
		$countries  = Country::where('status', 1)->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
		if($this->request->isMethod('post')){
			$validator = User::validateMy($this->request->all(), $id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('profile_not_updated')]);
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
				if(!empty($formData['payout_email']) && !empty($formData['street_1']) && !empty($formData['city']) && !empty($formData['state']) && !empty($formData['country_id'])){
					$formData['is_complete_profile'] = 1;
				}else{
					$formData['is_complete_profile'] = 0;
				}
				
				$user  = $data->update($formData);
				
				if($user){
					if(!empty($formData['uniq_username']) and ($uniq_username_old != $formData['uniq_username'])){
						changeuniqusername($uniq_username_old, $formData['uniq_username']);
					}
					$u_prefix = "";
					if(Auth::User()->role_id == 1){
						$u_prefix  =  env('ADMIN_PREFIX');
					}
					return response()->json(['type' => 'success', 'url'=> url($u_prefix, Auth::User()->uniq_username), 'message' => getLabels('profile_updated_successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url($u_prefix, Auth::User()->uniq_username), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		$total_followers  = Follower::where('user_id', Auth::id())->orWhere('to_user_id', Auth::id())->count();
		return view('frontend/users/update_profile', compact('data', 'id', 'countries', 'page_title', 'total_followers', $total_followers));
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
	
	
	
	public function follow_user($uniq_username = null){
		$data =  User::where('uniq_username', $uniq_username)->where('status', 1)->first();
		if($data){ 
			$is_existing  = Follower::where(function($query) use($data){
                $query->where('user_id', $data->id)->where('to_user_id', Auth::id());
            })->orWhere(function($query2) use($data){
                $query2->where('to_user_id', $data->id)->where('user_id', Auth::id());
            })->count();
			if($is_existing == 0){
				Follower::create(['user_id' => Auth::id(), 'to_user_id' => $data->id]);
				$messageNoti  = str_replace(array('{USER}'), array(Auth::User()->first_name." ".Auth::User()->last_name), getLabels('start_following_you'));
				//$messageNoti  = Auth::User()->first_name." ".Auth::User()->last_name.' start following you';
				$notification = Notification::createNotifications(Auth::User()->uniq_username, $uniq_username, $messageNoti, 16, 0);
				
				$html = '<div class="dropdown d-inline-block">
							<button class="btn btn-xs btn-outline-primary dropdown-toggle mb-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Following
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item unfollow_user" rel="'.$data->uniq_username.'" href="javascript:void(0);">'.getLabels('unfollow').'</a>
							</div>
						</div>';
						
				return json_encode(['type' => 'success', 'html' => $html, 'notification' => $notification]);
			}
		}
	}
	
	
	
	
	public function unfollow_user($uniq_username = null){
		$data =  User::where('uniq_username', $uniq_username)->where('status', 1)->first();
		if($data){ 
			$is_existing  = Follower::where(function($query) use($data){
                $query->where('user_id', $data->id)->where('to_user_id', Auth::id());
            })->orWhere(function($query2) use($data){
                $query2->where('to_user_id', $data->id)->where('user_id', Auth::id());
            })->count();
			if($is_existing > 0){
				Follower::where('user_id', Auth::id())->where('to_user_id', $data->id)->delete();
				Follower::where('to_user_id', Auth::id())->where('user_id', $data->id)->delete();
				$html = '<button type="button" class="btn btn-xs btn-outline-primary follow_btn" rel="'.$uniq_username.'">'.getLabels('follow').'</button>';
				return json_encode(['type' => 'success', 'html' => $html]);
			}
		}
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

	
	public function subscription_plans(){
		$page_title = "Subscription Plans";
		$data = Plans::sortable();
		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}

		$data  = $data->orderBy('id', 'asc')->paginate(config('constants.PAGINATION'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}

		return view("/frontend/departments/subscription_plans",compact('page_title','data'));
	}

	public function subscription_plan_update($id = null){
		$url_prefix = ($this->request->route()->getPrefix() == env('ADMIN_PREFIX'))?env('ADMIN_PREFIX').'/':'';
		$page_title = "Subscription Plan Update";
		$data = Plans::find($id);
		if($this->request->isMethod('post')){
			$inputs = $this->request->all();
			$update = $data->update($inputs);
			if($update){
				return response()->json(array("type" => "success", "url" => url($url_prefix.'subscription-plans'), "message" => getLabels('update_subscription-plan_successfully')));
			}
		}
		return view('frontend/departments/subscription_plan_update',compact('page_title','data','id'));
	}

	public function perspective_update($id = null){
		$url_prefix = ($this->request->route()->getPrefix() == env('ADMIN_PREFIX'))?env('ADMIN_PREFIX').'/':'';
		$page_title = "Perspective Update";
		$data = Perspective::find($id);
		if($this->request->isMethod('post')){
			$inputs = $this->request->all();
			$update = $data->update($inputs);
			if($update){
				return response()->json(array("type" => "success", "url" => url($url_prefix.'perspective'), "message" => getLabels('update_perspective_successfully')));
			}
		}
		return view('frontend/departments/perspective_update',compact('page_title','data','id'));
	}
	public function perspective_add(){
		$url_prefix = ($this->request->route()->getPrefix() == env('ADMIN_PREFIX'))?env('ADMIN_PREFIX').'/':'';
		$page_title = "Add Perspective";
		if($this->request->isMethod('post')){
			$validator = Perspective::validate($this->request->all());
			if($validator->fails()){
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('please_correct_errors')]);
			}else{
				$inputs = $this->request->all();
				$add = Perspective::create($inputs);
				if($add){
					return response()->json(array("type" => "success", "url" => url($url_prefix.'perspective'), "message" => getLabels('add_perspective_successfully')));
				}
			}
			
		}
		return view('frontend/departments/perspective_add',compact('page_title'));
	}

	public function perspective(){
		$page_title = "Perspective";
		$data = Perspective::sortable()->whereNull('company_id');

		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}

		$data  = $data->orderBy('id', 'desc')->paginate(config('constants.PAGINATION'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		} 
		return view('frontend/departments/perspective',compact('page_title','data'));
	}

	public function roadmap(){
		$page_title = "Road Map";
		$objective_data = Objective::with('subObjectives','getMeasures','getInitiatives')->leftjoin('al_goal_cycles','al_goal_cycles.id','=','al_objectives.cycle_id')->where('al_objectives.company_id',Auth::User()->company_id)->whereNull('al_objectives.objective_id')->select('al_objectives.*','al_goal_cycles.cycle_name')->get();
		//echo "<pre>"; print_r($objective_data); die;
		$jsonData = array();
		$i=1;
		foreach($objective_data as $dkey => $dvalue){
			$jsonData[] = array('id'=>$i,'name'=>$dvalue->heading,'title'=>'Objective','description'=>$dvalue->summary,'period'=>$dvalue->cycle_name,'img'=>"{!!url('public/img/75.png')!!}");
			$j=$i;
			$i++;	
				
			foreach($dvalue->subObjectives as $sdkey => $sdvalue){
				$jsonData[] = array('id'=>$i,'pid'=>$j,'name'=>$sdvalue->heading,'title'=>'Sub Objective','description'=>$sdvalue->summary,'period'=>$sdvalue->cycle_name,'img'=>"{!!url('public/img/75.png')!!}");
				$k = $i;
				$i++;			
				foreach($sdvalue->subObjectives as $sd1key => $sd1value){
					$jsonData[] = array('id'=>$i,'pid'=>$k,'name'=>$sd1value->heading,'title'=>'Sub Objective','description'=>$sd1value->summary,'period'=>$sd1value->cycle_name,'img'=>"{!!url('public/img/75.png')!!}");
					$n = $i;
					$i++;			
					foreach($sd1value->getMeasures as $sdtkey => $sdtvalue){
						$jsonData[] = array('id'=>$i,'pid'=>$n,'name'=>$sdtvalue->heading,'title'=>'Measure','description'=>$sdtvalue->summary,'period'=>'','img'=>"{!!url('public/img/75.png')!!}");
						$p = $i;
						$i++;
					}
					foreach($sd1value->getInitiatives as $sdtkey => $sdtvalue){
						$jsonData[] = array('id'=>$i,'pid'=>$n,'name'=>$sdtvalue->heading,'title'=>'Initiative','description'=>$sdtvalue->summary,'period'=>'','img'=>"{!!url('public/img/75.png')!!}");
						$q = $i;
						$i++;
					}
				}
				foreach($sdvalue->getMeasures as $sdtkey => $sdtvalue){
					$jsonData[] = array('id'=>$i,'pid'=>$k,'name'=>$sdtvalue->heading,'title'=>'Measure','description'=>$sdtvalue->summary,'period'=>'','img'=>"{!!url('public/img/75.png')!!}");
					$l = $i;
					$i++;
				}
				foreach($sdvalue->getInitiatives as $sdtkey => $sdtvalue){
					$jsonData[] = array('id'=>$i,'pid'=>$k,'name'=>$sdtvalue->heading,'title'=>'Measure','description'=>$sdtvalue->summary,'period'=>'','img'=>"{!!url('public/img/75.png')!!}");
					$m = $i;
					$i++;
				}
			}
			foreach($dvalue->getMeasures as $dtkey => $dtvalue){
				$jsonData[] = array('id'=>$i,'pid'=>$j,'name'=>$dtvalue->heading,'title'=>'Measure','description'=>$dtvalue->summary,'period'=>'','img'=>"{!!url('public/img/75.png')!!}");
				$n = $i;
				$i++;
			}
			foreach($dvalue->getInitiatives as $dtkey => $dtvalue){
				$jsonData[] = array('id'=>$i,'pid'=>$j,'name'=>$dtvalue->heading,'title'=>'Measure','description'=>$dtvalue->summary,'period'=>'','img'=>"{!!url('public/img/75.png')!!}");
				$o = $i;
				$i++;
			}
		}
		$jsonData = json_encode($jsonData);
		//echo "<pre>"; print_r($jsonData); die;
		//$jsonData = '{"id":1,"tags":["Company"]},{"id":2,"tags":["Company"]},{"id":3,"tags":["Company"]}';
		/*$jsonData = '{ "id": 1, "name": "Sales Objective", "title": "In Progress","description": "Sales Target for FY-2020", "period": "FY 2020", "img": "{!!url('public/img/40.png')!!}" },
            { id: 2, pid: 1, name: "H1 Sales", title: "On Track",description: "Sales Target for H1 FY-2020", period: "H1 FY 2020", img: "{!!url('public/img/75.png')!!}" },
            { id: 3, pid: 1, name: "H2 Sales", title: "Out Of Track",description: "Sales Target for H2 FY-2020", period: "H2 FY 2020", img: "{!!url('public/img/32.png')!!}" },
            { id: 4, pid: 2, name: "Q1 Sales", title: "On Track",description: "Sales Target for Q1 FY-2020", period: "Q1 FY 2020", img: "{!!url('public/img/64.png')!!}" },
            { id: 5, pid: 2, name: "Q2 Sales", title: "On Track", description: "Sales Target for Q2 FY-2020", period: "Q2 FY 2020",img: "{!!url('public/img/40.png')!!}" },
            { id: 6, pid: 3, name: "Q3 Sales", title: "Out Of Track", description: "Sales Target for Q3 FY-2020", period: "Q3 FY 2020",img: "{!!url('public/img/32.png')!!}" },
            { id: 7, pid: 3, name: "Q4 Sales", title: "Out Of Track", description: "Sales Target for Q4 FY-2020", period: "Q4 FY 2020",img: "{!!('public/img/32.png')!!}" }';*/
           
		return view("/frontend/departments/roadmap",compact('page_title','objective_data','jsonData'));
	}
	public function timemap(){
		$page_title = "Time Map";
		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}
		$cycle_id ='';
		$department_id ='';
		$owner_id ='';
		$perspective_id ='';
		$theme_id ='';
		
		if(! empty($_POST)){
			if(isset($_POST['cycle_id']) and $_POST['cycle_id'] !=0){
				$cycle_id = $_POST['cycle_id'];
				$this->request->session()->put('usearch.cycle_id', $cycle_id);
			}
			if(isset($_POST['department_id']) and $_POST['department_id'] !=0){
				$department_id = $_POST['department_id'];
				$this->request->session()->put('usearch.department_id', $department_id);
			}
			if(isset($_POST['owner_id']) and $_POST['owner_id'] !=0){
				$owner_id = $_POST['owner_id'];
				$this->request->session()->put('usearch.owner_id', $owner_id);
			}
			if(isset($_POST['perspective_id']) and $_POST['perspective_id'] !=0){
				$perspective_id = $_POST['perspective_id'];
				$this->request->session()->put('usearch.perspective_id', $perspective_id);
			}
			if(isset($_POST['theme_id']) and $_POST['theme_id'] !=0){
				$theme_id = $_POST['theme_id'];
				$this->request->session()->put('usearch.theme_id', $theme_id);
			}
			
		}else{
			$this->request->session()->forget('usearch');
		}
		$al_goal_cycles = GoalCycles::where('company_id',Auth::User()->company_id)->where('status',1)->pluck('cycle_name','id')->toArray();
		$al_themes = Theme::where('company_id',Auth::User()->company_id)->where('status',1)->pluck('theme_name','id')->toArray();
		$all_perspective = Perspective::where('status',1)->where('company_id',Auth::User()->company_id)->pluck('name','id')->toArray();
		$all_department = Department::where('company_id',Auth::User()->company_id)->where('status',1)->pluck('department_name','id')->toArray();
		$all_users = User::select(DB::Raw('CONCAT(COALESCE(`first_name`,"")," ",COALESCE(`last_name`,"")) as full_name'),'id')->where('company_id',Auth::User()->company_id)->where('status',1)->get()->pluck('full_name','id')->toArray();
		
		
		//echo "<pre>"; print_r($all_department); die;
		if(!empty($cycle_id)){
			$GoalCycles = GoalCycles::where('company_id',Auth::User()->company_id)->where('id',$cycle_id)->where('status',1)->get();
		}else{
			$GoalCycles = GoalCycles::where('company_id',Auth::User()->company_id)->where('status',1)->get();
		
		}
		
		//echo "<pre>"; print_r(Auth::User()); die;
		$timemap_data = array();
		foreach($GoalCycles as $val){
			$data = Objective::with('getMeasures','getInitiatives')->leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->leftjoin('al_goal_cycles','al_goal_cycles.id','=','al_objectives.cycle_id')->where('al_objectives.cycle_id',$val->id);
			if(!empty($perspective_id)){
				$data = $data->where('al_objectives.perspective_id',$perspective_id);
			}
			if(!empty($theme_id)){
				$data = $data->where('al_objectives.theme_id',$theme_id);
			}
			if(!empty($department_id)){
				$data = $data->where('al_objectives.department_id',$department_id);
			}
			if(!empty($owner_id)){
				$data = $data->where('al_objectives.owner_user_id',$owner_id);
			}
			$timemap_data[] = $data->where('al_objectives.company_id',Auth::User()->company_id)->select('al_objectives.*','al_master_status.bg_color','al_master_status.icons','al_master_status.name as status_name','al_goal_cycles.cycle_name')->get();
		
		}
		
		return view("/frontend/departments/timemap",compact('page_title','timemap_data','al_goal_cycles','all_perspective','al_themes','all_department','all_users'));
	}
	public function departmental(){
		$page_title = "Departmental View";
		
		$department_data = Department::with('subDepartments','getTeams')->where('company_id',Auth::User()->company_id)->whereNull('parent_department_id')->where('status',1)->get();
		//echo "<pre>"; print_r($department_data); die;
		$jsonData = array();
		$i=1;
		foreach($department_data as $dkey => $dvalue){
			$jsonData[] = array('id'=>$i,'tags'=>array('Company'),'name'=>$dvalue->department_name,'smallName'=>'Department');
			$j=$i;
			$i++;	
				
			foreach($dvalue->subDepartments as $sdkey => $sdvalue){
				$jsonData[] = array('id'=>$i,'pid'=>$j,'tags'=>array('Company'),'name'=>$sdvalue->department_name,'smallName'=>'Department');
				$k = $i;
				$i++;			
				foreach($sdvalue->subDepartments as $sd1key => $sd1value){
					$jsonData[] = array('id'=>$i,'pid'=>$k,'tags'=>array('Company'),'name'=>$sd1value->department_name,'smallName'=>'Department');
					$n = $i;
					$i++;			
					foreach($sd1value->getTeams as $sdtkey => $sdtvalue){
						$jsonData[] = array('id'=>$i,'pid'=>$n,'tags'=>array('Department'),'name'=>$sdtvalue->team_name,'smallName'=>'Team');
						$o = $i;
						$i++;
						foreach($sdtvalue->getTeamMembers as $sdtmkey => $sdtmvalue){
							$jsonData[] = array('id'=>$i,'pid'=>$o,'tags'=>array('Staff'),'name'=>$sdtmvalue->first_name .' '.$sdtmvalue->last_name,'smallName'=>'Member');
							$i++;			
						}
					}
				}
				foreach($sdvalue->getTeams as $sdtkey => $sdtvalue){
					$jsonData[] = array('id'=>$i,'pid'=>$k,'tags'=>array('Department'),'name'=>$sdtvalue->team_name,'smallName'=>'Team');
					$l = $i;
					$i++;
					foreach($sdtvalue->getTeamMembers as $sdtmkey => $sdtmvalue){
						$jsonData[] = array('id'=>$i,'pid'=>$l,'tags'=>array('Staff'),'name'=>$sdtmvalue->first_name .' '.$sdtmvalue->last_name,'smallName'=>'Member');
						$i++;			
					}
				}
			}
			foreach($dvalue->getTeams as $dtkey => $dtvalue){
				$jsonData[] = array('id'=>$i,'pid'=>$j,'tags'=>array('Department'),'name'=>$dtvalue->team_name,'smallName'=>'Team');
				$m = $i;
				$i++;
				foreach($dtvalue->getTeamMembers as $sdtmkey => $sdtmvalue){
					$jsonData[] = array('id'=>$i,'pid'=>$m,'tags'=>array('Staff'),'name'=>$sdtmvalue->first_name .' '.$sdtmvalue->last_name,'smallName'=>'Member');
					$i++;			
				}
			}
		}
		$jsonData = json_encode($jsonData);
		//echo "<pre>"; print_r($jsonData); die;
		//$jsonData = '{"id":1,"tags":["Company"]},{"id":2,"tags":["Company"]},{"id":3,"tags":["Company"]}';
		/*$jsonData = '{ id: 1, tags: ["Company"] },
            { id: 2, pid: 1, tags: ["Department"], name: "Develepment Department" },
            { id: 3, pid: 1, tags: ["Department"], name: "QA Department" },
            { id: 4, pid: 1, tags: ["Department"], name: "Marketing Department" },
            { id: 5, pid: 2, tags: ["Staff"], name: "Elliot Ross" },
            { id: 6, pid: 2, tags: ["Staff"], name: "Anahi Gordon" }';*/
           
		return view("/frontend/departments/departmental",compact('page_title','department_data','jsonData'));
	}
	
	public function invoice(){
		$page_title = "Invoice";
		return view("/frontend/departments/invoice",compact('page_title'));
	}
	
	public function supports(){
		$page_title = "Supports";
		return view("/frontend/departments/supports",compact('page_title'));
	}public function notifications(){
		$page_title = "Notifications";
		return view("/frontend/departments/notifications",compact('page_title'));
	}
	public function addDepartmentForm(){
		$all_members = User::select(DB::raw('CONCAT_WS(" ",first_name,last_name) as full_name'),'id')->where('company_id',Auth::User()->company_id)->pluck('full_name','id');
		$departments = Department::where('status',1)->pluck("department_name","id");
		//pr($departments);
		
		return view('Element/department/add_department',compact('all_members','departments'));
	}

	
	public function department_remove($id = null){
		$data			 = Department::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url('department'), "message" => getLabels('department_removed'));
		}else{
			$results = array("type" => "error", "url" => url('department'), "message" => getLabels('department_not_removed'));
		}
		return json_encode($results);
	}
	public function perspective_remove($id = null){
		$data			 = Perspective::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX').'/perspective'), "message" => getLabels('perspective_removed'));
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX').'/perspective'), "message" => getLabels('perspective_not_removed'));
		}
		return json_encode($results);
	}

	public function getdepartments(){
		$inputs = $this->request->all();
		$departments = Department::where('company_id',$inputs['company_id'])->pluck('department_name','id');
		return json_encode($departments);
	}

	public function transactions(){
		$page_title = "Transactions";
		$data = Subscription::sortable()->leftjoin('al_companies','al_companies.id','=','al_comp_subscriptions.company_id');

		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}

		$data  = $data->select('al_comp_subscriptions.*','al_companies.company_name')->orderBy('al_companies.id', 'desc')->paginate(config('constants.PAGINATION'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}

		return view("/frontend/departments/transactions",compact('page_title','data'));
	}

	public function subscription(){
		$page_title = "Subscription";
		$PlansYearly = Plans::where('period',2)->orderBy('id','asc')->get();
		$PlansMonthly = Plans::where('period',1)->orderBy('id','asc')->get();
		return view('frontend/departments/subscription',compact('page_title','PlansMonthly','PlansYearly'));
	}

	public function upgrade_membership(){
		$inputs = $this->request->all();
		$token = $inputs['stripeToken'];
		$email = $inputs['stripeEmail'];
		$plan_id = $inputs['plan_id'];
		$plan_detail = Plans::where('plan_id',$plan_id)->first();
		$trial_end = strtotime(Auth::User()->trial_expiry_date);
		$subscription_details = stripeSubscription($token,$email,$plan_id);
		$update_user = array();
		$update_user['enable_subscription'] = 1;
		$update_user['current_membership_plan'] = $plan_detail->id;
		$update_user['stripe_customer_id'] = $subscription_details['customer_id'];
		$update_user['trial_expiry_date'] = date('Y-m-d',$subscription_details['subscription']['current_period_end']);
		$update = User::where('id',Auth::User()->id)->update($update_user);
		$cupdate = Company::where('id',Auth::User()->company_id)->update(array('plan_id'=>$plan_detail->id));
		$subscriptionarray = array();
		$subscriptionarray['user_id'] = Auth::User()->id;
		$subscriptionarray['company_id'] = Auth::User()->company_id;
		$subscriptionarray['emp_limit'] = $plan_detail->emp_limit;
		$subscriptionarray['heading'] = $plan_detail->heading;
		$subscriptionarray['plan_fee'] = $subscription_details['subscription']['items']['data'][0]['plan']['amount']/100;
		$subscriptionarray['total_stripe_payment'] = $subscription_details['subscription']['items']['data'][0]['plan']['amount']/100;
		$subscriptionarray['period'] = $plan_detail->period;
		$subscriptionarray['stripe_subscription_id'] = $subscription_details['subscription']->id;
		$subscriptionarray['stripe_plan_id'] = $plan_id;
		$subscriptionarray['plan_id'] = $plan_detail->id;
		$subscriptionarray['start_date'] = $subscription_details['subscription']->current_period_start;
		$subscriptionarray['end_date'] = $subscription_details['subscription']->current_period_end;
		$subscriptionarray['stripe_status'] = $subscription_details['subscription']->status;
		$createSubscription = Subscription::create($subscriptionarray);
		return redirect()->back()->with('message','Membership Plan Upgrade Successfully');
	}

	public function scorecardlist(){
		$page_title = "Scorecards";
		$data  = Scorecard::sortable()->where('company_id',Auth::User()->company_id);
		
		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}
		
		
		if(! empty($_POST)){
			if(isset($_POST['name']) and $_POST['name'] !=''){
				$name = $_POST['name'];
				$this->request->session()->put('usearch.name', $name);
				$data = $data->whereRaw('al_comp_scorecard.name like ?', "%{$name}%");
			}
			
			if(isset($_POST['status']) and $_POST['status'] !=''){
				$status = $_POST['status'];
				$this->request->session()->put('usearch.status', $status);
				$data = $data->where('al_comp_scorecard.status', $status);
			}
		}else{
			$this->request->session()->forget('usearch');
		}
		
		
		$data  = $data->orderBy('id', 'desc')->paginate(config('constants.PAGINATION'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		return view('frontend/departments/scorecardlist',compact('page_title','data'));
	}

	public function scorecardadd(){
		$validator = Scorecard::validateadd($this->request->all());
		
		if ( $validator->fails() ) {
			return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('please_correct_errors')]);
		} else {
			$formData              	= $this->request->except('_token');
			$formData['company_id']	= Auth::User()->company_id;
			if(isset($formData['id']) && !empty($formData['id'])){
				$scorecard = Scorecard::where('id',$formData['id'])->update($formData);
				$message  = getLabels('update_scorecard_successfully');
			}else{
				$scorecard  = Scorecard::create($formData);
				$message  = getLabels('add_scorecard_successfully');
			}
			if($scorecard){
				return response()->json(['type' => 'success', 'url'=> url('scorecards'), 'message' => $message]);
			}else{
				return response()->json(['type' => 'error', 'url'=> url('scorecards'), 'message' => getLabels('something_wrong_try_again')]);
			}
		}
	}

	public function singlescorecard($id){
		$singlescorecard = Scorecard::where('id',$id)->first();
		return json_encode($singlescorecard);
	}

	public function themelist(){
		$page_title = "Themes";
		$data  = Theme::sortable()->where('company_id',Auth::User()->company_id);
		
		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}
		
		
		if(! empty($_POST)){
			if(isset($_POST['theme_name']) and $_POST['theme_name'] !=''){
				$theme_name = $_POST['theme_name'];
				$this->request->session()->put('usearch.theme_name', $theme_name);
				$data = $data->whereRaw('al_theme.theme_name like ?', "%{$theme_name}%");
			}
			
			if(isset($_POST['status']) and $_POST['status'] !=''){
				$status = $_POST['status'];
				$this->request->session()->put('usearch.status', $status);
				$data = $data->where('al_comp_scorecard.status', $status);
			}
		}else{
			$this->request->session()->forget('usearch');
		}
		
		
		$data  = $data->orderBy('id', 'desc')->paginate(config('constants.PAGINATION'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		return view('frontend/departments/themelist',compact('page_title','data'));
	}

	public function themeadd(){
		$validator = Theme::validateadd($this->request->all());
		
		if ( $validator->fails() ) {
			return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('please_correct_errors')]);
		} else {
			$formData              	= $this->request->except('_token');
			$formData['company_id']	= Auth::User()->company_id;
			if(isset($formData['id']) && !empty($formData['id'])){
				$theme = Theme::where('id',$formData['id'])->update($formData);
				$message  = getLabels('update_theme_successfully');
			}else{
				$theme  = Theme::create($formData);
				$message  = getLabels('add_theme_successfully');
			}
			if($theme){
				return response()->json(['type' => 'success', 'url'=> url('themes'), 'message' => $message]);
			}else{
				return response()->json(['type' => 'error', 'url'=> url('themes'), 'message' => getLabels('something_wrong_try_again')]);
			}
		}
	}

	public function singletheme($id){
		$singletheme = Theme::where('id',$id)->first();
		return json_encode($singletheme);
	}
}
