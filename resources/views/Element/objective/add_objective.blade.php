<div class="modal fade modal-right" id="myModalAddObjective" role="dialog" >
        <div class="modal-dialog" style="max-width: 50%">
        <div class="modal-content" >
        <div class="modal-header">
            <h5 class="modal-title" id = "addobjectiven">Add Objective</h5>
            <button type="button" class="close" id="popupaddhideObjective" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        {!! Form::open(array('url' => array($route_prefix.'/addobjective'), 'class' =>'alignya_form needs-validation tooltip-label-right updateobjectiveform', 'id'=>'myForm', 'name'=>'', 'files'=>true)) !!}
        <div class="modal-body">
        		<div class="container-fluid">
            	<div class="row">
            		
            	<div class="col-lg-12">
            		<div class="form-group position-relative error-l-100">
                    <label>Title</label>
                    {!!Form::text('heading',null,array('class'=>'form-control'))!!}
                    <div class="invalid-tooltip"></div>
                    <input type="hidden" name="scorecard_id" value="" id="objective_scorecard">
                    <input type="hidden" name="theme_id" value="" id="objective_theme">
                    <input type="hidden" name="team_type" value="department" id = "obj_teamtype">
                    <input type="hidden" name="team_id" value="" id = "obj_teamid">
                    <input type="hidden" name="department_id" value="" id = obj_department_id>
                    <input type="hidden" name="owner_user_id" value="" id="obj_ind_owner_user_id">
                    <input type="hidden" name="objective_id" value="" id = "parent_objective_id">
                    <input type="hidden" name="is_popup" class="is_popup">
                </div>
               

                <div class="form-group  position-relative error-l-100 mb-4">
                    <label>Time Period</label>
                    <select class="form-control" name="cycle_id" data-width="100%" id="timeperiods">
                        <option value="">Please Select Time Period</option>
                    @foreach($goal_cycles as $key => $balue)
                        <option value="{!!$key!!}">{!!$balue!!}</option>
                    @endforeach
                    </select>
                    <div class="invalid-tooltip"></div>
                </div>
                <div class="form-group position-relative error-l-50">
                    <label>Perspective</label>
                    {!!Form::select('perspective_id',array(""=>"Please Select Perspective") + $perspectives->toArray(),null,array('class'=>'form-control'))!!}
                    <div class="invalid-tooltip"></div>
                </div>
                <div class="form-group ">	
                    <label>Ownership</label>
               		<br>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-primary active" onclick ="onclickownershipadd(1)">
                            <input type="radio" name="options" id="option1" value="1" checked> Department
                        </label>
                        <label class="btn btn-primary" onclick ="onclickownershipadd(2)">
                            <input type="radio" name="options" value="2" id="option2"> Team
                        </label>
                        <label class="btn btn-primary" onclick ="onclickownershipadd(3)">
                            <input type="radio" name="options" value="3" id="option3"> Individual
                        </label>
                    </div>
                </div>

               <div class="form-group position-relative error-l-50">
        			<select class="form-control" onchange="ownershipdropobj()" name="ownership" data-width="100%" id = "ownership">
                        @if(!empty($departments))
                        <option value="">Please Select Department</option>
                    	@foreach($departments as $key => $vale)
                        <option value="{!!$key!!}">{!!$vale!!}</option>
                        @endforeach
                        @endif
                    </select>						
        			<div class="invalid-tooltip"></div>
        		</div>

        		 <div class="form-group ">
                        <label>Contributers</label>
                       <select class="form-control select2-multiple" multiple="multiple" name="contributers[]" data-width="100%" id="contributersadd">
                           
                       </select>                    
                      
                    </div>
                    
                <button type="submit" class="btn btn-primary">Submit</button>
            
                </div>
                <!-- <div class="col-lg-4" style="text-align: right;">
                   <button type="button" class="btn btn-primary" style="margin-bottom: 10px;" onclick="scorecardpopup()">Scorecard</button> <br>
                   <button type="button" class="btn btn-primary" style="margin-bottom: 10px;" onclick="themepopup()">Theme</button> <br>
                   <button type="button" class="btn btn-primary" onclick="addcyclepopup()">Add Cycle</button>     
                </div> -->
                
                </div>
                </div>
            
        </div>

        {!!Form::close()!!}
        </div>
        </div>
        </div>



<script type="text/javascript">
    function scorecardpopup(){
        $("#scorecardsli").html("");
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}";
        $.ajax({
            type:"POST",
            url: "{!!url('/getscorecards')!!}",
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
        var token = "{!!csrf_token()!!}";
        var scorecardname = $("#scorecardname").val();
        var scorecardstatus = $("#scorecardstatus").val();
        var company_id = "{!!Auth::User()->company_id!!}";
        $.ajax({
            type:"POST",
            url: "{!!url('/submitscorecard')!!}",
            data:'_token='+token+'&company_id='+company_id+'&scorecardname='+scorecardname+'&scorecardstatus='+scorecardstatus,
            dataType:'JSON',
            success: function (response) {
                hideaddscorecard();
                scorecardpopup();
            }  
        });
    }

    function submitaddcycle(){
        var token = "{!!csrf_token()!!}";
        var cyclename = $("#cyclename").val();
        var numberofmonth = $("#numberofmonth").val();
        var company_id = "{!!Auth::User()->company_id!!}";
        $.ajax({
            type:"POST",
            url: "{!!url('/submitaddcycle')!!}",
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
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}";
        $.ajax({
            type:"POST",
            url: "{!!url('/getCycles')!!}",
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
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}";
        $.ajax({
            type:"POST",
            url: "{!!url('/getthemes')!!}",
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
        var token = "{!!csrf_token()!!}";
        var themename = $("#themename").val();
        var themesummary = $("#themesummary").val();
        var company_id = "{!!Auth::User()->company_id!!}";
        $.ajax({
            type:"POST",
            url: "{!!url('/submitaddtheme')!!}",
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

    function ownershipdropobj(){
        $("#obj_department_id").val("");
        $("#obj_teamid").val("");
        $("#obj_ind_owner_user_id").val(""); 
        var id = $("#ownership").val();
        var team_type = $("#obj_teamtype").val();
        if(team_type == "department"){
            $("#obj_department_id").val(id);
        }else if(team_type == "team"){
            $("#obj_teamid").val(id);
        }else{
            $("#obj_ind_owner_user_id").val(id); 
        }
    }
</script>