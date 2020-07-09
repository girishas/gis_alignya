<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Country;
use App\Models\Template;
use App\Models\Teams;
use App\Models\TeamsMembers;
use App\Models\Objective;
use App\Models\Post;
use App\Models\Notification;
use App\Models\Department;
use App\Models\SubscriptionPlan;

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
class TeamController extends Controller
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
	
	
	
	public function admin_index($id = null){
		$data  = Teams::where('company_id',Auth::User()->company_id)->get();
		if($id){
			$team_detail = Teams::leftjoin('users','users.id','=','al_comp_teams.team_head')->where('al_comp_teams.company_id',Auth::User()->company_id)->where('al_comp_teams.id',$id)->select('al_comp_teams.*','users.first_name as team_head_name','users.photo','users.designation','users.id as team_lead_id')->first();
			$team_members = TeamsMembers::leftjoin('users','users.id','=','al_teams_members.member_id')->where('al_teams_members.team_id',$id)->where('is_head',0)->select('users.id','users.photo','users.first_name','users.last_name','users.designation','users.id as team_lead_id')->get();
		}else{
			$team_detail = Teams::leftjoin('users','users.id','=','al_comp_teams.team_head')->where('users.company_id',Auth::User()->company_id)->select('al_comp_teams.*','users.first_name as team_head_name','users.photo','users.designation','users.id as team_lead_id')->first();
			if(!empty($team_detail)){
			$team_members = TeamsMembers::leftjoin('users','users.id','=','al_teams_members.member_id')->where('al_teams_members.team_id',$team_detail->id)->where('is_head',0)->select('users.id','users.photo','users.first_name','users.last_name','users.designation','users.photo','users.id as team_lead_id')->get();
			}
		}
		
		$team_members_pluck = TeamsMembers::leftjoin('users','users.id','=','al_teams_members.member_id')->where('al_teams_members.team_id',$id)->where('is_head',0)->select('users.id','users.photo','users.first_name','users.last_name','users.designation')->pluck('users.id','users.first_name');
		$teamleads = User::where('role_id',4)->where('company_id',Auth::User()->company_id)->pluck('first_name','id');
		$all_members = User::select(DB::raw('CONCAT_WS(" ",first_name,last_name) as full_name'),'id')->where('company_id',Auth::User()->company_id)->where('role_id',5)->pluck('full_name','id');
		$departments = Department::where('company_id',Auth::User()->company_id)->pluck('department_name','id');
		$page_title  = getLabels("Teams");

		if($this->request->isMethod('post')){
			$validator = Teams::validate($this->request->all());
			
			if ( $validator->fails() ) {
				return redirect()->back()->with('errormessageadd',getLabels('team_not_saved_errors'))->withErrors($validator->errors());
			} else {
				$size = 0;
				$formData = $this->request->except('member_ids');
				$formData['status'] = 1;
				$formData['company_id'] = Auth::User()->company_id;
				if($id){
					$u_data = Teams::find($id);
					$updateteam = $u_data->update($formData);
					$message = "Update Team Successfully";
				}else{
					$addteam = Teams::create($formData);
					$message = "Add Team Successfully";
				}
				if($this->request->get('member_ids')){
					if($id){
						$prev_members = TeamsMembers::where('team_id',$id)->where('is_head',0)->get();
						if(!empty($prev_members)){
							$deleteteam = TeamsMembers::where('team_id',$id)->where('is_head',0)->delete();
						}
					}
					$member_ids = $this->request->get('member_ids');
					
					foreach ($member_ids as $key => $value) {
						$teammembers = array();
						$teammembers['member_id'] = $value;
						if($id){
							$teammembers['team_id'] = $id;
						}else{
							$teammembers['team_id'] = $addteam->id;
						}
						$teammembers['is_head'] = 0;
						TeamsMembers::create($teammembers);
						$size++;
					}
				}
				if($this->request->get('team_head')){
					if($id){
						$prev_members = TeamsMembers::where('team_id',$id)->where('is_head',1)->get();
						if(!empty($prev_members)){
							$deletedepartment = TeamsMembers::where('team_id',$id)->where('is_head',1)->delete();
						}
					}
					$teammembers = array();
					$teammembers['member_id'] = $this->request->get('team_head');
					if($id){
						$teammembers['team_id'] = $id;
					}else{
						$teammembers['team_id'] = $addteam->id;
					}
					$teammembers['is_head'] = 1;
					TeamsMembers::create($teammembers);
					$size = $size+1;
				}
				if($id){
					$u_data = Teams::find($id);
					$updateteam = $u_data->update(array('size'=>$size));
				}else{
					$u_data = Teams::find($addteam->id);
					$updateteam = $u_data->update(array('size'=>$size));
				}
			}
			return redirect()->back()->with('message',$message);
		}
		if(isset($team_detail)){
			$objectives = Objective::where('owner_user_id',$team_detail->team_lead_id)->get();
		}else{
			$objectives = array();
		}

		return view('frontend/teams/team', compact('data','page_title','teamleads','all_members','departments','team_detail','team_members','id','team_members_pluck','objectives'));
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
	
	
	
	
	public function admin_add(){
		
		$data = array();
		
		$page_title = getLabels("Add New Team");
		$members  = User::select(DB::raw("CONCAT_WS(', ',first_name,designation) AS name"),'id')->where('role_id', 2)->orderBy('id', 'desc')->pluck('name', 'id')->toArray();
		if($this->request->isMethod('post')){
			$validator = Teams::validate($this->request->all());
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('team_not_saved_errors')]);
			} else {
				$formData              	= $this->request->except('team_members');
				$members_id = $this->request->get('team_members');
				$formData['size'] = count($members_id);
				
				$formData['status']	= 1;
				$teams  = Teams::create($formData);
				if(count($members_id) > 0){
					$member_arr = array();
					foreach ($members_id as $key => $value) {
						$member_arr['team_id'] = $teams->id;
						$member_arr['member_id'] = $value;
						$member_arr['is_head'] = 0;
						TeamsMembers::create($member_arr);
					}
				}
				if($this->request->get('team_head')){
					$member_arr = array();
					$member_arr['team_id'] = $teams->id;
					$member_arr['member_id'] = $this->request->get('team_head');
					$member_arr['is_head'] = 1;
					TeamsMembers::create($member_arr);
					
				}
				if($teams){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'teams'), 'message' => getLabels('Team Saved Successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'teams'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/teams/admin_add', compact('data', 'members', 'page_title'));
	}
	
	
	
	public function admin_edit($id = null){ 
		
		$data   = Teams::find($id);
		$page_title = getLabels("Update Team");
		if($this->request->isMethod('post')){
			$validator = Teams::validate($this->request->all(), $id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('team_not_saved_errors')]);
			} else {
				$formData = $this->request->except('team_members');
				$members_id = $this->request->get('team_members');
				$formData['size'] = count($members_id);
				$teams  = $data->update($formData);
				if(count($members_id) > 0){
					$delete = TeamsMembers::where('team_id',$id)->where('is_head',0)->delete();
					$member_arr = array();
					foreach ($members_id as $key => $value) {
						$member_arr['team_id'] = $id;
						$member_arr['member_id'] = $value;
						$member_arr['is_head'] = 0;
						TeamsMembers::create($member_arr);
					}
				}
				if($this->request->get('team_head')){
					$delete = TeamsMembers::where('team_id',$id)->where('is_head',1)->delete();
					$member_arr = array();
					$member_arr['team_id'] = $id;
					$member_arr['member_id'] = $this->request->get('team_head');
					$member_arr['is_head'] = 1;
					TeamsMembers::create($member_arr);
					
				}
				if($teams){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'teams'), 'message' => getLabels('Team Update Successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'teams'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		$members  = User::select(DB::raw("CONCAT_WS(', ',first_name,designation) AS name"),'id')->where('role_id', 2)->orderBy('id', 'desc')->pluck('name', 'id')->toArray();
		$selected_members = TeamsMembers::where('team_id',$id)->where('is_head',0)->pluck('member_id','id');
		if(!empty($selected_members)){
			$selected_members = $selected_members->toArray();
		}
		return view('frontend/teams/admin_edit', compact('data', 'id', 'members', 'page_title','selected_members'));
	}
	
	
	
	
	public function profile($username = null){
	
		$data  = DB::table('users')->leftjoin('countries', 'countries.id', '=', 'users.country_id')->where('users.uniq_username', $username)->where('users.status', 1)->first(array('users.*', 'countries.name as country_name'));
		$page_title = $data->first_name." ".$data->last_name;
		
		$following   = Follower::leftjoin('users', 'users.id', '=', 'followers.to_user_id')->where('followers.user_id', $data->id)->where('users.status', 1)->orderBy("first_name", "ASC")->select('users.*', 'followers.to_user_id')->paginate(config('constants.PAGINATION_FOLLOWERS', ['*'], 'fipage'));
		
		$followers   = Follower::leftjoin('users', 'users.id', '=', 'followers.user_id')->where('followers.to_user_id', $data->id)->where('users.status', 1)->orderBy("first_name", "ASC")->select('users.*', 'followers.user_id')->paginate(config('constants.PAGINATION_FOLLOWERS'), ['*'], 'fpage');
		//$followers->setPageName('fpage');
		$my_following  = $my_followers = array();
		if(Auth::check()){
			$my_following  = Follower::where('user_id', Auth::id())->pluck('to_user_id')->toArray();
			$my_followers   = Follower::where('to_user_id', Auth::id())->pluck('user_id')->toArray();
		}
		
		$myfollowers = array_merge($my_following, $my_followers);
		
		$posts = Post::with(['postUser', 'postFiles', 'postLike', 'postComments'])->where("posts.user_id", $data->id)->orderBy('created_at', 'DESC')->paginate(2)->map(function ($query) {
            $query->setRelation('postComments', $query->postComments->take(config('constants.PAGINATION_COMMENTS')));
            return $query;
        });

		
		if ($this->request->ajax() and isset($_GET['fpage'])) {
			$view = view('Element/users/followers',compact('followers'))->render();
            return response()->json(['html'=>$view, 'total_page' => $followers->lastPage()]);
        }
		
		if ($this->request->ajax() and isset($_GET['fipage'])) {
			//return response()->json(['html'=>$following->currentPage()]);
			$view = view('Element/users/following',compact('following'))->render();
            return response()->json(['html'=>$view, 'total_page' => $following->lastPage()]);
        }
		
		if ($this->request->ajax() and isset($_GET['page'])) {
    		$view = view('frontend/posts/post_mid',compact('posts'))->render();
            return response()->json(['html'=>$view]);
        }
		
		
		$myfollowers[] = Auth::id();
		$myfollowers = array_unique($myfollowers);
		
		
		/* Uncomment the code if Follwing and Followers will be on One page
		
		$following  = Follower::leftjoin('users', 'users.id', '=', 'followers.to_user_id')->where('followers.user_id', Auth::id())->where('users.status', 1)->select(DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS userfullname"), "followers.to_user_id")->pluck('userfullname', 'followers.to_user_id')->toArray();
		$follower   = Follower::leftjoin('users', 'users.id', '=', 'followers.user_id')->where('followers.to_user_id', Auth::id())->where('users.status', 1)->select(DB::raw("CONCAT(users.first_name, ' ', users.last_name) AS userfullname"), "followers.user_id")->pluck('userfullname', 'followers.user_id')->toArray();
		
		$followArr  = $following + $follower;
		
		asort($followArr);
		$orders = array_keys($followArr);
		$orderBy  = implode(", ", $orders);
	
		$dataFollower  = User::where('users.status', 1)->whereIn('users.id', $orders)->leftjoin('countries', 'countries.id', '=', 'users.country_id');
		$dataFollower  = $dataFollower->select('users.*', 'countries.name as country')->orderByRaw('FIELD(users.id,'.$orderBy.')')->paginate(config('constants.PAGINATION')); */
		$plans = SubscriptionPlan::where('user_id', $data->id)->get();	
		if($plans){
			$plans = $plans->toArray();
		}
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
	
	public function reports(){
		$page_title = "Reports";
		return view('frontend/teams/reports',compact('page_title'));
	}
	public function ideas(){
		$page_title = "Ideas";
		return view('frontend/teams/ideas',compact('page_title'));
	}
	
	public function scorecard(){
		$page_title = "Scorecard";
		$financial = Objective::leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->where('al_objectives.perspective_id',1)->where('al_objectives.company_id',Auth::User()->company_id)->select('al_objectives.*','al_master_status.bg_color')->get();
		$customer = Objective::leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->where('al_objectives.perspective_id',2)->where('al_objectives.company_id',Auth::User()->company_id)->select('al_objectives.*','al_master_status.bg_color')->get();
		$process = Objective::leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->where('al_objectives.perspective_id',3)->where('al_objectives.company_id',Auth::User()->company_id)->select('al_objectives.*','al_master_status.bg_color')->get();
		$people = Objective::leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->where('al_objectives.perspective_id',4)->where('al_objectives.company_id',Auth::User()->company_id)->select('al_objectives.*','al_master_status.bg_color')->get();
		return view('frontend/teams/scorecard',compact('page_title','financial','customer','process','people'));
	}
	public function startegic_map(){
		$page_title = "Startegic Map";
		$financial = Objective::leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->where('al_objectives.perspective_id',1)->where('al_objectives.company_id',Auth::User()->company_id)->select('al_objectives.*','al_master_status.bg_color')->get();
		$customer = Objective::leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->where('al_objectives.perspective_id',2)->where('al_objectives.company_id',Auth::User()->company_id)->select('al_objectives.*','al_master_status.bg_color')->get();
		$process = Objective::leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->where('al_objectives.perspective_id',3)->where('al_objectives.company_id',Auth::User()->company_id)->select('al_objectives.*','al_master_status.bg_color')->get();
		$people = Objective::leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->where('al_objectives.perspective_id',4)->where('al_objectives.company_id',Auth::User()->company_id)->select('al_objectives.*','al_master_status.bg_color')->get();
		return view('frontend/teams/strategic_map',compact('page_title','financial','customer','process','people'));
	}

	public function add_teampopup(){
		return view('Element/team/add_team',compact('teamleads','members','departments'));
	}

	public function team_remove($id = null){
		$data			 = Teams::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url('team'), "message" => getLabels('team_removed'));
		}else{
			$results = array("type" => "error", "url" => url('team'), "message" => getLabels('team_not_removed'));
		}
		return json_encode($results);
	}

	public function getteams(){
		$inputs = $this->request->all();
		$teams = Teams::where('company_id',$inputs['company_id'])->pluck('team_name','id');
		return json_encode($teams);
	}

	public function getprojectinsightsobjective(){
		$input = $this->request->all();
		$objectives = Objective::whereRaw('FIND_IN_SET(?,contributers)',$input['id'])->orWhere('owner_user_id',$input['id'])->get();
		if(!empty($objectives))
		{
			$result = $objectives->toArray();
		}else{
			$result = array();
		}
		return json_encode($result);
		//return view('Element/team/projectinsightobjective',compact('objectives'));
	}
}
