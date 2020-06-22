<?php use App\Traits\SortableTrait;  ?>
<?php $__env->startSection('content'); ?>
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo $page_title; ?></h1>
					<div class="text-zero top-right-button-container">
						<?php if(Auth::User()->is_complete_profile): ?>
							<a href="<?php echo url($route_prefix.'/add-subscription-plan'); ?>" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1"><?php echo getLabels('create_new_plan'); ?></a>
						<?php else: ?>
							<a href="<?php echo url($route_prefix.'/'.Auth::User()->uniq_username.'/update-profile'); ?>" onclick="showNotificationApp('top', 'right', 'danger', '<?php echo getLabels('error'); ?>!', '<?php echo getLabels('complete_profile_notification'); ?>');" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1"><?php echo getLabels('create_new_plan'); ?></a>
						<?php endif; ?>
					</div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
            <div class="row mb-4">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead class="thead-light">
										<tr>
											<th> <?php echo getLabels('image'); ?> </th>
											<th> <?php echo SortableTrait::link_to_sorting_action('level_id',  getLabels('level')); ?> </th>
											<th> <?php echo SortableTrait::link_to_sorting_action('price', getLabels('price')); ?> </th>
											<th> <?php echo getLabels('fees'); ?> </th>
											<th> <?php echo SortableTrait::link_to_sorting_action('description', getLabels('Description')); ?> </th>
											<th> <?php echo getLabels('action'); ?> </th>
										</tr>
									</thead>
									<tbody>
										<?php if(!$data->isEmpty()): ?>
											<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php
												$leveldata = getLevelFees($val->level_id); ?>
												<tr class="odd gradeX">
													<td style="max-width:100px;">
														<?php if( !empty($val->image) and file_exists('public/upload/plans/'. $val->image) ): ?>
															<?php echo HTML::image('public/upload/plans/'. $val->image, $val->name, array('class' => 'list-thumbnail border-0')); ?>

														<?php endif; ?>
													</td>
													<td><?php echo config('constants.LEVELS.'.$val->level_id); ?></td>
													<td>$<?php echo $val->price; ?></td>
													<td>
														<?php if(!empty($leveldata->fees)): ?>
															<?php echo $leveldata->fees; ?>% + <?php echo $leveldata->fixed_amount; ?> cents
														<?php endif; ?>
													</td>
													<td><?php echo html_entity_decode($val->description); ?></td>		
													<td><a class="steamerst_link btn btn-outline-primary btn-xs" href="<?php echo url($route_prefix.'/add-subscription-plan/'.$val->id); ?>">Edit</a></td>
												</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php else: ?>
											<tr class="odd gradeX">
												<td colspan="6" class="no_record"><?php echo getLabels('records_not_found'); ?></td>
											</tr>
										<?php endif; ?>
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>