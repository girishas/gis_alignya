<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;
use App\Models\Measure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Objective extends Model
{
	use SortableTrait;
	protected $table = "al_objectives";
    protected $fillable = [
        'user_id','company_id','is_home','objective_id',
'cycle_id',
'team_type',
'department_id',
'team_id',
'owner_user_id','perspective_id','scorecard_id','theme_id','heading','summary','goal_visibility','confidence_level','is_save_publish','status','contributers'];



public static function validate($input){
		$rules = array(
		
			'heading'         	=> 'required',
			'cycle_id'    	=> 'required',
		);
		
		
		$messages = array(
			'heading.required'			    => getLabels('objective_name_required'),
			'cycle_id.required'				=> getLabels('time_period_required'),
		);
		return validator($input, $rules, $messages);
	}
	
	public function getMeasures(){
       return $this->hasMany('App\Models\Measure', 'objective_id', 'id')->leftjoin('al_master_status','al_master_status.id','=','al_measures.status')->where('category_type',1)->select('al_measures.*','al_master_status.bg_color','al_master_status.icons','al_master_status.name as status_name')->orderBy('al_measures.id', 'DESC');
    }
   public function getInitiatives(){
       return $this->hasMany('App\Models\Measure', 'objective_id', 'id')->leftjoin('al_master_status','al_master_status.id','=','al_measures.status')->where('category_type',2)->select('al_measures.*','al_master_status.bg_color','al_master_status.icons','al_master_status.name as status_name')->orderBy('al_measures.id', 'DESC');
    }
   
	
	
	
	}