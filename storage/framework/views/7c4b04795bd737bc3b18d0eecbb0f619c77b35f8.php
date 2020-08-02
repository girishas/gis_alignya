<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
<style type="text/css">
   .cssformflex{
        width: 100%;
        display: flex;
   } 
</style>
  <main>
        <div class="container-fluid">
            <div class="row mb-5">
                <div class="col-12">

                    <div class="mb-2">
                        <h1>Subscription</h1>
                        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                            <ol class="breadcrumb pt-0">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                
                                <li class="breadcrumb-item active" aria-current="page">Subscription</li>
                            </ol>
                        </nav>
                        
                          <div class="float-md-right">
                           <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                  <label class="btn btn-secondary active" onclick="PeriodChange(1)" style="cursor: pointer;">
                                    <input type="radio" name="options" id="option1" autocomplete="off" checked > Monthly
                                  </label>
                                   
                                  <label class="btn btn-secondary" onclick="PeriodChange(2)" style="cursor: pointer;">
                                    <input type="radio" name="options" id="option3" autocomplete="off" > Yearly
                                  </label>
                                </div>
                          </div>
                        <div class="separator mb-3"></div>
                    </div> 
                    
                    
                    <div class="row equal-height-container">
                       <?php if(session('message')): ?>
                            <div class="alert alert-success" role="alert" style="z-index: 1">
                                <?php echo session('message'); ?>

                            </div>
                        <?php elseif(session('errormessage')): ?>
                            
                            <div class="alert alert-danger" role="alert" style="z-index: 1">
                                <?php echo session('errormessage'); ?>

                            </div>
                        <?php endif; ?>
                        <div class="col-12 mb-4 ">
                           Please choose subscription for membership plan!!
                        </div>
                        <?php echo Form::open(array('url' => url('upgrade-membership') ,'class'=>'steamerstudio_form cssformflex')); ?>

                            <input type="hidden" name="plan_id" class="plan_id_value">
                        
                        <?php if(!empty($PlansMonthly)): ?>
                        <?php $__currentLoopData = $PlansMonthly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-12 col-lg-4 mb-4 col-item hideshowthismonthly">
                            <div class="card" style="border: <?php echo Auth::User()->current_membership_plan == $value->id?'10px solid green':''; ?>">
                                <div
                                    class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
                                    <div class="price-top-part">
                                        <i class="iconsminds-male large-icon"></i>
                                        <h5 class="mb-0 font-weight-semibold color-theme-1 mb-4"><strong><?php echo $value->heading; ?></strong></h5>
                                        <p class="text-large mb-2 text-default">$<?php echo $value->plan_fee; ?></p>
                                        <p class="text-muted text-small">Upto <?php echo $value->emp_limit; ?> Members</p>
                                    </div>
                                    <div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column flex-grow-1">
                                        <ul class="list-unstyled">
                                            <li>
                                                <p class="mb-0 ">
                                                    30 Days Trial Period
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    24/5 support
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Number of end products 1
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Free updates
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Forum support
                                                </p>
                                            </li>
                                        </ul>
                                        <div class="text-center">
                                            <?php if(Auth::User()->current_membership_plan == $value->id && Auth::User()->enable_subscription == 1): ?>
                                            <button class="btn btn-success">
                                                Current
                                            </button>
                                            <?php else: ?>
                                            <a href="javascript:void(0);" onclick="upgradePlan('<?php echo $value->plan_id; ?>')">
                                                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                data-key="<?php echo config('constants.STRIPE_PK'); ?>"
                                                data-image=""
                                                data-email="<?php echo Auth::User()->email; ?>"
                                                data-name="Membership Upgrade"
                                                data-description="<?php echo $value->heading; ?>"
                                                data-panel-label="Pay $<?php echo $value->plan_fee; ?>"
                                                data-label="Pay $<?php echo $value->plan_fee; ?>"
                                                data-locale="auto">
                                                </script>
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <?php if(!empty($PlansYearly)): ?>
                        <?php $__currentLoopData = $PlansYearly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-12 col-lg-4 mb-4 col-item hideshowthisyearly" style="display: none">
                            <div class="card">
                                <div
                                    class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
                                    <div class="price-top-part">
                                        <i class="iconsminds-male large-icon"></i>
                                        <h5 class="mb-0 font-weight-semibold color-theme-1 mb-4"><strong><?php echo $value->heading; ?></strong></h5>
                                        <p class="text-large mb-2 text-default">$<?php echo $value->plan_fee; ?></p>
                                        <p class="text-muted text-small">Upto <?php echo $value->emp_limit; ?> Members</p>
                                    </div>
                                    <div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column flex-grow-1">
                                        <ul class="list-unstyled">
                                            <li>
                                                <p class="mb-0 ">
                                                    30 Days Trial Period
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    24/5 support
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Number of end products 1
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Free updates
                                                </p>
                                            </li>
                                            <li>
                                                <p class="mb-0 ">
                                                    Forum support
                                                </p>
                                            </li>
                                        </ul>
                                        <div class="text-center">
                                            <a href="javascript:void(0);" onclick="upgradePlan('<?php echo $value->plan_id; ?>')">
                                                <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                                data-key="<?php echo config('constants.STRIPE_PK'); ?>"
                                                data-email="<?php echo Auth::User()->email; ?>"
                                                data-name="Membership Upgrade"
                                                data-description="<?php echo $value->heading; ?>"
                                                data-panel-label="Pay $<?php echo $value->plan_fee; ?>"
                                                data-label="Pay $<?php echo $value->plan_fee; ?>"
                                                data-locale="auto">
                                                </script>
                                            </a>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php echo Form::close(); ?>

                    </div>

                </div>
            </div>

           
        </div>
    </main>
    <script type="text/javascript">
        function PeriodChange(Period){
            if(Period == 1){
                $(".hideshowthisyearly").hide();
                $(".hideshowthismonthly").show();
            }else{
                $(".hideshowthismonthly").hide();
                $(".hideshowthisyearly").show();
            }
        }
        function upgradePlan(plan_id){
            $(".plan_id_value").val(plan_id);
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>