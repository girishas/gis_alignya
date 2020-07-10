<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SortableTrait;
class Conversation extends Model {
	use SortableTrait;
	
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'conversations';
	
	protected $fillable = array('sender', 'receiver', 'message', 'is_read', 'group_id');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	public function setUpdatedAt($value)
    {
      return NULL;
    }
	
	
	 public function User()
    {
         return $this->belongsTo('App\User','sender','uniq_username')->select(array('uniq_username','first_name','last_name','photo'));
    }
	
	
	 public function Group()
    {
         return $this->belongsTo('App\Models\Group','group_id','slug')->select(array('slug','icon','name'));
    }
 
}
