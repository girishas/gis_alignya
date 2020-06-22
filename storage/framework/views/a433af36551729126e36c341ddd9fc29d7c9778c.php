

<?php $__env->startSection('content'); ?>
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('add_new_page'); ?></h1>
					<div class="text-zero top-right-button-container">
						<a href="<?php echo url($route_prefix, 'pages'); ?>" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1"><?php echo getLabels('Pages'); ?></a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'pages'); ?>"><?php echo getLabels('Pages'); ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('add_new_page'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					<?php echo Form::open(array('url' => array($route_prefix.'/add-new-page'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search')); ?>

						<div class="form-group  position-relative error-l-50">
							<label for="inputTitle"><?php echo getLabels('Title'); ?></label>
							<?php echo Form::text('title_en', null, array('class' => 'form-control', 'id' => 'inputTitle',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<?php /* <div class="form-group  position-relative error-l-50">
							<label for="inputTitle">{!! getLabels('Title') !!} ({!! getLabels('spanish') !!})</label>
							{!! Form::text('title_sp', null, array('class' => 'form-control', 'id' => 'inputTitle_sp',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputTitle">{!! getLabels('Title') !!} ({!! getLabels('french') !!})</label>
							{!! Form::text('title_fr', null, array('class' => 'form-control', 'id' => 'inputTitle_fr',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div> */ ?>
						
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug"><?php echo getLabels('slug'); ?></label>
							<?php echo Form::text('slug', null, array('class' => 'form-control', 'id' => 'inputSlug',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputContent"><?php echo getLabels('Content'); ?></label>
							<?php echo Form::textarea('content_en', null, array('class' => 'form-control summernote', 'id' => 'inputContent',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<?php /* <div class="form-group  position-relative error-l-50">
							<label for="inputContent">{!! getLabels('Content') !!}  ({!! getLabels('spanish') !!})</label>
							{!! Form::textarea('content_sp', null, array('class' => 'form-control summernote', 'id' => 'inputContent_sp',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputContent">{!! getLabels('Content') !!}  ({!! getLabels('french') !!})</label>
							{!! Form::textarea('content_fr', null, array('class' => 'form-control summernote', 'id' => 'inputContent_fr',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div> */ ?>
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputMetaTitle"><?php echo getLabels('meta_title'); ?></label>
							<?php echo Form::text('meta_title', null, array('class' => 'form-control', 'id' => 'inputMetaTitle',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputMetaKeywords"><?php echo getLabels('meta_keywords'); ?></label>
							<?php echo Form::text('meta_keywords', null, array('class' => 'form-control', 'id' => 'inputMetaKeywords',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
							<label for="inputMetaDescription"><?php echo getLabels('meta_description'); ?></label>
							<?php echo Form::textarea('meta_description', null, array('class' => 'form-control', 'rows'=>2, 'id' => 'inputMetaDescription',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-row">
							<div class="form-group col-md-3 position-relative error-l-50">
								<label for="inputStatus"><?php echo getLabels('status'); ?></label>
								<?php echo Form::select('status', config('constants.STATUS'), null, array('class' => 'form-control', "id"=>"inputStatus")); ?>

								<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						<div class="form-group">
							<button type="submit" class="btn btn-primary"><?php echo getLabels('Submit'); ?></button>&nbsp;&nbsp;
							<a href="<?php echo url($route_prefix, 'pages'); ?>" class="btn btn-dark steamerst_link"><?php echo getLabels('back'); ?></a>
						</div>
					<?php echo Form::close(); ?>

				</div>
			</div>
        </div>
	
    </main>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('.summernote').summernote({
				height: 300,
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
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>