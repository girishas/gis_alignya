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
                    <h1>Add Subscription</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'subscriptions') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">SUBSCRIPTION LIST</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'subscriptions') !!}">Subscription</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Add New Subscription</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
            <div class="card mb-4">
				<div class="card-body">
					
					{!! Form::open(array('url' => array($route_prefix.'/subscriptions/add'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search')) !!}
					<div class="form-row">
						<div class="form-group  position-relative error-l-100 col-md-6">
							<label for="inputTitle">Transaction Id</label>
							{!! Form::text('transaction_id', null, array('class' => 'form-control', 'id' => 'transaction_id',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-100 col-md-6">
							<label for="inputSlug">Page Creater Id</label>
							{!! Form::text('page_creater_id', null, array('class' => 'form-control', 'id' => 'page_creater_id',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group  position-relative error-l-100 col-md-6">
							<label for="inputSlug">Subscriber User Id</label>
							{!! Form::text('subscriber_user_id', null, array('class' => 'form-control', 'id' => 'subscriber_user_id',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>

						<div class="form-group  position-relative error-l-100 col-md-6">
							<label for="inputSlug">Gift User Id</label>
							{!! Form::text('gift_user_id', null, array('class' => 'form-control', 'id' => 'gift_user_id',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
					</div>
						
					<div class="form-row">
						<div class="form-group  position-relative error-l-100 col-md-6">
							<label>Page Type </label>
							{!! Form::select('page_type', array('' => 'Please_Select','1' => 'User Page Subscription', '2' => 'Social Website Page Subscription', '3' => 'User Page Gift Subscription', '4' => 'Social Website Page Gift Subscription', '5' => 'Smart App Subsciption'),null, array('class' =>'form-control'))!!}
							<div class="invalid-tooltip"></div>	
						</div>

						<div class="form-group  position-relative error-l-100 col-md-6">
							<label for="inputSlug">Page Id</label>
							{!! Form::text('page_id', null, array('class' => 'form-control', 'id' => 'page_id',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group  position-relative error-l-100 col-md-6">
							<label for="inputSlug">App Id</label>
							{!! Form::number('app_id', null, array('class' => 'form-control', 'id' => 'app_id',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>

						<div class="form-group  position-relative error-l-100 col-md-6">
							<label for="inputSlug">Level</label>
							{!! Form::number('level', null, array('class' => 'form-control', 'id' => 'level',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
					</div>

					

					<div class="form-row">
						<div class="form-group  position-relative error-l-100 col-md-6">
							<label for="inputSlug">Plan Id</label>
							{!! Form::number('plan_id', null, array('class' => 'form-control', 'id' => 'plan_id',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>

						<div class="form-group  position-relative error-l-100 col-md-6">
							<label>payout_status </label>
							{!! Form::select('payout_status', array('' => 'Please_Select','0' => 'Not Paid', '1' => 'paid'),null, array('class' =>'form-control'))!!}
							<div class="invalid-tooltip"></div>	
						</div>
					</div>

					<div class="form-row">
						<div class="form-group  position-relative error-l-100 col-md-6">
							<label>Status </label>
							{!! Form::select('status', array('' => 'Please_Select','1' => 'Subscribed', '2' => 'Un-Subscribed'),null, array('class' =>'form-control'))!!}
							<div class="invalid-tooltip"></div>	
						</div>

						<div class="form-group  position-relative error-l-100 col-md-6">
							<label for="inputSlug">Cron Processed</label>
							{!! Form::number('cron_processed', null, array('class' => 'form-control', 'id' => 'cron_processed',  'placeholder'=> '','min' => '1', 'max' => '4'))!!}
							<div class="invalid-tooltip"></div>
						</div>
					</div>

					
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;
							<a href="{!! url($route_prefix, 'subscriptions') !!}" class="btn btn-dark steamerst_link">Back</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
        </div>
	@if(empty($_POST))
    </main>
@stop
@endif