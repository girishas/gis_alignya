<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
  <main>
        <div class="container-fluid"> 
            <div class="row">
                <div class="col-12">
                    <h1> <span class="align-middle d-inline-block pt-1">Team Insights</span>   
                        </h1><nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        
                    </nav>
                        <div class="float-md-right">
                            <button type="button" class="btn btn-primary mb-1" id="myModal1">Add Team</button>

                         

  
  <script>
$(document).ready(function(){

    var addteamerror = "<?php echo session('errormessageadd')?session('errormessageadd'):''; ?>";
    if(addteamerror != ""){
        $("#myModalAddTeam").modal('show');
    }
    $("#myModal1").click(function(){
    $("#myModalAddTeam").modal('show');
  
})
    $("#popupaddhideteam").click(function(){
    $("#myModalAddTeam").modal('hide');
  });
   $("#popupupdatehideteam").click(function(){
    $("#myModalUpdateTeam").modal('hide');
  });
})
</script>
                            <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split top-right-button top-right-button-single" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                               Choose Team
                            </button> 
                            
                            <a href="<?php echo url('members'); ?>"><button type="button" class="btn btn-primary mb-1">Members</button></a>
                            <a href="<?php echo url('department'); ?>"><button type="button" class="btn btn-primary mb-1">Departments</button></a>
                            
                            
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(874px, 43px, 0px);">
                                <?php if(!empty($data)): ?>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="dropdown-item" href="<?php echo url('team/'.$v->id); ?>"><?php echo $v->team_name; ?></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <div class="separator mb-5"></div>
                </div>
            </div>

           <?php if(session('message')): ?>
            <div class="alert alert-success" role="alert" style="z-index: unset;">
                <?php echo session('message'); ?>

            </div>
            <?php endif; ?>
            <?php if(!empty($team_detail)): ?>
            
              <div class="row">
              
              
              
                                <div class="card col-lg-12 col-12 mb-4 ">
                                   
                                        <div class="position-absolute card-top-buttons">
                                            
                                            <button class="btn btn-header-light icon-button" onclick="updateTeam()">
                                                <i class="simple-icon-pencil"></i>
                                            </button>
                                            <?php
                                                $remove_url = url($route_prefix."/team/remove/".$team_detail->id); 
                                                $remove_msg = getLabels('are_you_sure'); ?>
                                                <a onclick = 'showConfirmationModal("Remove", "<?php echo $remove_msg; ?>", "<?php echo $remove_url; ?>");' href="javascript:void(0);">
                                                    <button class="btn btn-header-light icon-button">
                                                        <i class="simple-icon-trash"></i>
                                                    </button>
                                                    </a>
                                           
                                        </div>
                                        <div class="card-body">
                                            <p class="list-item-heading mb-4"><?php echo $team_detail->team_name; ?></p> 
                                           
                                               <div
                                                class="d-flex flex-row mb-3 pb-3 border-bottom justify-content-between align-items-center">
                                                <?php if($team_detail->photo and file_exists('public/upload/users/profile-photo/'. $team_detail->photo) ): ?>
                                                     <img src="<?php echo url('public/upload/users/profile-photo/'.$team_detail->photo); ?>" alt="Philip Nelms"class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />            
                                                <?php else: ?>
                                                     <img src="<?php echo url('/img/no_images.png'); ?>" alt="Philip Nelms"class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />  
                                                <?php endif; ?>
                                                <div class="pl-3 flex-fill">
                                                    <a href="#">
                                                        <p class="font-weight-medium mb-0"><?php echo $team_detail->team_head_name; ?> ( Team Leader )</p>
                                                        <p class="text-muted mb-0 text-small"><?php echo $team_detail->designation; ?></p>
                                                    </a>
                                                </div> 
                                            </div>
                                           
                                        </div>
                                   
                                </div>
                                
                
                                    <div class="card mb-4 col-lg-4 col-4">
                                        <div class="card-body">
                                            <h5 class="card-title">All Members</h5>
                                            <?php if(!empty($team_members)): ?>
                                            <?php $__currentLoopData = $team_members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h => $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div
                                                class="d-flex flex-row mb-3 pb-3 border-bottom justify-content-between align-items-center">
                                                <a href="javascript:void(0)">
                                                     <?php if($j->photo and file_exists('public/upload/users/profile-photo/'. $j->photo) ): ?>
                                                     <img src="<?php echo url('public/upload/users/profile-photo/'.$j->photo); ?>" alt="Philip Nelms"class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />            
                                                <?php else: ?>
                                                     <img src="<?php echo url('/img/no_images.png'); ?>" alt="Philip Nelms"class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall" />  
                                                <?php endif; ?>
                                                </a>
                                                <div class="pl-3 flex-fill">
                                                    <a href="javascript:void(0)">
                                                        <p class="font-weight-medium mb-0"><?php echo $j->first_name.' '.$j->last_name; ?></p>
                                                        <p class="text-muted mb-0 text-small"><?php echo $team_detail->designation; ?></p>
                                                    </a>
                                                </div>
                                                <div>
                                                    <a class="btn btn-outline-primary btn-xs" href="javascript:void(0)" onclick="getReprts('<?php echo $j->team_lead_id; ?>')">Reports</a>
                                                </div>
                                            </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            
                                        </div>
                                    </div>

                <div class="col-xl-8 col-lg-8 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Get Insights of Team Progress</h5>
                            <table class="data-table data-table-standard responsive nowrap"
                                data-order="[[ 1, &quot;desc&quot; ]]">
                                <thead>
                                    <tr>
                                        <th>Projects</th> 
                                        <th>Type</th> 
                                        <th>Status</th>
                                        <th>Progress</th>
                                    </tr>
                                </thead> 
                                
                                <tbody id = "getinsights">
                                    <?php if(!empty($objectives)): ?>
                                    <?php $__currentLoopData = $objectives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $obj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="javascript:void(0);">
                                                <span class="align-middle d-inline-block"><?php echo $obj->heading; ?></span>
                                            </a>
                                        </td>
                                        <td> 
                                            <p class="text-semi-muted mb-2">Objective</p>  
                                        </td>
                                          <td> 
                                            <span class="badge badge-pill badge-secondary">ON HOLD</span>  
                                        </td>
                                        <td>
                                            <div role="progressbar" class="progress-bar-circle position-relative"
                                                data-color="#922c88" data-trailColor="#d7d7d7" aria-valuemax="100"
                                                aria-valuenow="40" data-show-percent="true">
                                            </div>
                                        </td>
                                       
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
              <?php else: ?>
              No Record Founds
              <?php endif; ?>
           </div>

    </main>
     

    <script type="text/javascript">
        function getReprts(id){
            $("#getinsights").html("");
            var token = "<?php echo csrf_token(); ?>";
            var company_id = "<?php echo Auth::User()->company_id; ?>";
            $.ajax({
                type:"POST",
                url: "<?php echo url('/getprojectinsightsobjective'); ?>",
                data:'_token='+token+'&company_id='+company_id+'&id='+id,
                dataType:'JSON',
                success: function (response) {
                    for (var i = 0; i < response.length; i++) {
                        $("#getinsights").append('<tr><td><a class="list-item-heading mb-0 truncate w-40 w-xs-100 mt-0" href="javascript:void(0);"><span class="align-middle d-inline-block">'+response[i].heading+'</span></a></td><td> <p class="text-semi-muted mb-2">Objective</p></td><td><span class="badge badge-pill badge-secondary">ON HOLD</span></td><td><div role="progressbar" class="progress-bar-circle position-relative"data-color="#922c88" data-trailColor="#d7d7d7" aria-valuemax="100"aria-valuenow="40" data-show-percent="true"></div></td></tr>');
                        
                    }
                }  
            });

        }
        function updateTeam(){
            $("#myModalUpdateTeam").modal('show');
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Element/team/update_team', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/team/add_team', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>