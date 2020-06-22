<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SupportReply extends Model
{
	use SortableTrait;
	protected $table = "al_supports_replies";
    protected $fillable = [
       'user_id',
'company_id',
'support_id',
'ticket_reply'];

}