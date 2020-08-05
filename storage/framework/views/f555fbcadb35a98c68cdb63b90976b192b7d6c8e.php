<div class="modal" id="addideacategory" role="dialog" >
    <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Idea Category</h5>
                <button type="button" class="close" id="addideacategoryhide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                        	
                   <?php echo Form::open(array('url' => array($route_prefix.'/idea-categories/new'), 'class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                        
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-12">
                                <label for="inputFirstname"><?php echo getLabels('Idea Category Name'); ?></label>
                                <?php echo Form::text('name', null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

                                 <div class="invalid-tooltip"></div>
                            </div>   
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