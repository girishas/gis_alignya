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


<?php $__env->startSection('content'); ?>
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('Initiatives'); ?></h1>
                    <div class="text-zero top-right-button-container">
                        <a href="javascript:void(0);" class=" btn btn-primary btn-sm top-right-button mr-1" id="add_objectiveBtn"><?php echo getLabels('add_initiative'); ?></a>
                        <button type="button" class="btn btn-outline-primary mb-1" onclick="filter()">Filters</button>

                    </div>
                    <?php echo $__env->make('Element/initiative/filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/initiative/add_initiative', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/initiative/view_initiative', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/initiative/add_milestone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/initiative/update_milestone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/initiative/update_initiative', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/measure/task', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('Element/measure/update_task', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    
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
            
           
            
            <div class="row mb-4">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                           <th> <?php echo getLabels('Name'); ?> </th>
                                            <th> <?php echo getLabels('Cycle'); ?> </th>
                                            <th> <?php echo getLabels('Owner'); ?> </th>
                                            <th> <?php echo getLabels('Status'); ?> </th>
                                            <th> <?php echo getLabels('Objective'); ?> </th>
                                            <th> <?php echo getLabels('action'); ?> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(!$data->isEmpty()): ?>
                                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $remove_url = url("initiative/remove/".$value->id); 
                                                    $remove_msg = getLabels('are_you_sure?'); ?>
                                                <tr>
                                                    <td><a href="javascript:void(0);" onclick="view_initiativepop('<?php echo $value->id; ?>')"> <i class="<?php echo $value->status_icon; ?> heading-icon" style="color:<?php echo $value->bg_color; ?>;"></i><?php echo $value->heading; ?></td>
                                                    <td>FY<?php echo $value->measure_cycle_year; ?>-<?php echo config('constants.Quarter.'.$value->measure_cycle_quarter); ?></td>
                                                    <td> <?php echo $value->owner_name; ?></td>
                                                    <td> <span class="badge badge-pill badge-success" style="background-color: <?php echo $value->bg_color; ?>"><?php echo $value->status_name; ?></span></td>
                                                    <td> <?php echo $value->parent_objective; ?></td>
                                                    <td>
                                                          <a  href="javascript:void(0);" onclick="updateinitiative('<?php echo $value->id; ?>')"><i class="simple-icon-pencil heading-icon"></i></a>
                                                          <a href="javascript:void(0);" onclick="view_initiativepop('<?php echo $value->id; ?>')"> <i class="iconsminds-information heading-icon" ></i>
                                                            <a onclick = 'showConfirmationModal("Remove", "<?php echo $remove_msg; ?>", "<?php echo $remove_url; ?>");' href="javascript:void(0);"><i class="simple-icon-trash heading-icon"></i></a>
                                                    </td>
                                                </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>   
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



<?php echo $__env->make('Element/js/includejs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <script>
    
    // function updateTask(id){
    //     $("#update_task_id").val(id);
    //     var token = "<?php echo csrf_token(); ?>";
    //     var company_id = "<?php echo Auth::User()->company_id; ?>";
    //     $.ajax({
    //         type:"POST",
    //         url: "<?php echo url('getTaskDetails'); ?>",
    //         data:'_token='+token+'&company_id='+company_id+'&task_id='+id,
    //         dataType:'JSON',
    //         success: function (response) {
    //             var taskdetails = response.task_details;
    //             $("#task_name_update_id").val(taskdetails.task_name);
    //             $("#task_description_update_id").val(taskdetails.description);
    //              $("#task_status_id").val(taskdetails.status);
    //             var owners = response.owners;
    //             for (var own in owners) {
    //                 if (owners.hasOwnProperty(own)) {
    //                     var owner = owners[own];
    //                     if(taskdetails.owners.indexOf(own) != -1){
    //                         $("#owners_update_id").append('<option value = "'+own+'" selected="selected">'+owner+'</option>');
    //                     }else{
    //                         $("#owners_update_id").append('<option value = "'+own+'">'+owner+'</option>');
    //                     }
    //                   }
    //                 }
    //             }  
    //     });
    //     $("#myModalUpdateTask").modal("show");
    // }
    function filter(){
        $("#filterPop").modal("show");
    }

    function getQuarter(quater){
        if(quater == 0){
            var value = "FULL";
        }else if(quater == 1){
            var value = "Q1";
        }else if(quater == 2){
            var value = "Q2";
        }else if(quater == 3){
            var value = "Q3";
        }else if(quater == 4){
            var value = "Q4";
        }else if(quater == 5){
            var value = "H1";
        }else if(quater == 6){
            var value = "H2";
        }
        return value;
    }
    

   
     
$(document).ready(function(){
    var inimessage = "<?php echo session('inimessage')?session('inimessage'):''; ?>";
    if(inimessage != ""){
        showNotificationApp('top', 'right', 'primary', 'success', '<?php echo session("inimessage"); ?>');
    }
    $("#hideFilter").click(function(){
        $("#filterPop").modal('hide');
    });
    var popup_content_message = "<?php echo session('popup_content_message')?session('popup_content_message'):''; ?>";
    if(popup_content_message != ""){
        view_initiativepop(localStorage.getItem('popup_id'));
    }
  
   $("#add_objectiveBtn").click(function(){
    $(".hideindivi").attr('id','');
    $("#myModalAddInitiative").modal('show');
  });

  $("#myBtn1").click(function(){
    $("#myModal1").modal('show');
  });
   $("#myBtn2").click(function(){
    $("#ini_idformilestone").val($("#viewpageinitiativeid").val());
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
   $("#popup3hideupdate").click(function(){
    $("#updatemilestoneini").modal('hide');
  });

  $("#popupaddhideTask").click(function(){
    $("#myModalAddTask").modal("hide");
  });
  $("#viewinitiativemodalhide").click(function(){
    $("#viewinitiativemodal").modal('hide');
  });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>