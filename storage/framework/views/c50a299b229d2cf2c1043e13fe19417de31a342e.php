<?php
	$action 				= (Route::currentRouteAction())?explode('@', Route::currentRouteAction()):'';
	$controllerString		= (isset($action[0]) and $action[0])?$action[0]:'';
	$controllerArr   		= explode("\\", $controllerString);
	$controller  			= array_last($controllerArr);
	$current_action 		= (isset($action[1]) and $action[1])?$action[1]:'';  ?>
	<?php if(!Request::ajax()): ?>
<!DOCTYPE html>
<!--
Template Name: Admin Lab Dashboard build with Bootstrap v2.3.1
Template Version: 1.0
Author: Mosaddek Hossain
Website: http://www.mosaddek.com
-->

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!-- BEGIN HEAD -->
	<html lang="en">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php endif; ?>
		<title><?php echo $page_title; ?></title>
		
		
		<?php if(!Request::ajax()): ?>
			<?php echo HTML::style('public/font/iconsmind-s/css/iconsminds.css'); ?>

			<?php echo HTML::style('public/font/simple-line-icons/css/simple-line-icons.css'); ?>

			<?php echo HTML::style('public/css/vendor/bootstrap.min.css'); ?>

			<?php echo HTML::style('public/css/vendor/bootstrap.rtl.only.min.css'); ?>

			<?php echo HTML::style('public/css/vendor/bootstrap-float-label.min.css'); ?>

			<?php echo HTML::style('public/css/vendor/fullcalendar.min.css'); ?>

			<?php echo HTML::style('public/css/vendor/dataTables.bootstrap4.min.css'); ?>

			<?php echo HTML::style('public/css/vendor/select2.min.css'); ?>

			<?php echo HTML::style('public/css/vendor/select2-bootstrap.min.css'); ?>

			<?php echo HTML::style('public/css/vendor/perfect-scrollbar.css'); ?>

			<?php echo HTML::style('public/css/vendor/glide.core.min.css'); ?>

			<?php echo HTML::style('public/css/vendor/bootstrap-stars.css'); ?>

			<?php echo HTML::style('public/css/vendor/nouislider.min.css'); ?>

			<?php echo HTML::style('public/css/vendor/bootstrap-datepicker3.min.css'); ?>

			<?php echo HTML::style('public/css/vendor/component-custom-switch.min.css'); ?>

			<?php echo HTML::style('public/css/vendor/baguetteBox.min.css'); ?>

			<?php echo HTML::style('public/css/dore.light.blue.min.css'); ?>

			<?php echo HTML::style('public/css/main.css'); ?>

			<?php echo HTML::style('public/css/style.css'); ?>

			
			<?php echo HTML::style('public/summernote/summernote.css'); ?>

			<?php echo HTML::script('public/js/vendor/jquery-3.3.1.min.js'); ?>

			<?php echo HTML::script('chatting/js/socket.io.js'); ?>

			<script type="text/javascript">
				var SITE_URL = "<?php echo config('constants.SITE_URL').$url_prefix; ?>";
				var SITE_URL_BASE = "<?php echo config('constants.SITE_URL'); ?>";
				var server = "https://streamer.studio:4200";
				var io = io(server);
				var updatedgmexist = false;
				var createdgmexist = false;
			</script>
		</head>
		<!-- BEGIN BODY -->
		<?php if(!in_array($current_action, array('login', 'register', 'forgot_password', 'resetpassword', 'page_not_found'))): ?>
			<body id="app-container" class="menu-default show-spinner">
		<?php else: ?>
			<body id="app-container" class="background no-footer ltr flat">
		<?php endif; ?>
	
		
			<?php endif; ?>
			
			<?php if(!Request::ajax()): ?>
				<span id="main-content-navigation">
				<?php if(!Auth::check() and in_array($current_action, array('profile', 'subscriptions'))): ?>
					<?php echo $__env->make('frontend/layouts/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php else: ?>
					<?php echo $__env->make('frontend/layouts/header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->make('frontend/layouts/navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php endif; ?>
				
			</span>
			<?php endif; ?>
			<?php if(!Request::ajax()): ?>
				<span id="main-content">
			<?php endif; ?>
					<?php echo $__env->yieldContent('content'); ?>
					<?php echo $__env->make('frontend/layouts/footer_modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<script type="text/javascript">
						var myName = "<?php echo Auth::check()?Auth()->User()->uniq_username:''; ?>";
						var myFullname = "<?php echo Auth::check()?Auth()->User()->first_name.' '.Auth()->User()->last_name:''; ?>";
						var myImage = "<?php echo Auth::check()?url('public/upload/users/profile-photo/'.Auth()->User()->photo):''; ?>";
						
					</script>
					<?php if(!in_array($current_action, array('login', 'register', 'forgot_password', 'resetpassword', 'page_not_found','messages','groups'))): ?>
						 <script type="text/javascript">
							jQuery('body').removeClass('background');
							jQuery('body').removeClass('no-footer');
							jQuery('body').addClass('menu-default');
							jQuery('body').addClass('show-spinner');
							jQuery('#main-content-footer').show();
							jQuery('#main-content-navigation').show();
							document.title = "<?php echo $page_title; ?>";
						</script>
					<?php elseif(in_array($current_action, array('messages', 'groups'))): ?>
						<script type="text/javascript">
							jQuery('#main_content_footer').hide();
							$('body').addClass('no-footer');
							document.title = "<?php echo $page_title; ?>";
						</script>
					<?php else: ?>
						 <script type="text/javascript">
							jQuery('#main_content_footer').hide();
							jQuery('#main-content-navigation').hide();
							$('body').addClass('background');
							$('body').addClass('no-footer');
							
							document.title = "<?php echo $page_title; ?>";
						</script>
					<?php endif; ?>
					
					<?php if(!Auth::check() and in_array($current_action, array('profile', 'subscriptions'))): ?>
						<script type="text/javascript">
							//jQuery('#main-content-navigation').hide();
							document.title = "<?php echo $page_title; ?>";
						</script>
					<?php endif; ?>
			<?php if(!Request::ajax()): ?>
				</span>
			<?php endif; ?>
		
		<?php if(!Request::ajax()): ?>
			<span id="main_content_footer">
				<?php echo $__env->make('frontend/layouts/footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</span>
			
			<?php echo HTML::script('public/js/vendor/bootstrap.bundle.min.js'); ?>

			<?php echo HTML::script('public/js/vendor/Chart.bundle.min.js'); ?>

			<?php echo HTML::script('public/js/vendor/chartjs-plugin-datalabels.js'); ?>

			<?php echo HTML::script('public/js/vendor/moment.min.js'); ?>

			<?php echo HTML::script('public/js/vendor/fullcalendar.min.js'); ?>

			<?php echo HTML::script('public/js/vendor/datatables.min.js'); ?>

			<?php echo HTML::script('public/js/vendor/perfect-scrollbar.min.js'); ?>

			<?php echo HTML::script('public/js/vendor/progressbar.min.js'); ?>

			<?php echo HTML::script('public/summernote/summernote.js'); ?>

			<?php echo HTML::script('public/js/vendor/jquery.barrating.min.js'); ?>

			<?php echo HTML::script('public/js/vendor/select2.full.js'); ?>

			<?php echo HTML::script('public/js/vendor/nouislider.min.js'); ?>

			<?php echo HTML::script('public/js/vendor/bootstrap-datepicker.js'); ?>

			<?php echo HTML::script('public/js/vendor/bootstrap-notify.min.js'); ?>

			<?php echo HTML::script('public/js/vendor/Sortable.js'); ?>

			<?php echo HTML::script('public/js/vendor/mousetrap.min.js'); ?>

			<?php echo HTML::script('public/js/vendor/baguetteBox.min.js'); ?>

			<?php echo HTML::script('public/js/vendor/glide.min.js'); ?>

			<?php echo HTML::script('public/js/dore.script2.js'); ?>

			<?php echo HTML::script('public/js/scripts.single.theme.js'); ?>

			<?php echo HTML::script('public/js/scripts.js'); ?>

			
			<?php echo HTML::style('public/bootstrap_material/bootstrap-material-datetimepicker.css'); ?>

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
	<?php echo HTML::script('public/bootstrap_material/bootstrap-material-datetimepicker.js'); ?>

	<?php echo HTML::style('public/bootstrap_material/bootstrap-material-datetimepicker.css'); ?>

	  <?php echo HTML::style('public/css/jquery-ui.css'); ?>

	 <?php echo HTML::script('public/js/jquery-ui.js'); ?>

	 <?php echo HTML::script('public/js/jquery.scrollTo.min.js'); ?>

	 <?php echo HTML::style('public/css/index_custom.css'); ?>

	 
	<?php echo HTML::script('public/js/index_functions.js'); ?>

	<?php echo HTML::script('public/js/ch_functions.js'); ?>

			
			<?php echo HTML::script('public/js/app.js'); ?>

	
			<div class="modal fade" id="showConfirmationModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalTitle"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body" id="modalBody">
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary"
								data-dismiss="modal"><?php echo getLabels('Cancel'); ?></button>
							<a href="javascript:void(0);" class="btn btn-primary steamerst_status" title="Confirm" id="confirmURL"><?php echo getLabels('Confirm'); ?></a>
						</div>
					</div>
				</div>
			</div>
			<?php if(!in_array($current_action, array('login', 'register', 'forgot_password', 'resetpassword', 'page_not_found', 'messages', 'groups'))): ?>
				 <script type="text/javascript">
					jQuery('#main-content-footer').show();
				</script>
			<?php else: ?>
				 <script type="text/javascript">
					jQuery('#main_content_footer').hide();
				</script>
			<?php endif; ?>
	</body>
	<!-- END BODY -->
</html>
<?php endif; ?>