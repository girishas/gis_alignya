<?php

namespace App\Http\Controllers;

use App\Models\Setting;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use URL;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function __construct()
    {
		
        $this->request = Request();
		$siteValue 	 =  Setting::select('settings.slug','settings.value')->get();
		
		foreach($siteValue as $val){
			session()->put('SiteValue.'. $val->slug, $val->value);
		}
		
		if(Auth::check() and Auth::User()->role_id == 2 and strpos(URL::current(),'admin/change_password') === false and session('LOGINWITHOTP') == 1){
			return redirect('admin/change_password')->send();
		}
		$url_prefix = (($this->request->route()->getPrefix() == env('ADMIN_PREFIX')) OR (Auth::check() and Auth::User()->role_id == 1))?env('ADMIN_PREFIX').'/':'';
		$route_prefix = (($this->request->route()->getPrefix() == env('ADMIN_PREFIX'))  OR (Auth::check() and Auth::User()->role_id == 1))?env('ADMIN_PREFIX'):'';
		view()->share(['url_prefix'=> $url_prefix, 'route_prefix' => $route_prefix]);
		
    }
}
