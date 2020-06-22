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
                                <?php echo getLabels('form_to_register'); ?>

                                <br><?php echo getLabels('you_are_a_member'); ?> 
                                 <a href="<?php echo url('login'); ?>" class="steamerst_link white"><?php echo getLabels('login'); ?></a>.
                            </p>
                        </div>
                        <div class="form-side">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'login'); ?>">
								<?php echo HTML::image("public/images/logo.png", "Logo", array("class"=>"", 'style'=>"width:250px;margin-bottom:40px;")); ?>

							</a>
                            <h6 class="mb-4"><?php echo getLabels('register'); ?></h6>
                           <?php echo Form::open(array('url' => url('/register'), 'class'=>'steamerstudio_form needs-validation tooltip-label-right', 'id'=>'login', 'files' => true)); ?>

								<label class="form-group has-float-label position-relative error-l-100 mb-4">
                                   <?php echo Form::text("first_name", null, array("class"=>"form-control")); ?>

								   <div class="invalid-tooltip"></div>
                                    <span><?php echo getLabels('first_name'); ?>*</span>
                                </label>
								<label class="form-group has-float-label mb-4 position-relative error-l-100">
                                   <?php echo Form::text("last_name", null, array("class"=>"form-control")); ?>

								   <div class="invalid-tooltip"></div>
                                    <span><?php echo getLabels('last_name'); ?></span>
                                </label>
                                <label class="form-group has-float-label mb-4 position-relative error-l-100">
                                   <?php echo Form::text("email", null, array("class"=>"form-control")); ?>

								   <div class="invalid-tooltip"></div>
                                    <span><?php echo getLabels('email'); ?>*</span>
                                </label>

                                <label class="form-group has-float-label mb-4 position-relative error-l-100">
									<?php echo Form::password("password",array("class"=>"form-control")); ?>

									<div class="invalid-tooltip"></div>
                                    <span><?php echo getLabels('password'); ?>*</span>
                                </label>
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn btn-primary btn-lg btn-shadow text-uppercase" type="submit"><?php echo getLabels('register'); ?></button>
                                </div>
							<?php echo Form::Close(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
	<script type="text/javascript">
		$("body").on('submit', ".steamerstudio_formlogin", function(e) {
			pageUrl = "<?php echo url($route_prefix, 'login'); ?>";
			e.preventDefault();
			$.cergis.loadContent();
			e.preventDefault();
		});
		
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>