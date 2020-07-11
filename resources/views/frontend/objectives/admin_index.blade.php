@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
<style>
#chartdiv {
  width: 100%;
  height: 250px;
}

</style>
<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
@include('Element/objective/view_objective')
@include('Element/objective/add_objective')
@include('Element/objective/scorecards')
@include('Element/objective/add_scorecard')
@include('Element/objective/themes')
@include('Element/objective/add_theme')
@include('Element/objective/add_cycle')
@include('Element/objective/update_objective')

@include('Element/measure/view_measure')
@include('Element/measure/add_measure')       
@include('frontend/objectives/filter')
@include('Element/measure/task')
@include('Element/initiative/add_initiative')
@include('Element/initiative/view_initiative') 
@include('Element/measure/update_task')
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Objective') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="javascript:void(0);" class=" btn btn-primary btn-sm top-right-button mr-1" onclick="addObjectivepop()">{!! getLabels('add_objective') !!}</a>
                        <button type="button" class="btn btn-outline-primary mb-1" id="filterBtn">Filters</button>
                            
                    </div>                       
  

                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Objective') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
			
            <div class="row mb-4">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead class="thead-light">
										<tr>
										   <th> {!!getLabels('Name') !!}</th>
										   <th> {!!  getLabels('Cycle')!!} </th>
											<th> {!!  getLabels('Owner') !!} </th>
                                            <th> {!!  getLabels('Status') !!} </th>
                                           <th> {!! getLabels('Aligned to') !!} </th>
											<th> {!! getLabels('action') !!} </th>
										</tr>
									</thead>
									<tbody>
                                        @if(!$data->isEmpty())
                                        @foreach($data as $key => $value)
                                         <?php
                                            $remove_url = url("objective/remove/".$value->id); 
                                            $remove_msg = getLabels('are_you_sure'); ?>
												<tr>
													<td>
									                   <a href="javascript:void(0);" onclick="viewobjective('{!!$value->id!!}')"><i class="{!!$value->status_icon!!} heading-icon" style="color:{!!$value->bg_color!!}"></i> {!!$value->heading!!}
														</a></td>
													<td> {!!$value->cycle_name!!}</td>
													<td> <p class="text-semi-muted mb-2">{!!$value->owner_name!!}</p></td>
                                                    <td> <span class="badge badge-pill badge-success" style="background: {!!$value->bg_color!!}">{!!$value->status_name!!}</span></td>
                                                    <td>{!!$value->parent_objective!!}</td>
													<td>
														<a  href="javascript:void(0);" onclick="updateObjective('{!!$value->id!!}')" title="Edit"><i class="simple-icon-pencil heading-icon"></i></a>
                                                                <a  onclick = 'showConfirmationModal("Remove", "{!! $remove_msg !!}", "{!! $remove_url !!}");' href="javascript:void(0);" title="Remove"><i class="simple-icon-trash heading-icon"></i></a>
                                                                 <a href="javascript:void(0);" onclick="viewobjective('{!!$value->id!!}')" title="View"><i class="iconsminds-information heading-icon"></i>
                                                        </a>
													</td>
												</tr>
                                                @endforeach
                                            @endif
									</tbody>
								</table>
							</div>
							<br />
							
							<div class="row">
								<div class="col-12 text-center">
									<p class="justify-content-center ">{!! str_replace(array('{FIRST}', '{LAST}', '{TOTAL}'), array($data->firstItem(), $data->lastItem(), $data->total()), getLabels('showing_first_to_last_of_total_records')) !!}</p>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									{!! $data->links('frontend.pagination_custom') !!}
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


