<?php

namespace App\Models;
use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class PostFile extends Model
{
    protected $fillable = [
        'user_id', 'post_id', 'type', 'image_name', 'label', 'video_cover', 'extension', 'mime_type', 'extension_previous', 'mime_type_previous', 'is_converted', 'file_title', 'file_description', 'url', 'embed_code', 'social_page_id','image_type'
    ];
	
	/*  protected $appends=['published','toTallike'];
	
	 public function getPublishedAttribute(){
        
            return Carbon::createFromTimeStamp(strtotime($this->attributes['updated_at']) )->diffForHumans();
        }
	public function gettoTallikeAttribute(){

             return $this->hasMany('App\Models\PostLike','post_id','id')->count();
        
             //return $thitotallikes->hasMany('App\Models\Post','parent_post_id','id')->count();
     } 

     public function PostDetail(){
             return $this->belongsTo('App\Models\Post','post_id','id','INNER')->select('id','post_category_id','created_at');      
 
    } */
}
