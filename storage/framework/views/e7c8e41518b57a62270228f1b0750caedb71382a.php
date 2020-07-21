<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('perspective'); ?></h1>
                    <div class="float-md-right">
                    <!-- <a href="<?php echo url($route_prefix.'/perspective/add'); ?>" class="steamerst_link btn btn-primary btn-sm top-right-button mr-1"><?php echo getLabels('add_perspective'); ?></a> -->
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('perspective'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
            <?php if(session('message')): ?>
			<div class="alert alert-success" role="alert" style="z-index: unset;">
				<?php echo session('message'); ?>

			</div>
			<?php endif; ?>
			
            <div class="row mb-4">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead class="thead-light">
										<tr>
										   <th> <?php echo getLabels('perspective_name'); ?> </th>
											<th class="text-center"> <?php echo getLabels('status'); ?> </th>
											<th> <?php echo getLabels('action'); ?> </th>
										</tr>
									</thead>
									<tbody>
										<?php if(!$data->isEmpty()): ?>
											<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php 
											$remove_url  = url($route_prefix.'/perspective/remove/'.$val->id);
											$remove_msg = "Are you sure."
											?>
												<tr class="odd gradeX">
													<td><?php echo $val->name; ?></td>
													
													<td class="text-center"><span class="badge badge-pill badge-primary" style="background: #4dd0e1 !important"><?php echo config('constants.STATUS.'.$val->status); ?></span></td>
													<td>
														<a href="<?php echo url($route_prefix.'/perspective/update/'.$val->id); ?>"><i class="heading-icon simple-icon-pencil"></i></a>
														<a  onclick = 'showConfirmationModal("Remove", "<?php echo $remove_msg; ?>", "<?php echo $remove_url; ?>");' href="javascript:void(0);" title="Remove"><i class="simple-icon-trash heading-icon"></i></a>

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