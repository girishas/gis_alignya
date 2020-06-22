<?php if(!$data->isEmpty()): ?>
	<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="col-md-6 col-sm-6 col-lg-6 col-12 ">
			<div class="card d-flex flex-row mb-2">
				<a class="d-flex" href="javascript:void(0);">
					<?php echo showImage($val->icon, 'img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center', "", "", $val->name, 'groups'); ?>

				</a>
				<div class=" d-flex flex-grow-1 min-width-zero">
					<div class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
						<div class="min-width-zero">
							<a href="javascript:void(0);">
								<p class="list-item-heading mb-1 truncate"><?php echo $val->name; ?></p>
							</a>
							<p class="mb-2 text-muted text-small"> <?php echo $val->totalMember; ?> <?php echo $val->totalMember > 1?getLabels('Members'):str_singular(getLabels('Members')); ?></p>
							<?php if($val->privacy == 1): ?>
								<a href="javascript:void(0);" rel="<?php echo $val->slug; ?>" class="btn btn-xs btn-outline-primary joinagrp"><?php echo getLabels('join'); ?></a>
							<?php elseif($val->privacy == 2): ?>
								<?php $isgroupMember = isGroupMember($val->slug); ?>
								<?php if(isset($isgroupMember->is_active)): ?>
									<a href="javascript:void(0);" rel="<?php echo $val->slug; ?>" class="btn btn-xs btn-outline-primary"><?php echo getLabels('requested'); ?></a>
								<?php else: ?>
									<a href="javascript:void(0);" rel="<?php echo $val->slug; ?>" class="btn btn-xs btn-outline-primary joinagrp"><?php echo getLabels('send_request'); ?></a>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php elseif(!isset($_GET['page']) OR (isset($_GET['page']) and $_GET['page'] == 1)): ?>
	<div class="col-12 ">
		<div class="card d-flex flex-row mb-2">
			<div class="card-body">
				<?php echo getLabels('no_results_to_show'); ?>

			</div>
		</div>
	</div>
<?php endif; ?>