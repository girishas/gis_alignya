<?php $__env->startSection('content'); ?>
	<style>
		.top-right-button-container .btn{text-transform:uppercase;}
		.top-right-button-container .btn-xs {
			line-height: 1.5;
			font-weight: 700;
			letter-spacing: .05rem;
			padding: .75rem 2.6rem .6rem 2.6rem;
			font-size:.8rem;
		}
	</style>
	<?php if(Auth::check()): ?>
		<main>
	<?php else: ?>
		<div class="mt-5 mb-5" style="margin-top:6rem !important;">
	<?php endif; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
						<?php if(Auth::check()): ?>
							<h1><?php echo ucwords($data->first_name." ".$data->last_name); ?></h1>
						<?php endif; ?>
						
						<?php if(Auth::check() and Route::input('username') != Auth::User()->uniq_username): ?>  
							<?php $isFollowing  = isFollowing($data->id); ?>
							
							<?php if(!empty($isFollowing['type'])): ?>
								<div class="text-zero top-right-button-container" id="followbtnouter<?php echo $data->uniq_username; ?>">
									<button class="btn btn-lg btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<?php echo getLabels($isFollowing['type']); ?>

									</button>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item unfollow_user" rel="<?php echo $isFollowing['userDetail']->uniq_username; ?>" href="javascript:void(0);"><?php echo getLabels('unfollow'); ?></a>
									</div>
								</div>
							<?php elseif(!empty($data->uniq_username)): ?>
								<div class="text-zero top-right-button-container" id="followbtnouter<?php echo $data->uniq_username; ?>">
									<button type="button" class="btn btn-lg btn-outline-primary pull-right follow_btn" rel="<?php echo $data->uniq_username; ?>"><?php echo getLabels('follow'); ?></button>
								</div>
							<?php endif; ?>
							
						<?php endif; ?>
						
                      
						<?php if(Auth::check() and $data->uniq_username == Auth::User()->uniq_username): ?>
							<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
								<ol class="breadcrumb pt-0">
									<li class="breadcrumb-item">
										<a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('profile'); ?></li>
								</ol>
							</nav>
						<?php endif; ?>
                    </div>
					<?php if(Auth::check()): ?>
						<ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
							<li class="nav-item">
								<a class="nav-link text-uppercase active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true"><?php echo getLabels('profile'); ?></a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link text-uppercase" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false"><?php echo getLabels('followers'); ?></a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link text-uppercase" id="third-tab" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false"><?php echo getLabels('following'); ?></a>
							</li>
						</ul>
					<?php endif; ?>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                            <div class="row">
                                <div class="col-12 mb-5">
									<a href="<?php echo url('public/upload/users/cover_photo/'.$data->cover_photo); ?>" class="lightbox">
										<?php echo showImage($data->cover_photo, "social-header card-img", "","",$data->first_name, 'users/cover_photo'); ?>

									</a>
							   </div>
                                <div class="col-12 col-lg-5 col-xl-4 col-left">
                                    <a href="<?php echo url('public/upload/users/profile-photo/'.$data->photo); ?>" class="lightbox">
										<?php echo showImage($data->photo, "img-thumbnail card-img social-profile-img", "","",$data->first_name, 'users/profile-photo'); ?>

                                    </a>

                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="text-center pt-4">
                                                <p class="list-item-heading pt-2"><?php echo ucwords($data->first_name." ".$data->last_name); ?></p>
                                            </div>
                                            <p class="mb-3">
                                               <?php echo $data->about_you; ?>

                                            </p>

                                            <p class="text-muted text-small mb-2"><?php echo getLabels('location'); ?></p>
                                            <p class="mb-3">
												<?php if(Auth::check() and $data->uniq_username == Auth::User()->uniq_username): ?>
													<?php echo $data->street_1; ?>

													<?php if($data->street_2): ?>
														, <br /> <?php echo $data->street_2; ?>

													<?php endif; ?>
													<?php if($data->city): ?>
														, <br /> <?php echo $data->city; ?>

													<?php endif; ?>
													<?php if($data->state): ?>
														, <?php echo $data->state; ?>

													<?php endif; ?>
												
													<?php if($data->country_name): ?>
														, <?php echo $data->country_name; ?>

													<?php endif; ?>
													<?php if($data->zip): ?>
														- <?php echo $data->zip; ?>

													<?php endif; ?>
												<?php elseif($data->country_name): ?>
													<?php echo $data->country_name; ?>

												<?php endif; ?>
												
											</p>

                                            <?php /* <p class="text-muted text-small mb-2">Responsibilities</p>
                                            <p class="mb-3">
                                                <a href="#">
                                                    <span
                                                        class="badge badge-pill badge-outline-theme-2 mb-1">FRONTEND</span>
                                                </a>
                                                <a href="#">
                                                    <span
                                                        class="badge badge-pill badge-outline-theme-2 mb-1">JAVASCRIPT</span>
                                                </a>
                                                <a href="#">
                                                    <span
                                                        class="badge badge-pill badge-outline-theme-2 mb-1">SECURITY</span>
                                                </a>
                                                <a href="#">
                                                    <span
                                                        class="badge badge-pill badge-outline-theme-2 mb-1">DESIGN</span>
                                                </a>
                                            </p> */ ?>
											<?php if(Auth::check() and $data->uniq_username == Auth::User()->uniq_username): ?>
												<p class="text-muted text-small mb-2"><?php echo getLabels('contact_number'); ?></p>
												<p class="mb-3"><?php echo $data->mobile?$data->mobile:"---"; ?>

											<?php endif; ?>
                                           <div class="social-icons">
                                                <ul class="list-unstyled list-inline">
													<?php if(!empty($data->facebook_profile_link)): ?>
														<li class="list-inline-item">
															<a href="<?php echo $data->facebook_profile_link; ?>" target="_blank" title="Facebook"><i class="simple-icon-social-facebook"></i></a>
														</li>
													<?php endif; ?>
													<?php if(!empty($data->youtube_profile_link)): ?>
														<li class="list-inline-item">
															<a href="<?php echo $data->youtube_profile_link; ?>" target="_blank"  title="Youtube"><i class="simple-icon-social-youtube"></i></a>
														</li>
													<?php endif; ?>
													
													<?php if(!empty($data->twitch_profile_link)): ?>
														<li class="list-inline-item">
															<a href="<?php echo $data->twitch_profile_link; ?>" target="_blank"  title="Twitch"><svg height="20" viewBox="0 0 1792 1792" width="20" fill="#757575" xmlns="http://www.w3.org/2000/svg"><path d="M896 434v434h-145v-434h145zm398 0v434h-145v-434h145zm0 760l253-254v-795h-1194v1049h326v217l217-217h398zm398-1194v1013l-434 434h-326l-217 217h-217v-217h-398v-1158l109-289h1483z"/></svg></a>
														</li>
													<?php endif; ?>
                                                </ul>
                                            </div>
                                        </div> 
                                    </div>
									
									<?php if(Auth::check() and Route::input('username') == Auth::User()->uniq_username): ?>
										<?php echo $__env->make('Element/users/who_to_follow', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php endif; ?>
                                </div>

                                <div class="col-12 col-lg-7 col-xl-8 col-right">
									<?php if(Auth::check() and Route::input('username') == Auth::User()->uniq_username): ?>
										<div class="card mb-4">
											<div class="card-body">
												<div class="d-flex justify-content-between align-items-center" style="position:relative;">
													<textarea class="form-control flex-grow-1" placeholder="Say something..." style="resize:none;" onclick="openPostModal();"></textarea>
													<div style="position:absolute;right:10px;" onclick="openPostModal();">
														<?php echo showImage(Auth::User()->photo, "img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall", "","", Auth::User()->first_name, 'users/profile-photo'); ?>

													</div>
												</div>
											</div>
										</div>
									<?php endif; ?>
                                    <div id="post-data">
										<?php echo $__env->make("frontend/posts/post_mid", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
									</div>
                                   <div class="ajax-load text-center" rel="1" style="display:none">
										<p><?php echo HTML::image('public/img/loader.gif', getLabels('loading').'...'); ?> <?php echo getLabels('loading'); ?></p>
									</div>
                                </div>
                            </div>
                        </div>

						<?php if(Auth::check()): ?>
							<div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
								<div class="row" id="followers_list">
									<?php echo $__env->make('Element/users/followers', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</div>
								 <div class="ajax-loadfollower text-center" rel="1" style="display:none;">
									<p><?php echo HTML::image('public/img/loader.gif', getLabels('loading').'...'); ?> <?php echo getLabels('loading'); ?></p>
								</div>
							</div>
							
							<div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
								<div class="row" id="following_list">
								   <?php echo $__env->make('Element/users/following', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</div>
								 <div class="ajax-loadfollowing text-center" rel="1" style="display:none;">
									<p><?php echo HTML::image('public/img/loader.gif', getLabels('loading').'...'); ?> <?php echo getLabels('loading'); ?></p>
								</div>
							</div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
	<?php if(Auth::check()): ?>
		</main>
	<?php else: ?>
		</div>
	<?php endif; ?>
	<script type="text/javascript">
		var page = 1; var f_page = 1; var fi_page = 1; var active = "profile"; followers_totalpage = "<?php echo $followers->lastPage(); ?>"; var following_totalpage = "<?php echo $followers->lastPage(); ?>";
		jQuery('body').on('click', '#second-tab', function(e){
			active = "followers";
		});
		jQuery('body').on('click', '#third-tab', function(e){
			active = "following";
		});
		jQuery('body').on('click', '#first-tab', function(e){
			active = "profile";
		});
		$(window).scroll(function() {
			if($(window).scrollTop() + $(window).height() >= $(document).height()) {
				if(active == 'followers'){
					if($('.ajax-loadfollower').attr('rel') == 1){
						f_page = 1;
					}
					f_page++;
					if(f_page <= followers_totalpage){
						$('.ajax-loadfollower').attr('rel', f_page);
						loadMoreFollowers(f_page);
					}
				}
				if(active == 'following'){
					if($('.ajax-loadfollowing').attr('rel') == 1){
						fi_page = 1;
					}
					fi_page++;
					if(fi_page <= following_totalpage){
						$('.ajax-loadfollowing').attr('rel', fi_page);
						loadMoreFollowing(fi_page);
					}
				}
				if(active == 'profile'){
					if($('.ajax-load').attr('rel') == 1){
						page = 1;
					}
					page++;
					$('.ajax-load').attr('rel', page);
					loadMoreData(page);
				}
			}
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>