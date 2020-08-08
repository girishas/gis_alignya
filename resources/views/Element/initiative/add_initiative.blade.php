<div class="modal modal-right" id="myModalAddInitiative" role="dialog" style="overflow: scroll;">
        <div class="modal-dialog" style="max-width: 99.99%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Initiative</h5>
                    <button type="button" class="close" id="popupaddhideinitiative" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            
                <div class="modal-body">
                     
                    {!! Form::open(array('url' => array($route_prefix.'/addinitiative'), 'class' =>' alignya_form needs-validation updateobjectiveform tooltip-label-right', 'name'=>'', 'files'=>true)) !!}
                                        
                        <div class="container-fluid">
                        <div class="row">
                            
                        <div class="col-lg-6">
                            <div class="form-group has-float-label position-relative error-l-100 mb-4">
                            <label>Title</label>
                            {!!Form::text('heading',null,array('class'=>'form-control'))!!}
                            <div class="invalid-tooltip"></div>
                            <input type="hidden" name="measure_team_type" id="initiative_team_type" value="department">
                            <input type="hidden" name="owner_user_id" id="initiative_owner_user_id">
                            <input type="hidden" name="measure_department_id" id="initiative_department_id">
                            <input type="hidden" name="measure_team_id" id="initiative_team_id">
                            <input type="hidden" name="objective_id" id="initiative_objectiveId" class = "hideindivi">
                           <input type="hidden" name="is_popup" class="is_popup">
                        </div>
                       
                        <div class="form-group  position-relative error-l-50 mb-4" id = "hideforobjini">
                            <label>Objective</label>
                            {!!Form::select('objective_id',array(""=> "Please Select Objective") + $objectives->toArray(),null,array('class'=>'form-control','id'=>'initiative_objectiveId', 'onchange'=>'onchangeobjectivegetcycleinitiative()'))!!}
                            <div class="invalid-tooltip"></div>
                        </div>
                        <div class="row">
                        <div class="form-group  position-relative error-l-50 mb-4 col-md-6">
                            <label>Cycle</label>
                            <select class="form-control" name="measure_cycle" id = "initiativeCycle">
                                
                            </select>
                            <div class="invalid-tooltip"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Check in Frequency</label>
                            {!!Form::select('check_in_frequency',config('constants.FREQUENCY'),null,array('class'=>'form-control'))!!}
                        </div>
                         </div>
                         <div class="row">
                         <div class="form-group col-md-6">   
                            <label>Ownership</label>
                            <br>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-primary active" onclick ="onclickownershipinitiative(1)">
                                    <input type="radio" name="options" id="option1" value="1" checked> Department
                                </label>
                                <label class="btn btn-primary" onclick ="onclickownershipinitiative(2)">
                                    <input type="radio" name="options" value="2" id="option2"> Team
                                </label>
                                <label class="btn btn-primary" onclick ="onclickownershipinitiative(3)">
                                    <input type="radio" name="options" value="3" id="option3"> Individual
                                </label>
                            </div>
                        </div>

                       <div class="form-group  position-relative error-l-50 mb-4 col-md-6">
                         <label>Please Select</label>
                            <select class="form-control ownership" onchange="ownershipdropinitiative()" name="ownership" data-width="100%" id = "ownershipinitiative">
                                @if(!empty($departments))
                                <option value="">Please Select Ownership</option>
                                @foreach($departments as $key => $vale)
                                <option value="{!!$key!!}">{!!$vale!!}</option>
                                @endforeach
                                @endif
                            </select>                       
                            <div class="invalid-tooltip"></div>
                        </div>
                    </div>
                        <div class="form-group mt-2">
                            <label>Contributers (optional) <br> <span style="font-size: 12px">(Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.)</span></label>
                            {!!Form::select('contributers[]',$contributers,null,array('class'=>'form-control','multiple'=>'multiple'))!!}
                            
                        </div>
                        
                        </div>

                        <div  class="col-md-6">
                            <button type="button" class="btn btn-primary" onclick="addMoreMilestone()">Add More Milestone</button> <button type="button" class="btn btn-primary" onclick="removeMilestone()">Remove</button>
                            <div id="addMoremilestones">
                            <div class="row" style="margin-top: 10px">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Milestone Name</label>
                                        {!!Form::text('milestone_name[]',null,array('class'=>'form-control','required'=>'required'))!!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        {!!Form::date('start_date[]',null,array('class'=>'form-control','required'=>'required'))!!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        {!!Form::date('end_date[]',null,array('class'=>'form-control','required'=>'required'))!!}
                                    </div>
                                </div>
                            </div>
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
    function onclickownershipinitiative(id){
        $("#ownershipinitiative").html("");
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}";
        if(id == 1){
            $("#initiative_team_type").val("department");
            var selectlabel = "Select Department";
            var url = "{!!url('/getdepartments')!!}"; 
        }else if(id == 2){
            $("#initiative_team_type").val("team");
            var selectlabel = "Select Team";
            var url = "{!!url('/getteams')!!}";
        }else{
            $("#initiative_team_type").val("individual");
            var selectlabel = "Select Owners";
            var url = "{!!url('/getmembers')!!}"
        }
        $.ajax({
            type:"POST",
            url: url,
            data:'_token='+token+'&company_id='+company_id,
            dataType:'JSON',
            success: function (response) {
                $("#ownershipinitiative").append('<option value = "">'+selectlabel+'</option>')
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#ownershipinitiative").append('<option value = "'+key+'">'+val+'</option>');
                  }
                }
            }  
        });
    }
    function ownershipdropinitiative(){
        $("#initiative_department_id").val("");
        $("#initiative_team_id").val("");
        $("#initiative_owner_user_id").val(""); 
        var id = $("#ownershipinitiative").val();
        var team_type = $("#initiative_team_type").val();
        if(team_type == "department"){
            $("#initiative_department_id").val(id);
        }else if(team_type == "team"){
            $("#initiative_team_id").val(id);
        }else{
            $("#initiative_owner_user_id").val(id); 
        }
    }

   

    function onchangeobjectivegetcycleinitiative(){
        var objective_id =  $("#initiative_objectiveId").val();
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}";
        $.ajax({
            type:"POST",
            url: "{!!url('getMeasureCycles')!!}",
            data:'_token='+token+'&company_id='+company_id+'&objective_id='+objective_id,
            dataType:'JSON',
            success: function (response) {
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#initiativeCycle").append('<option value = "'+val+'">'+val+'</option>');
                  }
                }
            }  
        });
    }

    function addMoreMilestone(){
        $("#addMoremilestones").append(' <div class="row thisisremoveclass" style="margin-top: 10px"><div class="col-md-4"><div class="form-group"><input type="text" name="milestone_name[]" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><input type="date" name="start_date[]" class="form-control"></div></div><div class="col-md-4"><div class="form-group"><input type="date" name="end_date[]" class="form-control"></div></div></div>');
    }

    function removeMilestone(){
        var maindiv = $("#addMoremilestones");
        var last = maindiv.find('.thisisremoveclass:last');
        last.remove();
    }
    </script>