<script>
    function removetask(id){
        var token = "{!!csrf_token()!!}";
        $.ajax({
            type:"POST",
            url: "{!!url('removetasks')!!}"+"/"+id,
            data:'_token='+token,
            dataType:'JSON',
            success: function (response) {

            }
        });
    }
    function updateTask(id){
        $("#update_task_id").val(id);
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}";
        $.ajax({
            type:"POST",
            url: "{!!url('getTaskDetails')!!}",
            data:'_token='+token+'&company_id='+company_id+'&task_id='+id,
            dataType:'JSON',
            success: function (response) {
                var taskdetails = response.task_details;
                $("#task_name_update_id").val(taskdetails.task_name);
                $("#task_description_update_id").val(taskdetails.description);
                var owners = response.owners;
                for (var own in owners) {
                    if (owners.hasOwnProperty(own)) {
                        var owner = owners[own];
                        if(taskdetails.owners.indexOf(own) != -1){
                            $("#owners_update_id").append('<option value = "'+own+'" selected="selected">'+owner+'</option>');
                        }else{
                            $("#owners_update_id").append('<option value = "'+own+'">'+owner+'</option>');
                        }
                      }
                    }
                }  
        });
        $("#myModalUpdateTask").modal("show");
    }
    function addMeasure(){
        var objid = $("#objective_idview").val();
        $("#hideforobj").hide();
        $("#objectiveId").val(objid);
        onchangeobjectivegetcycle();
        $("#myModalAddMeasure").modal("show");
    }
    function addObjectivepop(slug){
        if(slug == "sub"){
            var heading = "Add Sub Objective";
            $("#addobjectiven").html(heading);
            var parobjeid = $("#objective_idview").val();
            $("#parent_objective_id").val(parobjeid);
        }else{
            var heading = "Add Objective";
            $("#addobjectiven").html(heading);
        }
        $("#myModalAddObjective").modal('show');
    }
     function onclickownershipadd(id){
        
        $("#ownership").html("");
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}";
        if(id == 1){
            $("#obj_teamtype").val("department");
            var selectlabel = "Select Department";
            var url = "{!!url('/getdepartments')!!}"; 
        }else if(id == 2){
            $("#obj_teamtype").val("team");
            var selectlabel = "Select Team";
            var url = "{!!url('/getteams')!!}";
        }else{
            $("#obj_teamtype").val("individual");
            var selectlabel = "Select Owners";
            var url = "{!!url('/getmembers')!!}"
        }
        $.ajax({
            type:"POST",
            url: url,
            data:'_token='+token+'&company_id='+company_id,
            dataType:'JSON',
            success: function (response) {
                $("#ownership").append('<option value = "">'+selectlabel+'</option>')
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#ownership").append('<option value = "'+key+'">'+val+'</option>');
                  }
                }
            }  
        });
    }

$(document).ready(function(){
    var adderrormessage = "{!!session('adderrormessage')?session('adderrormessage'):''!!}";
    if(adderrormessage != ''){
        $("#myModalAddObjective").modal('show');
    }
    
  $("#popupaddhideupdateTask").click(function(){
    $("#myModalUpdateTask").modal("hide");
  });
  $("#filterBtn").click(function(){
    $("#filterPop").modal('show');
  });
  
  $("#viewinitiativemodalhide").click(function(){
    $("#viewinitiativemodal").modal('hide');
  });
   $("#myBtn2").click(function(){
    $("#myModal2").modal('show');
  });
  
   $("#myBtn4").click(function(){
    $("#myModal4").modal('show');
  });$("#myBtn5").click(function(){
    $("#myModal5").modal('show');
  });
   
  $("#popup1hide").click(function(){
    $("#myModal").modal('hide');
  });
  
  $("#popup3hide").click(function(){
    $("#myModal2").modal('hide');
  });
   $("#hideFilter").click(function(){
    $("#filterPop").modal('hide');
  });
  $("#popup4hide").click(function(){
    $("#myModal3").modal('hide');
  });
  $("#popup5hide").click(function(){
    $("#myModal4").modal('hide');
  }); $("#popup8hide").click(function(){
    $("#myModal5").modal('hide');
  });
  $("#popupaddhideObjective").click(function(){
    $("#myModalAddObjective").modal('hide');
  });

   $("#popupaddhideinitiative").click(function(){
    $("#myModalAddInitiative").modal('hide');
  });
   $("#popupaddhideMeasure").click(function(){
    $("#myModalAddMeasure").modal("hide");
   });
   $("#view_measuremodal_hide").click(function(){
    $("#viewmeasuremodal").modal("hide");
});
   $("#popupaddhideTask").click(function(){
    $("#myModalAddTask").modal("hide");
   })
});

