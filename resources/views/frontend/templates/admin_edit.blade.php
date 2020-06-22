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
                    <h1>{!! getLabels('update_email_template') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'templates') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('Email_Templates') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'templates') !!}">{!! getLabels('Email_Templates') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('update_email_template') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					{!! Form::model($data, array('url' => array($route_prefix.'/templates/edit/'.$data->slug), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search')) !!}
						<div class="form-group  position-relative error-l-50">
							<label for="inputTitle">{!! getLabels('Name') !!}</label>
							{!! Form::text('name', null, array('class' => 'form-control', 'id' => 'inputTitle',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! getLabels('slug') !!}</label>
							{!! Form::text('slug', null, array('class' => 'form-control', 'id' => 'inputSlug',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-60">
							<label for="inputMetaTitle">{!! getLabels('subject') !!}</label>
							{!! Form::text('subject_en', null, array('class' => 'form-control',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<?php /* <div class="form-group  position-relative error-l-60">
							<label for="inputMetaTitle">{!! getLabels('subject') !!} ({!! getLabels('spanish') !!})</label>
							{!! Form::text('subject_sp', null, array('class' => 'form-control',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-60">
							<label for="inputMetaTitle">{!! getLabels('subject') !!} ({!! getLabels('french') !!})</label>
							{!! Form::text('subject_fr', null, array('class' => 'form-control', 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div> */ ?>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputContent">{!! getLabels('Content') !!}</label>
							{!! Form::textarea('content_en', null, array('class' => 'form-control summernote', 'id' => 'inputContent',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<?php /* <div class="form-group  position-relative error-l-50">
							<label for="inputContent">{!! getLabels('Content') !!} ({!! getLabels('spanish') !!})</label>
							{!! Form::textarea('content_sp', null, array('class' => 'form-control summernote', 'id' => 'inputContent',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputContent">{!! getLabels('Content') !!} ({!! getLabels('french') !!})</label>
							{!! Form::textarea('content_fr', null, array('class' => 'form-control summernote', 'id' => 'inputContent',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div> */ ?>
						
						
						<div class="form-group  position-relative error-l-60">
							<label for="inputMetaDescription">{!! getLabels('shortcodes') !!}</label>
							{!! Form::textarea('description', null, array('class' => 'form-control', 'rows'=>4, 'id' => 'inputMetaDescription',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
							<a href="{!! url($route_prefix, 'templates') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
        </div>
	@if(empty($_POST))
    </main>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('.summernote').summernote({
				height: 200,
				popover: {
				image: [],
				link: [],
				air: []
				}
			});
			
			jQuery("#inputTitle, #inputSlug").keyup(function (e) {
				var Text = jQuery(this).val();
				if(Text != ""){
					var slug = Text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
					jQuery("#inputSlug").val(slug);
				}
			});
		});
	</script>
@stop
@endif
