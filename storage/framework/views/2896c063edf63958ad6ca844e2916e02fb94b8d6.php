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
                            <?php echo Form::open(array('url' => array($route_prefix.'/my-subscriptions'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')); ?>

								<div class="form-body">
									<div class="input-group">
										<?php echo Form::text('keyword', isset($_POST['keyword'])?trim($_POST['keyword']):null, array('class' => 'form-control',  'placeholder'=> getLabels('keyword'))); ?>

										<div class="input-group-append">
											<button class="btn btn-outline-secondary" type="submit"><?php echo getLabels('Search'); ?></button>
											<a class="btn btn-outline-secondary  steamerst_link" href="<?php echo url($route_prefix, 'my-subscriptions'); ?>"><?php echo getLabels('clear_search'); ?></a>
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
											<th> <?php echo SortableTrait::link_to_sorting_action('plan_name', getLabels('plan_name')); ?> </th>
											<th> <?php echo SortableTrait::link_to_sorting_action('level', getLabels('level')); ?> </th>
											<th> <?php echo SortableTrait::link_to_sorting_action('first_name', getLabels('channel_owner')); ?> </th>
											<th> <?php echo SortableTrait::link_to_sorting_action('created_at', getLabels('renew')); ?> </th>
											<th> <?php echo SortableTrait::link_to_sorting_action('status', getLabels('status')); ?> </th>
											<th> Action </th>
										</tr>
									</thead>
									<tbody>
										<?php if(!$data->isEmpty()): ?>
											<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
												<tr class="odd gradeX">
													<td><?php echo $val->transaction_id; ?></td>
													<td><?php echo $val->plan_name; ?> <br /> $<?php echo $val->amount; ?> / <?php echo getLabels('month'); ?></td>
													<td><?php echo config('constants.LEVELS.'.$val->level); ?></td>
													<td><?php echo $val->first_name." ".$val->last_name; ?></td>
													<td><?php echo date("d M Y", strtotime("+1 month", strtotime($val->created_at))); ?></td>
													<td>
														<?php if($val->status==1): ?>
															<?php echo getLabels('subscribed'); ?>

														<?php elseif($val->status==0): ?>
															<?php echo getLabels('unsubscribed'); ?>

														<?php endif; ?>
													</td>
													<td>
														<?php if($val->status==1): ?>
															<a href="javascript:void(0);"  onClick="cancelAppPayment(<?php echo $val->id; ?>, 'unsubscribes', <?php echo $val->plan_id; ?>, '<?php echo $val->uniq_username; ?>')" class="btn btn-outline-primary"><?php echo getLabels('unsubscribe'); ?></a>
														<?php else: ?>
															<p>NA</p>
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
	
	<script type="text/javascript">
		var token = "<?php echo csrf_token(); ?>";
		var url="";
		var redirectUrl="<?php echo url('my-subscriptions'); ?>";
		var id = "";
		var data = "";
		var text_ask ="";
		var prefix  = "";
		var ptype = "";
		function cancelAppPayment(sub_id, type, planId, username){
			ptype = type;
			prefix = username;
			token = "<?php echo csrf_token(); ?>";
			if(type == 'unsubscribes'){
				id = sub_id;
				url = SITE_URL_BASE+prefix+"/unsubscribe/"+id;		
				text_ask = "<?php echo getLabels('unsubscribe_message'); ?>";			
				data = {_token:token};			
			}
			showConfirmationModalsubscription("<?php echo getLabels('confirm'); ?>", text_ask);
		}
		
		
		function showConfirmationModalsubscription(title, message){
			$('#modalTitleSub').html(title);
			$('#modalBodySub').html(message);
			$('#showConfirmationModalsubscription').modal('show');
		}
		
		$("body").on('click', "#confirmURLSub", function(e) {
			$('#showConfirmationModalsubscription').modal('hide');
			$.ajax({
				method:"POST",
				url:url,
				data:data,
				success:function(response){						
					if(response){
						pageUrl = redirectUrl;
						$.cergis.loadContent();
						e.preventDefault();
						if(ptype == 'unsubscribes'){
							showNotificationApp('top', 'right', 'primary', "<?php echo getLabels('success'); ?>!", "<?php echo getLabels('current_plan_unsubscribed'); ?>");
						}
					}										
				},
				error:function(){
					showNotificationApp('top', 'right', 'danger', "<?php echo getLabels('error'); ?>!", "<?php echo getLabels('something_went_wrong'); ?>");
				}
			});	
		});
		
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>