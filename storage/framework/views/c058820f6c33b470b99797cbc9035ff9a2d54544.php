<?php echo HTML::style('public/slimcropper/css/slim.css'); ?>

    <?php echo HTML::style('public/slimcropper/css/style.css'); ?>

    <?php echo HTML::script('public/slimcropper/js/slim.kickstart.min.js'); ?>

<div class="modal" id="addmember" role="dialog" >
    <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Member</h5>
                <button type="button" class="close" id="addmemberhide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                        	
                   <?php echo Form::open(array('url' => array($route_prefix.'/members/new'), 'class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                        
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputFirstname"><?php echo getLabels('First Name'); ?></label>
                                <?php echo Form::text('first_name', null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

                                 <div class="invalid-tooltip"></div>
                            </div>
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputLastname"><?php echo getLabels('last_name'); ?></label>
                                <?php echo Form::text('last_name', null, array('class' => 'form-control', 'id' => 'inputLastname',  'placeholder'=> '')); ?>

                                
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-40 col-md-6">
                                <label for="inputEmail4"><?php echo getLabels('email'); ?></label>
                                <?php echo Form::text('email', null, array('class' => 'form-control', "id"=>"inputEmail4", 'placeholder'=> '')); ?>

                                 <div class="invalid-tooltip"></div>
                            </div>
                            <div class="form-group  position-relative error-l-40 col-md-6 position-relative error-l-100">
                                <label for="inputPassword4"><?php echo getLabels('password'); ?></label>
                                <?php echo Form::password('password', array('class' => 'form-control', "id"=>"inputPassword4", 'placeholder'=> '')); ?>

                                 <div class="invalid-tooltip"></div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputMobile"><?php echo getLabels('contact_number'); ?></label>
                                <?php echo Form::text('mobile', null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> '')); ?>

                                 <div class="invalid-tooltip"></div>
                            </div>
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputMobile"><?php echo getLabels('Designation'); ?></label>
                                <?php echo Form::text('designation', null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> '')); ?>

                                
                            </div>
                            
                            
                        </div>
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputMobile"><?php echo getLabels('user_type'); ?></label>
                                <?php echo Form::select('role_id', $roles,null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                                
                            </div>
                            <div class="form-group col-md-3">
                                <label for=""><?php echo getLabels('profile_picture'); ?></label>
                                <div class="slim" data-ratio="1:1" data-instant-edit="true">
                                    <input type="file" name="photo"/>
                                </div>
                            </div>                          
                        </div>
                        
                        <div class="form-group  position-relative error-l-100">
                        <button type="submit" class="btn btn-primary"><?php echo getLabels('Submit'); ?></button>&nbsp;&nbsp;
                        <a href="<?php echo url($route_prefix, 'users'); ?>" class="btn btn-dark steamerst_link"><?php echo getLabels('back'); ?></a>
                        </div>
                    <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>