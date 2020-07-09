<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('Objective'); ?></h1>
					<div class="text-zero top-right-button-container">
						<a href="javascript:void(0);" class=" btn btn-primary btn-sm top-right-button mr-1" onclick="addObjectivepop()"><?php echo getLabels('add_objective'); ?></a>
                        <button type="button" class="btn btn-outline-primary mb-1" id="filterBtn">Filters</button>
                            
                    </div>
                    <?php echo $__env->make('Element/objective/add_objective', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/objective/view_objective', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/measure/add_measure', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>       
                    <?php echo $__env->make('frontend/objectives/filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/measure/task', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/initiative/add_initiative', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
						                            <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">Measure</a>
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
     $("#myBtn3").click(function(){
        var objid = $("#objective_idview").val();
        $("#hideforobj").hide();
        $("#objectiveId").val(objid);
        onchangeobjectivegetcycle();
        $("#myModalAddMeasure").modal("show");
    });
    function addObjectivepop(slug){
        if(slug == "sub"){
            var heading = "Add Sub Objective";
            $("#addobjectiven").html(heading);
            var parobjeid = $("#objective_idview").val();
            $("#parent_objective_id").val(parobjeid);
        }else{
            var heading = "Add Objective";
            $("#addobjectiven").html(heading);
        }
        $("#myModalAddObjective").modal('show');
    }
     function onclickownershipadd(id){
        
        $("#ownership").html("");
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>";
        if(id == 1){
            $("#obj_teamtype").val("department");
            var selectlabel = "Select Department";
            var url = "<?php echo url('/getdepartments'); ?>"; 
        }else if(id == 2){
            $("#obj_teamtype").val("team");
            var selectlabel = "Select Team";
            var url = "<?php echo url('/getteams'); ?>";
        }else{
            $("#obj_teamtype").val("individual");
            var selectlabel = "Select Owners";
            var url = "<?php echo url('/getmembers'); ?>"
        }
        $.ajax({
            type:"POST",
            url: url,
            data:'_token='+token+'&company_id='+company_id,
            dataType:'JSON',
            success: function (response) {
                $("#ownership").append('<option value = "">'+selectlabel+'</option>')
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#ownership").append('<option value = "'+key+'">'+val+'</option>');
                  }
                }
            }  
        });
    }

