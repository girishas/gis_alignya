    @extends('frontend/layouts/default')
    <?php use App\Traits\SortableTrait;  ?>

    @section('content')
	<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 350px;
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
  },

  {
    name: "Milestone 4",
    fromDate: "2018-01-01 16:00",
    toDate: "2018-01-01 20:00",
    color: colorSet.getIndex(6).brighten(0)
  },
  {
    name: "Milestone 4",
    fromDate: "2018-01-01 20:30",
    toDate: "2018-01-01 24:00",
    color: colorSet.getIndex(6).brighten(0.4)
  },

  {
    name: "Milestone 5",
    fromDate: "2018-01-01 13:00",
    toDate: "2018-01-01 24:00",
    color: colorSet.getIndex(8).brighten(0)
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <main>
    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
    <h1>{!! getLabels('Measures') !!}</h1>
    <div class="text-zero top-right-button-container">
    <a href="javascript:void(0);" class=" btn btn-primary btn-sm top-right-button mr-1" id="add_objectiveBtn">{!! getLabels('add_measure') !!}</a>
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
                                            <a class="btn btn-dark mb-1 steamerst_link" href="{!!url('kpis')!!}">Show All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
    <!-- Modal -->
    <div class="modal modal-right" id="myModalAddObjective" role="dialog" >
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Measure</h5>
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
                            <label>Title</label>
                            <input type="text" class="form-control" placeholder="">
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
                   <button type="button" class="btn btn-primary">Submit</button>
                    
                </div>
            </div>
        </div>
    </div>


    <div class="modal modal-right" id="myModal" role="dialog" >
        <div class="modal-dialog" style="max-width: 99.99%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="iconsminds-up-1 heading-icon" style="color:#0fe50f;"></i> Ticket Prices Differential<p class="text-muted mb-0 text-small" style="margin-left: 35px;"><i class="
                                                simple-icon-clock"></i> FY2020-Q2 <a href="#" class="badge badge-pill badge-outline-info mb-1">Edit</a></p></h5>
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
    <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab"
        aria-controls="third" aria-selected="false">Tasks</a>
    </li>

    </ul>
    <div class="tab-content mb-4">
    <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
    <div class="row">

        <div class="col-lg-8 col-12 mb-4">
         <div class="card mb-8">
                <div class="card-body">
                    <div>
                     <button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float: right;">
                                                                {!! getLabels('filter') !!}
                                                            </button>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
                                                                <a class="dropdown-item" href="javascript:void(0);">{!! getLabels('this_week') !!}</a>
                                                              
                                                                <a class="dropdown-item" href="javascript:void(0);">{!! getLabels('this_month') !!}</a>
                                                              <a class="dropdown-item" href="javascript:void(0);">{!! getLabels('this_quater') !!}</a>
                                                              <a class="dropdown-item" href="javascript:void(0);">{!! getLabels('this_year') !!}</a>
                                                              <a class="dropdown-item" href="javascript:void(0);">{!! getLabels('all') !!}</a>
                                                                                                                          </div>
                                                             <br><br> 
                                                        </div>
                                                            
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
                <td>40</td>
                <td>50</td>
                <td >10/06/2020</td>
                <td>11/06/2020</td>
				<td><a href="javascript:void(0);"><i class="simple-icon-pencil"></i></a></td>
            </tr>
             <tr>
                <th scope="row"><a href="javascript:void(0);"><h6 id="myBtn2"><i class="simple-icon-plus btn-group-icon"></i> Add Milestone</a></h6></th>
               
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
                                        <p class="mb-0 truncate">Measure 1</p>
                                    </a>
                                    <p class="text-muted mb-0 text-small">315 Target</p>
                                </div>
                            </div>
                        </div>
                    </div>
					<!--<div id="chartdiv"></div>-->
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
                                        <td><span class="badge badge-pill badge-success">ON TARGET</span></td>
                                        <td><i class="iconsminds-right-1 heading-icon" style="cursor: pointer;"></i> <i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i>&nbsp;&nbsp;&nbsp; <i class="simple-icon-trash" style="font-size: initial;cursor: pointer;"></i></td>
                                    </tr>
                                    <tr>
                                        <td>Discuss Requirements</td>
                                        <td>06/06/2020</td>
                                        <td >Smith</td>
                                        <td ><span class="badge badge-pill badge-primary">HOLD</span></td>
                                        <td><i class="iconsminds-right-1 heading-icon" style="cursor: pointer;"></i> <i class="simple-icon-pencil" style="font-size: initial;cursor: pointer;"></i>&nbsp;&nbsp;&nbsp; <i class="simple-icon-trash" style="font-size: initial;cursor: pointer;"></i></td>
                                    </tr>
             <tr>
                <th scope="row"><a href="javascript:void(0);"><h6 id="myBtn1"><i class="simple-icon-plus btn-group-icon"></i> Add Task</a></h6></th>
               
            </tr>
        </tbody>
    </table>

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
                <th scope="row"><a href="javascript:void(0);" id="myBtn2">Sub Objective 1</a></th>
                <td></td>
                <td></td>
                <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
        data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="40"
        data-show-percent="true">
    </div></td>
            </tr>
            <tr>
                <th scope="row">Sub Objective 2</th>
                <td></td>
                <td></td>
                <td><div role="progressbar" class="progress-bar-circle position-relative" data-color="#922c88"
        data-trailColor="#d7d7d7" aria-valuemax="100" aria-valuenow="10"
        data-show-percent="true">
    </div></td>
            </tr>
            <tr>
                <th scope="row">Sub Objective 3</th>
                <td colspan="2"></td>
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
                                        <p class="mb-0 truncate">Sub Objective 1</p>
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
                              <label>Actual</label>
                          <input class="form-control" placeholder="">
        <div class="invalid-tooltip"></div>
    </div><div class="form-group ">
                              <label>Target</label>
                          <input class="form-control" placeholder="">
        <div class="invalid-tooltip"></div>
    </div><div class="form-group ">
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
    $("#myModalAddObjective").modal('show');
    });
$("#filterBtn").click(function(){
    $("#filterPop").modal('show');
  });
 $("#hideFilter").click(function(){
    $("#filterPop").modal('hide');
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

    <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Measures') !!}</li>
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
    				<th> {!! SortableTrait::link_to_sorting_action('measure_cycle_quarter',  getLabels('Cycle')) !!} </th>
                    <th> {!! SortableTrait::link_to_sorting_action('team_head',  getLabels('Owner')) !!} </th>
                    <th> {!! SortableTrait::link_to_sorting_action('status_name',  getLabels('Status')) !!} </th>
                    <th> {!! SortableTrait::link_to_sorting_action('team_head',  getLabels('Objective')) !!} </th>
    				<th> {!! getLabels('action') !!} </th>
    			</tr>
    		</thead>
    		<tbody>
    					@if(!$data->isEmpty())
                        @foreach($data as $key => $value)
                        <tr>
    						<td><a href="javascript:void(0);" id="myBtn"><i class="iconsminds-up-1 heading-icon" style="color:{!!$value->bg_color!!}"></i>{!!$value->heading!!}</td>
    						<td> FY{!!$value->measure_cycle_year!!}-{!!config('constants.Quarter.'.$value->measure_cycle_quarter)!!}</td>
                            <td> Jhon</td>
                            <td> <span class="badge badge-pill badge-success" style="background: {!!$value->bg_color!!}">{!!$value->status_name!!}</span></td>
                            <td>{!!$value->parent_objective!!}</td>
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