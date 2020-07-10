<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Traits\SortableTrait;

class Faq extends Model
{
	use SortableTrait;
	protected $table = 'faqs';
    protected $fillable = [
        'slug', 'question_en', 'question_fr', 'question_sp', 'answer_en', 'answer_sp', 'answer_fr'];


        public static function validate($input, $id = null){
		$rules = array(
		
			'slug'    	=> 'required',
		    'question_en'    	=> 'required',
		    'answer_en'         	=> 'required',
			
		);
		
		$messages = array(
			
			'slug.required' 				=> 'Slug is required.',
		    'question_en.required' 				=> 'Question is required.',
		    'answer_en.required' 			=> 'Answer is required.',
			
		);
		return validator($input, $rules, $messages);
	}

	
	
}