$(document).ready(function(){
    var adderrormessage = "<?php echo session('adderrormessage')?session('adderrormessage'):''; ?>";
    if(adderrormessage != ''){
        $("#myModalAddObjective").modal('show');
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
  $("#popupaddhideObjective").click(function(){
    $("#myModalAddObjective").modal('hide');
  });

   $("#popupaddhideinitiative").click(function(){
    $("#myModalAddInitiative").modal('hide');
  });
   $("#popupaddhideMeasure").click(function(){
    $("#myModalAddMeasure").modal("hide");
   })
});
</script>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('Objective'); ?></li>
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
										   <th> <?php echo getLabels('Name'); ?></th>
										   <th> <?php echo getLabels('Cycle'); ?> </th>
											<th> <?php echo getLabels('Owner'); ?> </th>
                                            <th> <?php echo getLabels('Status'); ?> </th>
                                           <th> <?php echo getLabels('Aligned to'); ?> </th>
											<th> <?php echo getLabels('action'); ?> </th>
										</tr>
									</thead>
									<tbody>
                                        <?php if(!$data->isEmpty()): ?>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<tr>
													<td>
									<a href="javascript:void(0);" onclick="viewobjective('<?php echo $value->id; ?>')"><i class="<?php echo $value->status_icon; ?> heading-icon" style="color:<?php echo $value->bg_color; ?>"></i> <?php echo $value->heading; ?>

														</a></td>
													<td> <?php echo $value->cycle_name; ?></td>
													<td> <p class="text-semi-muted mb-2"><?php echo $value->owner_name; ?></p></td>
                                                    <td> <span class="badge badge-pill badge-success" style="background: <?php echo $value->bg_color; ?>"><?php echo $value->status_name; ?></span></td>
                                                    <td><?php echo $value->parent_objective; ?></td>
													<td>
														<div class="btn-group float-none-xs">
															<button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
																<?php echo getLabels('action'); ?>

															</button>
															<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
																<a class="dropdown-item" href="javascript:void(0);" onclick="updateObjective('<?php echo $value->id; ?>')"><?php echo getLabels('edit'); ?></a>
																
															</div>
														</div>
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
    <?php echo $__env->make('Element/objective/update_objective', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
    function updateObjective(id){
        $("#ownership_update").html("");
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>"; 
        $.ajax({
            type:"POST",
            url: "<?php echo url('updateobjective'); ?>",
            data:'_token='+token+'&company_id='+company_id+'&objective_id='+id,
            dataType:'JSON',
            success: function (all_response) {
                var response = all_response.objective;
                var teamsli = all_response.teams;
                var departmentli = all_response.departments;
                var memberli = all_response.members;
                var team_type = response.team_type;
                $("#obj_teamtype_update").val(team_type);
                $("#editId").val(response.id);
                $("#objective_heading_value").val(response.heading);
                $("#timeperiodsupdate").val(response.cycle_id);
                $("#perspectiveId").val(response.perspective_id);
                if(response.team_type == "department"){
                    $("#depactive").addClass('active');
                    $("#teamactive").removeClass('active');
                    $("#indiactive").removeClass('active');
                    $("#obj_department_id_update").val(response.department_id);
                    for (var depart in departmentli) {
                      if (departmentli.hasOwnProperty(depart)) {
                        var dep = departmentli[depart];
                        $("#ownership_update").append('<option value = "'+depart+'">'+dep+'</option>');                       
                     }
                    }
                    $("#ownership_update").val(response.department_id);
                }else if(response.team_type == "team"){
                    $("#depactive").removeClass('active');
                    $("#teamactive").addClass('active');
                    $("#indiactive").removeClass('active');
                    $("#obj_teamid_update").val(response.team_id);
                    for (var team in teamsli) {
                      if (teamsli.hasOwnProperty(team)) {
                        var tea = teamsli[team];
                        if(response.team_id == team){
                            $("#ownership_update").append('<option value = "'+team+'" selected="selected">'+tea+'</option>');
                        }else{
                            $("#ownership_update").append('<option value = "'+team+'">'+tea+'</option>');
                        }
                      }
                    }
                    $("#ownership_update").val(response.team_id);
                }else{
                    $("#depactive").removeClass('active');
                    $("#teamactive").removeClass('active');
                    $("#indiactive").addClass('active');
                    $("#obj_ind_owner_user_id_update").val(response.owner_user_id);
                    for (var member in memberli) {
                      if (memberli.hasOwnProperty(member)) {
                        var mem = memberli[member];
                        $("#ownership_update").append('<option value = "'+member+'">'+mem+'</option>');
                      }
                    }
                    $("#ownership_update").val(response.owner_user_id);
                }
                $("#scorecardsliupdate").html("");
                var selectedscorecard = response.scorecard_id;
                $("#objective_scorecard_update").val(selectedscorecard);
                $.ajax({
                    type:"POST",
                    url: "<?php echo url('/getscorecards'); ?>",
                    data:'_token='+token+'&company_id='+company_id,
                    dataType:'JSON',
                    success: function (scorecards) {
                        for (var scs in scorecards) {
                          if (scorecards.hasOwnProperty(scs)) {
                            var vals = scorecards[scs];
                            if(selectedscorecard.indexOf(scs) != -1){
                                $("#scorecardsliupdate").append('<option value = "'+scs+'" selected="selected">'+vals+'</option>');
                            }else{
                                $("#scorecardsliupdate").append('<option value = "'+scs+'">'+vals+'</option>');
                            }
                          }
                        }
                       
                    }  
                });
                $.ajax({
                    type:"POST",
                    url: "<?php echo url('/getthemes'); ?>",
                    data:'_token='+token+'&company_id='+company_id,
                    dataType:'JSON',
                    success: function (themes) {
                        for (var the in themes) {
                          if (themes.hasOwnProperty(the)) {
                            var thes = themes[the];
                            if(the == response.theme_id){
                                $("#themelistupdate").append('<option value = "'+the+'" selected="selected">'+thes+'</option>');
                            }else{
                                $("#themelistupdate").append('<option value = "'+the+'">'+thes+'</option>');
                            }
                          }
                        }
                    }  
                });
                var selectedcontributers = response.contributers;
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
                                $("#contributersupdate").append('<option value = "'+contri+'" selected="selected">'+con+'</option>');
                            }else{
                                $("#contributersupdate").append('<option value = "'+contri+'">'+con+'</option>');
                            }
                          }
                        }
                    }  
                });
                
                $("#goal_visibilityid").val(response.goal_visibility);
                $("#confidance_level_id").val(response.confidence_level);
                $("#status_id").val(response.status);
                $("#inputAboutYouupdate").val(response.summary);
                $("#updateobjectivemodal").modal("show");
            }  
        });
    }
    $("#popupaddhideObjectiveupdate").click(function(){
        $("#updateobjectivemodal").modal("hide");
    });

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
    function viewobjective(id){
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>"; 
        $("#measurelistvieww").html("");
        $("#tasklistid").html("");
        $("#objective_name_view").html("");
        $("#initiativelistobj").html("");
        $("#alignedobjectivelist").html("");
        $.ajax({
            type:"POST",
            url: "<?php echo url('/viewobjective'); ?>",
            data:'_token='+token+'&company_id='+company_id+'&id='+id,
            dataType:'JSON',
            success: function (response) {
                $("#objective_name_view").html('<i class="'+response.objectiveinfo.status_icon+' heading-icon" style="color:'+response.objectiveinfo.bg_color+';"></i>'+response.objectiveinfo.heading+'<p class="text-muted mb-0 text-small" style="margin-left: 35px;"><i class="simple-icon-clock"></i> '+response.objectiveinfo.cycle_name+'  <i class="simple-icon-people"></i> '+response.objectiveinfo.owner_name );
                $("#objective_idview").val(id);
                for (var i = 0; i < response.measuresList.length; i++) {
                    $("#measurelistvieww").append('<tr><td style="padding-top: 25px;"><a href="javascript:void(0);" onclick="onclickgraph()"><i class="'+response.measuresList[i].status_icon+' heading-icon" style="color:'+response.measuresList[i].bg_color+';"></i> '+response.measuresList[i].heading+' </a><p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY'+response.measuresList[i].measure_cycle_year+'-'+getQuarter(response.measuresList[i].measure_cycle_quarter)+'</p></td><td style="padding-top: 30px;"><p class="text-semi-muted mb-2">'+response.measuresList[i].owner_name+'</p></td><td><span class="badge badge-pill badge-success" style="background: '+response.measuresList[i].bg_color+';margin-top: 20px;">'+response.measuresList[i].status_name+'</span></td><td><div class="c100 p60 small" style="font-size:50px"><span>60%</span><div class="slice"><div class="bar"></div><div class="fill"></div></div></div></td></tr>');
                }
                for (var i = 0; i < response.subobjective.length; i++) {
                    $("#alignedobjectivelist").append('<tr><td style="padding-top: 25px;"><a href="javascript:void(0);" onclick="onclickgraph()"><i class="'+response.subobjective[i].status_icon+' heading-icon" style="color:'+response.subobjective[i].bg_color+';"></i> '+response.subobjective[i].heading+' </a><p class="text-muted mb-0 text-small" style="margin-left: 35px;">'+response.subobjective[i].cycle_name+'</p></td><td style="padding-top: 30px;"><p class="text-semi-muted mb-2">'+response.subobjective[i].owner_name+'</p></td><td><span class="badge badge-pill badge-success" style="background: '+response.subobjective[i].bg_color+';margin-top: 20px;">'+response.subobjective[i].status_name+'</span></td><td><div class="c100 p60 small" style="font-size:50px"><span>60%</span><div class="slice"><div class="bar"></div><div class="fill"></div></div></div></td></tr>');
                }
                for (var i = 0; i < response.initiativeList.length; i++) {
                    $("#initiativelistobj").append('<tr><td style="padding-top: 25px;"><a href="javascript:void(0);" onclick="onclickgraph()"><i class="'+response.initiativeList[i].status_icon+' heading-icon" style="color:'+response.initiativeList[i].bg_color+';"></i> '+response.initiativeList[i].heading+' </a><p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY'+response.initiativeList[i].measure_cycle_year+'-'+getQuarter(response.initiativeList[i].measure_cycle_quarter)+'</p></td><td style="padding-top: 30px;"><p class="text-semi-muted mb-2">'+response.initiativeList[i].owner_name+'</p></td><td><span class="badge badge-pill badge-success" style="background: '+response.initiativeList[i].bg_color+';margin-top: 20px;">'+response.initiativeList[i].status_name+'</span></td><td><div class="c100 p60 small" style="font-size:50px"><span>60%</span><div class="slice"><div class="bar"></div><div class="fill"></div></div></div></td></tr>');
                }
                for (var i = 0; i < response.tasklist.length; i++) {
                    $("#tasklistid").append('<tr><td>'+response.tasklist[i].task_name+'</td><td>'+response.tasklist[i].owners+'</td><td><span class="badge badge-pill badge-danger">'+response.tasklist[i].status_name+'</span></td><td><i class="iconsminds-right-1 heading-icon" style="cursor: pointer;"></i> <i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i>&nbsp;&nbsp;&nbsp; <i class="simple-icon-trash" style="font-size: initial;cursor: pointer;"></i></td></tr>'); 
                }
            }  
        });

        $("#myModal").modal('show');
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>