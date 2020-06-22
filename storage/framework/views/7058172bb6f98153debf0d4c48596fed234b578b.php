<?php $__env->startSection('content'); ?>
	 <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('Dashboard'); ?></h1>
                    <div class="separator mb-5"></div>
                </div>
				<div class="col-lg-12 col-xl-6">
                    <div class="icon-cards-row">
                        <div class="glide dashboard-numbers">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">
                                    <li class="glide__slide">
                                        <a href="javascript:void(0);" class="card">
                                            <div class="card-body text-center">
                                                <i class="iconsminds-clock"></i>
                                                <p class="card-text mb-0"><?php echo getLabels('scheduled_posts'); ?></p>
                                                <p class="lead text-center"><?php echo scheduledPostCount(); ?></p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="glide__slide">
                                        <a href="javascript:void(0);" class="card">
                                            <div class="card-body text-center">
                                                <i class="iconsminds-basket-coins"></i>
                                                <p class="card-text mb-0"><?php echo getLabels('total_posts'); ?></p>
                                                <p class="lead text-center"><?php echo myPostCount(); ?></p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="glide__slide">
                                        <a href="javascript:void(0);" class="card">
                                            <div class="card-body text-center">
                                                <i class="iconsminds-male-female"></i>
                                                <p class="card-text mb-0"><?php echo getLabels('followers'); ?></p>
                                                <p class="lead text-center"><?php echo followersCount(); ?></p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-4">
                             <div class="card h-100">
								<div class="card-body">
									<h5 class="card-title"><?php echo getLabels('scheduled_posts'); ?></h5>
									<div class="calendar"></div>
								</div>
							</div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-12 mb-4">
                    <div class="card">
                        <div class="position-absolute card-top-buttons">
                            <a class="btn btn-header-light icon-button steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>">
                                <i class="simple-icon-refresh"></i>
                            </a>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title"><?php echo getLabels('recent_post'); ?></h5>
                            <div class="scroll dashboard-list-with-thumbs">
                                <div id="post-data">
										<?php echo $__env->make("frontend/posts/post_mid", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>