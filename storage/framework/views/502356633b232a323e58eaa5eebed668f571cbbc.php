<div class="modal" id="importmember" role="dialog" >
    <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Member</h5>
                <button type="button" class="close" id="importmemberhide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">   	
                   <?php echo Form::open(array('url' => array($route_prefix.'/import-members'), 'class' =>' needs-validation tooltip-label-right', 'name'=>'', 'files'=>true)); ?>

                    <div class="form-row">
                           <div class="form-group position-relative error-l-100 col-md-6">
                                <label for=""><?php echo getLabels('members_csv'); ?></label><br>
                                <input type="file" name="csv" > <br/>
                                <?php if($errors->first('csv')): ?><div class="errors" style="color: red"><?php echo $errors->first('csv'); ?></div><?php endif; ?>
                            </div>  
                            <div class="form-group col-md-6">
                               
                                <a href = "<?php echo url('public/upload/import.csv'); ?>"><button type="button" class="btn float-right btn-primary"><?php echo getLabels('download_sample_csv'); ?></button></a>
                            </div>                          
                        </div>
                        <div class="form-group  position-relative error-l-100">
                        <button type="submit" class="btn btn-primary"><?php echo getLabels('Submit'); ?></button>&nbsp;&nbsp;
                        <a href="<?php echo url($route_prefix, 'members'); ?>" class="btn btn-dark steamerst_link"><?php echo getLabels('back'); ?></a>
                        </div>
                    <?php echo Form::close(); ?>

                    <?php if(!empty(session('rejected_arr'))): ?>
                    
                    <label><h3><?php echo getLabels('Rejected Records'); ?></h3></label>
            
                    <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                           <th> <?php echo getLabels('name'); ?> </th>
                                            <th> <?php echo getLabels('email'); ?> </th>
                                            <th> <?php echo getLabels('user_type'); ?> </th>
                                            <th class="text-center"> <?php echo getLabels('designation'); ?> </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!$data->isEmpty()): ?>
                                            <?php $__currentLoopData = session('rejected_arr'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $val['0']." ".$val['1']; ?></td>
                                                    <td>
                                                        <a href="mailto:<?php echo $val['3']; ?>"> <?php echo $val['3']; ?> </a>
                                                    </td>
                                                    <td><?php echo config('constants.USER_TYPES.'.$val['4']); ?></td>
                                                    <td class="text-center">
                                                        <?php echo $val['5']; ?>

                                                    </td>
                                                    
                                                    
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                        <tr class="odd gradeX">
                                            <td colspan="6" class="no_record"><?php echo getLabels('records_not_found'); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</div>