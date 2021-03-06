<?php echo HTML::style('public/slimcropper/css/slim.css'); ?>

    <?php echo HTML::style('public/slimcropper/css/style.css'); ?>

    <?php echo HTML::script('public/slimcropper/js/slim.kickstart.min.js'); ?>

<div class="modal" id="updatemember" role="dialog" >
    <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Member</h5>
                <button type="button" class="close" id="updatememberhide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">  
                    	
                 <?php echo Form::model($data, array('url' => array($route_prefix.'/members/update/'.$data->id), 'class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                       
                        <div class="form-row">
                            
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputFirstname"><?php echo getLabels('First Name'); ?></label>
                                <?php echo Form::text('first_name', null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputLastname"><?php echo getLabels('last_name'); ?></label>
                                <?php echo Form::text('last_name', null, array('class' => 'form-control', 'id' => 'inputLastname',  'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-40 col-md-6"><?php
                                $is_disabled  = !empty($data->email)?'readonly':""; ?>
                                <label for="inputEmail4"><?php echo getLabels('email'); ?></label>
                                <?php echo Form::text('email', null, array('class' => 'form-control', "id"=>"inputEmail4", 'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputMobile"><?php echo getLabels('contact_number'); ?></label>
                                <?php echo Form::text('mobile', null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputMobile"><?php echo getLabels('Designation'); ?></label>
                                <?php echo Form::text('designation', null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                            <?php if(Auth::User()->role_id == 2): ?>
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputMobile"><?php echo getLabels('user_type'); ?></label>
                                <?php echo Form::select('role_id', config('constants.USER_TYPES'),null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-row">
                         
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputMobile"><?php echo getLabels('status'); ?></label>
                                <?php echo Form::select('status', config('constants.STATUS'),null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                           
                        </div>
                         <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for=""><?php echo getLabels('profile_picture'); ?></label>
                                <div class="slim" data-ratio="1:1" data-instant-edit="true" data-will-remove="profileimageWillBeRemoved">
                                    <?php if( $data->photo and file_exists('public/upload/users/profile-photo/'. $data->photo) ): ?>
                                        <?php echo HTML::image('public/upload/users/profile-photo/'. $data->photo, $data->first_name); ?>

                                    <?php endif; ?>
                                    <input type="file" name="photo"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                        <button type="submit" class="btn btn-primary"><?php echo getLabels('update'); ?></button>&nbsp;&nbsp;
                        <a href="<?php echo url($route_prefix, 'users'); ?>" class="btn btn-dark steamerst_link"><?php echo getLabels('back'); ?></a>
                        </div>
                    <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('Element/js/includejs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
    $("#updatememberhide").click(function(){
        $("#updatemember").modal("hide");
    });
</script>