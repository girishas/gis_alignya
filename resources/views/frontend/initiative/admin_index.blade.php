@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>
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

<!-- Chart code -->
<script>

</script>
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Initiatives') !!}</h1>
                    <div class="text-zero top-right-button-container">
                        <a href="javascript:void(0);" class=" btn btn-primary btn-sm top-right-button mr-1" id="add_objectiveBtn">{!! getLabels('add_initiative') !!}</a>
                    </div>
                    
  <!-- Modal -->
                           @include('Element/initiative/add_initiative')
                           @include('Element/initiative/view_initiative')
                           @include('Element/initiative/add_milestone')
                           @include('Element/initiative/update_milestone')
                           @include('Element/initiative/update_initiative')
                           @include('Element/measure/task')
                            <div class="modal modal-right" id="myModal1" role="dialog" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Task</h5>
                                            <button type="button" class="close" id="popup2hide" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <form>
                                                <div class="container-fluid">
                                                <div class="row">
                                                    
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                                
                                                    <div class="form-group ">
                                                                              <label>Due Date</label>
                                                                          <input class="form-control datepicker" placeholder="">
                                                        <div class="invalid-tooltip"></div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <button type="button" class="btn btn-primary">Submit</button>
                                                                    
                                                        <div class="invalid-tooltip"></div>
                                                    </div>

                                                </div>
                                               
                                                </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Initiatives') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4">{!! getLabels('Search') !!}</h5>
                            {!! Form::open(array('url' => array($route_prefix.'/teams'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')) !!}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                {!! Form::text('team_name', isset($_POST['team_name'])?trim($_POST['team_name']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_name')))!!}
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3">               
                                            <button class="btn btn-primary mb-1" type="submit">{!! getLabels('Search') !!}</button>
                                            <a class="btn btn-dark mb-1 steamerst_link" href="{!! url($route_prefix, 'teams') !!}">{!! getLabels('show_all') !!}</a>
                                        </div>
                                    </div>
                                </div>
                            {!!Form::close()!!}
                        </div>
                    </div>
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
                                            <th> {!! getLabels('Cycle') !!} </th>
                                            <th> {!! getLabels('Owner') !!} </th>
                                            <th> {!! getLabels('Status') !!} </th>
                                            <th> {!! getLabels('Objective') !!} </th>
                                            <th> {!! getLabels('action') !!} </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(!$data->isEmpty())
                                    @foreach($data as $key => $value)
                                                <?php
                                                    $remove_url = url("initiative/remove/".$value->id); 
                                                    $remove_msg = getLabels('are_you_sure'); ?>
                                                <tr>
                                                    <td><a href="javascript:void(0);" onclick="view_initiativepop('{!!$value->id!!}')"> <i class="{!!$value->status_icon!!} heading-icon" style="color:{!!$value->bg_color!!};"></i>{!!$value->heading!!}</td>
                                                    <td>FY{!!$value->measure_cycle_year!!}-{!!config('constants.Quarter.'.$value->measure_cycle_quarter)!!}</td>
                                                    <td> {!!$value->owner_name!!}</td>
                                                    <td> <span class="badge badge-pill badge-success" style="background-color: {!!$value->bg_color!!}">{!!$value->status_name!!}</span></td>
                                                    <td> {!!$value->parent_objective!!}</td>
                                                    <td>
                                                        <div class="btn-group float-none-xs">
                                                            <button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                {!! getLabels('action') !!}
                                                            </button>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
                                                                <a class=" dropdown-item" href="javascript:void(0);" onclick="updateinitiative('{!!$value->id!!}')">{!! getLabels('edit') !!}</a>
                                                            <a class="dropdown-item" onclick = 'showConfirmationModal("Remove", "{!! $remove_msg !!}", "{!! $remove_url !!}");' href="javascript:void(0);">{!! getLabels('remove') !!}</a>
                                                            </div>
                                                        </div>
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
    function updateinitiative(id){
        $("#initiative_update_id").val(id);
        $("#ownershipinitiativeupdate").html("");
        var company_id = "{!!Auth::User()->company_id!!}"; 
        var token = "{!!csrf_token()!!}";
        $.ajax({
            type:"POST",
            url: "{!!url('getInitiativeData')!!}",
            data:'_token='+token+'&company_id='+company_id+'&id='+id,
            dataType:'JSON',
            success: function (response) {
                $("#iniheading_update").val(response.initiatives.heading);
                $("#initiative_team_type_update").val(response.initiatives.measure_team_type);
                $("#initiative_objectiveId_update").val(response.initiatives.objective_id);
                onchangeobjectivegetcycleinitiativeupdate("FY"+response.initiatives.measure_cycle_year+"-"+getQuarter(response.initiatives.measure_cycle_quarter));
                $("#initiativeCycleUpdate").val("FY"+response.initiatives.measure_cycle_year+"-"+getQuarter(response.initiatives.measure_cycle_quarter));
                var teamsmeasli = response.teams;
                var departmentmeasli = response.departments;
                var membermeasli = response.members;
                if(response.initiatives.measure_team_type == "department"){
                    $("#deptiniuactive").addClass('active');
                    $("#teaminiuactive").removeClass('active');
                    $("#indiviniuactive").removeClass('active');
                    $("#initiative_department_id_update").val(response.initiatives.measure_department_id);
                    for (var depart in departmentmeasli) {
                      if (departmentmeasli.hasOwnProperty(depart)) {
                        var dep = departmentmeasli[depart];
                        $("#ownershipinitiativeupdate").append('<option value = "'+depart+'">'+dep+'</option>');                       
                     }
                    }
                    $("#ownershipinitiativeupdate").val(response.initiatives.measure_department_id);
                }else if(response.initiatives.measure_team_type == "team"){
                    $("#deptiniuactive").removeClass('active');
                    $("#teaminiuactive").addClass('active');
                    $("#indiviniuactive").removeClass('active');
                    $("#initiative_team_id_update").val(response.initiatives.measure_team_id);
                    for (var team in teamsmeasli) {
                      if (teamsmeasli.hasOwnProperty(team)) {
                        var tea = teamsmeasli[team];
                        if(response.initiatives.measure_team_id == team){
                            $("#ownershipinitiativeupdate").append('<option value = "'+team+'" selected="selected">'+tea+'</option>');
                        }else{
                            $("#ownershipinitiativeupdate").append('<option value = "'+team+'">'+tea+'</option>');
                        }
                      }
                    }
                    $("#ownershipinitiativeupdate").val(response.initiatives.measure_team_id);
                }else{
                    $("#deptiniuactive").removeClass('active');
                    $("#teaminiuactive").removeClass('active');
                    $("#indiviniuactive").addClass('active');
                    $("#initiative_owner_user_id_update").val(response.initiatives.owner_user_id);
                    for (var member in membermeasli) {
                      if (membermeasli.hasOwnProperty(member)) {
                        var mem = membermeasli[member];
                        $("#ownershipinitiativeupdate").append('<option value = "'+member+'">'+mem+'</option>');
                      }
                    }
                    $("#ownershipinitiativeupdate").val(response.initiatives.owner_user_id);
                }
                var selectedcontributers = response.initiatives.contributers;
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
                                $("#contriiniupdate").append('<option value = "'+contri+'" selected="selected">'+con+'</option>');
                            }else{
                                $("#contriiniupdate").append('<option value = "'+contri+'">'+con+'</option>');
                            }
                          }
                        }
                    }  
                });
            }
        })

        $("#myModalUpdateInitiative").modal('show');
    }

    function updatemilestoneini(id){
        $("#ini_idformilestoneup").val($("#viewpageinitiativeid").val());
        $("#milestone_id_ini").val(id);
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}"; 
        $.ajax({
            type:"POST",
            url: "{!!url('getmilestonedata')!!}",
            data:'_token='+token+'&company_id='+company_id+'&id='+id,
            dataType:'JSON',
            success: function (response) {
                $("#milestonenameini").val(response.milestone_name);
                var sdate = new Date(response.start_date);
                var edate = new Date(response.end_date);
                $('#start_date_ini').val((sdate.getMonth()+1)+'/'+sdate.getDate()+'/'+sdate.getFullYear());
                $('#end_date_ini').val((edate.getMonth()+1)+'/'+edate.getDate()+'/'+edate.getFullYear());
                console.log(response)
            }
        })
        $("#updatemilestoneini").modal("show");
    }
     function view_initiativepop(id){
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
                    $("#initiativetasklistview").append('<tr><td>'+response.tasklist[i].task_name+'</td><td>'+response.tasklist[i].owners+'</td><td><span class="badge badge-pill badge-danger" style="background-color:'+response.tasklist[i].bg_color+'">'+response.tasklist[i].status_name+'</span></td><td><i class="iconsminds-right-1 heading-icon" style="cursor: pointer;"></i> <i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i>&nbsp;&nbsp;&nbsp; <i class="simple-icon-trash" style="font-size: initial;cursor: pointer;"></i></td></tr>');

                }
            }
        })
        
        $("#myModal").modal('show');
     }
$(document).ready(function(){
  $("#popupaddhideinitiativeupdate").click(function(){
    $("#myModalUpdateInitiative").modal('hide');
  });
   $("#add_objectiveBtn").click(function(){
    $(".hideindivi").attr('id','');
    $("#myModalAddInitiative").modal('show');
  });

  $("#myBtn1").click(function(){
    $("#myModal1").modal('show');
  });
   $("#myBtn2").click(function(){
    $("#ini_idformilestone").val($("#viewpageinitiativeid").val());
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
   $("#popup3hideupdate").click(function(){
    $("#updatemilestoneini").modal('hide');
  });
  $("#popupaddhideinitiative").click(function(){
    $("#myModalAddInitiative").modal('hide');
  });
  $("#popupaddhideTask").click(function(){
    $("#myModalAddTask").modal("hide");
  });
});
</script>
@stop