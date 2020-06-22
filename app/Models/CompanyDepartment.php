<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CompanyDepartment extends Model
{
	use SortableTrait;
	protected $table = "al_comp_departments";
    protected $fillable = ['company_id','parent_dpartment_id','deprtment_nae','status'
];

}