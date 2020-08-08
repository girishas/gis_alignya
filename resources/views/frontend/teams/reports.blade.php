@if(empty($_POST))
@extends('frontend/layouts/default')
@endif


@if(empty($_POST))
@section('content')

	
  <main>
  @endif

 
      <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>
                            <i class="simple-icon-refresh heading-icon"></i>
                            <span class="align-middle d-inline-block pt-1">Reports</span>
                        </h1><nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Reports</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Objectives</li>
                        </ol>
                    </nav>
                        <div class="float-md-right">

                            <button type="button" class="btn btn-lg btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               Choose Objectives
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(874px, 43px, 0px);">
                                @if(!empty($objectives))
                                    @foreach($objectives as $key => $value)
                                        <a class="dropdown-item" href="{!!url('reports/'.$key)!!}">{!!$value!!}</a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    <div class="separator mb-5"></div>
                </div>
            </div>

			 
					
					
			
            <div class="row">
                <div class="col-12"> 
                    <div class="card mb-4"> 
					<div class="card-body"> 
                            <h5 class="mb-4">{!!isset($single_objective)?$single_objective->heading:""!!} <p class="d-sm-inline-block mb-2 ml-3">
                                                    <a href="#">
                                                        <span class="badge badge-pill badge-outline-theme-3 mb-1" style="color:white;background-color: {!!isset($single_objective)?$single_objective->bg_color:""!!}">{!!isset($single_objective)?$single_objective->status_name:""!!}</span>
                                                    </a>
                                                </p> 
												
												</h5>  
                             
                            <div class="row">
                                
                              <!--   <div class="col-lg-8 mb-5">
                                    <h6 class="mb-4">Sales Objective Measure 1</h6>
                                    <div class="chart-container chart">
                                        <canvas id="productChart"></canvas>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-5">
                                    <h6 class="mb-4">Summary</h6>
                                    <div class="chart-container chart">
                                        <div class="mb-4">
                                                <p class="mb-2">Overall Progress
                                                    <span class="float-right text-muted">5/52</span>
                                                </p>
                                                <div class="progress mb-3">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                    <div class="progress-bar bg-theme-2" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                                                </div>

                                                <table class="table table-sm table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span class="log-indicator border-theme-1 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span class="font-weight-medium text-muted text-small">52 Weekly Milestones
                                                                 </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span class="log-indicator border-theme-2 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span class="font-weight-medium text-muted text-small">5
                                                                    Report Submitted</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
												
												
											<p class="text-muted text-small mb-2">Strategic Theme</p>
                                            <p class="mb-3">Marketing </p>
											 
											<p class="text-muted text-small mb-2">Measure Actual - Target</p>
                                            <p class="mb-3">
                                                20 USD - 100 USD
                                            </p>
											
                                            <p class="text-muted text-small mb-2">Asigned To</p>
                                            <div class="mb-3">
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sarah Kortney">
                                                   <i class="simple-icon-user-following"></i>
                                                </a>
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Latarsha Gama">
                                                     <i class="simple-icon-user-following"></i>
                                                </a>
                                            </div>
                                             
											
                                            </div>
                                    </div>
                                
								</div>
                            <div class="col-lg-8 mb-5">
                                    <h6 class="mb-4">Sales Objective Measure 1</h6>
                                    <div class="chart-container chart">
                                        <canvas id="areaChartNoShadow"></canvas>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-5">
                                    <h6 class="mb-4">Summary</h6>
                                    <div class="chart-container chart">
                                        <div class="mb-4">
                                                <p class="mb-2">Overall Progress
                                                    <span class="float-right text-muted">5/52</span>
                                                </p>
                                                <div class="progress mb-3">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                    <div class="progress-bar bg-theme-2" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                                                </div>

                                                <table class="table table-sm table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span class="log-indicator border-theme-1 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span class="font-weight-medium text-muted text-small">52 Weekly Milestones
                                                                 </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span class="log-indicator border-theme-2 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span class="font-weight-medium text-muted text-small">5
                                                                    Report Submitted</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
												
												
											<p class="text-muted text-small mb-2">Strategic Theme</p>
                                            <p class="mb-3">Marketing </p>
											 
											<p class="text-muted text-small mb-2">Measure Actual - Target</p>
                                            <p class="mb-3">
                                                20 USD - 100 USD
                                            </p>
											
                                            <p class="text-muted text-small mb-2">Asigned To</p>
                                            <div class="mb-3">
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sarah Kortney">
                                                    <i class="simple-icon-user-following"></i>
                                                </a>
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Latarsha Gama">
                                                    <i class="simple-icon-user-following"></i>
                                                </a>
                                            </div>
                                             
											
                                            </div>
                                    </div>
                            
								</div>
                             -->
                             @if(!empty($measures))
                                    @foreach($measures as $key  => $value)

                                   
                             <div class="col-lg-8 mb-5">
                                    <h6 class="mb-4">{!!$value['heading']!!}</h6>
                                    <div class="chart-container chart">
                                        <canvas id="salesChart{!!$key!!}"></canvas>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-5">
                                    <h6 class="mb-4">Summary</h6>
                                    <div class="chart-container chart">
                                        <div class="mb-4">
                                                <p class="mb-2">Overall Progress
                                                    <span class="float-right text-muted">{!!round($value['percent_complete'],0)!!}%</span>
                                                </p>
                                                <div class="progress mb-3">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="{!!$value['percent_complete']!!}" aria-valuemin="0" aria-valuemax="100" style="width: {!!$value['percent_complete']!!}%;"></div>
                                                    
                                                </div>

                                                <table class="table table-sm table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span class="log-indicator border-theme-1 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span class="font-weight-medium text-muted text-small">{!!$value['total_milestone']!!} {!!config('constants.FREQUENCY.'.$value['check_in_frequency'])!!} Milestones
                                                                 </span>
                                                            </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
												
												
											<p class="text-muted text-small mb-2">Strategic Theme</p>
                                            <p class="mb-3">{!!isset($single_objective)?$single_objective->theme_name:""!!} </p>
											 
											<p class="text-muted text-small mb-2">Measure Actual - Target</p>
                                            <p class="mb-3">
                                                {!!$value['measure_actual']!!} {!!$value['measure_unit']!!} - {!!$value['measure_target']!!} {!!$value['measure_unit']!!}
                                            </p>
											
                                            <p class="text-muted text-small mb-2">Assigned To</p>
                                            <div class="mb-3">
                                               {!!$value['owner_name']!!}
                                            </div>
                                             
											
                                            </div>
                                    </div>
                                
								</div>
                                 @endforeach
                                 @else
                                 <p style="text-align: center;width: 100%">Please select objective to view detailed report and graphs</p>
                                @endif
                            <!-- <div class="col-lg-8 mb-5">
                                    <h6 class="mb-4">Sales Objective Measure 1</h6>
                                    <div class="chart-container chart">
                                        <canvas id="salesChartNoShadow"></canvas>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-5">
                                    <h6 class="mb-4">Summary</h6>
                                    <div class="chart-container chart">
                                        <div class="mb-4">
                                                <p class="mb-2">Overall Progress
                                                    <span class="float-right text-muted">5/52</span>
                                                </p>
                                                <div class="progress mb-3">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                    <div class="progress-bar bg-theme-2" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                                                </div>

                                                <table class="table table-sm table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span class="log-indicator border-theme-1 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span class="font-weight-medium text-muted text-small">52 Weekly Milestones
                                                                 </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span class="log-indicator border-theme-2 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span class="font-weight-medium text-muted text-small">5
                                                                    Report Submitted</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
												
												
											<p class="text-muted text-small mb-2">Strategic Theme</p>
                                            <p class="mb-3">Marketing </p>
											 
											<p class="text-muted text-small mb-2">Measure Actual - Target</p>
                                            <p class="mb-3">
                                                20 USD - 100 USD
                                            </p>
											
                                            <p class="text-muted text-small mb-2">Asigned To</p>
                                            <div class="mb-3">
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sarah Kortney">
                                                     <i class="simple-icon-user-following"></i>
                                                </a>
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Latarsha Gama">
                                                     <i class="simple-icon-user-following"></i>
                                                </a>
                                            </div>
                                             
											
                                            </div>
                                    </div>
                                
								
								 
								
								
								
								
								
								
								
								
								
								</div>
                            <div class="col-lg-8 mb-5">
                                    <h6 class="mb-4">Sales Objective Measure 1</h6>
                                    <div class="chart-container chart">
                                        <canvas id="productChartNoShadow"></canvas>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-5">
                                    <h6 class="mb-4">Summary</h6>
                                    <div class="chart-container chart">
                                        <div class="mb-4">
                                                <p class="mb-2">Overall Progress
                                                    <span class="float-right text-muted">5/52</span>
                                                </p>
                                                <div class="progress mb-3">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                    <div class="progress-bar bg-theme-2" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                                                </div>

                                                <table class="table table-sm table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span class="log-indicator border-theme-1 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span class="font-weight-medium text-muted text-small">52 Weekly Milestones
                                                                 </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span class="log-indicator border-theme-2 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span class="font-weight-medium text-muted text-small">5
                                                                    Report Submitted</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
												
												
											<p class="text-muted text-small mb-2">Strategic Theme</p>
                                            <p class="mb-3">Marketing </p>
											 
											<p class="text-muted text-small mb-2">Measure Actual - Target</p>
                                            <p class="mb-3">
                                                20 USD - 100 USD
                                            </p>
											
                                            <p class="text-muted text-small mb-2">Asigned To</p>
                                            <div class="mb-3">
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sarah Kortney">
                                                    <i class="simple-icon-user-following"></i>
                                                </a>
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Latarsha Gama">
                                                    <i class="simple-icon-user-following"></i>
                                                </a>
                                            </div>
                                             
											
                                            </div>
                                    </div>
                                
								
								 
								
								
								
								
								
								
								
								
								
								</div>
                            <div class="col-lg-8 mb-5">
                                    <h6 class="mb-4">Sales Objective Measure 1</h6>
                                    <div class="chart-container chart">
                                        <canvas id="areaChart"></canvas>
                                    </div>
                                </div>
                                <div class="col-lg-4 mb-5">
                                    <h6 class="mb-4">Summary</h6>
                                    <div class="chart-container chart">
                                        <div class="mb-4">
                                                <p class="mb-2">Overall Progress
                                                    <span class="float-right text-muted">5/52</span>
                                                </p>
                                                <div class="progress mb-3">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                    <div class="progress-bar bg-theme-2" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div>
                                                </div>

                                                <table class="table table-sm table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span class="log-indicator border-theme-1 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span class="font-weight-medium text-muted text-small">52 Weekly Milestones
                                                                 </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-0 pb-1 w-10">
                                                                <span class="log-indicator border-theme-2 align-middle"></span>
                                                            </td>
                                                            <td class="p-0 pb-1">
                                                                <span class="font-weight-medium text-muted text-small">5
                                                                    Report Submitted</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
												
												
											<p class="text-muted text-small mb-2">Strategic Theme</p>
                                            <p class="mb-3">Marketing </p>
											 
											<p class="text-muted text-small mb-2">Measure Actual - Target</p>
                                            <p class="mb-3">
                                                20 USD - 100 USD
                                            </p>
											
                                            <p class="text-muted text-small mb-2">Asigned To</p>
                                            <div class="mb-3">
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Sarah Kortney">
                                                    <i class="simple-icon-user-following"></i>
                                                </a>
                                                <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Latarsha Gama">
                                                    <i class="simple-icon-user-following"></i>
                                                </a>
                                            </div>
                                             
											
                                            </div>
                                    </div>
                                
								
								 
								
								
								
								
								
								
								
								
								
								</div>
                            
							
							
							
							
							
							
							
							
							
							
							
							
							
							 -->
							</div>
                        </div>
                    </div>



   </div>
            </div>
        </div>

  <script>
    <?php if($id){ ?>
    $(document).ready(function(){
        var id = "{!!$id!!}";
        if(id != ""){
            var measures = <?php echo json_encode($measures); ?>;
            for (var i = 0; i < measures.length; i++) {
                measureGraph(measures[i].plucked_milestone,measures[i].graph_labels,measures[i].actual_graph_data,measures[i].max_mile,measures[i].pojected_graph_data,i);
            }
        }
    })
  <?php  } ?>
   function measureGraph(target_data,labels,actual_data,max_value,projection_data,i){
    var contributionChartOptions = {
    type: "LineWithShadow",
    options: {
      plugins: {
        datalabels: {
          display: false
        }
      },
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        yAxes: [
          {
            gridLines: {
              display: true,
              lineWidth: 1,
              color: "rgba(0,0,0,0.1)",
              drawBorder: false
            },
            ticks: {
              beginAtZero: true,
              stepSize: max_value/10,
              min: 0,
              max: parseInt(max_value),
              padding: 20
            }
          }
        ],
        xAxes: [
          {
            gridLines: {
              display: false
            }
          }
        ]
      },
      legend: {
        display: false
      },
      
    },
    data: {
      labels: labels,
      datasets: [
        {
          borderWidth: 2,
          label: "",
          data: target_data,
          borderColor: "red",
       
          pointBorderColor: "red",
          pointHoverBackgroundColor: "red",
         
          pointRadius: 4,
          pointBorderWidth: 2,
          pointHoverRadius: 5,
          fill: false
        },
        {
          borderWidth: 2,
          label: "",
          data: actual_data,
          borderColor: "blue",
       
          pointBorderColor: "blue",
          pointHoverBackgroundColor: "blue",
         
          pointRadius: 4,
          pointBorderWidth: 2,
          pointHoverRadius: 5,
          fill: false
        },
        {
          borderWidth: 2,
          label: "",
          data: projection_data,
          borderColor: "yellow",
       
          pointBorderColor: "yellow",
          pointHoverBackgroundColor: "yellow",
         
          pointRadius: 4,
          pointBorderWidth: 2,
          pointHoverRadius: 5,
          fill: false
        },
        
      ]
    }
  };

  if (document.getElementById("salesChart"+i)) {
    var contributionChart1 = new Chart(
      document.getElementById("salesChart"+i).getContext("2d"),
      contributionChartOptions
    );
  }
}
</script> 
	@if(empty($_POST))
    </main>

@stop
@endif

