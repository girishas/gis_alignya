<?php

namespace App\Models;
use App\Models\PostFile;
use App\Models\PostLike;
use App\User;
use Carbon\Carbon;



use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'scheduled_starttime',  'user_id', 'post_category_id', 'wall_user_id', 'group_id', 'title', 'description','video_url','parent_post_id','location','web_preview','content_type', 'who_can_see', 'who_can_comment','giphy_image','published','notification_status','start_date','end_date','start_time','end_time','category','share_link','live_url','social_page_id','post_type','social_page_name','group_name','subscription_level','posted_time','thumbnail_height','topic'
    ];

	//protected $with = ['postUser', 'postFiles', 'postLike', 'postComments'];
	
	public function gettoTallikeAttribute(){
       return $this->hasMany('App\Models\PostLike','post_id','id')->count();
    }
	 
	public function getTotalcommentAttribute(){
		return $this->hasMany('App\Models\PostComment','post_id','id')->count();
    } 
	 
	public function postFiles(){
       return $this->hasMany('App\Models\PostFile');
    }
   
    public function postUser(){
		return $this->belongsTo('App\User','user_id','id')->select('id', 'first_name','last_name','photo','uniq_username','city','state','cover_photo');
    }
	
	public function postLike(){
        return $this->hasMany('App\Models\PostLike');       
    }
	
	public function postComments(){
		return $this->hasMany('App\Models\PostComment', 'post_id', 'id')->orderBy('id', 'DESC');
		
		//->orderBy('id', 'DESC')->limit(config('constants.PAGINATION_COMMENTS'));
    }
	
	
	public static function validate($input){
		
		$rules = array(
			'title'         			=> 'required',
			//'live_url'         			=> 'required',
			//'scheduled_starttime'       => 'required',
		);
		
		
		$messages = array(
			'title.required'  		 	 			 => getLabels('title_is_required'),
			'scheduled_starttime.required' 		 	 => getLabels('schedule_date_required'),
			'live_url.required' 		 			 => getLabels('video_url_is_required'),
		);
		return validator($input, $rules, $messages);
	}
	
	
}
