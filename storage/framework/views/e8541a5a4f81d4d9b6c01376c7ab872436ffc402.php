<?php $__env->startSection('content'); ?>
 <div class="fixed-background" style="opacity:1;"></div>
    <main style="opacity:1;">
        <div class="container">
			
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
				
                    <div class="card auth-card">
                        <div class="position-relative image-side ">

                            <p class=" text-white h2"><?php echo getLabels('magic_is_in_the_details'); ?></p>

                            <p class="white mb-0">
                                <?php echo getLabels('use_credentials_for_login'); ?>

								<?php if($route_prefix != env('ADMIN_PREFIX')): ?>
									<br><?php echo getLabels('not_a_member'); ?>

									 <a href="<?php echo url('register'); ?>" class="steamerst_link white"><?php echo getLabels('register'); ?></a>.
								<?php endif; ?>
                            </p>
                        </div>
                        <div class="form-side">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'login'); ?>">
								<?php echo HTML::image("public/img/logo.png", "Logo", array("class"=>"", 'style'=>"width:250px;margin-bottom:40px;")); ?>

							</a>
							<?php echo $__env->make('frontend/alert_message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<div class="alert alert-danger" role="alert" id="error_alert" style="display:none;">
                                This is a danger alert—check it out!
                            </div>
                            <h6 class="mb-4"><?php echo getLabels('login'); ?> </h6>
                           <?php echo Form::open(array('url' => url($route_prefix.'/login'), 'class'=>'steamerstudio_formlogin', 'id'=>'login', 'files' => true)); ?>

                                <label class="form-group has-float-label mb-4">
                                   <?php echo Form::text("email", null, array("class"=>"form-control")); ?>

                                    <span><?php echo getLabels('email'); ?></span>
                                </label>

                                <label class="form-group has-float-label mb-4">
									<?php echo Form::password("password2",array("class"=>"form-control")); ?>

                                    <span><?php echo getLabels('password'); ?></span>
                                </label>
                                <div class="d-flex justify-content-between <?php echo ($route_prefix == env('ADMIN_PREFIX'))?'float-right':'align-items-center'; ?>">
									<?php if($route_prefix != env('ADMIN_PREFIX')): ?>
										<a href="<?php echo url('forgot-password'); ?>" class="steamerst_link"><?php echo getLabels('forget_password'); ?>?</a>
									<?php endif; ?>
                                    <button class="btn btn-primary btn-lg btn-shadow text-uppercase" type="submit"><?php echo getLabels('login'); ?></button>
                                </div>
							<?php echo Form::Close(); ?>

							<div style="clear:both;"></div>
							<?php if($route_prefix != env('ADMIN_PREFIX')): ?>
								 <div class="d-flex flex-row mb-3 mt-3">
									<a class="btn btn-primary" onclick="applogin(this)" rel="<?php echo e(url('auth/facebook')); ?>" href="javascript:void(0);" style="width:100%;"><b>Facebook</b></a>&nbsp;&nbsp;
									<a class="btn btn-primary" onclick="applogin(this)" rel="<?php echo e(url('auth/google')); ?>" href="javascript:void(0);" style=" background-color:#d9534f;border-color:#d9534f;width:100%;"><b>YouTube</b></a>
								</div>
								 
							<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
	<?php if(Auth::check()): ?>{
		<script type="text/javascript">
			pageUrl = SITE_URL+'dashboard';
			$.cergis.loadContent();
			e.preventDefault();
		</script>
	<?php endif; ?>
	<script type="text/javascript">
		$("body").on('submit', ".steamerstudio_formlogin", function(e) {
			e.preventDefault();
			var form_action = $(this).attr('action');
			pageUrl = SITE_URL+'dashboard';
			data = $(this).serialize();
			$.ajax({
				type:"POST",
				url: form_action,
				data:data,
				dataType:'json',
				success: function (response) {
					
					if(response.status == 'error'){
						jQuery('#error_alert').show();
						jQuery('#error_alert').html(response.message);
					}else{
						if(response.header){
							jQuery('#main-content-navigation').html(response.header);
							jQuery('#main-content-navigation').append(response.navigation);
						}
						new $.dore(this);
						
						$.cergis.loadContent();
						e.preventDefault();
					}
				},
				 error: function(xhr, ajaxOptions, thrownError) {
				  console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>