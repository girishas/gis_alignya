<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Strategic Map</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Analytics</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Strategic Map</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
             
            <div class="row mb-4">
                <div class="col-lg-12 col-md-12 mb-4">
                <div class="card mb-4">
                </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12" style="height: 200px;" >
                                <h6><b>Financial</b></h6>
                                <br>
                                <div class="row" style="justify-content: center;">
                                <?php if(!empty($financial)): ?>
                                <?php $__currentLoopData = $financial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-2"><div style="border-radius: 50%;background: <?php echo $value->bg_color; ?>;height: 100px;text-align: center;padding-top: 35px;"><b><?php echo $value->heading; ?></b></div></div> 
                                     

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-12" style="height: 200px;">
                                <h6><b>Customer</b></h6>
                                 <br>
                                <div class="row" style="justify-content: center;">
                                    <?php if(!empty($customer)): ?>
                                <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-2"><div style="border-radius: 50%;background: <?php echo $value->bg_color; ?>;height: 100px;text-align: center;padding-top: 35px;"><b><?php echo $value->heading; ?></b></div></div> 
                                     

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                            
                                </div>
                            </div>
                            <div class="col-lg-12" style="height: 200px;">
                                <h6><b>Internal Process</b></h6>
                                 <br>
                                <div class="row" style="justify-content: center;">
                                    <?php if(!empty($process)): ?>
                                <?php $__currentLoopData = $process; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-2"><div style="border-radius: 50%;background: <?php echo $value->bg_color; ?>;height: 100px;text-align: center;padding-top: 35px;"><b><?php echo $value->heading; ?></b></div></div> 
                                     

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                    
                                </div>
                            </div>
                            <div class="col-lg-12" style="height: 200px;">
                                <h6><b>L&G</b></h6>
                                 <br>
                                <div class="row" style="justify-content: center;">
                                    <?php if(!$people->isEmpty()): ?>
                                <?php $__currentLoopData = $people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-2"><div style="border-radius: 50%;background: <?php echo $value->bg_color; ?>;height: 100px;text-align: center;padding-top: 35px;"><b><?php echo $value->heading; ?></b></div></div> 
                                     

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                No Data Available
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            
            
            </div>
        </div>

    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>