    @extends('frontend/layouts/default')
    <?php use App\Traits\SortableTrait;  ?>

    @section('content')
    @include('Element/measure/view_measure')
    @include('Element/measure/add_measure')
    @include('Element/measure/update_measure')
    @include('Element/measure/update_milestone')
    @include('Element/measure/add_milestone')
    @include('Element/measure/task')
    @include('Element/measure/update_task')
    <main>
    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
    <h1>{!! getLabels('Measures') !!}</h1>
    <div class="text-zero top-right-button-container">
    <a href="javascript:void(0);" class=" btn btn-primary btn-sm top-right-button mr-1" id="add_objectiveBtn">{!! getLabels('add_measure') !!}</a>
    <button type="button" class="btn btn-outline-primary mb-1" id="filterBtn">Filters</button>
    </div>

 <div class="modal modal-right" id="filterPop" role="dialog" >
                                <div class="modal-dialog" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Search</h5>
                                            <button type="button" class="close" id="hideFilter" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                            <form>
                                                <div class="container-fluid">
                                                <div class="row">
                                                    
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                               

                                                <div class="form-group">
                                                    <label>Cycle</label>
                                                    <select class="form-control">
                                                        <option label="&nbsp;">&nbsp;</option>
                                                        <option value="Flexbox">FY2020-Q1</option>
                                                        <option value="Sass">FY2020-Q2</option>
                                                        <option value="React">FY2020-Q3</option>
                                                        <option value="React">FY2020-Q4</option>
                                                        <option value="React">FY2020-H1</option>
                                                        <option value="React">FY2020-H2</option>
                                                    </select>
                                                </div>
                                                 <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control">
                                                        <option label="&nbsp;">&nbsp;</option>
                                                        <option value="Flexbox">Hold</option>
                                                        <option value="Sass">Above Target</option>
                                                        <option value="React">Below Target</option>
                                                        <option value="React">At Risk</option>
                                                    </select>
                                                </div>
                                                <div class="form-group ">
                                                    <label>Owners</label>
                                                    <select class="form-control select2-single">
                                                        <option label="&nbsp;">&nbsp;</option>
                                                        <option value="Flexbox">Jhon</option>
                                                        <option value="Sass">Emma</option>
                                                        <option value="React">Jolley</option>
                                                        <option value="React">Jack</option>
                                                    </select>
                                                </div>
                                                  
                                                </div>
                                                
                                                </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                           <button type="button" class="btn btn-primary">Search</button>
                                            <a class="btn btn-dark mb-1 steamerst_link" href="{!!url('kpis')!!}">Show All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>    

    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
    <ol class="breadcrumb pt-0">
    <li class="breadcrumb-item">
        <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
    </li>

    <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Measures') !!}</li>
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
                    <th> {!!getLabels('Owner') !!} </th>
                    <th> {!!getLabels('Status') !!} </th>
                    <th> {!!getLabels('Objective') !!} </th>
                    <th> {!!getLabels('action') !!} </th>
                </tr>
            </thead>
            <tbody>
                        @if(!$data->isEmpty())
                        @foreach($data as $key => $value)
                        <?php
                            $remove_url = url("measure/remove/".$value->id); 
                            $remove_msg = getLabels('are_you_sure'); ?>
                        <tr>
                            <td><a href="javascript:void(0);" onclick="viewMeasure('{!!$value->id!!}')"><i class="{!!$value->status_icon!!} heading-icon" style="color:{!!$value->bg_color!!}"></i>{!!$value->heading!!}</td>
                            <td> FY{!!$value->measure_cycle_year!!}-{!!config('constants.Quarter.'.$value->measure_cycle_quarter)!!}</td>
                            <td> {!!$value->owner_name!!}</td>
                            <td> <span class="badge badge-pill badge-success" style="background: {!!$value->bg_color!!}">{!!$value->status_name!!}</span></td>
                            <td>{!!$value->parent_objective!!}</td>
                            <td>
                                <a href="javascript:void(0);" onclick="updateMeasure('{!!$value->id!!}')"><i class="simple-icon-pencil heading-icon"></i></a>
                                    <a onclick = 'showConfirmationModal("Remove", "{!! $remove_msg !!}", "{!! $remove_url !!}");' href="javascript:void(0);"><i class="heading-icon simple-icon-trash"></i></a>
                                    <a href="javascript:void(0);" onclick="viewMeasure('{!!$value->id!!}')"><i class="iconsminds-information heading-icon"></i>
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
    $(document).ready(function(){
        var adderrormessage = "{!!session('adderrormessage')?session('adderrormessage'):''!!}";
            if(adderrormessage != ''){
                $("#myModalAddMeasure").show();
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
    function updatetask(id){
        $("#myModalUpdateTask").modal('show');
    }
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
                    $("#addtaskmeasureview").html('<tr><td>'+taskli[i].task_name+'</td><td>'+taskli[i].owners+'</td><td><span class="badge badge-pill badge-danger" style="background:'+taskli[i].bg_color+'">'+taskli[i].status_name+'</span></td><td><i class="iconsminds-right-1 heading-icon" style="cursor: pointer;"></i> <a href="javascript:void(0);" onclick="updatetask('+taskli[i].id+')"><i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i></a>&nbsp;&nbsp;&nbsp; <i class="simple-icon-trash" style="font-size: initial;cursor: pointer;"></i></td></tr>');
                }
            }
        })  
        $("#viewmeasuremodal").modal('show');
    }
    function updateMeasure(id){
        $("#ownershipmeasureupdate").html("");
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
                $("#measure_target_color").val(all_response.target_color);
                $("#actual_color_measure").val(all_response.actual_color);
                $("#measure_projection_color").val(all_response.projection_color);
                $("#measuretargetnew").val(all_response.measure_target_new);
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
    @stop