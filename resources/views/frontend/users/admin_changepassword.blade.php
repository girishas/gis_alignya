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
                    <h1>{!! getLabels('Change_Password') !!} : {!! $data->first_name." ".$data->last_name !!} </h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'users') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('Users') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'users') !!}">{!! getLabels('Users') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Change_Password') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			 <div class="row">
                <div class="offset-3 col-6">
				   <div class="card mb-4">
						<div class="card-body">
							
							{!! Form::open(array('url' => array($route_prefix.'/users-chnagepassword/'.$data->uniq_username), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
								
								<div class="form-group  position-relative error-l-150">
									<label>{!! getLabels('New_Password') !!}</label>
									{!! Form::password("new_password", array("class"=>"form-control")) !!}
									<div class="invalid-tooltip"></div>
								</div>

								<div class="form-group  position-relative error-l-150">
									<label>{!! getLabels('Confirm_New_Password') !!}</label>
									{!! Form::password("confirm_new_password", array("class"=>"form-control")) !!}
									<div class="invalid-tooltip"></div>
								</div>
									
								<div class="form-group  position-relative error-l-100">
								<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
								<a href="{!! url($route_prefix, 'users') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
								</div>
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
        </div>
	@if(empty($_POST))
    </main>
@stop
@endif