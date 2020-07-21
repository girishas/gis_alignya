<div class="modal modal-right" id="myModal2" role="dialog" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Milestone</h5>
                <button type="button" class="close" id="popup3hide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <?php echo Form::open(array('url' => array($route_prefix.'/addmilestoneinitiative'), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                    
                    <div class="container-fluid">
                    <div class="row">
                        
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label>Milestone Name</label>
                        <?php echo Form::text('milestone_name', null, array('class'=>'form-control')); ?>

                        <input type="hidden" name="initiative_id" id="ini_idformilestone">
                        <input type="hidden" name="is_popup" class ="is_popup">
                        <input type="hidden" name="id">
                    </div>
                     <div class="form-group ">
                        <label>Start Date</label>
                        <?php echo Form::text('start_date', null, array('class'=>'form-control datepicker')); ?>

                        
                        <div class="invalid-tooltip"></div>
                        </div>
                        <div class="form-group ">
                            <label>End Date</label>
                        <?php echo Form::text('end_date', null, array('class'=>'form-control datepicker')); ?>

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