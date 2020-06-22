

<?php $__env->startSection('content'); ?>
	<?php echo HTML::style('public/slimcropper/css/slim.css'); ?>

	<?php echo HTML::style('public/slimcropper/css/style.css'); ?>

	<?php echo HTML::script('public/slimcropper/js/slim.kickstart.min.js'); ?>

  <main>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h1><?php echo $page_title; ?> </h1>
				<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
					<ol class="breadcrumb pt-0">
						<li class="breadcrumb-item">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
						</li>
						  <li class="breadcrumb-item">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'subscription-plans'); ?>"><?php echo getLabels('Subscription_Plans'); ?></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $page_title; ?></li>
					</ol>
				</nav>
				<div class="separator mb-5"></div>
			</div>
		</div>
			
			
		<div class="card mb-4">
			<div class="card-body">
				
				<?php echo Form::model($data, array('url' => array($route_prefix.'/add-subscription-plan/'.$id), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search')); ?>

					<div class="form-group  position-relative error-l-50 col-md-6">
						<label for="inputSlug"><?php echo getLabels('Name'); ?></label>
						<?php echo Form::text('name', null, array('class' => 'form-control')); ?>

						<div class="invalid-tooltip"></div>
					</div>
					
					<div class="form-group col-md-2">
						<label for=""><?php echo getLabels('image'); ?></label>
						<div class="slim" data-ratio="1:1" data-instant-edit="true" >
							<?php if( !empty($data->image) and file_exists('public/upload/plans/'. $data->image) ): ?>
								<?php echo HTML::image('public/upload/plans/'. $data->image, $data->name); ?>

							<?php endif; ?>
							<input type="file" name="image" />
						</div>
					</div>
					
					<div class="form-group  position-relative error-l-50 col-md-6">
						<label for="inputTitle"><?php echo getLabels('price'); ?></label>
						<?php echo Form::text('price', null, array('class' => 'form-control', 'id' => 'price')); ?>

						<div class="invalid-tooltip"></div>
					</div>
					
					<div class="form-group  position-relative error-l-50 col-md-6">
						<label for="inputSlug"><?php echo getLabels('level'); ?></label>
						<?php echo Form::select('level_id',config('constants.LEVELS'),null, array('class' => 'form-control')); ?>

						<div class="invalid-tooltip"></div>
					</div>
					
					<?php /* <div class="form-group  position-relative error-l-50 col-md-6">
						<label for="inputSlug">Allowed Content</label>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="customCheckText">
							<label class="custom-control-label" for="customCheckText">Text</label>
						</div>
						
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="customCheckImage">
							<label class="custom-control-label" for="customCheckImage">Image</label>
						</div>
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="customCheckVideo">
							<label class="custom-control-label" for="customCheckVideo">Video</label>
						</div>
					</div> */ ?>
					
					
					<div class="form-group  position-relative error-l-100 col-md-6">
						<label for="inputSlug"><?php echo getLabels('Description'); ?></label>
						<?php echo Form::textarea('description', null, array('class' => 'form-control summernote', 'rows' => 3)); ?>

						<div class="invalid-tooltip"></div>
					</div>
	
					<div class="form-group col-md-6">
						<button type="submit" class="btn btn-primary"><?php echo getLabels('Submit'); ?></button>&nbsp;&nbsp;
						<a href="<?php echo url($route_prefix, 'subscription-plans'); ?>" class="btn btn-dark steamerst_link"><?php echo getLabels('back'); ?></a>
					</div>
				<?php echo Form::close(); ?>

			</div>
		</div>
    </div>

</main>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.summernote').summernote({
			height: 200,
				toolbar: [
				['font', ['bold', 'underline', 'clear']],
				['fontname', ['fontname']],
				['para', ['ul', 'ol', 'paragraph']],
			  ],
			popover: {
			image: [],
			link: [],
			air: []
			}
		});
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>