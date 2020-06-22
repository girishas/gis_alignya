<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Language extends Model
{
	use SortableTrait;
    protected $fillable = [
        'name', 'code', 'icon', 'status'];






        public static function validate($input, $id = null){
		$rules = array(
		
			'name'         	=> 'required',
		    'status'    	=> 'required',
			
		);
		
		$messages = array(
			
			
			'name.required' 			=> getLabels('name_is_required'),
			'icon.required' 				=> getLabels('icon_is_required'),
		    'status.required' 				=> getLabels('status_is_required'),
			
		);
		return validator($input, $rules, $messages);
	}

	
	
}