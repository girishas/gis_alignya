<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCommentLike extends Model
{
     protected $fillable = [
        'user_id', 'post_id', 'post_comment_id'
    ];
	
	public function setUpdatedAt($value)
    {
      return NULL;
    }
}
