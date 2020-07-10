<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\Plans;
use App\Models\Payouts;
use App\Models\UserPayment;
use App\Models\Payment;
use App\Models\LevelCommission;
use App\Models\SubscriptionPlan;
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
Class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	
	
	public function transaction_manager(){
		$page_title  = getLabels('Transactions');
		$search_sess = array();
		if ($this->request->session()->has('transactionSearch') and ((isset($_GET['page']) and $_GET['page']>=1))) {
			$_POST = $this->request->session()->get('transactionSearch');
		}else{
			$this->request->session()->forget('transactionSearch');
		}
		$data = Payment::leftjoin('subscriptions','payments.subscription_id','=','subscriptions.id');
		if(! empty($_POST)){
			if(isset($_POST['keyword']) and $_POST['keyword'] !=''){
				foreach ($_POST as $key => $value) {
					if($key =='_token') { continue; }
					if($key == 'keyword' and $value !=''){
						$data = $data->where(function($query) use($value)  {                  
							$query->orwhere('payments.profile_id', 'like', '%'.trim($value).'%');
							$query->orwhere('payments.amount', 'like', '%'.trim($value).'%');
							$query->orwhere('payments.profile_status', 'like', '%'.trim($value).'%');						 
						});
						$search_sess[$key] = $value;  
					}
				}      
				$this->request->session()->put('transactionSearch',$search_sess);
			}
			}else{
			$this->request->session()->forget('transactionSearch');
		}
		
		$data = $data->orderBy('payments.created_at', 'DESC')->select('payments.*', 'subscriptions.plan_id', 'subscriptions.transaction_id', 'subscriptions.subscriber_user_id')->paginate(config('costants.PAGINATION'));
		
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		return view('frontend/subscriptions/transaction_manager',compact('data', 'page_title'));
	}
	
	public function admin_payouts(){
		$page_title = getLabels('Payouts');
		$setting_array = Setting::pluck('value','slug');

		$data = Subscription::leftjoin('users','subscriptions.page_creater_id','=','users.id')->groupBy('subscriptions.page_creater_id')->select('subscriptions.id as subscription_id','subscriptions.*','users.first_name as first_name','users.last_name as last_name','users.payout_email as payout_email','users.uniq_username','subscriptions.page_creater_id')->whereRaw('DATE(subscriptions.last_payment_date) <= DATE_SUB(CURDATE(), INTERVAL '.$setting_array['payout_days'].' DAY)')->where('subscriptions.payout_status',0);
		
		$data = $data->orderBy('subscriptions.last_payment_date', 'DESC');
		
		$data = $data->paginate(config('constants.PAGINATION'));
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		return view('frontend/subscriptions/admin_payouts',compact('data', 'page_title'));
	}
	
	
	
	public function payout_history(){
		$page_title = getLabels('Payout_History');
		$data 	= Payouts::leftjoin('users', 'users.uniq_username', '=', 'payouts.user_id')->select('payouts.*', 'users.first_name', 'users.last_name', 'users.payout_email')->orderBy('created_at', 'DESC');	
		$data 	= $data->paginate(config('constants.PAGINATION'));
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		return view('frontend/subscriptions/payout_history',compact('data', 'page_title'));
	}
		
		
	public function payouts_amount_details($slug = null){
		$page_title = getLabels('Subscriptions');
		$user = User::where('uniq_username',$slug)->first();
		$username = $user->uniq_username;
		$setting_array = Setting::pluck('value','slug');

		$subscribed_page_ids = Subscription::where('page_creater_id', $user->id)->leftjoin('subscription_plans', 'subscription_plans.id', '=', 'subscriptions.id')->whereRaw('DATE(subscriptions.last_payment_date) <= DATE_SUB(CURDATE(), INTERVAL '.$setting_array['payout_days'].' DAY)')->where('subscriptions.payout_status',0)->pluck('subscription_plans.name', 'plan_id');
		
		$payouts = Payment::sortable()->leftjoin('subscriptions','payments.subscription_id','=','subscriptions.id')->leftjoin('users','subscriptions.subscriber_user_id','=','users.id')->select('payments.*','subscriptions.id as subscription_id','subscriptions.*','users.first_name as first_name','users.uniq_username as username','users.last_name as last_name','users.payout_email as payout_email','payments.id as payment_id')->whereRaw('DATE(subscriptions.last_payment_date) <= DATE_SUB(CURDATE(), INTERVAL '.$setting_array['payout_days'].' DAY)')->where('subscriptions.payout_status',0)->where('subscriptions.page_creater_id',$user->id);
		
		$level_array = LevelCommission::get()->toArray();
		foreach($level_array as $com){
			$level_commission[$com['level_id']] = $com;
		}
		$payouts = $payouts->orderBy('payments.created_at', 'DESC')->get();
		return view('frontend/subscriptions/payouts_amount_details',compact('payouts','subscribed_page_ids','level_commission','setting_array','username','page_title'));
	}
		
		
	public function payouttoowner($username = null){
		if($this->request->isMethod('post')){
			$validator = Payouts::validate($this->request->all());
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('payout_errors_messages')]);
			} else {
				
				$input = $this->request->all();
				$username  = $this->request->user_id;
				$user  =   User::where('uniq_username', $username)->first();
				$setting_array = Setting::pluck('value','slug');
				
				$subscriptionIds 	= Subscription::where('page_creater_id', $user->id)->whereRaw('DATE(subscriptions.created_at) <= DATE_SUB(CURDATE(), INTERVAL '.$setting_array['payout_days'].' DAY)')->where('subscriptions.payout_status',0)->pluck('id')->toArray();
				$subscriptionIdss 	= implode(',', $subscriptionIds);
				$profileIds 		= Payment::whereIn('subscription_id', $subscriptionIds)->pluck('profile_id')->toArray();
				$profileIdss 		= implode(',', $profileIds);
				
				$input['user_id'] = $username;
				
				$input['payment_status'] = "Success";
				$input['subscription_ids'] = $subscriptionIdss;
				$input['profile_ids'] = $profileIdss;
				$create = Payouts::create($input);
				
				if($create){
					$updateSub = Subscription::whereIn('id', $subscriptionIds)->update(array('payout_status' => 1));
					$updatePay = Payment::whereIn('profile_id', $profileIds)->update(array('payout_status' => 1));
					/* if(config('constants.SITE_MODE')=='live' && $user->email){
						$usr_name       = $user->first_name." ".$user->last_name;
						$email          = $user->email; 
						$link           = config('constants.SITE_URL'); 
						$site_name      = config('constants.SITE_TITLE');
						$admin_email    = config('constants.SITE_EMAIL'); 
						$helplink       = config('constants.SITE_URL').'help';
						$privacy_policy = config('constants.SITE_EMAIL').'privacy_policy'; 
						$about_us   = config('constants.SITE_EMAIL').'about_us';
						$message        = str_replace(array('{NAME}', '{EMAIL}', '{LINK}', '{SITE}','{helplink}','{privacy_policy}','{about_us}'), array($usr_name, $email, $link, $site_name,$helplink,$privacy_policy,$about_us), getLabel('payout_email',true));
						$subject        = str_replace(array('{SITE}'), array($site_name), getLabel('payout_receipt',true));
						
						Mail::send('frontend.my_email_payout', array('payouts'=>$payouts,'setting_array'=>$setting_array,'payouts'=>$payouts,'level_commission'=>$level_commission,'subscribed_page_ids'=>$subscribed_page_ids), function($message) use ($subject,$usr_name,$email, $site_name, $admin_email){
							$message->from($admin_email, $site_name);
							$message->to($email, $usr_name)->subject($subject);
						});
					} */
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'payout-history'), 'message' => getLabels('payout_created_successfully')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX').'/payout-amount-detail/'.$username), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
	}
	
	
	
	public function payout_history_detail($id=null){
		$page_title      = getLabels('payout_history_detail');
		$subscriptionsArr 		= Payouts::where('id', $id)->first();
		$subscriptionsIds 		= explode(',', $subscriptionsArr->subscription_ids);
		$setting_array 			= Setting::pluck('value','slug');
		
		$data = Payment::leftjoin('subscriptions','payments.subscription_id','=','subscriptions.id')->leftjoin('users','subscriptions.subscriber_user_id','=','users.id')->select('payments.*','subscriptions.id as subscription_id','subscriptions.*','users.first_name as first_name','users.uniq_username as username','users.last_name as last_name','users.payout_email as payout_email','payments.id as payment_id')->where('subscriptions.payout_status',1)->whereIn('subscriptions.id',$subscriptionsIds);
		
		$level_array = LevelCommission::get()->toArray();
		foreach($level_array as $com){
			$level_commission[$com['level_id']] = $com;
		}
		$data = $data->orderBy('payments.created_at', 'DESC')->get();
		return view('frontend/subscriptions/payout_history_detail',compact('data', 'level_commission','setting_array', 'page_title'));			
	}
	
	
	
	public function admin_subscriptions(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		if($this->request->session()->has('msearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('msearch');
		}else{
			$this->request->session()->forget('msearch');
		}
		
		$data  = Subscription::sortable();
		
		if(! empty($_POST)){
			if(isset($_POST['transaction_id']) and $_POST['transaction_id'] !=''){
				$transaction_id = $_POST['transaction_id'];
				$this->request->session()->put('msearch.transaction_id', $transaction_id);
				$data = $data->whereRaw('subscriptions.transaction_id like ?', "%{$transaction_id}%");
			}
			
			if(isset($_POST['page_creater_id']) and $_POST['page_creater_id'] !=''){
				$page_creater_id = $_POST['page_creater_id'];
				$this->request->session()->put('msearch.page_creater_id', $page_creater_id);
				$data = $data->whereRaw('subscriptions.page_creater_id like ?', "%{$page_creater_id}%");
			}
		}else{
			$this->request->session()->forget('msearch');
		}

		$data  = $data->paginate(config('constants.PAGINATION'));
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$page_title      = getLabels('Subscriptions');
		return view('frontend/subscriptions/admin_subscriptions',compact('data', 'page_title'));
	}

	public function admin_add_subscriptions(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = array();
		
		$page_title = "Add Subscription";
		if($this->request->isMethod('post')){
			$validator = Subscription::validate($this->request->all());
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => 'Subscription could not be created, Please correct errors.']);
			} else {
				$formData = $this->request->all();
				
				$page  = Subscription::create($formData);
				if($page){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'subscriptions'), 'message' => 'Label has been created successfully.']);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'subscriptions'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/subscriptions/admin_add_subscriptions', compact('data', 'page_title'));
	}

	public function admin_edit_subscriptions($id = null){ 
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data   = Subscription::find($id);
		$page_title = "Update Subscription";
		if($this->request->isMethod('post')){
			$validator = Subscription::validate($this->request->all(), $id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => 'Subscription could not be updated, Please correct errors.']);
			} else {
				$formData = $this->request->all();

				$user  = $data->update($formData);
				if($user){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'subscriptions'), 'message' => 'Subscription information has been updated successfully.']);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'subscriptions'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/subscriptions/admin_edit_subscriptions', compact('data', 'id',  'page_title'));
	}

	public function admin_remove($id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = Subscription::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'subscriptions'), "message" => 'Subscription has been removed successfully.');
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'subscriptions'), "message" => 'Subscription could not be removed, please try again.');
		}
		return json_encode($results);
	}


	public function admin_subscriptionlevel(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		if($this->request->session()->has('rsearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('rsearch');
		}else{
			$this->request->session()->forget('rsearch');
		}
		
		$data  = LevelCommission::sortable();
		
		if(! empty($_POST)){
			if(isset($_POST['fees']) and $_POST['fees'] !=''){
				$fees = $_POST['fees'];
				$this->request->session()->put('rsearch.fees', $fees);
				$data = $data->whereRaw('fees like ?', "%{$fees}%");
			}
			
			if(isset($_POST['fixed_amount']) and $_POST['fixed_amount'] !=''){
				$fixed_amount = $_POST['fixed_amount'];
				$this->request->session()->put('rsearch.fixed_amount', $fixed_amount);
				$data = $data->whereRaw('fixed_amount like ?', "%{$fixed_amount}%");
			}
		}else{
			$this->request->session()->forget('rsearch');
		}

		$data  = $data->paginate(config('constants.PAGINATION'));
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		$page_title      = getLabels('Subscription_Level');
		return view('frontend/subscriptionlevel/admin_subscriptionlevel',compact('data', 'page_title'));
	}

	public function admin_add_subscriptionlevel(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = array();
		$page_title = getLabels('add_subscription_level');
		if($this->request->isMethod('post')){
			$validator = LevelCommission::validate($this->request->all());
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('subscription_level_saved_errors')]);
			} else {
				$formData = $this->request->all();

				
				$page  = LevelCommission::create($formData);
				if($page){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'subscriptionlevel'), 'message' => getLabels('subscription_level_saved')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'subscriptionlevel'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/subscriptionlevel/admin_add_subscriptionlevel', compact('data', 'page_title'));
	}


	public function admin_edit_subscriptionlevel($id = null){ 
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data   = LevelCommission::find($id);
		$page_title = getLabels('update_subscription_level');
		
		if($this->request->isMethod('post')){
			$validator = LevelCommission::validate($this->request->all(), $id);
			
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('subscription_level_saved_errors')]);
			} else {
				$formData = $this->request->all();

				$user  = $data->update($formData);
				if($user){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'subscriptionlevel'), 'message' => getLabels('subscription_level_saved')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'subscriptionlevel'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/subscriptionlevel/admin_edit_subscriptionlevel', compact('data', 'id',  'page_title'));
	}

	public function admin_remove_subscriptionlevel($id = null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		$data = LevelCommission::destroy($id);
		if($data){
			$results = array("type" => "success", "url" => url(env('ADMIN_PREFIX'), 'subscriptionlevel'), "message" => 'Subscription has been removed successfully.');
		}else{
			$results = array("type" => "error", "url" => url(env('ADMIN_PREFIX'), 'subscriptionlevel'), "message" => 'Subscription could not be removed, please try again.');
		}
		return json_encode($results);
	}
	
	
	
	
	
	/*************************************/
	
	public function subscription_plans(){	
		$page_title = getLabels('Subscription_Plans');
		$data = SubscriptionPlan::where('user_id', Auth::id())->get();
		return view('frontend/subscriptions/subscription_plans',compact('data', 'page_title'));
	}

	
	
	public function add_subscription_plan($id=null){
		if(Auth::User()->is_complete_profile != 1){
			return redirect('subscription-plans');
		}
		require (base_path()."/stripe-php/init.php");
		\Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
			
		$input = array();
		$data = array();
		$page_title = getLabels('create_new_plan');
		if($id){
			$data = SubscriptionPlan::find($id);
		}
		if($this->request->isMethod('post')){
			$input 				= $this->request->except('image');
			$input['user_id'] 	= Auth::id();
			$validator 			= SubscriptionPlan::validate($input, $id);				
			if($validator->fails()){
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('plan_saved_errors')]);
			}else{
				if ( $this->request->image){
					$image = head(Slim::getImages('image'));
					
					if ( isset($image['output']['data']) ){
						if($id and !empty($data->image) and file_exists('public/upload/plans/'.$image)){
							unlink('public/upload/plans/'.$image);
						}
						$name = $image['output']['name'];

						$dataImage = $image['output']['data'];

						$path = base_path() . '/public/upload/plans/';

						$file = Slim::saveFile($dataImage, $name, $path);
						
						$input['image'] 	= $file['name'];
					}
				}
				
				
				
				
				if($id){
					$plan = $data->update($input);
				}else{
					$plan = SubscriptionPlan::create($input);
					$id   = $plan->id;
				}
				
				$exist_plan = Plans::where(array('subscription_plan_id' => $id, 'level_id'=>$input['level_id'], 'price'=>$input['price']))->first();
				if(!empty($exist_plan)){
					$exist_plan_id = $exist_plan->plan_id;
					$p = \Stripe\Plan::retrieve($exist_plan_id);
					$p->nickname = $input['name']; 
					$p->save();
					Plans::where('id', $exist_plan->id)->update(array('plan_name'=>$input['name']));
				}else{
					$create_plan_stripe = \Stripe\Plan::create([
									  "amount" => $input['price']*100,
									  "interval" => "month",
									  "product" => config('constants.PAGE_PRODUCT_ID'),
									  'nickname' => $input['name'],
									  "currency" => "usd",
									]);
					$productPlan = array();
					
					$productPlan['product_id'] = config('constants.PAGE_PRODUCT_ID');
					$productPlan['plan_name'] = $input['name'];
					$productPlan['plan_id'] = $create_plan_stripe->id;
					$productPlan['price'] = $input['price'];
					$productPlan['type'] = 2;
					$productPlan['subscription_plan_id'] = $id;
					$productPlan['level_id'] = $input['level_id'];
					Plans::create($productPlan);
				}
				if($plan){
					return response()->json(['type' => 'success', 'url'=> url('subscription-plans'), 'message' => getLabels('plan_saved')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url('subscription-plans'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		return view('frontend/subscriptions/add_subscription_plan',compact('data','id','page_title'));
	}
	
	
	
	
	public function subscription_list($slug=null, $id=null){
		$page_title = getLabels('My_Subscriptions');
		
		$search_sess = array();
		if ($this->request->session()->has('mysubsearch') and ((isset($_GET['page']) and $_GET['page']>=1))) {
			$_POST = $this->request->session()->get('mysubsearch');
		}else{
			$this->request->session()->forget('mysubsearch');
		}
		$data = Subscription::where('subscriber_user_id', Auth::id())->leftjoin('users', 'subscriptions.page_creater_id','=','users.id')->leftjoin('payments', 'subscriptions.id','=','payments.subscription_id')->leftjoin('subscription_plans', 'subscriptions.plan_id','=','subscription_plans.id')->select('subscriptions.*', 'users.first_name','users.first_name','users.uniq_username','payments.amount','payments.profile_id','subscription_plans.name as plan_name');
		if(!empty($_POST)){
			foreach ($_POST as $key => $value) {
				if($key =='_token') { continue; }
				if($key == 'keyword' and $value !=''){
					$data = $data->where(function($query) use($value)  {                    
						$query->orwhere('subscriptions.transaction_id',$value);
						$query->orwhere('users.first_name', 'like', '%'.trim($value).'%');
						$query->orwhere('users.last_name', 'like', '%'.trim($value).'%');  
					});
					$search_sess[$key] = $value;  
				}
			}
			
			$this->request->session()->put('mysubsearch',$search_sess);
		}
		$data = $data->orderBy('subscriptions.created_at', 'DESC');
		$data = $data->paginate(config('costants.PAGINATION'));
		
		return view('frontend/subscriptions/my_subscriptions',compact('data', 'page_title'));
		
	}
	
	
	
	
	public function transaction_history(){
		$slug = "transaction";
		$page_title = getLabels('Transaction_History');
		$search_sess = array();
		if ($this->request->session()->has('transactionSearch') and ((isset($_GET['page']) and $_GET['page']>=1))) {
			$_POST = $this->request->session()->get('transactionSearch');
		}else{
			$this->request->session()->forget('transactionSearch');
		}
		$data = Payment::where('user_id', Auth::id())->leftjoin('subscriptions','payments.subscription_id','=','subscriptions.id');
		if(! empty($_POST)){
			if(isset($_POST['keyword']) and $_POST['keyword'] !=''){
				foreach ($_POST as $key => $value) {
					if($key =='_token') { continue; }
					if($key == 'keyword' and $value !=''){
						$data = $data->where(function($query) use($value)  {                  
							$query->orwhere('payments.profile_id', 'like', '%'.trim($value).'%');
							$query->orwhere('payments.amount', 'like', '%'.trim($value).'%');
							$query->orwhere('payments.profile_status', 'like', '%'.trim($value).'%');						 
						});
						$search_sess[$key] = $value;  
					}
				}      
				$this->request->session()->put('transactionSearch',$search_sess);
			}
		}else{
			$this->request->session()->forget('transactionSearch');
		}
		$data = $data->orderBy('payments.created_at', 'DESC');
		$data = $data->select('payments.*', 'subscriptions.plan_id', 'subscriptions.transaction_id', 'subscriptions.subscriber_user_id')->paginate(config('costants.PAGINATION'));			
		if(isset($_GET['s']) and $_GET['s']){
			$data->appends(array('s' => $_GET['s'],'o'=>$_GET['o']))->links();
		}
		
		return view('frontend/subscriptions/transaction_history',compact('data','page_title','slug'));
	}
	
	
	
	
	public function my_channel_subscriptions($id=null){
		$page_title = getLabels('My_Channel_Subscriptions');
		
		$search_sess = array();
		if ($this->request->session()->has('subsearch') and ((isset($_GET['page']) and $_GET['page']>=1))) {
			$_POST = $this->request->session()->get('subsearch');
		}else{
			$this->request->session()->forget('subsearch');
		}
		$data = Subscription::sortable()->where('page_creater_id', Auth::id())->where('subscriptions.status', 1)->leftjoin('users', 'subscriptions.subscriber_user_id','=','users.id')->leftjoin('payments', 'subscriptions.id','=','payments.subscription_id')->leftjoin('subscription_plans', 'subscriptions.plan_id','=','subscription_plans.id')->select('subscriptions.*', 'users.first_name as subscriber_first_name','users.last_name as subscriber_last_name','payments.amount','subscription_plans.name as plan_name');
			
		if(!empty($_POST)){
			foreach ($_POST as $key => $value) {
				if($key =='_token') { continue; }
				if($key == 'keyword' and $value !=''){
					$data = $data->where(function($query) use($value)  {                    
						$query->orwhere('subscriptions.id',$value);
						$query->orwhere('subscriptions.transaction_id',$value);
						$query->orwhere('users.subscriber_first_name', 'like', '%'.trim($value).'%');
						$query->orwhere('users.subscriber_last_name', 'like', '%'.trim($value).'%');  
					});
					$search_sess[$key] = $value;  
				}
			}
			
			$this->request->session()->put('subsearch',$search_sess);
		}
		$data = $data->orderBy('subscriptions.created_at', 'DESC');
		$data = $data->paginate(config('costants.PAGINATION'));
		return view('frontend/subscriptions/my_channel_subscriptions',compact('data', 'page_title'));
	}
	
	
	public function subscriptions($username = null){
		$user  = User::where('uniq_username', $username)->first();
		
		if(!empty($user->id)){
			
			$page_title = str_singular(getLabels('Subscription_Plans'))." : ".$user->first_name." ".$user->last_name;
			$data = SubscriptionPlan::where('user_id', $user->id)->get();	
			if($data){
				$data = $data->toArray();
			}
			return view('frontend/subscriptions/subscriptions', compact('data', 'user', 'username', 'page_title'));
		}else{
			return redirect('dashboard');
		}
	}
	
	
	
	public function payment_subscribe($username=null){
		$userDetails = UserPayment::where('user_id', Auth::id())->first();
		/* $cardDetails = UserCard::where('user_id',Auth::User()->username)->get();
		if(!empty($cardDetails)){
			$cardDetails = $cardDetails->toArray();
		} */ 
		if(!empty($userDetails)){
			$userDetails = $userDetails->toArray();
		} 
		$page_title = getLabels('billing_and_payment_details'); 
		if($this->request->isMethod('post')){
			$plan_id = $this->request->plan_id;
			$user_id =  $this->request->user_id;
			$level = $this->request->level;
			$amount = $this->request->amount;
			$this->request->session()->put('plan_id', $plan_id);
			$this->request->session()->put('user_id', $user_id);
			$this->request->session()->put('level', $level);
			$this->request->session()->put('amount', $amount);
			return response()->json(['type' => 'success', 'url'=> url($username.'/payment-subscribe'), 'message' => '']);
		}
		$plan_id = $this->request->session()->get('plan_id');
		$user_id = $this->request->session()->get('user_id');
		$level = $this->request->session()->get('level');
		$amount = $this->request->session()->get('amount');		
		return view('frontend/subscriptions/subscription_payment', compact('page_title', 'username', 'userDetails', 'plan_id','user_id','level','amount'));
	}
	
	
	
	
	public function procced_success($prifix=null){
		if (!empty($_REQUEST)) {
			$plan_id = $this->request->session()->get('plan_id');
			$user_id = $this->request->session()->get('user_id');
			$level = $this->request->session()->get('level');
			$amount = $this->request->session()->get('amount');	
		
			$checkAlreadySubscribe = checkAlreadySubscribe($user_id);
			$del_sub_id = $checkAlreadySubscribe['id'];
			//gs($del_sub_id);
			$subscription = array();
			$subscription['transaction_id'] = $_REQUEST['tx'];
			$subscription['page_creater_id'] = $user_id;
			$subscription['subscriber_user_id'] = Auth::user()->id;
			$subscription['payment_gateway'] = 1;
			
			$subscription['plan_id'] = $plan_id;
			$subscription['level'] = $level;
			$subscription['last_payment_date'] = date('Y-m-d H:i:s'); //gmdate("Y-m-d\TH:i:s\Z");
			$subscription['status'] = 1;
			
			$createSubscription  = Subscription::create($subscription);
			$subscription_id	 = $createSubscription->id;
			$subscriber_user_id  = $createSubscription->subscriber_user_id;
			$transactionId 		 = $createSubscription->transaction_id;
			$nvpString 			 = "&TRANSACTIONID=$transactionId";
			$getTransactionDetail = $this->getTransactionDetailTranId('GetTransactionDetails',$nvpString);
			
			//pr($getTransactionDetail); die;
			$createpayment = array();
			$createPayment['profile_id'] 		= isset($getTransactionDetail['SUBSCRIPTIONID'])?urldecode($getTransactionDetail['SUBSCRIPTIONID']):"";
			$createPayment['email'] 	 		= isset($getTransactionDetail['EMAIL'])?urldecode($getTransactionDetail['EMAIL']):"";
			$createPayment['profile_status'] 	= isset($getTransactionDetail['PAYMENTSTATUS'])?$getTransactionDetail['PAYMENTSTATUS']:"failed";
			$createPayment['payment_dump'] 		= json_encode($getTransactionDetail);
			$createPayment['user_id'] 			= $user_id;
			$createPayment['subscription_id'] 	= $subscription_id;
			$createPayment['amount'] 			= isset($getTransactionDetail['SUBSCRIPTIONID'])?urldecode($getTransactionDetail['AMT']):0;
			$createPayment['acknowledge'] 		= 'success';
			$createPaymentDB 					= Payment::create($createPayment);	
			
			if($createPaymentDB){
				if(!empty($del_sub_id)){
					$data = Subscription::find($del_sub_id);
					if($data->payment_gateway==1){
						$payment_id = Payment::where('subscription_id',$data->id)->first();
						//gs($payment_id['profile_id']);
						$profileId = urlencode($payment_id->profile_id);
						$profileStatus = urlencode('Cancel');
						$nvpStr = "&PROFILEID=$profileId&ACTION=$profileStatus";
						$httpParsedResponseAr = $this->paypal_cancel_subscription('ManageRecurringPaymentsProfileStatus', $nvpStr);
						if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])){
							$update = $data->update(array('status'=>0));
							$paymentupdate = $payment_id->update(array('profile_status'=>'Canceled'));
						}	
						}else{
						require (base_path()."/stripe-php/init.php");
						$payment_id = Payment::where('subscription_id',$data->id)->first();
						$profileId = $payment_id->profile_id;							
						\Stripe\Stripe::setApiKey("sk_test_iDKP0iFpLRKRWEpv6AFf0IbV");
						$sub = \Stripe\Subscription::retrieve($profileId);
						$cancel = $sub->cancel();
						if($cancel){
							$update = $data->update(array('status'=>0));
							$paymentupdate = $payment_id->update(array('profile_status'=>$cancel->status));
						}
					}
					
				}
				
				$this->request->session()->forget('user_id');
				$this->request->session()->forget('level');
				$this->request->session()->forget('amount');
				$this->request->session()->forget('plan_id');
			}
			
			$planArr        = SubscriptionPlan::find($plan_id);
			$plan_name      = !empty($planArr->name)?$planArr->name:"";
				
			$mail_data  	= getEmailTemplate('subscription-receipt');
			
			if($mail_data && !empty($getTransactionDetail['EMAIL']) && urldecode($getTransactionDetail['EMAIL'])){
				$usr_name       = Auth::User()->first_name." ".Auth::User()->last_name;
				$email          = urldecode($getTransactionDetail['EMAIL']); 
				$link           = config('constants.SITE_URL'); 
				$site_name      = config('constants.SITE_TITLE');
				$admin_email    = config('constants.SITE_EMAIL'); 
				$helplink       = config('constants.SITE_URL').'help';
				$privacy_policy = config('constants.SITE_URL').'privacy_policy'; 
				$about_us       = config('constants.SITE_URL').'about_us';
				
				$message        = str_replace(array('{NAME}', '{SITE}', '{SUBSCRIPTION_ID}', '{AMOUNT}', '{PLAN_NAME}'), array($usr_name, $site_name, urldecode($getTransactionDetail['SUBSCRIPTIONID']),urldecode($getTransactionDetail['AMT']), $plan_name), $mail_data['content']);
				$subject 		= str_replace(array('{SITE}'), array($site_name), $mail_data['subject']);
				
				try{
					Mail::send('frontend.my_email', array('data'=>$message), function($message) use ($subject,$usr_name,$email, $site_name, $admin_email){
						$message->from($admin_email, $site_name);
						$message->to($email, $usr_name)->subject($subject);
					});	
				}catch(\Exception $e){
					// Get error here
				}
			}
			
			$adminemail = User::where('role_id',1)->first();
			$user = User::where('id', $this->request->session()->get('user_id'))->first();
			
			$mail_data  	=     getEmailTemplate('subscription-receipt-owner');
			if($mail_data and !empty($user->email)){									
				$usr_name       = $user->first_name." ".$user->last_name;
				$email          = $user->email; 
				$link           = config('constants.SITE_URL'); 
				$site_name      = config('constants.SITE_TITLE');
				$admin_email    = config('constants.SITE_EMAIL'); 
				$helplink       = config('constants.SITE_URL').'help';
				$privacy_policy = config('constants.SITE_EMAIL').'privacy_policy'; 
				$about_us   = config('constants.SITE_EMAIL').'about_us';
				
				$message        = str_replace(array('{NAME}', '{SITE}', '{SUBSCRIPTION_ID}', '{AMOUNT}', '{PLAN_NAME}', '{CUSTMER_EMAIL}'), array($usr_name, $site_name, urldecode($getTransactionDetail['SUBSCRIPTIONID']),urldecode($getTransactionDetail['AMT']), $plan_name,urldecode($getTransactionDetail['EMAIL'])), $mail_data['content']);
				$subject 		= str_replace(array('{SITE}'), array($site_name), $mail_data['subject']);
				
				try{
					Mail::send('frontend.my_email', array('data'=>$message), function($message) use ($subject,$usr_name,$email, $site_name, $admin_email){
						$message->from($admin_email, $site_name);
						$message->to($email, $usr_name)->subject($subject);
					}); 
				}catch(\Exception $e){
					// Get error here
				}
			}
			
			$mail_data  	=     getEmailTemplate('subscription-receipt-owner');
			if($mail_data && !empty($adminemail->email)){									
				$usr_name       = $adminemail->first_name." ".$adminemail->last_name;
				$email          = $adminemail->email; 
				$link           = config('constants.SITE_URL'); 
				$site_name      = config('constants.SITE_TITLE');
				$admin_email    = config('constants.SITE_EMAIL'); 
				$helplink       = config('constants.SITE_URL').'help';
				$privacy_policy = config('constants.SITE_EMAIL').'privacy_policy'; 
				$about_us   = config('constants.SITE_EMAIL').'about_us';
				
				$message        = str_replace(array('{NAME}', '{SITE}', '{SUBSCRIPTION_ID}', '{AMOUNT}', '{PLAN_NAME}', '{CUSTMER_EMAIL}'), array($usr_name, $site_name, urldecode($getTransactionDetail['SUBSCRIPTIONID']),urldecode($getTransactionDetail['AMT']), $plan_name,urldecode($getTransactionDetail['EMAIL'])), $mail_data['content']);
				$subject 		= str_replace(array('{SITE}'), array($site_name), $mail_data['subject']);
				
				try{
					Mail::send('frontend.my_email', array('data'=>$message), function($message) use ($subject,$usr_name,$email, $site_name, $admin_email){
						$message->from($admin_email, $site_name);
						$message->to($email, $usr_name)->subject($subject);
					}); 
				}catch(\Exception $e){
					// Get error here
				}
				
			}
			
			return redirect('my-subscriptions')->with('success', getLabels('payment_successfully_done'));
		}
	}
	
	
	
	
	public function getTransactionDetailTranId($methodName_, $nvpStr_){
		$msg ="";
		$site_settings 	= config('constants.SiteValue');
		$environment 	= (isset($site_settings['paypal_mode']) and $site_settings['paypal_mode'])?$site_settings['paypal_mode']:'';
		$API_UserName 	= (isset($site_settings['paypal_api_username']) and $site_settings['paypal_api_username'])?$site_settings['paypal_api_username']:'';
		$API_Password 	= (isset($site_settings['paypal_api_password']) and $site_settings['paypal_api_password'])?$site_settings['paypal_api_password']:'';
		$API_Signature 	= (isset($site_settings['paypal_api_signature']) and $site_settings['paypal_api_signature'])?$site_settings['paypal_api_signature']:'';			
		$API_Endpoint 	= "https://api-3t.paypal.com/nvp";		
		$API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
		if("sandbox" === $environment || "beta-sandbox" === $environment) {
			$API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
		}	
		
		$version = urlencode('76.0');			
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		
		$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
		//gs($nvpreq);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		
		$httpResponse = curl_exec($ch);			
		//gs($httpResponse);
		if(!$httpResponse) {
			$msg = ("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
		}		
		$httpResponseAr = explode("&", $httpResponse);
		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}		
		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
			$msg = getLabels('invalid_response_for_payment'); 
		}			
		if($msg){
			return redirect('payout-subscription')->with('type', 'errormessage')->with('message', $msg);
		}			
		return $httpParsedResponseAr;
		
	}
	
	
	
	
	
	/***************************************************S*****************/
	
	public function payout_subscription($prifix=null){	
		
		$plan_id = $this->request->session()->get('plan_id');
		$user_id = $this->request->session()->get('user_id');
		$level = $this->request->session()->get('level');
		$amount = $this->request->session()->get('amount');	
			
		//if(config('constants.SITE_MODE')=='live'){
			require (base_path()."/stripe-php/init.php");
		//}	
		\Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
		$input = array();
		$checkAlreadySubscribe = checkAlreadySubscribe($user_id);
		$del_sub_id = !empty($checkAlreadySubscribe['id'])?$checkAlreadySubscribe['id']:"";
		
		if($this->request->isMethod('post')){			
			$input = $this->request->all();
			//gs($input);
			$validator = Subscription::validate_subscribe($input);
			if($validator->fails()){
				//return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => 'Please correct errors.']);
				$this->request->session()->flash('error', "Please correct errors.");
				return back()->withErrors($validator)->withInput($input);
			}else{
				$checkcustomeridexist = User::where('id', Auth::id())->value('stripe_customer_id');
				if($checkcustomeridexist){
					$customer_id = $checkcustomeridexist;
				}else{
					$customer = \Stripe\Customer::create(array(
						'email' => $input['email'],
						'source'  => $input['stripeToken']
					));
					$customer_id = $customer->id;				
				}	
				$updatecustomerid = User::where('id', Auth::id())->update(array('stripe_customer_id'=>$customer_id));
				$subscription = \Stripe\Subscription::create(array(
					'customer' => $customer_id,
					'items' => array(array('plan' => $input['plan'])),
				));
				$ts = $subscription->current_period_end;
				$last_payment_date = date('Y-m-d h:i:s', $ts);
				
				$savesubscription = array();
				$payment = array();
				$userInfo = array();
				$plan_id = $input['subscription_plan_id'];
				$user_id = $input['page_creater_id'];
				$level = $input['level'];
				$amount = $input['plan_price'];	
				$checkAlreadySubscribe = checkAlreadySubscribe($user_id);
				$del_sub_id = !empty($checkAlreadySubscribe['id'])?$checkAlreadySubscribe['id']:"";
		
				$savesubscription['subscriber_user_id']    	= $userInfo['user_id'] = $payment['user_id'] = Auth::id();
				//$pagetype = $savesubscription['page_type'] 	= $input['page_type'];
				$savesubscription['plan_id'] 			   	= $input['subscription_plan_id'];			
				$savesubscription['page_creater_id']       	= $input['page_creater_id'];			
				$savesubscription['level']				   	= $input['level'];			
				$savesubscription['payment_gateway'] 		= 0;			
				$savesubscription['subscriber_user_id'] 	= Auth::id();	
				
				$savesubscription['status'] 				= 1;
				$savesubscription['transaction_id'] 		= $customer_id;
				$savesubscription['last_payment_date'] 		= $last_payment_date;
				$subscriptioncreate 						= Subscription::create($savesubscription);
				
				$profileId = $subscription->id;
				$payment['profile_id'] = $profileId;
				$payment['profile_status'] = $subscription->status;
				$payment['payment_dump'] = json_encode($subscription);
				$payment['email'] = $input['email'];
				$payment['subscription_id'] = $subscriptioncreate->id;
				$payment['amount'] = $input['plan_price'];
				$payment['acknowledge'] = 'success';
				$payment_success = Payment::create($payment);
				
				$userInfo['payer_email'] = $input['email']; 
				$userInfo['first_name'] = $input['first_name'];
				$userInfo['last_name'] = $input['last_name'];
				$userInfo['address_street'] = $input['street'];
				$userInfo['address_city'] = $input['city'];
				$userInfo['address_state'] = $input['state'];
				$userInfo['address_zip'] = $input['zipcode']; 
				$userInfo['address_country_code'] = $input['country_code'];
				$UserDetailVerify = UserPayment::where('user_id',Auth::User()->username)->first();
				if(!empty($UserDetailVerify)){
					$UserDetailVerify = $UserDetailVerify->update($userInfo);	
				}else{
					$userDetailSave = UserPayment::create($userInfo);
				}
			
				if($payment_success){
					
					if(!empty($del_sub_id)){
						$data = Subscription::find($del_sub_id);
						
						if($data->payment_gateway==1){
							$payment_id = Payment::where('subscription_id',$data->id)->first();
							//gs($payment_id['profile_id']);
							$profileId = urlencode($payment_id->profile_id);
							$profileStatus = urlencode('Cancel');
							$nvpStr = "&PROFILEID=$profileId&ACTION=$profileStatus";
							$httpParsedResponseAr = $this->paypal_cancel_subscription('ManageRecurringPaymentsProfileStatus', $nvpStr);
							if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])){
								$update = $data->update(array('status'=>0));
								$paymentupdate = $payment_id->update(array('profile_status'=>'Canceled'));
							}	
						}else{
							$payment_id = Payment::where('subscription_id',$data->id)->first();
							$profileId = $payment_id->profile_id;							
							\Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
							$sub = \Stripe\Subscription::retrieve($profileId);
							$cancel = $sub->cancel();
							if($cancel){
								$update = $data->update(array('status'=>0));
								$paymentupdate = $payment_id->update(array('profile_status'=>$cancel->status));
							}
						}
						
					}
				}
				
				return redirect('my-subscriptions')->with('success', getLabels('payment_successfully_done'));
			}
		}
	}
	
		
		
	public function unsubscribe($prifix=null, $id){
		require (base_path()."/stripe-php/init.php"); 
		$data = Subscription::find($id);
		if($data->payment_gateway==1){
			$payment_id = Payment::where('subscription_id',$data->id)->first();
			//gs($payment_id['profile_id']);
			$profileId = urlencode($payment_id->profile_id);
			$profileStatus = urlencode('Cancel');
			$nvpStr = "&PROFILEID=$profileId&ACTION=$profileStatus";
			$httpParsedResponseAr = $this->paypal_cancel_subscription('ManageRecurringPaymentsProfileStatus', $nvpStr);
			if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])){
				$update = $data->update(array('status'=>0));
				$paymentupdate = $payment_id->update(array('profile_status'=>'Canceled'));
			}	
		}else{
			$payment_id = Payment::where('subscription_id', $data->id)->first();
			$profileId = $payment_id->profile_id;							
			\Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
			$sub = \Stripe\Subscription::retrieve($profileId);
			$cancel = $sub->cancel();
			if($cancel){
				$update = $data->update(array('status'=>0));
				$paymentupdate = $payment_id->update(array('profile_status'=>$cancel->status));
			}
		}
		return "success";
	}
	
	
	
	public function paypal_cancel_subscription($methodName_, $nvpStr_) {			
		$msg ="";
		$site_settings 	= config('constants.SiteValue');
		$environment 	= (isset($site_settings['paypal_mode']) and $site_settings['paypal_mode'])?$site_settings['paypal_mode']:'';
		$API_UserName 	= (isset($site_settings['paypal_api_username']) and $site_settings['paypal_api_username'])?$site_settings['paypal_api_username']:'';
		$API_Password 	= (isset($site_settings['paypal_api_password']) and $site_settings['paypal_api_password'])?$site_settings['paypal_api_password']:'';
		$API_Signature 	= (isset($site_settings['paypal_api_signature']) and $site_settings['paypal_api_signature'])?$site_settings['paypal_api_signature']:'';			
		$API_Endpoint 	= "https://api-3t.paypal.com/nvp";	
		$API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
		if("sandbox" === $environment || "beta-sandbox" === $environment) {
			
			$API_Endpoint = "https://api-3t.sandbox.paypal.com/nvp";
		}			
		$version = urlencode('76.0');			
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		
		$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
		//gs($nvpreq);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
		
		$httpResponse = curl_exec($ch);			
		//gs($httpResponse);
		if(!$httpResponse) {
			$msg = ("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
		}		
		$httpResponseAr = explode("&", $httpResponse);			
		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}		
		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
			$msg = getLabels('invalid_response_for_payment'); 
		}			
		if($msg){
			return redirect('payout-subscription')->with('type', 'errormessage')->with('message', $msg);
		}			
		return $httpParsedResponseAr;
	}
}



?>