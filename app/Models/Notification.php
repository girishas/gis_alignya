<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
'company_id',
'notify_type',
'notify_msg',
'notify_url',
'is_read'
    ];


    protected $with = ['User'];

    protected $appends=['published'];

    public function getPublishedAttribute(){
        
            return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']) )->diffForHumans();
        }

    public function User()
    {
         return $this->belongsTo('App\User','user_id','uniq_username')->select(array('uniq_username','first_name','last_name','photo'));
    }
	
	
	public static function createNotifications($user_id, $to_user_id, $message, $type, $status = 0, $jsondata = NULL){
		$notification_data = array();
		$notification_data['user_id']  		= $user_id;
		$notification_data['to_user_id'] 	= $to_user_id;
		$notification_data['status'] 		= $status;
		$notification_data['message'] 		= $message;
		$notification_data['type'] 			= $type;
		$notification_data['data'] 			= $jsondata;
		$dataSaved  = Self::create($notification_data);
		$data   = Self::where('id', $dataSaved->id)->first();
		return $data;
	}
}
