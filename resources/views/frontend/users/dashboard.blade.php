@extends('frontend/layouts/default')

@section('content')
@include('Element/users/addmember')
	 <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>@if(Auth::User()->role_id  == 1) Admin @endif Dashboard</h1>
                    @if(Auth::User()->role_id  != 1)
					<!-- <div class="text-zero top-right-button-container">
                            <button type="button"
                                class="btn btn-lg  dropdown-toggle-split top-right-button top-right-button-single"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="simple-icon-plus" style="font-size:30px;"></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="javascript:void(0);" id="add_objective_btn">Add Objective</a>
                                <a class="dropdown-item" href="javascript:void(0);" id="add_measure_btn">Add Measure</a>
                                <a class="dropdown-item" href="javascript:void(0);" id="add_initiative_btn">Add Initiative</a>
                                <a class="dropdown-item" href="javascript:void(0);" id="add_kpi_btn">Add KPI</a>
                                <a class="dropdown-item" href="#">Add Task</a>
                                <a class="dropdown-item" href="javascript:void(0);" id= "add_department_btn">Add Department</a>
                                <a class="dropdown-item" href="javascript:void(0);" id= "add_team_btn">Add Team</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="addMember()">Add Member</a>
                            </div>
                        </div> -->
					@endif
                    @if(Auth::User()->role_id  != 1)
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
					@endif
                </div>
				
                <div class="col-lg-12 col-xl-12">
                    <div class="row icon-cards-row mb-4">
                       
                        @if(Auth::User()->role_id == 1)
                         <div class="col-md-3 col-lg-2 col-sm-4 col-6 mb-4">
                                        <a href="" class="card">
                                            <div class="card-body text-center">
                                                <i class="iconsminds-male-female"></i>
                                                <p class="card-text mb-0">Company</p>
                                                <p class="lead text-center">{!!$companycount!!}</p>
                                            </div>
                                        </a>
                                </div>
                                <div class="col-md-3 col-lg-2 col-sm-4 col-6 mb-4">
                                        <a href="" class="card">
                                            <div class="card-body text-center">
                                                <i class="iconsminds-money-bag"></i>
                                                <p class="card-text mb-0">Transactions</p>
                                                <p class="lead text-center">{!!$transaction_count!!}</p>
                                            </div>
                                        </a>
                                </div>
                        @else
                         
					
                           <div class="col-md-3 col-lg-2 col-sm-4 col-6 mb-4">
                                        <a href="{!!url('objectives')!!}" class="card">
                                            <div class="card-body text-center">
                                                <i class="simple-icon-graph"></i>
                                                <p class="card-text mb-0">Objectives</p>
                                                <p class="lead text-center">{!!$objectives_count!!}</p>
                                            </div>
                                        </a>
								</div>
                                <div class="col-md-3 col-lg-2 col-sm-4 col-6 mb-4">
                                        <a href="{!!url('measures')!!}" class="card">
                                            <div class="card-body text-center">
                                                <i class="simple-icon-hourglass"></i>
                                                <p class="card-text mb-0">Measures</p>
                                                <p class="lead text-center">{!!$measure_count!!}</p>
                                            </div>
                                        </a>
                                </div>
                                <div class="col-md-3 col-lg-2 col-sm-4 col-6 mb-4">
                                        <a href="{!!url('initiatives')!!}" class="card">
                                            <div class="card-body text-center">
                                                <i class="simple-icon-book-open"></i>
                                                <p class="card-text mb-0">Initiatives</p>
                                                <p class="lead text-center">{!!$initiative_count!!}</p>
                                            </div>
                                        </a>
                                </div>
                                <div class="col-md-3 col-lg-2 col-sm-4 col-6 mb-4">
                                        <a href="{!!url('kpis')!!}" class="card">
                                            <div class="card-body text-center">
                                                <i class="simple-icon-layers"></i>
                                                <p class="card-text mb-0">KPIs</p>
                                                <p class="lead text-center">{!!$kpi_count!!}</p>
                                            </div>
                                        </a>
                                </div>
                                <div class="col-md-3 col-lg-2 col-sm-4 col-6 mb-4">
                                        <a href="#" class="card">
                                            <div class="card-body text-center">
                                                <i class="simple-icon-list"></i>
                                                <p class="card-text mb-0">Tasks</p>
                                                <p class="lead text-center">{!!$tasks_count!!}</p>
                                            </div>
                                        </a>
                                    </div>
                                     
                                
                            </div>
                        </div>
                
			
     <div class="col-xl-6 col-lg-6 mb-4">
     <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Objectives Insights</h5>
                            <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Projects</th> 
                                        <th>Owner</th> 
                                        <th>Status</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    @if(!empty($objlist))
                                    @foreach($objlist as $key => $obj)
                                    <?php //pr($obj); ?>
                                    <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0">
                                        <i class="{!!$obj->status_icon!!} heading-icon" style="color: {!!$obj->bg_color!!}"></i> 
                                        <span class="align-middle d-inline-block">{!!$obj->heading!!}</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">{!!$obj->owner_name!!}</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-secondary" style="background-color: {!!$obj->bg_color!!} !important;">{!!$obj->status_name!!}</span>  
                                        </td>
                                        <td>
                                            <div class="c100 p{!!getPercentComplateObjective($obj->id)>100?100:getPercentComplateObjective($obj->id)!!} small" style="font-size:50px"><span>{!!getPercentComplateObjective($obj->id)!!}%</span><div class="slice"><div class="bar"></div><div class="fill"></div></div></div>
                                        </td>
                                       
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                              
               </div>
	
				<div class="col-md-6 col-lg-6 col-sm-6 col-6 mb-4" style="display:none;"> 
					
					<div class="alert alert-info alert-dismissible fade show " style="z-index:0;" role="alert">Step 1: Add Team Members <a href="">Click Here</a> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
					 
					<div class="alert alert-info alert-dismissible fade show "  style="z-index:0;" role="alert">Step 2: Departments <a href="">Click Here</a>  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
					 
					<div class="alert alert-info alert-dismissible fade show " style="z-index:0;" role="alert">Step 3: Teams <a href="">Click Here</a>  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
					 
					<div class="alert alert-info alert-dismissible fade show " style="z-index:0;" role="alert">Step 4: Add Objective <a href="">Click Here</a>  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
					</div>




			   <div class="col-xl-6 col-lg-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Task Insights</h5>
                            <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Task</th> 
                                        <th>Owner</th> 
                                        <th>Status</th>
                                    </tr>
                                </thead> 
                                <tbody>
                                    @if(!empty($tasklist))
                                        @foreach($tasklist as $key => $value)
                                        <tr>
                                            <td>
                                                <span class="align-middle d-inline-block">{!!$value['task_name']!!}</span>
                                            </td>
                                            <td> 
                                                <p class="text-semi-muted mb-2">{!!$value['owners']!!}</p>  
                                            </td>
                                            <td> 
                                                <span class="badge badge-pill badge-primary" style="background: {!!$value['bg_color']!!} !important">{!!$value['status_name']!!}</span>  
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                              
               </div>
               
               @endif

             </div>
 
            

 

  
         </div>
         <div class="app-menu showClass" style="display: none;">
            

            <div class="p-4 h-100">
                <div class="form-group">
                    <input type="text" class="form-control rounded" placeholder="Search">
                </div>
                <div class="tab-content h-100">
                    <div class="tab-pane fade show active  h-100" id="firstFull" role="tabpanel"
                        aria-labelledby="first-tab">

                        <div class="scroll">

                            <div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3">
                                <a class="d-flex" href="#">
                                   <i class="iconsminds-down-1 heading-icon" style="color: red;"></i>
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="{!!url('/dashboard')!!}">
                                                <p class=" mb-0 truncate">Customer Decrease</p>
                                            </a>
                                            <p class="mb-1 text-muted text-small">FY2020 - Q2</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3">
                                <a class="d-flex" href="#">
                                   <i class="iconsminds-up-1 heading-icon" style="color: green;"></i>
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="{!!url('/dashboard')!!}">
                                                <p class=" mb-0 truncate">Sale Increase</p>
                                            </a>
                                            <p class="mb-1 text-muted text-small">FY2020 - Q4</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3">
                               <a class="d-flex" href="#">
                                   <i class="iconsminds-pause heading-icon" style="color: yellow;"></i>
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="{!!url('/dashboard')!!}">
                                                <p class=" mb-0 truncate">Growth Increase</p>
                                            </a>
                                            <p class="mb-1 text-muted text-small">FY2020 - H1</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" style="text-align: center;" onclick="Closepop()">Close</button>
                           
                        </div>
                    </div>

                    <div class="tab-pane fade  h-100" id="secondFull" role="tabpanel" aria-labelledby="second-tab">
                        <div class="scroll">

                            <div class="d-flex flex-row mb-3 border-bottom pb-3">
                                <a class="d-flex" href="#">
                                    <img alt="Profile Picture" src="img/profile-pic-l.jpg"
                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="mb-0 truncate">Sarah Kortney</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 border-bottom pb-3">
                                <a class="d-flex" href="#">
                                    <img alt="Profile Picture" src="img/profile-pic-l-2.jpg"
                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="mb-0 truncate">Williemae Lagasse</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 border-bottom pb-3">
                                <a class="d-flex" href="#">
                                    <img alt="Profile Picture" src="img/profile-pic-l-3.jpg"
                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="mb-0 truncate">Tommy Nash</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 border-bottom pb-3">
                                <a class="d-flex" href="#">
                                    <img alt="Profile Picture" src="img/profile-pic-l-4.jpg"
                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="mb-0 truncate">Mayra Sibley</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 border-bottom pb-3">
                                <a class="d-flex" href="#">
                                    <img alt="Profile Picture" src="img/profile-pic-l-5.jpg"
                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="mb-0 truncate">Kathryn Mengel</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 border-bottom pb-3">
                                <a class="d-flex" href="#">
                                    <img alt="Profile Picture" src="img/profile-pic-l-2.jpg"
                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="mb-0 truncate">Williemae Lagasse</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 border-bottom pb-3">
                                <a class="d-flex" href="#">
                                    <img alt="Profile Picture" src="img/profile-pic-l-3.jpg"
                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="mb-0 truncate">Tommy Nash</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 border-bottom pb-3">
                                <a class="d-flex" href="#">
                                    <img alt="Profile Picture" src="img/profile-pic-l-4.jpg"
                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="mb-0 truncate">Mayra Sibley</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 border-bottom pb-3">
                                <a class="d-flex" href="#">
                                    <img alt="Profile Picture" src="img/profile-pic-l-3.jpg"
                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="mb-0 truncate">Tommy Nash</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 border-bottom pb-3">
                                <a class="d-flex" href="#">
                                    <img alt="Profile Picture" src="img/profile-pic-l-4.jpg"
                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="mb-0 truncate">Mayra Sibley</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 border-bottom pb-3">
                                <a class="d-flex" href="#">
                                    <img alt="Profile Picture" src="img/profile-pic-l-5.jpg"
                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="mb-0 truncate">Kathryn Mengel</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 border-bottom pb-3">
                                <a class="d-flex" href="#">
                                    <img alt="Profile Picture" src="img/profile-pic-l-2.jpg"
                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="mb-0 truncate">Williemae Lagasse</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 border-bottom pb-3">
                                <a class="d-flex" href="#">
                                    <img alt="Profile Picture" src="img/profile-pic-l-3.jpg"
                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="mb-0 truncate">Tommy Nash</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3">
                                <a class="d-flex" href="#">
                                    <img alt="Profile Picture" src="img/profile-pic-l-4.jpg"
                                        class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">
                                </a>
                                <div class="d-flex flex-grow-1 min-width-zero">
                                    <div
                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
                                            <a href="#">
                                                <p class="mb-0 truncate">Mayra Sibley</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <a class="app-menu-button d-inline-block d-xl-none" href="#">
                <i class="simple-icon-options"></i>
            </a>
			
        </div>

    </main>
    @include('Element/objective/add_objective')
                        @include('Element/measure/add_measure')
                        @include('Element/initiative/add_initiative')
                        @include('Element/kpi/add_kpi')
                        @include('Element/department/add_department')
                        @include('Element/team/add_team')
	<script type="text/javascript">
        function addMember(){
            $("#addmember").modal("show");
        }
     function filterShow(){
        $(".showClass").show();
     } function Closepop(){
        $(".showClass").hide();
     }   
	 $(document).ready(function(){
		
		$("#add_measure_btn").click(function(){
			$("#myModalAddMeasure").modal('show');
		});
        $("#add_initiative_btn").click(function(){
            $("#myModalAddInitiative").modal('show');
        });
        $("#add_kpi_btn").click(function(){
            $("#myModalAddKPI").modal('show');
        });
        $("#popupaddhideinitiative").click(function(){
            $("#myModalAddInitiative").modal('hide');
        });
        $("#popupaddhidekpi").click(function(){
            $("#myModalAddKPI").modal('hide');
        });
		$("#popupaddhideMeasure").click(function(){
			$("#myModalAddMeasure").modal('hide');
		});
		$("#add_objective_btn").click(function(){
			$("#myModalAddObjective").modal('show');
		});
		$("#popupaddhideObjective").click(function(){
			$("#myModalAddObjective").modal('hide');
		});
        $("#add_department_btn").click(function(){
            $("#myModalAddDepartment").modal('show');
        });
        $("#popupaddhidedepartment").click(function(){
            $("#myModalAddDepartment").modal('hide');
        });
        $("#add_team_btn").click(function(){
            $("#myModalAddTeam").modal('show');          
        });
        $("#popupaddhideteam").click(function(){
            $("#myModalAddTeam").modal('hide');
        });
	});
	</script>
    
@stop