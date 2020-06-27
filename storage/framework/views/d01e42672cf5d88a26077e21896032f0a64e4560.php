<?php
	$action 				= (Route::currentRouteAction())?explode('@', Route::currentRouteAction()):'';
	$controllerString		= (isset($action[0]) and $action[0])?$action[0]:'';
	$controllerArr   		= explode("\\", $controllerString);
	$controller  			= array_last($controllerArr);
	$current_action 		= (isset($action[1]) and $action[1])?$action[1]:''; 
	$slug_get 				= Route::input('slug'); ?>
	<script>
		function onFunc(url) {
			window.location.href = SITE_URL+url;
		}
	</script>
<div class="menu">
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled"><?php
					
					$class_nav  = ($controller == "UserController" && in_array($current_action, ['dashboard']))?"active":""; ?>
                    <li class="<?php echo $class_nav; ?>" id="">
                      <a class="" href="javascript:void(0);" onclick="onFunc('dashboard')">
                            <i class="iconsminds-shop-4"></i>
                            <?php echo getLabels('Dashboard'); ?>

                        </a>
                    </li>
                    <?php
                    $class_nav  = ($controller == "UserController" && in_array($current_action, ['analytics']))?"active":""; ?>
                    <li class="<?php echo $class_nav; ?>" id="st_analytics">
                      <a class="" href="#analytic_manager" >
                            <i class="simple-icon-pie-chart"></i>
                            <?php echo getLabels('Analytics'); ?>

                        </a>
                    </li>
                    <?php
                    $class_nav  = ($controller == "ObjectiveController" && in_array($current_action, ['objectives']))?"active":""; ?>
                    <li class="<?php echo $class_nav; ?>" id="st_explore">
                      <a class="" href="#explore_manager" >
                            <i class="simple-icon-organization"></i>
                            <?php echo getLabels('Explore'); ?>

                        </a>
                    </li>
                    <?php
                    $class_nav  = ($controller == "ObjectiveController" && in_array($current_action, ['objectives']))?"active":""; ?>
                    <li class="<?php echo $class_nav; ?>" >
                      <a class="" href="javascript:void(0);" onclick="onFunc('ideas')"  >
                            <i class="iconsminds-air-balloon-1"></i>
                            <?php echo getLabels('Ideas'); ?>

                        </a>
                    </li>
                    <?php /*
                    //echo $current_action;die;
						$class_nav  = ($controller == "ObjectiveController" && in_array($current_action, ['objectives']))?"active":""; ?>
						
						<li class="{!! $class_nav !!}" id="">
							<a class="" href="javascript:void(0);" onclick="onFunc('objectives')" >
	                            <i class="iconsminds-statistic"></i>
	                            {!! getLabels('Objectives') !!}
	                        </a>
						</li>
                    <?php 
						$class_nav  = ($controller == "ObjectiveController" && in_array($current_action, ['admin_index']))?"active":""; ?>
						
						<li class="{!! $class_nav !!}" id="st_objective">
							<a class="steamerst_link" href="{!! url($route_prefix, 'measures') !!}" >
	                            <i class="simple-icon-hourglass"></i>
	                            {!! getLabels('Measures') !!}
	                        </a>
						</li><?php 
						$class_nav  = ($controller == "ObjectiveController" && in_array($current_action, ['admin_index']))?"active":""; ?>
						
						<li class="{!! $class_nav !!}" id="st_objective">
							<a class="steamerst_link" href="{!! url($route_prefix, 'initiatives') !!}" >
	                            <i class="simple-icon-book-open"></i>
	                            {!! getLabels('Initiatives') !!}
	                        </a>
						</li>
						
					<?php 
                    $class_nav  = ($controller == "ObjectiveController" && in_array($current_action, ['measures']))?"active":""; ?>
                    <li class="{!! $class_nav !!}" id="">
                      <a class="" href="javascript:void(0);" onclick="onFunc('kpis')">
                            <i class="simple-icon-layers"></i>
                            {!! getLabels('KPIs') !!}
                        </a>
                    </li> */ ?>
                   
					<?php if(Auth::check() and Auth::User()->role_id == 1): ?><?php
						$class_nav  = (($controller == "UserController" && in_array($current_action, ['admin_index'])) OR (strpos(URL::current(),'users') !== false))?"active":""; ?>
						
						<li class="<?php echo $class_nav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'users'); ?>">
								<i class="iconsminds-male-female"></i>
								<?php echo getLabels('Users'); ?>

							</a>
						</li><?php
						$class_nav  = (($controller == "PageController" OR  $controller == "TemplateController" ) && in_array($current_action, ['admin_view', 'admin_index', 'admin_add', 'admin_edit']))?"active":""; ?>
						
						<li class="<?php echo $class_nav; ?>" id="st_content">
							<a href="#content_manager">
								<i class="iconsminds-library"></i>
								<span><?php echo getLabels('Content'); ?></span>
							</a>
						</li><?php
						
						$class_nav  = ($controller == "SettingController" && in_array($current_action, ['admin_languages', 'admin_edit_language', 'admin_add_language']))?"active":""; ?>
						
						<li class="<?php echo $class_nav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'languages'); ?>">
								<i class="iconsminds-sound"></i>
								<?php echo getLabels('Languages'); ?>

							</a>
						</li><?php
						/* $class_nav  = ($controller == "SettingController" && in_array($current_action, ['admin_badges', 'admin_edit_badges', 'admin_add_badges']))?"active":""; ?>

						<li class="{!! $class_nav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'badges') !!}">
								<i class="simple-icon-badge"></i>
								{!! getLabels('Badges') !!}
							</a>
						</li><?php */
						$class_nav  = ($controller == "SettingController" && in_array($current_action, ['admin_labels', 'admin_edit_labels', 'admin_add_labels']))?"active":""; ?>

						<li class="<?php echo $class_nav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'labels'); ?>">
								<i class="simple-icon-docs"></i>
								<?php echo getLabels('Labels'); ?>

							</a>
						</li><?php
						$class_nav  = ($controller == "SettingController" && in_array($current_action, ['admin_add_page_images', 'admin_edit_page_images', 'admin_page_images']))?"active":""; ?>	

						<li class="<?php echo $class_nav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'page_images'); ?>">
								<i class="simple-icon-picture"></i>
								<?php echo getLabels('Page_Images'); ?>

							</a>
						</li><?php
						$class_nav  = ($controller == "SettingController" && in_array($current_action, ['admin_add_testimonials', 'admin_testimonials', 'admin_edit_testimonials']))?"active":""; ?>	

						<li class="<?php echo $class_nav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'testimonials'); ?>">
								<i class="simple-icon-list"></i>
								<?php echo getLabels('Testimonials'); ?>

							</a>
						</li><?php
						$class_nav  = ($controller == "SettingController" && in_array($current_action, ['admin_add_faqs', 'admin_faqs', 'admin_edit_faqs']))?"active":""; ?>
						<li class="<?php echo $class_nav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'faqs'); ?>">
								<i class="simple-icon-question"></i>
								<?php echo getLabels('Faqs'); ?>

							</a>
						</li><?php
						$class_nav  = ($controller == "SubscriptionController" && in_array($current_action, ['payouts_amount_details', 'payout_history_detail', 'transaction_manager', 'admin_payouts', 'payout_history', 'admin_add_subscriptions', 'admin_subscriptions', 'admin_edit_subscriptions', 'admin_add_subscriptionlevel', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
						
						<?php
						$class_nav  = ($controller == "SettingController" && in_array($current_action, ['admin_update']))?"active":""; ?>
						
						<li class="<?php echo $class_nav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'settings'); ?>">
								<i class="simple-icon-settings"></i>
								<?php echo getLabels('Settings'); ?>

							</a>
						</li><?php
						$class_nav  = ($controller == "BadgeController" && in_array($current_action, ['admin_index', 'admin_add', 'admin_edit']))?"active":""; ?>
						
						<?php /* <li class="{!! $class_nav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'badges') !!}">
								<i class="simple-icon-badge"></i>
								Badges
							</a>
						</li> */ ?>
					<?php elseif(Auth::check() and Auth::User()->role_id == 2): ?>
						<?php $class_nav  = ($controller == "UserController" && in_array($current_action, ['members']))?"active":""; ?>
						
						<li class="<?php echo $class_nav; ?>" id="st_members">
							<a class="" href="#subscription_manager" >
	                            <i class="simple-icon-people"></i>
	                            <?php echo getLabels('members'); ?>

	                        </a>
						</li>
						<?php $class_nav  = ($controller == "UserController" && in_array($current_action, ['members']))?"active":""; ?>
						
						<li class="<?php echo $class_nav; ?>" id="st_members">
							<a class="" href="#" onclick="logout()">
	                            <i class="iconsminds-gear"></i>
	                            <?php echo getLabels('logout'); ?>

	                        </a>
						</li>
						
					<?php endif; ?>
					
                </ul>
            </div>
        </div>

        <div class="sub-menu">
            <div class="scroll">
				<ul class="list-unstyled" data-link="roadmap_manager"><?php
					$class_subnav  = ($controller == "DepartmentController
					" && in_array($current_action, ['tree']))?"active":""; ?>
						
                    <li class="<?php echo $class_subnav; ?>">
                        <a href="<?php echo url($route_prefix, 'tree'); ?>" class="steamerst_link" data-main-link="st_roadmaps">
                            <i class="iconsminds-digital-drawing"></i> <span class="d-inline-block"><?php echo getLabels('Tree View'); ?></span>
                        </a>
                    </li><?php
					$class_subnav  = ($controller == "DepartmentController" && in_array($current_action, ['departmental']))?"active":""; ?>
						
                    <li class="<?php echo $class_subnav; ?>">
                         <a href="<?php echo url($route_prefix, 'departmental'); ?>" class="steamerst_link" data-main-link="st_roadmaps">
                            <i class="simple-icon-envelope-open"></i> <span class="d-inline-block"><?php echo getLabels('Departmental View'); ?></span>
                        </a>
                    </li>
                </ul>
				<ul class="list-unstyled" data-link="analytic_manager">
					<?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['transaction_manager']))?"active":""; ?>
						<li class="<?php echo $class_subnav; ?>">
							<a class="" href="javascript:void(0);" onclick="onFunc('strategic-map')" data-main-link="st_analytics">
								<i class="simple-icon-cursor"></i>
								<?php echo getLabels('Strategic Map'); ?>

							</a>
						</li><?php
						
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['admin_payouts', 'payouts_amount_details']))?"active":""; ?>
						<li class="<?php echo $class_subnav; ?>">
							<a class="" href="javascript:void(0);" onclick="onFunc('scorecard')" data-main-link="st_analytics">
								<i class="simple-icon-cursor"></i>
								<?php echo getLabels('Scorecard'); ?>

							</a>
						</li><?php
					
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['payout_history','payout_history_detail']))?"active":""; ?>
						<li class="<?php echo $class_subnav; ?>">
							<a class="" href="javascript:void(0);" onclick="onFunc('tree')" data-main-link="st_analytics">
								<i class="simple-icon-cursor"></i>
								<?php echo getLabels('Roadmap'); ?>

							</a>
						</li><?php
					
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['payout_history','payout_history_detail']))?"active":""; ?>
						<li class="<?php echo $class_subnav; ?>">
							<a class="" href="javascript:void(0);" onclick="onFunc('timemap')" data-main-link="st_analytics">
								<i class="iconsminds-clock"></i>
								<?php echo getLabels('TimeMap'); ?>

							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['admin_add_subscriptionlevel', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
							
						<li class="<?php echo $class_subnav; ?>">
							<a class="" href="javascript:void(0);" onclick="onFunc('reports')" data-main-link="st_analytics">
								<i class="simple-icon-cursor"></i>
								<?php echo getLabels('reports'); ?>

							</a>
						</li>
						<?php $class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['admin_add_subscriptionlevel', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
							
						<li class="<?php echo $class_subnav; ?>">
							<a class=""  href="javascript:void(0);" onclick="onFunc('departmental')"  data-main-link="st_analytics">
								<i class="simple-icon-cursor"></i>
								<?php echo getLabels('Department Charts'); ?>

							</a>
						</li>
						<?php $class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['admin_add_subscriptionlevel', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
							
						<li class="<?php echo $class_subnav; ?>">
							<a class="" href="javascript:void(0);" onclick="onFunc('subscription')"  data-main-link="st_analytics">
								<i class="simple-icon-cursor"></i>
								<?php echo getLabels('Subscription'); ?>

							</a>
						</li>
					</ul>
				
				<ul class="list-unstyled" data-link="explore_manager">
					<?php
						$class_nav  = ($controller == "ObjectiveController" && in_array($current_action, ['objectives']))?"active":""; ?>
						<li class="<?php echo $class_subnav; ?>">
							<a class="" href="javascript:void(0);" onclick="onFunc('objectives')" data-main-link="st_explore">
								<i class="iconsminds-statistic"></i>
								<?php echo getLabels('Objectives'); ?>

							</a>
						</li><?php
						
						$class_nav  = ($controller == "ObjectiveController" && in_array($current_action, ['admin_index']))?"active":""; ?>
						<li class="<?php echo $class_subnav; ?>">
							<a class="" href="javascript:void(0);" onclick="onFunc('measures')" data-main-link="st_explore">
								<i class="simple-icon-hourglass"></i>
								<?php echo getLabels('Measures'); ?>

							</a>
						</li><?php
					
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['payout_history','payout_history_detail']))?"active":""; ?>
						<li class="<?php echo $class_subnav; ?>">
							<a class="" href="javascript:void(0);" onclick="onFunc('initiatives')" data-main-link="st_explore">
								<i class="simple-icon-book-open"></i>
								<?php echo getLabels('Initiatives'); ?>

							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['admin_add_subscriptionlevel', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
							
						<li class="<?php echo $class_subnav; ?>">
							<a class="" href="javascript:void(0);" onclick="onFunc('kpis')" data-main-link="st_explore">
								<i class="simple-icon-layers"></i>
								<?php echo getLabels('KPIs'); ?>

							</a>
						</li>
						
					</ul>
						
						
						<ul class="list-unstyled" data-link="subscription_manager">
					 <?php
					
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['my_channel_subscriptions']))?"active":""; ?>
						<li class="<?php echo $class_subnav; ?>">
							<a class="" href="javascript:void(0);" onclick="onFunc('members')" data-main-link="st_members">
								<i class="simple-icon-people"></i>
								<?php echo getLabels('Members'); ?>

							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['subscription_list']))?"active":""; ?>
							
						<li class="<?php echo $class_subnav; ?>">
							<a class="" href="javascript:void(0);" onclick="onFunc('department')"  data-main-link="st_members"><i class="iconsminds-embassy"></i><?php echo getLabels('Departments'); ?>

							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['subscription_plans', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
							
						<li class="<?php echo $class_subnav; ?>">
							<a class="" href="javascript:void(0);" onclick="onFunc('team')" data-main-link="st_members">
								<i class="simple-icon-organization"></i>
								<?php echo getLabels('Teams'); ?>

							</a>
						</li>
					
					
                </ul>
            </div>
        </div>
    </div>