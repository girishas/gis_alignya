@extends('frontend/layouts/default')

@section('content')
 <div class="fixed-background" style="opacity:1;"></div>
    <main style="opacity:1;">
        <div class="container">
			
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
				
                    <div class="card auth-card">
                    	@if($route_prefix != env('ADMIN_PREFIX'))
                        <div class="position-relative image-side ">

                            <p class=" text-white h2">Let's Get Started</p>

                            <p class="white mt-3 mb-5">
                                Join Alignya and develop strategy, create and align goals, set targets and initiatives, get prescriptive insights, manage execution and track progress both in real time and collaboratively. 
                            </p>
							@if($route_prefix != env('ADMIN_PREFIX'))
								  <p class="white mt-0 mb-0"><a href="{!! url('register') !!}" style="width: 100%;" class="btn btn-primary">{!! getLabels('Create_your_account') !!}</a></p>
								@endif
							
                        </div>
                        @endif
                        @if($route_prefix == env('ADMIN_PREFIX'))
                        <div class="form-side" style=" margin-left: 20%;">
                        	@else
                        <div class="form-side">
                        	@endif
							<a class="steamerst_link" href="{!! url($route_prefix, 'login') !!}">
								{!! HTML::image("public/img/logo.png", "Logo", array("class"=>"", 'style'=>"width:250px;margin-bottom:40px;")) !!}
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
							@if($route_prefix != env('ADMIN_PREFIX'))
								<!--  <div class="d-flex flex-row mb-3 mt-3">
									<a class="btn btn-primary" onclick="applogin(this)" rel="{{ url('auth/facebook') }}" href="javascript:void(0);" style="width:100%;"><b>Facebook</b></a>&nbsp;&nbsp;
									<a class="btn btn-primary" onclick="applogin(this)" rel="{{ url('auth/google') }}" href="javascript:void(0);" style="background-color:#d9534f;border-color:#d9534f;width:100%;"><b>YouTube</b></a>
								</div>
								 -->
								
								
								 
							@endif
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