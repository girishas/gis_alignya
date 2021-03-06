<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Measure extends Model
{
	use SortableTrait;
	protected $table = "al_measures";
    protected $fillable = [
        'user_id',
'category_type',
'company_id',
'objective_id',
'measure_type',
'measure_unit',
'heading',
'summary',
'measure_team_type',
'measure_department_id',
'measure_team_id',
'owner_user_id',
'measure_actual',
'measure_target',
'measure_target_new',
'measure_graph_type',
'calculation_type',
'target_color',
'actual_color',
'projection_color',
'kpi_quaters',
'kpi_quater_month',
'measure_cycle_year',
'measure_cycle_quarter',
'quarter_start_month',
'check_in_frequency',
'confidence_level',
'is_save_publish',
'status',
'contributers'];



public static function validate($input){
		$rules = array(
		
			'heading'         	=> 'required',
			'objective_id'         	=> 'required',
			'measure_cycle'    	=> 'required',
			'ownership'    	=> 'required',
			'measure_target' =>'required', 
			'measure_actual' =>'required',  
			'revenue_target' => 'required_if:measure_type,revenue',
			'revenue_actual' => 'required_if:measure_type,revenue',
			'measure_unit' => 'required_if:measure_type,revenue|required_if:measure_type,value',
			
		);
		
		
		$messages = array(
			'heading.required'			    => getLabels('Measure_name_required'),
			'objective_id.required'			    => getLabels('please_select_objective'),
			'measure_cycle.required'				=> getLabels('please_select_cycle'),
			'ownership.required'				=> getLabels('please_select_owner'),
			'measure_actual.required'				=> getLabels('measure_actual_required'),
			'measure_target.required'				=> getLabels('measure_target_required'),
			
		);
		return validator($input, $rules, $messages);
	}

public static function validateInitiative($input){
		$rules = array(
		
			'heading'         	=> 'required',
			'objective_id'         	=> 'required',
			'measure_cycle'    	=> 'required',
			'ownership'    	=> 'required',
		);
		
		
		$messages = array(
			'heading.required'			    => getLabels('Measure_name_required'),
			'objective_id.required'			    => getLabels('please_select_objective'),
			'measure_cycle.required'				=> getLabels('please_select_cycle'),
			'ownership.required'				=> getLabels('please_select_owner'),
			
		);
		return validator($input, $rules, $messages);
	}	
	public static function validateKpi($input){
		$rules = array(
		
			'heading'         	=> 'required',
			'measure_cycle'    	=> 'required',
			'ownership'    	=> 'required',
			'measure_target' =>'required', 
			'measure_actual' =>'required',  
			'revenue_target' => 'required_if:measure_type,revenue',
			'revenue_actual' => 'required_if:measure_type,revenue',
			'measure_unit' => 'required_if:measure_type,revenue|required_if:measure_type,value',
			
		);
		
		
		$messages = array(
			'heading.required'			    => getLabels('Measure_name_required'),
			'measure_cycle.required'				=> getLabels('please_select_cycle'),
			'ownership.required'				=> getLabels('please_select_owner'),
			'measure_actual.required'				=> getLabels('measure_actual_required'),
			'measure_target.required'				=> getLabels('measure_target_required'),
			
		);
		return validator($input, $rules, $messages);
	}	

}

