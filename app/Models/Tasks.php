<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Tasks extends Model
{
	use SortableTrait;
	protected $table = "al_tasks";
    protected $fillable = [
'user_id',
'company_id',
'objective_id',
'measure_id',
'type',
'task_name',
'description',
'status'];

}