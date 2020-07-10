<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; 

class PostLike extends Model
{
     protected $fillable = [
        'user_id', 'post_id'];

     protected $with = ['User'];

	protected $appends = array('Published');

	public function setUpdatedAt($value)
    {
      return NULL;
    }
	
    public function User()
    {     

        return $this->belongsTo('App\User','user_id','id')->select(array('id','first_name','last_name','photo','uniq_username'));
    }
	  public function getPublishedAttribute(){

            $end = Carbon::parse($this->attributes['created_at']);

            $now = Carbon::now();

            $length = $end->diffInDays($now);

            if($length >= 1){
               return $end->format('F  j \a\t h:i A'); 
            }else{
                return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']) )->diffForHumans();
            }

            return $length;
        
           // return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']) )->diffForHumans();
        }
}
