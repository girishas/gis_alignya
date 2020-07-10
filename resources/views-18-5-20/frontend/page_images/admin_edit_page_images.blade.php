@extends('frontend/layouts/default')

@section('content')
	{!! HTML::style('public/slimcropper/css/slim.css') !!}
	{!! HTML::style('public/slimcropper/css/style.css') !!}
	{!! HTML::script('public/slimcropper/js/slim.kickstart.min.js') !!}
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('update_page_images') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'page_images') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('Page_Images') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'page_images') !!}">{!! getLabels('Page_Images') !!}</a>
                            </li>
							  <li class="breadcrumb-item active" aria-current="page">{!! getLabels('update_page_images') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					{!! Form::model($data, array('url' => array($route_prefix.'/page_images/edit/'.$data->id), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
						
						
					
						 <div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-4">
								<label>{!! getLabels('slug') !!}</label>
								{!! Form::text('slug', null, array('class' => 'form-control', 'id' => 'slug',  'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-4">
								<label>{!! getLabels('Title') !!}</label>
								{!! Form::text('page_title', null, array('class' => 'form-control', 'id' => 'page_title',  'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-4">
								<label>{!! getLabels('type') !!} </label>
								{!! Form::select('type', ['' => getLabels('please_select'), '1' => getLabels('image'), '2' => getLabels('video')], null, array('class' => 'form-control', 'id' => 'type'))!!}
								<div class="invalid-tooltip"></div>
							</div>

						</div> 

						<div class="form-row">
							<div class="form-group col-md-3 row_image" id="row_dim1">
								<label for="">{!! getLabels('image') !!}</label>
								<div class="slim" data-instant-edit="true" data-will-remove="profileimageWillBeRemoved">
									@if ( $data->image and file_exists('public/upload/page_images/'. $data->image) )
										{!! HTML::image('public/upload/page_images/'. $data->image, $data->first_name) !!}
									@endif

									<input type="file" name="image"/>
								</div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-12 row_video" id="row_dim">
								<label>{!! getLabels('video') !!}</label>
								{!! Form::text('video', null, array('class' => 'form-control', "id"=>"video", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-12 row_video" id="row_dim2">
								<label>{!! getLabels('width') !!}</label>
								{!! Form::number('width', null, array('class' => 'form-control', "id"=>"width", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-12 row_video" id="row_dim3">
								<label>{!! getLabels('height') !!}</label>
								{!! Form::number('height', null, array('class' => 'form-control', "id"=>"height", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group position-relative error-l-40 col-md-12">
								<label>{!! getLabels('status') !!} </label>
							{!! Form::select('status', array('' => getLabels('please_select'),'1' => getLabels('active'), '2' => getLabels('inactive')),null, array('class' =>'form-control'))!!}
							<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
						<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
						<a href="{!! url($route_prefix, 'page_images') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
        </div>
    </main>
	
    <script type="text/javascript">
		var selected_value = '{!! !empty($data->type)?$data->type:"" !!}';
    	$(function() {
			showSelectedTypeMedia(selected_value);
			$('body').on('change', '#type', function(e){
				selected_value = $(this).val();
				showSelectedTypeMedia(selected_value);
			});
		});
		
		function showSelectedTypeMedia(selected_value){
			$('.row_image').hide(); 
			$('.row_video').hide(); 
			if(selected_value == '2') {
				$('.row_video').show(); 
			} else if(selected_value == '1') {
				$('.row_image').show(); 
			} 
		}

    </script>
@stop