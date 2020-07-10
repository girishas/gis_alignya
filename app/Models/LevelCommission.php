<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Traits\SortableTrait;

class LevelCommission extends Model
{
	protected $table = 'level_commissions';
	use SortableTrait;
    protected $fillable = [
        'fees', 'fixed_amount', 'admin_commission', 'level_id'];






        public static function validate($input, $id = null){
		$rules = array(
		
			'fees'         	=> 'required|numeric|min:0',
			'fixed_amount'  => 'required|numeric|min:0',
			'admin_commission'  => 'required|numeric|min:0',
		    'level_id'    	=> 'required|unique:level_commissions,level_id,'.$id,
		   		
		);
		
		$messages = array(
			'fees.required' 			=> getLabels('fees_is_required'),
			'fees.numeric' 				=> getLabels('invalid_value'),
		    'fees.min' 					=> getLabels('invalid_value'),
			'fixed_amount.required' 	=> getLabels('fixed_amount_required'),
			'fixed_amount.numeric' 		=> getLabels('invalid_value'),
			'fixed_amount.min' 			=> getLabels('invalid_value'),
		    'level_id.required' 		=> getLabels('level_is_required'),
		    'level_id.unique' 			=> getLabels('duplicate_level'),
			'admin_commission.required' 	=> getLabels('admin_commission_required'),
			'admin_commission.numeric' 		=> getLabels('invalid_value'),
			'admin_commission.min' 			=> getLabels('invalid_value'),
		);
		return validator($input, $rules, $messages);
	}

	
	
}