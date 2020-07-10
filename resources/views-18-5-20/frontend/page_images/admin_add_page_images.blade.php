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
                    <h1>{!! getLabels('add_new_page_images') !!}</h1>
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
							  <li class="breadcrumb-item active" aria-current="page">{!! getLabels('add_new_page_images') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					{!! Form::open(array('url' => array($route_prefix.'/page_images/add'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
						
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
								<select name="type" id="type"  class="form-control">
									<option name="" value="">{!! getLabels('please_select') !!}</option>
									<option name="image" value="1">{!! getLabels('image') !!}</option>
									<option name="video" value="2">{!! getLabels('video') !!}</option>
						        </select> 
								<div class="invalid-tooltip"></div>
							</div>
						</div> 

					   
						                          
						
						
						<div class="form-row">	
							<div class="form-group col-md-3" id="row_dim1">
								<label for="">{!! getLabels('image') !!}</label>
								<div class="slim" data-instant-edit="true">
									<input type="file" name="image"/>
								</div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-12" id="row_dim">
								<label>{!! getLabels('video') !!}</label>
								{!! Form::text('video', null, array('class' => 'form-control', "id"=>"video", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-12" id="row_dim2">
								<label>{!! getLabels('width') !!}</label>
								{!! Form::number('width', null, array('class' => 'form-control', "id"=>"width", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-12" id="row_dim3">
								<label>{!! getLabels('height') !!}</label>
								{!! Form::number('height', null, array('class' => 'form-control', "id"=>"height", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
						</div>
						 
						<!-- <div class="form-row"> -->
							
							<!-- <div class="form-group  position-relative error-l-40 col-md-6">
								<label>Criterias</label>
								{!! Form::text('criterias', null, array('class' => 'form-control', "id"=>"criterias", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
						</div> --> 

						<div class="form-row">
							
							<div class="form-group  position-relative error-l-40 col-md-12">
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
	@if(empty($_POST))
    </main>
    <script>
    	$(function() {
    $('#row_dim').hide(); 
    $('#type').change(function(){
        if($('#type').val() == '2') {
            $('#row_dim').show(); 
        } else {
            $('#row_dim').hide(); 
        } 
    });
});

    </script>
	  <script>
    	$(function() {
    $('#row_dim1').hide(); 
    $('#type').change(function(){
        if($('#type').val() == '1') {
            $('#row_dim1').show(); 
        } else {
            $('#row_dim1').hide(); 
        } 
    });
});

    </script>
     <script>
    	$(function() {
    $('#row_dim2').hide(); 
    $('#type').change(function(){
        if($('#type').val() == '1','1') {
            $('#row_dim2').show(); 
        } else {
            $('#row_dim2').hide(); 
        } 
    });
});

    </script>
    <script>
    	$(function() {
    $('#row_dim3').hide(); 
    $('#type').change(function(){
        if($('#type').val() == '1','1') {
            $('#row_dim3').show(); 
        } else {
            $('#row_dim3').hide(); 
        } 
    });
});

    </script>


   
    
@stop
@endif