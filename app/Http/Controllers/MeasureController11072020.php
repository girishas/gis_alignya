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
class MeasureController extends Controller
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
		$page_title  = getLabels("Measures");
		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}
		
		$data  = Measure::sortable()->leftjoin('al_master_status','al_master_status.id','=','al_measures.status')->leftjoin('users','users.id','=','al_measures.owner_user_id')->leftjoin('al_objectives','al_objectives.id','=','al_measures.objective_id')->where('al_measures.company_id',Auth::User()->company_id)->where('al_measures.category_type',1);
		
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
		
		
		$data  = $data->select('al_measures.*','al_master_status.name as status_name','al_master_status.bg_color','al_objectives.heading as parent_objective','al_master_status.icons as status_icon',DB::raw('CONCAT_WS(" ",users.first_name,users.last_name) as owner_name'))->paginate(config('constants.PAGINATION'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$contributers = User::where('company_id',Auth::User()->company_id)->pluck('first_name','id');
		$departments = Department::where('company_id',Auth::User()->company_id)->pluck('department_name','id');
		$status = Status::where('is_obj',1)->pluck('name','id');
		$objectives = Objective::where('company_id',Auth::User()->company_id)->pluck('heading','id');
		return view('frontend/measures/admin_index', compact('data','role_id','page_title','goal_cycles','perspectives','contributers','departments','status','objectives'));
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

	public function addmeasure(){
		

		$validator = Measure::validate($this->request->all());
		if($validator->fails()){
			return redirect()->back()->with('adderrormessage',getLabels('measure_saved_errors'))->withErrors($validator->errors());
		}else{
			$input = $this->request->except('contributers');
			if($input['measure_type'] == "revenue"){
				$input['measure_target'] = $input['revenue_target'];
				$input['measure_actual'] = $input['revenue_actual'];
			}
			//pr($input);
			$input['user_id'] = Auth::User()->id;
			$input['company_id'] = Auth::User()->company_id;
			$input['category_type'] = 1;
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
			//pr($input);
			$measure = Measure::create($input);

			$mile_target = $input['measure_actual'] ;
  			$quarterly_target = $input['measure_target'] -  $mile_target;  
			if($input['measure_type'] == "revenue"){
    			$target_gm = $input['actual_gm'] ;
    			$target_mm = $input['actual_mm'] ;
    			$target_nm = $input['actual_nm'] ;
    			$target_expense = $input['actual_expense'] ;
    			$target_net = $input['actual_net'];
    			$target_ebitda = $input['actual_ebitda'];
    			$quarterly_gm = $input['target_gm'] -  $target_gm;  
    			$quarterly_mm = $input['target_mm'] -  $target_mm;  
    			$quarterly_nm = $input['target_nm'] -  $target_nm;  
    			$quarterly_expense = $input['target_expense'] -  $target_expense;  
    			$quarterly_net = $input['target_net'] -  $target_net;  
    			$quarterly_ebitda = $input['target_ebitda'] -  $target_ebitda;      
  			}
			$measure_id = $measure->id;  
  			$frequency = $input['check_in_frequency'];
  			$year = substr($this->request->get('measure_cycle'),2,4);
			if($input['measure_cycle_quarter'] == 1){
				$date1 =  $year."-01-01";
				$date2 =  date("Y-m-t", strtotime($year."-03-01"));
			}elseif($input['measure_cycle_quarter'] == 2){
				$date1 =  $year."-03-01";
				$date2 =  date("Y-m-t", strtotime($year."-06-01"));
			}elseif($input['measure_cycle_quarter'] == 3){
				$date1 =  $year."-06-01"; 
				$date2 =  date("Y-m-t", strtotime($year."-09-01"));
			}elseif($input['measure_cycle_quarter'] == 4){
				$date1 =  $year."-09-01"; 
				$date2 =  date("Y-m-t", strtotime($year."-12-01"));
			}elseif($input['measure_cycle_quarter'] == 0){ // Full Yearly Create Q1,Q2,Q3,Q4
				$date1 =  $year."-01-01"; 
				$date2 =  date("Y-m-t", strtotime($year."-12-01"));
			}elseif($input['measure_cycle_quarter'] == 5){ 
				$date1 =  $year."-01-01"; 
				$date2 =  date("Y-m-t", strtotime($year."-06-01"));
			}elseif($input['measure_cycle_quarter'] == 6){ 
				$date1 =  $year."-06-01"; 
				$date2 =  date("Y-m-t", strtotime($year."-12-01"));
			}  
  			
		    if($frequency ==1){

		      $single_target = $quarterly_target / dateDiff($date1,$date2); 
		      if($input['measure_type'] == "revenue"){         
		        $single_gm = $quarterly_gm / dateDiff($date1,$date2);  
		        $single_nm = $quarterly_nm / dateDiff($date1,$date2);  
		        $single_mm = $quarterly_mm / dateDiff($date1,$date2);  
		        $single_expense = $quarterly_expense / dateDiff($date1,$date2);  
		        $single_net = $quarterly_net / dateDiff($date1,$date2);  
		        $single_ebitda = $quarterly_ebitda / dateDiff($date1,$date2);   
		    
		      }else{
		        $single_gm = 0 ;
		        $single_nm = 0 ;
		        $single_mm = 0 ;
		        $single_expense = 0 ;
		        $single_net = 0 ;
		        $single_ebitda = 0 ;
		      }

		      $i = 1 ;
		      while($date1 <= $date2){   
		        $year = date('Y',strtotime($date1));
		        $weekNumber = getWeek($date1); 
		        $dayNumber = getDayNumber($date1); 
		        $days = date('d',strtotime($date1));  
		        $month = date('m',strtotime($date1)); 
		        $quarter = $month / 3 ;  

		        $start_date = $year."-".$month."-".$days;  
		        $end_date =  $start_date; 
		         
		        $milestonesArr = array();
		        $milestonesArr['user_id'] = Auth::User()->id;//user id
		        $milestonesArr['company_id'] = Auth::User()->company_id;//company id
		        $milestonesArr['objective_id'] = $input['objective_id'];
		        $milestonesArr['measure_id'] = $measure_id;//measure id
		        $milestonesArr['is_automatic'] = 1;// is automtic
		        $milestonesArr['start_date'] = $start_date;//start date
		        $milestonesArr['end_date'] = $start_date;//end date

		        $mile_target = ($input['measure_target'] > $mile_target)?$mile_target:$input['measure_target'];
		        
		        
				if($input['calculation_type'] ==1){ // Target value divide in all milestones equally.
					$milestonesArr['sys_target'] = $single_target; 
					$milestonesArr['projection_target'] = $single_target; 
				}elseif($input['calculation_type'] ==2){ // Target value achieve in incremental order.
					$milestonesArr['sys_target'] = $mile_target; 
					$milestonesArr['projection_target'] = $mile_target; 
				}else{ // Fixed calculate value
					$milestonesArr['sys_target'] = $input['measure_target']; 
					$milestonesArr['projection_target'] = $input['measure_target']; 
				} 

				$milestonesArr['mile_status'] = 2; // status	
				$milestonesArr['milestone_name'] = "FY".$year."-Q".$quarter.": Milestone ".$i ;
				$milestonesArr['year'] = $year; // year
				$milestonesArr['quarter'] = $quarter; // quarter
				$milestonesArr['month'] = $month; // month	
				$milestonesArr['week'] = $weekNumber; // week
				$milestonesArr['day'] = $dayNumber; // day		 
		        
		        $milestone = Milestones::create($milestonesArr);
		             //---------- Revenue fields added in milestone revenue table - Daily---------
	            if($input['measure_type'] == "revenue"){
	              $target_gm = ($input['target_gm'] > $target_gm)?$target_gm:$input['target_gm'];
	              $target_mm = ($input['target_mm'] > $target_mm)?$target_mm:$input['target_mm'];
	              $target_nm = ($input['target_nm'] > $target_nm)?$target_nm:$input['target_nm'];
	              $target_expense = ($input['target_expense'] > $target_expense)?$target_expense:$input['target_expense'];
	              $target_net = ($input['target_net'] > $target_net)?$target_net:$input['target_net'];
	              $target_ebitda = ($input['target_ebitda'] > $target_ebitda)?$target_ebitda:$input['target_ebitda'];
	             
	              $RevenuesArr = array(); 
	              $RevenuesArr['milestone_id'] = $milestone->id;
	              $RevenuesArr['company_id'] = Auth::User()->company_id;  

	              if($input['calculation_type'] ==1){ // Target value divide in all milestones equally.
	                  $RevenuesArr['target_gm'] = $single_gm;  
	                  $RevenuesArr['target_mm'] = $single_mm;  
	                  $RevenuesArr['target_nm'] = $single_nm;  
	                  $RevenuesArr['target_expense'] = $single_expense;  
	                  $RevenuesArr['target_net'] = $single_net;  
	                  $RevenuesArr['target_ebitda'] = $single_ebitda;
	                  $RevenuesArr['projection_gm'] = $single_gm;  
	                  $RevenuesArr['projection_mm'] = $single_mm;  
	                  $RevenuesArr['projection_nm'] = $single_nm;  
	                  $RevenuesArr['projection_expense'] = $single_expense;  
	                  $RevenuesArr['projection_net'] = $single_net;  
	                  $RevenuesArr['projection_ebitda'] = $single_ebitda;
	               }elseif($input['calculation_type'] ==2){ // Target value achieve in incremental order.
	                  $RevenuesArr['target_gm'] = $target_gm;  
	                  $RevenuesArr['target_mm'] = $target_mm;  
	                  $RevenuesArr['target_nm'] = $target_nm;  
	                  $RevenuesArr['target_expense'] = $target_expense;  
	                  $RevenuesArr['target_net'] = $target_net;  
	                  $RevenuesArr['target_ebitda'] = $target_ebitda;
	                  $RevenuesArr['projection_gm'] = $target_gm;  
	                  $RevenuesArr['projection_mm'] = $target_mm;  
	                  $RevenuesArr['projection_nm'] = $target_nm;  
	                  $RevenuesArr['projection_expense'] = $target_expense;  
	                  $RevenuesArr['projection_net'] = $target_net;  
	                  $RevenuesArr['projection_ebitda'] = $target_ebitda;
	               }else{ // Fixed calculate value
	                $RevenuesArr['target_gm'] = $input['target_gm'];
	                $RevenuesArr['target_mm'] = $input['target_mm'];
	                $RevenuesArr['target_nm'] = $input['target_nm'];
	                $RevenuesArr['target_expense'] = $input['target_expense'];  
	                $RevenuesArr['target_net'] = $input['target_net']; 
	                $RevenuesArr['target_ebitda'] = $input['target_ebitda'];
	                $RevenuesArr['projection_gm'] = $input['target_gm'];
	                $RevenuesArr['projection_mm'] = $input['target_mm'];
	                $RevenuesArr['projection_nm'] = $input['target_nm'];
	                $RevenuesArr['projection_expense'] = $input['target_expense'];  
	                $RevenuesArr['projection_net'] = $input['target_net']; 
	                $RevenuesArr['projection_ebitda'] = $input['target_ebitda)'];
	            }
	              MilestoneRevenue::create($RevenuesArr);

	               $target_gm = $target_gm + $single_gm ;
	               $target_mm = $target_mm + $single_mm ;
	               $target_nm = $target_nm + $single_nm ;
	               $target_expense = $target_expense + $single_expense ;
	               $target_net = $target_net + $single_net ;
	               $target_ebitda = $target_ebitda + $single_ebitda ;
	 
	  
	             }
		            //---------- End - Revenue fields added in milestone revenue table ---------
		          //res.json(result) ; 
		         
		 
		        $mile_target = $mile_target + $single_target ;
		        $date1 = date('Y-m-d', strtotime($date1. ' + 1 days'));
		        $i++;

		        } 
		    } 
			if($measure){
				return redirect()->back()->with('message',getLabels('measure_saved_successfully'));
			}else{
				return redirect()->back()->with('adderrormessage',getLabels('something_wen_wrong'));
			}
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

	public function addtask(){
		$inputs = $this->request->all();
		if(isset($inputs['task_id'])){
			$task_id = $inputs['task_id'];
			$data = Tasks::find($task_id);
		}
		$inputs['user_id'] = Auth::User()->id;
		$inputs['company_id'] = Auth::User()->company_id;
		$inputs['status'] = 1;
		if($this->request->get('owners')){
			$inputs['owners'] = implode(',', $this->request->get('owners'));
		}
		if(isset($inputs['task_id'])){
			$update = $data->update($inputs);
		}else{
			$tasks = Tasks::create($inputs);
		}
		return redirect()->back();
	}

	public function updatemeasure(){
		$input = $this->request->except('contributers');
		$input['user_id'] = Auth::User()->id;
		$input['company_id'] = Auth::User()->company_id;
		$input['category_type'] = 1;
		$data = Measure::find($input['id']);
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
		
		$measure = $data->update($input);

		return redirect()->back();

	}

	public function getMeasureonUpdatePage(){
		$inputs = $this->request->all();
		$data['measures'] = Measure::leftjoin('al_master_status','al_master_status.id','=','al_measures.status')->leftjoin('users','users.id','=','al_measures.owner_user_id')->where('al_measures.id',$inputs['measure_id'])->select('al_measures.*','al_master_status.name as status_name','al_master_status.icons as status_icon','al_master_status.bg_color',DB::raw('CONCAT_WS(" ",first_name,last_name) as owner_name'))->first();
		$data['departments'] = Department::where('company_id',Auth::User()->company_id)->pluck('department_name','id');
		$data['teams'] = Teams::where('company_id',Auth::User()->company_id)->pluck('team_name','id');
		$data['members'] = User::where('company_id',Auth::User()->company_id)->pluck('first_name','id');
		$milestone = Milestones::where('measure_id',$inputs['measure_id'])->where('milestone_type',0)->get();
		if(!empty($milestone)){
			$milestone = $milestone->toArray();
		}else{
			$milestone = array();
		}
		$data['milestones'] = $milestone;
		$tasklist = Tasks::leftjoin('al_master_status','al_master_status.id','=','al_tasks.status')->where('al_tasks.type',1)->where('al_tasks.measure_id',$inputs['measure_id'])->select('al_master_status.name as status_name','al_master_status.bg_color','al_tasks.*')->get();
		if (!empty($tasklist)) {
			$tasklist = $tasklist->toArray();
			foreach ($tasklist as $key => $value) {
				$owners = explode(',',$value['owners']);
				$list = User::whereIn('id',$owners)->pluck('first_name')->toArray();
				$tasklist[$key]['owners'] = implode(',', $list);
			}
		}
		$data['tasklist'] = $tasklist;
		return json_encode($data);
	}

	public function getmilestonedetails(){
		$inputs = $this->request->all();
		$milestone_id = $inputs['milestone_id'];
		$milestone_data = Milestones::where('id',$milestone_id)->first();
		if(!empty($milestone_data)){
			$milestone_data = $milestone_data->toArray();
		}
		$data['milestone_data'] = $milestone_data;
		return json_encode($data);
	}

	public function updatemilestonemeasure(){
		$inputs = $this->request->except('start_date','end_date');
		$start_date = date('Y-m-d',strtotime($this->request->get('start_date')));
		$end_date = date('Y-m-d',strtotime($this->request->get('end_date')));
		$inputs['start_date'] = $start_date;
		$inputs['end_date'] = $end_date;
		$inputs['user_id'] = Auth::User()->id;
		$inputs['sys_progress'] = ($this->request->get('mile_actual')/$this->request->get('sys_target'))*100;
		if(isset($inputs['id'])){
			$data = Milestones::find($inputs['id']);
			$update = $data->update($inputs);
		}else{
			Milestones::create($inputs);
		}
		
		return redirect()->back();
		
	}

	public function removetasks($id=null){
		$inputs = $this->request->all();
		$id = $inputs['task_id'];
		$data = Tasks::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url('team'), "message" => getLabels('task_removed'));
		}else{
			$results = array("type" => "error", "url" => url('team'), "message" => getLabels('task_not_removed'));
		}
		return json_encode($results);
	}

	public function remove_measure($id = null){		
		$data = Measure::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url('measures'), "message" => getLabels('measure_removed'));
		}else{
			$results = array("type" => "error", "url" => url('measures'), "message" => getLabels('measure_not_removed'));
		}
		return json_encode($results);
	}
}
