@extends('frontend/layouts/default')

@section('content')

	 <main>
         <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Dashboard</h1>
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
                <div class="col-lg-12 col-xl-6">
                    <div class="icon-cards-row">
                        <div class="glide dashboard-numbers">
                            <div class="glide__track" data-glide-el="track">
                                <ul class="glide__slides">
                                    <li class="glide__slide">
                                        <a href="{!!url('objectives')!!}" class="card">
                                            <div class="card-body text-center">
                                                <i class="iconsminds-statistic"></i>
                                                <p class="card-text mb-0">Objectives</p>
                                                <p class="lead text-center">16</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="glide__slide">
                                        <a href="#" class="card">
                                            <div class="card-body text-center">
                                                <i class="simple-icon-layers"></i>
                                                <p class="card-text mb-0">KPIs</p>
                                                <p class="lead text-center">32</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="glide__slide">
                                        <a href="#" class="card">
                                            <div class="card-body text-center">
                                                <i class="simple-icon-list"></i>
                                                <p class="card-text mb-0">Tasks</p>
                                                <p class="lead text-center">512</p>
                                            </div>
                                        </a>
                                    </li>
                                     
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    
                    
                      <div class="col-md-12 col-sm-12 mb-4">
                    <div class="card dashboard-filled-line-chart">
                        <div class="card-body ">
                            <div class="float-left float-none-xs">
                                <div class="d-inline-block">
                                    <h5 class="d-inline">FY2020-Q2 Report</h5>
                                    <span class="text-muted text-small d-block"># Customer increase</span>
                                </div>
                            </div>
                            
                            <div class="position-absolute card-top-buttons">

                                    <button class="btn btn-header-light icon-button" type="button">
                                        <i class="simple-icon-settings"></i>
                                    </button>
                                    <button class="btn btn-header-light icon-button" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="simple-icon-chart"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right mt-3">
                                        <a class="dropdown-item" href="#">Bar Chart</a>
                                        <a class="dropdown-item" href="#">Line Chart</a> 
                                    </div>

                                </div> 
                             
                        </div>
                        <div class="chart card-body pt-0">
                            <canvas id="visitChart"></canvas>
                        </div>
                    </div>
                </div>

                    
                    
                    
                    
                    
                    
                    
                    
                    
                      </div>
                </div>
     <div class="col-xl-6 col-lg-12 mb-4">
     <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Objectives Insights</h5>
                            <table class="data-table data-table-standard responsive nowrap"
                                data-order="[[ 1, &quot;desc&quot; ]]">
                                <thead>
                                    <tr>
                                        <th>Projects</th> 
                                        <th>Owner</th> 
                                        <th></th>
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

             </div>
 
            

 

  
         </div>
    </main>
	
@stop