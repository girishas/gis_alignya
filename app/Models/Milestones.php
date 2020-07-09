<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Milestones extends Model
{
	use SortableTrait;
	protected $table = "al_project_milestones";
    protected $fillable = [
        'user_id',
'company_id',
'objective_id',
'sub_objective_id',
'milestone_type',
'initiative_id',
'measure_id',
'is_automatic',
'milestone_name',
'description',
'year',
'quarter',
'month',
'week',
'day',
'start_date',
'end_date',
'sys_target',
'mile_actual',
'projection_target',
'sys_progress',
'mile_status'];

}