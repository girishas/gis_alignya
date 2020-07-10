

    <div class="modal modal-right" id="myModal" role="dialog" >
        <div class="modal-dialog" style="max-width: 99.99%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="view_measure_heading"></h5>
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
                            <th scope="col"><h6><strong>Milestones</h6></th>
                            
                            <th scope="col"><h6><strong>Actual</strong></h6></th>
                            <th scope="col"><h6><strong>Target</strong></h6></th>
                            <th scope="col"><h6><strong>Start Date</strong></h6></th>
                            <th scope="col"><h6><strong>Due Date</strong></h6></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="milestonelistmeasureview">     
                    </tbody>
                    <tbody>
                        <input type="hidden" name="measure_id" id="measure_id_view">
                        <tr>
                            <th scope="row"><a href="javascript:void(0);" onclick="addmilestoneMeasureView()"><h6><strong><i class="simple-icon-plus btn-group-icon"></i> Add Milestone</strong></a></h6></th>
                           
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
                                <th scope="col"><h6><strong>Tasks</strong></h6></th>
                                <th scope="col"><h6><strong>Owner</strong></h6></th>
                                <th scope="col"><h6><strong>Status</strong></h6></th>
                                <th scope="col"><h6><strong>Action</strong></h6></th>
                            </tr>
                        </thead>
                        <tbody id="addtaskmeasureview">
                                                       
                        </tbody>
                        <tbody>
                            <tr>
                                <th scope="row"><a href="javascript:void(0);" onclick="addTask()"><h6><strong><i class="simple-icon-plus btn-group-icon"></i> Add Task</strong></a></h6></th>
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