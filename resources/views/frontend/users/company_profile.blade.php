@extends('frontend/layouts/default')

@section('content')

	<main>
		<div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="mb-2">
                        <h1>{!!(!empty($company_details))?$company_details->company_name:""!!}</h1>
                         <div class="text-zero top-right-button-container">
						
                    </div>
                        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                            <ol class="breadcrumb pt-0">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li> 
                                 <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'companies') !!}">{!! getLabels('company') !!}</a>
                            </li>
                                <li class="breadcrumb-item active" aria-current="page">Company Profile</li>
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
                            <a href="{!!url('members')!!}" class="card">
                                <div class="card-body text-center">
                                    <i class="simple-icon-people"></i>
                                    <p class="card-text font-weight-semibold mb-0">Members</p>
                                    <p class="lead text-center">{!!$total_members!!}</p>
                                </div>
                            </a>
                        </div>
                       <div class="col-md-3 col-lg-4 col-sm-4 col-6 mb-4">
                            <a href="{!!url('team')!!}" class="card">
                                <div class="card-body text-center">
                                    <i class="iconsminds-money-bag"></i>
                                    <p class="card-text font-weight-semibold mb-0">Transactions</p>
                                    <p class="lead text-center">{!!$total_transactions!!}</p>
                                </div>
                            </a>
                        </div>
                        
                    </div>
                   
				   
                                    <div class="card mb-4"> 
                                        <div class="card-body">  
                                            <p class="text-muted text-small mb-2">Slogan</p>
                                            <p class="mb-3">{!!(!empty($company_details))?$company_details->slogan:""!!}</p>

                                            <p class="text-muted text-small mb-2">Address</p>
                                            <p class="mb-3">{!!(!empty($company_details))?($company_details->address):""!!}</p>
                                            <p class="text-muted text-small mb-2">Industry</p>
                                            <p class="mb-3">{!!(!empty($company_details)) && $company_details->industry_id ?(getIndustryName($company_details->industry_id))->name:""!!}</p>

                                            <p class="text-muted text-small mb-2">Subscription Plan</p>
                                            <p class="mb-3">
                                                <a href="#">
                                                    <span
                                                        class="badge badge-pill badge-outline-theme-2 mb-1">{!!$plan_details->heading!!} / {!!config('constants.PLAN_PERIOD.'.$plan_details->period)!!}</span>
                                                </a>
                                                
                                            </p>
                                            <p class="text-muted text-small mb-2">Registered Email</p>
                                            <div class="social-icons  mb-3">{!!(!empty($company_details))?($company_details->email):""!!}</div>
                                            <p class="text-muted text-small mb-2">Company Licence</p>
                                            <div class="social-icons  mb-3">{!!(!empty($company_details))?($company_details->comp_licence):""!!}</div>
                                            <p class="text-muted text-small mb-2">Company Currency</p>
                                            <div class="social-icons  mb-3">{!!(!empty($company_details))?($company_details->company_currency):""!!}</div>
                                             <p class="text-muted text-small mb-2">Fiscal Start Month</p>
                                            <div class="social-icons  mb-3">{!!(!empty($company_details))?(config('constants.COMPANY_FISCAL_MONTH.'.$company_details->fiscal_start_month)):""!!}</div>
                                            <p class="text-muted text-small mb-2">Contact</p>
                                            <div class="social-icons  mb-3">  {!!(!empty($company_details))?($company_details->mobile):""!!} </div>
                                        </div>
                                    </div>
                                    
                                  
                                  
                                </div>
							    <div class="col-12 col-lg-6"> 
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <a href="#">
                                    <p class="list-item-heading mb-1 color-theme-1">Mission</p> 
                                    <p class="mb-6 ">{!!(!empty($company_details))?($company_details->com_mission):""!!}</p>
                                </a>
                                <div class="separator"></div>
                            </div>
                             <div class="mb-4">
                                <a href="#">
                                    <p class="list-item-heading mb-1 color-theme-1">Vision</p> 
                                    <p class="mb-6">{!!(!empty($company_details))?($company_details->com_vision):""!!}</p>
                                </a>
                                <div class="separator"></div>
                            </div>
                             <div class="mb-4">
                                <a href="#">
                                    <p class="list-item-heading mb-1 color-theme-1">Values</p> 
                                    <p class="mb-6 ">{!!(!empty($company_details))?($company_details->com_values):""!!}</p>
                                </a>
                                <div class="separator"></div>
                            </div>
                            <div class="mb-4">
                                <a href="#">
                                    <p class="list-item-heading mb-1 color-theme-1">Company Competitive Advantages</p> 
                                    <p class="mb-6 ">{!!(!empty($company_details))?($company_details->com_competitive_advantages):""!!}</p>
                                </a>
                                <div class="separator"></div>
                            </div>
                             <div class="mb-4">
                                <a href="#">
                                    <p class="list-item-heading mb-1 color-theme-1">Company Focus Area</p> 
                                    <p class="mb-6">{!!(!empty($company_details))?($company_details->com_focus_area):""!!}</p>
                                </a>
                                <div class="separator"></div>
                            </div>
                             <div class="mb-4">
                                <a href="#">
                                    <p class="list-item-heading mb-1 color-theme-1">Company Strategic Issue</p> 
                                    <p class="mb-6 ">{!!(!empty($company_details))?($company_details->comp_strategic_issue):""!!}</p>
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

	<script type="text/javascript">
		function updateProfile(){
			$("#updateprofileopen").modal('show');
		}
		$("#updateprofilehide").click(function(){
		    $("#updateprofileopen").modal('hide');
		});
	</script>
@stop