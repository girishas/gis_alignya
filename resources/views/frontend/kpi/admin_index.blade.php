    @extends('frontend/layouts/default')
    <?php use App\Traits\SortableTrait;  ?>

    @section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <main>
    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
    <h1>{!! getLabels('KPI') !!}</h1>
    <div class="text-zero top-right-button-container">
    <a href="javascript:void(0);" class=" btn btn-primary btn-sm top-right-button mr-1" id="add_objectiveBtn">{!! getLabels('add_kpi') !!}</a>
    <button type="button" class="btn btn-outline-primary mb-1" onclick="filter()">Filters</button>
    </div>
    @include('Element/kpi/view_kpi')
    @include('Element/measure/view_large_measure_graph')
    @include('Element/kpi/add_kpi')
    @include('Element/kpi/update_kpi')
    @include('Element/measure/update_milestone')
    @include('Element/measure/add_milestone')
    @include('Element/measure/task')
    @include('Element/measure/update_task')
    @include('frontend/kpi/filter')
    

    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
    <ol class="breadcrumb pt-0">
    <li class="breadcrumb-item">
        <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
    </li>

    <li class="breadcrumb-item active" aria-current="page">{!! getLabels('KPI') !!}</li>
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
    			   <th> {!! getLabels('Name') !!} </th>
    				<th> {!!getLabels('Cycle') !!} </th>
                    <th> {!! getLabels('Owner') !!} </th>
                    <th> {!! getLabels('Status') !!} </th>
    				<th> {!! getLabels('action') !!} </th>
    			</tr>
    		</thead>
    		<tbody>
                @if(!$data->isEmpty())
                @foreach($data as $key => $value)
                    <?php $remove_msg = "Are you sure";
                    $remove_url = url('kpi/remove/'.$value->id); ?>
    					<tr>
    						<td><a href="javascript:void(0);" onclick="viewMeasure('{!!$value->id!!}')"><i class="{!!$value->status_icon!!} heading-icon" style="color:{!!$value->bg_color!!}"></i>  {!!$value->heading!!}</td>
    						 <td> FY{!!$value->measure_cycle_year!!}-{!!config('constants.Quarter.'.$value->measure_cycle_quarter)!!}</td>
                            <td> {!!$value->owner_name!!}</td>
                            <td> <span class="badge badge-pill badge-success" style="background-color: {!!$value->bg_color!!}">{!!$value->status_name!!}</span></td>
    						<td>
    							<a href="javascript:void(0);" onclick="updateKPI('{!!$value->id!!}')"><i class="simple-icon-pencil heading-icon"></i></a>
                                <a href="javascript:void(0);" onclick="viewMeasure('{!!$value->id!!}')"><i class="iconsminds-information heading-icon"></i></a>
                                <a onclick = 'showConfirmationModal("Remove", "{!! $remove_msg !!}", "{!! $remove_url !!}");' href="javascript:void(0);"><i class="simple-icon-trash heading-icon"></i></a>
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
@include('Element/js/includejs')
        <script>
      
    $(document).ready(function(){
        $("#popupaddhideupdateTask").click(function(){
            $("#myModalUpdateTask").modal("hide");
        });
        var kpimessage = "{!!session('kpimessage')?session('kpimessage'):''!!}";
        if(kpimessage != ""){
            showNotificationApp('top', 'right', 'primary', 'success', '{!!session("kpimessage")!!}');
        }

        var popup_content_message = "{!!session('popup_content_message')?session('popup_content_message'):''!!}";
        if(popup_content_message != ""){
            viewMeasure(localStorage.getItem('popup_id'));
        }
        $("#popupaddhideTask").click(function(){
            $("#myModalAddTask").modal("hide");
        })
        $("#myBtn").click(function(){
            $("#myModal").modal('show');
        });
        $("#add_objectiveBtn").click(function(){
         
              onchangeobjectivegetcyclekpi();
        $("#myModalAddKPI").modal('show');
        });
        $("#filterBtn").click(function(){
            $("#filterPop").modal('show');
        });
        $("#hideFilter").click(function(){
            $("#filterPop").modal('hide');
        });
        $("#myBtn1").click(function(){
            $("#myModal1").modal('show');
        });
        $("#myBtn2").click(function(){
            $("#myModal2").modal('show');
        });
        $("#popup1hide").click(function(){
            $("#myModal").modal('hide');
        });
        $("#popup2hide").click(function(){
            $("#myModal1").modal('hide');
        });
        $("#popup3hide").click(function(){
            $("#myModal2").modal('hide');
        });
        $("#popupaddhidekpi").click(function(){
            $("#myModalAddKPI").modal('hide');
        });
        $("#popupaddhideUpdateKPI").click(function(){
            $("#myModalUpdateKPI").modal('hide');
        });
        $("#view_kpimodal_hide").click(function(){
            $("#viewkpimodal").modal("hide");
            window.location.reload();
        })
    });
