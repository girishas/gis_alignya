<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\GroupMember;
class Group extends Model
{
	protected $fillable = [
        
        'name','slug','user_id','icon','group_info','privacy','status'

    ];
	protected $with = ['groupUser','groupMembers'];
    protected $table = "groups";
	
	public function getTotalconversationAttribute(){
		return $this->hasMany('App\Models\Conversation','group_id','slug')->whereNotNull('group_id')->where('receiver', Auth::User()->uniq_username)->where('is_read', 0)->count();
    } 
	
	public function gettotalMemberAttribute(){
       return $this->hasMany('App\Models\GroupMember','group_id','id')->where('is_active', 1)->count();
    }
	
	public function groupUser(){
		 return $this->belongsTo('App\User','user_id','uniq_username')->select(array('uniq_username','first_name','last_name','photo'));
	}
	
	public function groupMembers(){
		return $this->hasMany('App\Models\GroupMember')->where('is_active', 1);
	}
	
	

    public static function validate($input, $id=null){
    	if($id){
            $rules = array(
                'name' => 'required',
                'privacy'    => 'required'
            );
        }else{
            $rules = array(
                'privacy'   	   => 'required',
                'name'         	   => 'required|unique:groups,name,NULL,user_id'.$id 
            );
        }
        
        
        $messages = array(
            'name.required'          => getLabels('name_is_required'),
            'privacy.required'          => getLabels('privacy_is_required'),
            'name.unique'            => getLabels('group_name_already_exist'),
        );
        return validator($input, $rules, $messages);
    }
	
	public static function createGroupSlug($group_name, $group_id){
		$number  = str_slug($group_name).str_pad($group_id, 3, '0', STR_PAD_LEFT);
		$group   = Self::find($group_id);
		$group->update(array("slug" => $number));
		return $number;
	}
}
