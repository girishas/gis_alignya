<div class="modal" id="updatetheme" role="dialog" >
    <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Goal Cycle</h5>
                <button type="button" class="close" id="updatethemehide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                        	
                   <?php echo Form::open(array('url' => array($route_prefix.'/goalcycles/new'), 'class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                        <input type="hidden" name="id" class="theme_id">
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-12">
                                <label for="inputScorecardName"><?php echo getLabels('Cycle Name'); ?></label>
                                <?php echo Form::text('cycle_name', null, array('class' => 'form-control', 'id' => 'inputThemeName',  'placeholder'=> '')); ?>

                                 <div class="invalid-tooltip"></div>
                            </div>   
                        </div>
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-12">
                                <label for="inputScorecardName"><?php echo getLabels('No_of_months'); ?></label>
                                <?php echo Form::text('no_months', null, array('class' => 'form-control', 'id' => 'inputMonths',  'placeholder'=> '')); ?>

                                 <div class="invalid-tooltip"></div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <?php echo Form::select('status',config('constants.MASTER_STATUS'),null,array('class'=>'form-control','id'=>'theme_status')); ?>

                            
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