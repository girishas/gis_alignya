<div class="modal modal-right" id="myModalAddTask" role="dialog" >
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="close" id="popupaddhideTask" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                 
                <div class="modal-body">
                	 
                    <?php echo Form::open(array('url' => array($route_prefix.'/addtask'), 'id'=>'addtaskId','class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                                        
                    	<div class="container-fluid">
                    	<div class="row">
                    		
                    	<div class="col-lg-12">
                    		<div class="form-group">
                            <label>Title</label>
                            <?php echo Form::text('task_name',null,array('class'=>'form-control','required'=>'required')); ?>

                            <?php if($errors->first('task_name')): ?><div class="error"><?php echo $errors->first('task_name'); ?></div><?php endif; ?>
                            <input type="hidden" name="objective_id" id="objectivetaskid" >
                            <input type="hidden" name="measure_id" id="measuretaskid">
                            <input type="hidden" name="type" id="typetaskid">
                            <input type="hidden" name="is_popup" class="is_popup">
                            
                        </div>
                        <div class="form-group mt-2">
                            <label>Owners <br> <span style="font-size: 12px">(Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.)</span></label>
							<?php $contributers = Contributers();
//print_r($contributers);
							?>
                            <?php echo Form::select('owners[]',$contributers,null,array('class'=>'form-control','multiple'=>'multiple','id'=>'contributer_id')); ?>

                            
                        </div>
                        <div class="form-group">
                            <label for="inputAboutYou"><?php echo getLabels('summary'); ?></label>
                        <?php echo Form::textarea('description', null, array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYouupdate", 'placeholder'=> '')); ?>

                        </div>
						<div class="form-group">
                            <label for="inputAboutYou"><?php echo getLabels('status'); ?></label>
                         <?php echo Form::select('status',$task_status,null,array('class'=>'form-control','id'=>'task_status_id')); ?>

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
    function onclickownershipmeasure(id){
        $("#ownershipmeasure").html("");
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>";
        if(id == 1){
            $("#measure_team_type").val("department");
            var selectlabel = "Select Department";
            var url = "<?php echo url('/getdepartments'); ?>"; 
        }else if(id == 2){
            $("#measure_team_type").val("team");
            var selectlabel = "Select Team";
            var url = "<?php echo url('/getteams'); ?>";
        }else{
            $("#measure_team_type").val("individual");
            var selectlabel = "Select Owners";
            var url = "<?php echo url('/getmembers'); ?>"
        }
        $.ajax({
            type:"POST",
            url: url,
            data:'_token='+token+'&company_id='+company_id,
            dataType:'JSON',
            success: function (response) {
                $("#ownershipmeasure").append('<option value = "">'+selectlabel+'</option>')
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#ownershipmeasure").append('<option value = "'+key+'">'+val+'</option>');
                  }
                }
            }  
        });
    }
    function ownershipdrop(){
        $("#obj_department_id").val("");
        $("#obj_teamid").val("");
        $("#obj_ind_owner_user_id").val(""); 
        var id = $("#ownership").val();
        var team_type = $("#measure_team_type").val();
        if(team_type == "department"){
            $("#measure_department_id").val(id);
        }else if(team_type == "team"){
            $("#measure_team_id").val(id);
        }else{
            $("#owner_user_id").val(id); 
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