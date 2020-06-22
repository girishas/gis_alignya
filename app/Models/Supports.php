<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Supports extends Model
{
	use SortableTrait;
	protected $table = "al_supports";
    protected $fillable = [
        'ticket_no',
'company_id',
'postedby_id',
'ticket_subject',
'ticket_message',
'ticket_status',
'priority_id'];

}