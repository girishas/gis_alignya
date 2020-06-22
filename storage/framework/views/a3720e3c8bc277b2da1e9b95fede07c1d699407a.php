<?php if(empty($_POST)): ?>

<?php endif; ?>


<?php if(empty($_POST)): ?>
<?php $__env->startSection('content'); ?>
	<?php echo HTML::style('public/slimcropper/css/slim.css'); ?>

	<?php echo HTML::style('public/slimcropper/css/style.css'); ?>

	<?php echo HTML::script('public/slimcropper/js/slim.kickstart.min.js'); ?>

	
  <main>
  <?php endif; ?>
	
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('update_my_profile'); ?></h1>
					
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, Auth::User()->uniq_username); ?>"><?php echo getLabels('my_profile'); ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('update_my_profile'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
	
					<?php echo Form::model($data, array('url' => array($route_prefix.'/'.Auth::User()->uniq_username.'/update-profile'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label for=""><?php echo getLabels('profile_picture'); ?></label>
								<div class="slim" data-ratio="1:1" data-instant-edit="true" data-will-remove="profileimageWillBeRemoved">
									<?php if( $data->photo and file_exists('public/upload/users/profile-photo/'. $data->photo) ): ?>
										<?php echo HTML::image('public/upload/users/profile-photo/'. $data->photo, $data->first_name); ?>

									<?php endif; ?>
									<input type="file" name="photo"/>
								</div>
							</div>
							<div class="form-group col-md-9">
								<label for=""><?php echo getLabels('cover_photo'); ?></label>
								<div class="slim" data-ratio="3:1" data-instant-edit="true" data-will-remove="coverimageWillBeRemoved">
									  <?php if( $data->cover_photo and file_exists('public/upload/users/cover_photo/'. $data->cover_photo) ): ?>
										<?php echo HTML::image('public/upload/users/cover_photo/'.$data->cover_photo, $data->first_name); ?>

									<?php endif; ?>
									 
									<input type="file" name="cover_photo"/>
								</div>
							</div>
						</div>
						<div class="form-row">
							
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputFirstname"><?php echo getLabels('First Name'); ?></label>
								<?php echo Form::text('first_name', null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputLastname"><?php echo getLabels('last_name'); ?></label>
								<?php echo Form::text('last_name', null, array('class' => 'form-control', 'id' => 'inputLastname',  'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group  position-relative error-l-40 col-md-6"><?php
								$is_disabled  = !empty($data->email)?'readonly':""; ?>
								<label for="inputEmail4"><?php echo getLabels('email'); ?></label>
								<?php echo Form::text('email', null, array('readonly' => true, 'class' => 'form-control', "id"=>"inputEmail4", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-6">
								<label for="inputEmail5"><?php echo getLabels('payout_email'); ?></label>
								<?php echo Form::text('payout_email', null, array('class' => 'form-control', "id"=>"inputEmail5", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						<?php if($total_followers > 10): ?>
							<div class="form-row">
								<div class="form-group  position-relative error-l-50 col-md-12">
									<label for="inputUsername"><?php echo getLabels('username'); ?></label>
									<?php echo Form::text('uniq_username', null, array('class' => 'form-control', "id"=>"inputUsername", 'placeholder'=> '')); ?>

									<div class="invalid-tooltip"></div>
								</div>
							</div>
						<?php else: ?>
							<?php echo Form::hidden('uniq_username'); ?>

						<?php endif; ?>
						
						<div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMobile"><?php echo getLabels('contact_number'); ?></label>
								<?php echo Form::text('mobile', null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-3">
								<label for="inputDOB"><?php echo getLabels('date_of_birth'); ?></label>
								<?php echo Form::date('dob', null, array('class' => 'form-control', "id"=>"inputDOB", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-50 col-md-3">
								<label for="inputGender"><?php echo getLabels('gender'); ?></label>
								<?php echo Form::select('gender', config('constants.GENDER'), null, array('class' => 'form-control', "id"=>"inputGender")); ?>

								<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputAboutYou"><?php echo getLabels('about_you'); ?></label>
							<?php echo Form::textarea('about_you', null, array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputStreet1"><?php echo getLabels('address_line_1'); ?></label>
							<?php echo Form::text('street_1', null, array('class' => 'form-control', "id"=>"inputStreet1", 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputStreet2"><?php echo getLabels('address_line_2'); ?></label>
							<?php echo Form::text('street_2', null, array('class' => 'form-control', "id"=>"inputStreet2", 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
							
						<div class="form-row">
							<div class="form-group  position-relative error-l-40 col-md-3">
								<label for="inputCity"><?php echo getLabels('city'); ?></label>
								<?php echo Form::text('city', null, array('class' => 'form-control', "id"=>"inputCity", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-3">
								<label for="inputState"><?php echo getLabels('state'); ?></label>
								<?php echo Form::text('state', null, array('class' => 'form-control', "id"=>"inputState", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-3">
								<label for="inputCountry"><?php echo getLabels('country'); ?></label>
								<?php echo Form::select('country_id', [''=>'Select Country'] + $countries, null, array('class' => 'form-control', "id"=>"inputCountry", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-3">
								<label for="inputZip"><?php echo getLabels('zipcode'); ?></label>
								<?php echo Form::text('zip', null, array('class' => 'form-control', "id"=>"inputZip")); ?>

								<div class="invalid-tooltip"></div>
							</div>
						</div>	
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputWebsite"><?php echo getLabels('facebook_profile_link'); ?></label>
							<?php echo Form::text('facebook_profile_link', null, array('class' => 'form-control', "id"=>"inputfacebook_profile_link", 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputWebsite"><?php echo getLabels('youtube_profile_link'); ?></label>
							<?php echo Form::text('youtube_profile_link', null, array('class' => 'form-control', "id"=>"inputyoutube_profile_link", 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputWebsite"><?php echo getLabels('twitch_profile_link'); ?></label>
							<?php echo Form::text('twitch_profile_link', null, array('class' => 'form-control', "id"=>"inputtwitch_profile_link", 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputWebsite"><?php echo getLabels('website'); ?></label>
							<?php echo Form::text('website', null, array('class' => 'form-control', "id"=>"inputWebsite", 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group ">
						<button type="submit" class="btn btn-primary"><?php echo getLabels('update'); ?></button>&nbsp;&nbsp;
						<a href="<?php echo url($route_prefix, 'users'); ?>" class="btn btn-dark steamerst_link"><?php echo getLabels('back'); ?></a>
						</div>
					<?php echo Form::close(); ?>

				</div>
			</div>
        </div>
		<script type="text/javascript">
			var user_id  = "<?php echo $data->id; ?>"
			function profileimageWillBeRemoved(data, remove) {
				removeImage(data, remove, 'photo', user_id);
			}
			
			function coverimageWillBeRemoved(data, remove){
				removeImage(data, remove, 'cover_photo', user_id);
			}
			
			function removeImage(data, remove, image_type, user_id){
				form_action = "<?php echo url($route_prefix.'/delete-user-photo'); ?>"
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
	<?php if(empty($_POST)): ?>
    </main>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>