<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Payouts extends Model
{
   public $timestamps = true;  
   protected $fillable = [
         'user_id','paypal_dump','subscription_ids','profile_ids','total_amount_paid','total_commission','transaction_id','payment_status'
    ];	
    protected $table ="payouts";
	
	
	public static function validate($input,$id=null) {
	
		$rules = array(
			'transaction_id' => 'required',
		);
		
		$messages = array(
			'transaction_id.required' =>'Transaction ID is required.',
		);

        return validator($input, $rules, $messages);
	}
}

