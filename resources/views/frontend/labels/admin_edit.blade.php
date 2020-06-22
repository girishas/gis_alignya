@extends('frontend/layouts/default')

@section('content')
	<main>
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<h1>{!! getLabels('update_label') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'labels') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('Labels') !!}</a>
					</div>
					<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
						<ol class="breadcrumb pt-0">
							<li class="breadcrumb-item">
								<a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
							</li>
							  <li class="breadcrumb-item">
								<a class="steamerst_link" href="{!! url($route_prefix, 'labels') !!}">{!! getLabels('Labels') !!}</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">{!! getLabels('update_label') !!}</li>
						</ol>
					</nav>
					<div class="separator mb-5"></div>
				</div>
			</div>
			
			
		   <div class="card mb-4">
				<div class="card-body">
					
					{!! Form::model($data, array('url' => array($route_prefix.'/labels/edit/'.$data->id), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}

						<div class="form-group  position-relative error-l-50">
							<label for="inputTitle">{!! getLabels('label_key') !!}</label>
							{!! Form::text('label_key', null, array('class' => 'form-control', 'id' => 'label_key',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! str_singular(getLabels('Labels')) !!}</label>
							{!! Form::text('label_text_en', null, array('class' => 'form-control', 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>

						<?php /* <div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! str_singular(getLabels('Labels')) !!} ({!! getLabels('spanish') !!})</label>
							{!! Form::text('label_text_sp', null, array('class' => 'form-control', 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! str_singular(getLabels('Labels')) !!} ({!! getLabels('french') !!})</label>
							{!! Form::text('label_text_fr', null, array('class' => 'form-control', 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div> */ ?>
							
						<div class="form-group  position-relative error-l-100">
							<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
							<a href="{!! url($route_prefix, 'labels') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
    </main>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#label_key").keyup(function (e) {
				var Text = jQuery(this).val();
				if(Text != ""){
					var slug = Text.toLowerCase().replace(/ /g,'_').replace(/[^\w-]+/g,'');
					jQuery("#label_key").val(slug);
				}
			});
		});
	</script>
@stop