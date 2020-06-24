<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
<style type="text/css">
    
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
}

.dropdown-submenu:hover>.dropdown-menu {
    display: block;
}

.dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
}

.dropdown-submenu:hover>a:after {
    border-left-color: #fff;
}

.dropdown-submenu.pull-left {
    float: none;
}

.dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
}
</style>
  <main>
         <div class="container-fluid"> 
							

            <div class="row">
			
		
							
							
                <div class="col-12">
                    <h1> <span class="align-middle d-inline-block pt-1">Department Insights</span>   
                        </h1><nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        
                    </nav>
                        <div class="float-md-right">
							
  <script>
$(document).ready(function(){
    $("#myModal1").click(function(){
    $("#myModalAddDepartment").modal('show');
  
})
    $("#popupaddhidedepartment").click(function(){
    $("#myModalAddDepartment").modal('hide');
  });
})
</script>
                            <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               Choose Department
                            </button>
							
							<a href="<?php echo url('members'); ?>"><button type="button" class="btn btn-primary mb-1">Members</button></a>
							<a href="<?php echo url('team'); ?>"><button type="button" class="btn btn-primary mb-1">Teams</button></a>
							<button type="button" class="btn btn-primary mb-1" id="myModal1">Add Department</button>
                            
						
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(874px, 43px, 0px);">
                               <li class="dropdown-item"><a href="#">Some action</a></li>
                                <li class="dropdown-item"><a href="#">Some other action</a></li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-submenu">
                                  <a  class="dropdown-item" tabindex="-1" href="#">Hover me for more options</a>
                                  <ul class="dropdown-menu">
                                    <li class="dropdown-item"><a tabindex="-1" href="#">Second level</a></li>
                                    <li class="dropdown-submenu">
                                      <a class="dropdown-item" href="#">Even More..</a>
                                      <ul class="dropdown-menu">
                                          <li class="dropdown-item"><a href="#">3rd level</a></li>
                                            <li class="dropdown-submenu"><a class="dropdown-item" href="#">another level</a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                                <li class="dropdown-item"><a href="#">4th level</a></li>
                                            </ul>
                                          </li>
                                            <li class="dropdown-item"><a href="#">3rd level</a></li>
                                      </ul>
                                    </li>
                                    <li class="dropdown-item"><a href="#">Second level</a></li>
                                    <li class="dropdown-item"><a href="#">Second level</a></li>
                                  </ul>
                                </li>
                                                 
                            </div>
                        </div>
                    <div class="separator mb-5"></div>
                </div>
            </div>

			 
			
			
			
			  <div class="row">
			  
			  
			  
                                <div class="card col-lg-12 col-12 mb-4 ">
                                   
                                        <div class="position-absolute card-top-buttons">
                                            <button class="btn btn-header-light icon-button">
                                                <i class="simple-icon-pencil"></i>
                                            </button>
											
											 <button class="btn btn-header-light icon-button">
                                                <i class="iconsminds-folder-delete"></i>
                                            </button>
											
                                        </div>
                                        <div class="card-body">
                                            <p class="list-item-heading mb-4">Finance</p> 
                                           
                                               <div
                                                class="d-flex flex-row mb-3 pb-3 border-bottom justify-content-between align-items-center">
                                                <a href="#">
                                                    <img src="<?php echo url('public/img/profile-pic-l-2.jpg'); ?>" alt="Philip Nelms"
                                                        class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                                </a>
                                                <div class="pl-3 flex-fill">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-0">Philip Nelms ( Head of Department )</p>
                                                        <p class="text-muted mb-0 text-small">Last login  12:45</p>
                                                    </a>
                                                </div> 
                                            </div>
                                           
                                        </div>
                                   
                                </div>
                                
                
                <div class="card mb-4 col-lg-4 col-4">
                                        <div class="card-body">
                                            <h5 class="card-title">All Members</h5>

                                            <div
                                                class="d-flex flex-row mb-3 pb-3 border-bottom justify-content-between align-items-center">
                                                <a href="#">
                                                    <img src="<?php echo url('public/img/profile-pic-l-2.jpg'); ?>" alt="Philip Nelms"
                                                        class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                                </a>
                                                <div class="pl-3 flex-fill">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-0">Philip Nelms</p>
                                                        <p class="text-muted mb-0 text-small">09.08.2019 - 12:45</p>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a class="btn btn-outline-primary btn-xs" href="#">Reports</a>
                                                </div>
                                            </div>

                                            <div
                                                class="d-flex flex-row mb-3 pb-3 border-bottom justify-content-between align-items-center">
                                                <a href="#">
                                                    <img src="<?php echo url('public/img/profile-pic-l-4.jpg'); ?>" alt="Mimi Carreira"
                                                        class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                                </a>
                                                <div class="pl-3 flex-fill">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-0">Mimi Carreira</p>
                                                        <p class="text-muted mb-0 text-small">14.08.2019 - 10:10</p>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a class="btn btn-outline-primary btn-xs" href="#">Reports</a>
                                                </div>
                                            </div>

                                            <div
                                                class="d-flex flex-row mb-3 pb-3 border-bottom justify-content-between align-items-center">
                                                <a href="#">
                                                    <img src="<?php echo url('public/img/profile-pic-l-3.jpg'); ?>" alt="Brynn Bragg"
                                                        class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                                </a>
                                                <div class="pl-3 flex-fill">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-0">Brynn Bragg</p>
                                                        <p class="text-muted mb-0 text-small">23.07.2019 - 16:10</p>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a class="btn btn-outline-primary btn-xs" href="#">Reports</a>
                                                </div>
                                            </div>

                                            <div
                                                class="d-flex flex-row mb-3 pb-3 border-bottom justify-content-between align-items-center">
                                                <a href="#">
                                                    <img src="<?php echo url('public/img/profile-pic-l-7.jpg'); ?>" alt="Rasheeda Vaquera"
                                                        class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                                </a>
                                                <div class="pl-3 flex-fill">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-0">Rasheeda Vaquera</p>
                                                        <p class="text-muted mb-0 text-small">18.07.2019 - 12:00</p>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a class="btn btn-outline-primary btn-xs" href="#">Reports</a>
                                                </div>
                                            </div>

                                            <div
                                                class="d-flex flex-row mb-3 pb-3 border-bottom justify-content-between align-items-center">
                                                <a href="#">
                                                    <img src="<?php echo url('public/img/profile-pic-l-8.jpg'); ?>" alt="Mayra Sibley"
                                                        class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />
                                                </a>
                                                <div class="pl-3 flex-fill">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-0">Esperanza Lodge</p>
                                                        <p class="text-muted mb-0 text-small">13.07.2019 - 13:00</p>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a class="btn btn-outline-primary btn-xs" href="#">Reports</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                <div class="col-xl-8 col-lg-8 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Get Insights of Department Progress</h5>
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
					
		   </div>

    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Element/department/add_department', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>