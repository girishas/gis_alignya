<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Scorecard</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Analytics</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Scorecard</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
             
            <div class="row mb-4">
                <div class="col-lg-12 col-md-12 mb-4">
				<?php echo Form::open(array('url' => array('/scorecard'), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)); ?>

                
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
                <a class="btn btn-dark mb-1 steamerst_link" style="width:100%;" href="<?php echo url('scorecard'); ?>">Show All</a>

							
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
                                        <th scope="col">Categories</th>
                                        <th scope="col">Objective</th>
                                        <th scope="col">Measure</th>
                                        <th scope="col">Initiative</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($scorecard_data)): ?>
                                    <?php $__currentLoopData = $scorecard_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skey => $svalue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php $__currentLoopData = $svalue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<?php if($key == '0'): ?>
												<th scope="row"><?php echo $value->perspective_name; ?></th>
												<?php else: ?>
												<th scope="row"></th>
												<?php endif; ?>
												<td><i class="<?php echo $value->icons; ?> heading-icon" style="color:<?php echo $value->bg_color; ?>"></i> <?php echo $value->heading; ?></td>
												<td></td>
												<td></td>
											</tr>
											<?php $__currentLoopData = $value->getMeasures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mKey=>$mValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<th scope="row"></th>
												<td><i class="<?php echo $value->icons; ?> heading-icon" style="color:<?php echo $value->bg_color; ?>"></i> <?php echo $value->heading; ?></td>
												<td><i class="<?php echo $mValue->icons; ?> heading-icon" style="color:<?php echo $mValue->bg_color; ?>"></i> <?php echo $mValue->heading; ?></td>
												<td></td>
											</tr>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php $__currentLoopData = $value->getInitiatives; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iKey=>$iValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<tr>
												<th scope="row"></th>
												<td><i class="<?php echo $value->icons; ?> heading-icon" style="color:<?php echo $value->bg_color; ?>"></i> <?php echo $value->heading; ?></td>
												<td></td>
												<td><i class="<?php echo $iValue->icons; ?> heading-icon" style="color:<?php echo $iValue->bg_color; ?>"></i> <?php echo $iValue->heading; ?></td>
												
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>