function filter(){
    $("#filterPop").modal('show');
}
function measureGraph(target_data,labels,actual_data,max_value,projection_data,actual_color,target_color,projection_color){
    document.getElementById("viewlargemeasuregraph").innerHTML = " ";
    document.getElementById("measuregraph").innerHTML = " ";
    var contributionChartOptions = {
    type: "LineWithShadow",
    options: {
      plugins: {
        datalabels: {
          display: false
        }
      },
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        yAxes: [
          {
            gridLines: {
              display: true,
              lineWidth: 1,
              color: "rgba(0,0,0,0.1)",
              drawBorder: false
            },
            ticks: {
              beginAtZero: true,
              stepSize: 50,
              min: 0,
              max: parseInt(max_value),
              padding: 20
            }
          }
        ],
        xAxes: [
          {
            gridLines: {
              display: false
            }
          }
        ]
      },
      legend: {
        display: false
      },
      
    },
    data: {
      labels: labels,
      datasets: [
        {
          borderWidth: 2,
          label: "",
          data: target_data,
          borderColor: target_color,
       
          pointBorderColor: target_color,
          pointHoverBackgroundColor: target_color,
         
          pointRadius: 4,
          pointBorderWidth: 2,
          pointHoverRadius: 5,
          fill: false
        },
        {
          borderWidth: 2,
          label: "",
          data: actual_data,
          borderColor: actual_color,
       
          pointBorderColor: actual_color,
          pointHoverBackgroundColor: actual_color,
         
          pointRadius: 4,
          pointBorderWidth: 2,
          pointHoverRadius: 5,
          fill: false
        },
        {
          borderWidth: 2,
          label: "",
          data: projection_data,
          borderColor: projection_color,
       
          pointBorderColor: projection_color,
          pointHoverBackgroundColor: projection_color,
         
          pointRadius: 4,
          pointBorderWidth: 2,
          pointHoverRadius: 5,
          fill: false
        },
        
      ]
    }
  };

  if (document.getElementById("viewlargemeasuregraph")) {
    var contributionChart1 = new Chart(
      document.getElementById("viewlargemeasuregraph").getContext("2d"),
      contributionChartOptions
    );
  }

  if (document.getElementById("measuregraph")) {
    var contributionChart1 = new Chart(
      document.getElementById("measuregraph").getContext("2d"),
      contributionChartOptions
    );
  }
}

    function viewMeasure(id){
        $(".is_popup").val(1);
        localStorage.setItem('popup_id',id);
        $("#measure_id_view").val(id);
        $("#view_measure_heading").html("");
        $("#milestonelistmeasureview").html("");
        $("#addtaskmeasureview").html("");
        $("#kpi_name_graph_side").html("");
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
                var actual_color = all_response.actual_color != "" ? all_response.actual_color : "blue";
                var target_color = all_response.target_color != "" ? all_response.target_color : "red";
                var projection_color = all_response.projection_color != "" ? all_response.projection_color : "yellow";
                measureGraph(response.plucked_milestone,response.graph_labels,response.actual_graph_data,response.max_mile,response.pojected_graph_data,actual_color,target_color,projection_color);
                
                $("#view_measure_heading").html('<i class="'+all_response.status_icon+' heading-icon" style="color:'+all_response.bg_color+';"></i>'+all_response.heading+' <a href="javascript:void(0);" onclick="updateKPI('+all_response.id+')"><i class="simple-icon-pencil"></i></a><p class="text-muted mb-0 text-small" style="margin: 10px 7px 0;"><i class="simple-icon-clock"></i> FF'+all_response.measure_cycle_year+'-'+getQuarter(all_response.measure_cycle_quarter)+'  <i class="simple-icon-people"></i> '+all_response.owner_name );
                $("#kpi_name_graph_side").html('<p class="mb-0 truncate">'+all_response.heading+'</p><p class="text-muted mb-0 text-small"> FF'+all_response.measure_cycle_year+'-'+getQuarter(all_response.measure_cycle_quarter)+'</p>');
                var milstonesli = response.milestones;
                for (var i = 0; i < milstonesli.length; i++) {
                    $("#milestonelistmeasureview").append('<tr><td>'+milstonesli[i].milestone_name+'</td><td>'+(milstonesli[i].mile_actual == null?"":milstonesli[i].mile_actual)+'</td><td>'+milstonesli[i].sys_target+'</td><td>'+milstonesli[i].start_date+'</td><td>'+milstonesli[i].end_date+'</td><td><a href="javascript:void(0);" onclick="updatemilestone('+milstonesli[i].id+')"><i class="simple-icon-pencil"></i></a></td></tr>');
                }
                var taskli = response.tasklist;
                
                for (var i = 0; i < taskli.length; i++) {
                    $("#addtaskmeasureview").append('<tr><td>'+taskli[i].task_name+'</td><td>'+taskli[i].owners+'</td><td><span class="badge badge-pill badge-danger" style="background:'+taskli[i].bg_color+'">'+taskli[i].status_name+'</span></td><td><a href="javascript:void(0);" onclick="updateTask('+taskli[i].id+')"><i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i></a></td></tr>');
                }
                $("#viewLargePlot").html('<a href="javascript:void(0);" onclick="viewLargeGraph('+measureGraph(response.plucked_milestone,response.graph_labels,response.actual_graph_data,response.max_mile,response.pojected_graph_data,actual_color,target_color,projection_color)+')"><i class="iconsminds-maximize heading-icon"></i></a>');
            }
        })  
        $("#viewkpimodal").modal('show');
    }

    function updateKPI(id){
        $("#ownershipmeasureupdate").html("");
        $("#contributersupdatemeasure").html("");
        $("#measure_id_update").val(id);
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}"; 
        $.ajax({
            type:"POST",
            url: "{!!url('getMeasureonUpdatePage')!!}",
            data:'_token='+token+'&company_id='+company_id+'&measure_id='+id,
            dataType:'JSON',
            success: function (response) {
                var all_response = response.measures;
                $("#measure_confidence_level").val(all_response.confidence_level);
                $("#measure_status_id").val(all_response.status);
                $("#measure_title_update").val(all_response.heading);
                $("#objectiveIdupdatemeasure").val(all_response.objective_id);
                $("#measure_team_type_update").val(all_response.measure_team_type);
                $(".measure_target_updatehtml").html("Measure Target : $"+all_response.measure_target);
                $(".measure_target_updateval").val(all_response.measure_target);
                $('#measure_actual').val(all_response.measure_actual);
                $('#calculation_type').val(all_response.calculation_type);
                $("#measure_target_color").val(all_response.target_color);
                $("#actual_color_measure").val(all_response.actual_color);
                $("#measure_projection_color").val(all_response.projection_color);
                $("#measuretargetnew").val(all_response.measure_target_new);
                $("#measure_graph_type").val(all_response.measure_graph_type);
                var teamsmeasli = response.teams;
                var departmentmeasli = response.departments;
                var membermeasli = response.members;
                if(all_response.measure_team_type == "department"){
                    $("#depmeaactive").addClass('active');
                    $("#teammeaactive").removeClass('active');
                    $("#indimeaactive").removeClass('active');
                    $("#measure_department_id_update").val(all_response.measure_department_id);
                    for (var depart in departmentmeasli) {
                      if (departmentmeasli.hasOwnProperty(depart)) {
                        var dep = departmentmeasli[depart];
                        $("#ownershipmeasureupdate").append('<option value = "'+depart+'">'+dep+'</option>');                       
                     }
                    }
                    $("#ownershipmeasureupdate").val(all_response.measure_department_id);
                }else if(all_response.measure_team_type == "team"){
                    $("#depmeaactive").removeClass('active');
                    $("#teammeaactive").addClass('active');
                    $("#indimeaactive").removeClass('active');
                    $("#measure_team_id_update").val(all_response.measure_team_id);
                    for (var team in teamsmeasli) {
                      if (teamsmeasli.hasOwnProperty(team)) {
                        var tea = teamsmeasli[team];
                        if(all_response.measure_team_id == team){
                            $("#ownershipmeasureupdate").append('<option value = "'+team+'" selected="selected">'+tea+'</option>');
                        }else{
                            $("#ownershipmeasureupdate").append('<option value = "'+team+'">'+tea+'</option>');
                        }
                      }
                    }
                    $("#ownershipmeasureupdate").val(all_response.measure_team_id);
                }else{
                    $("#depmeaactive").removeClass('active');
                    $("#teammeaactive").removeClass('active');
                    $("#indimeaactive").addClass('active');
                    $("#owner_user_id_update").val(all_response.owner_user_id);
                    for (var member in membermeasli) {
                      if (membermeasli.hasOwnProperty(member)) {
                        var mem = membermeasli[member];
                        $("#ownershipmeasureupdate").append('<option value = "'+member+'">'+mem+'</option>');
                      }
                    }
                    $("#ownershipmeasureupdate").val(all_response.owner_user_id);
                }
                var selectedcontributers = all_response.contributers;
                $.ajax({
                    type:"POST",
                    url: "{!!url('/getcontributers')!!}",
                    data:'_token='+token+'&company_id='+company_id,
                    dataType:'JSON',
                    success: function (contributers) {
                        for (var contri in contributers) {
                          if (contributers.hasOwnProperty(contri)) {
                            var con = contributers[contri];
                            if(selectedcontributers && selectedcontributers.indexOf(contri) != -1){
                                $("#contributersupdatemeasure").append('<option value = "'+contri+'" selected="selected">'+con+'</option>');
                            }else{
                                $("#contributersupdatemeasure").append('<option value = "'+contri+'">'+con+'</option>');
                            }
                          }
                        }
                    }  
                });
            }
        })
              
        $("#myModalUpdateKPI").modal("show");
    }
     function addTask(){
        $("#typetaskid").val(3);
        $("#measuretaskid").val($("#measure_id_view").val());
        $("#myModalAddTask").modal("show");
    }
    function addmilestoneMeasureView(){
        $("#measure_id_measue_view").val($("#measure_id_view").val());
        $("#addMilestoneMeasureView").modal('show');
    }
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
    function updateTask(id){
        $("#update_task_id").val(id);
        $("#owners_update_id").html("");
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
				  // $("#task_status_id").val(taskdetails.status);
					//alert(taskdetails.status);
					$("#task_status_id option[value='"+taskdetails.status+"']").attr("selected", "selected");
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
     function updatemilestone(id){
        $("#milestone_id_measue_view").val(id);
       
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}"; 
        $.ajax({
            type:"POST",
            url: "{!!url('getmilestonedetails')!!}",
            data:'_token='+token+'&company_id='+company_id+'&milestone_id='+id,
            dataType:'JSON',
            success: function (response) {
                var milestone_data = response.milestone_data;
                $("#milestone_name_measure_view_id").val(milestone_data.milestone_name);
                $("#mile_actual_measure_view_id").val(milestone_data.mile_actual);
                $("#sys_target_measure_view_id").val(milestone_data.sys_target);
                var st_date = new Date(milestone_data.start_date);
                $("#start_date_measure_view_id").val((st_date.getMonth()+1)+'/'+st_date.getDate()+'/'+st_date.getFullYear());
                var en_date = new Date(milestone_data.end_date);
                $("#end_date_measure_view_id").val((en_date.getMonth()+1)+'/'+en_date.getDate()+'/'+en_date.getFullYear());
                $("#updateMilestoneMeasureView").modal("show");
            }
        });

    }
    </script>
        
<script type="text/javascript">
    function viewLargeGraph(){
        $("#viewLargeMeasureShow").modal('show');
    }
    $(document).ready(function(){
        $("#viewLargeMeasureHide").click(function(){
            $("#viewLargeMeasureShow").modal("hide");
        });
    });
</script>
    @stop