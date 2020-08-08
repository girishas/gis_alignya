<div class="modal modal-right" id="viewinitiativemodal" role="dialog" >
                                <div class="modal-dialog" style="max-width: 99.99%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="initiativeheading"></h5>
                                            <button type="button" class="close" id="viewinitiativemodalhide" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="height: 600px;overflow: scroll;">
                                            
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12 survey-app">
                    <ul class="nav nav-tabs separator-tabs ml-0 mb-5" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="view_initiative_first-tab" data-toggle="tab" href="#view_initiative_first" role="tab"
                                aria-controls="view_initiative_first" aria-selected="true">Milestones</a>
                        </li>
<li class="nav-item">
                            <a class="nav-link " id="view_initiative_second-tab" data-toggle="tab" href="#view_initiative_second" role="tab"
                                aria-controls="view_initiative_second" aria-selected="true">Tasks</a>
                        </li>

                        
                    </ul>
                    <div class="tab-content mb-4">
                        <div class="tab-pane show active" id="view_initiative_first" role="tabpanel" aria-labelledby="view_initiative_first-tab">
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
                                        <th scope="row"><a href="javascript:void(0);" onclick="addinimilestone()"><h6 ><strong><i class="simple-icon-plus btn-group-icon"></i> Add Milestone</strong></h6></a></th>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        <input type="hidden" name="initiative_id" id = "viewpageinitiativeid">
                                </div>
                                </div>
                                </div>

                                
                            </div>
                        </div>
                        <div class="tab-pane show" id="view_initiative_second" role="tabpanel" aria-labelledby="view_initiative_second-tab">
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
                                        <th scope="row"><a href="javascript:void(0);" onclick="addTask('initiative')"><strong><i class="simple-icon-plus btn-group-icon"></i> Add Task</strong></a></th>
                                       
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
</script>