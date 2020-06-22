<?php
	$action 				= (Route::currentRouteAction())?explode('@', Route::currentRouteAction()):'';
	$controllerString		= (isset($action[0]) and $action[0])?$action[0]:'';
	$controllerArr   		= explode("\\", $controllerString);
	$controller  			= array_last($controllerArr);
	$current_action 		= (isset($action[1]) and $action[1])?$action[1]:'';  ?>
	@if(!Request::ajax())
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
@endif
		<title>{!! $page_title !!}</title>
		
		
		@if(!Request::ajax())
			{!! HTML::style('public/font/iconsmind-s/css/iconsminds.css') !!}
			{!! HTML::style('public/font/simple-line-icons/css/simple-line-icons.css') !!}
			{!! HTML::style('public/css/vendor/bootstrap.min.css') !!}
			{!! HTML::style('public/css/vendor/bootstrap.rtl.only.min.css') !!}
			{!! HTML::style('public/css/vendor/bootstrap-float-label.min.css') !!}
			{!! HTML::style('public/css/vendor/fullcalendar.min.css') !!}
			{!! HTML::style('public/css/vendor/dataTables.bootstrap4.min.css') !!}
			{!! HTML::style('public/css/vendor/select2.min.css') !!}
			{!! HTML::style('public/css/vendor/select2-bootstrap.min.css') !!}
			{!! HTML::style('public/css/vendor/perfect-scrollbar.css') !!}
			{!! HTML::style('public/css/vendor/glide.core.min.css') !!}
			{!! HTML::style('public/css/vendor/bootstrap-stars.css') !!}
			{!! HTML::style('public/css/vendor/nouislider.min.css') !!}
			{!! HTML::style('public/css/vendor/bootstrap-datepicker3.min.css') !!}
			{!! HTML::style('public/css/vendor/component-custom-switch.min.css') !!}
			{!! HTML::style('public/css/vendor/baguetteBox.min.css') !!}
			{!! HTML::style('public/css/dore.light.blue.min.css') !!}
			{!! HTML::style('public/css/main.css') !!}
			{!! HTML::style('public/css/style.css') !!}
			
			{!! HTML::style('public/summernote/summernote.css') !!}
			{!! HTML::script('public/js/vendor/jquery-3.3.1.min.js') !!}
			{!! HTML::script('chatting/js/socket.io.js') !!}
			<script type="text/javascript">
				var SITE_URL = "{!! config('constants.SITE_URL').$url_prefix !!}";
				var SITE_URL_BASE = "{!! config('constants.SITE_URL') !!}";
				var server = "https://streamer.studio:4200";
				var io = io(server);
				var updatedgmexist = false;
				var createdgmexist = false;
			</script>
		</head>
		<!-- BEGIN BODY -->
		@if(!in_array($current_action, array('login', 'register', 'forgot_password', 'resetpassword', 'page_not_found')))
			<body id="app-container" class="menu-default show-spinner">
		@else
			<body id="app-container" class="background no-footer ltr flat">
		@endif
	
		
			@endif
			
			@if(!Request::ajax())
				<span id="main-content-navigation">
				@if(!Auth::check() and in_array($current_action, array('profile', 'subscriptions')))
					@include('frontend/layouts/header')
				@else
					@include('frontend/layouts/header')
					@include('frontend/layouts/navigation')
				@endif
				
			</span>
			@endif
			@if(!Request::ajax())
				<span id="main-content">
			@endif
					@yield('content')
					@include('frontend/layouts/footer_modals')
					<script type="text/javascript">
						var myName = "{!! Auth::check()?Auth()->User()->uniq_username:'' !!}";
						var myFullname = "{!! Auth::check()?Auth()->User()->first_name.' '.Auth()->User()->last_name:'' !!}";
						var myImage = "{!! Auth::check()?url('public/upload/users/profile-photo/'.Auth()->User()->photo):'' !!}";
						
					</script>
					@if(!in_array($current_action, array('login', 'register', 'forgot_password', 'resetpassword', 'page_not_found','messages','groups')))
						 <script type="text/javascript">
							jQuery('body').removeClass('background');
							jQuery('body').removeClass('no-footer');
							jQuery('body').addClass('menu-default');
							jQuery('body').addClass('show-spinner');
							jQuery('#main-content-footer').show();
							jQuery('#main-content-navigation').show();
							document.title = "<?php echo $page_title; ?>";
						</script>
					@elseif(in_array($current_action, array('messages', 'groups')))
						<script type="text/javascript">
							jQuery('#main_content_footer').hide();
							$('body').addClass('no-footer');
							document.title = "<?php echo $page_title; ?>";
						</script>
					@else
						 <script type="text/javascript">
							jQuery('#main_content_footer').hide();
							jQuery('#main-content-navigation').hide();
							$('body').addClass('background');
							$('body').addClass('no-footer');
							
							document.title = "<?php echo $page_title; ?>";
						</script>
					@endif
					
					@if(!Auth::check() and in_array($current_action, array('profile', 'subscriptions')))
						<script type="text/javascript">
							//jQuery('#main-content-navigation').hide();
							document.title = "<?php echo $page_title; ?>";
						</script>
					@endif
			@if(!Request::ajax())
				</span>
			@endif
		
		@if(!Request::ajax())
			<span id="main_content_footer">
				@include('frontend/layouts/footer')
			</span>
			
			{!! HTML::script('public/js/vendor/bootstrap.bundle.min.js') !!}
			{!! HTML::script('public/js/vendor/Chart.bundle.min.js') !!}
			{!! HTML::script('public/js/vendor/chartjs-plugin-datalabels.js') !!}
			{!! HTML::script('public/js/vendor/moment.min.js') !!}
			{!! HTML::script('public/js/vendor/fullcalendar.min.js') !!}
			{!! HTML::script('public/js/vendor/datatables.min.js') !!}
			{!! HTML::script('public/js/vendor/perfect-scrollbar.min.js') !!}
			{!! HTML::script('public/js/vendor/progressbar.min.js') !!}
			{!! HTML::script('public/summernote/summernote.js') !!}
			{!! HTML::script('public/js/vendor/jquery.barrating.min.js') !!}
			{!! HTML::script('public/js/vendor/select2.full.js') !!}
			{!! HTML::script('public/js/vendor/nouislider.min.js') !!}
			{!! HTML::script('public/js/vendor/bootstrap-datepicker.js') !!}
			{!! HTML::script('public/js/vendor/bootstrap-notify.min.js') !!}
			{!! HTML::script('public/js/vendor/Sortable.js') !!}
			{!! HTML::script('public/js/vendor/mousetrap.min.js') !!}
			{!! HTML::script('public/js/vendor/baguetteBox.min.js') !!}
			{!! HTML::script('public/js/vendor/glide.min.js') !!}
			{!! HTML::script('public/js/dore.script2.js') !!}
			{!! HTML::script('public/js/scripts.single.theme.js') !!}
			{!! HTML::script('public/js/scripts.js') !!}
			
			{!! HTML::style('public/bootstrap_material/bootstrap-material-datetimepicker.css') !!}
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
	{!! HTML::script('public/bootstrap_material/bootstrap-material-datetimepicker.js') !!}
	{!! HTML::style('public/bootstrap_material/bootstrap-material-datetimepicker.css') !!}
	  {!! HTML::style('public/css/jquery-ui.css') !!}
	 {!! HTML::script('public/js/jquery-ui.js') !!}
	 {!! HTML::script('public/js/jquery.scrollTo.min.js') !!}
	 {!! HTML::style('public/css/index_custom.css') !!}
	 
	{!! HTML::script('public/js/index_functions.js') !!}
	{!! HTML::script('public/js/ch_functions.js') !!}
			
			{!! HTML::script('public/js/app.js') !!}
	
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
								data-dismiss="modal">{!! getLabels('Cancel') !!}</button>
							<a href="javascript:void(0);" class="btn btn-primary steamerst_status" title="Confirm" id="confirmURL">{!! getLabels('Confirm') !!}</a>
						</div>
					</div>
				</div>
			</div>
			@if(!in_array($current_action, array('login', 'register', 'forgot_password', 'resetpassword', 'page_not_found', 'messages', 'groups')))
				 <script type="text/javascript">
					jQuery('#main-content-footer').show();
				</script>
			@else
				 <script type="text/javascript">
					jQuery('#main_content_footer').hide();
				</script>
			@endif
	</body>
	<!-- END BODY -->
</html>
@endif