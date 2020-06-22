<?php $whotofollows  = who_to_follow(); ?>
<?php if(!$whotofollows->isEmpty()): ?>
	<div class="card mb-4 d-none d-lg-block" id="rfbwhotofollow">
		<div class="card-body">
			<h5 class="card-title"><?php echo getLabels('who_to_follow'); ?></h5>
			
			<?php $__currentLoopData = $whotofollows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $whotofollow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="d-flex flex-row mb-3 pb-3 border-bottom justify-content-between align-items-center rfbsub" id="rfb<?php echo $whotofollow->uniq_username; ?>">
					<a href="<?php echo url($route_prefix.'/'.$whotofollow->uniq_username); ?>" class="steamerst_link">
						<?php echo showImage($whotofollow->photo, "img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall", "","", $whotofollow->first_name, 'users/profile-photo'); ?>

					</a>
					<div class="pl-3 flex-fill">
						<a href="<?php echo url($route_prefix.'/'.$whotofollow->uniq_username); ?>" class="steamerst_link">
							<p class="font-weight-medium mb-0"><?php echo ucwords($whotofollow->first_name." ".$whotofollow->last_name); ?></p>
							<p class="text-muted mb-0 text-small"><?php echo $whotofollow->city; ?><?php echo $whotofollow->state?", ".$whotofollow->state:""; ?><?php echo $whotofollow->country?", ".$whotofollow->country:""; ?></p>
						</a>
					</div>
					<div>
						<a href="javascript:void(0);" class="btn btn-xs btn-outline-primary follow_btn" rel="<?php echo $whotofollow->uniq_username; ?>"><?php echo getLabels('follow'); ?></a>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
<?php endif; ?>