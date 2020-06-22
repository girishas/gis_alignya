<?php if(empty($_POST)): ?>

<?php endif; ?>


<?php if(empty($_POST)): ?>
<?php $__env->startSection('content'); ?>
	<?php echo HTML::style('public/slimcropper/css/slim.css'); ?>

	<?php echo HTML::style('public/slimcropper/css/style.css'); ?>

	<?php echo HTML::script('public/slimcropper/js/slim.kickstart.min.js'); ?>

  <main>
  <?php endif; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('Add New Members'); ?></h1>
					<div class="text-zero top-right-button-container">
						<a href="<?php echo url($route_prefix, 'users'); ?>" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1"><?php echo getLabels('Members'); ?></a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'users'); ?>"><?php echo getLabels('Members'); ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('Add New Members'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					<?php echo Form::open(array('url' => array($route_prefix.'/members/new'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

						<div class="form-row">
							<div class="form-group col-md-3">
								<label for=""><?php echo getLabels('profile_picture'); ?></label>
								<div class="slim" data-ratio="1:1" data-instant-edit="true">
									<input type="file" name="photo"/>
								</div>
							</div>							
						</div>
						<div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputFirstname"><?php echo getLabels('First Name'); ?></label>
								<?php echo Form::text('first_name', null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputLastname"><?php echo getLabels('last_name'); ?></label>
								<?php echo Form::text('last_name', null, array('class' => 'form-control', 'id' => 'inputLastname',  'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group  position-relative error-l-40 col-md-6">
								<label for="inputEmail4"><?php echo getLabels('email'); ?></label>
								<?php echo Form::text('email', null, array('class' => 'form-control', "id"=>"inputEmail4", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMobile"><?php echo getLabels('contact_number'); ?></label>
								<?php echo Form::text('mobile', null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						<div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMobile"><?php echo getLabels('Designation'); ?></label>
								<?php echo Form::text('designation', null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							
						</div>
						
						
						
						
						
						
						
						
						<div class="form-group  position-relative error-l-100">
						<button type="submit" class="btn btn-primary"><?php echo getLabels('Submit'); ?></button>&nbsp;&nbsp;
						<a href="<?php echo url($route_prefix, 'users'); ?>" class="btn btn-dark steamerst_link"><?php echo getLabels('back'); ?></a>
						</div>
					<?php echo Form::close(); ?>

				</div>
			</div>
        </div>
	<?php if(empty($_POST)): ?>
    </main>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>