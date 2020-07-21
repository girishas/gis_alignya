<?php

namespace App;
use App\Country;
use App\Models\Post;
use App\Models\PostFile;
use App\Models\UserSetting;
use App\Models\UserDetail;
use App\Models\Friend;
//use App\Models\ActiveStatus;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
	use SortableTrait;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'is_complete_profile', 'stripe_customer_id','visibility_status', 'facebook_profile_link','twitch_profile_link','linkedin_profile_link', 'twitter_profile_link',
		'role_id', 'email', 'first_name','last_name', 'password','username','uniq_username', 'about_you',
		'language_id','timezone_id', 'photo', 'cover_photo','gender', 'temperature', 'dob','street_1','street_2',
		'state','province','city','zip','country_id','mobile','phone','website','security_que1_id','security_que2_id',
		'security_ans1','security_ans2','status','varify_hash','varify_account','provider', 'provider_id','instagram_profile_link',
		'reddit_profile_link','discordapp_profile_link','tumblr_profile_link','google_plus_profile_link','vk_profile_link','meetup_profile_link',
		'youtube_profile_link','pinterest_profile_link','ask_fm_profile_link','flicker_profile_link','classmates_profile_link',
		'referral_code','referral_by','block_ip_start','block_ip_end','full_name','image_name','is_validate','active_status','payout_email','enable_subscription_admin',
		'enable_subscription','domain_name_id','designation','stripe_customer_id','token_code','company_id','user_agent','last_activity','emp_code','trial_expiry_date','current_membership_plan','user_ip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function getTotalconversationAttribute(){
		return $this->hasMany('App\Models\Conversation','sender','uniq_username')->whereNull('group_id')->where('receiver', Auth::User()->uniq_username)->where('is_read', 0)->count();
    } 
	
	public static function validate_forgot_pass($input){
		$rules = array(
			'email' 	=> 'required|email|exists:users,email,status,1,role_id,2',
		);
		
		$messages = array(
			'email.required'		=> getLabels('email_is_required'),
			'email.email' 			=> getLabels('invalid_email'),
			'email.exists' 			=>  getLabels('email_is_not_active'),
		);
        return validator($input, $rules, $messages);
	}
	public static function change_password($input){
		$rules = array(
			'current_password' => array('required', 'current_password'),
			'new_password'	  			=> array('required', 'min:6'),
			'confirm_new_password' => 'required|same:new_password',
		);
		
		$messages = array(
			'current_password.required' 		=> getLabels('current_password_is_required'),
			'current_password.current_password' => getLabels('current_password_incorrect'),
			'new_password.min' 		  			=> getLabels('password_length'),
			'new_password.confirmed' 			=> getLabels('password_mismatch'),
			'confirm_new_password.required'=> getLabels('confirm_password_required'),
		);
		
        return validator($input, $rules, $messages);
	}
	
	
	
	public static function admin_changepassword($input){
		$rules = array(
			'new_password'	  			=> array('required', 'min:6'),
			'confirm_new_password' => 'required|same:new_password',
		);
		
		$messages = array(
			'current_password.required' 		=> getLabels('current_password_is_required'),
			'current_password.current_password' => getLabels('current_password_incorrect'), 
			'new_password.min' 		  			=> getLabels('password_length'),
			'new_password.confirmed' 			=> getLabels('password_mismatch'),
			'confirm_new_password.required'=> getLabels('confirm_password_required'),
		);
		
        return validator($input, $rules, $messages);
	}

	public static function validate_email($input, $id = null){
		$rules = array(
			'email'         => 'email|unique:users,email',
		);
		
		$messages = array(
			'email.email'  		 	 => getLabels('invalid_email'),
			'email.unique' 		 	 => getLabels('email_is_already_exist'),
		);
		return validator($input, $rules, $messages);
	}
	
	
	public static function validate_login($input){
		$rules = array(
			'email'  => 'required|email',
			'password2'  => 'required',
		);
		
		$messages = array(
			'email.required'	=> getLabels('email_is_required'),
			'email.email' 		=> getLabels('invalid_email'),
			'password2.required' => getLabels('password_is_required'),
		);
        return validator($input, $rules, $messages);
	}
	
	public static function validate($input, $id = null){
		$rules = array(
		
			'email'         	=> 'required|email|unique:users,email,'.$id,
			'first_name'    	=> 'required',
			//'dob'	            => 'required',
			//'gender' 	        =>'required',
			//'mobile'             => 'required|min:6|numeric',
			//'password' 	        =>'required'.$id,
			//'is_validate'       =>'required',
		);
		
		
		$messages = array(
			
			'email.email'  		 	 	=> getLabels('invalid_email'),	
			'email.unique' 		 	 	=> getLabels('email_is_already_exist'),
			'email.required' 			=> getLabels('email_is_required'),
			'first_name.required' 		=> getLabels('first_name_required'),
			'dob.required' 				=> getLabels('dob_is_required'),
			'gender.required'			=> getLabels('please_select_gender'),
			'password.required'			=> getLabels('password_is_required'),
			'mobile.required'			=> getLabels('phone_number_required'),
			'mobile.numeric'		    => getLabels('invalid_phone_format'),
			'mobile.min'			    => getLabels('invalid_phone'),
			'is_validate.required'				=> getLabels('select_validate_email_option'),
		);
		return validator($input, $rules, $messages);
	}
	
	
	public static function validateMy($input, $id = null){
		$rules = array(
		
			'email'         	=> 'required|email|unique:users,email,'.$id,
			'first_name'    	=> 'required',
			'dob'	            => 'required',
			'gender' 	        =>'required',
			'mobile'             => 'required|min:6|numeric',
			'password' 	        =>'required'.$id,
			'uniq_username'      => 'required|unique:users,uniq_username,'.$id,
		);
		
		
		
		$messages = array(
			
			'email.email'  		 	 	=> getLabels('invalid_email'),		
			'email.unique' 		 	 	=> getLabels('email_is_already_exist'),
			'email.required' 			=> getLabels('email_is_required'),
			'uniq_username.unique' 		=> getLabels('username_already_exist'),
			'uniq_username.required'    => getLabels('username_is_required'),
			'first_name.required' 		=> getLabels('first_name_required'),
			'dob.required' 				=> getLabels('dob_is_required'),
			'gender.required'			=> getLabels('please_select_gender'),
			'password.required'			=> getLabels('password_is_required'),
			'mobile.required'			=> getLabels('phone_number_required'),
			'mobile.numeric'		    => getLabels('invalid_phone_format'),
			'mobile.min'			    => getLabels('invalid_phone'),
			'is_validate.required'				=> getLabels('select_validate_email_option'),
		);
		return validator($input, $rules, $messages);
	}

	public static function validateUserInfo($input, $id = null){
		$rules = array(
			'first_name'    	=> 'required',
			'dob'				=> 'required',
			'uniq_username'		=> 'required|unique:users,uniq_username,'.$id,
		);
		
		$messages = array(
			'first_name.required' 		=> getLabels('first_name_required'),
			'dob.required' 				=> getLabels('dob_is_required'),
			'uniq_username.unique' 		=> getLabels('username_already_exist'),
		);
		return validator($input, $rules, $messages);
	}

	public static function usereditvalidate($input, $id = null){
		$rules = array(
		
			//'email'         	=> 'required',
			'first_name'    	=> 'required',
			'gender' 	        => 'required',
		);
		
		$messages = array(
			
			'first_name.required' 		=> getLabels('first_name_required'),
			'gender.required'			=> getLabels('please_select_gender'),
		);
		return validator($input, $rules, $messages);
	}
	
	
	public static function register($input){
		$rules = array(
			'email'  		=> 'required|email|unique:users,email',
			'password'  	=> 'required|min:6',
			'first_name'  	=> 'required',
			'company_name' => 'required',
			'plan_id' => 'required',
		);
		
		$messages = array(
			'email.required'			=> getLabels('email_is_required'),
			'email.email' 				=> getLabels('invalid_email'),
			'password.required' 		=> getLabels('password_is_required'),
			'password.required' 		=> getLabels('password_length'),
			'first_name.required' 		=> getLabels('first_name_required'),
			'company_name.required' 		=> getLabels('company_name_required'),
			'plan_id.required' 		=> getLabels('choose_plan_required'),
		);
        return validator($input, $rules, $messages);
	}

	
	public static function createUsername($user_id){
		$number  = time().str_pad($user_id, 5, '0', STR_PAD_LEFT);
		// $user   = Self::find($user_id);
		// $user->update(array("uniq_username" => $number));
		return $number;
	}

}


