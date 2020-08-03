<script>
  $(document).ready(function(){
    
  
$("body").on('submit', ".alignya_form", function(e) {
        $("div.invalid-tooltip").css("display",'none');
    e.preventDefault();
    
    var form_action = $(this).attr('action');
    data = $(this).serialize();
    
   
    $.ajax({
        type:"POST",
        url: form_action,
        data:data,
        beforeSend: function(){
            $('body').addClass('show-spinner');
        },
        success: function (response) {
            if(response.type == 'error'){
                errors = response.error;
                $.each(errors, function(key,value) {
                    $('input[name="'+key+'"]').next('div.invalid-tooltip').css('display', 'block');
                    $('input[name="'+key+'"]').next('div.invalid-tooltip').html(value[0]);
                    $('select[name="'+key+'"]').next('div.invalid-tooltip').css('display', 'block');
                    $('select[name="'+key+'"]').next('div.invalid-tooltip').html(value[0]);
                    $('.summernote_'+key).css('display', 'block');
                    $('.summernote_'+key).html(value[0]);
                    $('textarea[name="'+key+'"]').next('div.invalid-tooltip').css('display', 'block');
                    $('textarea[name="'+key+'"]').next('div.invalid-tooltip').html(value[0]);
                });
                showNotificationApp('top', 'right', 'danger', 'Error', response.message);
            }else if(response.type == 'success'){
                pageUrl = response.url;
                var lastslashindex = pageUrl.lastIndexOf('/');
                var resultName= pageUrl.substring(lastslashindex  + 1);
                $('#myModalAddObjective').modal('hide');
                $('#updateobjectivemodal').modal('hide');
                $('#myModalAddMeasure').modal('hide');
                $('#myModalUpdateMeasure').modal('hide');
                $('#myModalAddInitiative').modal('hide');
                $('#myModalAddKPI').modal('hide');
                $('#myModalUpdateKPI').modal('hide');
                $('#myModalUpdateInitiative').modal('hide');
                $('#updateMilestoneMeasureView').modal('hide');
                $('#myModalAddTask').modal('hide');
                $('#myModalUpdateTask').modal('hide');
                $('#updatemilestoneini').modal('hide');
                $('#addMilestoneMeasureView').modal('hide');
                $('#myModal2').modal('hide');
                
                $("form").trigger("reset");
                if(pageUrl == "close_modal"){
                    if(response.popup_name == "objective"){
                       // $("form.alignya_form .select2-multiple").val(null).trigger('change');
                        viewobjective(localStorage.getItem('popup_id'));
                    }else if(response.popup_name == "measures"){
                        if(window.location.href.indexOf('objectives') !== -1){
                      viewobjective(localStorage.getItem('popup_id'));
                      }else if(window.location.href.indexOf('measures') !== -1){
                          viewMeasure(localStorage.getItem('popup_id'));
                      }else if(window.location.href.indexOf('initiatives') !== -1){
                          view_initiativepop(localStorage.getItem('popup_id'));
                      }
                    }else if(response.popup_name == "initiative"){
                        view_initiativepop(localStorage.getItem('popup_id'));
                    }

                    return false;
                }else{
                    window.location.reload();
                }
                
                $.cergis.loadContent();
                e.preventDefault();
                if(response.message){
                    showNotificationApp('top', 'right', 'primary', 'Success', response.message);
                }
                $('.slim-popover').remove();
                
                $('html,body').animate({
                    scrollTop: $("html").offset().top
                }, 'fast');
            }
            $('body').removeClass("show-spinner");
            
        },
         error: function(xhr, ajaxOptions, thrownError) {
          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});
})

function getContributers(){
    var token = "{!!csrf_token()!!}";
    $.ajax({
        type:"POST",
        url: "{!!url('/getcontributersforobjective')!!}",
        data:'_token='+token,
        dataType:'JSON',
        success: function (response) {
            for (var con in response) {
                    if (response.hasOwnProperty(con)) {
                        var contri = response[con];
                        $("#contributersadd").append('<option value = "'+con+'">'+contri+'</option>');
                    }
            }
        }  
    });
}
// add objective popup

function addObjectivepop(slug){
    $("#contributersadd").html("");
    if(slug == "sub"){
        var heading = "Add Sub Objective";
        $("#addobjectiven").html(heading);
        var parobjeid = $("#objective_idview").val();
        $("#parent_objective_id").val(parobjeid);
    }else{
        var heading = "Add Objective";
        $("#addobjectiven").html(heading);
    }
    var token = "{!!csrf_token()!!}";
    $.ajax({
        type:"POST",
        url: "{!!url('/getcontributersforobjective')!!}",
        data:'_token='+token,
        dataType:'JSON',
        success: function (response) {
            for (var con in response) {
                    if (response.hasOwnProperty(con)) {
                        var contri = response[con];
                        $("#contributersadd").append('<option value = "'+con+'">'+contri+'</option>');
                    }
            }
            $("#myModalAddObjective").modal('show');
        }  
    });
   
}

// view measure

function viewMeasure(id){

    $(".is_popup").val(1);
    localStorage.setItem('popup_id',id);
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
            measureGraph(response.plucked_milestone,response.graph_labels,response.actual_graph_data,response.max_mile,response.pojected_graph_data);
            
            var all_response = response.measures;
            // if(window.location.href.indexOf('objective') !== -1){
            //    $("#view_measure_heading").html('<i class="'+all_response.status_icon+' heading-icon" style="color:'+all_response.bg_color+';"></i>'+all_response.heading+'<p class="text-muted mb-0 text-small" style="margin-left: 35px;"><i class="simple-icon-clock"></i> FF'+all_response.measure_cycle_year+'-'+getQuarter(all_response.measure_cycle_quarter)+'  <i class="simple-icon-people"></i> '+all_response.owner_name );
            // }else{
               $("#view_measure_heading").html('<i class="'+all_response.status_icon+' heading-icon" style="color:'+all_response.bg_color+';"></i>'+all_response.heading+' <a href="javascript:void(0);" onclick="updateMeasure('+all_response.id+')"><i class="simple-icon-pencil"></i></a><p class="text-muted mb-0 text-small" style="margin-left: 35px;"><i class="simple-icon-clock"></i> FF'+all_response.measure_cycle_year+'-'+getQuarter(all_response.measure_cycle_quarter)+'  <i class="simple-icon-people"></i> '+all_response.owner_name );
            // }
           
            var milstonesli = response.milestones;
            // if(window.location.href.indexOf('objective') !== -1){
            //   for (var i = 0; i < milstonesli.length; i++) {
            //       $("#milestonelistmeasureview").append('<tr><td>'+milstonesli[i].milestone_name+'</td><td>'+(milstonesli[i].mile_actual == null?"":milstonesli[i].mile_actual)+'</td><td>'+milstonesli[i].sys_target+'</td><td>'+milstonesli[i].start_date+'</td><td>'+milstonesli[i].end_date+'</td></tr>');
            //   }
            // }else{
              for (var i = 0; i < milstonesli.length; i++) {
                  $("#milestonelistmeasureview").append('<tr><td>'+milstonesli[i].milestone_name+'</td><td>'+(milstonesli[i].mile_actual == null?"":milstonesli[i].mile_actual)+'</td><td>'+milstonesli[i].sys_target+'</td><td>'+milstonesli[i].start_date+'</td><td>'+milstonesli[i].end_date+'</td><td><a href="javascript:void(0);" onclick="updatemilestone('+milstonesli[i].id+')"><i class="simple-icon-pencil"></i></a></td></tr>');
              }
            // }
            var taskli = response.tasklist;
            for (var i = 0; i < taskli.length; i++) {
                $("#addtaskmeasureview").append('<tr><td>'+taskli[i].task_name+'</td><td>'+taskli[i].owners+'</td><td><span class="badge badge-pill badge-danger" style="background:'+taskli[i].bg_color+'">'+taskli[i].status_name+'</span></td><td><a href="javascript:void(0);" onclick="updateTask('+taskli[i].id+')"><i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i></a>&nbsp;&nbsp;&nbsp; <i class="simple-icon-trash" style="font-size: initial;cursor: pointer;"></i></td></tr>');
            }
            $("#viewLargePlot").html('<a href="javascript:void(0);" onclick="viewLargeGraph('+measureGraph(response.plucked_milestone,response.graph_labels,response.actual_graph_data,response.max_mile,response.pojected_graph_data)+')"><i class="iconsminds-maximize heading-icon"></i></a>');

            $("#viewmeasuremodal").modal('show');
        }
    })  
    
}

