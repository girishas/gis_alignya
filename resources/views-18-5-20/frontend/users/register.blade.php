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
                                {!! getLabels('form_to_register') !!}
                                <br>{!! getLabels('you_are_a_member') !!} 
                                 <a href="{!! url('login') !!}" class="steamerst_link white">{!! getLabels('login') !!}</a>.
                            </p>
                        </div>
                        <div class="form-side">
							<a class="steamerst_link" href="{!! url($route_prefix, 'login') !!}">
								<h1 style="font-weight:800;">{!! config('constants.SITE_TITLE') !!}</h1>
							</a>
                            <h6 class="mb-4">{!! getLabels('register') !!}</h6>
                           {!! Form::open(array('url' => url('/register'), 'class'=>'steamerstudio_form needs-validation tooltip-label-right', 'id'=>'login', 'files' => true))!!}
								<label class="form-group has-float-label position-relative error-l-100 mb-4">
                                   {!! Form::text("first_name", null, array("class"=>"form-control")) !!}
								   <div class="invalid-tooltip"></div>
                                    <span>{!! getLabels('first_name') !!}*</span>
                                </label>
								<label class="form-group has-float-label mb-4 position-relative error-l-100">
                                   {!! Form::text("last_name", null, array("class"=>"form-control")) !!}
								   <div class="invalid-tooltip"></div>
                                    <span>{!! getLabels('last_name') !!}</span>
                                </label>
                                <label class="form-group has-float-label mb-4 position-relative error-l-100">
                                   {!! Form::text("email", null, array("class"=>"form-control")) !!}
								   <div class="invalid-tooltip"></div>
                                    <span>{!! getLabels('email') !!}*</span>
                                </label>

                                <label class="form-group has-float-label mb-4 position-relative error-l-100">
									{!! Form::password("password",array("class"=>"form-control")) !!}
									<div class="invalid-tooltip"></div>
                                    <span>{!! getLabels('password') !!}*</span>
                                </label>
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn btn-primary btn-lg btn-shadow text-uppercase" type="submit">{!! getLabels('register') !!}</button>
                                </div>
							{!! Form::Close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
	<script type="text/javascript">
		$("body").on('submit', ".steamerstudio_formlogin", function(e) {
			pageUrl = "{!! url($route_prefix, 'login') !!}";
			e.preventDefault();
			$.cergis.loadContent();
			e.preventDefault();
		});
		
	</script>
@stop