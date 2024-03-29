<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Country;
use App\Models\Notification;
use App\Models\SubscriptionPlan;
use App\Models\Objective;
use App\Models\Tasks;
use App\Models\Measure;
use App\Models\GoalCycles;
use App\Models\Perspective;
use App\Models\UserRoles;
use App\Models\Department;
use App\Models\Plans;
use App\Models\Teams;
use App\Models\Industries;
use App\Models\Subscription;
use App\Models\Company;
use PHPMailer\PHPMailer\PHPMailer;

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
		$this->middleware('auth', ['except' => ['resizeProfileImageGoogle', 'resizeProfileImage', 'profile', 'resizeProfileImageFacebook', 'verifyMail', 'findOrCreateUser', 'redirectToProvider', 'handleProviderCallback', 'admin_login', 'admin_register', 'home','features_strategy_development','features_alignment_target_initiative','features_progress_tracking_and_insights','features_collaboration','alignya_process','blog','contact','login', 'register', 'forgot_password', 'resetpassword', 'admin_forgot_password','checkemailexist']]);
	}
	
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
					if(Auth::loginUsingId($userdata->id,true)){

						return redirect('dashboard')->with('message', getLabels('email_address_confirmed'));
					}
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
		$plans = Plans::where('status',1)->where('period',1)->orderBy('id','asc')->get();
		$yearly = Plans::where('status',1)->where('period',2)->orderBy('id','asc')->get();	
		if ($this->request->isMethod('post')) {
			$input = $this->request->all();
			$validator = User::register($this->request->all());
			if($validator->fails()){
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('please_correct_errors')]);
			}else{
				$company = array();
				$company['company_name'] = $input['company_name'];
				$company['plan_id'] = $input['plan_id'];
				$createcompany = Company::create($company);
				
				foreach (config('constants.DEFAULT_CYCLES') as $key => $value) {
					$goalcycles = array();
					$goalcycles['company_id'] = $createcompany->id; 
					$goalcycles['cycle_name'] = $value; 
					$goalcycles['no_months'] = $key; 
					$goalcycles['status'] = 1; 
					$creategoalcycles = GoalCycles::create($goalcycles);
				}
				$defaultperspective = Perspective::whereNull('company_id')->pluck('name','id');
				if(!empty($defaultperspective)){
					foreach ($defaultperspective as $key => $value) {
						$perspectivearray = array();
						$perspectivearray['company_id'] = $createcompany->id;
						$perspectivearray['name'] = $value;
						$perspectivearray['status'] = 1;
						$createperspective = Perspective::create($perspectivearray);
					}
					 
				}
				$data                = $this->request->except('password');
				$data['password']    = Hash::make($this->request->get('password'));
				$data['role_id']     = 2;
				$data['status']      = 0;
				$data['company_id'] = $createcompany->id;
				$data['full_name'] = $input['first_name'].' '.$input['last_name'];
				$data['user_ip'] = $_SERVER['REMOTE_ADDR'];
				$data['last_activity'] = date('Y-m-d h:i:s');
				$data['current_membership_plan'] = $input['plan_id'];
				$data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
				$data['is_owner'] = 1;
				$data['trial_expiry_date'] = date('Y-m-d', strtotime(date('Y-m-d'). ' + '.config('constants.TRIAL_DAYS').' days'));
				$user = User::create($data);
				if($user){
					$last_id = $user->id;
					$uniq_username = User::createUsername($last_id);
					$emp_code = "EMP-".$user->id.'-'.$createcompany->id;
					$updateempcode = User::where('id',$user->id)->update(array('emp_code'=>$emp_code));
					$varify_hash = base64_encode($last_id.$uniq_username);
					User::where('id', $user->id)->update(array('varify_hash'=>$varify_hash ));
					// if(config('constants.SITE_MODE') == 'live'){
						$mail_data  	=     getEmailTemplate('registration');
						if($mail_data){
							$usr_name       = $user->first_name." ".$user->last_name;
							$email          = $user->email; 
							$link           = config('constants.SITE_URL').'verify-mail?q='.$varify_hash;                       
							$site_name      = config('constants.SITE_TITLE');
							$admin_email    = config('constants.SITE_EMAIL'); 
							$message        = str_replace(array('{NAME}', '{EMAIL}', '{LINK}', '{SITE}'), array($usr_name, $email, $link, $site_name), $mail_data->template_body);
							$subject        = str_replace(array('{SITE}'), array($site_name), $mail_data->subject);
							require (base_path()."/Phpmailer/Phpmailer/vendor/autoload.php");
							$mail = new PHPMailer();                    // Enable verbose debug output
						    $mail->isSMTP();                                            // Send using SMTP
						    $mail->Host       = 'smtp-mail.outlook.com';                    // Set the SMTP server to send through
						    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
						    $mail->Username   = 'alignya@outlook.com';                     // SMTP username
						    $mail->Password   = 'Gisllp@123';                               // SMTP password
						    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
							$mail->SMTPSecure = 'tls';
						    //Recipients
						    $mail->setFrom('alignya@outlook.com', 'Alignya');
						    $mail->addAddress($email, $usr_name);     // Add a recipient
						     // Add a recipient
						    $mail->addReplyTo('dev.girishas@gmail.com', 'Gisllp');
						   
						    // Content
						    $mail->isHTML(true);                                  // Set email format to HTML
						    $mail->Subject = $subject;
						    $mail->Body    = $message;
						    $mail->AltBody = 'Someone want to contact you via Alignya platform. Here are the information:- Email:';
						    $mail->send();
							
						}
					// }
				}
				$update_emp_code = User::where('id',$user->id)->update(array('emp_code'=>"EMP-".$user->id."-".$createcompany->id));
				return response()->json(array("type" => "success", "url" => url('login'), "message" => getLabels('verification_link_sent_on_registered_email')));
			}
		}
	
		return view('frontend.users.register', compact('page_title','plans','yearly'));
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
					
					$mail_data  	= getEmailTemplate('forgot_password');
					
					if($mail_data){
						$number =   rand(0,100000);
                    	$varify_hash    =   base64_encode($usr_data['id'].$usr_data['emp_code'].time());
                        User::where('id', $usr_data['id'])->update(array('varify_hash'=>$varify_hash ));
                        $usr_name       = $usr_data['first_name']." ".$usr_data['last_name'];
                        // pr($usr_data['email']);
                        $email          = $usr_data['email']; 
                        $link           = config('constants.SITE_URL').'resetpassword/'.$number.'?q='.$varify_hash; 
                        $site_name      = config('constants.SITE_TITLE');
                        $admin_email    = config('constants.SITE_EMAIL'); 
						if($email){
							//if(config('constants.SITE_MODE') == 'live'){
								$message        = str_replace(array('{NAME}','{LINK}', '{SITE}'), array($usr_name, $link, $site_name),  $mail_data->template_body);
								//pr($message);
								$subject        = str_replace(array('{SITE}'), array($site_name), $mail_data->subject);

							require (base_path()."/Phpmailer/Phpmailer/vendor/autoload.php");
							$mail = new PHPMailer();                    // Enable verbose debug output
						    $mail->isSMTP();                                            // Send using SMTP
						    $mail->Host       = 'smtp-mail.outlook.com';                    // Set the SMTP server to send through
						    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
						    $mail->Username   = 'alignya@outlook.com';                     // SMTP username
						    $mail->Password   = 'Gisllp@123';                               // SMTP password
						    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
							$mail->SMTPSecure = 'tls';
						    //Recipients
						    $mail->setFrom('alignya@outlook.com', 'Alignya');
						    $mail->addAddress($email, $usr_name);     // Add a recipient
						     // Add a recipient
						    $mail->addReplyTo('dev.girishas@gmail.com', 'Gisllp');
						   
						    // Content
						    $mail->isHTML(true);                                  // Set email format to HTML
						    $mail->Subject = $subject;
						    $mail->Body    = $message;
						    $mail->AltBody = 'Someone want to contact you via Alignya platform. Here are the information:- Email:';
						    $mail->send();
						    //pr($mail);
								
							//}
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
	
	
	
	public function resetpassword($prefix=null){
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
					}elseif((Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4) and $url_prefix ==""){
						return json_encode(array("status" => "success", "header" => view('frontend/layouts/header')->render(), "navigation" => view('frontend/layouts/navigation')->render()));
					}else{
						Auth::logout();
						return json_encode(array("status" => "error", "message" => getLabels('credentials_not_valid')));
					} 
				}else {	
					return json_encode(array("status" => "error",  "message" => getLabels('incorrect_username_password')));	
				}
			}
		}
		
		return view('frontend.users.login', compact('page_title'));
	}
	
	
	
	
	public function dashboard(){
		$page_title = getLabels('Dashboard');
		$objectives_count = Objective::where('company_id',Auth::User()->company_id);
		if(Auth::User()->role_id != 2){
			$objectives_count = $objectives_count->where(function($queryW){
				$queryW->where("al_objectives.owner_user_id", Auth::User()->id)
				->orWhereRaw(DB::raw('FIND_IN_SET('.Auth::User()->id.',al_objectives.contributers) > 0'))
				->orWhere('al_objectives.user_id',Auth::User()->id);
			});	
		}
		$objectives_count = $objectives_count->count();

		$measure_count = Measure::where('company_id',Auth::User()->company_id)->where('category_type',1);
		if(Auth::User()->role_id != 2){
			$measure_count = $measure_count->where(function($queryW){
				$queryW->where("owner_user_id", Auth::User()->id)
				->orWhereRaw(DB::raw('FIND_IN_SET('.Auth::User()->id.',contributers) > 0'))
				->orWhere('user_id',Auth::User()->id);
			});	
		}
		$measure_count = $measure_count->count();
		$initiative_count = Measure::where('company_id',Auth::User()->company_id)->where('category_type',2);
		if(Auth::User()->role_id != 2){
			$initiative_count = $initiative_count->where(function($queryW){
				$queryW->where("owner_user_id", Auth::User()->id)
				->orWhereRaw(DB::raw('FIND_IN_SET('.Auth::User()->id.',contributers) > 0'))
				->orWhere('user_id',Auth::User()->id);
			});	
		}
		$initiative_count = $initiative_count->count();
		
		$kpi_count = Measure::where('company_id',Auth::User()->company_id)->where('category_type',3);
		if(Auth::User()->role_id != 2){
			$kpi_count = $kpi_count->where(function($queryW){
				$queryW->where("owner_user_id", Auth::User()->id)
				->orWhereRaw(DB::raw('FIND_IN_SET('.Auth::User()->id.',contributers) > 0'))
				->orWhere('user_id',Auth::User()->id);
			});	
		}
		$kpi_count = $kpi_count->count();
		
		$tasks_count = Tasks::where('company_id',Auth::User()->company_id)->count();
		$all_members = User::select(DB::raw('CONCAT_WS(" ",first_name,last_name) as full_name'),'id')->where('company_id',Auth::User()->company_id)->where('role_id',5)->pluck('full_name','id');
		$departments = Department::where('company_id',Auth::User()->company_id)->where('status',1)->pluck("department_name","id");
		$teamleads = User::where('role_id',4)->where('company_id',Auth::User()->company_id)->pluck('first_name','id');
		$goal_cycles = GoalCycles::where('company_id',Auth::User()->company_id)->pluck('cycle_name','id');
		$perspectives = Perspective::where('company_id',Auth::User()->company_id)->pluck('name','id');
		$contributers = User::where('company_id',Auth::User()->company_id)->pluck('first_name','id');
		$objectives = Objective::where('company_id',Auth::User()->company_id)->pluck('heading','id');
		$objlist = Objective::leftjoin('al_master_status','al_master_status.id','=','al_objectives.status')->leftjoin('al_goal_cycles','al_goal_cycles.id','=','al_objectives.cycle_id')->leftjoin('users','users.id','=','al_objectives.owner_user_id')->leftjoin('al_objectives as o','o.id','=','al_objectives.objective_id')->where('al_objectives.company_id',Auth::User()->company_id)->select('al_objectives.*','al_master_status.name as status_name','al_master_status.bg_color','o.heading as parent_objective','al_goal_cycles.cycle_name','al_master_status.icons as status_icon',DB::raw('CONCAT_WS(" ",users.first_name,users.last_name) as owner_name'))->get();
		$tasklist = Tasks::leftjoin('al_master_status','al_master_status.id','=','al_tasks.status')->where('company_id',Auth::User()->company_id)->orderBy('id','desc')->select('al_tasks.*','al_master_status.name as status_name','al_master_status.icons as status_icon','al_master_status.bg_color')->get();
		$members_count = User::count();
		$companycount = User::where('role_id',2)->count();
		$transaction_count = Subscription::count();
		if(!empty($tasklist)){
			$tasklist = $tasklist->toArray();
			foreach ($tasklist as $key => $tasks) {
				$owners = User::whereIn('id',explode(',',$tasks['owners']))->pluck('first_name');
				$tasklist[$key]['owners'] = implode(',', $owners->toArray());
			}
		}
		if(Auth::User()->role_id == 2){
			$roles = UserRoles::whereIn('id',array(2,3,4,5))->pluck('role','id');
		}elseif(Auth::User()->role_id == 3){
			$roles = UserRoles::whereIn('id',array(4,5))->pluck('role','id');
		}elseif(Auth::User()->role_id == 4){
			$roles = UserRoles::where('id',5)->pluck('role','id');
		}elseif(Auth::User()->role_id == 1){
			$roles = UserRoles::whereIn('id',array(2,3,4,5))->pluck('role','id');
		}
		return view('frontend.users.dashboard', compact('page_title','objectives_count','measure_count','initiative_count','kpi_count','all_members','departments','teamleads','goal_cycles','perspectives','contributers','objectives','objlist','tasks_count','tasklist','members_count','transaction_count','companycount','roles'));
	}
	
	
	public function logout(){
		Auth::logout();
	}
	
	
	public function admin_index(){
		$this->request->session('rejected_arr',array());
		$page_title  = getLabels("Members");		
		$data  = User::sortable()->where('users.company_id', Auth::User()->company_id)->where('users.id','!=',Auth::User()->id)->leftjoin('countries', 'countries.id', '=', 'users.country_id');
		
		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}
		
		
		if(! empty($_POST)){
			if(isset($_POST['first_name']) and $_POST['first_name'] !=''){
				$first_name = $_POST['first_name'];
				$this->request->session()->put('usearch.first_name', $first_name);
				$data = $data->where(function($queryW) use($first_name){
				$queryW->whereRaw('CONCAT_WS("",users.first_name,users.last_name) like ?', "%{$first_name}%")
				->orWhereRaw('users.email like ?',  "%{$first_name}%");
			});
				
			}
			if(isset($_POST['role_id']) and $_POST['role_id'] !=''){
				$role_id = $_POST['role_id'];
				$this->request->session()->put('usearch.role_id', $role_id);
				$data = $data->where('users.role_id',  $role_id);
			}
			if(isset($_POST['status']) and $_POST['status'] !=''){
				$status = $_POST['status'];
				$this->request->session()->put('usearch.status', $status);
				$data = $data->where('users.status', $status);
			}
		}else{
			$this->request->session()->forget('usearch');
		}
		if(Auth::User()->role_id == 2){
			$roles = UserRoles::whereIn('id',array(2,3,4,5))->pluck('role','id');
		}elseif(Auth::User()->role_id == 3){
			$roles = UserRoles::whereIn('id',array(4,5))->pluck('role','id');
		}elseif(Auth::User()->role_id == 4){
			$roles = UserRoles::where('id',5)->pluck('role','id');
		}
		
		$data  = $data->select('users.*', 'countries.name as country')->orderBy('users.created_at', 'desc')->paginate(config('constants.PAGINATION'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$page_title  = getLabels("Members");
		return view('frontend/users/admin_index', compact('data','role_id','page_title','roles'));
	}

	public function companies($role_id = null){
		$page_title  = getLabels("companies");		
		$data  = User::where('users.role_id',2)->sortable()->leftjoin('al_comp_plans','al_comp_plans.id','=','users.current_membership_plan')->leftjoin('al_companies','al_companies.id','=','users.company_id')->leftjoin('countries', 'countries.id', '=', 'users.country_id');
	
		if($this->request->session()->has('usearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('usearch');
		}else{
			$this->request->session()->forget('usearch');
		}
		
		
		if(! empty($_POST)){
			if(isset($_POST['first_name']) and $_POST['first_name'] !=''){
				$first_name = $_POST['first_name'];
				$this->request->session()->put('usearch.first_name', $first_name);
				$data = $data->whereRaw('CONCAT_WS("",al_companies.company_name,users.last_name) like ?', "%{$first_name}%");
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
		
		
		$data  = $data->select('users.*', 'countries.name as country','al_comp_plans.heading','al_comp_plans.plan_fee','al_comp_plans.period','al_companies.id as company_id','al_companies.company_name')->orderBy('users.created_at', 'desc')->paginate(config('constants.PAGINATION'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$page_title  = getLabels("companies");
		return view('frontend/users/companies', compact('data','role_id','page_title'));
	}
	
	public function company_add(){
		$page_title = "Company Add";
		if($this->request->isMethod('post')){
			$validator = User::register($this->request->all());
			if($validator->fails()){
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('please_correct_errors')]);
			}else{
				$input =$this->request->all();
				$company = array();
				$company['company_name'] = $input['company_name'];
				$company['plan_id'] = $input['plan_id'];

				$createcompany = Company::create($company);
				$data                = $this->request->except('password');
				$data['password']    = Hash::make($this->request->get('password'));
				$data['role_id']     = 2;
				$data['status']      = 0;
				$data['company_id'] = $createcompany->id;
				$data['full_name'] = $input['first_name'].' '.$input['last_name'];
				$data['user_ip'] = $_SERVER['REMOTE_ADDR'];
				$data['last_activity'] = date('Y-m-d h:i:s');
				$data['current_membership_plan'] = $input['plan_id'];
				$data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
				$data['status'] = 1;
				$data['trial_expiry_date'] = date('Y-m-d', strtotime(date('Y-m-d'). ' + '.config('constants.TRIAL_DAYS').' days'));
				$user = User::create($data);
				if($user){
					$last_id = $user->id;
					$uniq_username = User::createUsername($last_id);
					$emp_code = "EMP-".$user->id.'-'.$createcompany->id;
					$updateempcode = User::where('id',$user->id)->update(array('emp_code'=>$emp_code));
					$varify_hash = base64_encode($last_id.$uniq_username);
					User::where('id', $user->id)->update(array('varify_hash'=>$varify_hash ));
					if(config('constants.SITE_MODE') == 'live'){
						$mail_data  	=     getEmailTemplate('registration');
						if($mail_data){
							$usr_name       = $user->first_name." ".$user->last_name;
							$email          = $user->email; 
							$link           = config('constants.SITE_URL').'verify-mail?q='.$varify_hash;                       
							$site_name      = config('constants.SITE_TITLE');
							$admin_email    = config('constants.SITE_EMAIL'); 
							$message        = str_replace(array('{NAME}', '{EMAIL}', '{LINK}', '{SITE}'), array($usr_name, $email, $link, $site_name), $mail_data->template_body);
							$subject        = str_replace(array('{SITE}'), array($site_name), $mail_data->subject);
							mail($email, $subject, $message);
							//return view('frontend.my_email')->with('data',$message);
							// Mail::send('frontend.my_email', array('data'=>$message), function($message) use ($subject,$usr_name,$email, $site_name, $admin_email){
							// 	$message->from($admin_email, $site_name);
							// 	$message->to($email, $usr_name)->subject($subject);
							// }); 	
						}
					}
				}
				$update_emp_code = User::where('id',$user->id)->update(array('emp_code'=>"EMP-".$user->id."-".$createcompany->id));
				return response()->json(array("type" => "success", "url" => url(env('ADMIN_PREFIX').'/companies'), "message" => getLabels('company_update_successfully')));
			}
		}
		$plans = Plans::where('period',1)->get();
		$yearly = Plans::where('period',2)->get();
		return view('frontend/users/company_add',compact('page_title','id','plans','yearly'));

	}
	
	public function company_update($id=null){
		$page_title = "Company Update";
		$data = Company::where('al_companies.id',$id)->leftjoin('users','users.company_id','=','al_companies.id')->select('al_companies.id as company_id','al_companies.company_name','users.id as user_id','users.first_name','users.last_name','users.email','users.current_membership_plan as plan_id','users.status')->first();
		if($this->request->isMethod('post')){
			$inputs = $this->request->all();
			
			$update_company = Company::where('id',$id)->update(array('company_name'=>$inputs['company_name']));
			$update_user = User::where('id',$inputs['user_id'])->update(array('first_name'=>$inputs['first_name'],'last_name'=>$inputs['last_name'],'email'=>$inputs['email'],'status'=>$inputs['status']));
			return response()->json(array("type" => "success", "url" => url(env('ADMIN_PREFIX').'/companies'), "message" => getLabels('company_update_successfully')));	
		}
		
		return view('frontend/users/company_update',compact('page_title','data','id'));
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
			$inputs = $this->request->all();
			$inputs['status'] = 1;
			$validator = User::validateaddmember($inputs,'',Auth::User()->role_id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('please_correct_errors')]);
			} else {
				$formData              	= $this->request->except('password','photo');
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
				
				
				
				$formData['status']	= 1;
				$formData['company_id']	= Auth::User()->company_id;
				$formData['user_ip'] = $_SERVER['REMOTE_ADDR'];
				$user  = User::create($formData);
				if($user){
					return response()->json(['type' => 'success', 'url'=> url('members'), 'message' => getLabels('add_member successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url('members'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/users/admin_add', compact('data', 'countries', 'page_title'));
	}
	
	
	
	public function admin_edit($id = null){ 
		
		$data   = User::find($id);
		$page_title = getLabels("Update Member");
		$countries  = Country::where('status', 1)->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
		if($this->request->isMethod('post')){
			$validator = User::validateaddmember($this->request->all(),$id,Auth::User()->role_id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('please_correct_errors')]);
			} else {
			$formData              	= $this->request->except('photo');
			
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
			
			
			$user  = $data->update($formData);
			if($user){
					return response()->json(['type' => 'success', 'url'=> url('members'), 'message' => getLabels('update_member successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url('members'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/users/admin_edit', compact('data', 'id', 'countries', 'page_title'));
	}
	
	
	
	
	public function profile(){
		$page_title = "Profile";
		$company_details = getCompanyProfile(Auth::User()->company_id);
		$plan_details = getPlanDetails(!empty($company_details)?$company_details->plan_id:"");
		$total_members = User::where('company_id',Auth::User()->company_id)->where('id','!=',Auth::User()->id)->count();
		$total_departments = Department::where('company_id',Auth::User()->company_id)->count();
		$total_teams = Teams::where('company_id',Auth::User()->company_id)->count();
		$industries = Industries::pluck('name','id');
		if($this->request->isMethod('post')){
			$formData = $this->request->all();
			$data = Company::find(Auth::User()->company_id);
			$update = $data->update($formData);
			if($update){
				return redirect('profile');
			}else{
				return redirect('profile');
			}
		}
		return view("/frontend/users/profile",compact('page_title','company_details','plan_details','total_members','total_departments','total_teams','industries'));
	}
	public function company_view($id=null){
		$page_title = "Company Profile";
		$company_details = getCompanyProfile($id);
		$plan_details = getPlanDetails(!empty($company_details)?$company_details->plan_id:"");
		$total_members = User::where('company_id',$id)->count();
		$total_departments = Department::where('company_id',$id)->count();
		$total_teams = Teams::where('company_id',$id)->count();
		$industries = Industries::pluck('name','id');
		$total_transactions = Subscription::where('company_id',$id)->count();
		
		return view("/frontend/users/company_profile",compact('page_title','company_details','plan_details','total_members','total_departments','total_teams','industries','total_transactions'));
	}
	public function getprofiledata(){
		$company_details = getCompanyProfile(Auth::User()->company_id);
		$plan_details = getPlanDetails(!empty($company_details)?$company_details->plan_id:"");
		$total_members = User::where('company_id',Auth::User()->company_id)->count();
		$total_departments = Department::where('company_id',Auth::User()->company_id)->count();
		$total_teams = Teams::where('company_id',Auth::User()->company_id)->count();
		$industries = Industries::pluck('name','id');
		return view("/Element/users/updateprofile",compact('company_details','plan_details','total_members','total_departments','total_teams','industries'));
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
	
	
	
	
	public function change_password($id = null){
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

	public function checkemailexist(){
		$email = User::where('email',$this->request->get('email'))->first();
		if(!empty($email)){
			return json_encode(array("success"=>"true"));
		}
	}

	public function setuserdatasession(){
		$input = $this->request->all();
		$data = User::find($input['id']);
		return view('Element/users/updatemember',compact('data'));
	}

	public function viewmember(){
		$inputs = $this->request->all();
		$data = User::find($inputs['id']);
		return view('Element/users/viewmember',compact('data'));
	} 

	public function getmembers(){
		$input = $this->request->all();
		$members = User::select(DB::raw('CONCAT(users.first_name," ",IFNULL(users.last_name," ")," ( ",al_users_role.role," )") as first_name'), 'users.id')->leftjoin('al_users_role','al_users_role.id','=','users.role_id')->where('users.company_id',$input['company_id'])->pluck('first_name','users.id');
		return json_encode($members);
	}

	public function importmembers(){
		$file = $this->request->file('csv');
		$validate = User::importvalidate($this->request->all());
		if($validate->fails()){
			return redirect()->back()->with('errormessage','Please correct errors')->withErrors($validate->errors());;
		}
		$company_id = Auth::User()->company_id;
		$handle = fopen($file, "r");
		$all_members = array();
		while(($filesop = fgetcsv($handle, 1000, ",")) !== false){
			$all_members[] = $filesop; 
		}
		unset($all_members[0]);
		$error = array();
		if(!empty($all_members)){
			
			foreach ($all_members as $key => $value) {
				$varr              	= array();
				$varr['first_name'] = $value['0'];
				$varr['password'] 	= $value['3'];
				$varr['email'] 	= $value['2'];
				
				
				$validator = User::importcsv($varr);
				if ( $validator->fails() ) {
					$error[] = $value;
					continue;
				} else {
					$formData              	= array();
					$formData['first_name'] 	= $value['0'];
					$formData['last_name'] 	= $value['1'];
					$formData['email'] 	= $value['2'];
					$formData['password'] 	= Hash::make($value['3']);
					$formData['role_id'] 	= $value['4'];
					$formData['designation'] 	= $value['5'];
					$formData['mobile'] 	= $value['6'];
					$formData['company_id'] 	= $company_id;
					$formData['status'] 	= 1;
					$user  = User::create($formData);
					$empcodeupdate = User::where('id',$user->id)->update(array('emp_code'=>"EMP-".$user->id."-".$company_id));
				}
			}
			if(!empty($error)){
				return redirect()->back()->with('rejected_arr',$error);
			}else{

				return redirect()->back()->with('message','import csv successfully');
			}
		}
		
		
	}

	public function remove_member($id=null){
		$data = User::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url('members'), "message" => getLabels('member_removed'));
		}else{
			$results = array("type" => "error", "url" => url('members'), "message" => getLabels('member_not_removed'));
		}
		return json_encode($results);
	}
	
}
