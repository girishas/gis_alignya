<div class="modal modal-right" id="updateobjectivemodal" role="dialog" >
    <div class="modal-dialog" style="max-width: 99.99%">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title">Update Objective</h5>
                <button type="button" class="close" id="popupaddhideObjectiveupdate" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo Form::open(array('url' => array($route_prefix.'/updateobjectivesubmit'), 'class' =>'alignya_form updateobjectiveform needs-validation tooltip-label-right', 'name'=>'', 'files'=>true)); ?>

            <div class="modal-body">
                
            		<div class="container-fluid">
                	<div class="row">
                		
                	<div class="col-lg-6">
                		<div class="form-group">
                        <label>Objective Title</label>
                        <?php echo Form::text('heading',null,array('class'=>'form-control','id'=>'objective_heading_value')); ?>

                       
                        <input type="hidden" name="team_type" value="department" id = "obj_teamtype_update">
                        <input type="hidden" name="team_id" value="" id = "obj_teamid_update">
                        <input type="hidden" name="department_id" value="" id = "obj_department_id_update">
                        <input type="hidden" name="owner_user_id" value="" id="obj_ind_owner_user_id_update">
                        <input type="hidden" name="id" value="" id="editId" class="editidobjective">
                        <input type="hidden" name="is_popup"  class="is_popup">
                    </div>
                   

                    <div class="form-group">
                        <label>Time Period</label>
                        <select class="form-control" name="cycle_id" data-width="100%" id="timeperiodsupdate">
                        <?php $__currentLoopData = $goal_cycles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $balue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo $key; ?>"><?php echo $balue; ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        
                        
                    </div>
                    <div class="form-group">
                        <label>Perspective</label>
                        <?php echo Form::select('perspective_id',$perspectives,null,array('class'=>'form-control', 'id'=>'perspectiveId')); ?>

                        
                    </div>
                    <div class="form-group">	
                        <label>Ownership</label>
                   		<br>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-primary active" onclick ="onclickownership(1)" id = "depactive">
                                <input type="radio" name="options" id="option1" value="1" checked> Department
                            </label>
                            <label class="btn btn-primary " onclick ="onclickownership(2)" id = "teamactive">
                                <input type="radio" name="options" value="2" id="option2" > Team
                            </label>
                            <label class="btn btn-primary" onclick ="onclickownership(3)" id = "indiactive">
                                <input type="radio" name="options" value="3" id="option3"> Individual
                            </label>
                        </div>
                    </div>

                   <div class="form-group">
						<select class="form-control" onchange="ownershipdropupdate()" name="ownership" data-width="100%" id = "ownership_update">
                            <?php if(!empty($departments)): ?>
                        	<?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $vale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo $key; ?>"><?php echo $vale; ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>						
						<div class="invalid-tooltip"></div>
					</div>

						<div class="form-group ">
                        <label>Choose scorecards</label>
                       <select class="form-control select2-multiple" multiple="multiple" name="scorecard_id[]" data-width="100%" id="scorecardsliupdate">
                           
                       </select>                    
                        <div class="invalid-tooltip"></div>
                    </div>
    
                    <button type="submit" class="btn btn-primary">Submit</button>
                
                    </div>
                    <div class="col-lg-6">
                       <div class="form-group ">
                            <label>Select Theme</label>
                           <select class="form-control" name="theme_id" data-width="100%" id="themelistupdate">
                               
                           </select>                    
                            <div class="invalid-tooltip"></div>
                        </div>
                   
                    
                    <div class="form-group ">
                        <label>Contributers</label>
                       <select class="form-control select2-multiple" multiple="multiple" name="contributers[]" data-width="100%" id="contributersupdate">
                           
                       </select>                    
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="row">
                     <div class="form-group col-lg-6">
                        <label>Goal Visibility</label>
                        <?php echo Form::select('goal_visibility',config('constants.GOAL_VISIBILITY'),null,array('class'=>'form-control','id'=>'goal_visibilityid')); ?>

                        
                    </div>  <div class="form-group col-lg-6">
                        <label>Confidence Level</label>
                        <?php echo Form::select('confidence_level',config('constants.CONFIDANCE_LEVEL'),null,array('class'=>'form-control','id'=>'confidance_level_id')); ?>

                        
                    </div>
                    </div>
                     <div class="form-group">
                        <label>Status</label>
                        <?php echo Form::select('status',$status,null,array('class'=>'form-control','id'=>'status_id')); ?>

                        
                    </div>
                     <div class="form-group  position-relative error-l-100">
                        <label for="inputAboutYou"><?php echo getLabels('summary'); ?></label>
                        <?php echo Form::textarea('summary', null, array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYouupdate", 'placeholder'=> '')); ?>

                        <div class="invalid-tooltip"></div>
                    </div>
                   </div>
                   
                    
                    </div>
                    </div>
                
            </div>
            
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>

<?php echo $__env->make('Element/objective/scorecards', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/objective/add_scorecard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/objective/themes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/objective/add_theme', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/objective/add_cycle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
    function scorecardpopup(){
        $("#scorecardsli").html("");
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>";
        $.ajax({
            type:"POST",
            url: "<?php echo url('/getscorecards'); ?>",
            data:'_token='+token+'&company_id='+company_id,
            dataType:'JSON',
            success: function (response) {
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#scorecardsli").append('<option value = "'+key+'">'+val+'</option>');
                  }
                }
                $("#scorecardslist").modal("show");
            }  
        });       
    }
    function addmorescorecard(){
        $("#addscorecard").modal("show");
    }

    function addcyclepopup(){
        $("#addcycle").modal("show");
    }

    function hideaddcycle(){
        $("#addcycle").modal("hide");
    }
    
    function hideaddscorecard(){
        $("#addscorecard").modal("hide");
    }

    function submitaddscorecard(){
        var token = "<?php echo csrf_token(); ?>";
        var scorecardname = $("#scorecardname").val();
        var scorecardstatus = $("#scorecardstatus").val();
        var company_id = "<?php echo Auth::User()->company_id; ?>";
        $.ajax({
            type:"POST",
            url: "<?php echo url('/submitscorecard'); ?>",
            data:'_token='+token+'&company_id='+company_id+'&scorecardname='+scorecardname+'&scorecardstatus='+scorecardstatus,
            dataType:'JSON',
            success: function (response) {
                hideaddscorecard();
                scorecardpopup();
            }  
        });
    }

    function submitaddcycle(){
        var token = "<?php echo csrf_token(); ?>";
        var cyclename = $("#cyclename").val();
        var numberofmonth = $("#numberofmonth").val();
        var company_id = "<?php echo Auth::User()->company_id; ?>";
        $.ajax({
            type:"POST",
            url: "<?php echo url('/submitaddcycle'); ?>",
            data:'_token='+token+'&company_id='+company_id+'&cyclename='+cyclename+'&numberofmonth='+numberofmonth,
            dataType:'JSON',
            success: function (response) {
                hideaddcycle();
                getCycles();
            }  
        });
    }

    function getCycles(){
        $("#timeperiods").html("");
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>";
        $.ajax({
            type:"POST",
            url: "<?php echo url('/getCycles'); ?>",
            data:'_token='+token+'&company_id='+company_id,
            dataType:'JSON',
            success: function (response) {
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#timeperiods").append('<option value = "'+key+'">'+val+'</option>');
                  }
                }
            }  
        });
    }

    function submitscid(){
        var sc_id = $("#scorecardsli").val();
        $("#objective_scorecard").val(sc_id.join(','));
        hideScorecardlist();   
    }

    function themepopup(){
        $("#themelist").html("");
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>";
        $.ajax({
            type:"POST",
            url: "<?php echo url('/getthemes'); ?>",
            data:'_token='+token+'&company_id='+company_id,
            dataType:'JSON',
            success: function (response) {
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#themelist").append('<option value = "'+key+'">'+val+'</option>');
                  }
                }
                $("#themelistpop").modal("show");
            }  
        });
    }

    function addmoretheme(){
        $("#addtheme").modal("show");
    }

    function submitaddtheme(){
        var token = "<?php echo csrf_token(); ?>";
        var themename = $("#themename").val();
        var themesummary = $("#themesummary").val();
        var company_id = "<?php echo Auth::User()->company_id; ?>";
        $.ajax({
            type:"POST",
            url: "<?php echo url('/submitaddtheme'); ?>",
            data:'_token='+token+'&company_id='+company_id+'&themename='+themename+'&themesummary='+themesummary,
            dataType:'JSON',
            success: function (response) {
                hideaddtheme();
                themepopup();
            }  
        });
    }

    function hideaddtheme(){
        $("#addtheme").modal('hide');
    }

    function onclickownership(id){
        $("#ownership_update").html("");
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>";
        if(id == 1){
            $("#obj_teamtype_update").val("department");
            var selectlabel = "Select Department";
            var url = "<?php echo url('/getdepartments'); ?>"; 
        }else if(id == 2){
            $("#obj_teamtype_update").val("team");
            var selectlabel = "Select Team";
            var url = "<?php echo url('/getteams'); ?>";
        }else{
            $("#obj_teamtype_update").val("individual");
            var selectlabel = "Select Owners";
            var url = "<?php echo url('/getmembers'); ?>"
        }
        $.ajax({
            type:"POST",
            url: url,
            data:'_token='+token+'&company_id='+company_id,
            dataType:'JSON',
            success: function (response) {
                $("#ownership_update").append('<option value = "">'+selectlabel+'</option>')
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#ownership_update").append('<option value = "'+key+'">'+val+'</option>');
                  }
                }
            }  
        });
    }

    function hidethemelistpop(){
        $("#themelistpop").modal('hide');
    }
    function hideScorecardlist(){
        $("#scorecardslist").modal("hide");
    }

    function submitthemeid(){
        var theme_id = $("#themelist").val();
        $("#objective_theme").val(theme_id);
        hidethemelistpop();
    }

    function ownershipdropupdate(){
        $("#obj_department_id_update").val("");
        $("#obj_teamid_update").val("");
        $("#obj_ind_owner_user_id_update").val(""); 
        var id = $("#ownership_update").val();
        var team_type = $("#obj_teamtype_update").val();
        if(team_type == "department"){
            $("#obj_department_id_update").val(id);
        }else if(team_type == "team"){
            $("#obj_teamid_update").val(id);
        }else{
            $("#obj_ind_owner_user_id_update").val(id); 
        }
    }
</script>