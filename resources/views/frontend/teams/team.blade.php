@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
  <main>
        <div class="container-fluid"> 
                            
            
            <div class="row">
            
        
                            
                            
                <div class="col-12">
                    <h1> <span class="align-middle d-inline-block pt-1">Team Insights</span>   
                        </h1><nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        
                    </nav>
                        <div class="float-md-right">
                            <button type="button" class="btn btn-primary mb-1" id="myModal1">Add Team</button>

                         @extends('Element/team/add_team')

  
  <script>
$(document).ready(function(){

    var addteamerror = "{!!session('errormessageadd')?session('errormessageadd'):''!!}";
    if(addteamerror != ""){
        $("#myModalAddTeam").modal('show');
    }
    $("#myModal1").click(function(){
    $("#myModalAddTeam").modal('show');
  
})
    $("#popupaddhideteam").click(function(){
    $("#myModalAddTeam").modal('hide');
  });
   $("#popupupdatehideteam").click(function(){
    $("#myModalUpdateTeam").modal('hide');
  });
})
</script>
                            <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               Choose Team
                            </button> 
                            
                            <a href="{!!url('members')!!}"><button type="button" class="btn btn-primary mb-1">Members</button></a>
                            <a href="{!!url('department')!!}"><button type="button" class="btn btn-primary mb-1">Departments</button></a>
                            
                            
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(874px, 43px, 0px);">
                                @if(!empty($data))
                                @foreach($data as $k => $v)
                                <a class="dropdown-item" href="{!!url('team/'.$v->id)!!}">{!!$v->team_name!!}</a>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    <div class="separator mb-5"></div>
                </div>
            </div>

           @if(session('message'))
            <div class="alert alert-success" role="alert" style="z-index: unset;">
                {!! session('message') !!}
            </div>
            @endif
            @if(!empty($team_detail))
            
              <div class="row">
              
              
              
                                <div class="card col-lg-12 col-12 mb-4 ">
                                   
                                        <div class="position-absolute card-top-buttons">
                                            @if($id)
                                            <button class="btn btn-header-light icon-button" onclick="updateTeam()">
                                                <i class="simple-icon-pencil"></i>
                                            </button>
                                            <?php
                                                $remove_url = url($route_prefix."/team/remove/".$id); 
                                                $remove_msg = getLabels('are_you_sure'); ?>
                                                <a onclick = 'showConfirmationModal("Remove", "{!! $remove_msg !!}", "{!! $remove_url !!}");' href="javascript:void(0);">
                                                    <button class="btn btn-header-light icon-button">
                                                        <i class="simple-icon-trash"></i>
                                                    </button>
                                                    </a>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <p class="list-item-heading mb-4">{!!$team_detail->team_name!!}</p> 
                                           
                                               <div
                                                class="d-flex flex-row mb-3 pb-3 border-bottom justify-content-between align-items-center">
                                                @if ($team_detail->photo and file_exists('public/upload/users/profile-photo/'. $team_detail->photo) )
                                                     <img src="{!!url('public/upload/users/profile-photo/'.$team_detail->photo)!!}" alt="Philip Nelms"class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />            
                                                @else
                                                     <img src="{!!url('/img/no_images.png')!!}" alt="Philip Nelms"class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />  
                                                @endif
                                                <div class="pl-3 flex-fill">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-0">{!!$team_detail->team_head_name!!} ( Team Leader )</p>
                                                        <p class="text-muted mb-0 text-small">{!!$team_detail->designation!!}</p>
                                                    </a>
                                                </div> 
                                            </div>
                                           
                                        </div>
                                   
                                </div>
                                
                
                <div class="card mb-4 col-lg-4 col-4">
                                        <div class="card-body">
                                            <h5 class="card-title">All Members</h5>
                                            @if(!empty($team_members))
                                            @foreach($team_members as $h => $j)
                                            <div
                                                class="d-flex flex-row mb-3 pb-3 border-bottom justify-content-between align-items-center">
                                                <a href="javascript:void(0)">
                                                     @if ($j->photo and file_exists('public/upload/users/profile-photo/'. $j->photo) )
                                                     <img src="{!!url('public/upload/users/profile-photo/'.$j->photo)!!}" alt="Philip Nelms"class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />            
                                                @else
                                                     <img src="{!!url('/img/no_images.png')!!}" alt="Philip Nelms"class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />  
                                                @endif
                                                </a>
                                                <div class="pl-3 flex-fill">
                                                    <a href="javascript:void(0)">
                                                        <p class="font-weight-medium mb-0">{!!$j->first_name.' '.$j->last_name!!}</p>
                                                        <p class="text-muted mb-0 text-small">{!!$team_detail->designation!!}</p>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a class="btn btn-outline-primary btn-xs" href="javascript:void(0)">Reports</a>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endif
                                            
                                        </div>
                                    </div>

                <div class="col-xl-8 col-lg-8 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Get Insights of Team Progress</h5>
                            <table class="data-table data-table-standard responsive nowrap"
                                data-order="[[ 1, &quot;desc&quot; ]]">
                                <thead>
                                    <tr>
                                        <th>Projects</th> 
                                        <th></th> 
                                        <th></th>
                                        <th>Progress</th>
                                    </tr>
                                </thead> 
                                
                                
                                
                                
                                <tbody>
                                    <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <i class="simple-icon-refresh heading-icon"></i> 
                                        <span class="align-middle d-inline-block">Book train tickets</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">Objective</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-secondary">ON HOLD</span>  
                                        </td>
                                        <td>
                                            <div role="progressbar" class="progress-bar-circle position-relative"
                                                data-color="#922c88" data-trailColor="#d7d7d7" aria-valuemax="100"
                                                aria-valuenow="40" data-show-percent="true">
                                            </div>
                                        </td>
                                       
                                    </tr>
                                     <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <i class="simple-icon-refresh heading-icon"></i> 
                                        <span class="align-middle d-inline-block">Book train tickets</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">Objective</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-secondary">ON HOLD</span>  
                                        </td>
                                        <td>
                                            <div role="progressbar" class="progress-bar-circle position-relative"
                                                data-color="#922c88" data-trailColor="#d7d7d7" aria-valuemax="100"
                                                aria-valuenow="40" data-show-percent="true">
                                            </div>
                                        </td>
                                       
                                    </tr>
                                     <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <i class="simple-icon-refresh heading-icon"></i> 
                                        <span class="align-middle d-inline-block">Book train tickets</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">Objective</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-secondary">ON HOLD</span>  
                                        </td>
                                        <td>
                                            <div role="progressbar" class="progress-bar-circle position-relative"
                                                data-color="#922c88" data-trailColor="#d7d7d7" aria-valuemax="100"
                                                aria-valuenow="40" data-show-percent="true">
                                            </div>
                                        </td>
                                       
                                    </tr>
                                     <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <i class="simple-icon-refresh heading-icon"></i> 
                                        <span class="align-middle d-inline-block">Book train tickets</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">Objective</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-secondary">ON HOLD</span>  
                                        </td>
                                        <td>
                                            <div role="progressbar" class="progress-bar-circle position-relative"
                                                data-color="#922c88" data-trailColor="#d7d7d7" aria-valuemax="100"
                                                aria-valuenow="40" data-show-percent="true">
                                            </div>
                                        </td>
                                       
                                    </tr>
                                     <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <i class="simple-icon-refresh heading-icon"></i> 
                                        <span class="align-middle d-inline-block">Book train tickets</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">Objective</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-secondary">ON HOLD</span>  
                                        </td>
                                        <td>
                                            <div role="progressbar" class="progress-bar-circle position-relative"
                                                data-color="#922c88" data-trailColor="#d7d7d7" aria-valuemax="100"
                                                aria-valuenow="40" data-show-percent="true">
                                            </div>
                                        </td>
                                       
                                    </tr>
                                     <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <i class="simple-icon-refresh heading-icon"></i> 
                                        <span class="align-middle d-inline-block">Book train tickets</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">Objective</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-secondary">ON HOLD</span>  
                                        </td>
                                        <td>
                                            <div role="progressbar" class="progress-bar-circle position-relative"
                                                data-color="#922c88" data-trailColor="#d7d7d7" aria-valuemax="100"
                                                aria-valuenow="40" data-show-percent="true">
                                            </div>
                                        </td>
                                       
                                    </tr>
                                     <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <i class="simple-icon-refresh heading-icon"></i> 
                                        <span class="align-middle d-inline-block">Book train tickets</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">Objective</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-secondary">ON HOLD</span>  
                                        </td>
                                        <td>
                                            <div role="progressbar" class="progress-bar-circle position-relative"
                                                data-color="#922c88" data-trailColor="#d7d7d7" aria-valuemax="100"
                                                aria-valuenow="40" data-show-percent="true">
                                            </div>
                                        </td>
                                       
                                    </tr>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
              @else
              no record found
              @endif
           </div>

    </main>
     @extends('Element/team/update_team')

    <script type="text/javascript">
        
        function updateTeam(){
            $("#myModalUpdateTeam").modal('show');
        }

    </script>
@stop