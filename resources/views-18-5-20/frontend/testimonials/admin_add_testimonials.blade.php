@extends('frontend/layouts/default')

@section('content')
	{!! HTML::style('public/slimcropper/css/slim.css') !!}
	{!! HTML::style('public/slimcropper/css/style.css') !!}
	{!! HTML::script('public/slimcropper/js/slim.kickstart.min.js') !!}
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('add_new_testimonials') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'testimonials') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('Testimonials') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'testimonials') !!}">{!! getLabels('Testimonials') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('add_new_testimonials') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
            <div class="card mb-4">
				<div class="card-body">
					
					{!! Form::open(array('url' => array($route_prefix.'/testimonials/add'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search')) !!}

					<div class="form-row">
							<div class="form-group col-md-3">
								<label for="">{!! getLabels('image') !!}</label>
								<div class="slim" data-ratio="1:1" data-instant-edit="true">
									<input type="file" name="image"/>
								</div>
							</div>
							
						</div>

						<div class="form-group  position-relative error-l-50">
							<label for="inputTitle">{!! getLabels('Name') !!}</label>
							{!! Form::text('name', null, array('class' => 'form-control', 'id' => 'name'))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! getLabels('designation') !!}</label>
							{!! Form::text('designation', null, array('class' => 'form-control', 'id' => 'designation'))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputSlug">{!! getLabels('Content') !!}</label>
							{!! Form::textarea('content', null, array('class' => 'form-control', 'id' => 'content',  'rows' => '2'))!!}
							<div class="invalid-tooltip"></div>	
						</div>
						<div class="form-group  position-relative error-l-100">
								<label>{!! getLabels('status') !!} </label>
							{!! Form::select('status', array('' => getLabels('please_select'),'1' => getLabels('active'), '2' => getLabels('inactive')),null, array('class' =>'form-control'))!!}
							<div class="invalid-tooltip"></div>
							</div>
						
						<div class="form-group">
							<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
							<a href="{!! url($route_prefix, 'testimonials') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
        </div>
	 </main>
@stop