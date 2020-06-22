

<?php $__env->startSection('content'); ?>
	<main>
        <div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1><?php echo getLabels('all_group_requests'); ?></h1>
						<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                            <ol class="breadcrumb pt-0">
                               <li class="breadcrumb-item">
									<a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
								</li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('all_group_requests'); ?></li>
                            </ol>
                        </nav>
                    </div>
					<div class="float-md-right mb-3">
						<span class="text-muted text-small"><?php echo str_replace(array('{FIRST}', '{LAST}', '{TOTAL}'), array($data->firstItem(), $data->lastItem(), $data->total()), getLabels('showing_first_to_last_of_total_records')); ?></span>
					</div>
				</div>
			</div>
                    <div class="separator mb-5"></div>
                </div>
            </div>
		
            <div class="row">
                <div class="col-12 list">
					<?php if(!$data->isEmpty()): ?>
						<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							
							<?php if($val->user_id == Auth::User()->uniq_username): ?>
								<div class="card d-flex flex-row mb-3" id="grtp<?php echo $val->id; ?>">
									<div class="card-body d-flex flex-row">
										<a href="javascript:void(0);">
											<?php echo showImage($val->memberUser->photo, "img-thumbnail list-thumbnail xsmall border-0 rounded-circle", "","", $val->memberUser->first_name, 'users/profile-photo'); ?>

										</a>
										<div class="pl-3">
										   <a href="javascript:void(0);">
												<p class="font-weight-medium mb-1"><?php echo str_replace(array('{MEMBER}', '{GROUP}'), array($val->memberUser->first_name." ".$val->memberUser->last_name, $val->name), getLabels('member_sent_request_to_join_group_group')); ?></p>
												<p class="text-muted mb-0 text-small"><?php echo timeAgo($val->created_at); ?></p>
											</a>
										</div>
									</div>
									<div class="custom-control mb-1 align-self-center pr-4">
										<a href="javascript:void(0);" onclick="joingroup(1, <?php echo $val->id; ?>);" class="btn btn-outline-primary btn-xs"><?php echo getLabels('approve'); ?></a>&nbsp;
										<a href="javascript:void(0);" onclick="joingroup(2, <?php echo $val->id; ?>);"  class="btn btn-outline-danger btn-xs"><?php echo getLabels('decline'); ?></a>
									</div>
								</div>
							
							<?php else: ?>
								<div class="card d-flex flex-row mb-3" id="grtp<?php echo $val->id; ?>">
									<div class="card-body d-flex flex-row">
										<a href="javascript:void(0);">
											<?php echo showImage($val->icon, "img-thumbnail list-thumbnail xsmall border-0 rounded-circle", "","", $val->name, 'groups'); ?>

										</a>
										<div class="pl-3">
										   <a href="javascript:void(0);">
												<p class="font-weight-medium mb-1"><?php echo str_replace(array('{GROUP}'), array($val->name), getLabels('you_are_invited_to_join_group')); ?></p>
												<p class="text-muted mb-0 text-small"><?php echo timeAgo($val->created_at); ?></p>
											</a>
										</div>
									</div>
									<div class="custom-control mb-1 align-self-center pr-4">
										<a href="javascript:void(0);" onclick="joingroup(1, <?php echo $val->id; ?>);" class="btn btn-outline-primary btn-xs"><?php echo getLabels('accept'); ?></a>&nbsp;
										<a href="javascript:void(0);" onclick="joingroup(2, <?php echo $val->id; ?>);"  class="btn btn-outline-danger btn-xs"><?php echo getLabels('reject'); ?></a>
									</div>
								</div>
							<?php endif; ?>
							
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
						<div class="card d-flex flex-row mb-3">
							<div class="card-body d-flex flex-row">
								<p class="font-weight-medium mb-1"><?php echo getLabels('no_requests_yet'); ?>. </p>
							</div>
						</div>
					<?php endif; ?>

                    <nav class="mt-4 mb-3">
                        <div class="row">
							<div class="col-12">
								<?php echo $data->links('frontend.pagination_custom'); ?>

							</div>
						</div>
                    </nav>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>