<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\SortableTrait;

class Contact extends Authenticatable
{
    use Notifiable, SortableTrait;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	 
	public $table = "contacts";
	
    protected $fillable = [
        'email', 'name', 'telephone','message', 'status'
    ];
    
	//public $timestamps = false;
	
	
   public static function validate($input, $id = null){
		$rules = array(
			'name'  	=> 'required',
			'email'  	=> 'required|email',
			'message'  	=> 'required',
		);
	
		
		
		$messages = array(
			'name.required'	 	 	 => getLabels('name_is_required'),
			'email.required'  		 => getLabels('email_is_required'),
			'email.email'  		 	 => getLabels('invalid_email'),
			'message.required' 	 	 => getLabels('message_is_required')
		);
        return validator($input, $rules, $messages);
	}
	
	
}
