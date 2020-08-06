<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;
use App\User;
use App\Models\TeamsMembers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class UserRoles extends Model
{
	use SortableTrait;
	protected $table = "al_users_role";
    protected $fillable = ['role'];
}