<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Country;
use App\Models\Template;
use App\Models\Teams;
use App\Models\GoalCycles;
use App\Models\Perspective;
use App\Models\Department;
use App\Models\MilestoneRevenue;
use App\Models\DepartmentMember;
use App\Models\Milestones;
use App\Models\TeamsMembers;
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
class InitiativeController extends Controller
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
	
	
	public function admin_index($role_id = null){
		$page_title  = getLabels("Initiatives");
		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}
		
		$data  = Measure::sortable()->leftjoin('al_master_status','al_master_status.id','=','al_measures.status')->leftjoin('users','users.id','=','al_measures.owner_user_id')->leftjoin('al_objectives','al_objectives.id','=','al_measures.objective_id')->where('al_measures.company_id',Auth::User()->company_id)->where('al_measures.category_type',2);
		
		if(! empty($_POST)){
			if(isset($_POST['heading']) and $_POST['heading'] !=''){
				$heading = $_POST['heading'];
				$this->request->session()->put('usearch.heading', $heading);
				$data = $data->whereRaw('al_measures.heading like ?', "%{$heading}%");
			}
			
			if(isset($_POST['status']) and $_POST['status'] !=''){
				$status = $_POST['status'];
				$this->request->session()->put('usearch.status', $status);
				$data = $data->where('al_measures.status',$status);
			}
			
		}else{
			$this->request->session()->forget('usearch');
		}
		
		
		$data  = $data->orderBy('al_measures.id','desc')->select('al_measures.*','al_master_status.name as status_name','al_master_status.bg_color','al_objectives.heading as parent_objective','al_master_status.icons as status_icon',DB::raw('CONCAT_WS(" ",users.first_name,users.last_name) as owner_name'))->paginate(config('constants.PAGINATION'));
		//pr($data->toArray());
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$goal_cycles = GoalCycles::where('company_id',Auth::User()->company_id)->pluck('cycle_name','id');
		$contributers = User::select(DB::raw('CONCAT(users.first_name," ",IFNULL(users.last_name," ")," ( ",al_users_role.role," )") as first_name'), 'users.id')->leftjoin('al_users_role','al_users_role.id','=','users.role_id')->where('users.company_id',Auth::User()->company_id)->pluck('first_name','users.id');
		$departments = Department::where('company_id',Auth::User()->company_id)->pluck('department_name','id');
		$status = Status::where('is_obj',1)->pluck('name','id')->toArray();
		$objectives = Objective::where('company_id',Auth::User()->company_id)->pluck('heading','id');
		return view('frontend/initiative/admin_index', compact('data','role_id','page_title','goal_cycles','perspectives','contributers','departments','status','objectives','goal_cycles'));
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
	
	
	public function getscorecards(){
		$input = $this->request->all();
		$scorecards = Scorecard::where('company_id',$input['company_id'])->pluck('name','id');
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

	public function addinitiative(){
		$validator = Measure::validateInitiative($this->request->all());
		if($validator->fails()){
			return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('please_correct_errors')]);
		}else{
			$input = $this->request->except('contributers','milestone_name','start_date');
			
			$input['user_id'] = Auth::User()->id;
			$input['company_id'] = Auth::User()->company_id;
			$input['category_type'] = 2;
			if($this->request->get('measure_team_type') == 'team'){
				$owner_user_id = TeamsMembers::where('team_id',$this->request->get('measure_team_id'))->where('is_head',1)->value('member_id');
				$input['owner_user_id'] = $owner_user_id;
			}elseif($this->request->get('measure_team_type') == 'department'){
				$owner_user_id = DepartmentMember::where('department_id',$this->request->get('measure_department_id'))->where('is_head',1)->value('member_id');
				$input['owner_user_id'] = $owner_user_id;
			}
			if($this->request->get('contributers')){
				$input['contributers'] = implode(',', $this->request->get('contributers'));
			}
			if($this->request->get('measure_cycle')){
				$input['measure_cycle_year'] = substr($this->request->get('measure_cycle'),2,4);
				if(strpos($this->request->get('measure_cycle'), 'Q1') !== false){
					$input['measure_cycle_quarter'] = 1;
					$input['quarter_start_month'] = 1;
				}
				if(strpos($this->request->get('measure_cycle'), 'Q2') !== false){
					$input['measure_cycle_quarter'] = 2;
					$input['quarter_start_month'] = 4;
				}
				if(strpos($this->request->get('measure_cycle'), 'Q3') !== false){
					$input['measure_cycle_quarter'] = 3;
					$input['quarter_start_month'] = 7;
				}
				if(strpos($this->request->get('measure_cycle'), 'Q4') !== false){
					$input['measure_cycle_quarter'] = 4;
					$input['quarter_start_month'] = 10;
				}
				if(strpos($this->request->get('measure_cycle'), 'H1') !== false){
					$input['measure_cycle_quarter'] = 5;
					$input['quarter_start_month'] = 1;
				}
				if(strpos($this->request->get('measure_cycle'), 'H2') !== false){
					$input['measure_cycle_quarter'] = 6;
					$input['quarter_start_month'] = 7;
				}
				if(strpos($this->request->get('measure_cycle'), 'FULL') !== false){
					$input['measure_cycle_quarter'] = 0;
					$input['quarter_start_month'] = 1;
				}
			}

			$measure = Measure::create($input);
			if($this->request->get('start_date')){
				$start_date = $this->request->get('start_date');
				$end_date = $this->request->get('end_date');
				$milestone_name = $this->request->get('milestone_name');
				for ($i=0; $i < count($start_date) ; $i++) { 
					$inarr = array();
					$inarr['user_id'] = Auth::User()->id;
					$inarr['company_id'] = Auth::User()->company_id;
					$inarr['milestone_type'] = 1;
					$inarr['initiative_id'] = $measure->id;
					$inarr['milestone_name'] = $milestone_name[$i];
					$inarr['start_date'] = $start_date[$i];
					$inarr['end_date'] = $end_date[$i];
					$inarr['mile_status'] = 2;
					Milestones::create($inarr);
				}
			}
			if($measure){
				if($this->request->get('is_popup')){
					return response()->json(array("type" => "success", "url" => 'close_modal', "popup_name" => 'objective'));
				}else{
					return response()->json(array("type" => "success", "url" => url('initiatives'), "message" => getLabels('initiative_saved_successfully')));
				}
			}else{
				return redirect()->back()->with('adderrormessage',getLabels('something_wen_wrong'));
			}
		}	 
	}

	public function updateinitiative(){

			$input = $this->request->except('contributers');
			$id = $input['id'];
			if($id){
				$data = Measure::find($id);
			}
			$input['user_id'] = Auth::User()->id;
			$input['company_id'] = Auth::User()->company_id;
			$input['category_type'] = 2;
			if($this->request->get('measure_team_type') == 'team'){
				$owner_user_id = TeamsMembers::where('team_id',$this->request->get('measure_team_id'))->where('is_head',1)->value('member_id');
				$input['owner_user_id'] = $owner_user_id;
			}elseif($this->request->get('measure_team_type') == 'department'){
				$owner_user_id = DepartmentMember::where('department_id',$this->request->get('measure_department_id'))->where('is_head',1)->value('member_id');
				$input['owner_user_id'] = $owner_user_id;
			}
			if($this->request->get('contributers')){
				$input['contributers'] = implode(',', $this->request->get('contributers'));
			}
			if($this->request->get('measure_cycle')){
				$input['measure_cycle_year'] = substr($this->request->get('measure_cycle'),2,4);
				if(strpos($this->request->get('measure_cycle'), 'Q1') !== false){
					$input['measure_cycle_quarter'] = 1;
					$input['quarter_start_month'] = 1;
				}
				if(strpos($this->request->get('measure_cycle'), 'Q2') !== false){
					$input['measure_cycle_quarter'] = 2;
					$input['quarter_start_month'] = 4;
				}
				if(strpos($this->request->get('measure_cycle'), 'Q3') !== false){
					$input['measure_cycle_quarter'] = 3;
					$input['quarter_start_month'] = 7;
				}
				if(strpos($this->request->get('measure_cycle'), 'Q4') !== false){
					$input['measure_cycle_quarter'] = 4;
					$input['quarter_start_month'] = 10;
				}
				if(strpos($this->request->get('measure_cycle'), 'H1') !== false){
					$input['measure_cycle_quarter'] = 5;
					$input['quarter_start_month'] = 1;
				}
				if(strpos($this->request->get('measure_cycle'), 'H2') !== false){
					$input['measure_cycle_quarter'] = 6;
					$input['quarter_start_month'] = 7;
				}
				if(strpos($this->request->get('measure_cycle'), 'FULL') !== false){
					$input['measure_cycle_quarter'] = 0;
					$input['quarter_start_month'] = 1;
				}
			}
			// pr($input);
			if($id){
				$measure = $data->update($input);
			}
			if($measure){
				if($this->request->get('is_popup')){
					return response()->json(array("type" => "success", "url" => 'close_modal', "popup_name" => 'objective'));
				}else{

					return response()->json(array("type" => "success", "url" => url('initiatives'), "message" => getLabels('initiative_update_successfully')));
				}
			}else{
				return redirect()->back()->with('adderrormessage',getLabels('something_wen_wrong'));
			}
		
	}

	public function getMeasureCycles(){
		$input = $this->request->all();
		$cycle_id = Objective::where('id',$input['objective_id'])->value('cycle_id');
		$years = GoalCycles::where('id',$cycle_id)->value('no_months');
		$current_year = date('Y');
		$select_values = array();
        for($i=0;$i < $years;$i++){  
            $select_values[] = 'FY'.($current_year+$i).'-Q1';  
            $select_values[] = 'FY'.($current_year+$i).'-Q2';  
            $select_values[] = 'FY'.($current_year+$i).'-Q3';  
            $select_values[] = 'FY'.($current_year+$i).'-Q4';  
            $select_values[] = 'FY'.($current_year+$i).'-H1';  
            $select_values[] = 'FY'.($current_year+$i).'-H2';  
            $select_values[] = "FY".($current_year+$i)."-FULL";

        } 
        return json_encode($select_values);
	}

	public function getInitiativeData(){
		$inputs = $this->request->all();
		$id = $inputs['id'];
		$initiatives = Measure::leftjoin('al_master_status','al_master_status.id','=','al_measures.status')->leftjoin('users','users.id','=','al_measures.owner_user_id')->where('al_measures.id',$inputs['id'])->select('al_measures.*','al_master_status.name as status_name','al_master_status.bg_color','al_master_status.icons as status_icon',DB::raw('CONCAT_WS(" ",users.first_name,users.last_name) as owner_name'))->first();
		$data['initiatives'] = $initiatives;
		$milestones = Milestones::leftjoin('al_master_status','al_master_status.id','=','al_project_milestones.mile_status')->where('al_project_milestones.initiative_id',$id)->select('al_project_milestones.milestone_name as name','al_project_milestones.start_date as fromDate','al_project_milestones.end_date as toDate','al_master_status.bg_color as color','al_project_milestones.id')->get();
		$tasklist = Tasks::leftjoin('al_master_status','al_master_status.id','=','al_tasks.status')->where('al_tasks.type',2)->where('al_tasks.measure_id',$id)->select('al_tasks.*','al_master_status.bg_color','al_master_status.icons as status_icon','al_master_status.name as status_name')->get();
		if(!empty($tasklist)){
			$tasklist = $tasklist->toArray();
			foreach ($tasklist as $key => $value) {
				$owners = explode(',',$value['owners']);
				$list = User::select(DB::raw('CONCAT(users.first_name," ",IFNULL(users.last_name," "), " ( ", al_users_role.role, " )")'))->leftjoin('al_users_role','al_users_role.id','users.role_id')->whereIn('users.id',$owners)->pluck('users.first_name')->toArray();
				$tasklist[$key]['owners'] = implode(',', $list);
			}
		}else{
			$tasklist = array();
		}
		if(!empty($milestones)){
			$milestones = $milestones->toArray();
		}else{
			$milestones = array();
		}
		$data['departments'] = Department::where('company_id',Auth::User()->company_id)->pluck('department_name','id');
		$data['teams'] = Teams::where('company_id',Auth::User()->company_id)->pluck('team_name','id');
		$data['members'] = User::select(DB::raw('CONCAT(users.first_name," ",IFNULL(users.last_name," ")," ( ",al_users_role.role," )") as first_name'), 'users.id')->leftjoin('al_users_role','al_users_role.id','=','users.role_id')->where('users.company_id',Auth::User()->company_id)->pluck('first_name','users.id');
		$data['milestones'] = $milestones;
		$data['tasklist'] = $tasklist;
		return json_encode($data);
	}

	public function addmilestoneinitiative(){
		$inputs = $this->request->except('start_date','end_date');
		$id = $inputs['id'];
		if($id){
			$data = Milestones::find($id);
		}
		$inputs['user_id'] = Auth::User()->id;
		$inputs['company_id'] = Auth::User()->company_id;
		$inputs['milestone_type'] = 1;
		$inputs['start_date'] = date('Y-m-d h:i:s',strtotime($this->request->get('start_date')));
		$inputs['end_date'] = date('Y-m-d h:i:s', strtotime($this->request->get('end_date')));
		if($id){
			$update = $data->update($inputs);
			$message = 'Milestone update successfully';
		}else{
			Milestones::create($inputs);
			$message = 'Milestone add successfully';
		}
		if($this->request->get('is_popup')){

			return response()->json(array("type" => "success", "url" => 'close_modal', "popup_name" => 'initiative'));
		}else{

			return response()->json(array("type" => "success", "url" => url('measures'), "message" => getLabels('measure_update_successfully')));
		}
	}

	public function getmilestonedata(){
		$inputs = $this->request->all();
		$id = $inputs['id'];
		$milestone = Milestones::where('id',$id)->first();
		if(!empty($milestone)){
			$milestone = $milestone->toArray();
		}else{
			$milestone = array();
		}
		return json_encode($milestone);
	}

	public function remove_milestone($id = null){
		$data = Milestones::destroy($id);
		
		if($data){
			return response()->json(array("type" => "success", "url" => 'comment_remove', "popup_name" => 'initiative'));
		}else{
			return response()->json(array("type" => "error", "url" => 'close_modal', "popup_name" => 'initiative'));
		}
		return json_encode($results);
	}

	public function remove_tasks($id = null){
		$data = Tasks::destroy($id);
		
		if($data){
			return response()->json(array("type" => "success", "url" => 'comment_remove', "popup_name" => 'initiative'));
		}else{
			return response()->json(array("type" => "error", "url" => 'close_modal', "popup_name" => 'initiative'));
		}
		return json_encode($results);
	}
	
	public function remove_initiative($id = null){
		$data = Measure::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url('initiatives'), "message" => getLabels('initiative_removed'));
		}else{
			$results = array("type" => "error", "url" => url('initiatives'), "message" => getLabels('initiative_not_removed'));
		}
		return json_encode($results);
	}
}
