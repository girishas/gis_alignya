<div class="modal modal-right" id="myModalUpdateTeam" role="dialog" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Team</h5>
                                            <button type="button" class="close" id="popupupdatehideteam" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                         <?php echo Form::model($team_detail,array('url' => array($route_prefix.'/team/'.$id), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                                        <div class="modal-body">
                                            
                                            <div class="container-fluid">
                                                <div class="row">
                                                    
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                    <label>Name</label>
                                                    <?php echo Form::text('team_name',null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

                                                </div>
                                                 <div class="form-group ">
                                                      <label>Choose Team Lead</label>
                                                <?php echo Form::select('team_head', $teamleads,null, array('class' => 'form-control select2-single', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

                                            
                                <div class="invalid-tooltip"></div>
                            </div>
                                <div class="form-group ">
                                                      <label>Choose Department</label>
                               <?php echo Form::select('department_id', $departments,null, array('class' => 'form-control select2-single', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>                  
                                <div class="invalid-tooltip"></div>
                            </div>

                            <div class="form-group ">
                                                      <label>Choose Members</label>
                               <select class="form-control select2-multiple" multiple="multiple" name="member_ids[]" data-width="100%">
                                   <option label="&nbsp;"></option>
                            <?php if(!empty($all_members)): ?>
                            <?php $__currentLoopData = $all_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_1 => $value_1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($team_members_pluck)): ?>
                                <?php if(array_search($key_1,$team_members_pluck->toArray())): ?>
                                    <option value="<?php echo $key_1; ?>" selected="selected"><?php echo $value_1; ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $key_1; ?>"><?php echo $value_1; ?></option>
                                <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                                </select>                   
                                <div class="invalid-tooltip"></div>
                            </div>
                                                

                          
                                                
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