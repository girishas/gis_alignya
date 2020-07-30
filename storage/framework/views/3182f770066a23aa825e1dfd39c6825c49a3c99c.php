<?php $__env->startSection('title'); ?>
	<?php echo $page_title; ?>

<?php $__env->stopSection(); ?>

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
                               <?php echo getLabels('please_reset_your_password'); ?> 
                                <br><?php echo getLabels('not_a_member'); ?>

								 <a href="<?php echo url('register'); ?>" class="white steamerst_link"><?php echo getLabels('register'); ?></a>
                            </p>
                        </div>
                        <div class="form-side">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'login'); ?>">
								<?php echo HTML::image("public/img/logo.png", "Logo", array("class"=>"", 'style'=>"width:250px;margin-bottom:40px;")); ?>

							</a>
                            <h6 class="mb-4">Reset Password</h6>
                           <?php echo Form::open(array('url' => url('/resetpassword/'.$prefix.'?q='.$hash), 'class'=>'steamerstudio_form needs-validation tooltip-left-bottom', 'id'=>'login', 'files' => true)); ?>

                                <label class="form-group has-float-label mb-4 position-relative error-l-100">
                                   <?php echo Form::password("new_password",  array("class"=>"form-control")); ?>

								   <div class="invalid-tooltip"></div>
                                    <span><?php echo getLabels('New_Password'); ?></span>
                                </label>
								
								<label class="form-group has-float-label mb-4 position-relative error-l-100">
                                   <?php echo Form::password("confirm_new_password",  array("class"=>"form-control")); ?>

								   <div class="invalid-tooltip"></div>
                                    <span><?php echo getLabels('Confirm_New_Password'); ?></span>
                                </label>
                               
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn btn-primary btn-lg btn-shadow text-uppercase" type="submit"><?php echo getLabels('reset'); ?></button>
                                </div>
							<?php echo Form::Close(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>