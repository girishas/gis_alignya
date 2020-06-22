<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
	<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('Labels'); ?></h1>
					<div class="text-zero top-right-button-container">
						<a href="<?php echo url($route_prefix.'/labels/add'); ?>" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1"><?php echo getLabels('add_new_label'); ?></a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('Labels'); ?></li>
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
                            <?php echo Form::open(array('url' => array($route_prefix.'/labels'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')); ?>

								<div class="form-body">
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group">
												<?php echo Form::text('label_key', isset($_POST['label_key'])?trim($_POST['label_key']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_label_key'))); ?>

											</div>
										</div>

										<div class="col-lg-4">
											<div class="form-group">
												<?php echo Form::text('label_text', isset($_POST['label_text'])?trim($_POST['label_text']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_label_text'))); ?>

											</div>
										</div>

										
										<div class="col-lg-3">               
											<button class="btn btn-primary mb-1" type="submit"><?php echo getLabels('Search'); ?></button>
											<a class="btn btn-dark mb-1 steamerst_link" href="<?php echo url($route_prefix, 'labels'); ?>"><?php echo getLabels('show_all'); ?></a>
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
							<div class="table-responsive">
								<table class="table">
									<thead class="thead-light">
										<tr>
											<th> <?php echo SortableTrait::link_to_sorting_action('label_key', getLabels('key')); ?> </th>
											<th> <?php echo SortableTrait::link_to_sorting_action('label_text_en', getLabels('Label')); ?> </th>
											<?php /* <th> {!! SortableTrait::link_to_sorting_action('label_text_sp', getLabels('spanish')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('label_text_fr', getLabels('french')) !!} </th> */ ?>
											<th> <?php echo getLabels('action'); ?> </th>
										</tr>
									</thead>
									<tbody>
										<?php if(!$data->isEmpty()): ?>
											<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<tr class="odd gradeX">
													<td><?php echo $val->label_key; ?></td>
													<td><?php echo $val->label_text_en; ?></td>
													<?php /* <td>{!! $val->label_text_sp !!}</td>
													<td>{!! $val->label_text_fr !!}</td> */ ?>
													<td>
														<div class="btn-group float-none-xs">
															<button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<?php echo getLabels('action'); ?>

															</button>
															<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
																<a class="steamerst_link dropdown-item" href="<?php echo url($route_prefix.'/labels/edit/'.$val->id); ?>"><?php echo getLabels('edit'); ?></a>
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
							</div>
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