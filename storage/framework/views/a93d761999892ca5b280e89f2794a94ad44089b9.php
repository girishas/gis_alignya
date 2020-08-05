<div class="modal" id="updateideacategory" role="dialog" >
    <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Category</h5>
                <button type="button" class="close" id="updatecategoryhide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                        	
                   <?php echo Form::open(array('url' => array($route_prefix.'/idea-categories/new'), 'class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                        <input type="hidden" name="id" class="idea_category_id">
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-12">
                                <label for="inputScorecardName"><?php echo getLabels('Idea Category Name'); ?></label>
                                <?php echo Form::text('name', null, array('class' => 'form-control', 'id' => 'inputIcategoryName',  'placeholder'=> '')); ?>

                                 <div class="invalid-tooltip"></div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <?php echo Form::select('status',config('constants.MASTER_STATUS'),null,array('class'=>'form-control','id'=>'icategory_status')); ?>

                            
                        </div>
                        <div class="form-group  position-relative error-l-100">
                        <button type="submit" class="btn btn-primary"><?php echo getLabels('Submit'); ?></button>&nbsp;&nbsp;
                        <a href="<?php echo url($route_prefix, 'idea-categories'); ?>" class="btn btn-dark steamerst_link"><?php echo getLabels('back'); ?></a>
                        </div>
                    <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>