    
    <?php use App\Traits\SortableTrait;  ?>

    <?php $__env->startSection('content'); ?>
    <?php echo $__env->make('Element/measure/view_measure', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Element/measure/add_measure', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Element/measure/update_measure', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Element/measure/update_milestone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Element/measure/add_milestone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Element/measure/task', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Element/measure/update_task', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('frontend/measures/filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <main>
    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
    <h1><?php echo getLabels('Measures'); ?></h1>
    <div class="text-zero top-right-button-container">
    <a href="javascript:void(0);" class=" btn btn-primary btn-sm top-right-button mr-1" id="add_objectiveBtn"><?php echo getLabels('add_measure'); ?></a>
    <button type="button" class="btn btn-outline-primary mb-1" id="filterBtn">Filters</button>
    </div>
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
    <ol class="breadcrumb pt-0">
    <li class="breadcrumb-item">
        <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
    </li>

    <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('Measures'); ?></li>
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
                   <th> <?php echo getLabels('Name'); ?> </th>
                    <th> <?php echo getLabels('Cycle'); ?> </th>
                    <th> <?php echo getLabels('Owner'); ?> </th>
                    <th> <?php echo getLabels('Status'); ?> </th>
                    <th> <?php echo getLabels('Objective'); ?> </th>
                    <th> <?php echo getLabels('action'); ?> </th>
                </tr>
            </thead>
            <tbody>
                        <?php if(!$data->isEmpty()): ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $remove_url = url("measure/remove/".$value->id); 
                            $remove_msg = getLabels('are_you_sure'); ?>
                        <tr>
                            <td><a href="javascript:void(0);" onclick="viewMeasure('<?php echo $value->id; ?>')"><i class="<?php echo $value->status_icon; ?> heading-icon" style="color:<?php echo $value->bg_color; ?>"></i><?php echo $value->heading; ?></td>
                            <td> FY<?php echo $value->measure_cycle_year; ?>-<?php echo config('constants.Quarter.'.$value->measure_cycle_quarter); ?></td>
                            <td> <?php echo $value->owner_name; ?></td>
                            <td> <span class="badge badge-pill badge-success" style="background: <?php echo $value->bg_color; ?>"><?php echo $value->status_name; ?></span></td>
                            <td><?php echo $value->parent_objective; ?></td>
                            <td>
                                <a href="javascript:void(0);" onclick="updateMeasure('<?php echo $value->id; ?>')"><i class="simple-icon-pencil heading-icon"></i></a>
                                    <a onclick = 'showConfirmationModal("Remove", "<?php echo $remove_msg; ?>", "<?php echo $remove_url; ?>");' href="javascript:void(0);"><i class="heading-icon simple-icon-trash"></i></a>
                                    <a href="javascript:void(0);" onclick="viewMeasure('<?php echo $value->id; ?>')"><i class="iconsminds-information heading-icon"></i>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                       
            </tbody>
        </table>
    </div>
    <br />

    <div class="row">
        <div class="col-12 text-center">
            <p class="justify-content-center "><?php echo str_replace(array('{FIRST}', '{LAST}', '{TOTAL}'), array($data->firstItem(), $data->lastItem(), $data->total()), getLabels('showing_first_to_last_of_total_records')); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php echo $data->links('frontend.pagination_custom'); ?>

        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </main>


    <script>
    function areaMeasureGraph(){
        if (document.getElementById("measuregraph")) {
            var areaChartNoShadow = document
              .getElementById("measuregraph")
              .getContext("2d");
            var myChart = new Chart(areaChartNoShadow, {
              type: "line",
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
                        stepSize: 5,
                        min: 50,
                        max: 70,
                        padding: 0
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
                tooltips: chartTooltip
              },
              data: {
                labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                datasets: [
                  {
                    label: "",
                    data: [54, 63, 60, 65, 60, 68, 60],
                    borderColor: themeColor1,
                    pointBackgroundColor: foregroundColor,
                    pointBorderColor: themeColor1,
                    pointHoverBackgroundColor: themeColor1,
                    pointHoverBorderColor: foregroundColor,
                    pointRadius: 4,
                    pointBorderWidth: 2,
                    pointHoverRadius: 5,
                    fill: true,
                    borderWidth: 2,
                    backgroundColor: themeColor1_10
                  }
                ]
              }
            });
          }
    }
    function updateTask(id){
        $("#update_task_id").val(id);
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>";
        $.ajax({
            type:"POST",
            url: "<?php echo url('getTaskDetails'); ?>",
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
function measureGraph(target_data,labels,actual_data,max_value,projection_data){
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
          borderColor: "red",
       
          pointBorderColor: "red",
          pointHoverBackgroundColor: "red",
         
          pointRadius: 4,
          pointBorderWidth: 2,
          pointHoverRadius: 5,
          fill: false
        },
        {
          borderWidth: 2,
          label: "",
          data: actual_data,
          borderColor: "blue",
       
          pointBorderColor: "blue",
          pointHoverBackgroundColor: "blue",
         
          pointRadius: 4,
          pointBorderWidth: 2,
          pointHoverRadius: 5,
          fill: false
        },
        {
          borderWidth: 2,
          label: "",
          data: projection_data,
          borderColor: "yellow",
       
          pointBorderColor: "yellow",
          pointHoverBackgroundColor: "yellow",
         
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

    $(document).ready(function(){
        var adderrormessage = "<?php echo session('adderrormessage')?session('adderrormessage'):''; ?>";
            if(adderrormessage != ''){
                $("#myModalAddMeasure").show();
            }
        var is_popup_content = "<?php echo session('popup_content_message')?session('popup_content_message'):''; ?>";
        if(is_popup_content != ""){
            viewMeasure(localStorage.getItem('popup_id'));
        }
    
    $("#add_objectiveBtn").click(function(){
        $(".removeattr").attr('id','');
    $("#myModalAddMeasure").modal('show');
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
    $("#view_measuremodal_hide").click(function(){
    $("#viewmeasuremodal").modal('hide');
    });
    $("#popup2hide").click(function(){
    $("#myModal1").modal('hide');
    });
    $("#addMilestoneMeasureViewHide").click(function(){
    $("#addMilestoneMeasureView").modal('hide');
    });
    $("#popupaddhideMeasure").click(function(){
    $("#myModalAddMeasure").modal('hide');
    });
    $("#popupaddhideUpdateMeasure").click(function(){
        $("#myModalUpdateMeasure").modal('hide');
    });
    $("#updateMilestoneMeasureViewHide").click(function(){
        $("#updateMilestoneMeasureView").modal("hide");
    });
    $("#popupaddhideTask").click(function(){
        $("#myModalAddTask").hide();
    });
    $("#view_measuremodal_hide").click(function(){
    $("#viewmeasuremodal").modal("hide");
});
    });
    </script>
<script type="text/javascript">
    
    function addTask(){
        $("#typetaskid").val(1);
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
    function updatemilestone(id){
        $("#milestone_id_measue_view").val(id);
       
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>"; 
        $.ajax({
            type:"POST",
            url: "<?php echo url('getmilestonedetails'); ?>",
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
    function viewMeasure(id){
        $(".is_popup").val(1);
        localStorage.setItem('popup_id',id);
        $("#measure_id_view").val(id);
        $("#view_measure_heading").html("");
        $("#milestonelistmeasureview").html("");
        $("#addtaskmeasureview").html("");
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>"; 
        $.ajax({
            type:"POST",
            url: "<?php echo url('getMeasureonUpdatePage'); ?>",
            data:'_token='+token+'&company_id='+company_id+'&measure_id='+id,
            dataType:'JSON',
            success: function (response) {
                measureGraph(response.plucked_milestone,response.graph_labels,response.actual_graph_data,response.max_mile,response.pojected_graph_data);
                
                var all_response = response.measures;
                $("#view_measure_heading").html('<i class="'+all_response.status_icon+' heading-icon" style="color:'+all_response.bg_color+';"></i>'+all_response.heading+' <a href="javascript:void(0);" onclick="updateMeasure('+all_response.id+')"><i class="simple-icon-pencil"></i></a><p class="text-muted mb-0 text-small" style="margin-left: 35px;"><i class="simple-icon-clock"></i> FF'+all_response.measure_cycle_year+'-'+getQuarter(all_response.measure_cycle_quarter)+'  <i class="simple-icon-people"></i> '+all_response.owner_name );
                var milstonesli = response.milestones;
                for (var i = 0; i < milstonesli.length; i++) {
                    $("#milestonelistmeasureview").append('<tr><td>'+milstonesli[i].milestone_name+'</td><td>'+(milstonesli[i].mile_actual == null?"":milstonesli[i].mile_actual)+'</td><td>'+milstonesli[i].sys_target+'</td><td>'+milstonesli[i].start_date+'</td><td>'+milstonesli[i].end_date+'</td><td><a href="javascript:void(0);" onclick="updatemilestone('+milstonesli[i].id+')"><i class="simple-icon-pencil"></i></a></td></tr>');
                }
                var taskli = response.tasklist;
                for (var i = 0; i < taskli.length; i++) {
                    $("#addtaskmeasureview").html('<tr><td>'+taskli[i].task_name+'</td><td>'+taskli[i].owners+'</td><td><span class="badge badge-pill badge-danger" style="background:'+taskli[i].bg_color+'">'+taskli[i].status_name+'</span></td><td><a href="javascript:void(0);" onclick="updateTask('+taskli[i].id+')"><i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i></a>&nbsp;&nbsp;&nbsp; <i class="simple-icon-trash" style="font-size: initial;cursor: pointer;"></i></td></tr>');
                }
                $("#viewLargePlot").html('<a href="javascript:void(0);" onclick="viewLargeGraph('+measureGraph(response.plucked_milestone,response.graph_labels,response.actual_graph_data,response.max_mile,response.pojected_graph_data)+')"><i class="iconsminds-maximize heading-icon"></i></a>');
            }
        })  
        $("#viewmeasuremodal").modal('show');
    }
    function updateMeasure(id){
        $("#ownershipmeasureupdate").html("");
        $("#measure_id_update").val(id);
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>"; 
        $.ajax({
            type:"POST",
            url: "<?php echo url('getMeasureonUpdatePage'); ?>",
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
                    url: "<?php echo url('/getcontributers'); ?>",
                    data:'_token='+token+'&company_id='+company_id,
                    dataType:'JSON',
                    success: function (contributers) {
                        for (var contri in contributers) {
                          if (contributers.hasOwnProperty(contri)) {
                            var con = contributers[contri];
                            if(selectedcontributers.indexOf(contri) != -1){
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
              
        $("#myModalUpdateMeasure").modal("show");
    }
    $("#popupaddhideUpdateMeasure").modal("hide");
</script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>