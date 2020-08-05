<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Ideas extends Model
{
	use SortableTrait;
	protected $table = "al_ideas";
    protected $fillable = [
'user_id',
'company_id',
'department_id',
'category_id',
'title',
'description',
'is_popular',
'status'
];


	public static function validate($input, $id = null){
		$rules = array(
			'title'         	=> 'required',
			'department_id'		=> 'required',
			'category_id'		=> 'required',
		);
		
		$messages = array(
			'title.required' 			=> 'Title is required.',
			'department_id.required' 			=> 'Department is required.',
			'category_id.required' 			=> 'Category is required.',
		);
		return validator($input, $rules, $messages);
	}

}