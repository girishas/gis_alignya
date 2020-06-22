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
                    <h1>{!! getLabels('add_new_badge') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'badges1234') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('badges_list') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'badges') !!}">{!! getLabels('Badges') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('add_new_badge') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					{!! Form::open(array('url' => array($route_prefix.'/badges/add'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="">{!! getLabels('Icon') !!}</label>
								<div class="slim" data-ratio="1:1" data-instant-edit="true">
									<input type="file" name="image"/>
								</div>
							</div>
							
						</div>
					 <div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label>{!! getLabels('Title') !!}</label>
								{!! Form::text('title', null, array('class' => 'form-control', 'id' => 'title',  'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label>{!! getLabels('slug') !!}</label>
								{!! Form::text('slug', null, array('class' => 'form-control', 'id' => 'slug',  'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
						</div> 
						
						 <div class="form-row">
							<div class="form-group  position-relative error-l-40 col-md-6">
								<label>{!! str_singular(getLabels('Languages')) !!}</label>
								{!! Form::number('langauge_id', null, array('class' => 'form-control', "id"=>"langauge_id", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-6">
								<label>{!! getLabels('points') !!}</label>
								{!! Form::number('points', null, array('class' => 'form-control', "id"=>"points", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
						</div>

						 
						<!-- <div class="form-row">
							<div class="form-group  position-relative error-l-40 col-md-6">
								<label>Value</label>
								{!! Form::text('value', null, array('class' => 'form-control', "id"=>"value", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-6">
								<label>Criterias</label>
								{!! Form::text('criterias', null, array('class' => 'form-control', "id"=>"criterias", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
						</div> -->

						<div class="form-row">
							<div class="form-group  position-relative error-l-40 col-md-6">
								<label>{!! getLabels('reason') !!}</label>
								{!! Form::text('reason', null, array('class' => 'form-control', "id"=>"reason", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-6">
								<label>{!! getLabels('status') !!} </label>
							{!! Form::select('status', array('' => 'Please Select','1' => 'active', '2' => 'redeemed'),null, array('class' =>'form-control'))!!}
							<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
						<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
						<a href="{!! url($route_prefix, 'badges') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
        </div>
	@if(empty($_POST))
    </main>
@stop
@endif