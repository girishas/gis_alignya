<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Badges extends Model
{
	use SortableTrait;
    protected $fillable = [
        'title', 'slug', 'langauge_id', 'points', 'image', 'reason', 'status'];






        public static function validate($input, $id = null){
		$rules = array(
		
			'title'         	=> 'required',
			'slug'    	=> 'required',
		    'langauge_id'    	=> 'required',
		    'points'         	=> 'required',
			'reason'    	=> 'required',
		    'status'    	=> 'required',
			
		);
		
		$messages = array(
			
			
			'title.required' 			=> 'Title is required.',
			'slug.required' 				=> 'Slug is required.',
		    'langauge_id.required' 				=> 'Langauge is required.',
		    'points.required' 			=> 'Points is required.',
		    'image.required' 			=> 'Image is required.',
			'reason.required' 				=> 'Reason is required.',
		    'status.required' 				=> 'Status is required.',
			
		);
		return validator($input, $rules, $messages);
	}

	
	
}