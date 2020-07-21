<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Traits\SortableTrait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Perspective extends Model
{
	use SortableTrait;
	protected $table = "al_perspectives";
    protected $fillable = [
        'name','status'];
    public $timestamps = false;



    public static function validate($input){
		$rules = array(
			'name'  		=> 'required',
		);
		
		$messages = array(
			'name.required'			=> getLabels('name_is_required'),
			
		);
        return validator($input, $rules, $messages);
	}

}