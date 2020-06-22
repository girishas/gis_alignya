<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Teams extends Model
{
	use SortableTrait;
	protected $table = "al_comp_teams";
    protected $fillable = ['company_id','department_id','team_name','size','team_head','status'];

}