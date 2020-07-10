@extends('frontend/layouts/default')

@section('content')
	{!! HTML::style('public/slimcropper/css/slim.css') !!}
	{!! HTML::style('public/slimcropper/css/style.css') !!}
	{!! HTML::script('public/slimcropper/js/slim.kickstart.min.js') !!}
  <main>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h1>{!! $page_title !!} </h1>
				<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
					<ol class="breadcrumb pt-0">
						<li class="breadcrumb-item">
							<a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
						</li>
						  <li class="breadcrumb-item">
							<a class="steamerst_link" href="{!! url($route_prefix, 'subscription-plans') !!}">{!! getLabels('Subscription_Plans') !!}</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{!! $page_title !!}</li>
					</ol>
				</nav>
				<div class="separator mb-5"></div>
			</div>
		</div>
			
			
		<div class="card mb-4">
			<div class="card-body">
				
				{!! Form::model($data, array('url' => array($route_prefix.'/add-subscription-plan/'.$id), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search')) !!}
					<div class="form-group  position-relative error-l-50 col-md-6">
						<label for="inputSlug">{!! getLabels('Name') !!}</label>
						{!! Form::text('name', null, array('class' => 'form-control')) !!}
						<div class="invalid-tooltip"></div>
					</div>
					
					<div class="form-group col-md-2">
						<label for="">{!! getLabels('image') !!}</label>
						<div class="slim" data-ratio="1:1" data-instant-edit="true" >
							@if ( !empty($data->image) and file_exists('public/upload/plans/'. $data->image) )
								{!! HTML::image('public/upload/plans/'. $data->image, $data->name) !!}
							@endif
							<input type="file" name="image" />
						</div>
					</div>
					
					<div class="form-group  position-relative error-l-50 col-md-6">
						<label for="inputTitle">{!! getLabels('price') !!}</label>
						{!! Form::text('price', null, array('class' => 'form-control', 'id' => 'price'))!!}
						<div class="invalid-tooltip"></div>
					</div>
					
					<div class="form-group  position-relative error-l-50 col-md-6">
						<label for="inputSlug">{!! getLabels('level') !!}</label>
						{!! Form::select('level_id',config('constants.LEVELS'),null, array('class' => 'form-control')) !!}
						<div class="invalid-tooltip"></div>
					</div>
					
					<?php /* <div class="form-group  position-relative error-l-50 col-md-6">
						<label for="inputSlug">Allowed Content</label>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="customCheckText">
							<label class="custom-control-label" for="customCheckText">Text</label>
						</div>
						
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="customCheckImage">
							<label class="custom-control-label" for="customCheckImage">Image</label>
						</div>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="customCheckVideo">
							<label class="custom-control-label" for="customCheckVideo">Video</label>
						</div>
					</div> */ ?>
					
					
					<div class="form-group  position-relative error-l-100 col-md-6">
						<label for="inputSlug">{!! getLabels('Description') !!}</label>
						{!! Form::textarea('description', null, array('class' => 'form-control summernote', 'rows' => 3))!!}
						<div class="invalid-tooltip"></div>
					</div>
	
					<div class="form-group col-md-6">
						<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
						<a href="{!! url($route_prefix, 'subscription-plans') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
    </div>

</main>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.summernote').summernote({
			height: 200,
				toolbar: [
				['font', ['bold', 'underline', 'clear']],
				['fontname', ['fontname']],
				['para', ['ul', 'ol', 'paragraph']],
			  ],
			popover: {
			image: [],
			link: [],
			air: []
			}
		});
	});
</script>
@stop