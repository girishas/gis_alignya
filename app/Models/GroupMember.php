<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
	protected $fillable = [
        
        'member_id','group_id','group_slug','is_admin','is_active'

    ];
    protected $table = "group_members"; 
	protected $with = ['memberUser'];
	
	public function memberUser(){
		 return $this->belongsTo('App\User','member_id','uniq_username')->select(array('uniq_username','first_name','last_name','photo'));
	}
	
	public function memberGroup(){
		 return $this->belongsTo('App\Models\Group','group_id','id')->select(array('icon','name','id','user_id','slug','privacy'));
	}
	
}
