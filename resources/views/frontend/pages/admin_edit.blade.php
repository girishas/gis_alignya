@if(empty($_POST))
@extends('frontend/layouts/default')
@endif


@if(empty($_POST))
@section('content')
{!! HTML::style('public/summernote/summernote.css') !!}
	{!! HTML::script('public/summernote/summernote.js') !!}
	
  <main>
  @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('update_page') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'pages') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('Pages') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'pages') !!}">{!! getLabels('Pages') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('update_page') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					{!! Form::model($data, array('url' => array($route_prefix.'/update-page/'.$data->slug), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search')) !!}
						<div class="form-group  position-relative error-l-50">
							<label for="inputTitle">{!! getLabels('Title') !!}</label>
							{!! Form::text('title_en', null, array('class' => 'form-control', 'id' => 'inputTitle',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<?php /* <div class="form-group  position-relative error-l-50">
							<label for="inputTitle">{!! getLabels('Title') !!} ({!! getLabels('spanish') !!})</label>
							{!! Form::text('title_sp', null, array('class' => 'form-control', 'id' => 'inputTitle_sp',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputTitle">{!! getLabels('Title') !!} ({!! getLabels('french') !!})</label>
							{!! Form::text('title_fr', null, array('class' => 'form-control', 'id' => 'inputTitle_fr',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div> */ ?>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! getLabels('slug') !!}</label>
							{!! Form::text('slug', null, array('class' => 'form-control', 'id' => 'inputSlug',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputContent">{!! getLabels('Content') !!} </label>
							{!! Form::textarea('content_en', null, array('class' => 'form-control summernote', 'id' => 'inputContent',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<?php /* <div class="form-group  position-relative error-l-50">
							<label for="inputContent">{!! getLabels('Content') !!}  ({!! getLabels('spanish') !!})</label>
							{!! Form::textarea('content_sp', null, array('class' => 'form-control summernote', 'id' => 'inputContent_sp',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputContent">{!! getLabels('Content') !!}  ({!! getLabels('french') !!})</label>
							{!! Form::textarea('content_fr', null, array('class' => 'form-control summernote', 'id' => 'inputContent_fr',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div> */ ?>
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputMetaTitle">{!! getLabels('meta_title') !!}</label>
							{!! Form::text('meta_title', null, array('class' => 'form-control', 'id' => 'inputMetaTitle',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputMetaKeywords">{!! getLabels('meta_keywords') !!}</label>
							{!! Form::text('meta_keywords', null, array('class' => 'form-control', 'id' => 'inputMetaKeywords',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputMetaDescription">{!! getLabels('meta_description') !!}</label>
							{!! Form::textarea('meta_description', null, array('class' => 'form-control', 'rows'=>2, 'id' => 'inputMetaDescription',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-row">
							<div class="form-group col-md-3 position-relative error-l-50">
								<label for="inputStatus">{!! getLabels('status') !!}</label>
								{!! Form::select('status', config('constants.STATUS'), null, array('class' => 'form-control', "id"=>"inputStatus"))!!}
								<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						<div class="form-group">
							<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
							<a href="{!! url($route_prefix, 'pages') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
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
				height: 300,
				popover: {
				image: [],
				link: [],
				air: []
				}
			});
			
			jQuery("#inputSlug").keyup(function (e) {
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
