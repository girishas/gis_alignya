

<?php $__env->startSection('content'); ?>
	<?php echo HTML::style('public/slimcropper/css/slim.css'); ?>

	<?php echo HTML::style('public/slimcropper/css/style.css'); ?>

	<?php echo HTML::script('public/slimcropper/js/slim.kickstart.min.js'); ?>

  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('update_language'); ?></h1>
					<div class="text-zero top-right-button-container">
						<a href="<?php echo url($route_prefix, 'languages'); ?>" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1"><?php echo getLabels('Languages'); ?></a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'languages'); ?>"><?php echo getLabels('Languages'); ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('update_language'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					<?php echo Form::model($data, array('url' => array($route_prefix.'/languages/edit/'.$data->id), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label for=""><?php echo getLabels('Icon'); ?></label>
								<div class="slim" data-ratio="3:2" data-instant-edit="true" data-will-remove="profileimageWillBeRemoved">
									<?php if( $data->icon and file_exists('public/upload/language/'. $data->icon) ): ?>
										<?php echo HTML::image('public/upload/language/'. $data->icon, $data->first_name); ?>

									<?php endif; ?>

									<input type="file" name="icon"/>
								</div>
							</div>
						</div>
						
					
						<div class="form-group  position-relative error-l-100">
							<label><?php echo getLabels('Name'); ?></label>
							<?php echo Form::text('name', null, array('class' => 'form-control', "id"=>"name", 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-40">
							<label><?php echo getLabels('code'); ?></label>
							<?php echo Form::text('code', null, array('required', "maxlength"=>"3", 'class' => 'form-control', "id"=>"code", 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
							<label><?php echo getLabels('status'); ?> </label>
							<?php echo Form::select('status', array('' => 'Please Select','0' => 'inactive', '1' => 'active'),null, array('class' =>'form-control')); ?>

							<div class="invalid-tooltip"></div>
						</div>
							
						<div class="form-group  position-relative error-l-100">
						<button type="submit" class="btn btn-primary"><?php echo getLabels('Submit'); ?></button>&nbsp;&nbsp;
						<a href="<?php echo url($route_prefix, 'languages'); ?>" class="btn btn-dark steamerst_link"><?php echo getLabels('back'); ?></a>
						</div>
					<?php echo Form::close(); ?>

				</div>
			</div>
        </div>
	</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>