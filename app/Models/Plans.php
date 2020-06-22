<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Plans extends Model
{
	use SortableTrait;
	protected $table = "al_comp_plans";
    protected $fillable = ['heading','sub_heading','emp_limit','summary','setup_fee','training_fee','plan_fee','period','status'];

}