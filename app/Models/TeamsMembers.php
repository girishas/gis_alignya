<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TeamsMembers extends Model
{
	use SortableTrait;
	protected $table = "al_teams_members";
    protected $fillable = [
        'member_id', 'team_id', 'is_head'];

    public $timestamps = false;
	
}