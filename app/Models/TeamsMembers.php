<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TeamsMembers extends Model
{
	use SortableTrait;
	protected $table = "al_teams_members";
    protected $fillable = [
        'member_id', 'team_id', 'is_head'];

    public $timestamps = false;
	
	public function getMembers(){
       return $this->hasOne('App\User', 'id', 'member_id')->where('users.status',1)->select('users.id','users.first_name','users.last_name');
    }
	
	
	
}