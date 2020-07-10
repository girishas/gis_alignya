<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SortableTrait;

class Payment extends Model
{
  
	use SortableTrait;
	protected $fillable = ['profile_id','first_name', 'last_name','street','city','state','zipcode','country_code','profile_status','payment_dump','user_id','subscription_id','amount','acknowledge','payout_status','email','app_payment_type'];
		
	protected $table = 'payments';
	
	
	public static function billingValidation($input){
		
		$rules = array(
			'email'=>'required',
			'firstName'=>'required',
			'street'=>'required',
			'city'=>'required',
			'state'=>'required',
			'zipcode'=>'required',
			'country'=>'required',
		);
		$messages = array(
			'email.required'=>getLabels('email_is_required'),
			'firstName.required'=>getLabels('first_name_required'),
			'street.required'=>getLabels('street_is_required'),
			'city.required'=>getLabels('city_is_required'),
			'state.required'=>getLabels('state_is_required'),
			'zipcode.required'=>getLabels('zip_code_is_required'),
			'country.required'=>getLabels('country_is_required'),
		);
		return validator($input, $rules, $messages);
	}
	  
}
