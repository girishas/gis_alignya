@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Initiatives') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="javascript:void(0);" class=" btn btn-primary btn-lg top-right-button mr-1" id="add_objectiveBtn">{!! getLabels('add_initiatieve') !!}</a>
                    </div>
                    
  <!-- Modal -->
<div class="modal modal-right" id="myModalAddObjective" role="dialog" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Initiatives</h5>
                                            <button type="button" class="close" id="popupaddhide" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        	
                                            <form>
                                            	<div class="container-fluid">
                                            	<div class="row">
                                            		
                                            	<div class="col-lg-8">
                                            		<div class="form-group">
                                                    <label>Initiatives Title</label>
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                                 <div class="form-group ">
                                                      <label>Choose Objective</label>
                                <select class="form-control select2-single" name="department_head" data-width="100%">
                                    <option label="&nbsp;"></option>
                                    <option value="1" >objective 1</option>
                                    <option value="1" >objective 2</option>
                                    <option value="1" >objective 3</option>
                                    <option value="1" >objective 4</option>
                                    <option value="1" >objective 5</option>
                                    
                                    
                                </select>                       
                                <div class="invalid-tooltip"></div>
                            </div>

                                                <div class="form-group">	
                                <label>Ownership</label>
                               		<br>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-primary active">
                                            <input type="radio" name="options" id="option1" value="1" checked> Department
                                        </label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="options" value="2" id="option2"> Team
                                        </label>
                                        <label class="btn btn-primary">
                                            <input type="radio" name="options" value="3" id="option3"> Individual
                                        </label>
                                    </div>
                                </div>

                           <div class="form-group ">
								<select class="form-control select2-single" name="department_head" data-width="100%">
                                	<option label="&nbsp;"></option>
                                	<option value="1" >dep1</option>
                                	<option value="1" >dep1</option>
                                	<option value="1" >dep1</option>
                                	<option value="1" >dep1</option>
                                	<option value="1" >dep1</option>
                                	
                                	
                                </select>						
								<div class="invalid-tooltip"></div>
							</div>

                           						
                                                </div>
                                               
                                                </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                           <button type="button" class="btn btn-primary">Submit</button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>


							<div class="modal modal-right" id="myModal" role="dialog" >
                                <div class="modal-dialog" style="max-width: 99.99%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"> <i class="fa fa-arrow-up" style="font-size:23px;color:green;"></i> Airport Traffic</h5>
                                            <button type="button" class="close" id="popup1hide" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        	
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12 survey-app">
                    <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
                                aria-controls="first" aria-selected="true">Milestones</a>
                        </li>
<li class="nav-item">
                            <a class="nav-link " id="second-tab" data-toggle="tab" href="#second" role="tab"
                                aria-controls="second" aria-selected="true">Tasks</a>
                        </li>

                        
                    </ul>
                    <div class="tab-content mb-4">
                        <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                            <div class="row">

                                <div class="col-lg-8 col-12 mb-4">
                                 <div class="card mb-8">
                                        <div class="card-body">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col"><h6>Milestones</h6></th>
                                        
                                        <th scope="col"><h6>Start Date</h6></th>
                                        <th scope="col"><h6>Due Date</h6></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Milestone 1</td>
                                        
                                        <td>06/06/2020</td>
                                        <td>07/06/2020</td>
                                    </tr>
                                    <tr>
                                        <td>Milestone 2</td>
                                       
                                        <td>08/06/2020</td>
                                        <td>09/06/2020</td>
                                    </tr>
                                    <tr>
                                        <td>Milestone 3</td>
                                        <td >10/06/2020</td>
                                        <td>11/06/2020</td>
                                    </tr>
                                     <tr>
                                        <th scope="row"><a href="javascript:void(0);"><h6 id="myBtn2"><i class="simple-icon-plus btn-group-icon"></i> Add Milestone</h6></a></th>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        
                                </div>
                                </div>
                                </div>

                                
                            </div>
                        </div>
                        <div class="tab-pane show" id="second" role="tabpanel" aria-labelledby="second-tab">
                            <div class="row">

                                <div class="col-lg-8 col-12 mb-4">
                                 <div class="card mb-8">
                                        <div class="card-body">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col"><h6>Tasks</h6></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"><h6>Due Date</h6></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Check Progress Return</td>
                                        <td></td>
                                        <td></td>
                                        <td>06/06/2020</td>
                                    </tr>
                                    <tr>
                                        <td>Plan Departures</td>
                                        <td></td>
                                        <td></td>
                                        <td>06/06/2020</td>
                                    </tr>
                                    <tr>
                                        <td>Discuss Requirements</td>
                                        <td colspan="2"></td>
                                        <td>06/06/2020</td>
                                    </tr>
                                     <tr>
                                        <th scope="row"><a href="javascript:void(0);" ><h6 id="myBtn1"><i class="simple-icon-plus"></i> Add Task</h6></a></th>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        
                                </div>
                                </div>
                                </div>

                                
                            </div>
                        </div>

                        
                        
                    </div>

                </div>
            </div>
        </div>

                                        </div>
                                        <div class="modal-footer">
                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
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

<div class="modal modal-right" id="myModal2" role="dialog" >
                                <div class="modal-dialog" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Milestone</h5>
                                            <button type="button" class="close" id="popup3hide" aria-label="Close">
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
                                                      <label>Start Date</label>
                                                  <input class="form-control datepicker" placeholder="">
                                <div class="invalid-tooltip"></div>
                            </div>
                            <div class="form-group ">
                                                      <label>End Date</label>
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

  
  <script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $("#myModal").modal('show');
  });
   $("#add_objectiveBtn").click(function(){
    $("#myModalAddObjective").modal('show');
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
  $("#popupaddhide").click(function(){
    $("#myModalAddObjective").modal('hide');
  });
});
</script>
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
										   <th> {!! SortableTrait::link_to_sorting_action('team_name',  getLabels('Name')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('team_head',  getLabels('Cycle')) !!} </th>
                                            <th> {!! SortableTrait::link_to_sorting_action('team_head',  getLabels('Owner')) !!} </th>
											<th> {!! getLabels('action') !!} </th>
										</tr>
									</thead>
									<tbody>
												<tr class="odd gradeX">
													<td><a href="javascript:void(0);" id="myBtn"> <i class="fa fa-arrow-up" style="font-size:23px;color:green;"></i> Airport Traffic</td>
													<td> FY2020-H1</td>
                                                    <td> Jhon</td>
													<td>
														<div class="btn-group float-none-xs">
															<button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																{!! getLabels('action') !!}
															</button>
															<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
																<a class="steamerst_link dropdown-item" href="javascript:void(0);">{!! getLabels('edit') !!}</a>
																
															</div>
														</div>
													</td>
												</tr>
											
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
@stop