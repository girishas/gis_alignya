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

                            <p class=" text-white h2">Reset Password</p>
 <p class="white mt-3 mb-5">
                               Please enter your email address to get a new password.
                            </p>
                            <p class="white mt-0 mb-0"><a href="<?php echo url('login'); ?>" style="width: 100%;" class="btn btn-primary"><?php echo getLabels('Go_Back_To_Login'); ?></a>
							<br/>
							<br/>
							<a href="<?php echo url('register'); ?>" style="width: 100%;" class="btn btn-primary"><?php echo getLabels('Create_your_account'); ?></a></p>
							
							
                        </div>
                        <div class="form-side">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'login'); ?>">
								<?php echo HTML::image("public/img/logo.png", "Logo", array("class"=>"", 'style'=>"width:250px;margin-bottom:40px;")); ?>

							</a>
                            <h6 class="mb-4"><?php echo getLabels('forgot_password'); ?></h6>
                           <?php echo Form::open(array('url' => url('/forgot-password'), 'class'=>'steamerstudio_form needs-validation tooltip-left-bottom', 'id'=>'login', 'files' => true)); ?>

                                <label class="form-group has-float-label mb-4 position-relative error-l-100">
                                   <?php echo Form::text("email", null, array("class"=>"form-control")); ?>

								   <div class="invalid-tooltip"></div>
                                    <span><?php echo getLabels('email'); ?></span>
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