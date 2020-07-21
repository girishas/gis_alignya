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


<?php $__env->startSection('content'); ?>
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('Initiatives'); ?></h1>
                    <div class="text-zero top-right-button-container">
                        <a href="javascript:void(0);" class=" btn btn-primary btn-sm top-right-button mr-1" id="add_objectiveBtn"><?php echo getLabels('add_initiative'); ?></a>
                        <button type="button" class="btn btn-outline-primary mb-1" onclick="filter()">Filters</button>

                    </div>
                    <?php echo $__env->make('Element/initiative/filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/initiative/add_initiative', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/initiative/view_initiative', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/initiative/add_milestone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/initiative/update_milestone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/initiative/update_initiative', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/measure/task', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('Initiatives'); ?></li>
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
                                                    $remove_url = url("initiative/remove/".$value->id); 
                                                    $remove_msg = getLabels('are_you_sure'); ?>
                                                <tr>
                                                    <td><a href="javascript:void(0);" onclick="view_initiativepop('<?php echo $value->id; ?>')"> <i class="<?php echo $value->status_icon; ?> heading-icon" style="color:<?php echo $value->bg_color; ?>;"></i><?php echo $value->heading; ?></td>
                                                    <td>FY<?php echo $value->measure_cycle_year; ?>-<?php echo config('constants.Quarter.'.$value->measure_cycle_quarter); ?></td>
                                                    <td> <?php echo $value->owner_name; ?></td>
                                                    <td> <span class="badge badge-pill badge-success" style="background-color: <?php echo $value->bg_color; ?>"><?php echo $value->status_name; ?></span></td>
                                                    <td> <?php echo $value->parent_objective; ?></td>
                                                    <td>
                                                          <a  href="javascript:void(0);" onclick="updateinitiative('<?php echo $value->id; ?>')"><i class="simple-icon-pencil heading-icon"></i></a>
                                                          <a href="javascript:void(0);" onclick="view_initiativepop('<?php echo $value->id; ?>')"> <i class="iconsminds-information heading-icon" ></i>
                                                            <a onclick = 'showConfirmationModal("Remove", "<?php echo $remove_msg; ?>", "<?php echo $remove_url; ?>");' href="javascript:void(0);"><i class="simple-icon-trash heading-icon"></i></a>
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
    function filter(){
        $("#filterPop").modal("show");
    }
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
        $("#contriiniupdate").html("");
        var company_id = "<?php echo Auth::User()->company_id; ?>"; 
        var token = "<?php echo csrf_token(); ?>";
        $.ajax({
            type:"POST",
            url: "<?php echo url('getInitiativeData'); ?>",
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
                    url: "<?php echo url('/getcontributers'); ?>",
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
                $("#initiative_status_id").val(response.initiatives.status);
            }
        })

        $("#myModalUpdateInitiative").modal('show');
    }

    function updatemilestoneini(id){
        $("#ini_idformilestoneup").val($("#viewpageinitiativeid").val());
        $("#milestone_id_ini").val(id);
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>"; 
        $.ajax({
            type:"POST",
            url: "<?php echo url('getmilestonedata'); ?>",
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
        $(".is_popup").val(1);
        localStorage.setItem('popup_id',id);
        $("#viewpageinitiativeid").val(id);
        $("#initiativemilestonelist").html("");
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>"; 
         $.ajax({
            type:"POST",
            url: "<?php echo url('getInitiativeData'); ?>",
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
                    $("#initiativetasklistview").append('<tr><td>'+response.tasklist[i].task_name+'</td><td>'+response.tasklist[i].owners+'</td><td><span class="badge badge-pill badge-danger" style="background-color:'+response.tasklist[i].bg_color+'">'+response.tasklist[i].status_name+'</span></td><td><a href="javascript:void(0);" onclick="updateTask('+response.tasklist[i].id+')"> <i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i></a></td></tr>');

                }
            }
        })
        
        $("#viewinitiativemodal").modal('show');
     }
$(document).ready(function(){
    var inimessage = "<?php echo session('inimessage')?session('inimessage'):''; ?>";
    if(inimessage != ""){
        showNotificationApp('top', 'right', 'primary', 'success', '<?php echo session("inimessage"); ?>');
    }
    $("#hideFilter").click(function(){
        $("#filterPop").modal('hide');
    });
    var popup_content_message = "<?php echo session('popup_content_message')?session('popup_content_message'):''; ?>";
    if(popup_content_message != ""){
        view_initiativepop(localStorage.getItem('popup_id'));
    }
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
  $("#viewinitiativemodalhide").click(function(){
    $("#viewinitiativemodal").modal('hide');
  });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>