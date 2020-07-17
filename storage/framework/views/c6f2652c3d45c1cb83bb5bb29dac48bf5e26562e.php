<?php $__env->startSection('title'); ?>
	<?php echo $page_title; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="<?php echo url('public/css/font-awesome/css/font-awesome.min.css'); ?>">

<style>
* {
    margin: 0;
    padding: 0
}

html {
    height: 100%
}

#grad1 {
    background-color: : #9C27B0;
    background-image: linear-gradient(120deg, #FF4081, #81D4FA)
}

#msform {
    text-align: center;
    position: relative;
    margin-top: 20px
}

#msform fieldset .form-card {
    background: white;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 20px 3%;
    position: relative
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}

#msform fieldset:not(:first-of-type) {
    display: none
}

#msform fieldset .form-card {
    text-align: left;
    color: #9E9E9E
}

#msform input,
#msform textarea {
    padding: 0px 8px 4px 8px;
    border: none;
    border-bottom: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    /* font-family: montserrat; */
    color: #2C3E50;
    font-size: 16px;
    letter-spacing: 1px
}

#msform input:focus,
#msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: none;
    font-weight: bold;
    border-bottom: 2px solid skyblue;
    outline-width: 0
}

#msform .action-button {
    width: 100px;
    background: skyblue;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
}

#msform .action-button:hover,
#msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
}

#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px
}

#msform .action-button-previous:hover,
#msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
}

select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px
}

select.list-dt:focus {
    border-bottom: 2px solid skyblue
}

.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative
}

.fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}

#progressbar .active {
    color: #000000
}

#progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 25%;
    float: left;
    position: relative
}

#progressbar #account:before {
    font-family: FontAwesome;
    content: "\f023"
}

#progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f007"
}

#progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f09d"
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c"
}

#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: skyblue
}

.radio-group {
    position: relative;
    margin-bottom: 25px
}

.radio {
    display: inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor: pointer;
    margin: 8px 2px
}

.radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
}

.radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
}

.fit-image {
    width: 100%;
    object-fit: cover
}
</style>
 <div class="fixed-background" style="opacity:1;"></div>
    <main style="opacity:1;">
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <!-- <div class="card auth-card">-->
                        <!-- <div class="position-relative image-side ">

                            <p class=" text-white h2"><?php echo getLabels('magic_is_in_the_details'); ?></p>

                            <p class="white mb-0">
                                <?php echo getLabels('form_to_register'); ?>

                                <br><?php echo getLabels('you_are_a_member'); ?> 
                                 <a href="<?php echo url('login'); ?>" class="steamerst_link white"><?php echo getLabels('login'); ?></a>.
                            </p>
                        </div> -->
						<!-- MultiStep Form -->
