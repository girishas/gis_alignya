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
                    <h1>Time Map</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Analytics</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Time Map</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
             
            <div class="row mb-4">
                <div class="col-lg-12 col-md-12 mb-4">
                <?php echo Form::open(array('url' => array('/timemap'), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Filters</h5>
                        <div class="row">
                        <div class="col-md-2">
                            <label>Goal Cycle</label>
                            <?php echo Form::select('cycle_id', array(0=>'Select Goal Cycle')+$al_goal_cycles, isset($_POST['cycle_id'])?$_POST['cycle_id']:null, array('class' => 'form-control select2-single')); ?>

							<!--<select class="form-control select2-single" data-width="100%">
                                <option >5 Year Strategy</option>
                                <option >3 Year Strategy</option>
                                <option >FY-2020</option>
                            </select>-->
                        </div>
                        <div class="col-md-2">
                            <label>Department</label>
                            <?php echo Form::select('department_id', array(0=>'Select Department')+$all_department, isset($_POST['department_id'])?$_POST['department_id']:null, array('class' => 'form-control select2-single')); ?>

							
                        </div>
                        <div class="col-md-2">
                            <label>Owner</label>
                            <?php echo Form::select('owner_id', array(0=>'Select Owner')+$all_users, isset($_POST['owner_id'])?$_POST['owner_id']:null, array('class' => 'form-control select2-single')); ?>

							
                        </div>
                        <div class="col-md-2">
                            <label>Perspective</label>
                             <?php echo Form::select('perspective_id', array(0=>'Select Perspective')+$all_perspective, isset($_POST['perspective_id'])?$_POST['perspective_id']:null, array('class' => 'form-control select2-single')); ?>

							
                        </div>
						
						<div class="col-md-2">
                            <label>Strategic Theme</label>
                             <?php echo Form::select('theme_id', array(0=>'Select Theme')+$al_themes, isset($_POST['theme_id'])?$_POST['theme_id']:null, array('class' => 'form-control select2-single')); ?>

							
                        </div>
						<div class="col-md-2">
                         
                   <button type="submit" style="width:100%;" class="btn btn-primary">Search</button>
                <a class="btn btn-dark mb-1 steamerst_link" style="width:100%;" href="<?php echo url('timemap'); ?>">Show All</a>

							
                        </div>
                    </div>
                    </div>
                </div>
				 <?php echo Form::close(); ?>

				    <div class="card">
                        <div class="card-body">
                           
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Goal Cycle</th>
                                        <th scope="col">Objective</th>
                                        <th scope="col">Measure</th>
                                        <th scope="col">Initiative</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($timemap_data)): ?>
                                    <?php $__currentLoopData = $timemap_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skey => $svalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php $__currentLoopData = $svalue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<?php if($key == '0'): ?>
												<th scope="row"><?php echo $value->cycle_name; ?></th>
												<?php else: ?>
												<th scope="row"></th>
												<?php endif; ?>
												<td><a href="javascript:void(0);" onclick="viewobjective('<?php echo $value->id; ?>')"><i class="<?php echo $value->icons; ?> heading-icon" style="color:<?php echo $value->bg_color; ?>"></i> <?php echo $value->heading; ?></a></td>
												<td></td>
												<td></td>
											</tr>
											<?php $__currentLoopData = $value->getMeasures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mKey=>$mValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<th scope="row"></th>
												<td><a href="javascript:void(0);" onclick="viewobjective('<?php echo $value->id; ?>')"><i class="<?php echo $value->icons; ?> heading-icon" style="color:<?php echo $value->bg_color; ?>"></i> <?php echo $value->heading; ?></a></td>
												<td><a href="javascript:void(0);" onclick="viewMeasure('<?php echo $mValue->id; ?>')"><i class="<?php echo $mValue->icons; ?> heading-icon" style="color:<?php echo $mValue->bg_color; ?>"></i> <?php echo $mValue->heading; ?></a></td>
												<td></td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php $__currentLoopData = $value->getInitiatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iKey=>$iValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<th scope="row"></th>
												<td><a href="javascript:void(0);" onclick="viewobjective('<?php echo $value->id; ?>')"><i class="<?php echo $value->icons; ?> heading-icon" style="color:<?php echo $value->bg_color; ?>"></i> <?php echo $value->heading; ?></a></td>
												<td></td>
												<td><a href="javascript:void(0);" onclick="view_initiativepop('<?php echo $iValue->id; ?>')"><i class="<?php echo $iValue->icons; ?> heading-icon" style="color:<?php echo $iValue->bg_color; ?>"></i> <?php echo $iValue->heading; ?></a></td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
								</tbody>
                            </table>
                        </div>
                    </div>
                </div>

            
            
            </div>
        </div>

    </main>
    <?php echo $__env->make('Element/js/includejs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>