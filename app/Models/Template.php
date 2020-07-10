<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SortableTrait;
class Template extends Model
{
	 use SortableTrait;

	/**
	* 

	*/
	protected $table = 'templates';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','subject','subject_en','subject_fr','subject_sp','description','content', 'content_en', 'content_sp', 'content_fr', 'slug'
    ];

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	
    protected $unfillable = ['created_at','updated_at'];
	
	public $timestamps = false;
	
	public static function validate($input, $id = null){
		$rules = array(
			'name'  		=> 'required',
			'subject_en'  		=> 'required',
			//'subject_fr'  		=> 'required',
			//'subject_sp'  		=> 'required',
			'content_en'  	=> 'required',
			//'content_fr'  	=> 'required',
			//'content_sp'  	=> 'required',
			'slug'        	=> 'required|unique:templates,slug,'.$id
		);
		
		
		$messages = array(
			'name.required'	 	 => getLabels('title_is_required'),
			'subject_en.required'  	 => getLabels('subject_is_required'),
			'subject_fr.required'  	 => getLabels('subject_is_required'),
			'subject_sp.required'  	 => getLabels('subject_is_required'),
			'content_en.required'  	 => getLabels('content_is_required'),
			'content_fr.required'  	 => getLabels('content_is_required'),
			'content_sp.required'  	 => getLabels('content_is_required'),
			'slug.required' 	 	 => getLabels('slug_is_required'),
			'slug.unique' 			 => getLabels('slug_must_be_unique'),
		);
        return validator($input, $rules, $messages);
	}

}
