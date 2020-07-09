<div class="modal modal-right" id="myModal" role="dialog" >
                                <div class="modal-dialog" style="max-width: 99.99%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="initiativeheading"></h5>
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
                                        <th scope="col"><h6><strong>Milestones</strong></h6></th>
                                        <th scope="col"><h6><strong>Start Date</strong></h6></th>
                                        <th scope="col"><h6><strong>Due Date</strong></h6></th>
                                        <th scope="col"><h6><strong>Action</strong></h6></th>
                                    </tr>
                                </thead>
                                <tbody id="initiativemilestonelist">
                                   
                                </tbody>
                                <tbody>
                                    <tr>
                                        <th scope="row"><a href="javascript:void(0);"><h6 id="myBtn2"><i class="simple-icon-plus btn-group-icon"></i> Add Milestone</h6></a></th>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        <input type="hidden" name="initiative_id" id = "viewpageinitiativeid">
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
                                        <th scope="col"><h6><strong>Tasks</strong></h6></th>
                                        <th scope="col"><h6><strong>Owner</strong></h6></th>
                                        <th scope="col"><h6><strong>Status</strong></h6></th>
                                        <th scope="col"><h6><strong>Action</strong></h6></th>
                                    </tr>
                                </thead>
                                <tbody id = "initiativetasklistview">
                                    
                                </tbody>
                                <tbody>
                                    <tr>
                                        <th scope="row"><a href="javascript:void(0);" onclick="addTask()"><i class="simple-icon-plus btn-group-icon"></i> Add Task</a></th>
                                       
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
<script type="text/javascript">
    function addTask(){
        $("#measuretaskid").val($("#viewpageinitiativeid").val());
        $("#typetaskid").val(2);
        $("#myModalAddTask").modal("show");
    }
</script>>