</script>
<script type="text/javascript">
    function chartload(milestones){

        am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.paddingRight = 30;
chart.dateFormatter.inputDateFormat = "yyyy-MM-dd HH:mm:ss";

var colorSet = new am4core.ColorSet();
colorSet.saturation = 0.4;

chart.data = milestones;

var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "name";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.inversed = true;

var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.dateFormatter.dateFormat = "yyyy-MM-dd HH:mm";
dateAxis.renderer.minGridDistance = 70;
dateAxis.baseInterval = { count: 30, timeUnit: "minute" };
dateAxis.max = new Date(2021, 0, 1, 24, 0, 0, 0).getTime();
dateAxis.strictMinMax = true;
dateAxis.renderer.tooltipLocation = 0;

var series1 = chart.series.push(new am4charts.ColumnSeries());
series1.columns.template.width = am4core.percent(80);
series1.columns.template.tooltipText = "{name}: {openDateX} - {dateX}";

series1.dataFields.openDateX = "fromDate";
series1.dataFields.dateX = "toDate";
series1.dataFields.categoryY = "name";
series1.columns.template.propertyFields.fill = "color"; // get color from data
series1.columns.template.propertyFields.stroke = "color";
series1.columns.template.strokeOpacity = 1;

chart.scrollbarX = new am4core.Scrollbar();

}); // end am4core.ready()
    
    }
    function viewInitiative(id){
        
        $("#viewpageinitiativeid").val(id);
        $("#initiativemilestonelist").html("");
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}"; 
         $.ajax({
            type:"POST",
            url: "{!!url('getInitiativeData')!!}",
            data:'_token='+token+'&company_id='+company_id+'&id='+id,
            dataType:'JSON',
            success: function (response) {
                var initiative =response.initiatives; 
                $("#initiativeheading").html('<i class="'+initiative.status_icon+' heading-icon" style="color:'+initiative.bg_color+';"></i>'+initiative.heading+'<p class="text-muted mb-0 text-small" style="margin-left: 35px;"><i class="simple-icon-clock"></i> FF'+initiative.measure_cycle_year+'-'+getQuarter(initiative.measure_cycle_quarter)+'  <i class="simple-icon-people"></i> '+initiative.owner_name )
                chartload(response.milestones);
                for(var i = 0; i < response.milestones.length; i++){
                    $("#initiativemilestonelist").append('<tr><td>'+response.milestones[i].name+'</td><td>'+response.milestones[i].fromDate+'</td><td>'+response.milestones[i].toDate+'</td><td><a href="javascript:void(0);" onclick="updatemilestoneini('+response.milestones[i].id+')"><i class="simple-icon-pencil"></i></a></td></tr>');

                }
                for(var i = 0; i < response.tasklist.length; i++){
                    $("#initiativetasklistview").append('<tr><td>'+response.tasklist[i].task_name+'</td><td>'+response.tasklist[i].owners+'</td><td><span class="badge badge-pill badge-danger" style="background-color:'+response.tasklist[i].bg_color+'">'+response.tasklist[i].status_name+'</span></td><td><i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i>&nbsp;&nbsp;&nbsp; <i class="simple-icon-trash" style="font-size: initial;cursor: pointer;"></i></td></tr>');

                }
            }
        })
        
        $("#viewinitiativemodal").modal('show');
     
    }
    function viewMeasure(id){
        $("#measure_id_view").val(id);
        $("#view_measure_heading").html("");
        $("#milestonelistmeasureview").html("");
        $("#addtaskmeasureview").html("");
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}"; 
        $.ajax({
            type:"POST",
            url: "{!!url('getMeasureonUpdatePage')!!}",
            data:'_token='+token+'&company_id='+company_id+'&measure_id='+id,
            dataType:'JSON',
            success: function (response) {
                var all_response = response.measures;
                $("#view_measure_heading").html('<i class="'+all_response.status_icon+' heading-icon" style="color:'+all_response.bg_color+';"></i>'+all_response.heading+'<p class="text-muted mb-0 text-small" style="margin-left: 35px;"><i class="simple-icon-clock"></i> FF'+all_response.measure_cycle_year+'-'+getQuarter(all_response.measure_cycle_quarter)+'  <i class="simple-icon-people"></i> '+all_response.owner_name );
                var milstonesli = response.milestones;
                for (var i = 0; i < milstonesli.length; i++) {
                    $("#milestonelistmeasureview").append('<tr><td>'+milstonesli[i].milestone_name+'</td><td>'+(milstonesli[i].mile_actual == null?"":milstonesli[i].mile_actual)+'</td><td>'+milstonesli[i].sys_target+'</td><td>'+milstonesli[i].start_date+'</td><td>'+milstonesli[i].end_date+'</td><td><a href="javascript:void(0);" onclick="updatemilestone('+milstonesli[i].id+')"><i class="simple-icon-pencil"></i></a></td></tr>');
                }
                var taskli = response.tasklist;
                for (var i = 0; i < taskli.length; i++) {
                    $("#addtaskmeasureview").html('<tr><td>'+taskli[i].task_name+'</td><td>'+taskli[i].owners+'</td><td><span class="badge badge-pill badge-danger" style="background:'+taskli[i].bg_color+'">'+taskli[i].status_name+'</span></td><td><a href="javascript:void(0);" onclick="updatetask('+taskli[i].id+')"><i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i></a>&nbsp;&nbsp;&nbsp; <i class="simple-icon-trash" style="font-size: initial;cursor: pointer;"></i></td></tr>');
                }
            }
        })  
        $("#viewmeasuremodal").modal('show');
    }
    function updateObjective(id){
        $("#ownership_update").html("");
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}"; 
        $.ajax({
            type:"POST",
            url: "{!!url('updateobjective')!!}",
            data:'_token='+token+'&company_id='+company_id+'&objective_id='+id,
            dataType:'JSON',
            success: function (all_response) {
                var response = all_response.objective;
                var teamsli = all_response.teams;
                var departmentli = all_response.departments;
                var memberli = all_response.members;
                var team_type = response.team_type;
                $("#obj_teamtype_update").val(team_type);
                $("#editId").val(response.id);
                $("#objective_heading_value").val(response.heading);
                $("#timeperiodsupdate").val(response.cycle_id);
                $("#perspectiveId").val(response.perspective_id);
                if(response.team_type == "department"){
                    $("#depactive").addClass('active');
                    $("#teamactive").removeClass('active');
                    $("#indiactive").removeClass('active');
                    $("#obj_department_id_update").val(response.department_id);
                    for (var depart in departmentli) {
                      if (departmentli.hasOwnProperty(depart)) {
                        var dep = departmentli[depart];
                        $("#ownership_update").append('<option value = "'+depart+'">'+dep+'</option>');                       
                     }
                    }
                    $("#ownership_update").val(response.department_id);
                }else if(response.team_type == "team"){
                    $("#depactive").removeClass('active');
                    $("#teamactive").addClass('active');
                    $("#indiactive").removeClass('active');
                    $("#obj_teamid_update").val(response.team_id);
                    for (var team in teamsli) {
                      if (teamsli.hasOwnProperty(team)) {
                        var tea = teamsli[team];
                        if(response.team_id == team){
                            $("#ownership_update").append('<option value = "'+team+'" selected="selected">'+tea+'</option>');
                        }else{
                            $("#ownership_update").append('<option value = "'+team+'">'+tea+'</option>');
                        }
                      }
                    }
                    $("#ownership_update").val(response.team_id);
                }else{
                    $("#depactive").removeClass('active');
                    $("#teamactive").removeClass('active');
                    $("#indiactive").addClass('active');
                    $("#obj_ind_owner_user_id_update").val(response.owner_user_id);
                    for (var member in memberli) {
                      if (memberli.hasOwnProperty(member)) {
                        var mem = memberli[member];
                        $("#ownership_update").append('<option value = "'+member+'">'+mem+'</option>');
                      }
                    }
                    $("#ownership_update").val(response.owner_user_id);
                }
                $("#scorecardsliupdate").html("");
                var selectedscorecard = response.scorecard_id;
                $("#objective_scorecard_update").val(selectedscorecard);
                $.ajax({
                    type:"POST",
                    url: "{!!url('/getscorecards')!!}",
                    data:'_token='+token+'&company_id='+company_id,
                    dataType:'JSON',
                    success: function (scorecards) {
                        for (var scs in scorecards) {
                          if (scorecards.hasOwnProperty(scs)) {
                            var vals = scorecards[scs];
                            if(selectedscorecard.indexOf(scs) != -1){
                                $("#scorecardsliupdate").append('<option value = "'+scs+'" selected="selected">'+vals+'</option>');
                            }else{
                                $("#scorecardsliupdate").append('<option value = "'+scs+'">'+vals+'</option>');
                            }
                          }
                        }
                       
                    }  
                });
                $.ajax({
                    type:"POST",
                    url: "{!!url('/getthemes')!!}",
                    data:'_token='+token+'&company_id='+company_id,
                    dataType:'JSON',
                    success: function (themes) {
                        for (var the in themes) {
                          if (themes.hasOwnProperty(the)) {
                            var thes = themes[the];
                            if(the == response.theme_id){
                                $("#themelistupdate").append('<option value = "'+the+'" selected="selected">'+thes+'</option>');
                            }else{
                                $("#themelistupdate").append('<option value = "'+the+'">'+thes+'</option>');
                            }
                          }
                        }
                    }  
                });
                var selectedcontributers = response.contributers;
                $.ajax({
                    type:"POST",
                    url: "{!!url('/getcontributers')!!}",
                    data:'_token='+token+'&company_id='+company_id,
                    dataType:'JSON',
                    success: function (contributers) {
                        for (var contri in contributers) {
                          if (contributers.hasOwnProperty(contri)) {
                            var con = contributers[contri];
                            if(selectedcontributers.indexOf(contri) != -1){
                                $("#contributersupdate").append('<option value = "'+contri+'" selected="selected">'+con+'</option>');
                            }else{
                                $("#contributersupdate").append('<option value = "'+contri+'">'+con+'</option>');
                            }
                          }
                        }
                    }  
                });
                
                $("#goal_visibilityid").val(response.goal_visibility);
                $("#confidance_level_id").val(response.confidence_level);
                $("#status_id").val(response.status);
                $("#inputAboutYouupdate").val(response.summary);
                $("#updateobjectivemodal").modal("show");
            }  
        });
    }
    $("#popupaddhideObjectiveupdate").click(function(){
        $("#updateobjectivemodal").modal("hide");
    });

    function getQuarter(quater){
        if(quater == 0){
            var value = "FULL";
        }else if(quater == 1){
            var value = "Q1";
        }else if(quater == 2){
            var value = "Q2";
        }else if(quater == 3){
            var value = "Q3";
        }else if(quater == 4){
            var value = "Q4";
        }else if(quater == 5){
            var value = "H1";
        }else if(quater == 6){
            var value = "H2";
        }
        return value;
    }
    function viewobjective(id){
        localStorage.setItem('key','viewobjctive');
        localStorage.setItem('keyid',id);
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}"; 
        $("#measurelistvieww").html("");
        $("#tasklistid").html("");
        $("#objective_name_view").html("");
        $("#initiativelistobj").html("");
        $("#alignedobjectivelist").html("");
        var removetasurl = 
        $.ajax({
            type:"POST",
            url: "{!!url('/viewobjective')!!}",
            data:'_token='+token+'&company_id='+company_id+'&id='+id,
            dataType:'JSON',
            success: function (response) {
                $("#objective_name_view").html('<i class="'+response.objectiveinfo.status_icon+' heading-icon" style="color:'+response.objectiveinfo.bg_color+';"></i>'+response.objectiveinfo.heading+'<p class="text-muted mb-0 text-small" style="margin-left: 35px;"><i class="simple-icon-clock"></i> '+response.objectiveinfo.cycle_name+'  <i class="simple-icon-people"></i> '+response.objectiveinfo.owner_name );
                $("#objective_idview").val(id);
                for (var i = 0; i < response.measuresList.length; i++) {
                    $("#measurelistvieww").append('<tr><td style="padding-top: 25px;"><a href="javascript:void(0);" onclick="onclickgraph()"><i class="'+response.measuresList[i].status_icon+' heading-icon" style="color:'+response.measuresList[i].bg_color+';"></i> '+response.measuresList[i].heading+' </a><p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY'+response.measuresList[i].measure_cycle_year+'-'+getQuarter(response.measuresList[i].measure_cycle_quarter)+'</p></td><td style="padding-top: 30px;"><p class="text-semi-muted mb-2">'+response.measuresList[i].owner_name+'</p></td><td><span class="badge badge-pill badge-success" style="background: '+response.measuresList[i].bg_color+';margin-top: 20px;">'+response.measuresList[i].status_name+'</span></td><td><div class="c100 p60 small" style="font-size:50px"><span>60%</span><div class="slice"><div class="bar"></div><div class="fill"></div></div></div></td><td style="padding-top:20px"><a href="javascript:void(0)" onclick="viewMeasure('+response.measuresList[i].id+')"><i class="iconsminds-information heading-icon"></i></td></tr>');
                }
                for (var i = 0; i < response.subobjective.length; i++) {
                    $("#alignedobjectivelist").append('<tr><td style="padding-top: 25px;"><a href="javascript:void(0);" onclick="onclickgraph()"><i class="'+response.subobjective[i].status_icon+' heading-icon" style="color:'+response.subobjective[i].bg_color+';"></i> '+response.subobjective[i].heading+' </a><p class="text-muted mb-0 text-small" style="margin-left: 35px;">'+response.subobjective[i].cycle_name+'</p></td><td style="padding-top: 30px;"><p class="text-semi-muted mb-2">'+response.subobjective[i].owner_name+'</p></td><td><span class="badge badge-pill badge-success" style="background: '+response.subobjective[i].bg_color+';margin-top: 20px;">'+response.subobjective[i].status_name+'</span></td><td><div class="c100 p60 small" style="font-size:50px"><span>60%</span><div class="slice"><div class="bar"></div><div class="fill"></div></div></div></td><td style="padding-top:20px"><a href="javascript:void(0)" onclick="viewobjective('+response.subobjective[i].id+')"><i class="iconsminds-information heading-icon"></i></td></tr>');
                }
                for (var i = 0; i < response.initiativeList.length; i++) {
                    $("#initiativelistobj").append('<tr><td style="padding-top: 25px;"><a href="javascript:void(0);" onclick="onclickgraph()"><i class="'+response.initiativeList[i].status_icon+' heading-icon" style="color:'+response.initiativeList[i].bg_color+';"></i> '+response.initiativeList[i].heading+' </a><p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY'+response.initiativeList[i].measure_cycle_year+'-'+getQuarter(response.initiativeList[i].measure_cycle_quarter)+'</p></td><td style="padding-top: 30px;"><p class="text-semi-muted mb-2">'+response.initiativeList[i].owner_name+'</p></td><td><span class="badge badge-pill badge-success" style="background: '+response.initiativeList[i].bg_color+';margin-top: 20px;">'+response.initiativeList[i].status_name+'</span></td><td><div class="c100 p60 small" style="font-size:50px"><span>60%</span><div class="slice"><div class="bar"></div><div class="fill"></div></div></div></td><td style="padding-top:20px"><a href="javascript:void(0)" onclick="viewInitiative('+response.initiativeList[i].id+')"><i class="iconsminds-information heading-icon"></i></td></tr>');
                }
                for (var i = 0; i < response.tasklist.length; i++) {
                    $("#tasklistid").append('<tr><td><i class="'+response.tasklist[i].status_icon+' heading-icon" style="color:'+response.initiativeList[i].bg_color+';"></i> '+response.tasklist[i].task_name+'</td><td>'+response.tasklist[i].owners+'</td><td><span class="badge badge-pill badge-danger" style="background:'+response.tasklist[i].bg_color+'">'+response.tasklist[i].status_name+'</span></td><td><a href="javascript:void(0);" onclick="updateTask('+response.tasklist[i].id+')"><i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i>&nbsp;&nbsp;&nbsp; </td></tr>'); 
                }
            }  
        });

        $("#myModal").modal('show');
    }
</script>

@stop