@extends('frontend/layouts/default')
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
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Initiatives') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="javascript:void(0);" class=" btn btn-primary btn-lg top-right-button mr-1" id="add_objectiveBtn">{!! getLabels('add_initiative') !!}</a>
                    </div>
                    
  <!-- Modal -->
                           @include('Element/initiative/add_initiative')
                           @include('Element/initiative/view_initiative')

							
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
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Initiatives') !!}</li>
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
										   <th> {!! getLabels('Name') !!} </th>
											<th> {!! getLabels('Cycle') !!} </th>
                                            <th> {!! getLabels('Owner') !!} </th>
                                            <th> {!! getLabels('Status') !!} </th>
                                            <th> {!!  getLabels('Objective') !!} </th>
											<th> {!! getLabels('action') !!} </th>
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