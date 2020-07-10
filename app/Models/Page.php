<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SortableTrait;

class Page extends Model
{
	use SortableTrait;
	protected $fillable = ['slug', 'title', 'title_en', 'title_sp', 'title_fr', 'langauge_id', 'content', 'content_en', 'content_sp', 'content_fr', 'meta_title', 'meta_keywords', 'meta_description', 'status'];
	
	public static function validate($input, $id = null){
		$rules = array(
			'title_en'  		=> 'required',
			'content_en'  	=> 'required',
			'slug'        	=> 'required|unique:pages,slug,'.$id
		);
		
		
		$messages = array(
			'title_en.required'	 	 => getLabels('title_is_required'),
			'content_en.required'  	 => getLabels('content_is_required'),
			'slug.required' 	 	 => getLabels('permalink_is_required'),
			'slug.unique' 			 => getLabels('permalink_must_be_unique'),
		);
        return validator($input, $rules, $messages);
	}
}
