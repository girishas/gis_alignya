<?php use App\Traits\SortableTrait;  ?>
<style>
#chartdiv {
  width: 100%;
  height: 250px;
}

</style>
<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.paddingRight = 30;
chart.dateFormatter.inputDateFormat = "yyyy-MM-dd HH:mm";

var colorSet = new am4core.ColorSet();
colorSet.saturation = 0.4;

chart.data = [
  {
    name: "Milestone 1",
    fromDate: "2018-01-01 08:00",
    toDate: "2018-01-01 10:00",
    color: colorSet.getIndex(0).brighten(0)
  },
  {
    name: "Milestone 1",
    fromDate: "2018-01-01 12:00",
    toDate: "2018-01-01 15:00",
    color: colorSet.getIndex(0).brighten(0.4)
  },
  {
    name: "Milestone 1",
    fromDate: "2018-01-01 15:30",
    toDate: "2018-01-01 21:30",
    color: colorSet.getIndex(0).brighten(0.8)
  },

  {
    name: "Milestone 2",
    fromDate: "2018-01-01 09:00",
    toDate: "2018-01-01 12:00",
    color: colorSet.getIndex(2).brighten(0)
  },
  {
    name: "Milestone 2",
    fromDate: "2018-01-01 13:00",
    toDate: "2018-01-01 17:00",
    color: colorSet.getIndex(2).brighten(0.4)
  },

  {
    name: "Milestone 3",
    fromDate: "2018-01-01 11:00",
    toDate: "2018-01-01 16:00",
    color: colorSet.getIndex(4).brighten(0)
  },
  {
    name: "Milestone 3",
    fromDate: "2018-01-01 16:00",
    toDate: "2018-01-01 19:00",
    color: colorSet.getIndex(4).brighten(0.4)
  }
];

var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "name";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.inversed = true;

var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
dateAxis.dateFormatter.dateFormat = "yyyy-MM-dd HH:mm";
dateAxis.renderer.minGridDistance = 70;
dateAxis.baseInterval = { count: 30, timeUnit: "minute" };
dateAxis.max = new Date(2018, 0, 1, 24, 0, 0, 0).getTime();
dateAxis.strictMinMax = true;
dateAxis.renderer.tooltipLocation = 0;

var series1 = chart.series.push(new am4charts.ColumnSeries());
series1.columns.template.width = am4core.percent(80);
series1.columns.template.tooltipText = "{name}: {openDateX} - {dateX}";

series1.dataFields.openDateX = "fromDate";
series1.dataFields.dateX = "toDate";
series1.dataFields.categoryY = "name";
series1.columns.template.propertyFields.fill = "color"; // get color from data
series1.columns.template.propertyFields.stroke = "color";
series1.columns.template.strokeOpacity = 1;

