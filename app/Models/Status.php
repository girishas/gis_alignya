<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Status extends Model
{
	use SortableTrait;
	protected $table = "al_master_status";
    protected $fillable = ['name',
'bg_color',
'icons',
'is_obj',
'is_meas',
'is_mil',
'status',
'is_task'
];

}