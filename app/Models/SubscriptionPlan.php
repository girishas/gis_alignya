<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class SubscriptionPlan extends Model
{
  
	protected $fillable = ['name','description',' 	image','price', 'level_id', 'user_id','image','allowed_text','allowed_image','allowed_video'];
		
	protected $table = 'subscription_plans';
	
	public static function validate($input,$id=null) {
	
		$rules = array(
			'name' => 'required',
			'description' => 'required',
			'price' => 'required|numeric|min:0.1',
		);
		
		$messages = array(
			'name.required' => getLabels('name_is_required'),
			'description.required' => getLabels('description_is_required'),
			'price.numeric' => getLabels('invalid_format'),
			'price.min' => getLabels('invalid_format'),
			'price.required' => getLabels('price_is_required'),
		);

        return validator($input, $rules, $messages);
	}

}
