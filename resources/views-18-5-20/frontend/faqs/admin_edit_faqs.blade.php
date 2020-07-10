@extends('frontend/layouts/default')

@section('content')
	<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('update_faqs') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'faqs') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('Faqs') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'faqs') !!}">{!! getLabels('Faqs') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('update_faqs') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					{!! Form::model($data, array('url' => array($route_prefix.'/faqs/edit/'.$data->id), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}

						<div class="form-group  position-relative error-l-50">
							<label for="inputTitle">{!! getLabels('slug') !!}</label>
							{!! Form::text('slug', null, array('class' => 'form-control', 'id' => 'slug',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! getLabels('question') !!} {!! getLabels('english') !!}</label>
							{!! Form::text('question_en', null, array('class' => 'form-control', 'id' => 'question_en',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! getLabels('question') !!} {!! getLabels('spanish') !!}</label>
							{!! Form::text('question_sp', null, array('class' => 'form-control', 'id' => 'question_sp',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! getLabels('question') !!} {!! getLabels('french') !!}</label>
							{!! Form::text('question_fr', null, array('class' => 'form-control', 'id' => 'question_fr',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>

						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! getLabels('answer') !!} {!! getLabels('english') !!}</label>
							{!! Form::text('answer_en', null, array('class' => 'form-control', 'id' => 'answer_en',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! getLabels('answer') !!} {!! getLabels('spanish') !!}</label>
							{!! Form::text('answer_sp', null, array('class' => 'form-control', 'id' => 'answer_sp',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! getLabels('answer') !!} {!! getLabels('french') !!}</label>
							{!! Form::text('answer_fr', null, array('class' => 'form-control', 'id' => 'answer_fr',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
							
						<div class="form-group  position-relative error-l-100">
						<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
						<a href="{!! url($route_prefix, 'faqs') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
        </div>
    </main>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#slug").keyup(function (e) {
				var Text = jQuery(this).val();
				if(Text != ""){
					var slug = Text.toLowerCase().replace(/ /g,'_').replace(/[^\w-]+/g,'');
					jQuery("#slug").val(slug);
				}
			});
		});
	</script>
@stop