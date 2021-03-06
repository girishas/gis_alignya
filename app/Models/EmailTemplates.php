<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class EmailTemplates extends Model
{
	use SortableTrait;
	protected $table = "al_email_templates";
    protected $fillable = [
'name',
'email_group',
'subject',
'template_body'
];

}