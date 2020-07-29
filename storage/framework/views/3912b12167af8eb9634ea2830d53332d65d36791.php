<div class="modal modal-right" id="myModalUpdateKPI" role="dialog" style="overflow: scroll;">
        <div class="modal-dialog" style="max-width: 99.99%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update KPI</h5>
                    <button type="button" class="close" id="popupaddhideUpdateKPI" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php if(session('adderrormessage')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo session('adderrormessage'); ?>

                    </div>    
                    <?php endif; ?> 
                <div class="modal-body">
                	 
                    <?php echo Form::open(array('url' => array($route_prefix.'/updatekpi'), 'class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                                        
                    	<div class="container-fluid">
                    	<div class="row">
                    		
                    	<div class="col-lg-6">
                    		<div class="form-group">
                            <label>KPI Title</label>
                            <?php echo Form::text('heading',null,array('class'=>'form-control','id'=>'measure_title_update')); ?>

                            <input type="hidden" name="measure_team_type" id="measure_team_type_update">
                            <input type="hidden" name="owner_user_id" id="owner_user_id_update">
                            <input type="hidden" name="measure_department_id" id="measure_department_id_update">
                            <input type="hidden" name="measure_team_id" id="measure_team_id_update">
                            <input type="hidden" name="id" id="measure_id_update">
                            <input type="hidden" name="measure_target" class ="measure_target_updateval">
                            <input type="hidden" name="measure_actual" id ="measure_actual">
                            <input type="hidden" name="calculation_type" id ="calculation_type">
                            <input type="hidden" name="is_popup" class="is_popup">

                        </div>
                       
                        <div class="row">
                         <div class="form-group col-md-6">   
                            <label>Ownership</label>
                            <br>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-primary active" onclick ="onclickownershipupdatemeasure(1)" id="depmeaactive">
                                    <input type="radio" name="options" id="option1" value="1" checked> Department
                                </label>
                                <label class="btn btn-primary" onclick ="onclickownershipupdatemeasure(2)" id="teammeaactive">
                                    <input type="radio" name="options" value="2" id="option2"> Team
                                </label>
                                <label class="btn btn-primary" onclick ="onclickownershipupdatemeasure(3)" id="indimeaactive">
                                    <input type="radio" name="options" value="3" id="option3"> Individual
                                </label>
                            </div>
                        </div>

                       <div class="form-group col-md-6">
                         <label>Please Select</label>
                            <select class="form-control ownership" onchange="ownershipdropmeasureupdate()" name="ownership" data-width="100%" id = "ownershipmeasureupdate">
                                <?php if(!empty($departments)): ?>
                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $vale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo $key; ?>"><?php echo $vale; ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>                       
                            <div class="invalid-tooltip"></div>
                        </div>
                    </div>
                        <div class="form-group">
                            <label>Contributers (optional)</label>
                            <?php echo Form::select('contributers[]',$contributers,null,array('class'=>'form-control select2-multiple' ,'id'=>'contributersupdatemeasure','multiple'=>'multiple')); ?>

                            
                        </div>
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group">
                                      <label class="measure_target_updatehtml">Measure Target : $</label>
                                       <div class="custom-control custom-checkbox "><input type="checkbox" class="custom-control-input upgradetargetcl" id="upgradetarget" onclick="showhidenewtarget()" name="is_updated_target"> <label class="custom-control-label" for="upgradetarget">Do you want to upgrade target ?</label></div>
                                 </div>
                             </div>
                             <div class="col-md-6" style="display: none;" id="measurehideid">
                                 <div class="form-group">
                                    <label>Measure Target (Revised)</label>
                                    <?php echo Form::text('measure_target_new',null,array('class'=>'form-control','id'=>'measuretargetnew')); ?>

                                </div>
                             </div>
                         </div>
                         
                        <div class="row">
                             <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Color Code for Target</label>
                                    <?php echo Form::color('target_color','#304ffe',array('class'=>'form-control','id'=>'measure_target_color')); ?>

                                </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Color Code for Actual</label>
                                    <?php echo Form::color('actual_color','#389328',array('class'=>'form-control','id'=>'actual_color_measure')); ?>

                                </div>
                             </div>
                             <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Color Code for Projection</label>
                                    <?php echo Form::color('projection_color','#f44336',array('class'=>'form-control','id'=>'measure_projection_color')); ?>

                                </div>
                             </div>
                         </div>


                        </div>

                        <div class="col-md-6">
                           
                            <div class="form-group">
                                <label>Confidence Level</label>
                                <?php echo Form::select('confidence_level',config('constants.CONFIDANCE_LEVEL'),null,array('class'=>'form-control','id'=>'measure_confidence_level')); ?>

                                
                            </div>

                          <div class="form-group">
                            <label>Status</label>
                            <?php echo Form::select('status',$status,null,array('class'=>'form-control','id'=>'measure_status_id')); ?>

                            
                        </div>
                        </div>
                    
                       
                        </div>
                        </div>
                        <div class="col-lg-12">
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                </div>
                
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function showhidenewtarget(){
            if(document.getElementById('upgradetarget').checked){
                $("#measurehideid").show();
            }else{

                $("#measurehideid").hide();
            }
        }
    function onclickownershipupdatemeasure(id){
        $("#ownershipmeasureupdate").html("");
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>";
        if(id == 1){
            $("#measure_team_type_update").val("department");
            var selectlabel = "Select Department";
            var url = "<?php echo url('/getdepartments'); ?>"; 
        }else if(id == 2){
            $("#measure_team_type_update").val("team");
            var selectlabel = "Select Team";
            var url = "<?php echo url('/getteams'); ?>";
        }else{
            $("#measure_team_type_update").val("individual");
            var selectlabel = "Select Owners";
            var url = "<?php echo url('/getmembers'); ?>"
        }
        $.ajax({
            type:"POST",
            url: url,
            data:'_token='+token+'&company_id='+company_id,
            dataType:'JSON',
            success: function (response) {
                $("#ownershipmeasureupdate").append('<option value = "">'+selectlabel+'</option>')
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#ownershipmeasureupdate").append('<option value = "'+key+'">'+val+'</option>');
                  }
                }
            }  
        });
    }
    function ownershipdropmeasureupdate(){
        $("#measure_department_id_update").val("");
        $("#measure_team_id_update").val("");
        $("#owner_user_id_update").val(""); 
        var id = $("#ownershipmeasureupdate").val();
        var team_type = $("#measure_team_type_update").val();
        if(team_type == "department"){
            $("#measure_department_id_update").val(id);
        }else if(team_type == "team"){
            $("#measure_team_id_update").val(id);
        }else{
            $("#owner_user_id_update").val(id); 
        }
    }

    function onchangemeasuretype(){
        var measure_ty = $("#measureType").val();
        if(measure_ty == "value"){
            $(".showmeasureunit").show();
        }else if(measure_ty == "revenue"){
           $(".revenueshow").show();
            $(".revenuehide").hide();
        }else{
            $(".revenueshow").hide();
             $(".revenuehide").show();
        }
    }

   

    
    </script>