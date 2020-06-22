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
'status'];

}