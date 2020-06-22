@extends('frontend/layouts/default')

@section('content')
	<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('application_settings') !!}</h1>
					<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                           <li class="breadcrumb-item active" aria-current="page">{!! getLabels('application_settings') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					{!! Form::open(array('url' => array($route_prefix.'/settings'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search')) !!}
						@foreach($data as $val)
							<div class="form-group  position-relative error-l-150">
								<label for="input{!! $val->slug !!}">{!!$val->label!!}</label>
								@if($val->type == 'textarea')
									{!! Form::textarea($val->slug, $val->value, array('rows'=>3, 'id' => 'input'.$val->slug, 'style'=>'resize:none;', 'class' => 'form-control '))!!}
								@elseif($val->type == 'text')
									{!! Form::text($val->slug, $val->value, array('id' => 'input'.$val->slug, 'class' => 'form-control'))!!}
								@else
									{!! Form::text($val->slug, $val->value, array('id' => 'input'.$val->slug, 'class' => 'form-control '))!!}
								@endif
								@if($val->description)
									<span> {!! $val->description !!} </span></br>
								@endif
								<div class="invalid-tooltip"></div>
							</div>
						@endforeach
						<div class="form-group">
							<button type="submit" class="btn btn-primary">{!! getLabels('update') !!}</button>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
        </div>
    </main>
@stop