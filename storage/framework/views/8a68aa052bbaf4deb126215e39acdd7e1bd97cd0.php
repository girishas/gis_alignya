<?php if(empty($_POST)): ?>

<?php endif; ?>


<?php if(empty($_POST)): ?>
<?php $__env->startSection('content'); ?>

  <main>
  <?php endif; ?>
  
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('Update Company'); ?></h1>
					<div class="text-zero top-right-button-container">
						<a href="<?php echo url($route_prefix, 'companies'); ?>" class="steamerst_link btn btn-primary btn-sm top-right-button mr-1"><?php echo getLabels('Company'); ?></a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'companies'); ?>"><?php echo getLabels('Company'); ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('Update Company'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					<?php echo Form::model($data, array('url' => array($route_prefix.'/company/update/'.$data->company_id), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

						
						<div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputFirstname"><?php echo getLabels('Company Name'); ?></label>
								<?php echo Form::text('company_name', null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-6">
								<label for="inputEmail4"><?php echo getLabels('email'); ?></label>
								<?php echo Form::text('email', null, array('class' => 'form-control', "id"=>"inputEmail4", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputFirstname"><?php echo getLabels('First Name'); ?></label>
								<?php echo Form::text('first_name', null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputLastname"><?php echo getLabels('last_name'); ?></label>
								<?php echo Form::text('last_name', null, array('class' => 'form-control', 'id' => 'inputLastname',  'placeholder'=> '')); ?>

								<?php echo Form::hidden('user_id',null,array('class'=>'form-control')); ?>

								<div class="invalid-tooltip"></div>
							</div>
						</div>
						<label class="form-group has-float-label position-relative error-l-100 mb-4">Choose Pricing Plan</label>
								
										<div style="display: inline-flex;">
											<div class="custom-control custom-radio">
												
												<input type="radio" id="monthlyplan" name="plan_type" class="custom-control-input plan_type" value="1" checked="checked">
												<label class="custom-control-label" for="monthlyplan">
													Monthly &nbsp;&nbsp;&nbsp;
												</label>
											</div>
											<div class="custom-control custom-radio">
												<input type="radio" id="yearlyplan" name="plan_type" class="custom-control-input plan_type" value="2">
												<label class="custom-control-label" for="yearlyplan">Yerly</label>
											</div>
										</div>
						<div class="form-group">

						<div class="monthlyshow">
											<?php if(!empty($plans)): ?>
											<?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="custom-control custom-radio">
												<?php if($plan->id == $data->plan_id): ?>
												<input type="radio" id="jQueryCustomRadio<?php echo $key; ?>" name="plan_id" class="custom-control-input" value="<?php echo $plan->id; ?>" checked="checked">
												<?php else: ?>
												<input type="radio" id="jQueryCustomRadio<?php echo $key; ?>" name="plan_id" class="custom-control-input" value="<?php echo $plan->id; ?>">
												<?php endif; ?>
												<label class="custom-control-label" for="jQueryCustomRadio<?php echo $key; ?>">
													<?php echo $plan->heading; ?> ( $<?php echo $plan->plan_fee; ?> per month | Upto <?php echo $plan->emp_limit; ?> Member )
												</label>
											</div>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
										<div class= "yearlyshow" style="display: none;">
											<?php endif; ?>
											<?php if(!empty($yearly)): ?>
											<?php $__currentLoopData = $yearly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $yp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="custom-control custom-radio">
												
												<input type="radio" id="yearly<?php echo $key; ?>" name="plan_id" class="custom-control-input" value="<?php echo $plan->id; ?>">
												<label class="custom-control-label" for="yearly<?php echo $key; ?>">
													<?php echo $yp->heading; ?> ( $<?php echo $yp->plan_fee; ?> per month | Upto <?php echo $yp->emp_limit; ?> Member )
												</label>
											</div>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php endif; ?>
										</div>
										<div class="invalid-tooltip"></div>	
							
						</div>
						
						
						<div class="form-group ">
						<button type="submit" class="btn btn-primary"><?php echo getLabels('update'); ?></button>&nbsp;&nbsp;
						<a href="<?php echo url($route_prefix, 'companies'); ?>" class="btn btn-dark steamerst_link"><?php echo getLabels('back'); ?></a>
						</div>
					<?php echo Form::close(); ?>

				</div>
			</div>
        </div>
	<script>
	$('.plan_type').click(function(){
			if($(this).val() == 2){
				$(".monthlyshow").hide();
				$(".yearlyshow").show();
			}else{
				$(".monthlyshow").show();
				$(".yearlyshow").hide();
			}
		});
</script>	
	<?php if(empty($_POST)): ?>
    </main>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>