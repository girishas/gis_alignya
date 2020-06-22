<?php

namespace App\Http\Controllers; 

use App\User;
use App\Models\Country;
use App\Models\Template;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Mail;
use File;

class TemplateController extends Controller
{
	

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function __construct()
    {
       Parent::__construct();
       $this->middleware('auth', ['except' => ['admin_login', 'login']]);
    }
	
	public function admin_index(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		if($this->request->session()->has('templatesearch') and (isset($_GET['page']) and $_GET['page']>=1) OR (isset($_GET['s']) and $_GET['s'])) {
			$_POST = $this->request->session()->get('templatesearch');
		}else{
			$this->request->session()->forget('templatesearch');
		}
		
		$data  = Template::sortable();
		
		if(! empty($_POST)){
			if(isset($_POST['name']) and $_POST['name'] !=''){
				$name = $_POST['name'];
				$this->request->session()->put('templatesearch.name', $name);
				$data = $data->where('name', 'like', $name."%");
			}
			if(isset($_POST['subject']) and $_POST['subject'] !=''){
				$subject = $_POST['subject'];
				$this->request->session()->put('templatesearch.subject', $subject);
				$data = $data->where(function($query) use($subject)  {
							$query->where('subject_en', 'like', $subject."%")->orwhere('subject_sp', 'like', $subject."%")->orwhere('subject_fr', 'like', $subject."%");
						});
				
				
			}
		}else{
			$this->request->session()->forget('templatesearch');
		}
		
		$data = $data->paginate(config('constants.PAGINATION'));
		$page_title = 'Email Templates';
		return view('frontend/templates/admin_index',compact('data', 'page_title'));
	}
	
	
	

	public function admin_add(){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
		
		$page_title = "Add Email Template";
		if($this->request->isMethod('post')){
			$validator = Template::validate($this->request->all());
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('template_saved_errors')]);
			} else {
				$formData              	= $this->request->all();
				
				$template  = Template::create($formData);
				if($template){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'templates'), 'message' => getLabels('email_template_saved')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'templates'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
		
		return view('frontend/templates/admin_add', compact('page_title'));
	
	 }
	 
	 

    public function admin_edit($slug=null){
		if(Auth::check() and Auth::User()->role_id != 1){
			return back();
		}
        $data =  Template::where('slug', $slug)->first();
    
		$page_title = "Update Email Template";
		if($this->request->isMethod('post')){
			$validator = Template::validate($this->request->all(), $data->id);
			if ( $validator->fails() ) {
				return response()->json(['type' => 'error', 'error'=>$validator->errors(), 'message' => getLabels('template_saved_errors')]);
			} else {
				$formData              	= $this->request->all();
				
				$template  = $data->update($formData);
				if($template){
					return response()->json(['type' => 'success', 'url'=> url(env('ADMIN_PREFIX'), 'templates'), 'message' => getLabels('email_template_saved')]);
				}else{
					return response()->json(['type' => 'error', 'url'=> url(env('ADMIN_PREFIX'), 'templates'), 'message' => getLabels('something_wrong_try_again')]);
				}
			}
		}
        return view('frontend/templates/admin_edit', compact('data', 'page_title'));
     }
	 
	public function admin_view($slug=null){
		$page_title = "Email Template";
		$data = Template::where('slug', $slug)->first();
		return view('frontend/templates/admin_view', compact('data', 'page_title'));
    }
	 
 }
