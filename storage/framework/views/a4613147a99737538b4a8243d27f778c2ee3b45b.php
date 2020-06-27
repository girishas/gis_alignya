 <div class="modal modal-right" id="myModalAddDepartment" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Department</h5>
                <button type="button" class="close" id="popupaddhidedepartment" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php if(session('errormessageadd')): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo session('errormessageadd'); ?>

            </div>    
            <?php endif; ?>
             <?php echo Form::open(array('url' => array($route_prefix.'/department'), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                
            <div class="modal-body">
                   
                    <div class="container-fluid">
                    <div class="row">
                        
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label>Name</label>
                        <?php echo Form::text('department_name',null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

                         <?php if($errors->first('department_name')): ?><div class="error"><?php echo $errors->first('department_name'); ?></div><?php endif; ?>
                    </div>
                    <?php if(isset($departments)): ?>
                    <div class="form-group ">
                          <label>Choose Parent Department</label>
                          <?php echo Form::select('parent_department_id', $departments,null, array('class' => 'form-control select2-single', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

                       
                        <div class="invalid-tooltip"></div>
                    </div>
                    <?php endif; ?>
                    <?php if(isset($department_head)): ?>
                    <div class="form-group ">
                        <label>Choose Department Head</label>
                        <?php echo Form::select('department_head', $department_head,null, array('class' => 'form-control select2-single', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>                    
                        <div class="invalid-tooltip"></div>
                    </div>
                    
                    <div class="form-group ">
                        <label>Choose Members</label>
                        <?php echo Form::select('member_ids[]', $all_members,null, array('class' => 'form-control select2-multiple', 'id' => 'inputFirstname',  "multiple" => 'multiple')); ?>                     
                        <div class="invalid-tooltip"></div>
                    </div>
                    <?php endif; ?>


                    
                    </div>
                   
                    </div>
                    </div>
                
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Submit</button>
                
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>