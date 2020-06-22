<?php use App\Traits\SortableTrait;  ?>


<?php $__env->startSection('content'); ?>
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('Testimonials'); ?></h1>
					<div class="text-zero top-right-button-container">
						<a href="<?php echo url($route_prefix.'/testimonials/add'); ?>" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1"><?php echo getLabels('add_new_testimonials'); ?> </a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('Testimonials'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
				<div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4"><?php echo getLabels('Search'); ?></h5>
                            <?php echo Form::open(array('url' => array($route_prefix.'/testimonials'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')); ?>

								<div class="form-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<?php echo Form::text('name', isset($_POST['name'])?trim($_POST['name']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_name'))); ?>

											</div>
										</div>

										<div class="col-lg-3">
											<div class="form-group">
												<?php echo Form::select('status', array('' => getLabels('all_status')) + config('constants.STATUS'), isset($_POST['status'])?$_POST['status']:null, array('class' => 'form-control')); ?>

											</div>
										</div>
										
										<div class="col-lg-3">               
											<button class="btn btn-primary mb-1" type="submit"><?php echo getLabels('Search'); ?></button>
											<a class="btn btn-dark mb-1 steamerst_link" href="<?php echo url($route_prefix, 'testimonials'); ?>"><?php echo getLabels('show_all'); ?></a>
										</div>
									</div>
								</div>
							<?php echo Form::close(); ?>

                        </div>
                    </div>
				</div>
			</div>
			
			
            <div class="row mb-4">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">

                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                    	<th> <?php echo SortableTrait::link_to_sorting_action('image', getLabels('image')); ?> </th>
										<th> <?php echo SortableTrait::link_to_sorting_action('name', getLabels('Name')); ?> </th>
										<th> <?php echo SortableTrait::link_to_sorting_action('designation', getLabels('designation')); ?> </th>
										<th> <?php echo SortableTrait::link_to_sorting_action('content', getLabels('Content')); ?> </th>
										<th class="text-center"> <?php echo SortableTrait::link_to_sorting_action('status', getLabels('status')); ?> </th>
										<th> <?php echo getLabels('action'); ?> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!$data->isEmpty()): ?>
										<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr class="odd gradeX">
												<?php
												$remove_url = url($route_prefix."/testimonials-remove/".$val->id); ?>
												<td>
													<img src="../public/upload/testimonials/<?php echo $val->image; ?>" class='img-circle' width="100px" height="100px">
												</td>
												<td><?php echo $val->name; ?></td>
												<td><?php echo $val->designation; ?></td>
												<td><?php echo $val->content; ?></td>
												<td class="text-center">
													<?php if($val->status == 1): ?>
														<a class="steamerst_status" href="<?php echo url($route_prefix.'/testimonials/status/'.$val->id); ?>" title="<?php echo getLabels('decline'); ?>"><span class="badge badge-pill badge-secondary "> <?php echo config('constants.STATUS.1'); ?> </span></a>
													<?php else: ?>
														<a class="steamerst_status" href="<?php echo url($route_prefix.'/testimonials/status/'.$val->id); ?>" title="<?php echo getLabels('approve'); ?>"><span class="badge badge-pill badge-danger "> <?php echo config('constants.STATUS.0'); ?> </span></a>
													<?php endif; ?>
												</td>
												<td>
													<div class="btn-group float-none-xs">
														<button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<?php echo getLabels('action'); ?>

														</button>
														<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
															<a class="steamerst_link dropdown-item" href="<?php echo url($route_prefix.'/testimonials/edit/'.$val->id); ?>"><?php echo getLabels('edit'); ?></a>
															<a class="dropdown-item" onclick = 'showConfirmationModal("<?php echo  getLabels('remove'); ?>", "<?php echo  getLabels('are_you_sure'); ?>", "<?php echo $remove_url; ?>");' href="javascript:void(0);"><?php echo getLabels('remove'); ?></a>
														</div>
													</div>
												</td>
											</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php else: ?>
									<tr class="odd gradeX">
										<td colspan="6" class="no_record"><?php echo getLabels('records_not_found'); ?></td>
									</tr>
								<?php endif; ?>
                                </tbody>
                            </table>
							<br />
							
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
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>