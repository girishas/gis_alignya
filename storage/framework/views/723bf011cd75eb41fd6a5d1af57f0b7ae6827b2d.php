<?php if(empty($_POST)): ?>

<?php endif; ?>


<?php if(empty($_POST)): ?>
<?php $__env->startSection('content'); ?>

	
  <main>
  <?php endif; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('update_email_template'); ?></h1>
					<div class="text-zero top-right-button-container">
						<a href="<?php echo url($route_prefix, 'templates'); ?>" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1"><?php echo getLabels('Email_Templates'); ?></a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'templates'); ?>"><?php echo getLabels('Email_Templates'); ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('update_email_template'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					<?php echo Form::model($data, array('url' => array($route_prefix.'/templates/edit/'.$data->slug), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search')); ?>

						<div class="form-group  position-relative error-l-50">
							<label for="inputTitle"><?php echo getLabels('Name'); ?></label>
							<?php echo Form::text('name', null, array('class' => 'form-control', 'id' => 'inputTitle',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug"><?php echo getLabels('slug'); ?></label>
							<?php echo Form::text('slug', null, array('class' => 'form-control', 'id' => 'inputSlug',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-60">
							<label for="inputMetaTitle"><?php echo getLabels('subject'); ?> (<?php echo getLabels('english'); ?>)</label>
							<?php echo Form::text('subject_en', null, array('class' => 'form-control',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-60">
							<label for="inputMetaTitle"><?php echo getLabels('subject'); ?> (<?php echo getLabels('spanish'); ?>)</label>
							<?php echo Form::text('subject_sp', null, array('class' => 'form-control',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-60">
							<label for="inputMetaTitle"><?php echo getLabels('subject'); ?> (<?php echo getLabels('french'); ?>)</label>
							<?php echo Form::text('subject_fr', null, array('class' => 'form-control', 'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputContent"><?php echo getLabels('Content'); ?> (<?php echo getLabels('english'); ?>)</label>
							<?php echo Form::textarea('content_en', null, array('class' => 'form-control summernote', 'id' => 'inputContent',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputContent"><?php echo getLabels('Content'); ?> (<?php echo getLabels('spanish'); ?>)</label>
							<?php echo Form::textarea('content_sp', null, array('class' => 'form-control summernote', 'id' => 'inputContent',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputContent"><?php echo getLabels('Content'); ?> (<?php echo getLabels('french'); ?>)</label>
							<?php echo Form::textarea('content_fr', null, array('class' => 'form-control summernote', 'id' => 'inputContent',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						
						<div class="form-group  position-relative error-l-60">
							<label for="inputMetaDescription"><?php echo getLabels('shortcodes'); ?></label>
							<?php echo Form::textarea('description', null, array('class' => 'form-control', 'rows'=>4, 'id' => 'inputMetaDescription',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary"><?php echo getLabels('Submit'); ?></button>&nbsp;&nbsp;
							<a href="<?php echo url($route_prefix, 'templates'); ?>" class="btn btn-dark steamerst_link"><?php echo getLabels('back'); ?></a>
						</div>
					<?php echo Form::close(); ?>

				</div>
			</div>
        </div>
	<?php if(empty($_POST)): ?>
    </main>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('.summernote').summernote({
				height: 200,
				popover: {
				image: [],
				link: [],
				air: []
				}
			});
			
			jQuery("#inputTitle, #inputSlug").keyup(function (e) {
				var Text = jQuery(this).val();
				if(Text != ""){
					var slug = Text.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
					jQuery("#inputSlug").val(slug);
				}
			});
		});
	</script>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>