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


@section('content')
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Initiatives') !!}</h1>
                    <div class="text-zero top-right-button-container">
                        <a href="javascript:void(0);" class=" btn btn-primary btn-sm top-right-button mr-1" id="add_objectiveBtn">{!! getLabels('add_initiative') !!}</a>
                        <button type="button" class="btn btn-outline-primary mb-1" onclick="filter()">Filters</button>

                    </div>
                    @include('Element/initiative/filter')
                    @include('Element/initiative/add_initiative')
                    @include('Element/initiative/view_initiative')
                    @include('Element/initiative/add_milestone')
                    @include('Element/initiative/update_milestone')
                    @include('Element/initiative/update_initiative')
                    @include('Element/measure/task')
                    @include('Element/measure/update_task')
                    
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
                                                    $remove_msg = getLabels('are_you_sure?'); ?>
                                                <tr>
                                                    <td><a href="javascript:void(0);" onclick="view_initiativepop('{!!$value->id!!}')"> <i class="{!!$value->status_icon!!} heading-icon" style="color:{!!$value->bg_color!!};"></i>{!!$value->heading!!}</td>
                                                    <td>FY{!!$value->measure_cycle_year!!}-{!!config('constants.Quarter.'.$value->measure_cycle_quarter)!!}</td>
                                                    <td> {!!$value->owner_name!!}</td>
                                                    <td> <span class="badge badge-pill badge-success" style="background-color: {!!$value->bg_color!!}">{!!$value->status_name!!}</span></td>
                                                    <td> {!!$value->parent_objective!!}</td>
                                                    <td>
                                                          <a  href="javascript:void(0);" onclick="updateinitiative('{!!$value->id!!}')"><i class="simple-icon-pencil heading-icon"></i></a>
                                                          <a href="javascript:void(0);" onclick="view_initiativepop('{!!$value->id!!}')"> <i class="iconsminds-information heading-icon" ></i>
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
    
    // function updateTask(id){
    //     $("#update_task_id").val(id);
    //     var token = "{!!csrf_token()!!}";
    //     var company_id = "{!!Auth::User()->company_id!!}";
    //     $.ajax({
    //         type:"POST",
    //         url: "{!!url('getTaskDetails')!!}",
    //         data:'_token='+token+'&company_id='+company_id+'&task_id='+id,
    //         dataType:'JSON',
    //         success: function (response) {
    //             var taskdetails = response.task_details;
    //             $("#task_name_update_id").val(taskdetails.task_name);
    //             $("#task_description_update_id").val(taskdetails.description);
    //              $("#task_status_id").val(taskdetails.status);
    //             var owners = response.owners;
    //             for (var own in owners) {
    //                 if (owners.hasOwnProperty(own)) {
    //                     var owner = owners[own];
    //                     if(taskdetails.owners.indexOf(own) != -1){
    //                         $("#owners_update_id").append('<option value = "'+own+'" selected="selected">'+owner+'</option>');
    //                     }else{
    //                         $("#owners_update_id").append('<option value = "'+own+'">'+owner+'</option>');
    //                     }
    //                   }
    //                 }
    //             }  
    //     });
    //     $("#myModalUpdateTask").modal("show");
    // }
    function filter(){
        $("#filterPop").modal("show");
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
    

   
     
$(document).ready(function(){
    var inimessage = "{!!session('inimessage')?session('inimessage'):''!!}";
    if(inimessage != ""){
        showNotificationApp('top', 'right', 'primary', 'success', '{!!session("inimessage")!!}');
    }
    $("#hideFilter").click(function(){
        $("#filterPop").modal('hide');
    });
    var popup_content_message = "{!!session('popup_content_message')?session('popup_content_message'):''!!}";
    if(popup_content_message != ""){
        view_initiativepop(localStorage.getItem('popup_id'));
    }
  
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

  $("#popupaddhideTask").click(function(){
    $("#myModalAddTask").modal("hide");
  });
  $("#viewinitiativemodalhide").click(function(){
    $("#viewinitiativemodal").modal('hide');
  });
});
</script>
@stop