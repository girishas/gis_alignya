@extends('frontend/layouts/default')
@section('title')
	{!! $page_title !!}
@stop

@section('content')
 <div class="fixed-background" style="opacity:1;"></div>
    <main style="opacity:1;">
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side ">

                            <p class=" text-white h2">{!! getLabels('magic_is_in_the_details') !!}</p>

                            <p class="white mb-0">
                               {!! getLabels('please_reset_your_password') !!} 
                                <br>{!! getLabels('not_a_member') !!}
								 <a href="{!! url('register') !!}" class="white steamerst_link">{!! getLabels('register') !!}</a>
                            </p>
                        </div>
                        <div class="form-side">
							<a class="steamerst_link" href="{!! url($route_prefix, 'login') !!}">
								{!! HTML::image("public/img/logo.png", "Logo", array("class"=>"", 'style'=>"width:250px;margin-bottom:40px;")) !!}
							</a>
                            <h6 class="mb-4">Reset Password</h6>
                           {!! Form::open(array('url' => url('/resetpassword/'.$prefix.'?q='.$hash), 'class'=>'steamerstudio_form needs-validation tooltip-left-bottom', 'id'=>'login', 'files' => true))!!}
                                <label class="form-group has-float-label mb-4 position-relative error-l-100">
                                   {!! Form::password("new_password",  array("class"=>"form-control")) !!}
								   <div class="invalid-tooltip"></div>
                                    <span>{!! getLabels('New_Password') !!}</span>
                                </label>
								
								<label class="form-group has-float-label mb-4 position-relative error-l-100">
                                   {!! Form::password("confirm_new_password",  array("class"=>"form-control")) !!}
								   <div class="invalid-tooltip"></div>
                                    <span>{!! getLabels('Confirm_New_Password') !!}</span>
                                </label>
                               
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn btn-primary btn-lg btn-shadow text-uppercase" type="submit">{!! getLabels('reset') !!}</button>
                                </div>
							{!! Form::Close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop