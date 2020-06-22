<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
        'label','slug','value','type','description'

    ];
    

     public $timestamps = false;

   public static function validate($input, $id=null)
   {
       $rules = array(

        'lebel' => 'requred',
		'value' => 'required',
        );

       $message = array(

            'label.requred' => getLabels('this_field_is_required'),
			'value.requred' => getLabels('this_field_is_required'),
        );

       return validator($input, $message, $rules);

   } 


    
    

}
