<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\PostCommentLike;
use Carbon\Carbon;
class PostComment extends Model
{
   protected $fillable = [
        'user_id', 'parent_id','giphy_image', 'post_id', 'nest_level', 'comment', 'file', 'status', 'check_parent'
    ];

     //public $belongsTo = ['App\Models\User'];
     	
    protected $with = ['User','commentLikes'];

    protected $appends=['published','dateiso'];

    

    public function getPublishedAttribute(){
        
            return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']) )->diffForHumans();
        }

    public function getdateisoAttribute(){

            $date = $this->attributes['created_at'];
            $time = strtotime( $date );
            return date( 'c', $time );

        }

    public function User()
    {
        return $this->belongsTo('App\User','user_id','id')->select(array('id','first_name','last_name','photo','uniq_username'));
    }

	public function commentLikes(){
       return $this->hasMany('App\Models\PostCommentLike'); 
    }
	
     public function getTotalCommentLikesAttribute(){
        return $this->hasMany('App\Models\PostCommentLike')->count(); 
    }
	
   
}

