    
    <?php use App\Traits\SortableTrait;  ?>

    <?php $__env->startSection('content'); ?>
    <?php echo $__env->make('Element/measure/view_measure', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Element/measure/add_measure', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Element/measure/update_measure', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Element/measure/update_milestone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Element/measure/add_milestone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Element/measure/task', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('Element/measure/update_task', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('frontend/measures/filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <main>
    <div class="container-fluid">
    <div class="row">
    <div class="col-12">
    <h1><?php echo getLabels('Measures'); ?></h1>
    <div class="text-zero top-right-button-container">
    <a href="javascript:void(0);" class=" btn btn-primary btn-sm top-right-button mr-1" id="add_objectiveBtn"><?php echo getLabels('add_measure'); ?></a>
    <button type="button" class="btn btn-outline-primary mb-1" id="filterBtn">Filters</button>
    </div>
    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
    <ol class="breadcrumb pt-0">
    <li class="breadcrumb-item">
        <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
    </li>

    <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('Measures'); ?></li>
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
                            $remove_url = url("measure/remove/".$value->id); 
                            $remove_msg = getLabels('are_you_sure'); ?>
                        <tr>
                            <td><a href="javascript:void(0);" onclick="viewMeasure('<?php echo $value->id; ?>')"><i class="<?php echo $value->status_icon; ?> heading-icon" style="color:<?php echo $value->bg_color; ?>"></i><?php echo $value->heading; ?></td>
                            <td> FY<?php echo $value->measure_cycle_year; ?>-<?php echo config('constants.Quarter.'.$value->measure_cycle_quarter); ?></td>
                            <td> <?php echo $value->owner_name; ?></td>
                            <td> <span class="badge badge-pill badge-success" style="background: <?php echo $value->bg_color; ?>"><?php echo $value->status_name; ?></span></td>
                            <td><?php echo $value->parent_objective; ?></td>
                            <td>
                                <a href="javascript:void(0);" onclick="updateMeasure('<?php echo $value->id; ?>')"><i class="simple-icon-pencil heading-icon"></i></a>
                                <a href="javascript:void(0);" onclick="viewMeasure('<?php echo $value->id; ?>')"><i class="iconsminds-information heading-icon"></i>
                                    <a onclick = 'showConfirmationModal("Remove", "<?php echo $remove_msg; ?>", "<?php echo $remove_url; ?>");' href="javascript:void(0);"><i class="heading-icon simple-icon-trash"></i></a>
                                    
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
    
    function areaMeasureGraph(){
        if (document.getElementById("measuregraph")) {
            var areaChartNoShadow = document
              .getElementById("measuregraph")
              .getContext("2d");
            var myChart = new Chart(areaChartNoShadow, {
              type: "line",
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
                        padding: 0
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
                tooltips: chartTooltip
              },
              data: {
                labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                datasets: [
                  {
                    label: "",
                    data: [54, 63, 60, 65, 60, 68, 60],
                    borderColor: themeColor1,
                    pointBackgroundColor: foregroundColor,
                    pointBorderColor: themeColor1,
                    pointHoverBackgroundColor: themeColor1,
                    pointHoverBorderColor: foregroundColor,
                    pointRadius: 4,
                    pointBorderWidth: 2,
                    pointHoverRadius: 5,
                    fill: true,
                    borderWidth: 2,
                    backgroundColor: themeColor1_10
                  }
                ]
              }
            });
          }
    }
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


    $(document).ready(function(){
        
        var adderrormessage = "<?php echo session('adderrormessage')?session('adderrormessage'):''; ?>";
            if(adderrormessage != ''){
                $("#myModalAddMeasure").show();
            }
        var is_popup_content = "<?php echo session('popup_content_message')?session('popup_content_message'):''; ?>";
        if(is_popup_content != ""){
            viewMeasure(localStorage.getItem('popup_id'));
        }
    
    $("#add_objectiveBtn").click(function(){
        $(".removeattr").attr('id','');
    $("#myModalAddMeasure").modal('show');
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
    $("#view_measuremodal_hide").click(function(){
    $("#viewmeasuremodal").modal('hide');
    });
    $("#popup2hide").click(function(){
    $("#myModal1").modal('hide');
    });
    $("#addMilestoneMeasureViewHide").click(function(){
    $("#addMilestoneMeasureView").modal('hide');
    });
    
    
    $("#updateMilestoneMeasureViewHide").click(function(){
        $("#updateMilestoneMeasureView").modal("hide");
    });
    $("#popupaddhideTask").click(function(){
        $("#myModalAddTask").hide();
    });
    
    });
    </script>
<script type="text/javascript">
    
    
    
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
    
    
    
    


    
</script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>