// measureGraph
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
              stepSize: max_value/10,
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

  if (document.getElementById("linechartformeasureobj")) {
    var contributionChart1 = new Chart(
      document.getElementById("linechartformeasureobj").getContext("2d"),
      contributionChartOptions
    );
  }
}

// Update Milestone 
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

// add milestones
  function addmilestoneMeasureView(){
      $("#measure_id_measue_view").val($("#measure_id_view").val());
      $("#addMilestoneMeasureView").modal('show');
  }

// update measures

function updateMeasure(id){
        $("#ownershipmeasureupdate").html("");
        $("#measure_id_update").val(id);
        $("#contributersupdatemeasure").html("");
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
                $(".measure_target_updatehtml").html("Measure Target : "+all_response.measure_target+all_response.measure_unit);
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
              
        $("#myModalUpdateMeasure").modal("show");
    }

    // chart loadContent

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

    // view myModalAddInitiative

    function view_initiativepop(id){
        $(".is_popup").val(1);
        localStorage.setItem('popup_id',id);
        $("#viewpageinitiativeid").val(id);
        $("#initiativemilestonelist").html("");
        $("#initiativetasklistview").html("");
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
				        remove_msg = 'Are you sure?';
                for(var i = 0; i < response.milestones.length; i++){
					          remove_url = '{!!url("milestone/remove/'+response.milestones[i].id+'")!!}';
                    $("#initiativemilestonelist").append('<tr><td>'+response.milestones[i].name+'</td><td>'+response.milestones[i].fromDate+'</td><td>'+response.milestones[i].toDate+'</td><td><a href="javascript:void(0);" onclick="updatemilestoneini('+response.milestones[i].id+')"><i class="heading-icon simple-icon-pencil"></i></a>  <a onclick = \'showDeleteConfirmationModal("Remove", "'+ remove_msg +'", "'+ remove_url +'");\' href="javascript:void(0);"><i class="heading-icon simple-icon-trash"></i></a></td></tr>');

                }
                for(var i = 0; i < response.tasklist.length; i++){
                    remove_url = '{!!url("tasks/remove/'+response.tasklist[i].id+'")!!}';
                    $("#initiativetasklistview").append('<tr><td>'+response.tasklist[i].task_name+'</td><td>'+response.tasklist[i].owners+'</td><td><span class="badge badge-pill badge-danger" style="background-color:'+response.tasklist[i].bg_color+'">'+response.tasklist[i].status_name+'</span></td><td><a href="javascript:void(0);" onclick="updateTask('+response.tasklist[i].id+')"> <i class="heading-icon simple-icon-pencil" style="cursor: pointer;"></i></a> <a onclick = \'showDeleteConfirmationModal("Remove", "'+ remove_msg +'", "'+ remove_url +'");\' href="javascript:void(0);"><i class="heading-icon simple-icon-trash"></i></a></td></tr>');

                }
            }
        })
        
        $("#viewinitiativemodal").modal('show');
    }

    // update initiative

    function updateinitiative(id){
        $("#initiative_update_id").val(id);
        $("#ownershipinitiativeupdate").html("");
        $("#contriiniupdate").html("");
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
                            if(selectedcontributers && selectedcontributers.indexOf(contri) != -1){
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


    // add Task

    function addTask(slug=null){
        if(slug == 'initiative'){
          $("#typetaskid").val(2);
          $("#measuretaskid").val($("#viewpageinitiativeid").val());
        }else{
          $("#typetaskid").val(1);
          $("#measuretaskid").val($("#measure_id_view").val());
        }
          $("#myModalAddTask").modal("show");
       
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

    function addinimilestone(){
      $("#ini_idformilestone").val($("#viewpageinitiativeid").val());
          $("#myModal2").modal('show');
    }
    $(document).ready(function(){
        $("#popupaddhideUpdateMeasure").click(function(){
            $("#myModalUpdateMeasure").modal('hide');
        });
        $("#popupaddhideinitiativeupdate").click(function(){
            $("#myModalUpdateInitiative").modal('hide');
        });
        $("#popupaddhideupdateTask").click(function(){
          $("#popupaddhideTask").modal('hide');
        });
        $("#updateMilestoneMeasureViewHide").click(function(){
          $("#updateMilestoneMeasureView").modal('hide');
        });
        $("#popupaddhideinitiative").click(function(){
          $("#myModalAddInitiative").modal('hide');
          window.location.reload(true);
        });
        
    })
    function onchangeobjectivegetcycle(){
       
        var objective_id =  $("#objectiveId").val();
        var token = "{!!csrf_token()!!}";
        var company_id = "{!!Auth::User()->company_id!!}";
        $("#measureCycle").html("");
        $.ajax({
            type:"POST",
            url: "{!!url('getMeasureCycles')!!}",
            data:'_token='+token+'&company_id='+company_id+'&objective_id='+objective_id,
            dataType:'JSON',
            success: function (response) {
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#measureCycle").append('<option value = "'+val+'">'+val+'</option>');
                  }
                }
            }  
        });
    }


    // delete popup JSON

$("body").on('click', ".alignya_status", function(e) {
  $('.modal').modal('hide');
  pageUrl = $(this).attr('href');
  pageUrlpost = $(this).attr('data-link');
   $.ajax({
    type:"GET",
        url: pageUrl,
    dataType:"json",
    beforeSend: function(){
      $('body').addClass('show-spinner');
    },
        success: function (data) {
      pageUrl = data.url;
      if(pageUrl == 'comment_remove'){
        if(data.type == 'error') return false;
        if(data.popup_name == 'initiative'){
          view_initiativepop(localStorage.getItem('popup_id'))
        }
        
      }
      
      $('body').removeClass("show-spinner");
        }
    });
   
    e.preventDefault();
});
function showDeleteConfirmationModal(title, message, url){
    $('#modalTitle1').html(title);
    $('#modalBody1').html(message);
    $('#confirmURL1').attr('href', url);
    $('#showDeleteConfirmationModal').modal('show');
  }
</script>