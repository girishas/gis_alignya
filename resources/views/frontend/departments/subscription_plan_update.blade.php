@if(empty($_POST))
@extends('frontend/layouts/default')
@endif


@if(empty($_POST))
@section('content')
	
  <main>
  @endif
  
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Update Plan') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'subscription-plans') !!}" class="steamerst_link btn btn-primary btn-sm top-right-button mr-1">{!! getLabels('Plan') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'subscription-plans') !!}">{!! getLabels('Plan') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Update Plan') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					{!! Form::model($data, array('url' => array($route_prefix.'/subscription-plan/update/'.$data->id), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
						
						<div class="form-row">
							
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputFirstname">{!! getLabels('Name') !!}</label>
								{!! Form::text('heading', null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputLastname">{!! getLabels('emp_limit') !!}</label>
								{!! Form::text('emp_limit', null, array('class' => 'form-control', 'id' => 'inputLastname',  'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						<div class="form-row">
							
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMobile">{!! getLabels('plan_fees') !!}</label>
								{!! Form::text('plan_fee', null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							
						</div>
						
						<div class="form-group ">
						<button type="submit" class="btn btn-primary">{!! getLabels('update') !!}</button>&nbsp;&nbsp;
						<a href="{!! url($route_prefix, 'subscription-plans') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
        </div>
		
	@if(empty($_POST))
    </main>
@stop
@endif