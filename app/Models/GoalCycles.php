<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class GoalCycles extends Model
{
	use SortableTrait;
	protected $table = "al_goal_cycles";
    protected $fillable = [
       'company_id',
'cycle_name',
'no_months',
'status'];

    public $timestamps = false;	
	
	public static function validateadd($input){
		$rules = array(
			'cycle_name'         	=> 'required',
			'no_months'         	=> 'required',
		);
		
		$messages = array(			
			'cycle_name.required' 			=> getLabels('goal_cycle_is_required'),
			'no_months.required' 			=> getLabels('no_of_months_is_required'),
			
		);
		return validator($input, $rules, $messages);
	}

	
}