<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Company extends Model
{
	use SortableTrait;
	protected $table = "al_companies";
    protected $fillable = ['company_name','comp_licence','slogan','industry_id','logo','company_currency','com_vision','com_values','com_mission','com_competitive_advantages','com_focus_area','comp_strategic_issue','support_email','fiscal_start_month','email','phone','mobile','fax','city','country','zip','address','website','skype_id','facebook','twitter','linkedin','plan_id','is_removed'];

}