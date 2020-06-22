

<?php $__env->startSection('content'); ?>
	<?php echo HTML::style('public/slimcropper/css/slim.css'); ?>

	<?php echo HTML::style('public/slimcropper/css/style.css'); ?>

	<?php echo HTML::script('public/slimcropper/js/slim.kickstart.min.js'); ?>

  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('update_page_images'); ?></h1>
					<div class="text-zero top-right-button-container">
						<a href="<?php echo url($route_prefix, 'page_images'); ?>" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1"><?php echo getLabels('Page_Images'); ?></a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'page_images'); ?>"><?php echo getLabels('Page_Images'); ?></a>
                            </li>
							  <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('update_page_images'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					<?php echo Form::model($data, array('url' => array($route_prefix.'/page_images/edit/'.$data->id), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

						
						
					
						 <div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-4">
								<label><?php echo getLabels('slug'); ?></label>
								<?php echo Form::text('slug', null, array('class' => 'form-control', 'id' => 'slug',  'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-4">
								<label><?php echo getLabels('Title'); ?></label>
								<?php echo Form::text('page_title', null, array('class' => 'form-control', 'id' => 'page_title',  'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-4">
								<label><?php echo getLabels('type'); ?> </label>
								<?php echo Form::select('type', ['' => getLabels('please_select'), '1' => getLabels('image'), '2' => getLabels('video')], null, array('class' => 'form-control', 'id' => 'type')); ?>

								<div class="invalid-tooltip"></div>
							</div>

						</div> 

						<div class="form-row">
							<div class="form-group col-md-3 row_image" id="row_dim1">
								<label for=""><?php echo getLabels('image'); ?></label>
								<div class="slim" data-instant-edit="true" data-will-remove="profileimageWillBeRemoved">
									<?php if( $data->image and file_exists('public/upload/page_images/'. $data->image) ): ?>
										<?php echo HTML::image('public/upload/page_images/'. $data->image, $data->first_name); ?>

									<?php endif; ?>

									<input type="file" name="image"/>
								</div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-12 row_video" id="row_dim">
								<label><?php echo getLabels('video'); ?></label>
								<?php echo Form::text('video', null, array('class' => 'form-control', "id"=>"video", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-12 row_video" id="row_dim2">
								<label><?php echo getLabels('width'); ?></label>
								<?php echo Form::number('width', null, array('class' => 'form-control', "id"=>"width", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-12 row_video" id="row_dim3">
								<label><?php echo getLabels('height'); ?></label>
								<?php echo Form::number('height', null, array('class' => 'form-control', "id"=>"height", 'placeholder'=> '')); ?>

								<div class="invalid-tooltip"></div>
							</div>
						</div>

						<div class="form-row">
							<div class="form-group position-relative error-l-40 col-md-12">
								<label><?php echo getLabels('status'); ?> </label>
							<?php echo Form::select('status', array('' => getLabels('please_select'),'1' => getLabels('active'), '2' => getLabels('inactive')),null, array('class' =>'form-control')); ?>

							<div class="invalid-tooltip"></div>
							</div>
						</div>
						
						<div class="form-group  position-relative error-l-100">
						<button type="submit" class="btn btn-primary"><?php echo getLabels('Submit'); ?></button>&nbsp;&nbsp;
						<a href="<?php echo url($route_prefix, 'page_images'); ?>" class="btn btn-dark steamerst_link"><?php echo getLabels('back'); ?></a>
						</div>
					<?php echo Form::close(); ?>

				</div>
			</div>
        </div>
    </main>
	
    <script type="text/javascript">
		var selected_value = '<?php echo !empty($data->type)?$data->type:""; ?>';
    	$(function() {
			showSelectedTypeMedia(selected_value);
			$('body').on('change', '#type', function(e){
				selected_value = $(this).val();
				showSelectedTypeMedia(selected_value);
			});
		});
		
		function showSelectedTypeMedia(selected_value){
			$('.row_image').hide(); 
			$('.row_video').hide(); 
			if(selected_value == '2') {
				$('.row_video').show(); 
			} else if(selected_value == '1') {
				$('.row_image').show(); 
			} 
		}

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>