<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SortableTrait;

class PageImage extends Model
{
	use SortableTrait;
	
	protected $table = 'page_images';
	
    protected $fillable = [
        'slug', 'page_title', 'type', 'image', 'video', 'status', 'height','width'];






        public static function validate($input, $id = null){
		$rules = array(
		
			'slug'         	=> 'required',
			'page_title'    	=> 'required',
		    'type'    	=> 'required',		
		    'status'    	=> 'required',
		    'height'    	=> 'required',
		    'width'    	=> 'required',
			
		);
		
		$messages = array(
			
			
			'slug.required' 			=> getLabels('slug_is_required'),
			'page_title.required' 				=> getLabels('title_is_required'),
		    'type.required' 				=> getLabels('type_is_required'),
			'status.required' 				=> getLabels('status_is_required'),
		    'height.required' 				=> getLabels('height_is_required'),
		     'width.required' 				=> getLabels('width_is_required'),
			
		);
		return validator($input, $rules, $messages);
	}

	
	
}