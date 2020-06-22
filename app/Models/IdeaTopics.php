<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class IdeaTopics extends Model
{
	use SortableTrait;
	protected $table = "al_idea_topics";
    protected $fillable = [
'name',
'status'
];

}