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
                    <h1>{!! getLabels('Update Members') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'users') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('Members') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'members') !!}">{!! getLabels('Members') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Update Members') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
	
					{!! Form::model($data, array('url' => array($route_prefix.'/members/update/'.$data->id), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
						<div class="form-row">
							<div class="form-group col-md-3">
								<label for="">{!! getLabels('profile_picture') !!}</label>
								<div class="slim" data-ratio="1:1" data-instant-edit="true" data-will-remove="profileimageWillBeRemoved">
									@if ( $data->photo and file_exists('public/upload/users/profile-photo/'. $data->photo) )
										{!! HTML::image('public/upload/users/profile-photo/'. $data->photo, $data->first_name) !!}
									@endif
									<input type="file" name="photo"/>
								</div>
							</div>
						</div>
						<div class="form-row">
							
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputFirstname">{!! getLabels('First Name') !!}</label>
								{!! Form::text('first_name', null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputLastname">{!! getLabels('last_name') !!}</label>
								{!! Form::text('last_name', null, array('class' => 'form-control', 'id' => 'inputLastname',  'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group  position-relative error-l-40 col-md-6"><?php
								$is_disabled  = !empty($data->email)?'readonly':""; ?>
								<label for="inputEmail4">{!! getLabels('email') !!}</label>
								{!! Form::text('email', null, array('readonly' => true, 'class' => 'form-control', "id"=>"inputEmail4", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMobile">{!! getLabels('contact_number') !!}</label>
								{!! Form::text('mobile', null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMobile">{!! getLabels('Designation') !!}</label>
								{!! Form::text('designation', null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							
						</div>
						<div class="form-group ">
						<button type="submit" class="btn btn-primary">{!! getLabels('update') !!}</button>&nbsp;&nbsp;
						<a href="{!! url($route_prefix, 'users') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
        </div>
		<script type="text/javascript">
			var user_id  = "{!! $data->id !!}"
			function profileimageWillBeRemoved(data, remove) {
				removeImage(data, remove, 'photo', user_id);
			}
			
			function coverimageWillBeRemoved(data, remove){
				removeImage(data, remove, 'cover_photo', user_id);
			}
			
			function removeImage(data, remove, image_type, user_id){
				form_action = "{!! url($route_prefix.'/delete-user-photo') !!}"
				$.ajax({
					type:"POST",
					url: form_action,
					data:"user_id="+user_id+"&image_type="+image_type,
					success: function (response) {
						if(response.type == 'success'){
							remove();
						}
					},
					 error: function(xhr, ajaxOptions, thrownError) {
					  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}
		</script>
	@if(empty($_POST))
    </main>
@stop
@endif