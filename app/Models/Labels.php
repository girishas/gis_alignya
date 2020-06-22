<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Traits\SortableTrait;

class Labels extends Model
{
	use SortableTrait;
    protected $fillable = [
        'label_key', 'label_text_en', 'label_text_fr', 'label_text_sp', 'language_id', 'module_id'];






        public static function validate($input, $id = null){
		$rules = array(
		
			'label_key'         	=> 'required|unique:labels,label_key,'.$id,
			'label_text_en'    	=> 'required',
		    //'label_text_sp'    	=> 'required',
		    //'label_text_fr'    	=> 'required',
		   		
		);
		
		$messages = array(
			
			
			'label_key.required' 				=> getLabels('label_key_is_required'),
			'label_key.unique' 					=> getLabels('label_key_already_exist'),
			'label_text_en.required' 			=> getLabels('english_version_required'),
			'label_text_sp.required' 			=> getLabels('spanish_version_is_required'),
			'label_text_fr.required' 			=> getLabels('french_version_is_required'),
		   
			
		);
		return validator($input, $rules, $messages);
	}

	
	
}