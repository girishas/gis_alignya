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
                    <h1>{!! getLabels('update_my_profile') !!}</h1>
					
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, Auth::User()->uniq_username) !!}">{!! getLabels('my_profile') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('update_my_profile') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
	
					{!! Form::model($data, array('url' => array($route_prefix.'/'.Auth::User()->uniq_username.'/update-profile'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
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
							<div class="form-group col-md-9">
								<label for="">{!! getLabels('cover_photo') !!}</label>
								<div class="slim" data-ratio="3:1" data-instant-edit="true" data-will-remove="coverimageWillBeRemoved">
									  @if ( $data->cover_photo and file_exists('public/upload/users/cover_photo/'. $data->cover_photo) )
										{!! HTML::image('public/upload/users/cover_photo/'.$data->cover_photo, $data->first_name) !!}
									@endif
									 
									<input type="file" name="cover_photo"/>
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
							<div class="form-group  position-relative error-l-40 col-md-6">
								<label for="inputEmail5">{!! getLabels('payout_email') !!}</label>
								{!! Form::text('payout_email', null, array('class' => 'form-control', "id"=>"inputEmail5", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						@if($total_followers > 10)
							<div class="form-row">
								<div class="form-group  position-relative error-l-50 col-md-12">
									<label for="inputUsername">{!! getLabels('username') !!}</label>
									{!! Form::text('uniq_username', null, array('class' => 'form-control', "id"=>"inputUsername", 'placeholder'=> ''))!!}
									<div class="invalid-tooltip"></div>
								</div>
							</div>
						@else
							{!! Form::hidden('uniq_username') !!}
						@endif
						
						<div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMobile">{!! getLabels('contact_number') !!}</label>
								{!! Form::text('mobile', null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-3">
								<label for="inputDOB">{!! getLabels('date_of_birth') !!}</label>
								{!! Form::date('dob', null, array('class' => 'form-control', "id"=>"inputDOB", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-50 col-md-3">
								<label for="inputGender">{!! getLabels('gender') !!}</label>
								{!! Form::select('gender', config('constants.GENDER'), null, array('class' => 'form-control', "id"=>"inputGender"))!!}
								<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputAboutYou">{!! getLabels('about_you') !!}</label>
							{!! Form::textarea('about_you', null, array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputStreet1">{!! getLabels('address_line_1') !!}</label>
							{!! Form::text('street_1', null, array('class' => 'form-control', "id"=>"inputStreet1", 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputStreet2">{!! getLabels('address_line_2') !!}</label>
							{!! Form::text('street_2', null, array('class' => 'form-control', "id"=>"inputStreet2", 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
							
						<div class="form-row">
							<div class="form-group  position-relative error-l-40 col-md-3">
								<label for="inputCity">{!! getLabels('city') !!}</label>
								{!! Form::text('city', null, array('class' => 'form-control', "id"=>"inputCity", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-3">
								<label for="inputState">{!! getLabels('state') !!}</label>
								{!! Form::text('state', null, array('class' => 'form-control', "id"=>"inputState", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-3">
								<label for="inputCountry">{!! getLabels('country') !!}</label>
								{!! Form::select('country_id', [''=>'Select Country'] + $countries, null, array('class' => 'form-control', "id"=>"inputCountry", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-3">
								<label for="inputZip">{!! getLabels('zipcode') !!}</label>
								{!! Form::text('zip', null, array('class' => 'form-control', "id"=>"inputZip"))!!}
								<div class="invalid-tooltip"></div>
							</div>
						</div>	
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputWebsite">{!! getLabels('facebook_profile_link') !!}</label>
							{!! Form::text('facebook_profile_link', null, array('class' => 'form-control', "id"=>"inputfacebook_profile_link", 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputWebsite">{!! getLabels('youtube_profile_link') !!}</label>
							{!! Form::text('youtube_profile_link', null, array('class' => 'form-control', "id"=>"inputyoutube_profile_link", 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputWebsite">{!! getLabels('twitch_profile_link') !!}</label>
							{!! Form::text('twitch_profile_link', null, array('class' => 'form-control', "id"=>"inputtwitch_profile_link", 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputWebsite">{!! getLabels('website') !!}</label>
							{!! Form::text('website', null, array('class' => 'form-control', "id"=>"inputWebsite", 'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
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