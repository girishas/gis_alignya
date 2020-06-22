
<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('people_search_results'); ?></h1>
                </div>
            </div>
			
			<div class="row mb-4">
				<?php if(!$data->isEmpty()): ?>
					<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-md-6 col-sm-6 col-lg-6 col-12 mb-4">
							<div class="card d-flex flex-row">
								<a class="d-flex steamerst_link" href="<?php echo url($route_prefix.'/'.$val->uniq_username); ?>">
									<?php echo showImage($val->photo, "img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center", "","", $val->first_name, 'users/profile-photo'); ?>

                                </a>
								
								<div class=" d-flex flex-grow-1 min-width-zero">
                                    <div class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
											<a href="<?php echo url($route_prefix.'/'.$val->uniq_username); ?>" class="steamerst_link">
                                                <p class="list-item-heading mb-1 truncate"><?php echo ucwords($val->first_name." ".$val->last_name); ?></p>
                                            </a>
                                            <p class="mb-2 text-muted text-small"><?php echo $val->city; ?><?php echo $val->state?", ".$val->state:""; ?><?php echo $val->country?", ".$val->country:""; ?></p>
                                           <div id="followbtnouter<?php echo $val->uniq_username; ?>">
											   <?php if(in_array($val->id, $following)): ?>
													<div class="dropdown d-inline-block">
														<button class="btn btn-xs btn-outline-primary dropdown-toggle mb-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<?php echo getLabels('following'); ?>

														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
															<a class="dropdown-item unfollow_user" rel="<?php echo $val->uniq_username; ?>" href="javascript:void(0);"><?php echo getLabels('unfollow'); ?></a>
														</div>
													</div>
												<?php elseif(in_array($val->id, $follower)): ?>
													<div class="dropdown d-inline-block">
														<button class="btn btn-xs btn-outline-primary dropdown-toggle mb-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<?php echo str_singular(getLabels('followers')); ?>

														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
															<a class="dropdown-item unfollow_user" rel="<?php echo $val->uniq_username; ?>" href="javascript:void(0);"><?php echo getLabels('unfollow'); ?></a>
														</div>
													</div>
												<?php else: ?>
													<button type="button" class="btn btn-xs btn-outline-primary follow_btn" rel="<?php echo $val->uniq_username; ?>"><?php echo getLabels('follow'); ?></button>
												<?php endif; ?>
											</div>
										</div>
                                    </div>
                                </div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
					<div class="col-12 mb-4">
						<div class="card ">
							<div class="card-body">
								<div class="text-center">
									<?php echo getLabels('records_not_found'); ?>

								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
			
            <div class="row">
				<div class="col-12 text-center">
					<p class="justify-content-center "><?php echo str_replace(array('{FIRST}', '{LAST}', '{TOTAL}'), array($data->firstItem(), $data->lastItem(), $data->total()), getLabels('showing_first_to_last_of_total_records')); ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?php echo $data->links('frontend.pagination_custom'); ?>

				</div>
			</div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>