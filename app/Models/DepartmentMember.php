<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DepartmentMember extends Model
{
	use SortableTrait;
	protected $table = "al_department_member";
    protected $fillable = [
        'member_id', 'department_id', 'is_head'];

    public $timestamps = false;	
	
}