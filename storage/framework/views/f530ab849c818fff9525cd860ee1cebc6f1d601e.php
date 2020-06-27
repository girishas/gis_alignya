<div class="modal" id="updateprofileopen" role="dialog" >
    <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Profile</h5>
                <button type="button" class="close" id="updateprofilehide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">            	
                    <?php echo Form::open(array('url' => array($route_prefix.'/profile'), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                        
                        <div class="form-row">
                                
                            <div class="form-group  position-relative error-l-100 col-md-4">
                                <label for="inputFirstname"><?php echo getLabels('company_name'); ?></label>
                                <?php echo Form::text('company_name', $company_details->company_name, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                            <div class="form-group  position-relative error-l-40 col-md-4">
                                <label for="inputEmail4"><?php echo getLabels('email'); ?></label>
                                <?php echo Form::text('email', $company_details->email, array( 'class' => 'form-control', "id"=>"inputEmail4", 'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                             <div class="form-group  position-relative error-l-100 col-md-4">
                                <label for="inputMobile"><?php echo getLabels('contact_number'); ?></label>
                                <?php echo Form::text('mobile', $company_details->mobile, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                            
                            
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-4">
                                <label for="inputFirstname"><?php echo getLabels('company_licence'); ?></label>
                                <?php echo Form::text('comp_licence', $company_details->comp_licence, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                            <div class="form-group  position-relative error-l-100 col-md-4">
                                <label for="inputFirstname"><?php echo getLabels('company_currency'); ?></label>
                                <?php echo Form::text('company_currency', $company_details->company_currency, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                            <div class="form-group  position-relative error-l-100 col-md-4">
                                <label for="inputFirstname"><?php echo getLabels('fiscal_start_month'); ?></label>
                                <?php echo Form::select('fiscal_start_month', config('constants.COMPANY_FISCAL_MONTH'),$company_details->fiscal_start_month, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                           
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputFirstname"><?php echo getLabels('industry'); ?></label>
                                <?php echo Form::select('industry_id', $industries, $company_details->industry_id, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputAboutYou"><?php echo getLabels('slogan'); ?></label>
                                <?php echo Form::text('slogan', $company_details->slogan, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> '')); ?>

                                
                                <div class="invalid-tooltip"></div>
                            </div>
                            
                        </div>
                        <div class="form-row">
                            
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputAboutYou"><?php echo getLabels('vision'); ?></label>
                                <?php echo Form::textarea('com_vision', $company_details->com_vision, array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputAboutYou"><?php echo getLabels('value'); ?></label>
                                <?php echo Form::textarea('com_values', $company_details->com_values, array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group  position-relative error-l-100 col-md-6">
                            <label for="inputAboutYou"><?php echo getLabels('address'); ?></label>
                            <?php echo Form::textarea('address', $company_details->address, array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> '')); ?>

                            <div class="invalid-tooltip"></div>
                        </div>
                        <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputAboutYou"><?php echo getLabels('mission'); ?></label>
                                <?php echo Form::textarea('com_mission', $company_details->com_mission, array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYou", 'placeholder'=> '')); ?>

                                <div class="invalid-tooltip"></div>
                            </div>
                        </div>
                        
                        <div class="form-group ">
                        <button type="submit" class="btn btn-primary"><?php echo getLabels('update'); ?></button>&nbsp;&nbsp;
                        </div>
                    <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>