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
                    <h1><?php echo getLabels('Add New Teams'); ?></h1>
					<div class="text-zero top-right-button-container">
						<a href="<?php echo url($route_prefix, 'teams'); ?>" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1"><?php echo getLabels('Teams'); ?></a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'teams'); ?>"><?php echo getLabels('Teams'); ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('Add New Teams'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					<?php echo Form::open(array('url' => array($route_prefix.'/teams/new'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

						
						<div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputFirstname"><?php echo getLabels('Team Name'); ?></label>
								<?php echo Form::text('team_name', null, array('class' => 'form-control', 'id' => 'inputTeamname',  'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMembers"><?php echo getLabels('Team Lead'); ?></label>
                                <select class="form-control select2-single" name="team_head" data-width="100%">
                                	<option label="&nbsp;">Select Team Lead</option>
                                	<?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    	<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>						
								<div class="invalid-tooltip"></div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMembers"><?php echo getLabels('Team Members'); ?></label>
                                <select name = "team_members[]" class="form-control select2-multiple" multiple="multiple" data-width="100%">
                                	<?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    	<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
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