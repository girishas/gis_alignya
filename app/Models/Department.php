<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Department extends Model
{
	use SortableTrait;
	protected $table = "al_comp_departments";
    protected $fillable = [
        'parent_department_id', 'department_name', 'parent_level','status','company_id'];

    
        public static function validate($input, $id = null){
		$rules = array(
		
			'department_name'         	=> 'required',
			
		);
		
		$messages = array(
			
			
			'department_name.required' 			=> 'Department Name is required.',
			
			
		);
		return validator($input, $rules, $messages);
	}

	
	
}