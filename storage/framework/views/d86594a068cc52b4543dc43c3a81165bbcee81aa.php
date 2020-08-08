<div class="modal modal-right" id="myModalUpdateInitiative" role="dialog" style="overflow: scroll;">
        <div class="modal-dialog" style="max-width: 50%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Initiative</h5>
                    <button type="button" class="close" id="popupaddhideinitiativeupdate" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                     
                    <?php echo Form::open(array('url' => array($route_prefix.'/updateinitiative'), 'class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                                        
                        <div class="container-fluid">
                        <div class="row">
                            
                        <div class="col-lg-12">
                            <div class="form-group">
                            <label>Title</label>
                            <?php echo Form::text('heading',null,array('class'=>'form-control','id'=>'iniheading_update')); ?>

                           
                            <input type="hidden" name="measure_team_type" id="initiative_team_type_update">
                            <input type="hidden" name="owner_user_id" id="initiative_owner_user_id_update">
                            <input type="hidden" name="measure_department_id" id="initiative_department_id_update">
                            <input type="hidden" name="measure_team_id" id="initiative_team_id_update">
                            <input type="hidden" name="id" id="initiative_update_id">
                            <input type="hidden" name="is_popup" class="is_popup">
                        </div>
                       
                        <div class="form-group">
                            <label>Objective</label>
                            <?php echo Form::select('objective_id',$objectives,null,array('class'=>'form-control','id'=>'initiative_objectiveId_update', 'onchange'=>'onchangeobjectivegetcycleinitiativeupdate()')); ?>

                            
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label>Cycle</label>
                            <select class="form-control" name="measure_cycle" id = "initiativeCycleUpdate">
                                
                            </select>
                           

                        </div>
                        <div class="form-group col-md-6">
                            <label>Check in Frequency</label>
                            <?php echo Form::select('check_in_frequency',config('constants.FREQUENCY'),null,array('class'=>'form-control','id'=>'check_in_freq_update')); ?>

                        </div>
                         </div>
                         <div class="row">
                         <div class="form-group col-md-6">   
                            <label>Ownership</label>
                            <br>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-primary active" onclick ="onclickownershipinitiativeupdate(1)" id="deptiniuactive">
                                    <input type="radio" name="options" id="option1" value="1" checked> Department
                                </label>
                                <label class="btn btn-primary" onclick ="onclickownershipinitiativeupdate(2)" id="teaminiuactive">
                                    <input type="radio" name="options" value="2" id="option2"> Team
                                </label>
                                <label class="btn btn-primary" onclick ="onclickownershipinitiativeupdate(3)" id="indiviniuactive">
                                    <input type="radio" name="options" value="3" id="option3"> Individual
                                </label>
                            </div>
                        </div>

                       <div class="form-group col-md-6">
                         <label>Please Select</label>
                            <select class="form-control ownership" onchange="ownershipdropinitiativeupdate()" name="ownership" data-width="100%" id = "ownershipinitiativeupdate">
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
                            <label>Contributers (optional) <br> <b style="font-size: 12px">(Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.)</b></label>
                            <?php echo Form::select('contributers[]',$contributers,null,array('class'=>'form-control','id'=>'contriiniupdate','multiple'=>'multiple')); ?>

                            
                        </div>
                        
                         <div class="form-group">
                            <label>Status</label>
                            <?php echo Form::select('status',$status,null,array('class'=>'form-control','id'=>'initiative_status_id')); ?>

                            
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
    function onclickownershipinitiativeupdate(id){
        $("#ownershipinitiativeupdate").html("");
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>";
        if(id == 1){
            $("#initiative_team_type_update").val("department");
            var selectlabel = "Select Department";
            var url = "<?php echo url('/getdepartments'); ?>"; 
        }else if(id == 2){
            $("#initiative_team_type_update").val("team");
            var selectlabel = "Select Team";
            var url = "<?php echo url('/getteams'); ?>";
        }else{
            $("#initiative_team_type_update").val("individual");
            var selectlabel = "Select Owners";
            var url = "<?php echo url('/getmembers'); ?>"
        }
        $.ajax({
            type:"POST",
            url: url,
            data:'_token='+token+'&company_id='+company_id,
            dataType:'JSON',
            success: function (response) {
                $("#ownershipinitiativeupdate").append('<option value = "">'+selectlabel+'</option>')
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#ownershipinitiativeupdate").append('<option value = "'+key+'">'+val+'</option>');
                  }
                }
            }  
        });
    }
    function ownershipdropinitiativeupdate(){
        $("#initiative_department_id_update").val("");
        $("#initiative_team_id_update").val("");
        $("#initiative_owner_user_id_update").val(""); 
        var id = $("#ownershipinitiativeupdate").val();
        var team_type = $("#initiative_team_type_update").val();
        if(team_type == "department"){
            $("#initiative_department_id_update").val(id);
        }else if(team_type == "team"){
            $("#initiative_team_id_update").val(id);
        }else{
            $("#initiative_owner_user_id_update").val(id); 
        }
    }

   

    function onchangeobjectivegetcycleinitiativeupdate(selectedcycle=null){
        var objective_id =  $("#initiative_objectiveId_update").val();
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>";
        $.ajax({
            type:"POST",
            url: "<?php echo url('getMeasureCycles'); ?>",
            data:'_token='+token+'&company_id='+company_id+'&objective_id='+objective_id,
            dataType:'JSON',
            success: function (response) {
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    if(selectedcycle == val.toString()){
                        $("#initiativeCycleUpdate").append('<option value = "'+val+'" selected = "selected">'+val+'</option>');
                    }else{
                        $("#initiativeCycleUpdate").append('<option value = "'+val+'">'+val+'</option>');
                    }
                  }
                }
            }  
        });
    }

   
    </script>