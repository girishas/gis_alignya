<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProjectAnalysis extends Model
{
	use SortableTrait;
	protected $table = "al_project_analysis";
    protected $fillable = [
        'user_id',
'company_id',
'project_id',
'type',
'analysis',
'percent_complete'];

}