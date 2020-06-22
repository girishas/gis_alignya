<?php
	$action 				= (Route::currentRouteAction())?explode('@', Route::currentRouteAction()):'';
	$controllerString		= (isset($action[0]) and $action[0])?$action[0]:'';
	$controllerArr   		= explode("\\", $controllerString);
	$controller  			= array_last($controllerArr);
	$current_action 		= (isset($action[1]) and $action[1])?$action[1]:'';  ?>
	
	<header id="header">
		<div class="mainmenu">
			<div class="container">
				<nav class="navbar navbar-expand-lg">
					<a class="logo" href="<?php echo url('/'); ?>"><?php echo HTML::image("public/images/logo.png", "Logo", array("class"=>"", 'style'=>"width:250px;")); ?></a>
					<?php /* <a  href="{!! url('/') !!}" style="font-size:24px;font-weight:800;color:#fff;">{!! config('constants.SITE_TITLE') !!}</a> */ ?>
					<button class="navbar-toggler ml-1" type="button" data-toggle="collapse" data-target="#NavbarContent">
						<span class="icofont-navigation-menu"></span>
					</button>
					<div class="navbar-collapse collapse" id="NavbarContent">
						<ul class="navbar-nav mx-auto text-center">
							<li class="nav-item">
								<a class="nav-link active" href="#" data-scroll-nav="1">About</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" data-scroll-nav="2">Channels</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" data-scroll-nav="3">Pricing</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" data-scroll-nav="4">Schedule</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" data-scroll-nav="5">FAQ</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#" data-scroll-nav="6">Contact</a>
							</li>
						</ul>
						<ul class="nav navbar-nav login-btn">
							<?php if(Auth::check()): ?>
								<li class="nav-item"><a class="nav-link " href="<?php echo url($route_prefix, 'dashboard'); ?>">DASHBOARD</a></li>
							<?php else: ?>
								<li class="nav-item"><a class="nav-link " href="<?php echo url('login'); ?>">LOG IN</a></li>
							<?php endif; ?>
						</ul>
					</div>
				</nav>
			</div>
		</div>
   </header>