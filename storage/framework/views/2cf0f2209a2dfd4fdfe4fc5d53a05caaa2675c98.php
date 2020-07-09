<div class="modal modal-right" id="filterPop" role="dialog" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter</h5>
                <button type="button" class="close" id="hideFilter" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo Form::open(array('url' => array($route_prefix.'/objectives'), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                                       
                    <div class="container-fluid">
                    <div class="row">
                        
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label>Name</label>
                        <?php echo Form::text('heading', isset($_POST['heading'])?trim($_POST['heading']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_name'))); ?>

                    </div>
                   

                    <div class="form-group">
                        <label>Cycle</label>
                        <?php echo Form::select('cycle_id', $goal_cycles, isset($_POST['cycle_id'])?$_POST['cycle_id']:null, array('class' => 'form-control')); ?>

                    </div>
                     <div class="form-group">
                        <label>Status</label>
                        <?php echo Form::select('status', $status, isset($_POST['status'])?$_POST['status']:null, array('class' => 'form-control')); ?>

                    </div>
                     <div class="form-group">
                   <button type="submit" class="btn btn-primary">Search</button>
                <a class="btn btn-dark mb-1 steamerst_link" href="<?php echo url('objectives'); ?>">Show All</a>
</div>
                      
                    </div>
                    
                    </div>
                    </div>
               <?php echo Form::close(); ?>

            </div>
            <div class="modal-footer">
                           </div>
        </div>
    </div>
</div>