<?php
namespace App\Traits;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

trait Encryptable {
	
	/*   public function getAttribute($key){
		 //gs("here");
        $value = parent::getAttribute($key);
        if (in_array($key, $this->encryptable)) {
            $value = Crypt::decrypt($value);
		
        }
    }  
 */
 public function setAttribute($key, $value){
		 //gs("herer");
        if (in_array($key, $this->encryptable)) {
            $value = Crypt::encrypt($value);
        }
        return parent::setAttribute($key, $value);
    }   
	
	 public function attributesToArray(){
        $attributes = parent::attributesToArray();
        foreach ($attributes as $key => $value){
            if (in_array($key, $this->encryptable)){
                $attributes[$key] = Crypt::decrypt($value);
            }
        }
        return $attributes;
    }
}