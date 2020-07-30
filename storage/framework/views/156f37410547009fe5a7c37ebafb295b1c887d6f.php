<div class="modal" id="addtheme" role="dialog" >
    <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Goal Cycle</h5>
                <button type="button" class="close" id="addthemehide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                        	
                   <?php echo Form::open(array('url' => array($route_prefix.'/goalcycles/new'), 'class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                        
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-12">
                                <label for="inputFirstname"><?php echo getLabels('Cycle Name'); ?></label>
                                <?php echo Form::text('cycle_name', null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

                                 <div class="invalid-tooltip"></div>
                            </div>   
                        </div>
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-12">
                                <label for="inputMonths"><?php echo getLabels('No_of_months'); ?></label>
                                <?php echo Form::text('no_months', null, array('class' => 'form-control', 'id' => 'inputMonths1',  'placeholder'=> '')); ?>

                                 <div class="invalid-tooltip"></div>
                            </div>   
                        </div>
                        
                        <div class="form-group  position-relative error-l-100">
                        <button type="submit" class="btn btn-primary"><?php echo getLabels('Submit'); ?></button>&nbsp;&nbsp;
                        <a href="<?php echo url($route_prefix, 'goalcycles'); ?>" class="btn btn-dark steamerst_link"><?php echo getLabels('back'); ?></a>
                        </div>
                    <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>