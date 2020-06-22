
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
			
			<div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4"><?php echo getLabels('Search'); ?></h5>
                            <?php echo Form::open(array('url' => array($route_prefix.'/transaction-history'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')); ?>

								<div class="form-body">
									<div class="input-group">
										<?php echo Form::text('keyword', isset($_POST['keyword'])?trim($_POST['keyword']):null, array('class' => 'form-control',  'placeholder'=> getLabels('keyword'))); ?>

										<div class="input-group-append">
											<button class="btn btn-outline-secondary" type="submit"><?php echo getLabels('Search'); ?></button>
											<a class="btn btn-outline-secondary  steamerst_link" href="<?php echo url($route_prefix, 'transaction-history'); ?>"><?php echo getLabels('clear_search'); ?></a>
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
											<th> <?php echo SortableTrait::link_to_sorting_action('transaction_id', getLabels('transaction_id')); ?> </th>
											<th> <?php echo SortableTrait::link_to_sorting_action('amount', getLabels('price')); ?> </th>
											<th> <?php echo getLabels('plan_name'); ?> </th>
											<th> <?php echo SortableTrait::link_to_sorting_action('profile_status', getLabels('payment_status')); ?> </th>
											<th> <?php echo getLabels('subscriber_name'); ?> </th>
										</tr>
									</thead>
									<tbody>
										<?php if(!$data->isEmpty()): ?>
											<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
												<?php $plan = getPlanDetailsByID($val->id); ?>
												<tr class="odd gradeX">
													<td><?php echo $val->transaction_id; ?></td>
													<td>$<?php echo $val->amount; ?> </td>
													<td><?php echo $plan->name; ?></td>
													<td><?php echo $val->profile_status; ?></td>
													<td><?php
														$user = getUserDetail($val->subscriber_user_id); ?>
														<?php if(!empty($user->first_name)): ?>
															<?php echo $user->first_name." ".$user->last_name; ?>

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