<div class="container-fluid" >
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Welcome Aboard </strong></h2>
                <p>Please enter few details to onboard Alignya!</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                       
                            <?php echo Form::open(array('url' => url('/register'), 'class'=>' needs-validation tooltip-label-right', 'id'=>'msform', 'files' => true)); ?>

                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="personal"><strong>Personal</strong></li>
                                <li id="account"><strong>Company</strong></li>
                                <li id="confirm"><strong>Others</strong></li>
                                <li id="payment"><strong>Choose Plan</strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Personal Information</h2>
                                    <div class="row" >
                                        <div class="col-md-5">

                                        <div class="first_name_error" style="color: red"></div>
                                        <input type="text" name="first_name" placeholder="First Name" id = "first_name"  />
                                        
                                        </div>

                                        <div class="col-md-1"></div>
                                        <input type="text" name="last_name" placeholder="Last Name" class="col-md-5" />
                                        <input type="hidden" name="plan_id" id="hiddenFields">
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-md-5">

                                        <div class="email_error" style="color: red"></div>

                                        <input type="text" name="email" placeholder="Email" id="email"  />
                                    </div>
                                        <div class="col-md-1"></div>
                                        <input type="text" name="mobile" placeholder="Phone" class="col-md-5" />
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">

                                        <div class="password_error" style="color: red"></div>
                                        <input type="password" name="password" id = "password" placeholder="Password"  />
                                    </div>
                                        <div class="col-md-1"></div>
                                        

                                        <input type="password" name="confirm_password" id = "confirm_password" placeholder="Confirm Password" class="col-md-5" />
                                 
                                    </div>
                                </div> 
                                
                                <input type="button" name="next" class="next action-button" id = "step1" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Company Information</h2>
                                    <div class="col-md-12">
                                        <div class="company_name_error" style="color: red"></div>
                                        <input type="text" name="company_name" id="company_name" placeholder="Company Name" />
                                    </div>
                                    <div class="col-md-12">
                                    <input type="text" name="slogan" placeholder="Description" />
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                 <input type="button" name="next" class="next action-button" id = "step2" value="Next Step" />
                            </fieldset>
                            
							<fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Others</h2>
                                     <input type="text" name="com_vision" placeholder="Company Vision" />
                                    <input type="text" name="com_values" placeholder="Company Values" />
                                    <input type="text" name="com_mission" placeholder="Company Mission" />
                                </div> 
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="make_payment" class="next action-button" id = "step3" value="Next" />
                            </fieldset>
                            <fieldset>
                                 <div class="row equal-height-container" style="padding: 10px;">

                        <div class="col-12 mb-4 ">
                           Please choose subscription for membership plan!!
                        </div>

                        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-12 col-lg-4 mb-4 col-item">
                            <div class="card">
                                <div
                                    class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
                                    <div class="price-top-part">
                                        <h5 class="mb-0 font-weight-semibold color-theme-1 mb-4"><?php echo $values->heading; ?></h5>
                                        <p class="text-large mb-2 text-default">$<?php echo $values->plan_fee; ?></p>
                                        <p class="text-muted text-small">Upto <?php echo $values->emp_limit; ?> Members</p>
                                    </div>
                                    <div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column flex-grow-1">
                                        <ul class="list-unstyled">
                                            <?php echo $values->summary; ?>

                                            <input type="hidden" name="price_id" value="<?php echo $values->plan_id; ?>">
                                            <input type="hidden" name="plan_amount" value="<?php echo $values->plan_fee; ?>">
                                        </ul>
                                        <div class="text-center">
                                            <a href="javascript:void(0);" rel="1" class="btn btn-primary btn-sm" onclick="submitForm(1)">Pay $<?php echo $values->plan_fee; ?>

                                           <!-- <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="pk_test_XBiHnVt8ZN2PFMvDa0wG6sUP"
                                            data-image=""
                                            data-email="gaurav.sadda@outlook.com"
                                            data-name="Company Registration"
                                            data-description="<?php echo $values->heading; ?>"
                                            data-panel-label="Pay $<?php echo $values->plan_fee; ?>"
                                            data-label="Pay $<?php echo $values->plan_fee; ?>"
                                            data-locale="auto">
                                            </script> -->
            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>  
                            
                            </fieldset>
                        <?php echo Form::Close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                </div>
            </div>
        </div>
    </main>
	<script type="text/javascript">
		$("body").on('submit', ".steamerstudio_formlogin", function(e) {
			pageUrl = "<?php echo url($route_prefix, 'login'); ?>";
			e.preventDefault();
			$.cergis.loadContent();
			e.preventDefault();
		});
		$(document).ready(function(){

		var current_fs, next_fs, previous_fs; //fieldsets
		var opacity;

		$(".next").click(function(){
        $(".first_name_error").html('');
        $(".email_error").html('');
        $(".password_error").html('');
        var first_name = $("#first_name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var confirm_password = $("#confirm_password").val();
        var company_name = $("#company_name").val();
        var step = $(this).attr('id');
        var ret = true;
        if(first_name == "" && step == "step1"){
            $(".first_name_error").html('First name required');
            return false;
        }
        if(email == "" && step == "step1"){
            $(".email_error").html('Email required');
            return false;
        }
        var token = "<?php echo csrf_token(); ?>";
        $.ajax({
            type:"POST",
            url: "<?php echo url('/checkemailexist'); ?>",
            data:'_token='+token+'&email='+email,
            success: function (response) {

               if(JSON.parse(response).success == "true"){
                $(".email_error").html('Email already exist');
                return false;
               }
            }  
        });
        if(password == "" && step == "step1"){
            $(".password_error").html('Password required');
            return false;
        }
        if((confirm_password != password) && step == "step1"){
            $(".password_error").html('Password & Confirm Password are different');
            return false;
        }
        if(company_name == "" && step == "step2"){
            $(".company_name_error").html('Company name required.');
            return false;
        }
		current_fs = $(this).parent();
		next_fs = $(this).parent().next();

		//Add Class Active
		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

		//show the next fieldset
		next_fs.show();
		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
		step: function(now) {
		// for making fielset appear animation
		opacity = 1 - now;

		current_fs.css({
		'display': 'none',
		'position': 'relative'
		});
		next_fs.css({'opacity': opacity});
		},
		duration: 600
		});
		});

		$(".previous").click(function(){

		current_fs = $(this).parent();
		previous_fs = $(this).parent().prev();

		//Remove class active
		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

		//show the previous fieldset
		previous_fs.show();

		//hide the current fieldset with style
		current_fs.animate({opacity: 0}, {
		step: function(now) {
		// for making fielset appear animation
		opacity = 1 - now;

		current_fs.css({
		'display': 'none',
		'position': 'relative'
		});
		previous_fs.css({'opacity': opacity});
		},
		duration: 600
		});
		});

		$('.radio-group .radio').click(function(){
		$(this).parent().find('.radio').removeClass('selected');
		$(this).addClass('selected');
		});

		

		});
		function submitForm(id){

            $("#hiddenFields").val(id);
            $("form").submit();

        }
	</script>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>