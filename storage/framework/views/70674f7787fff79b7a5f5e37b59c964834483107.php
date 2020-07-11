
                  <div class="modal modal-right" id="myModal" role="dialog" >
                      <div class="modal-dialog" style="max-width: 99.99%;">
                          <div class="modal-content view_objective_background_popup">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="objective_name_view"></h5>
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
                                                            aria-controls="first" aria-selected="true">Measure</a>
                                                    </li>

                                                    <li class="nav-item">
                                                        <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab"
                                                            aria-controls="third" aria-selected="false">Initiative</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab"
                                                            aria-controls="second" aria-selected="false">Aligned Objective</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="fourth-tab" data-toggle="tab" href="#fourth" role="tab"
                                                            aria-controls="fourth" aria-selected="false">Tasks</a>
                                                    </li>
                                                   
                                                </ul>
                                                <div class="tab-content mb-4">
                                                    <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                                                        <div class="row">
                                                            <div class="col-lg-8 col-12 mb-4">
                                                              <div class="card mb-8">
                                                                <div class="card-body">
                                                                  <table class="table table-borderless">
                                                                      
                                                                      <tbody id="measurelistvieww"></tbody>
                                                                      <tbody>
                                                                          <tr>
                                                                              <th scope="row"><a href="javascript:void(0);" onclick="addMeasure()"><h6><i class="simple-icon-plus btn-group-icon"></i>
                                                                                      Add Measure</h6></a></th>
                                                                              <td colspan="2"></td>
                                                                              <td></td>

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
                                                                                <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                                                                    <div class="min-width-zero">
                                                                                        <a href="#">
                                                                                          <p class="mb-0 truncate"><i class="iconsminds-up-1 heading-icon" style="color:#0fe50f;"></i>Revenue</p>
                                                                                        </a>
                                                                                        <p class="text-muted mb-0 text-small" style="margin-left: 35px">FY2020-Q3</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
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
                                    
                                    <tbody id="initiativelistobj">
                                       
                                    </tbody>
                                    <tbody>
                                           <tr>
                                              <th scope="row"><a href="javascript:void(0);" onclick="addInitiative()"><h6><i class="simple-icon-plus btn-group-icon"></i>
                                                      Add Initiative</h6></a></th>
                                              <td colspan="2"></td>
                                              <td></td>

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
                                    
                                    <tbody id="alignedobjectivelist">
                                        
                                    </tbody>
                                    <tbody>
                                        <input type="hidden" name="objective_id" id="objective_idview">
                                                                <tr>
                                                                    <th scope="row"><a href="javascript:void(0);" onclick="addObjectivepop('sub')"><h6><i class="simple-icon-plus btn-group-icon"></i>
                                                                            Add Sub Objective</h6></a></th>
                                                                    <td colspan="2"></td>
                                                                    <td></td>

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
                                                                    <p class="mb-0 truncate"><i class="iconsminds-pause heading-icon" style="color:yellow;"></i>Product Sales</p>
                                                                </a>
                                                               <p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY2020-Q3</p>
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

                                       <div class="tab-pane fade" id="fourth" role="tabpanel" aria-labelledby="fourth-tab">
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
                                <tbody id="tasklistid">
                                </tbody>
                                <tbody>
                                  <tr>
                                      <th scope="row"><a href="javascript:void(0);" onclick="addtask()"><h6><strong><i class="simple-icon-plus btn-group-icon"></i> Add Task</strong></a></h6></th>
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
                                    
                                    <tbody id="alignedobjectivelist">
                                        
                                    </tbody>
                                    <tbody>
                                        <input type="hidden" name="objective_id" id="objective_idview">
                                                                <tr>
                                                                    <th scope="row"><a href="javascript:void(0);" onclick="addObjectivepop('sub')"><h6><i class="simple-icon-plus btn-group-icon"></i>
                                                                            Add Sub Objective</h6></a></th>
                                                                    <td colspan="2"></td>
                                                                    <td></td>

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
                                                                    <p class="mb-0 truncate"><i class="iconsminds-pause heading-icon" style="color:yellow;"></i>Product Sales</p>
                                                                </a>
                                                               <p class="text-muted mb-0 text-small" style="margin-left: 35px;">FY2020-Q3</p>
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

<script>
 
    function addInitiative(){
      $("#hideforobjini").hide();
      $(".hideindivi").val($("#objective_idview").val());
      onchangeobjectivegetcycleinitiative();
      $("#myModalAddInitiative").modal('show');
    }
    function onclickgraph(){

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
                  stepSize: 5,
                  min: 50,
                  max: 70,
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
          labels: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec"
          ],
          datasets: [
            {
              borderWidth: 2,
              label: "",
              data: [40, 54, 63, 60, 65, 60, 68, 60, 63, 60, 65, 60, 80],
              borderColor: "red",
           
              pointBorderColor: "orange",
              pointHoverBackgroundColor: "#2b6ca1",
             
              pointRadius: 4,
              pointBorderWidth: 2,
              pointHoverRadius: 5,
              fill: false
            },
             {
              borderWidth: 2,
              label: "",
              data: [20, 27, 31, 120, 65, 60, 68, 60, 63, 60, 65, 60, 80],
              borderColor: "yellow",
           
              pointBorderColor: "red",
              pointHoverBackgroundColor: "#2b6ca1",
             
              pointRadius: 4,
              pointBorderWidth: 2,
              pointHoverRadius: 5,
              fill: false
            }
          ]
        }
      };

      if (document.getElementById("contributionChart1")) {
        var contributionChart1 = new Chart(
          document.getElementById("contributionChart1").getContext("2d"),
          contributionChartOptions
        );
      }

    }
    function addtask(){
      var objective_id = $("#objective_idview").val();
      $("#objectivetaskid").val(objective_id);
      $("#typetaskid").val(0);
      $("#myModalAddTask").modal('show');

    }
</script>