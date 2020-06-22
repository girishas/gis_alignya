

<?php $__env->startSection('content'); ?>
	<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('application_settings'); ?></h1>
					<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                           <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('application_settings'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					<?php echo Form::open(array('url' => array($route_prefix.'/settings'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search')); ?>

						<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="form-group  position-relative error-l-150">
								<label for="input<?php echo $val->slug; ?>"><?php echo $val->label; ?></label>
								<?php if($val->type == 'textarea'): ?>
									<?php echo Form::textarea($val->slug, $val->value, array('rows'=>3, 'id' => 'input'.$val->slug, 'style'=>'resize:none;', 'class' => 'form-control ')); ?>

								<?php elseif($val->type == 'text'): ?>
									<?php echo Form::text($val->slug, $val->value, array('id' => 'input'.$val->slug, 'class' => 'form-control')); ?>

								<?php else: ?>
									<?php echo Form::text($val->slug, $val->value, array('id' => 'input'.$val->slug, 'class' => 'form-control ')); ?>

								<?php endif; ?>
								<?php if($val->description): ?>
									<span> <?php echo $val->description; ?> </span></br>
								<?php endif; ?>
								<div class="invalid-tooltip"></div>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<div class="form-group">
							<button type="submit" class="btn btn-primary"><?php echo getLabels('update'); ?></button>
						</div>
					<?php echo Form::close(); ?>

				</div>
			</div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>