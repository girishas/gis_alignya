@extends('frontend/layouts/default')

@section('content')
	{!! HTML::style('public/slimcropper/css/slim.css') !!}
	{!! HTML::style('public/slimcropper/css/style.css') !!}
	{!! HTML::script('public/slimcropper/js/slim.kickstart.min.js') !!}
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('add_new_language') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'languages') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('Languages') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'languages') !!}">{!! getLabels('Languages') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('add_new_language') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					{!! Form::open(array('url' => array($route_prefix.'/languages/add'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="">{!! getLabels('Icon') !!}</label>
								<div class="slim" data-ratio="3:2" data-instant-edit="true">
									<input type="file" name="icon"/>
								</div>
							</div>
						</div>
						
					
						<div class="form-group  position-relative error-l-100">
							<label>{!! getLabels('Name') !!}</label>
							{!! Form::text('name', null, array('class' => 'form-control', "id"=>"name", 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						<div class="form-group  position-relative error-l-40">
							<label>{!! getLabels('code') !!}</label>
							{!! Form::text('code', null, array('required', "maxlength"=>"3"'class' => 'form-control', "id"=>"code", 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						<div class="form-group  position-relative error-l-100">
							<label>{!! getLabels('status') !!} </label>
							{!! Form::select('status', array('' => getLabels('please_select'),'0' => getLabels('inactive'), '1' => getLabels('active')),null, array('class' =>'form-control')) !!}
							<div class="invalid-tooltip"></div>
						</div>
							
						<div class="form-group  position-relative error-l-100">
						<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
						<a href="{!! url($route_prefix, 'languages') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
        </div>
    </main>
@stop