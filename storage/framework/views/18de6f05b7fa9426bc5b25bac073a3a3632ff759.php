<?php $__env->startSection('content'); ?>

	 <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Dashboard</h1>
					<div class="text-zero top-right-button-container">
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
                                <a class="dropdown-item" href="#">Add Member</a>
                            </div>
                        </div>
						
						
						
                        
                        
                        
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
					
                </div>
				
                <div class="col-lg-12 col-xl-12">
                    <div class="row icon-cards-row mb-4">
                       
                        
                           <div class="col-md-3 col-lg-2 col-sm-4 col-6 mb-4">
                                        <a href="<?php echo url('objectives'); ?>" class="card">
                                            <div class="card-body text-center">
                                                <i class="simple-icon-graph"></i>
                                                <p class="card-text mb-0">Objectives</p>
                                                <p class="lead text-center"><?php echo $objectives_count; ?></p>
                                            </div>
                                        </a>
								</div>
                                <div class="col-md-3 col-lg-2 col-sm-4 col-6 mb-4">
                                        <a href="<?php echo url('measures'); ?>" class="card">
                                            <div class="card-body text-center">
                                                <i class="simple-icon-hourglass"></i>
                                                <p class="card-text mb-0">Measures</p>
                                                <p class="lead text-center"><?php echo $measure_count; ?></p>
                                            </div>
                                        </a>
                                </div>
                                <div class="col-md-3 col-lg-2 col-sm-4 col-6 mb-4">
                                        <a href="<?php echo url('initiatives'); ?>" class="card">
                                            <div class="card-body text-center">
                                                <i class="simple-icon-book-open"></i>
                                                <p class="card-text mb-0">Initiatives</p>
                                                <p class="lead text-center"><?php echo $initiative_count; ?></p>
                                            </div>
                                        </a>
                                </div>
                                <div class="col-md-3 col-lg-2 col-sm-4 col-6 mb-4">
                                        <a href="<?php echo url('kpis'); ?>" class="card">
                                            <div class="card-body text-center">
                                                <i class="simple-icon-layers"></i>
                                                <p class="card-text mb-0">KPIs</p>
                                                <p class="lead text-center"><?php echo $kpi_count; ?></p>
                                            </div>
                                        </a>
                                </div>
                                <div class="col-md-3 col-lg-2 col-sm-4 col-6 mb-4">
                                        <a href="#" class="card">
                                            <div class="card-body text-center">
                                                <i class="simple-icon-list"></i>
                                                <p class="card-text mb-0">Tasks</p>
                                                <p class="lead text-center">512</p>
                                            </div>
                                        </a>
                                    </div>
                                     
                                
                            </div>
                        </div>
                    
     <div class="col-xl-6 col-lg-6 mb-4">
     <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Objectives Insights</h5>
                            <table class="data-table data-table-standard responsive nowrap"
                                data-order="[[ 1, &quot;desc&quot; ]]">
                                <thead>
                                    <tr>
                                        <th>Projects</th> 
                                        <th>Owner</th> 
                                        <th>Status</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead> 
                                
                                
                                
                                
                                <tbody>
                                    <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <i class="iconsminds-pause heading-icon"></i> 
                                        <span class="align-middle d-inline-block">Book train tickets</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">John Ch.</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-secondary">ON HOLD</span>  
                                        </td>
                                        <td>
                                            <div role="progressbar" class="progress-bar-circle position-relative"
                                                data-color="#922c88" data-trailColor="#d7d7d7" aria-valuemax="100"
                                                aria-valuenow="50" data-show-percent="true">
                                            </div>
                                        </td>
                                       
                                    </tr>
                                     <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <i class="iconsminds-right-1 heading-icon"></i> 
                                        <span class="align-middle d-inline-block">Book train tickets</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">John Ch.</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-primary">IN PROGRESS</span>  
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
                                        <i class="iconsminds-down-1 heading-icon"></i> 
                                        <span class="align-middle d-inline-block">Book train tickets</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">John Ch.</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-danger">AT RISK</span>  
                                        </td>
                                        <td>
                                            <div role="progressbar" class="progress-bar-circle position-relative"
                                                data-color="#922c88" data-trailColor="#d7d7d7" aria-valuemax="100"
                                                aria-valuenow="20" data-show-percent="true">
                                            </div>
                                        </td>
                                       
                                    </tr>
                                     <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <i class="iconsminds-up-1 heading-icon"></i> 
                                        <span class="align-middle d-inline-block">Book train tickets</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">John Ch.</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-success">ON TARGET</span>  
                                        </td>
                                        <td>
                                            <div role="progressbar" class="progress-bar-circle position-relative"
                                                data-color="#922c88" data-trailColor="#d7d7d7" aria-valuemax="100"
                                                aria-valuenow="90" data-show-percent="true">
                                            </div>
                                        </td>
                                       
                                    </tr>
                                     
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                              
               </div>
			   <div class="col-xl-6 col-lg-6 mb-4">
     <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Task Insights</h5>
                            <table class="data-table data-table-standard responsive nowrap"
                                data-order="[[ 1, &quot;desc&quot; ]]">
                                <thead>
                                    <tr>
                                        <th>Task</th> 
                                        <th>Owner</th> 
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead> 
                                
                                
                                
                                
                                <tbody>
                                    <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <span class="align-middle d-inline-block">Complete FY2020 Targets</span>
                                    </a>
                                        </td>
                                         <td> 
                                            <p class="text-semi-muted mb-2">Mark</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-primary">In-Progress</span>  
                                        </td>
                                        <td><a href="javascript:void(0);"><i class="simple-icon-pencil"></i></a>&nbsp;&nbsp;<a href="javascript:void(0);"><i class="simple-icon-action-undo"></i></a></td>
                                       
                                    </tr>
                                     <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <span class="align-middle d-inline-block">Assign sales orders</span>
                                    </a>
                                        </td>
                                         <td> 
                                            <p class="text-semi-muted mb-2">Susie</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-primary">In-Progress</span>  
                                        </td>
                                        <td><a href="javascript:void(0);"><i class="simple-icon-pencil"></i></a>&nbsp;&nbsp;<a href="javascript:void(0);"><i class="simple-icon-action-undo"></i></a></td>
                                       
                                    </tr>
                                     <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <span class="align-middle d-inline-block">Check assignments</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">John</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-danger">AT RISK</span>  
                                        </td>
                                        <td><a href="javascript:void(0);"><i class="simple-icon-pencil"></i></a>&nbsp;&nbsp;<a href="javascript:void(0);"><i class="simple-icon-action-undo"></i></a></td>
                                    </tr>
                                     <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <span class="align-middle d-inline-block">UI updates</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">Zac</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-success">Completed</span>  
                                        </td>
                                        <td><a href="javascript:void(0);"><i class="simple-icon-pencil"></i></a>&nbsp;&nbsp;<a href="javascript:void(0);"><i class="simple-icon-action-undo"></i></a></td>
                                       
                                    </tr>
                                     
                                     <tr>
                                        <td>
                                          <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="Apps.Todo.Details.html">
                                        <span class="align-middle d-inline-block">Report submission</span>
                                    </a>
                                        </td>
                                        
                                         
                                         <td> 
                                            <p class="text-semi-muted mb-2">Lie</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-success">Completed</span>  
                                        </td>
                                        <td><a href="javascript:void(0);"><i class="simple-icon-pencil"></i></a>&nbsp;&nbsp;<a href="javascript:void(0);"><i class="simple-icon-action-undo"></i></a></td>
                                       
                                    </tr>
                                     
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                              
               </div>

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
                                            <a href="<?php echo url('/dashboard'); ?>">
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
                                            <a href="<?php echo url('/dashboard'); ?>">
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
                                            <a href="<?php echo url('/dashboard'); ?>">
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
	<script type="text/javascript">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Element/team/add_team', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/department/add_department', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/kpi/add_kpi', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/initiative/add_initiative', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/measure/add_measure', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/objective/add_objective', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>