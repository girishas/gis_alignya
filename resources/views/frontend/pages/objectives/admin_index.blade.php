@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Objective') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="javascript:void(0);" class=" btn btn-primary btn-lg top-right-button mr-1" id="add_objectiveBtn">{!! getLabels('add_objective') !!}</a>
                    </div>
                    
  <!-- Modal -->
  							<!-- add objecive -->
							<div class="modal modal-right" id="myModalAddObjective" role="dialog" >
                                <div class="modal-dialog" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Objective</h5>
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
                                                    <label>Objective Title</label>
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                               

                                                <div class="form-group">
                                                    <label>Time Period</label>
                                                    <select class="form-control">
                                                        <option label="&nbsp;">&nbsp;</option>
                                                        <option value="Flexbox">Flexbox</option>
                                                        <option value="Sass">Sass</option>
                                                        <option value="React">React</option>
                                                    </select>
                                                </div>
                                                 <div class="form-group">
                                                    <label>Perspective</label>
                                                    <select class="form-control">
                                                        <option label="&nbsp;">&nbsp;</option>
                                                        <option value="Flexbox">Flexbox</option>
                                                        <option value="Sass">Sass</option>
                                                        <option value="React">React</option>
                                                    </select>
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
                            <!-- add objecive -->
							<!-- parent objective -->
							<div class="modal modal-right" id="myModal" role="dialog" >
                                <div class="modal-dialog" style="max-width: 99.99%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i class="fa fa-arrow-up" style="font-size:23px;color:green;"></i>  Increase Share Holder Value</h5>
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
						                                aria-controls="first" aria-selected="true">Measure</a>
						                        </li>

						                        <li class="nav-item">
						                            <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab"
						                                aria-controls="third" aria-selected="false">Initiative</a>
						                        </li>
						                        <li class="nav-item">
						                            <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
						                                aria-controls="second" aria-selected="false">Sub Objective</a>
						                        </li>
						                        <li class="nav-item">
						                            <a class="nav-link" id="no-tab" data-toggle="tab" href="#no" role="tab"
						                                aria-controls="no" aria-selected="false">Tasks</a>
						                        </li>
						                    </ul>
						                    <div class="tab-content mb-4">
						                        <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
						                            <div class="row">

						                                <div class="col-lg-8 col-12 mb-4">
						                                 <div class="card mb-8">
						                                        <div class="card-body">
						                            <table class="table table-borderless">
						                                
						                                <tbody>
						                                    <tr>
						                                        <td style="padding-top: 25px;"><i class="fa fa-arrow-up" style="font-size:23px;color:green;"></i> Revenue</td>
						                                        <td style="padding-top: 30px;">FY2020-Q3</td>
						                                        <td></td>
						                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
						                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="40"
						                                data-show-percent="true">
						                            </div>
						                        </td>
						                        <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
						                                    </tr>
						                                    <tr>
						                                        <td style="padding-top: 25px;"><i class="fa fa-arrow-down" style="font-size:23px;color:red;"></i> Net Profit</td>
						                                        <td style="padding-top: 30px;">FY2020-Q1</td>
						                                        <td></td>
						                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
						                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="10"
						                                data-show-percent="true">
						                            </div></td>
						                             <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
						                                    </tr>
						                                    <tr>
						                                        <td style="padding-top: 25px;"><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Expense</td>
						                                        <td style="padding-top: 30px;">FY2020-Q2</td>
						                                        <td ></td>
						                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
						                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="20"
						                                data-show-percent="true">
						                            </div></td>
						                             <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
						                                    </tr> <tr>
						                                        <th scope="row"><a href="javascript:void(0);" ><h6 id="myBtn3"><i class="simple-icon-plus btn-group-icon"></i>
                                                                        Add Measure</h6></a></th>
						                                        <td colspan="2"></td>
						                                        <td></td>

						                                    </tr>
						                                </tbody>
						                            </table>
						                        
						                                </div>
						                                </div>
						                                </div>

						                                <div class="col-12 col-lg-4">
						                                	 <div class="card mb-8">
						                                        <div class="card-body">
						                                   
						                                   <div class="d-flex flex-row mb-2  mb-4">
						                                                
						                                                <div class=" d-flex flex-grow-1 min-width-zero">
						                                                    <div
						                                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
						                                                        <div class="min-width-zero">
						                                                            <a href="#">
						                                                                <p class="mb-0 truncate">Revenue</p>
						                                                            </a>
						                                                            <p class="text-muted mb-0 text-small">315 Target</p>
						                                                        </div>
						                                                    </div>
						                                                </div>
						                                            </div>
						                                            <div class="dashboard-line-chart">
						                                                <canvas id="contributionChart1"></canvas>
						                                            </div>
						                                </div>
						                                </div>
						                                </div>
						                            </div>
						                        </div>

                        <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
                                             <div class="row">

                                <div class="col-lg-8 col-12 mb-4">
                                 <div class="card mb-8">
                                        <div class="card-body">
                            <table class="table table-borderless">
                                
                                <tbody>
                                    <tr>
                                        <td style="padding-top: 25px;"><i class="fa fa-arrow-down" style="font-size:23px;color:red;"></i>  Goods & Sales</td>
                                        <td style="padding-top: 30px;">FY2020-Q3</td>
                                        <td></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="40"
                                data-show-percent="true">
                            </div></td>
                            <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 25px;"><i class="fa fa-arrow-up" style="font-size:23px;color:green;"></i> Targets</td>
                                       <td style="padding-top: 30px;">FY2020-Q1</td>
                                        <td></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="10"
                                data-show-percent="true">
                            </div></td>
                            <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Ticket Sold</td>
                                        <td style="padding-top: 30px;">FY2020-Q2</td>
                                        <td ></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="20"
                                data-show-percent="true">
                            </div></td>
                            <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
                                    </tr><tr>
                                        <th scope="row"><a href="javascript:void(0);" ><h6 id="myBtn4"><i class="simple-icon-plus btn-group-icon"></i> Add Initiative</h6></a></th>
                                        <td colspan="2"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        
                                </div>
                                </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                	 <div class="card mb-8">
                                        <div class="card-body">
                                   
                                   <div class="d-flex flex-row mb-2  mb-4">
                                                
                                                <div class=" d-flex flex-grow-1 min-width-zero">
                                                    <div
                                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                        <div class="min-width-zero">
                                                            <a href="#">
                                                                <p class="mb-0 truncate">Goods & Sales</p>
                                                            </a>
                                                            <p class="text-muted mb-0 text-small">315 Target</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dashboard-line-chart">
                                                <canvas id="contributionChart2"></canvas>
                                            </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                                  <div class="row">

                                <div class="col-lg-8 col-12 mb-4">
                                 <div class="card mb-8">
                                        <div class="card-body">
                            <table class="table table-borderless">
                                
                                <tbody>
                                    <tr>
                                        <td style="padding-top: 25px;"><a href="javascript:void(0);" id="myBtn2"><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Product Sales</a></td>
                                        <td style="padding-top: 30px;">FY2020-Q1</td>
                                        
                                        <td></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="40"
                                data-show-percent="true">
                            </div></td>
                            <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
                            
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 25px;"><i class="fa fa-arrow-up" style="font-size:23px;color:green;"></i> Machinery Sales</td>
                                        <td style="padding-top: 30px;">FY2020-Q2</td>
                                        <td></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="10"
                                data-show-percent="true">
                            </div></td>
                            <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
                            
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 25px;"><i class="fa fa-arrow-down" style="font-size:23px;color:red;"></i> Commodities & Sales</th>
                                        <td style="padding-top: 30px;">FY2020-Q3</td>
                                        <td ></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="20"
                                data-show-percent="true">
                            </div></td>
                            <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
                            
                                    </tr>
                                </tbody>
                            </table>
                        
                                </div>
                                </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                	 <div class="card mb-8">
                                        <div class="card-body">
                                   
                                   <div class="d-flex flex-row mb-2  mb-4">
                                                
                                                <div class=" d-flex flex-grow-1 min-width-zero">
                                                    <div
                                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                        <div class="min-width-zero">
                                                            <a href="#">
                                                                <p class="mb-0 truncate">Product Sales</p>
                                                            </a>
                                                            <p class="text-muted mb-0 text-small">315 Target</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dashboard-line-chart">
                                                <canvas id="contributionChart3"></canvas>
                                            </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>




                        <div class="tab-pane fade" id="no" role="tabpanel" aria-labelledby="no-tab">
                                             <div class="row">

                                <div class="col-lg-8 col-12 mb-4">
                                 <div class="card mb-8">
                                        <div class="card-body">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col"><h6>Tasks</h6></th>
                                        <th scope="col"></th>
                                        <th scope="col"><h6>Due Date</h6></th>
                                        <th scope="col"><h6>Action</h6></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Check Progress Return</td>
                                        <td></td>
                                        <td>06/06/2020</td>
                                        <td><i class="fa fa-pencil"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Plan Departures</td>
                                        <td></td>
                                        <td>06/06/2020</td>
                                        <td><i class="fa fa-pencil"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Discuss Requirements</td>
                                        <td></td>
                                        <td>06/06/2020</td>
                                        <td><i class="fa fa-pencil"></i></td>
                                    </tr>
                                     <tr>
                                        <th scope="row"><a href="javascript:void(0);" id="myBtn5"><h6><i class="simple-icon-plus btn-group-icon"></i> Add Task</h6></a></th>
                                       
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
<!-- 
parent objective -->

