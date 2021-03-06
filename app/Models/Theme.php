<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Theme extends Model
{
	use SortableTrait;
	protected $table = "al_theme";
    protected $fillable = ['company_id','theme_name','theme_summary','fiscal_year','status'];

     public static function validateadd($input){
		$rules = array(
			'theme_name'         	=> 'required',
		);
		
		$messages = array(			
			'theme_name.required' 			=> getLabels('theme_name_is_required'),
			
		);
		return validator($input, $rules, $messages);
	}

}