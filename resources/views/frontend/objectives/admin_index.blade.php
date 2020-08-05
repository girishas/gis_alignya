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
@include('Element/initiative/add_initiative')
@include('Element/initiative/view_initiative') 
@include('Element/measure/update_task')
@include('Element/measure/update_milestone')
@include('Element/measure/update_measure')
@include('Element/initiative/update_initiative')
@include('Element/measure/add_milestone')
@include('Element/initiative/add_milestone')
@include('Element/initiative/update_milestone')
@include('Element/measure/task')
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
                                           <th>{!!"% ".getLabel('complete')!!}</th>
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
                                                    <td> <div class="c100 p{!!getPercentComplateObjective($value->id)>100?100:getPercentComplateObjective($value->id)!!} small" style="font-size: 50px;">
                                                        <span>{!!getPercentComplateObjective($value->id)!!}%</span>
                                                        <div class="slice">
                                                            <div class="bar"></div>
                                                            <div class="fill"></div>
                                                        </div>
                                                    </div></td>
													<td>
														<a  href="javascript:void(0);" onclick="updateObjective('{!!$value->id!!}')" title="Edit"><i class="simple-icon-pencil heading-icon"></i></a>
                             <a href="javascript:void(0);" onclick="viewobjective('{!!$value->id!!}')" title="View"><i class="iconsminds-information heading-icon"></i>
                                                        </a>
                                                                <a  onclick = 'showConfirmationModal("Remove", "{!! $remove_msg !!}", "{!! $remove_url !!}");' href="javascript:void(0);" title="Remove"><i class="simple-icon-trash heading-icon"></i></a>
                                                                
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
                if(response != ""){
                   $("#ownership").append('<option value = "">'+selectlabel+'</option>')
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#ownership").append('<option value = "'+key+'">'+val+'</option>');
                  }
                }
                }
               
            }  
        });
    }

$(document).ready(function(){
    var objective_add_error = "{!!session('objective_add_error')?session('objective_add_error'):''!!}";
    if(objective_add_error != ""){
      $("#myModalAddObjective").modal('show');
    }
    var objective_add_success = "{!!session('objective_add_success')?session('objective_add_success'):''!!}";
    if(objective_add_success != ""){
      showNotificationApp('top', 'right', 'primary', 'success', '{!!session("objective_add_success")!!}');
    }
    var is_popup = "{!!session('is_popup')?session('is_popup'):''!!}";
    if(is_popup != ""){
      showNotificationApp('top', 'right', 'primary', 'success', '{!!session("is_popup")!!}');
    }
    var is_popup_content = "{!!session('popup_content_message')?session('popup_content_message'):''!!}";
    if(is_popup_content != ""){
      viewobjective(localStorage.getItem('popup_id'));
    }
    
    var is_popup = "{!!session('is_popup')?session('is_popup'):''!!}";
    if(is_popup != ''){
      viewobjective(localStorage.getItem('popup_id'));
    }
    
  
  $("#filterBtn").click(function(){
    $("#filterPop").modal('show');
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
    window.location.reload(true);
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
  

   $("#popupaddhideinitiative").click(function(){
    $("#myModalAddInitiative").modal('hide');
  });
   $("#popupaddhideMeasure").click(function(){
    $("#myModalAddMeasure").modal("hide");
   });
   $("#view_measuremodal_hide").click(function(){
    $("#viewmeasuremodal").modal("hide");
});
   
});

</script>
<script type="text/javascript">

    
   
    
    $("#popupaddhideObjectiveupdate").click(function(){
      $(".updateobjectiveform").attr("name","updateobjectiveform");
        $("#updateobjectivemodal").modal("hide");
    });

    
    
    
    
</script>

@stop