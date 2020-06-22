<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Subscription extends Model
{
	use SortableTrait;
	protected $table = "al_comp_subscriptions";
    protected $fillable = ['user_id','company_id','emp_limit','heading','setup_fee','training_fee','plan_fee','total_stripe_payment','period','admin_notes','stripe_customer_id','stripe_subscription_id','stripe_plan_id','plan_id','stripe_dump','start_date','end_date','stripe_status'];

}