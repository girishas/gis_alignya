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
                    <h1>{!! getLabels('Add New Department') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'teams') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('Departments') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'teams') !!}">{!! getLabels('Departments') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Add New Department') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					{!! Form::open(array('url' => array($route_prefix.'/department/new'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
						
						<div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputFirstname">{!! getLabels('Department Name') !!}</label>
								{!! Form::text('department_name', null, array('class' => 'form-control', 'id' => 'inputTeamname',  'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMembers">{!! getLabels('Parent Department') !!}</label>
                                <select class="form-control select2-single" name="parent_department_id" data-width="100%">
                                	<option value="0">Root Department</option>
                                	@foreach($Parentdepartments as $key => $value)
                                    	<option value="{!!$key!!}">{!!$value!!}</option>
                                    @endforeach
                                </select>						
								<div class="invalid-tooltip"></div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMembers">{!! getLabels('Department Head') !!}</label>
                                <select class="form-control select2-single" name="department_head" data-width="100%">
                                	<option label="&nbsp;"></option>
                                	@foreach($members as $key => $value)
                                    	<option value="{!!$key!!}">{!!$value!!}</option>
                                    @endforeach
                                </select>						
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMembers">{!! getLabels('Department Members') !!}</label>
                                <select name = "department_members[]" class="form-control select2-multiple" multiple="multiple" data-width="100%">
                                	@foreach($members as $key => $value)
                                    	<option value="{!!$key!!}">{!!$value!!}</option>
                                    @endforeach
                                </select>
							</div>							
						</div>

						
						
						
						<div class="form-group  position-relative error-l-100">
						<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
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