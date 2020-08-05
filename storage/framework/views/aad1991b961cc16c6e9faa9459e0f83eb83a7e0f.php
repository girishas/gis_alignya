<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
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

<?php echo $__env->make('Element/objective/view_objective', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/objective/add_objective', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/objective/scorecards', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/objective/add_scorecard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/objective/themes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/objective/add_theme', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/objective/add_cycle', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/objective/update_objective', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/measure/view_measure', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/measure/add_measure', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>       
<?php echo $__env->make('frontend/objectives/filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/initiative/add_initiative', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/initiative/view_initiative', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('Element/measure/update_task', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/measure/update_milestone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/measure/update_measure', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/initiative/update_initiative', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/measure/add_milestone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/initiative/add_milestone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/initiative/update_milestone', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('Element/measure/task', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo getLabels('Objective'); ?></h1>
					<div class="text-zero top-right-button-container">
						<a href="javascript:void(0);" class=" btn btn-primary btn-sm top-right-button mr-1" onclick="addObjectivepop()"><?php echo getLabels('add_objective'); ?></a>
                        <button type="button" class="btn btn-outline-primary mb-1" id="filterBtn">Filters</button>
                            
                    </div>                       
  

                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>"><?php echo getLabels('Dashboard'); ?></a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page"><?php echo getLabels('Objective'); ?></li>
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
										   <th> <?php echo getLabels('Name'); ?></th>
										   <th> <?php echo getLabels('Cycle'); ?> </th>
											<th> <?php echo getLabels('Owner'); ?> </th>
                                            <th> <?php echo getLabels('Status'); ?> </th>
                                           <th> <?php echo getLabels('Aligned to'); ?> </th>
                                           <th><?php echo "% ".getLabel('complete'); ?></th>
											<th> <?php echo getLabels('action'); ?> </th>
										</tr>
									</thead>
									<tbody>
                                        <?php if(!$data->isEmpty()): ?>
                                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                         <?php
                                            $remove_url = url("objective/remove/".$value->id); 
                                            $remove_msg = getLabels('are_you_sure'); ?>
												<tr>
													<td>
									                   <a href="javascript:void(0);" onclick="viewobjective('<?php echo $value->id; ?>')"><i class="<?php echo $value->status_icon; ?> heading-icon" style="color:<?php echo $value->bg_color; ?>"></i> <?php echo $value->heading; ?>

														</a></td>
													<td> <?php echo $value->cycle_name; ?></td>
													<td> <p class="text-semi-muted mb-2"><?php echo $value->owner_name; ?></p></td>
                                                    <td> <span class="badge badge-pill badge-success" style="background: <?php echo $value->bg_color; ?>"><?php echo $value->status_name; ?></span></td>
                                                    <td><?php echo $value->parent_objective; ?></td>
                                                    <td> <div class="c100 p<?php echo getPercentComplateObjective($value->id)>100?100:getPercentComplateObjective($value->id); ?> small" style="font-size: 50px;">
                                                        <span><?php echo getPercentComplateObjective($value->id); ?>%</span>
                                                        <div class="slice">
                                                            <div class="bar"></div>
                                                            <div class="fill"></div>
                                                        </div>
                                                    </div></td>
													<td>
														<a  href="javascript:void(0);" onclick="updateObjective('<?php echo $value->id; ?>')" title="Edit"><i class="simple-icon-pencil heading-icon"></i></a>
                             <a href="javascript:void(0);" onclick="viewobjective('<?php echo $value->id; ?>')" title="View"><i class="iconsminds-information heading-icon"></i>
                                                        </a>
                                                                <a  onclick = 'showConfirmationModal("Remove", "<?php echo $remove_msg; ?>", "<?php echo $remove_url; ?>");' href="javascript:void(0);" title="Remove"><i class="simple-icon-trash heading-icon"></i></a>
                                                                
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
    

    function removetask(id){
        var token = "<?php echo csrf_token(); ?>";
        $.ajax({
            type:"POST",
            url: "<?php echo url('removetasks'); ?>"+"/"+id,
            data:'_token='+token,
            dataType:'JSON',
            success: function (response) {

            }
        });
    }
    
    
    
     function onclickownershipadd(id){
        
        $("#ownership").html("");
        var token = "<?php echo csrf_token(); ?>";
        var company_id = "<?php echo Auth::User()->company_id; ?>";
        if(id == 1){
            $("#obj_teamtype").val("department");
            var selectlabel = "Select Department";
            var url = "<?php echo url('/getdepartments'); ?>"; 
        }else if(id == 2){
            $("#obj_teamtype").val("team");
            var selectlabel = "Select Team";
            var url = "<?php echo url('/getteams'); ?>";
        }else{
            $("#obj_teamtype").val("individual");
            var selectlabel = "Select Owners";
            var url = "<?php echo url('/getmembers'); ?>"
        }
        $.ajax({
            type:"POST",
            url: url,
            data:'_token='+token+'&company_id='+company_id,
            dataType:'JSON',
            success: function (response) {
                if(response != ""){
                   $("#ownership").append('<option value = "">'+selectlabel+'</option>')
                for (var key in response) {
                  if (response.hasOwnProperty(key)) {
                    var val = response[key];
                    $("#ownership").append('<option value = "'+key+'">'+val+'</option>');
                  }
                }
                }
               
            }  
        });
    }

$(document).ready(function(){
    var objective_add_error = "<?php echo session('objective_add_error')?session('objective_add_error'):''; ?>";
    if(objective_add_error != ""){
      $("#myModalAddObjective").modal('show');
    }
    var objective_add_success = "<?php echo session('objective_add_success')?session('objective_add_success'):''; ?>";
    if(objective_add_success != ""){
      showNotificationApp('top', 'right', 'primary', 'success', '<?php echo session("objective_add_success"); ?>');
    }
    var is_popup = "<?php echo session('is_popup')?session('is_popup'):''; ?>";
    if(is_popup != ""){
      showNotificationApp('top', 'right', 'primary', 'success', '<?php echo session("is_popup"); ?>');
    }
    var is_popup_content = "<?php echo session('popup_content_message')?session('popup_content_message'):''; ?>";
    if(is_popup_content != ""){
      viewobjective(localStorage.getItem('popup_id'));
    }
    
    var is_popup = "<?php echo session('is_popup')?session('is_popup'):''; ?>";
    if(is_popup != ''){
      viewobjective(localStorage.getItem('popup_id'));
    }
    
  
  $("#filterBtn").click(function(){
    $("#filterPop").modal('show');
  });
  
  
   $("#myBtn2").click(function(){
    $("#myModal2").modal('show');
  });
  
   $("#myBtn4").click(function(){
    $("#myModal4").modal('show');
  });$("#myBtn5").click(function(){
    $("#myModal5").modal('show');
  });
   
  $("#popup1hide").click(function(){
    $("#myModal").modal('hide');
    window.location.reload(true);
  });
  
  $("#popup3hide").click(function(){
    $("#myModal2").modal('hide');
  });
   $("#hideFilter").click(function(){
    $("#filterPop").modal('hide');
  });
  $("#popup4hide").click(function(){
    $("#myModal3").modal('hide');
  });
  $("#popup5hide").click(function(){
    $("#myModal4").modal('hide');
  }); $("#popup8hide").click(function(){
    $("#myModal5").modal('hide');
  });
  

   $("#popupaddhideinitiative").click(function(){
    $("#myModalAddInitiative").modal('hide');
  });
   $("#popupaddhideMeasure").click(function(){
    $("#myModalAddMeasure").modal("hide");
   });
   $("#view_measuremodal_hide").click(function(){
    $("#viewmeasuremodal").modal("hide");
});
   
});

</script>
<script type="text/javascript">

    
   
    
    $("#popupaddhideObjectiveupdate").click(function(){
      $(".updateobjectiveform").attr("name","updateobjectiveform");
        $("#updateobjectivemodal").modal("hide");
    });

    
    
    
    
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>