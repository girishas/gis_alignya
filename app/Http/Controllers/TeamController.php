<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Country;
use App\Models\Template;
use App\Models\Teams;
use App\Models\TeamsMembers;
use App\Models\Objective;
use App\Models\GoalCycles;
use App\Models\Measure;
use App\Models\IdeaCategory;
use App\Models\IdeaComments;
use App\Models\Status;
use App\Models\Milestones;
use App\Models\Theme;
use App\Models\Ideas;
use App\Models\IdeaLikes;
use App\Models\Perspective;
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
		
		$team_members_pluck = TeamsMembers::select(DB::raw('CONCAT(IFNULL(users.first_name," ")," ",IFNULL(users.last_name," ")," (",al_users_role.role,")")) as first_name'),'users.id')->leftjoin('users','users.id','=','al_teams_members.member_id')->leftjoin('al_users_role','al_users_role.id','=','users.role_id')->where('al_teams_members.team_id',isset($team_detail->id) ? $team_detail->id:$id)->where('is_head',0)->select('users.id','users.photo','users.first_name','users.last_name','users.designation')->pluck('users.id','first_name');
		$teamleads = User::select(DB::raw('CONCAT(IFNULL(users.first_name," ")," ",IFNULL(users.last_name," ")," ( ",al_users_role.role," )") as first_name'),'users.id')->leftjoin('al_users_role','al_users_role.id','=','users.role_id')->where('users.company_id',Auth::User()->company_id)->pluck('users.first_name','users.id');
		$all_members = User::select(DB::raw('CONCAT(users.first_name," ",IFNULL(users.last_name,"")," ( ",al_users_role.role," )") as full_name'),'users.id')->leftjoin('al_users_role','al_users_role.id','=','users.role_id')->where('users.company_id',Auth::User()->company_id)->pluck('full_name','users.id');
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
						Objective::where('team_id',$id)->update(array('owner_user_id'=>$this->request->get('team_head')));
						Measure::where('measure_team_id',$id)->update(array('owner_user_id'=>$this->request->get('team_head')));
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
			$objectives = Objective::where('company_id',Auth::User()->company_id)->where('owner_user_id',$team_detail->team_lead_id)->get();
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
	
	public function reports($id=null){
		$page_title = "Reports";
		$objectives = Objective::where('company_id',Auth::User()->company_id)->orderBy('id','desc')->pluck('heading','id');
		if($id){
			$single_objective = Objective::select('al_objectives.*','al_master_status.bg_color','al_master_status.name as status_name','al_master_status.icons as status_icon','al_theme.theme_name')->leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->leftjoin('al_theme','al_theme.id','=','al_objectives.theme_id')->where('al_objectives.id',$id)->first();
			$measures = Measure::select('al_measures.*',DB::raw('CONCAT_WS(" ",first_name,last_name) as owner_name'))->leftjoin('users','users.id','=','al_measures.owner_user_id')->where('al_measures.category_type',1)->where('al_measures.objective_id',$id)->where('al_measures.company_id',Auth::User()->company_id)->orderBy('al_measures.id','desc')->get();
			if(!empty($measures)){
				$measures = $measures->toArray();
				foreach ($measures as $key => $value) {
					$measures[$key]['plucked_milestone'] = Milestones::where('company_id',Auth::User()->company_id)->where('measure_id',$value['id'])->orderBy('start_date','asc')->pluck('sys_target')->toArray();
					$measures[$key]['actual_graph_data'] = Milestones::where('company_id',Auth::User()->company_id)->where('measure_id',$value['id'])->orderBy('start_date','asc')->pluck('mile_actual')->toArray();
					$measures[$key]['graph_labels'] = Milestones::where('company_id',Auth::User()->company_id)->where('measure_id',$value['id'])->orderBy('start_date','asc')->pluck('milestone_name')->toArray();
					$measures[$key]['max_mile'] = Milestones::select(DB::raw('MAX(GREATEST(COALESCE(mile_actual,0),COALESCE(sys_target,0),COALESCE(projection_target,0))) as max_value'))->where('company_id',Auth::User()->company_id)->where('measure_id',$value['id'])->value('max_value');
					$measures[$key]['pojected_graph_data'] = Milestones::where('company_id',Auth::User()->company_id)->where('measure_id',$value['id'])->orderBy('start_date','asc')->pluck('projection_target')->toArray();
					$avg = Milestones::where('company_id',Auth::User()->company_id)->where('measure_id',$value['id'])->orderBy('start_date','asc')->avg('sys_progress');
					$measures[$key]['percent_complete'] = $avg;
					$total_milestone = Milestones::where('company_id',Auth::User()->company_id)->where('measure_id',$value['id'])->count();
					$measures[$key]['total_milestone'] = $total_milestone;
				}
			}
		}
		return view('frontend/teams/reports',compact('page_title','objectives','measures','id','single_objective'));
	}
	public function ideas(){
		$page_title = 'Ideas';
		$ideas = Ideas::select('al_ideas.*','al_master_status.name as status_name',DB::raw('CONCAT(users.first_name,IFNULL(users.last_name," ")) as created_by'))->leftjoin('al_master_status','al_master_status.id','=','al_ideas.status')->leftjoin('users','users.id','=','al_ideas.user_id')->where('al_ideas.company_id',Auth::User()->company_id);
		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}
		
		
		if(! empty($_POST)){
			if(isset($_POST['title']) and $_POST['title'] !=''){
				$title = $_POST['title'];
				$this->request->session()->put('usearch.title', $title);
				$ideas = $ideas->whereRaw('al_ideas.title like ?', "%{$title}%");
			}
			if(isset($_POST['category_id']) and $_POST['category_id'] !=''){
				$category_id = $_POST['category_id'];
				$this->request->session()->put('usearch.category_id', $category_id);
				$ideas = $ideas->where('al_ideas.category_id', $category_id);
			}
			if(isset($_POST['status']) and $_POST['status'] !=''){
				$status = $_POST['status'];
				$this->request->session()->put('usearch.status', $status);
				$ideas = $ideas->where('al_ideas.status', $status);
			}
		}else{
			$this->request->session()->forget('usearch');
		}
		$ideas = $ideas->orderBy('id','desc')->get();
		$departments = Department::where('company_id',Auth::User()->company_id)->pluck('department_name','id');
		$status = Status::where('is_idea',1)->where('status',1)->pluck('name','id');
		if(!empty($status)){
			$status = $status->toArray();
		}else{
			$status = array();
		}
		$categories = IdeaCategory::pluck('name','id');
		if(!empty($categories)){
			$categories = $categories->toArray();
		}else{
			$categories = array();
		}
		if(!empty($departments))
		{
			$departments = $departments->toArray();
		}else{
			$departments = array();
		}
		return view('frontend/teams/ideas',compact('page_title','departments','categories','status','ideas'));
	}
	
	public function scorecard(){
		$page_title = "Scorecard";
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
		//$data = array();
		if(! empty($_POST)){
			if(isset($_POST['cycle_id']) and $_POST['cycle_id'] !=0){
				$cycle_id = $_POST['cycle_id'];
				$this->request->session()->put('usearch.cycle_id', $cycle_id);
				// $data = $data->whereRaw('al_objectives.cycle_id like ?', "%{$cycle_id}%");
			}
			if(isset($_POST['department_id']) and $_POST['department_id'] !=0){
				$department_id = $_POST['department_id'];
				$this->request->session()->put('usearch.department_id', $department_id);
				// $data = $data->whereRaw('al_objectives.department_id like ?', "%{$department_id}%");
			}
			if(isset($_POST['owner_id']) and $_POST['owner_id'] !=0){
				$owner_id = $_POST['owner_id'];
				$this->request->session()->put('usearch.owner_id', $owner_id);
				// $data = $data->whereRaw('al_objectives.owner_id like ?', "%{$owner_id}%");
			}
			if(isset($_POST['perspective_id']) and $_POST['perspective_id'] !=0){
				$perspective_id = $_POST['perspective_id'];
				$this->request->session()->put('usearch.perspective_id', $perspective_id);
				// $data = $data->whereRaw('al_objectives.perspective_id like ?', "%{$perspective_id}%");
			}
			if(isset($_POST['theme_id']) and $_POST['theme_id'] !=0){
				$theme_id = $_POST['theme_id'];
				$this->request->session()->put('usearch.theme_id', $theme_id);
				// $data = $data->whereRaw('al_objectives.theme_id like ?', "%{$theme_id}%");
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
		if(!empty($perspective_id)){
			$perspective_data = Perspective::where('id',$perspective_id)->where('status',1)->get();
		}else{
			$perspective_data = Perspective::where('status',1)->where('company_id',Auth::User()->company_id)->get();
		}
		$scorecard_data = array();
		foreach($perspective_data as $val){
			 $data = Objective::with('getMeasures','getInitiatives')->leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->leftjoin('al_perspectives','al_perspectives.id','=','al_objectives.perspective_id')->where('al_objectives.perspective_id',$val->id);
			if(!empty($cycle_id)){
				$data = $data->where('al_objectives.cycle_id',$cycle_id);
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
			$scorecard_data[] = $data->where('al_objectives.company_id',Auth::User()->company_id)->select('al_objectives.*','al_master_status.bg_color','al_master_status.icons','al_master_status.name as status_name','al_perspectives.name as perspective_name')->get();
		
		}
		
		return view('frontend/teams/scorecard',compact('page_title','scorecard_data','al_goal_cycles','all_perspective','al_themes','all_department','all_users'));
	}
	public function startegic_map(){
		$page_title = "Startegic Map";
		
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
		
		if(!empty($perspective_id)){
			$perspective_data = Perspective::where('id',$perspective_id)->where('status',1)->get();
		}else{
			$perspective_data = Perspective::where('status',1)->where('company_id',Auth::User()->company_id)->get();
		}
		$strategic_data = array();
		foreach($perspective_data as $val){
			$data = Objective::with('getMeasures','getInitiatives')->leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->leftjoin('al_perspectives','al_perspectives.id','=','al_objectives.perspective_id')->where('al_objectives.perspective_id',$val->id);
			if(!empty($cycle_id)){
				$data = $data->where('al_objectives.cycle_id',$cycle_id);
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
			$strategic_data[] = $data->where('al_objectives.company_id',Auth::User()->company_id)->select('al_objectives.*','al_master_status.bg_color','al_master_status.icons','al_master_status.name as status_name','al_perspectives.name as perspective_name')->get();
		
		}
		$goal_cycles = GoalCycles::where('company_id',Auth::User()->company_id)->where('status',1)->pluck('cycle_name','id');
		$perspectives = Perspective::where('company_id',Auth::User()->company_id)->where('status',1)->pluck('name','id');

		$contributers = User::select(DB::raw('CONCAT(users.first_name," ",IFNULL(users.last_name," ")," (",al_users_role.role,")") as first_name'),'users.id')->leftjoin('al_users_role','al_users_role.id','=','users.role_id')->where('users.company_id',Auth::User()->company_id)->pluck('first_name','users.id');
		//pr($contributers);
		$departments = Department::where('company_id',Auth::User()->company_id)->pluck('department_name','id');
		$status = Status::where('is_obj',1)->pluck('name','id');
		$objectives = Objective::where('company_id',Auth::User()->company_id)->pluck('heading','id');
		return view('frontend/teams/strategic_map',compact('page_title','perspective_data','strategic_data','al_goal_cycles','all_perspective','al_themes','all_department','all_users','goal_cycles','perspectives','contributers','departments','status','objectives'));
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

	public function addidea(){
		$validator = Ideas::validate($this->request->all());
		
		if ( $validator->fails() ) {
			return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('please_correct_errors')]);
		} else {
			$formData              	= $this->request->except('_token');
			$formData['company_id']	= Auth::User()->company_id;
			$formData['user_id']	= Auth::User()->id;
			if(isset($formData['id']) && !empty($formData['id'])){
				$theme = Ideas::where('id',$formData['id'])->update($formData);
				$message  = getLabels('idea_updated_successfully');
				$url = url('idea-details/'.$formData['id']);
			}else{
				$theme  = Ideas::create($formData);
				$message  = getLabels('idea_add_successfully');
				$url = url('ideas');
			}
			if($theme){
				return response()->json(['type' => 'success', 'url'=> $url, 'message' => $message]);
			}else{
				return response()->json(['type' => 'error', 'url'=> url('ideas'), 'message' => getLabels('something_wrong_try_again')]);
			}
		}
	}

	public function idea_details($id=null){
		if($this->request->isMethod('post')){
			$validator = IdeaComments::validate($this->request->all());
			if($validator->fails()){
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('please_correct_errors')]);	
			}else{
				$addcomment = array();
				$addcomment['idea_id'] = $id;
				$addcomment['comments'] = $this->request->get('comments');
				$addcomment['user_id'] = Auth::User()->id;
				$add = IdeaComments::create($addcomment);
				return response()->json(array("type" => "success", "url" => url('idea-details/'.$id), "message" => getLabels('comment_saved_successfully')));
			}
		}
		$page_title = "Idea Detail";
		$idea_details = Ideas::select('al_ideas.*','al_idea_categories.name as category_name','al_comp_departments.department_name','al_master_status.name as status_name',DB::raw('CONCAT(users.first_name, " ", IFNULL(users.last_name," ")) as created_by'))->leftjoin('users','users.id','=','al_ideas.user_id')->leftjoin('al_idea_categories','al_idea_categories.id','=','al_ideas.category_id')->leftjoin('al_comp_departments','al_comp_departments.id','=','al_ideas.department_id')->leftjoin('al_master_status','al_master_status.id','=','al_ideas.status')->where('al_ideas.id',$id)->first();
		$comments = IdeaComments::select('al_idea_comments.*',DB::raw('CONCAT(users.first_name," ",IFNULL(users.last_name, " ")) as commented_by'))->leftjoin('users','users.id','=','al_idea_comments.user_id')->where('al_idea_comments.idea_id',$id)->orderBy('al_idea_comments.id','desc')->get();
		$popular_ideas = Ideas::where('company_id',Auth::User()->company_id)->where('is_popular',1)->get();
		$departments = Department::where('company_id',Auth::User()->company_id)->pluck('department_name','id');
		$status = Status::where('is_idea',1)->where('status',1)->pluck('name','id');
		if(!empty($status)){
			$status = $status->toArray();
		}else{
			$status = array();
		}
		$categories = IdeaCategory::pluck('name','id');
		if(!empty($categories)){
			$categories = $categories->toArray();
		}else{
			$categories = array();
		}
		if(!empty($departments))
		{
			$departments = $departments->toArray();
		}else{
			$departments = array();
		}
		return view('frontend/teams/ideas_details',compact('page_title','idea_details','comments','id','popular_ideas','departments','status','categories'));
	}

	public function idealike(){
		$input = $this->request->all();
		//pr($input);
		$input['user_id'] = Auth::User()->id;
		$check = IdeaLikes::where('user_id',Auth::User()->id)->where('idea_id',$this->request->get('idea_id'))->whereNull('idea_comment_id')->first();
		if(!empty($check)){
			if($check->is_like == 0){
				$ucheck = $check->update(array('is_like'=>1));
			}
		}else{
			$input['is_like'] = 1;
			$clike = IdeaLikes::create($input);
		}
		$data = array();
		$data['total_like'] = IdeaLikes::where('idea_id',$input['idea_id'])->where('is_like',1)->whereNull('idea_comment_id')->count();
		$data['total_dislike'] = IdeaLikes::where('idea_id',$input['idea_id'])->where('is_like',0)->whereNull('idea_comment_id')->count();
		return json_encode($data);
	}
	public function ideadislike(){
		$input = $this->request->all();
		$input['user_id'] = Auth::User()->id;
		$check = IdeaLikes::where('user_id',Auth::User()->id)->where('idea_id',$this->request->get('idea_id'))->whereNull('idea_comment_id')->first();
		if(!empty($check)){
			if($check->is_like == 1){
				$ucheck = $check->update(array('is_like'=>0));
			}
		}else{
			$input['is_like'] = 0;
			$clike = IdeaLikes::create($input);
		}
		$data = array();
		$data['total_like'] = IdeaLikes::where('idea_id',$input['idea_id'])->where('is_like',1)->whereNull('idea_comment_id')->count();
		$data['total_dislike'] = IdeaLikes::where('idea_id',$input['idea_id'])->where('is_like',0)->whereNull('idea_comment_id')->count();
		return json_encode($data);
	}

	public function ideacommentlike(){
		$input = $this->request->all();
		$input['user_id'] = Auth::User()->id;
		$check = IdeaLikes::where('user_id',Auth::User()->id)->where('idea_id',$this->request->get('idea_id'))->where('idea_comment_id',$this->request->get('idea_comment_id'))->first();
		if(!empty($check)){
			if($check->is_like == 0){
				$ucheck = $check->update(array('is_like'=>1));
			}
		}else{
			$input['is_like'] = 1;
			$clike = IdeaLikes::create($input);
		}
		$data = array();
		$data['total_like'] = IdeaLikes::where('idea_id',$input['idea_id'])->where('is_like',1)->where('idea_comment_id',$this->request->get('idea_comment_id'))->count();
		$data['total_dislike'] = IdeaLikes::where('idea_id',$input['idea_id'])->where('is_like',0)->where('idea_comment_id',$this->request->get('idea_comment_id'))->count();
		return json_encode($data);
	}
	public function ideacommentdislike(){
		$input = $this->request->all();
		$input['user_id'] = Auth::User()->id;
		$check = IdeaLikes::where('user_id',Auth::User()->id)->where('idea_id',$this->request->get('idea_id'))->where('idea_comment_id',$this->request->get('idea_comment_id'))->first();
		if(!empty($check)){
			if($check->is_like == 1){
				$ucheck = $check->update(array('is_like'=>0));
			}
		}else{
			$input['is_like'] = 0;
			$clike = IdeaLikes::create($input);
		}
		$data = array();
		$data['total_like'] = IdeaLikes::where('idea_id',$input['idea_id'])->where('is_like',1)->where('idea_comment_id',$this->request->get('idea_comment_id'))->count();
		$data['total_dislike'] = IdeaLikes::where('idea_id',$input['idea_id'])->where('is_like',0)->where('idea_comment_id',$this->request->get('idea_comment_id'))->count();
		return json_encode($data);
	}

}
