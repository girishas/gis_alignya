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
						<a href="javascript:void(0);" class=" btn btn-primary btn-sm top-right-button mr-1" id="add_objectiveBtn">{!! getLabels('add_objective') !!}</a>
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
                                            <a class="btn btn-dark mb-1 steamerst_link" href="{!!url('objectives')!!}">Show All</a>
                                        </div>
                                    </div>
                                </div>
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
                                            <h5 class="modal-title"><i class="iconsminds-up-1 heading-icon" style="color:#0fe50f;"></i>  Increase Share Holder Value<p class="text-muted mb-0 text-small" style="margin-left: 35px;"><i class="
                                                simple-icon-clock"></i> FY2020-Q3  <a href="#" class="badge badge-pill badge-outline-info mb-1">Edit</a></p>



</h5>
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
						                                aria-controls="second" aria-selected="false">Aligned Objective</a>
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
						                                    <tr style="background: #f3f3f3;">
						                                        <td style="padding-top: 25px;"><i class="iconsminds-up-1 heading-icon" style="color:#0fe50f;"></i> Revenue <p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY2020-Q3</p></td>
						                                        <td style="padding-top: 30px;"><p class="text-semi-muted mb-2">John Ch.</p></td>
                    						                  <td> 
                                                                <span class="badge badge-pill badge-success" style="margin-top: 20px;">ON TARGET</span>  
                                                            </td>
						                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
						                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="40"
						                                data-show-percent="true">
						                            </div>
						                        </td>
						                       
						                                    </tr>
						                                    <tr>
						                                        <td style="padding-top: 25px;"><i class="iconsminds-down-1 heading-icon" style="color:red;"></i> Net Profit<p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY2020-Q1</p></td>
						                                        <td style="padding-top: 30px;"><p class="text-semi-muted mb-2">Emma Wh.</p></td>
						                                        <td> 
                                                                <span class="badge badge-pill badge-danger" style="margin-top: 20px;">AT RISK</span>  
                                                            </td>
						                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
						                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="10"
						                                data-show-percent="true">
						                            </div></td>
						                                    </tr>
						                                    <tr>
						                                        <td style="padding-top: 25px;"><i class="iconsminds-pause heading-icon" style="color:yellow;"></i> Expense <p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY2020-Q2</p></td>
						                                        <td style="padding-top: 30px;"><p class="text-semi-muted mb-2">Jolly RA.</p></td>
						                                        <td ><span class="badge badge-pill badge-secondary" style="    margin-top: 20px;">ON HOLD</span> </td>
						                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
						                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="20"
						                                data-show-percent="true">
						                            </div></td>
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
						                                                                <p class="mb-0 truncate"><i class="iconsminds-up-1 heading-icon" style="color:#0fe50f;"></i>Revenue</p>
						                                                            </a>
						                                                            <p class="text-muted mb-0 text-small" style="margin-left: 35px">FY2020-Q3</p>
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
                                    <tr style="background:#f3f3f3; ">
                                        <td style="padding-top: 25px;"><i class="iconsminds-down-1 heading-icon" style="color:red;"></i>  Goods & Sales<p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY2020-Q2</p></td>
                                        <td style="padding-top: 30px;"><p class="text-semi-muted mb-2">John Ch.</p></td>
                                        <td><span class="badge badge-pill badge-danger" style="margin-top: 20px;">AT RISK</span></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="40"
                                data-show-percent="true">
                            </div></td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 25px;"><i class="iconsminds-up-1 heading-icon" style="color:#0fe50f;"></i> Targets<p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY2020-Q1</p></td>
                                       <td style="padding-top: 30px;"><p class="text-semi-muted mb-2">Emma Ch.</p></td>
                                        <td><span class="badge badge-pill badge-success" style="margin-top: 20px;">ON TARGET</span></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="10"
                                data-show-percent="true">
                            </div></td>
                                    </tr>
                                    <tr>
                                        <td><i class="iconsminds-pause heading-icon" style="color:yellow;"></i></i> Ticket Sold <p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY2020-Q3</p></td>
                                        <td style="padding-top: 30px;"><p class="text-semi-muted mb-2">Jolly Ch.</p></td>
                                        <td ><span class="badge badge-pill badge-secondary" style="    margin-top: 20px;">ON HOLD</span></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="20"
                                data-show-percent="true">
                            </div></td>
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
                                                                <p class="mb-0 truncate"><i class="iconsminds-down-1 heading-icon" style="color:red;"></i>Goods & Sales</p>
                                                            </a>
                                                             <p class="text-muted mb-0 text-small" style="margin-left: 35px">FY2020-Q2</p>
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
                                    <tr  style="background:#f3f3f3; ">
                                        <td style="padding-top: 25px;"><a href="javascript:void(0);" ><i class="iconsminds-pause heading-icon" style="color:yellow;"></i> Product Sales<p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY2020-Q3</p></a></td>
                                        <td style="padding-top: 30px;"><p class="text-semi-muted mb-2">John Ch.</p></td>
                                        
                                        <td><span class="badge badge-pill badge-secondary" style="    margin-top: 20px;">ON HOLD</span></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="40"
                                data-show-percent="true">
                            </div></td>
                            
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 25px;"><i class="iconsminds-up-1 heading-icon" style="color:#0fe50f;"></i> Machinery Sales<p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY2020-Q1</p></td>
                                        <td style="padding-top: 30px;"><p class="text-semi-muted mb-2">Jolly Ch.</p></td>
                                        <td><span class="badge badge-pill badge-success" style="margin-top: 20px;">ON TARGET</span></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="10"
                                data-show-percent="true">
                            </div></td>
                            
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 25px;"><i class="iconsminds-down-1 heading-icon" style="color:red;"></i> Commodities & Sales<p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY2020-Q2</p></th>
                                        <td style="padding-top: 30px;"><p class="text-semi-muted mb-2">Jack Ch.</p></td>
                                        <td ><span class="badge badge-pill badge-danger" style="margin-top: 20px;">AT RISK</span></td>
                                        <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
                                data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="20"
                                data-show-percent="true">
                            </div></td>
                            
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
                                                                <p class="mb-0 truncate"><i class="iconsminds-pause heading-icon" style="color:yellow;"></i>Product Sales</p>
                                                            </a>
                                                           <p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY2020-Q3</p>
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
						                                aria-controls="second" aria-selected="false">Aligned Objective</a>
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
  $("#filterBtn").click(function(){
    $("#filterPop").modal('show');
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
			
			
			
            <div class="row mb-4">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead class="thead-light">
										<tr>
										   <th> {!! SortableTrait::link_to_sorting_action('heading',  getLabels('Name')) !!} </th>
										   <th> {!! SortableTrait::link_to_sorting_action('cycle_name',  getLabels('Cycle')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('owner_user_id',  getLabels('Owner')) !!} </th>
                                            <th> {!! SortableTrait::link_to_sorting_action('project_status_id',  getLabels('Status')) !!} </th>
                                           <th> {!! SortableTrait::link_to_sorting_action('objective_id',  getLabels('Aligned to')) !!} </th>
											<th> {!! getLabels('action') !!} </th>
										</tr>
									</thead>
									<tbody>
                                        @if(!$data->isEmpty())
                                        @foreach($data as $key => $value)
												<tr>
													<td>
									<a href="javascript:void(0);" id="myBtn"><i class="iconsminds-up-1 heading-icon" style="color:{!!$value->bg_color!!}"></i> {!!$value->heading!!}
														</a></td>
													<td> {!!$value->cycle_name!!}</td>
													<td> <p class="text-semi-muted mb-2">John Ch.</p></td>
                                                    <td> <span class="badge badge-pill badge-success" style="background: {!!$value->bg_color!!}">{!!$value->status_name!!}</span></td>
                                                    <td>{!!$value->parent_objective!!}</td>
													<td>
														<div class="btn-group float-none-xs">
															<button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
																{!! getLabels('action') !!}
															</button>
															<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
																<a class="steamerst_link dropdown-item" href="javascript:void(0);">{!! getLabels('edit') !!}</a>
																
															</div>
														</div>
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
@stop