<?php $__env->startSection('content'); ?>
 <div class="fixed-background" style="opacity:1;"></div>
     <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side ">
                            <p class=" text-white h2"><?php echo getLabels('magic_is_in_the_details'); ?></p>
                            <p class="text-white mb-0"><?php echo getLabels('yes_it_is_indeed'); ?></p>
                        </div>
                        <div class="form-side">
                            <div class="text-center">
								<a class="steamerst_link" href="<?php echo url($route_prefix, '/'); ?>">
									<h1 style="font-weight:800;"><?php echo config('constants.SITE_TITLE'); ?></h1>
								</a>

                                <h6 class="mb-4"><?php echo getLabels('ooops_looks_like_an_error_occurred'); ?></h6>
                                <p class="mb-0 text-muted text-small mb-0"><?php echo getLabels('error_code'); ?></p>
                                <p class="display-1 font-weight-bold mb-5">
                                    404
                                </p>
                                <a href="<?php echo url($route_prefix.'/dashboard'); ?>" class="steamerst_link btn btn-primary btn-lg btn-shadow"><?php echo getLabels('go_back_home'); ?></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>