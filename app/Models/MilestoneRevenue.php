<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MilestoneRevenue extends Model
{
	use SortableTrait;
	protected $table = "al_milestones_revenues";
    protected $fillable = ['company_id',
'milestone_id',
'target_gm',
'target_mm',
'target_nm',
'target_expense',
'target_net',
'target_ebitda',
'actual_gm',
'actual_mm',
'actual_nm',
'actual_expense',
'actual_net',
'actual_ebitda',
'projection_gm',
'projection_mm',
'projection_nm',
'projection_expense',
'projection_net',
'projection_ebitda'
];

}