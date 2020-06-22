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
                    <h1><?php echo getLabels('update_profile'); ?></h1>
					
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, Auth::User()->uniq_username); ?>"><?php echo getLabels('my_profile'); ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('update_profile'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
	
					<?php echo Form::open(array('url' => "", 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

						
						<div class="form-row">
							
							<div class="form-group  position-relative error-l-100 col-md-12">
								<label for="inputFirstname"><?php echo getLabels('company_name'); ?></label>
								<?php echo Form::text('company_name', 'abc private Ltd', array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							
						</div>
						
						<div class="form-row">
							<div class="form-group  position-relative error-l-40 col-md-6">
								<label for="inputEmail4"><?php echo getLabels('email'); ?></label>
								<?php echo Form::text('email', 'dev.girishas@test.com', array( 'class' => 'form-control', "id"=>"inputEmail4", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMobile"><?php echo getLabels('contact_number'); ?></label>
								<?php echo Form::text('mobile', '6575757654', array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
						</div>
						
					
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputAboutYou"><?php echo getLabels('about'); ?></label>
							<?php echo Form::textarea('about', 'I spend my whole day, practically every day, experimenting with HTML, CSS, and JavaScript through a few hundred RSS feeds. I build websites that delight and inform. I do it well.', array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						<div class="form-group  position-relative error-l-100">
							<label for="inputAboutYou"><?php echo getLabels('mission'); ?></label>
							<?php echo Form::textarea('mission', 'Wedding cake with flowers Macarons and blueberries Wedding cake with flowers Macarons and blueberries', array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						<div class="form-group  position-relative error-l-100">
							<label for="inputAboutYou"><?php echo getLabels('vision'); ?></label>
							<?php echo Form::textarea('vision', 'Wedding cake with flowers Macarons and blueberries Wedding cake with flowers Macarons and blueberries', array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						<div class="form-group  position-relative error-l-100">
							<label for="inputAboutYou"><?php echo getLabels('value'); ?></label>
							<?php echo Form::textarea('value', 'Wedding cake with flowers Macarons and blueberries', array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div><div class="form-group  position-relative error-l-100">
							<label for="inputAboutYou"><?php echo getLabels('address'); ?></label>
							<?php echo Form::textarea('value', 'Nairobi, Kenya', array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						
						<div class="form-group ">
						<button type="submit" class="btn btn-primary"><?php echo getLabels('update'); ?></button>&nbsp;&nbsp;
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