<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Country;
use App\Models\Template;
use App\Models\Teams;
use App\Models\GoalCycles;
use App\Models\Perspective;
use App\Models\Department;
use App\Models\DepartmentMember;
use App\Models\TeamsMembers;
use App\Models\Milestones;
use App\Models\Status;
use App\Models\Objective;
use App\Models\Measure;
use App\Models\Follower;
use App\Models\Scorecard;
use App\Models\Theme;
use App\Models\Tasks;
use App\Models\Notification;
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
class ObjectiveController extends Controller
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
	
	
	public function admin_index(){
		$page_title  = getLabels("Objectives");
		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}
		
		$data  = Objective::sortable()->leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->leftjoin('al_goal_cycles','al_goal_cycles.id','=','al_objectives.cycle_id')->leftjoin('users','users.id','=','al_objectives.owner_user_id')->leftjoin('al_objectives as o','o.id','=','al_objectives.objective_id')->where('al_objectives.company_id',Auth::User()->company_id);
		if(Auth::User()->role_id != 2){
			$data = $data->where(function($queryW){
				$queryW->where("al_objectives.owner_user_id", Auth::User()->id)
				->orWhereRaw(DB::raw('FIND_IN_SET('.Auth::User()->id.',al_objectives.contributers) > 0'))
				->orWhere('al_objectives.user_id',Auth::User()->id);
			});	
		}
		if(! empty($_POST)){
			if(isset($_POST['heading']) and $_POST['heading'] !=''){
				$heading = $_POST['heading'];
				$this->request->session()->put('usearch.heading', $heading);
				$data = $data->whereRaw('al_objectives.heading like ?', "%{$heading}%");
			}
			if(isset($_POST['cycle_id']) and $_POST['cycle_id'] !=''){
				$cycle_id = $_POST['cycle_id'];
				$this->request->session()->put('usearch.cycle_id', $cycle_id);
				$data = $data->whereRaw('al_objectives.cycle_id like ?', "%{$cycle_id}%");
			}
			if(isset($_POST['status']) and $_POST['status'] !=''){
				$status = $_POST['status'];
				$this->request->session()->put('usearch.status', $status);
				$data = $data->whereRaw('al_objectives.status like ?', "%{$status}%");
			}
			
		}else{
			$this->request->session()->forget('usearch');
		}
		
		
		$data  = $data->orderBy('al_objectives.id','desc')->select('al_objectives.*','al_master_status.name as status_name','al_master_status.bg_color','o.heading as parent_objective','al_goal_cycles.cycle_name','al_master_status.icons as status_icon',DB::raw('CONCAT_WS(" ",users.first_name,users.last_name) as owner_name'))->paginate(config('constants.PAGINATION'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$goal_cycles = GoalCycles::where('company_id',Auth::User()->company_id)->where('status',1)->pluck('cycle_name','id');
		$perspectives = Perspective::where('company_id',Auth::User()->company_id)->where('status',1)->pluck('name','id');

		$contributers = User::select(DB::raw('CONCAT(users.first_name," ",IFNULL(users.last_name," ")," (",al_users_role.role,")") as first_name'),'users.id')->leftjoin('al_users_role','al_users_role.id','=','users.role_id')->where('users.company_id',Auth::User()->company_id)->pluck('first_name','users.id');
		//pr($contributers);
		$departments = Department::where('company_id',Auth::User()->company_id)->pluck('department_name','id');
		$page_title  = getLabels("Objectives");
		$objectives = Objective::where('company_id',Auth::User()->company_id)->pluck('heading','id');
		
		$status = Status::where('is_obj',1)->pluck('name','id');
		$task_status = Status::where('is_task',1)->pluck('name','id');

		return view('frontend/objectives/admin_index', compact('data','role_id','page_title','goal_cycles','perspectives','contributers','departments','status','objectives','task_status'));
	}

	public function measures($role_id = null){
		$page_title  = "KPI";
		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}
		
		$data  = Measure::sortable()->where('al_measures.category_type',3);
		if(! empty($_POST)){
			if(isset($_POST['team_name']) and $_POST['team_name'] !=''){
				$team_name = $_POST['team_name'];
				$this->request->session()->put('usearch.team_name', $team_name);
				$data = $data->whereRaw('al_comp_teams.team_name like ?', "%{$team_name}%");
			}
			
		}else{
			$this->request->session()->forget('usearch');
		}
		
		
		$data  = $data->paginate(config('constants.PAGINATION'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$page_title  = "KPI";
		return view('frontend/objectives/kpi', compact('data','role_id','page_title'));
	}
	public function measure($role_id = null){
		$page_title  = "Measures";
		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}
		
		$data  = Measure::sortable()->leftjoin('al_master_status','al_master_status.id','=','al_measures.status')->leftjoin('al_objectives','al_objectives.id','=','al_measures.objective_id')->where('al_measures.category_type',1);
		if(! empty($_POST)){
			if(isset($_POST['team_name']) and $_POST['team_name'] !=''){
				$team_name = $_POST['team_name'];
				$this->request->session()->put('usearch.team_name', $team_name);
				$data = $data->whereRaw('al_comp_teams.team_name like ?', "%{$team_name}%");
			}
			
		}else{
			$this->request->session()->forget('usearch');
		}
		
		
		$data  = $data->select('al_measures.*','al_master_status.name as status_name','al_master_status.bg_color','al_objectives.heading as parent_objective')->paginate(config('constants.PAGINATION'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$page_title  = "Measures";
		return view('frontend/objectives/measure', compact('data','role_id','page_title'));
	}
	public function initiatives($role_id = null){
		$page_title  = getLabels("Initiatives");
		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}
		
		$data  = Teams::sortable()->leftjoin('users', 'users.id', '=', 'al_comp_teams.team_head');
		
		if(! empty($_POST)){
			if(isset($_POST['team_name']) and $_POST['team_name'] !=''){
				$team_name = $_POST['team_name'];
				$this->request->session()->put('usearch.team_name', $team_name);
				$data = $data->whereRaw('al_comp_teams.team_name like ?', "%{$team_name}%");
			}
			
		}else{
			$this->request->session()->forget('usearch');
		}
		
		
		$data  = $data->select('al_comp_teams.*',DB::raw("CONCAT_WS(' ',users.first_name,users.last_name) AS team_head_name"), 'users.designation')->orderBy('al_comp_teams.id', 'desc')->paginate(config('constants.PAGINATION'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$page_title  = getLabels("Initiatives");
		return view('frontend/objectives/initiatives', compact('data','role_id','page_title'));
	}
	
	
	
	public function getscorecards($id=null){
		$input = $this->request->all();
		if($id){
			$scorecards = Scorecard::where('company_id',$id)->pluck('name','id');
		}else{
			$scorecards = Scorecard::where('company_id',$input['company_id'])->pluck('name','id');
		}
		return json_encode($scorecards);
	}

	public function submitscorecard(){
		$input = $this->request->all();
		$input['name'] = $input['scorecardname'];
		$input['status'] = $input['scorecardstatus'];
		$add = Scorecard::create($input);
		if($add){
			return json_encode("success");
		}
	}
	public function submitaddtheme(){
		$input = $this->request->all();
		$input['theme_name'] = $input['themename'];
		$input['theme_summary'] = $input['themesummary'];
		$add = Theme::create($input);
		if($add){
			return json_encode("success");
		}
	}
	public function submitaddcycle(){
		$input = $this->request->all();
		$input['cycle_name'] = $input['cyclename'];
		$input['no_months'] = $input['numberofmonth'];
		$add = GoalCycles::create($input);
		if($add){
			return json_encode("success");
		}
	}

	public function getthemes(){
		$input = $this->request->all();
		$themes = Theme::where('company_id',$input['company_id'])->pluck('theme_name','id');
		return json_encode($themes);
	}

	public function getCycles(){
		$input = $this->request->all();
		$cycles = GoalCycles::where('company_id',$input['company_id'])->pluck('cycle_name','id');
		return json_encode($cycles);
	}

	public function addobjective(){
		
		$validator = Objective::validate($this->request->all());
		if($validator->fails()){
			return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('please_correct_errors')]);
		}else{
			$input = $this->request->except('contributers');
			$input['user_id'] = Auth::User()->id;
			$input['company_id'] = Auth::User()->company_id;
			if($this->request->get('team_type') == 'team'){
				$owner_user_id = TeamsMembers::where('team_id',$this->request->get('team_id'))->where('is_head',1)->value('member_id');
				$input['owner_user_id'] = $owner_user_id;
			}elseif($this->request->get('team_type') == 'department'){
				$owner_user_id = DepartmentMember::where('department_id',$this->request->get('department_id'))->where('is_head',1)->value('member_id');
				$input['owner_user_id'] = $owner_user_id;
			}
			if($this->request->get('contributers')){
				$input['contributers'] = implode(',', $this->request->get('contributers'));
			}
			$objective = Objective::create($input);
			
			if($objective){
				if($this->request->get('is_popup')){
					return response()->json(array("type" => "success", "url" => 'close_modal', "popup_name" => 'objective'));
				}else{
					return response()->json(array("type" => "success", "url" => url('objectives'), "message" => getLabels('objective_saved_successfully')));
				}
			}else{
				return redirect()->back()->with('objective_add_success',getLabels('something_wen_wrong'));
			}
		}	 
	}

	public function viewobjective(){
		$data = array();
		$input = $this->request->all();
		$objectiveinfo = Objective::leftjoin('al_goal_cycles','al_goal_cycles.id','=','al_objectives.cycle_id')->leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->leftjoin('users','users.id','=','al_objectives.owner_user_id')->where('al_objectives.id',$input['id'])->select('al_objectives.*','al_goal_cycles.cycle_name','al_master_status.name as status_name','al_master_status.bg_color','al_master_status.icons as status_icon',DB::raw('CONCAT_WS(" ",users.first_name,users.last_name) as owner_name'))->first();
		$measuresList = Measure::leftjoin('al_master_status','al_master_status.id','=','al_measures.status')->leftjoin('users','users.id','=','al_measures.owner_user_id')->leftjoin('al_objectives','al_objectives.id','=','al_measures.objective_id')->where('al_measures.objective_id',$input['id'])->where('al_measures.category_type',1)->select('al_measures.*','al_master_status.name as status_name','al_master_status.bg_color','al_objectives.heading as parent_objective','al_master_status.icons as status_icon',DB::raw('CONCAT_WS(" ",users.first_name,users.last_name) as owner_name'))->orderBy('id','desc')->get();
		if(!empty($measuresList)){
			$measuresList = $measuresList->toArray();
			foreach ($measuresList as $key => $value) {
				$avg = Milestones::where('measure_id',$value['id'])->avg('sys_progress');
				$measuresList[$key]['percentage'] = (!empty($avg))?$avg:0;
				$measuresList[$key]['plucked_milestone'] = Milestones::where('company_id',Auth::User()->company_id)->where('measure_id',$value['id'])->orderBy('start_date','asc')->pluck('sys_target')->toArray();
				$measuresList[$key]['actual_graph_data'] = Milestones::where('company_id',Auth::User()->company_id)->where('measure_id',$value['id'])->orderBy('start_date','asc')->pluck('mile_actual')->toArray();
				$measuresList[$key]['graph_labels'] = Milestones::where('company_id',Auth::User()->company_id)->where('measure_id',$value['id'])->orderBy('start_date','asc')->pluck('milestone_name')->toArray();
				$measuresList[$key]['max_mile'] = Milestones::select(DB::raw('MAX(GREATEST(COALESCE(mile_actual,0),COALESCE(sys_target,0),COALESCE(projection_target,0))) as max_value'))->where('company_id',Auth::User()->company_id)->where('measure_id',$value['id'])->value('max_value');
				$measuresList[$key]['pojected_graph_data'] = Milestones::where('company_id',Auth::User()->company_id)->where('measure_id',$value['id'])->orderBy('start_date','asc')->pluck('projection_target')->toArray();
			}
			if(!empty($measuresList)){
				$data['plucked_milestone'] = Milestones::where('company_id',Auth::User()->company_id)->where('measure_id',$measuresList[0]['id'])->orderBy('start_date','asc')->pluck('sys_target')->toArray();
				$data['actual_graph_data'] = Milestones::where('company_id',Auth::User()->company_id)->where('measure_id',$measuresList[0]['id'])->orderBy('start_date','asc')->pluck('mile_actual')->toArray();
				$data['graph_labels'] = Milestones::where('company_id',Auth::User()->company_id)->where('measure_id',$measuresList[0]['id'])->orderBy('start_date','asc')->pluck('milestone_name')->toArray();
				$data['max_mile'] = Milestones::select(DB::raw('MAX(GREATEST(COALESCE(mile_actual,0),COALESCE(sys_target,0),COALESCE(projection_target,0))) as max_value'))->where('company_id',Auth::User()->company_id)->where('measure_id',$measuresList[0]['id'])->value('max_value');
				$data['pojected_graph_data'] = Milestones::where('company_id',Auth::User()->company_id)->where('measure_id',$measuresList[0]['id'])->orderBy('start_date','asc')->pluck('projection_target')->toArray();
			}
		}else{
			$measuresList = array();
		}

		$initiativeList = Measure::leftjoin('al_master_status','al_master_status.id','=','al_measures.status')->leftjoin('users','users.id','=','al_measures.owner_user_id')->leftjoin('al_objectives','al_objectives.id','=','al_measures.objective_id')->where('al_measures.objective_id',$input['id'])->where('al_measures.category_type',2)->select('al_measures.*','al_master_status.name as status_name','al_master_status.bg_color','al_objectives.heading as parent_objective','al_master_status.icons as status_icon',DB::raw('CONCAT_WS(" ",users.first_name,users.last_name) as owner_name'))->orderBy('al_measures.id','desc')->get();

		if(!empty($initiativeList)){
			$initiativeList = $initiativeList->toArray();
		}else{
			$initiativeList = array();
		}
		$subobjective = Objective::leftjoin('al_goal_cycles','al_goal_cycles.id','=','al_objectives.cycle_id')->leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->leftjoin('users','users.id','=','al_objectives.owner_user_id')->where('al_objectives.objective_id',$input['id'])->select('al_objectives.*','al_goal_cycles.cycle_name','al_master_status.name as status_name','al_master_status.bg_color','al_master_status.icons as status_icon',DB::raw('CONCAT_WS(" ",users.first_name,users.last_name) as owner_name'))->orderBy('al_objectives.id','desc')->get();
		if(!empty($subobjective)){
			$subobjective = $subobjective->toArray();
			foreach ($subobjective as $key => $value) {
				$avg = Milestones::where('objective_id',$value['id'])->avg('sys_progress');
				$subobjective[$key]['percentage'] = (!empty($avg))?$avg:0;
			}
			
		}else{
			$subobjective = array();
		}
		$tasklist = Tasks::leftjoin('al_master_status','al_master_status.id','=','al_tasks.status')->where('al_tasks.type',0)->where('al_tasks.objective_id',$input['id'])->select('al_master_status.name as status_name','al_master_status.icons as status_icon','al_master_status.bg_color','al_tasks.*')->orderBy('al_tasks.id','desc')->get();
		if (!empty($tasklist)) {
			$tasklist = $tasklist->toArray();
			foreach ($tasklist as $key => $value) {
				$owners = explode(',',$value['owners']);
				$list = User::whereIn('id',$owners)->pluck('first_name')->toArray();
				$tasklist[$key]['owners'] = implode(',', $list);
			}
		}

		$data['objectiveinfo'] = $objectiveinfo;
		$data['measuresList'] = $measuresList;
		$data['initiativeList'] = $initiativeList;
		$data['subobjective'] = $subobjective;
		$data['tasklist'] = $tasklist;
 		return json_encode($data);
	}

	public function updateobjective(){
		$data = array();
		$inputs = $this->request->all();
		$objective = Objective::find($inputs['objective_id']);
		if(!empty($objective)){
			$objective = $objective->toArray();
		}else{
			$objective = array();
		}
		$departments = $departments = Department::where('company_id',Auth::User()->company_id)->pluck('department_name','id');
		$teams = Teams::where('company_id',Auth::User()->company_id)->pluck('team_name','id');
		$members = User::select(DB::raw('CONCAT(users.first_name," ",IFNULL(users.last_name," ")," ( ",al_users_role.role," )") as first_name'), 'users.id')->leftjoin('al_users_role','al_users_role.id','=','users.role_id')->where('users.company_id',Auth::User()->company_id)->pluck('first_name','users.id');
		$data['teams'] = $teams;
		$data['departments'] = $departments;
		$data['members'] = $members;
		$data['objective'] = $objective;
		return json_encode($data);	
	}

	public function getcontributers(){
		$input = $this->request->all();
		$contributers = User::select(DB::raw('CONCAT(users.first_name," ",IFNULL(users.last_name," ")," ( ",al_users_role.role," )") as first_name'), 'users.id')->leftjoin('al_users_role','al_users_role.id','=','users.role_id')->where('users.company_id',Auth::User()->company_id)->pluck('first_name','users.id');
		return json_encode($contributers);
	}

	public function updateobjectivesubmit(){
		$validator = Objective::validate($this->request->all());
		if($validator->fails()){
			return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('please_correct_errors')]);
		}else{
			$input = $this->request->except('contributers','scorecard_id');
			$data = Objective::find($input['id']);
			$input['user_id'] = Auth::User()->id;
			$input['company_id'] = Auth::User()->company_id;
			if($this->request->get('team_type') == 'team'){
				$owner_user_id = TeamsMembers::where('team_id',$this->request->get('team_id'))->where('is_head',1)->value('member_id');
				$input['owner_user_id'] = $owner_user_id;
			}elseif($this->request->get('team_type') == 'department'){
				$owner_user_id = DepartmentMember::where('department_id',$this->request->get('department_id'))->where('is_head',1)->value('member_id');
				$input['owner_user_id'] = $owner_user_id;
			}
			if($this->request->get('contributers')){
				$input['contributers'] = implode(',', $this->request->get('contributers'));
			}
			if($this->request->get('scorecard_id')){
				$input['scorecard_id'] = implode(',', $this->request->get('scorecard_id'));
			}
			//pr($input);
			$objective = $data->update($input);
			if($objective){
				if($this->request->get('is_popup')){

					return response()->json(array("type" => "success", "url" => 'close_modal', "popup_name" => 'objective'));
				}else{

					return response()->json(array("type" => "success", "url" => url('objectives'), "message" => getLabels('objective_updated_successfully')));
				}
			}else{
				return redirect()->back()->with('objective_add_error',getLabels('something_went_wrong'));
			}
		}
	} 

	public function getTaskDetails(){
		$inputs = $this->request->all();
		$task_id = $inputs['task_id'];
		$data['task_details'] = Tasks::find($task_id);
		$data['owners'] = User::select(DB::raw('CONCAT_WS(" ",first_name,last_name) as owner_name'), 'id')->where('company_id',Auth::User()->company_id)->pluck('owner_name','id');
		return json_encode($data);
	}

	public function remove_objective($id = null){		
		$data = Objective::destroy($id);
		$delete_measure = Measure::where('objective_id',$id)->delete();
		if($data){
			$results = array("type" => "success", "url" => url('objectives'), "message" => getLabels('objective_removed'));
		}else{
			$results = array("type" => "error", "url" => url('objectives'), "message" => getLabels('objective_not_removed'));
		}
		return json_encode($results);
	}

	public function getcontributersforobjective(){
		$data = User::select(DB::raw('CONCAT(IFNULL(users.first_name," ")," ",IFNULL(users.last_name," ")," ( ",al_users_role.role," )") as first_name'), 'users.id')->leftjoin('al_users_role','al_users_role.id','users.role_id')->where('users.company_id',Auth::User()->company_id)->pluck('users.first_name','users.id');
		return json_encode($data);
	}
}
