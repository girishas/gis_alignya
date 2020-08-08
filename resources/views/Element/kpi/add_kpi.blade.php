<div class="modal modal-right" id="myModalAddKPI" role="dialog" style="overflow: scroll;">
        <div class="modal-dialog" style="max-width: 99.99%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add KPI</h5>
                    <button type="button" class="close" id="popupaddhidekpi" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
               
                <div class="modal-body">
                     
                    {!! Form::open(array('url' => array($route_prefix.'/addkpi'), 'class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
                                        
                        <div class="container-fluid">
                        <div class="row">
                            
                        <div class="col-lg-6">
                            <div class="form-group has-float-label position-relative error-l-100">
                            <label>KPI Title</label>
                            {!!Form::text('heading',null,array('class'=>'form-control'))!!}
                            <div class="invalid-tooltip"></div>
                            <input type="hidden" name="measure_team_type" id="kpi_team_type" value="department">
                            <input type="hidden" name="owner_user_id" id="owner_user_id">
                            <input type="hidden" name="measure_department_id" id="kpi_department_id">
                            <input type="hidden" name="measure_team_id" id="kpi_team_id">
                            <input type="hidden" name="objective_id" id="objectiveId" class="removeattr" value="NO">
                        </div>
                       
                        
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label>Cycle</label>
                            <select class="form-control" name="measure_cycle" id = "KPICycle">
                                
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
                                <label class="btn btn-primary active" onclick ="onclickownershipkpi(1)">
                                    <input type="radio" name="options" id="option1" value="1" checked> Department
                                </label>
                                <label class="btn btn-primary" onclick ="onclickownershipkpi(2)">
                                    <input type="radio" name="options" value="2" id="option2"> Team
                                </label>
                                <label class="btn btn-primary" onclick ="onclickownershipkpi(3)">
                                    <input type="radio" name="options" value="3" id="option3"> Individual
                                </label>
                            </div>
                        </div>

                       <div class="form-group position-relative error-l-50 col-md-6">
                         <label>Please Select</label>
                            <select class="form-control ownership" onchange="ownershipdropkpi()" name="ownership" data-width="100%" id = "ownershipkpi">
                                @if(!empty($departments))
                                <option value="">Please Select Department</option>
                                @foreach($departments as $key => $vale)
                                <option value="{!!$key!!}">{!!$vale!!}</option>
                                @endforeach
                                @endif
                            </select>                       
                            <div class="invalid-tooltip"></div>
                        </div>
                    </div>
                        <div class="form-group mt-2">
                            <label>Contributers (optional)<br> <span style="font-size: 12px">(Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.)</span></label>
                            {!!Form::select('contributers[]',$contributers,null,array('class'=>'form-control','multiple'=>'multiple'))!!}
                            
                        </div>
                         <div class="row">
                            <div class="form-group col-md-6">
                                <label>KPI Type</label>
                                {!!Form::select('measure_type',config('constants.MEASURE_TYPE'),null,array('class'=>'form-control','onchange'=>'onchangekpitype()','id'=>'KPIType'))!!}
                            </div>
                              <div class="form-group col-md-6 showkpiunit revenueshow" style="display: none;">
                                <label>KPI Unit</label>
                                {!!Form::text('measure_unit',null,array('class'=>'form-control'))!!}
								<div class="invalid-tooltip"></div>
                            </div>
                        </div>
                            
                        </div>

                        <div class="col-lg-6">
                            <div class="row revenuehide">
                            <div class="form-group col-md-6 has-float-label position-relative error-l-100">
                                <label>KPI Target</label>
                                {!!Form::text('measure_target',null,array('class'=>'form-control'))!!}
                                <div class="invalid-tooltip"></div>
                            </div>
                              <div class="form-group col-md-6 has-float-label position-relative error-l-100">
                                <label>KPI Actual</label>
                                {!!Form::text('measure_actual',null,array('class'=>'form-control'))!!}
                                <div class="invalid-tooltip"></div>
                            </div>
                        </div>
                        <div class="row revenueshow" style="display: none;">
                            <div class="form-group col-md-6">
                                <label>Revenue Target</label>
                                {!!Form::text('revenue_target',null,array('class'=>'form-control'))!!}
								<div class="invalid-tooltip"></div>
                            </div>
                              <div class="form-group col-md-6">
                                <label>Revenue Actual</label>
                                {!!Form::text('revenue_actual',null,array('class'=>'form-control'))!!}
								<div class="invalid-tooltip"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Gross Margin Target</label>
                                {!!Form::text('target_gm',null,array('class'=>'form-control'))!!}
                            </div>
                              <div class="form-group col-md-6">
                                <label>Gross Margin Actual</label>
                                {!!Form::text('actual_gm',null,array('class'=>'form-control'))!!}
                            </div> <div class="form-group col-md-6">
                                <label>Middle Margin Target</label>
                                {!!Form::text('target_mm',null,array('class'=>'form-control'))!!}
                            </div>
                              <div class="form-group col-md-6">
                                <label>Middle Margin Actual</label>
                                {!!Form::text('actual_mm',null,array('class'=>'form-control'))!!}
                            </div> <div class="form-group col-md-6">
                                <label>Net Margin Target</label>
                                {!!Form::text('target_nm',null,array('class'=>'form-control'))!!}
                            </div>
                              <div class="form-group col-md-6">
                                <label>Net Margin Actual</label>
                                {!!Form::text('actual_nm',null,array('class'=>'form-control'))!!}
                            </div> <div class="form-group col-md-6">
                                <label>SG & A Expense Target</label>
                                {!!Form::text('target_expense',null,array('class'=>'form-control'))!!}
                            </div>
                              <div class="form-group col-md-6">
                                <label>SG & A Expense Actual</label>
                                {!!Form::text('actual_expense',null,array('class'=>'form-control'))!!}
                            </div> <div class="form-group col-md-6">
                                <label>Net Income/Loss Target</label>
                                {!!Form::text('target_net',null,array('class'=>'form-control'))!!}
                            </div>
                              <div class="form-group col-md-6">
                                <label>Net Income/Loss Actual</label>
                                {!!Form::text('actual_net',null,array('class'=>'form-control'))!!}
                            </div> <div class="form-group col-md-6">
                                <label>EBITDA Target</label>
                                {!!Form::text('target_ebitda',null,array('class'=>'form-control'))!!}
                            </div>
                              <div class="form-group col-md-6">
                                <label>EBITDA Actual</label>
                                {!!Form::text('actual_ebitda',null,array('class'=>'form-control'))!!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="custom-control custom-checkbox "><input type="checkbox" class="custom-control-input" id="customCheckThis" name="is_auto" onclick="calc_type_hide()" checked="checked"> <label class="custom-control-label" for="customCheckThis">Do you want to create dynamic milestones</label></div>
                                
                            </div>
                             <div class="col-md-6" id="hide_calc_type">
                                <label>Calculation Type</label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="calculation_type1" name="calculation_type" value = "0" class="custom-control-input" checked="checked">
                                    <label class="custom-control-label" for="calculation_type1">Target value set for each milestone</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="calculation_type2" name="calculation_type" value="1" class="custom-control-input"> 
                                    <label class="custom-control-label" for="calculation_type2">Target value divide in all milestones equally</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="calculation_type3" name="calculation_type" value="2" class="custom-control-input">
                                    <label class="custom-control-label" for="calculation_type3">Target value achieve in incremental order</label>
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

    function onclickownershipkpi(id){
        $("#ownershipkpi").html("");
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}";
        if(id == 1){
            $("#kpi_team_type").val("department");
            var selectlabel = "Select Department";
            var url = "{!!url('/getdepartments')!!}"; 
        }else if(id == 2){
            $("#kpi_team_type").val("team");
            var selectlabel = "Select Team";
            var url = "{!!url('/getteams')!!}";
        }else{
            $("#kpi_team_type").val("individual");
            var selectlabel = "Select Owners";
            var url = "{!!url('/getmembers')!!}"
        }
        $.ajax({
            type:"POST",
            url: url,
            data:'_token='+token+'&company_id='+company_id,
            dataType:'JSON',
            success: function (response) {
                $("#ownershipkpi").append('<option value = "">'+selectlabel+'</option>')
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#ownershipkpi").append('<option value = "'+key+'">'+val+'</option>');
                  }
                }
            }  
        });
    }
    function ownershipdropkpi(){
        $("#kpi_department_id").val("");
        $("#kpi_team_id").val("");
        $("#owner_user_id").val(""); 
        var id = $("#ownershipkpi").val();
        var team_type = $("#kpi_team_type").val();
        if(team_type == "department"){
            $("#kpi_department_id").val(id);
        }else if(team_type == "team"){
            $("#kpi_team_id").val(id);
        }else{
            $("#owner_user_id").val(id); 
        }
    }

    function onchangekpitype(){
        var kpi_ty = $("#KPIType").val();
        if(kpi_ty == "value"){
            $(".showkpiunit").show();
        }else if(kpi_ty == "revenue"){
           $(".revenueshow").show();
            $(".revenuehide").hide();
        }else{
            $(".revenueshow").hide();
             $(".revenuehide").show();
        }
    }

    function onchangeobjectivegetcyclekpi(){
    
        var objective_id =  $("#objectiveId").val();
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}";
        $("#KPICycle").html("");
        $.ajax({
            type:"POST",
            url: "{!!url('getMeasureCycles')!!}",
            data:'_token='+token+'&company_id='+company_id+'&objective_id='+objective_id,
            dataType:'JSON',
            success: function (response) {
                console.log(response)
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#KPICycle").append('<option value = "'+val+'">'+val+'</option>');
                  }
                }
            }  
        });
    }

    function calc_type_hide(){
        if($("input[name=is_auto]").is(":checked")){           
            $("#hide_calc_type").show();
        }   
        else{
            $("#hide_calc_type").hide();
        }
    }
    
    </script>

