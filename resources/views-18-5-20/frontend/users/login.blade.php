@extends('frontend/layouts/default')

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
                                {!! getLabels('use_credentials_for_login') !!}
								@if($route_prefix != env('ADMIN_PREFIX'))
									<br>{!! getLabels('not_a_member') !!}
									 <a href="{!! url('register') !!}" class="steamerst_link white">{!! getLabels('register') !!}</a>.
								@endif
                            </p>
                        </div>
                        <div class="form-side">
							<a class="steamerst_link" href="{!! url($route_prefix, 'login') !!}">
								<h1 style="font-weight:800;">{!! config('constants.SITE_TITLE') !!}</h1>
							</a>
							@include('frontend/alert_message')
							<div class="alert alert-danger" role="alert" id="error_alert" style="display:none;">
                                This is a danger alert—check it out!
                            </div>
                            <h6 class="mb-4">{!! getLabels('login') !!} </h6>
                           {!! Form::open(array('url' => url($route_prefix.'/login'), 'class'=>'steamerstudio_formlogin', 'id'=>'login', 'files' => true))!!}
                                <label class="form-group has-float-label mb-4">
                                   {!! Form::text("email", null, array("class"=>"form-control")) !!}
                                    <span>{!! getLabels('email') !!}</span>
                                </label>

                                <label class="form-group has-float-label mb-4">
									{!! Form::password("password2",array("class"=>"form-control")) !!}
                                    <span>{!! getLabels('password') !!}</span>
                                </label>
                                <div class="d-flex justify-content-between {!! ($route_prefix == env('ADMIN_PREFIX'))?'float-right':'align-items-center' !!}">
									@if($route_prefix != env('ADMIN_PREFIX'))
										<a href="{!! url('forgot-password') !!}" class="steamerst_link">{!! getLabels('forget_password') !!}?</a>
									@endif
                                    <button class="btn btn-primary btn-lg btn-shadow text-uppercase" type="submit">{!! getLabels('login') !!}</button>
                                </div>
							{!! Form::Close() !!}
							<div style="clear:both;"></div>
							 <div class="d-flex flex-row mb-3 mt-3">
								<a class="btn btn-primary" onclick="applogin(this)" rel="{{ url('auth/facebook') }}" href="javascript:void(0);" style="width:100%;">Facebook</a>&nbsp;&nbsp;
								<a class="btn btn-primary" onclick="applogin(this)" rel="{{ url('auth/google') }}" href="javascript:void(0);" style=" background-color:#d9534f;border-color:#d9534f;width:100%;">Google</a>
							</div>
							 <div class="d-flex flex-row mb-3 mt-3">
								<a class="btn btn-primary" onclick="applogin(this)" rel="{{ url('auth/mixer') }}" href="javascript:void(0);" style=" background-color:#152C5A;border-color:#152C5A;width:100%;">Mixer</a>&nbsp;&nbsp;
								<a class="btn btn-primary" onclick="applogin(this)" rel="{{ url('auth/twitch') }}" href="javascript:void(0);" style="background-color:#6441A4;border-color:#6441A4;width:100%;">Twitch</a>
								<?php /* <a class="btn btn-primary" onclick="applogin(this)" rel="{{ url('auth/twitter') }}" href="javascript:void(0);" style="background-color:#twitter;border-color:#twitter;width:100%;">Twitter</a>&nbsp;&nbsp;
								<a class="btn btn-primary" onclick="applogin(this)" rel="{{ url('auth/linkdin') }}" href="javascript:void(0);" style="background-color:#0078B6;border-color:#0078B6;width:100%;">Linkdin</a> */ ?>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
	@if(Auth::check()){
		<script type="text/javascript">
			pageUrl = SITE_URL+'dashboard';
			$.cergis.loadContent();
			e.preventDefault();
		</script>
	@endif
	<script type="text/javascript">
		$("body").on('submit', ".steamerstudio_formlogin", function(e) {
			e.preventDefault();
			var form_action = $(this).attr('action');
			pageUrl = SITE_URL+'dashboard';
			data = $(this).serialize();
			$.ajax({
				type:"POST",
				url: form_action,
				data:data,
				dataType:'json',
				success: function (response) {
					console.log(response);
					if(response.status == 'error'){
						jQuery('#error_alert').show();
						jQuery('#error_alert').html(response.message);
					}else{
						if(response.header){
							jQuery('#main-content-navigation').html(response.header);
							jQuery('#main-content-navigation').append(response.navigation);
						}
						new $.dore(this);
						$.cergis.loadContent();
						e.preventDefault();
					}
				},
				 error: function(xhr, ajaxOptions, thrownError) {
				  console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		});
	</script>
@stop