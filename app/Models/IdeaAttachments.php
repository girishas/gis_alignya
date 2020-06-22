<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class IdeaAttachments extends Model
{
	use SortableTrait;
	protected $table = "al_idea_attachments";
    protected $fillable = [
'user_id',
'idea_id',
'idea_file'
];

}