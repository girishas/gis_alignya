<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class IdeaLikes extends Model
{
	use SortableTrait;
	protected $table = "al_idea_likes";
    protected $fillable = [
'user_id',
'idea_id',
'idea_comment_id',
'is_like'
];

}