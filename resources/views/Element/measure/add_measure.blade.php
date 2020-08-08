<div class="modal fade modal-right" id="myModalAddMeasure" role="dialog" style="overflow: scroll;" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" style="max-width: 99.99%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Measure</h5>
                    <button type="button" class="close" id="popupaddhideMeasure" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                	 
                    {!! Form::open(array('url' => array($route_prefix.'/addmeasure'), 'class' =>'alignya_form needs-validation updateobjectiveform tooltip-label-right', 'name'=>'', 'files'=>true)) !!}
                                        
                    	<div class="container-fluid">
                    	<div class="row">
                    		
                    	<div class="col-lg-6">
                    		<div class="form-group has-float-label position-relative error-l-100 mb-4">
                            <label>Measure Title</label>
                            {!!Form::text('heading',null,array('class'=>'form-control'))!!}
                           <div class="invalid-tooltip"></div>
                            <input type="hidden" name="measure_team_type" id="measure_team_type" value="department">
                            <input type="hidden" name="owner_user_id" id="owner_user_id">
                            <input type="hidden" name="measure_department_id" id="measure_department_id">
                            <input type="hidden" name="measure_team_id" id="measure_team_id">
                            <input type="hidden" name="objective_id" id="objectiveId" class="removeattr">
                            <input type="hidden" name="is_popup" class="is_popup_id">
                        </div>
                       
                        <div class="form-group position-relative error-l-50 mb-4" id = "hideforobj">
                            <label>Objective</label>
                            {!!Form::select('objective_id',array(""=>"") + $objectives->toArray(),null,array('class'=>'form-control','id'=>'objectiveId', 'onchange'=>'onchangeobjectivegetcycle()'))!!}
                            <div class="invalid-tooltip"></div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label>Cycle</label>
                            <select class="form-control" name="measure_cycle" id = "measureCycle">
                                
                            </select>
                            
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
                                <label class="btn btn-primary active" onclick ="onclickownershipmeasure(1)">
                                    <input type="radio" name="options" id="option1" value="1" checked> Department
                                </label>
                                <label class="btn btn-primary" onclick ="onclickownershipmeasure(2)">
                                    <input type="radio" name="options" value="2" id="option2"> Team
                                </label>
                                <label class="btn btn-primary" onclick ="onclickownershipmeasure(3)">
                                    <input type="radio" name="options" value="3" id="option3"> Individual
                                </label>
                            </div>
                        </div>

                       <div class="form-group col-md-6">
                         <label>Please Select</label>
                            <select class="form-control ownership" onchange="ownershipdropmea()" name="ownership" data-width="100%" id = "ownershipmeasure">
                                @if(!empty($departments))
                                <option value="">Please Select</option>
                                @foreach($departments as $key => $vale)
                                <option value="{!!$key!!}">{!!$vale!!}</option>
                                @endforeach
                                @endif
                            </select>                       
                            <div class="invalid-tooltip"></div>
                        </div>
                    </div>
                        <div class="form-group">
                            <label>Contributers (optional)<br> <b style="font-size: 12px">(Hold down the Ctrl (windows) or Command (Mac) button to select multiple options.)</b></label>
                            {!!Form::select('contributers[]',$contributers,null,array('class'=>'form-control','multiple'=>'multiple'))!!}
                            
                        </div>
                         <div class="row">
                            <div class="form-group col-md-6">
                                <label>Measure Type</label>
                                {!!Form::select('measure_type',config('constants.MEASURE_TYPE'),null,array('class'=>'form-control','onchange'=>'onchangemeasuretype()','id'=>'measureType'))!!}
                            </div>
                              <div class="form-group col-md-6 showmeasureunit revenueshow" style="display: none;">
                                <label>Measure Unit</label>
                                {!!Form::text('measure_unit',null,array('class'=>'form-control'))!!}
								<div class="invalid-tooltip"></div>
                            </div>
                        </div>
    						
                        </div>

                        <div class="col-lg-6">
                            <div class="row revenuehide">
                            <div class="form-group position-relative error-l-50 mb-4 col-md-6">
                                <label>Measure Target</label>
                                {!!Form::text('measure_target',null,array('class'=>'form-control'))!!}
                                 <div class="invalid-tooltip"></div>
                            </div>
                              <div class="form-group position-relative error-l-50 mb-4 col-md-6">
                                <label>Measure Actual</label>
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
                                <div class="custom-control custom-checkbox "><input type="checkbox" class="custom-control-input" id="customCheckThis" name="is_auto" checked="checked" onclick="calc_type_hide()"> <label class="custom-control-label" for="customCheckThis">Do you want to create dynamic milestones</label></div>
                                
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
    function ownershipdropmea(){
        $("#measure_department_id").val("");
        $("#measure_team_id").val("");
        $("#owner_user_id").val(""); 
        var id = $("#ownershipmeasure").val();
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

    
     function calc_type_hide(){
        if($("input[name=is_auto]").is(":checked")){           
            $("#hide_calc_type").show();
        }   
        else{
            $("#hide_calc_type").hide();
        }
    }

  

    </script>