

<?php $__env->startSection('content'); ?>
	<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('update_faqs'); ?></h1>
					<div class="text-zero top-right-button-container">
						<a href="<?php echo url($route_prefix, 'faqs'); ?>" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1"><?php echo getLabels('Faqs'); ?></a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'faqs'); ?>"><?php echo getLabels('Faqs'); ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('update_faqs'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					<?php echo Form::model($data, array('url' => array($route_prefix.'/faqs/edit/'.$data->id), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>


						<div class="form-group  position-relative error-l-50">
							<label for="inputTitle"><?php echo getLabels('slug'); ?></label>
							<?php echo Form::text('slug', null, array('class' => 'form-control', 'id' => 'slug',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug"><?php echo getLabels('question'); ?></label>
							<?php echo Form::text('question_en', null, array('class' => 'form-control', 'id' => 'question_en',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<?php /* <div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! getLabels('question') !!} {!! getLabels('spanish') !!}</label>
							{!! Form::text('question_sp', null, array('class' => 'form-control', 'id' => 'question_sp',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! getLabels('question') !!} {!! getLabels('french') !!}</label>
							{!! Form::text('question_fr', null, array('class' => 'form-control', 'id' => 'question_fr',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div> */ ?>

						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug"><?php echo getLabels('answer'); ?></label>
							<?php echo Form::text('answer_en', null, array('class' => 'form-control', 'id' => 'answer_en',  'placeholder'=> '')); ?>

							<div class="invalid-tooltip"></div>
						</div>
						
						<?php /* <div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! getLabels('answer') !!} {!! getLabels('spanish') !!}</label>
							{!! Form::text('answer_sp', null, array('class' => 'form-control', 'id' => 'answer_sp',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div>
						
						<div class="form-group  position-relative error-l-50">
							<label for="inputSlug">{!! getLabels('answer') !!} {!! getLabels('french') !!}</label>
							{!! Form::text('answer_fr', null, array('class' => 'form-control', 'id' => 'answer_fr',  'placeholder'=> ''))!!}
							<div class="invalid-tooltip"></div>
						</div> */ ?>
							
						<div class="form-group  position-relative error-l-100">
						<button type="submit" class="btn btn-primary"><?php echo getLabels('Submit'); ?></button>&nbsp;&nbsp;
						<a href="<?php echo url($route_prefix, 'faqs'); ?>" class="btn btn-dark steamerst_link"><?php echo getLabels('back'); ?></a>
						</div>
					<?php echo Form::close(); ?>

				</div>
			</div>
        </div>
    </main>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#slug").keyup(function (e) {
				var Text = jQuery(this).val();
				if(Text != ""){
					var slug = Text.toLowerCase().replace(/ /g,'_').replace(/[^\w-]+/g,'');
					jQuery("#slug").val(slug);
				}
			});
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>