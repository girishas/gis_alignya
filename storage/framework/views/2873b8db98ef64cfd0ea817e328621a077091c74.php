<?php
	$action 				= (Route::currentRouteAction())?explode('@', Route::currentRouteAction()):'';
	$controllerString		= (isset($action[0]) and $action[0])?$action[0]:'';
	$controllerArr   		= explode("\\", $controllerString);
	$controller  			= array_last($controllerArr);
	$current_action 		= (isset($action[1]) and $action[1])?$action[1]:'';  ?>
	<footer id="footer" data-scroll-index="6">
		<div class="footer-area">
			<div class="contact-element">
				<?php echo HTML::image("public/upload/page_images/".pageImage('sms'), "", array("class"=>"img-fluid")); ?>

			</div>
			<div class="contact-element-two">
				<?php echo HTML::image("public/upload/page_images/".pageImage('map'), "", array("class"=>"img-fluid")); ?>

			</div>
			<div class="container">
				<div class="row">
					<!--start contact form-->
					<div class="col-lg-6 col-md-7">
						<div class="contact-form">
							<div class="contact-title">
								<h4>Don't Hesitate to Contact us</h4>
								<h5>We will respond within 24 hours</h5>
							</div>
							<form id="ajax-contact" action="<?php echo url('contactus'); ?>" method="post">
								<div class="form-group">
									<input type="text" class="form-control" id="name" name="name" placeholder="Name*" required="required" data-error="<?php echo getLabels('name_is_required'); ?>">
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<input type="email" class="form-control" id="email" name="email" placeholder="Email Address*" required="required" data-error="<?php echo getLabels('email_is_required'); ?>">
									<div class="help-block with-errors"></div>
								</div>
								<?php /* <div class="form-group">
									<input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
								</div> */ ?>
								<div class="form-group">
									<textarea class="form-control" id="message" name="message" rows="10" placeholder="Your Message*" required="required" data-error="<?php echo getLabels('message_is_required'); ?>"></textarea>
									<div class="help-block with-errors"></div>
								</div>
								<button type="submit"><?php echo getLabels('Submit'); ?></button>
								<div class="messages"></div>
							</form>
						</div>
					</div>
					<!--end contact form-->
					<div class="col-md-5 offset-lg-1">
						<div class="contact-cont">
							<h4>Contact Us</h4>
							<h2>Get in touch</h2>
							<p>You are important to us and we are continuously improving our services to serve you better.</p>
							<div class="contact-thumb">
								<?php echo HTML::image("public/upload/page_images/".pageImage('contact'), "", array("class"=>"img-fluid")); ?>

							</div>
						</div>
					</div>
				</div>
				<!--start footer bottom-->
				<div class="footer-btm row">
					<div class="col-lg-6">
						<div class="copyright-text">
							<p class="m-0">© <?php echo config('constants.COPYRIGHT_MESSAGE'); ?></p>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="footer-social text-right">
							<ul>
								<li><a href=""><i class="icofont-facebook"></i></a></li>
								<li><a href=""><i class="icofont-linkedin"></i></a></li>
								<li><a href=""><i class="icofont-twitter"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<!--end footer bottom-->
			</div>
		</div>
	</footer>