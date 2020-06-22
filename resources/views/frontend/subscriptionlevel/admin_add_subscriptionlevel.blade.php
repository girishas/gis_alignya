@extends('frontend/layouts/default')

@section('content')
  <main>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h1>{!! getLabels('add_level_commission') !!} </h1>
				<div class="text-zero top-right-button-container">
					<a href="{!! url($route_prefix, 'subscriptionlevel') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('Subscription_Level') !!}</a>
				</div>
				<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
					<ol class="breadcrumb pt-0">
						<li class="breadcrumb-item">
							<a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
						</li>
						  <li class="breadcrumb-item">
							<a class="steamerst_link" href="{!! url($route_prefix, 'subscriptionlevel') !!}">{!! getLabels('Subscription_Level') !!}</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{!! getLabels('add_level_commission') !!}</li>
					</ol>
				</nav>
				<div class="separator mb-5"></div>
			</div>
		</div>
			
			
		<div class="card mb-4">
			<div class="card-body">
				
				{!! Form::open(array('url' => array($route_prefix.'/subscriptionlevel/add'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search')) !!}
					<div class="form-group  position-relative error-l-50 col-md-6">
						<label for="inputSlug">{!! getLabels('level') !!}</label>
						{!! Form::select('level_id',config('constants.LEVELS'),null, array('class' => 'form-control')) !!}
						<div class="invalid-tooltip"></div>
					</div>
					<div class="form-group  position-relative error-l-50 col-md-6">
						<label for="inputTitle">{!! getLabels('processing_fees') !!}</label>
						{!! Form::text('fees', null, array('class' => 'form-control', 'id' => 'fees',  'placeholder'=> ''))!!}
						<div class="invalid-tooltip"></div>
					</div>
					
					<div class="form-group  position-relative error-l-100 col-md-6">
						<label for="inputSlug">{!! getLabels('fixed_amount') !!}</label>
						{!! Form::text('fixed_amount', null, array('class' => 'form-control', 'id' => 'fixed_amount',  'placeholder'=> ''))!!}
						<div class="invalid-tooltip"></div>
					</div>
					
					<div class="form-group  position-relative error-l-50 col-md-6">
						<label for="inputTitle">{!! getLabels('admin_commission') !!}</label>
						{!! Form::text('admin_commission', null, array('class' => 'form-control', 'id' => 'fees',  'placeholder'=> ''))!!}
						<div class="invalid-tooltip"></div>
					</div>
	
					<div class="form-group">
						<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
						<a href="{!! url($route_prefix, 'subscriptionlevel') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
    </div>

</main>
@stop