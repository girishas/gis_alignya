<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Ideas extends Model
{
	use SortableTrait;
	protected $table = "al_ideas";
    protected $fillable = [
'user_id',
'company_id',
'department_id',
'title',
'description',
'is_popular',
'status'
];

}