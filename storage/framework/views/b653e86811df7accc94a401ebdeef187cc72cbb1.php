<div class="modal modal-right" id="updateMilestoneMeasureView" role="dialog" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Milestone</h5>
                <button type="button" class="close" id="updateMilestoneMeasureViewHide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <?php echo Form::open(array('url' => array($route_prefix.'/updatemilestonemeasure'), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                    
                    <div class="container-fluid">
                    <div class="row">
                        
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label>Milestone Name</label>
                        <?php echo Form::text('milestone_name', null, array('class'=>'form-control','id'=>'milestone_name_measure_view_id')); ?>

                        <input type="hidden" name="id" id="milestone_id_measue_view">
                    </div>
                     <div class="form-group ">
                        <label>Actual</label>
                        <?php echo Form::text('mile_actual', null, array('class'=>'form-control','id'=>'mile_actual_measure_view_id')); ?>

                        
                        <div class="invalid-tooltip"></div>
                        </div>
                         <div class="form-group ">
                        <label>Target</label>
                        <?php echo Form::text('sys_target', null, array('class'=>'form-control','id'=>'sys_target_measure_view_id')); ?>

                        
                        <div class="invalid-tooltip"></div>
                        </div>
                     <div class="form-group ">
                        <label>Start Date</label>
                        <?php echo Form::text('start_date', null, array('class'=>'form-control datepicker','id'=>'start_date_measure_view_id')); ?>

                        
                        <div class="invalid-tooltip"></div>
                        </div>
                        <div class="form-group ">
                            <label>End Date</label>
                        <?php echo Form::text('end_date', null, array('class'=>'form-control datepicker','id'=>'end_date_measure_view_id')); ?>

                            <div class="invalid-tooltip"></div>
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary">Submit</button>
                                        
                            <div class="invalid-tooltip"></div>
                        </div>

                    </div>
                   
                    </div>
                    </div>
               <?php echo Form::close(); ?>

            </div>
           
        </div>
    </div>
</div>