<div class="modal modal-right" id="myModal2" role="dialog" >
                                <div class="modal-dialog" style="max-width: 99.99%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Product Sales</h5>
                                            <button type="button" class="close" id="popup3hide" aria-label="Close">
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
						                                aria-controls="first" aria-selected="true">Measure</a>
						                        </li>

						                        <li class="nav-item">
						                            <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab"
						                                aria-controls="third" aria-selected="false">Initiative</a>
						                        </li>
						                        <li class="nav-item">
						                            <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
						                                aria-controls="second" aria-selected="false">Sub Objective</a>
						                        </li>
						                        <li class="nav-item">
						                            <a class="nav-link" id="no-tab" data-toggle="tab" href="#no" role="tab"
						                                aria-controls="no" aria-selected="false">Tasks</a>
						                        </li>
						                    </ul>
						                    <div class="tab-content mb-4">
						                        <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
						                            <div class="row">

						                                <div class="col-lg-8 col-12 mb-4">
						                                 <div class="card mb-8">
						                                        <div class="card-body">
						                            <table class="table table-borderless">
						                                
						                                <tbody>
						                                    <tr>
						                                        <th scope="row"><i class="fa fa-arrow-up" style="font-size:23px;color:green;"></i> Revenue</th>
						                                        <td class="mt-3">FY2020-Q3</td>
						                                        <td></td>
						                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
						                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="40"
						                                data-show-percent="true">
						                            </div>
						                        </td>
						                        <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
						                                    </tr>
						                                    <tr>
						                                        <th scope="row"><i class="fa fa-arrow-down" style="font-size:23px;color:red;"></i> Net Profit</th>
						                                        <td class="mt-3">FY2020-Q1</td>
						                                        <td></td>
						                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
						                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="10"
						                                data-show-percent="true">
						                            </div></td>
						                             <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
						                                    </tr>
						                                    <tr>
						                                        <th scope="row"><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Expense</th>
						                                        <td class="mt-3">FY2020-Q2</td>
						                                        <td ></td>
						                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
						                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="20"
						                                data-show-percent="true">
						                            </div></td>
						                             <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
						                                    </tr> <tr>
						                                        <th scope="row"><a href="javascript:void(0);" id="myBtn3"><i class="simple-icon-plus btn-group-icon"></i>
                                                                        Add Measure</a></th>
						                                        <td colspan="2"></td>
						                                        <td></td>

						                                    </tr>
						                                </tbody>
						                            </table>
						                        
						                                </div>
						                                </div>
						                                </div>

						                                <div class="col-12 col-lg-4">
						                                	 <div class="card mb-8">
						                                        <div class="card-body">
						                                   
						                                   <div class="d-flex flex-row mb-2  mb-4">
						                                                
						                                                <div class=" d-flex flex-grow-1 min-width-zero">
						                                                    <div
						                                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
						                                                        <div class="min-width-zero">
						                                                            <a href="#">
						                                                                <p class="mb-0 truncate">Revenue</p>
						                                                            </a>
						                                                            <p class="text-muted mb-0 text-small">315 Target</p>
						                                                        </div>
						                                                    </div>
						                                                </div>
						                                            </div>
						                                            <div class="dashboard-line-chart">
						                                                <canvas id="salesChart"></canvas>
						                                            </div>
						                                </div>
						                                </div>
						                                </div>
						                            </div>
						                        </div>

                        <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
                                             <div class="row">

                                <div class="col-lg-8 col-12 mb-4">
                                 <div class="card mb-8">
                                        <div class="card-body">
                            <table class="table table-borderless">
                                
                                <tbody>
                                    <tr>
                                        <th scope="row"><i class="fa fa-arrow-down" style="font-size:23px;color:red;"></i>  Goods & Sales</th>
                                        <td class="mt-3">FY2020-Q3</td>
                                        <td></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="40"
                                data-show-percent="true">
                            </div></td>
                            <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="fa fa-arrow-up" style="font-size:23px;color:green;"></i> Targets</th>
                                       <td class="mt-3">FY2020-Q1</td>
                                        <td></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="10"
                                data-show-percent="true">
                            </div></td>
                            <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Ticket Sold</th>
                                        <td class="mt-3">FY2020-Q2</td>
                                        <td ></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="20"
                                data-show-percent="true">
                            </div></td>
                            <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
                                    </tr><tr>
                                        <th scope="row"><a href="javascript:void(0);" id="myBtn4"><i class="simple-icon-plus btn-group-icon"></i> Add Initiative</a></th>
                                        <td colspan="2"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        
                                </div>
                                </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                	 <div class="card mb-8">
                                        <div class="card-body">
                                   
                                   <div class="d-flex flex-row mb-2  mb-4">
                                                
                                                <div class=" d-flex flex-grow-1 min-width-zero">
                                                    <div
                                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                        <div class="min-width-zero">
                                                            <a href="#">
                                                                <p class="mb-0 truncate">Goods & Sales</p>
                                                            </a>
                                                            <p class="text-muted mb-0 text-small">315 Target</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dashboard-line-chart">
                                                <canvas id="contributionChart2"></canvas>
                                            </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
                                  <div class="row">

                                <div class="col-lg-8 col-12 mb-4">
                                 <div class="card mb-8">
                                        <div class="card-body">
                            <table class="table table-borderless">
                                
                                <tbody>
                                    <tr>
                                        <th scope="row"><a href="javascript:void(0);" id="myBtn2"><i class="fa fa-square" style="font-size:23px;color:yellow;"></i> Product Sales</a></th>
                                        <td class="mt-3">FY2020-Q1</td>
                                        
                                        <td></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="40"
                                data-show-percent="true">
                            </div></td>
                            <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
                            
                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="fa fa-arrow-up" style="font-size:23px;color:green;"></i> Machinery Sales</th>
                                        <td class="mt-3">FY2020-Q2</td>
                                        <td></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="10"
                                data-show-percent="true">
                            </div></td>
                            <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
                            
                                    </tr>
                                    <tr>
                                        <th scope="row"><i class="fa fa-arrow-down" style="font-size:23px;color:red;"></i> Commodities & Sales</th>
                                        <td class="mt-3">FY2020-Q3</td>
                                        <td ></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="20"
                                data-show-percent="true">
                            </div></td>
                            <td><i class="fa fa-line-chart mt-3" style="font-size:23px;"></i></td>
                            
                                    </tr>
                                </tbody>
                            </table>
                        
                                </div>
                                </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                	 <div class="card mb-8">
                                        <div class="card-body">
                                   
                                   <div class="d-flex flex-row mb-2  mb-4">
                                                
                                                <div class=" d-flex flex-grow-1 min-width-zero">
                                                    <div
                                                        class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                        <div class="min-width-zero">
                                                            <a href="#">
                                                                <p class="mb-0 truncate">Product Sales</p>
                                                            </a>
                                                            <p class="text-muted mb-0 text-small">315 Target</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dashboard-line-chart">
                                                <canvas id="contributionChart3"></canvas>
                                            </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>




                        <div class="tab-pane fade" id="no" role="tabpanel" aria-labelledby="no-tab">
                                             <div class="row">

                                <div class="col-lg-8 col-12 mb-4">
                                 <div class="card mb-8">
                                        <div class="card-body">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Tasks</th>
                                        <th scope="col"></th>
                                        <th scope="col">Due Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Check Progress Return</th>
                                        <td></td>
                                        <td>06/06/2020</td>
                                        <td><i class="fa fa-pencil"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Plan Departures</th>
                                        <td></td>
                                        <td>06/06/2020</td>
                                        <td><i class="fa fa-pencil"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Discuss Requirements</th>
                                        <td></td>
                                        <td>06/06/2020</td>
                                        <td><i class="fa fa-pencil"></i></td>
                                    </tr>
                                     <tr>
                                        <th scope="row"><a href="javascript:void(0);" id="myBtn5"><i class="simple-icon-plus btn-group-icon"></i> Add Task</a></th>
                                       
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



                            <div class="modal modal-right" id="myModal3" role="dialog" >
                                <div class="modal-dialog" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Measure</h5>
                                            <button type="button" class="close" id="popup4hide" aria-label="Close">
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
                                               
                                                <div class="form-group">
                                                    <label>Objective</label>
                                                    <select class="form-control">
                                                        <option label="&nbsp;">&nbsp;</option>
                                                        <option value="Flexbox">Objective 1</option>
                                                        <option value="Sass">Objective 2</option>
                                                        <option value="React">Objective 3</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Cycle</label>
                                                    <select class="form-control">
                                                        <option label="&nbsp;">&nbsp;</option>
                                                        <option value="Flexbox">FY2020-Q1</option>
                                                        <option value="Sass">FY2020-Q2</option>
                                                        <option value="React">FY2020-Q3</option>
                                                    </select>
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
                                           
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
<div class="modal modal-right" id="myModal5" role="dialog" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Task</h5>
                                            <button type="button" class="close" id="popup8hide" aria-label="Close">
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
                            <div class="modal modal-right" id="myModal4" role="dialog" >
                                <div class="modal-dialog" >
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Initiative</h5>
                                            <button type="button" class="close" id="popup5hide" aria-label="Close">
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

  
  <script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $("#myModal").modal('show');
  });
   $("#add_objectiveBtn").click(function(){
    $("#myModalAddObjective").modal('show');
  });
  
   $("#myBtn2").click(function(){
    $("#myModal2").modal('show');
  });
   $("#myBtn3").click(function(){
    $("#myModal3").modal('show');
  });
   $("#myBtn4").click(function(){
    $("#myModal4").modal('show');
  });$("#myBtn5").click(function(){
    $("#myModal5").modal('show');
  });
   
  $("#popup1hide").click(function(){
    $("#myModal").modal('hide');
  });
  
  $("#popup3hide").click(function(){
    $("#myModal2").modal('hide');
  });
  $("#popup4hide").click(function(){
    $("#myModal3").modal('hide');
  });
  $("#popup5hide").click(function(){
    $("#myModal4").modal('hide');
  }); $("#popup8hide").click(function(){
    $("#myModal5").modal('hide');
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
                            
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Objective') !!}</li>
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
										   <th> {!! SortableTrait::link_to_sorting_action('team_name',  getLabels('Cycle')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('team_head',  getLabels('Owner')) !!} </th>
											<th> {!! getLabels('action') !!} </th>
										</tr>
									</thead>
									<tbody>
												<tr class="odd gradeX">
													<td>
									<a href="javascript:void(0);" id="myBtn"><i class="fa fa-arrow-up" style="font-size:23px;color:green;"></i> Increase Share Holder Value
														</a></td>
													<td> FY2020-Q1</td>
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