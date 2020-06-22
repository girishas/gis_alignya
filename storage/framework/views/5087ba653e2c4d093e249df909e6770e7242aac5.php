
<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo $page_title; ?></h1>
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

                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
										<th> <?php echo getLabels('id'); ?> </th>
										<th> <?php echo getLabels('profile_id'); ?> </th>
										<th> <?php echo getLabels('price'); ?> </th>
										<th> <?php echo str_singular(getLabels('Subscription_Plans')); ?> </th>
										<th> <?php echo getLabels('status'); ?> </th>
										<th> <?php echo getLabels('subscriber_name'); ?> </th>
										<?php /* <th> Invoice </th> */ ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!$data->isEmpty()): ?>
										<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr class="odd gradeX"><?php 
												$plan = getPlanDetailsByID($val->id); ?>
												<td><?php echo $val->subscription_id; ?></td>
												<td><?php echo $val->profile_id; ?></td>								
												<td>$<?php echo $val->amount; ?></td>
												<td><?php echo $plan->name; ?> <br /> <?php echo number_format($plan->price, 2); ?>/month</td>
												<td><?php echo $val->profile_status; ?></td>
												<td><?php
													$user = getUserDetail($val->subscriber_user_id); ?>
													<?php if(!empty($user->first_name)): ?>
														<?php echo $user->first_name." ".$user->last_name; ?>

													<?php endif; ?>
												</td>
												<?php /* <td><button class="btn btn-primary invoiceLayer" rel="{!! $val->profile_id !!}"><i class="simple-icon-eye"></i></button></td>	*/ ?>
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