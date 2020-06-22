<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Objective extends Model
{
	use SortableTrait;
	protected $table = "al_objectives";
    protected $fillable = [
        'user_id',
'company_id',
'is_home',
'objective_id',
'cycle_id',
'team_type',
'department_id',
'team_id',
'owner_user_id',
'perspective_id',
'scorecard_id',
'theme_id',
'heading',
'summary',
'goal_visibility',
'confidence_level',
'is_save_publish',
'status'];

}