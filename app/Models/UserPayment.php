<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;
class UserPayment extends Model
{
   use Encryptable;
	protected $fillable = ['address_street', 'address_zip', 'first_name', 'address_country_code', 'address_country', 'address_city', 'payer_email', 'last_name', 'address_state', 'user_id'];
		
	protected $table = 'user_payment_details';
	
	protected $encryptable = [
        'address_street',
        'address_zip',
        'first_name',
        'address_country_code',
		'address_city',
		'last_name',
		'address_state',
    ];

}
