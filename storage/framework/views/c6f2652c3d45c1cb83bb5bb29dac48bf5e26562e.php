<?php $__env->startSection('content'); ?>
 <div class="fixed-background" style="opacity:1;"></div>
    <main style="opacity:1;">
        <div class="container">
			
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
				
                    <div class="card auth-card">
                        
                        <div class="form-side" style="width:100%;">
							<p class="h2">Create Your Account</p>
							<?php echo $__env->make('frontend/alert_message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							<div class="alert alert-danger" role="alert" id="error_alert" style="display:none;">
                                
                            </div>
                            <h6 class="mb-4">One account is all you need to manage your business strategy. Let's get Started ! </h6>
							
							
							
                           <?php echo Form::open(array('url' => url($route_prefix.'/register'), 'class'=>'steamerstudio_form', 'id'=>'register', 'files' => true)); ?>

                               

								<div class="row">
								<div class="col-12 col-lg-12">
								<label class="form-group has-float-label position-relative error-l-100 mb-4">
									 <?php echo Form::text("company_name", null, array("class"=>"form-control")); ?>

									 <div class="invalid-tooltip"></div>
                                    <span>Company Name*</span>

                                </label>
									</div>
									<div class="col-12 col-lg-6">
									<label class="form-group has-float-label position-relative error-l-100 mb-4">
										<?php if($errors->first('first_name')): ?><div class="error"><?php echo $errors->first('first_name'); ?></div><?php endif; ?>
                                   <?php echo Form::text("first_name", null, array("class"=>"form-control")); ?>

                                   <div class="invalid-tooltip"></div>
                                    <span>First Name*</span>
                                </label>
								</div>
								<div class="col-12 col-lg-6"> 
								 <label class="form-group has-float-label position-relative mb-4">
								    <?php echo Form::text("last_name", null, array("class"=>"form-control")); ?>

                                    <span>Last Name</span>
                                </label> 
								</div>

								 <div class="col-12 col-lg-6">
								 <label class="form-group has-float-label position-relative error-l-100 mb-4">
 								 <?php echo Form::text("email", null, array("class"=>"form-control")); ?>

 								 <div class="invalid-tooltip"></div>
                                    <span><?php echo getLabels('email'); ?>*</span>
                                </label>
								</div>
								<div class="col-12 col-lg-6">
                                <label class="form-group has-float-label position-relative error-l-100 mb-4">
                                	<?php echo Form::password("password",array("class"=>"form-control")); ?>

									<div class="invalid-tooltip"></div>
                                    <span><?php echo getLabels('password'); ?>*</span>
                                </label>
								</div>
								
								
								<div class="col-12 col-lg-12">
								
									<div class="form-group position-relative">
										<label class="form-group has-float-label position-relative error-l-100 mb-4">Choose Pricing Plan (free for 30 days)</label>
								
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
										<div class="monthlyshow">
											<?php if(!empty($plans)): ?>
											<?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="custom-control custom-radio">
												<input type="radio" id="jQueryCustomRadio<?php echo $key; ?>" name="plan_id" class="custom-control-input" value="<?php echo $plan->id; ?>">
												<label class="custom-control-label" for="jQueryCustomRadio<?php echo $key; ?>">
													<?php echo $plan->heading; ?> ( $<?php echo $plan->plan_fee; ?> per month | Upto <?php echo $plan->emp_limit; ?> Member )
												</label>
											</div>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
										<div class="invalid-tooltip"></div>
										<div class= "yearlyshow" style="display: none;">
											<?php endif; ?>
											<?php if(!empty($yearly)): ?>
											<?php $__currentLoopData = $yearly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $yp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="custom-control custom-radio">
												<input type="radio" id="yearly<?php echo $key; ?>" name="plan_id" class="custom-control-input" value="<?php echo $yp->id; ?>">
												<label class="custom-control-label" for="yearly<?php echo $key; ?>">
													<?php echo $yp->heading; ?> ( $<?php echo $yp->plan_fee; ?> per month | Upto <?php echo $yp->emp_limit; ?> Member )
												</label>
											</div>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php endif; ?>
										</div>
										<div class="invalid-tooltip"></div>
									</div>
								</div>

							</div>								
								
								
                                <div class="d-flex justify-content-between float-right">
									
                                    <button class="btn btn-primary btn-lg btn-shadow text-uppercase" type="submit">Submit</button>
                                </div>
							<?php echo Form::Close(); ?>

							<div style="clear:both;"></div>
							 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
	<?php if(Auth::check()): ?>{
		<script type="text/javascript">
			pageUrl = SITE_URL+'dashboard';
			$.cergis.loadContent();
			e.preventDefault();
		</script>
	<?php endif; ?>
	<script type="text/javascript">
		$(document).on("click",".plan_type",function(){
			if($(this).val() == 2){
				$(".monthlyshow").hide();
				$(".yearlyshow").show();
			}else{
				$(".monthlyshow").show();
				$(".yearlyshow").hide();
			}
		});

		$("body").on('submit', ".steamerstudio_formlogin", function(e) {
			e.preventDefault();
			var form_action = $(this).attr('action');
			pageUrl = SITE_URL+'dashboard';
			data = $(this).serialize();
			$.ajax({
				type:"POST",
				url: form_action,
				data:data,
				dataType:'json',
				success: function (response) {
					
					if(response.status == 'error'){
						jQuery('#error_alert').show();
						jQuery('#error_alert').html(response.message);
					}else{
						if(response.header){
							jQuery('#main-content-navigation').html(response.header);
							jQuery('#main-content-navigation').append(response.navigation);
						}
						new $.dore(this);
						
						$.cergis.loadContent();
						e.preventDefault();
					}
				},
				 error: function(xhr, ajaxOptions, thrownError) {
				  console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>