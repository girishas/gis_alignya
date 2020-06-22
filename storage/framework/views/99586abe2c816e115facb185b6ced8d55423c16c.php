<?php $__currentLoopData = $following; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $follower): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="col-12 col-md-6 col-lg-4 pfollower_outer<?php echo $follower->uniq_username; ?>">
		<div class="card d-flex flex-row mb-4">
			<a class="d-flex steamerst_link" href="<?php echo url($route_prefix.'/'.$follower->uniq_username); ?>">
				<?php echo showImage($follower->photo, "img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center", "","", $follower->first_name, 'users/profile-photo'); ?>

			</a>
			<div class=" d-flex flex-grow-1 min-width-zero">
				<div
					class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
					<div class="min-width-zero">
						<a href="<?php echo url($route_prefix.'/'.$follower->uniq_username); ?>" class="steamerst_link">
							<p class="list-item-heading mb-1 truncate"><?php echo ucwords($follower->first_name." ".$follower->last_name); ?></p>
						</a>
						<p class="mb-2 text-muted text-small"><?php echo $follower->city; ?><?php echo $follower->state?", ".$follower->state:""; ?><?php echo $follower->country?", ".$follower->country:""; ?></p>
                        <?php if(Route::input('username') == Auth::User()->uniq_username): ?>                  
							<div class="dropdown d-inline-block">
								<button class="btn btn-xs btn-outline-primary dropdown-toggle mb-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?php echo getLabels('following'); ?>

								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item unfollow_user" rel="<?php echo $follower->uniq_username; ?>" href="javascript:void(0);"><?php echo getLabels('unfollow'); ?></a>
								</div>
							</div>
						<?php elseif(!in_array($follower->id, $myfollowers)): ?>
							<div id="rfb<?php echo $follower->uniq_username; ?>">
								<button type="button" class="btn btn-xs btn-outline-primary follow_btn" rel="<?php echo $follower->uniq_username; ?>"><?php echo getLabels('follow'); ?></button>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>