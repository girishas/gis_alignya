
<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('Payouts'); ?></h1>
					<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('Payouts'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
            <div class="row mb-4">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">

                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
										<th> <?php echo SortableTrait::link_to_sorting_action('first_name', getLabels('receiver_name')); ?> </th>
										<th> <?php echo SortableTrait::link_to_sorting_action('payout_email', getLabels('receiver_email')); ?> </th>
										<th> <?php echo getLabels('action'); ?> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!$data->isEmpty()): ?>
										<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr class="odd gradeX">
												<td><?php echo $val->first_name." ".$val->last_name; ?></td>
												<td><a href="mailto:<?php echo $val->payout_email; ?>"><?php echo $val->payout_email; ?></a></td>
												<td>
													<?php if($val->payout_status==0): ?>
														<a href="<?php echo url($route_prefix.'/payout-amount-detail/'.$val->uniq_username); ?>" class="btn btn-primary steamerst_link"><?php echo str_singular(getLabels('Payouts')); ?></a>
													<?php else: ?>
														<a href="javascript::void(0);" class="btn btn-success"><?php echo getLabels('paid'); ?></a>
													<?php endif; ?>	
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