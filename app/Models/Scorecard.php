<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Scorecard extends Model
{
	use SortableTrait;
	protected $table = "al_comp_scorecard";
    protected $fillable = ['company_id','name','status'];

}