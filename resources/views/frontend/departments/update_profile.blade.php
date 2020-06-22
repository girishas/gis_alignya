@if(empty($_POST))
@extends('frontend/layouts/default')
@endif


@if(empty($_POST))
@section('content')
	{!! HTML::style('public/slimcropper/css/slim.css') !!}
	{!! HTML::style('public/slimcropper/css/style.css') !!}
	{!! HTML::script('public/slimcropper/js/slim.kickstart.min.js') !!}
	
  <main>
  @endif
	
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('update_profile') !!}</h1>
					
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, Auth::User()->uniq_username) !!}">{!! getLabels('my_profile') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('update_profile') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
	
					{!! Form::open(array('url' => "", 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
						
						<div class="form-row">
							
							<div class="form-group  position-relative error-l-100 col-md-12">
								<label for="inputFirstname">{!! getLabels('company_name') !!}</label>
								{!! Form::text('company_name', 'abc private Ltd', array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							
						</div>
						
						<div class="form-row">
							<div class="form-group  position-relative error-l-40 col-md-6">
								<label for="inputEmail4">{!! getLabels('email') !!}</label>
								{!! Form::text('email', 'dev.girishas@test.com', array( 'class' => 'form-control', "id"=>"inputEmail4", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMobile">{!! getLabels('contact_number') !!}</label>
								{!! Form::text('mobile', '6575757654', array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
						</div>
						
					
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputAboutYou">{!! getLabels('about') !!}</label>
							{!! Form::textarea('about', 'I spend my whole day, practically every day, experimenting with HTML, CSS, and JavaScript through a few hundred RSS feeds. I build websites that delight and inform. I do it well.', array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						<div class="form-group  position-relative error-l-100">
							<label for="inputAboutYou">{!! getLabels('mission') !!}</label>
							{!! Form::textarea('mission', 'Wedding cake with flowers Macarons and blueberries Wedding cake with flowers Macarons and blueberries', array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						<div class="form-group  position-relative error-l-100">
							<label for="inputAboutYou">{!! getLabels('vision') !!}</label>
							{!! Form::textarea('vision', 'Wedding cake with flowers Macarons and blueberries Wedding cake with flowers Macarons and blueberries', array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						<div class="form-group  position-relative error-l-100">
							<label for="inputAboutYou">{!! getLabels('value') !!}</label>
							{!! Form::textarea('value', 'Wedding cake with flowers Macarons and blueberries', array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div><div class="form-group  position-relative error-l-100">
							<label for="inputAboutYou">{!! getLabels('address') !!}</label>
							{!! Form::textarea('value', 'Nairobi, Kenya', array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						
						<div class="form-group ">
						<button type="submit" class="btn btn-primary">{!! getLabels('update') !!}</button>&nbsp;&nbsp;
						<a href="{!! url($route_prefix, 'users') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
        </div>
		
	@if(empty($_POST))
    </main>
@stop
@endif