chart.scrollbarX = new am4core.Scrollbar();

}); // end am4core.ready()
</script>
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('Initiatives'); ?></h1>
					<div class="text-zero top-right-button-container">
						<a href="javascript:void(0);" class=" btn btn-primary btn-lg top-right-button mr-1" id="add_objectiveBtn"><?php echo getLabels('add_initiative'); ?></a>
                    </div>
                    
  <!-- Modal -->
                           


							<div class="modal modal-right" id="myModal" role="dialog" >
                                <div class="modal-dialog" style="max-width: 99.99%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"> <i class="iconsminds-up-1 heading-icon" style="color:#18ca18;"></i> Airport Traffic
                                                <p style="margin-left: 40px;"><a href="#" class="badge badge-pill badge-outline-info mb-1">Edit</a> </p></h5>
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

                                <div class="col-lg-12 col-12 mb-4">
									<div id="chartdiv"></div>
								</div>
							   <div class="col-lg-12 col-12 mb-4">
                                 <div class="card mb-8">
                                        <div class="card-body">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col"><h6>Milestones</h6></th>
                                        
                                        <th scope="col"><h6>Actual</h6></th>
                                        <th scope="col"><h6>Target</h6></th>
                                        <th scope="col"><h6>Start Date</h6></th>
                                        <th scope="col"><h6>Due Date</h6></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Milestone 1</td>
                                        
                                        <td>10</td>
										<td>20</td>
										<td>06/06/2020</td>
										<td>07/06/2020</td>
										<td><a href="javascript:void(0);"><i class="simple-icon-pencil"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Milestone 2</td>
                                       
                                        <td>30</td>
										<td>40</td>
										<td>08/06/2020</td>
										<td>09/06/2020</td>
										<td><a href="javascript:void(0);"><i class="simple-icon-pencil"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>Milestone 3</td>
                                        <td>50</td>
										<td>60</td>
										<td>10/06/2020</td>
										<td>11/06/2020</td>
										<td><a href="javascript:void(0);"><i class="simple-icon-pencil"></i></a></td>
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

                                <div class="col-lg-12 col-12 mb-4">
                                 <div class="card mb-8">
                                        <div class="card-body">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col"><h6>Tasks</h6></th>
                                        <th scope="col"><h6>Due Date</h6></th>
                                        <th scope="col"><h6>Owner</h6></th>
                                        <th scope="col"><h6>Status</h6></th>
                                        <th scope="col"><h6>Action</h6></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Check Progress Return</td>
                                        <td>06/06/2020</td>
                                        <td>Jhon</td>
                                        <td><span class="badge badge-pill badge-danger">AT RISK</span></td>
                                        <td><i class="iconsminds-right-1 heading-icon" style="cursor: pointer;"></i> <i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i>&nbsp;&nbsp;&nbsp; <i class="simple-icon-trash" style="font-size: initial;cursor: pointer;"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Plan Departures</td>
                                        <td>06/06/2020</td>
                                        <td>Jack</td>
                                        <td><span class="badge badge-pill badge-danger">AT RISK</span></td>
                                        <td><i class="iconsminds-right-1 heading-icon" style="cursor: pointer;"></i> <i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i>&nbsp;&nbsp;&nbsp; <i class="simple-icon-trash" style="font-size: initial;cursor: pointer;"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Discuss Requirements</td>
                                        <td>06/06/2020</td>
                                        <td>Smith</td>
                                        <td><span class="badge badge-pill badge-success">Above Target</span></td>
                                        <td><i class="iconsminds-right-1 heading-icon" style="cursor: pointer;"></i> <i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i>&nbsp;&nbsp;&nbsp; <i class="simple-icon-trash" style="font-size: initial;cursor: pointer;"></i></td>
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
    $("#myModalAddInitiative").modal('show');
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
  $("#popupaddhideinitiative").click(function(){
    $("#myModalAddInitiative").modal('hide');
  });
});
</script>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('Initiatives'); ?></li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			<div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4"><?php echo getLabels('Search'); ?></h5>
                            <?php echo Form::open(array('url' => array($route_prefix.'/teams'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')); ?>

								<div class="form-body">
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												<?php echo Form::text('team_name', isset($_POST['team_name'])?trim($_POST['team_name']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_name'))); ?>

											</div>
										</div>
										
										<div class="col-lg-3">               
											<button class="btn btn-primary mb-1" type="submit"><?php echo getLabels('Search'); ?></button>
											<a class="btn btn-dark mb-1 steamerst_link" href="<?php echo url($route_prefix, 'teams'); ?>"><?php echo getLabels('show_all'); ?></a>
										</div>
									</div>
								</div>
							<?php echo Form::close(); ?>

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
										   <th> <?php echo SortableTrait::link_to_sorting_action('team_name',  getLabels('Name')); ?> </th>
											<th> <?php echo SortableTrait::link_to_sorting_action('team_head',  getLabels('Cycle')); ?> </th>
                                            <th> <?php echo SortableTrait::link_to_sorting_action('team_head',  getLabels('Owner')); ?> </th>
                                            <th> <?php echo SortableTrait::link_to_sorting_action('team_head',  getLabels('Status')); ?> </th>
                                            <th> <?php echo SortableTrait::link_to_sorting_action('team_head',  getLabels('Objective')); ?> </th>
											<th> <?php echo getLabels('action'); ?> </th>
										</tr>
									</thead>
									<tbody>
												<tr class="odd gradeX">
													<td><a href="javascript:void(0);" id="myBtn"> <i class="iconsminds-up-1 heading-icon" style="color:#18ca18;"></i> Airport Traffic</td>
													<td> FY2020-H1</td>
                                                    <td> Jhon</td>
                                                    <td> <span class="badge badge-pill badge-success">ON TARGET</span></td>
                                                    <td> Increase Goods & Sales</td>
													<td>
														<div class="btn-group float-none-xs">
															<button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<?php echo getLabels('action'); ?>

															</button>
															<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
																<a class="steamerst_link dropdown-item" href="javascript:void(0);"><?php echo getLabels('edit'); ?></a>
																
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Element/initiative/add_initiative', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>