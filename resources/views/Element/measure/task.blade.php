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
                	 
                    {!! Form::open(array('url' => array($route_prefix.'/addtask'), 'class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
                                        
                    	<div class="container-fluid">
                    	<div class="row">
                    		
                    	<div class="col-lg-12">
                    		<div class="form-group">
                            <label>Title</label>
                            {!!Form::text('task_name',null,array('class'=>'form-control','required'=>'required'))!!}
                            @if($errors->first('task_name'))<div class="error">{!!$errors->first('task_name')!!}</div>@endif
                            <input type="hidden" name="objective_id" id="objectivetaskid" >
                            <input type="hidden" name="measure_id" id="measuretaskid">
                            <input type="hidden" name="type" id="typetaskid">
                            <input type="hidden" name="is_popup" class="is_popup">
                            
                        </div>
                        <div class="form-group">
                            <label>Owners</label>
                            {!!Form::select('owners[]',$contributers,null,array('class'=>'form-control select2-multiple','multiple'=>'multiple'))!!}
                            
                        </div>
                        <div class="form-group">
                            <label for="inputAboutYou">{!! getLabels('summary') !!}</label>
                        {!! Form::textarea('description', null, array('rows' => 2, 'class' => 'form-control', "id"=>"inputAboutYouupdate", 'placeholder'=> ''))!!}
                        </div>
                        
    						
                        </div>
                        </div>
                        </div>
                        <div class="col-lg-12">
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
                
            </div>
        </div>
    </div>
    <script type="text/javascript">
    function onclickownershipmeasure(id){
        $("#ownershipmeasure").html("");
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}";
        if(id == 1){
            $("#measure_team_type").val("department");
            var selectlabel = "Select Department";
            var url = "{!!url('/getdepartments')!!}"; 
        }else if(id == 2){
            $("#measure_team_type").val("team");
            var selectlabel = "Select Team";
            var url = "{!!url('/getteams')!!}";
        }else{
            $("#measure_team_type").val("individual");
            var selectlabel = "Select Owners";
            var url = "{!!url('/getmembers')!!}"
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