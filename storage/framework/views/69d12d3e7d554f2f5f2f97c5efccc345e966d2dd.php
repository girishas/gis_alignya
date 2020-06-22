<?php $__env->startSection('content'); ?>
	<main>
		<div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="mb-2">
                        <h1>abc private Ltd</h1>
                         
                        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                            <ol class="breadcrumb pt-0">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li> 
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
						 <div class="separator mb-5"></div>
                    </div>


                     <div class="tab-content">
                        <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                            <div class="row">
                                <div class="col-12 col-lg-6  col-left"> 
								 <div class="row icon-cards-row ">
                        <div class="col-md-3 col-lg-4 col-sm-4 col-6 mb-4">
                            <a href="<?php echo url('members'); ?>" class="card">
                                <div class="card-body text-center">
                                    <i class="simple-icon-people"></i>
                                    <p class="card-text font-weight-semibold mb-0">Members</p>
                                    <p class="lead text-center">160</p>
                                </div>
                            </a>
                        </div>
                       <div class="col-md-3 col-lg-4 col-sm-4 col-6 mb-4">
                            <a href="<?php echo url('team'); ?>" class="card">
                                <div class="card-body text-center">
                                    <i class="simple-icon-organization"></i>
                                    <p class="card-text font-weight-semibold mb-0">Teams</p>
                                    <p class="lead text-center">23</p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-lg-4 col-sm-4 col-6 mb-4">
                            <a href="<?php echo url('department'); ?>" class="card">
                                <div class="card-body text-center">
                                    <i class="iconsminds-embassy"></i>
                                    <p class="card-text font-weight-semibold mb-0">Departments</p>
                                    <p class="lead text-center">16</p>
                                </div>
                            </a>
                        </div>
                    </div>
                   
				   
                                    <div class="card mb-4"> 
                                        <div class="card-body">  
                                            <p class="text-muted text-small mb-2">About</p>
                                            <p class="mb-3">
                                                I spend my whole day, practically every day,
                                                experimenting with HTML, CSS, and JavaScript 
                                                through a few hundred RSS feeds. I build websites that delight and
                                                inform. I do it well.
                                            </p>

                                            <p class="text-muted text-small mb-2">Invoice Address</p>
                                            <p class="mb-3">Nairobi, Kenya</p>

                                            <p class="text-muted text-small mb-2">Subscription Plan</p>
                                            <p class="mb-3">
                                                <a href="#">
                                                    <span
                                                        class="badge badge-pill badge-outline-theme-2 mb-1">Basic / Monthly</span>
                                                </a>
                                                
                                            </p>
                                            <p class="text-muted text-small mb-2">Registered Email</p>
                                            <div class="social-icons  mb-3">dev.girishas@test.com</div>
                                            <p class="text-muted text-small mb-2">Contact</p>
                                            <div class="social-icons  mb-3">  6575757654 </div>
                                        </div>
                                    </div>
                                    
                                  
                                  
                                </div>
							    <div class="col-12 col-lg-6"> 
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <a href="#">
                                    <p class="list-item-heading mb-1 color-theme-1">Mission</p> 
                                    <p class="mb-6 ">Wedding cake with flowers Macarons and blueberries Wedding cake with flowers Macarons and blueberries</p>
                                </a>
                                <div class="separator"></div>
                            </div>
                             <div class="mb-4">
                                <a href="#">
                                    <p class="list-item-heading mb-1 color-theme-1">Vision</p> 
                                    <p class="mb-6  ">Wedding cake with flowers Macarons and blueberries Wedding cake with flowers Macarons and blueberries</p>
                                </a>
                                <div class="separator"></div>
                            </div>
                             <div class="mb-4">
                                <a href="#">
                                    <p class="list-item-heading mb-1 color-theme-1">Values</p> 
                                    <p class="mb-6 ">Wedding cake with flowers Macarons and blueberries</p>
                                </a>
                                <div class="separator"></div>
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

	</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>