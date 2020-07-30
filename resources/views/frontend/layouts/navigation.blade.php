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
                    <li class="{!! $class_nav !!}" id="">
                      <a class="" href="javascript:void(0);" onclick="onFunc('dashboard')">
                            <i class="iconsminds-shop-4"></i>
                            {!! getLabels('Dashboard') !!}
                        </a>
                    </li>
                    
                   
					@if(Auth::check() and Auth::User()->role_id == 1)<?php
						$class_nav  = (($controller == "UserController" && in_array($current_action, ['admin_index'])) OR (strpos(URL::current(),'members') !== false))?"active":""; ?>
						
						<li class="{!! $class_nav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'companies') !!}">
								<i class="iconsminds-male-female"></i>
								{!! getLabels('Company') !!}
							</a>
						</li> 
						<?php
						$class_nav  = ($controller == "DepartmentController" && in_array($current_action, ['subscription_plans']))?"active":""; ?>
						
						<li class="{!! $class_nav !!}">
							<a href="#masters">
								<i class="simple-icon-settings"></i>
								{!! getLabels('Masters') !!}
							</a>
						</li> 
						<?php
						$class_nav  = (($controller == "UserController" && in_array($current_action, ['admin_index'])) OR (strpos(URL::current(),'members') !== false))?"active":""; ?>
						
						<li class="{!! $class_nav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'transactions') !!}">
								<i class="iconsminds-money-bag"></i>
								{!! getLabels('transactions') !!}
							</a>
						</li> 
						
					@else
						<?php /* Show All users - Cmpany/ hod/ team */ ?>
					 <?php
                    $class_nav  = (in_array($controller,['TeamController','DepartmentController']) && in_array($current_action, ['startegic_map','scorecard','roadmap','timemap','reports','departmental','subscription']))?"active":""; ?>
                    <li class="{!! $class_nav !!}" id="st_analytics">
                      <a class="" href="#analytic_manager" >
                            <i class="simple-icon-pie-chart"></i>
                            {!! getLabels('Analytics') !!}
                        </a>
                    </li>
                    <?php
                    $class_nav  = (in_array($controller, ['MeasureController','ObjectiveController','InitiativeController','KPIController']) && in_array($current_action, ['admin_index']))?"active":""; ?>
                    <li class="{!! $class_nav !!}" id="st_explore">
                      <a class="" href="#explore_manager" >
                            <i class="simple-icon-organization"></i>
                            {!! getLabels('Explore') !!}
                        </a>
                    </li>
                    <?php
                    $class_nav  = ($controller == "TeamController" && in_array($current_action, ['ideas']))?"active":""; ?>
                    <li class="{!! $class_nav !!}" >
                      <a class="" href="javascript:void(0);" onclick="onFunc('ideas')"  >
                            <i class="iconsminds-air-balloon-1"></i>
                            {!! getLabels('Ideas') !!}
                        </a>
                    </li>
						<?php $class_nav  = (in_array($controller,["UserController","DepartmentController","TeamController"]) && in_array($current_action, ['admin_index']))?"active":""; ?>
						
						<li class="{!! $class_nav !!}" id="st_members">
							<a class="" href="#subscription_manager" >
	                            <i class="simple-icon-people"></i>
	                            {!! getLabels('members') !!}
	                        </a>
						</li> 
					 </li>
						<?php $class_nav  = (in_array($controller,["DepartmentController"]) && in_array($current_action, ['scorecard_list']))?"active":""; ?>
						
						<li class="{!! $class_nav !!}" id="st_settings">
							<a class="" href="#settings_manager" >
	                            <i class="iconsminds-gear"></i>
	                            {!! getLabels('Settings') !!}
	                        </a>
						</li> 

						
					@endif
					
					<?php $class_nav  = ($controller == "UserController" && in_array($current_action, ['members']))?"active":""; ?>
						
						<li class="{!! $class_nav !!}" id="st_members">
							<a class="" href="#" onclick="logout()">
	                            <i class="simple-icon-logout"></i>
	                            {!! getLabels('logout') !!}
	                        </a>
						</li>
					
                </ul>
            </div>
        </div>

        <div class="sub-menu">
            <div class="scroll">
				<ul class="list-unstyled" data-link="settings_manager"><?php
					$class_subnav  = ($controller == "DepartmentController
					" && in_array($current_action, ['scorecard_list']))?"active":""; ?>
						
                    <li class="{!! $class_subnav !!}">
                        <a href="{!! url($route_prefix, 'scorecards') !!}" class="steamerst_link" data-main-link="st_settings">
                            <i class="simple-icon-cursor"></i> <span class="d-inline-block">{!! getLabels('scorecards') !!}</span>
                        </a>
                    </li><?php
					$class_subnav  = ($controller == "DepartmentController" && in_array($current_action, ['themes']))?"active":""; ?>
						
                    <li class="{!! $class_subnav !!}">
                         <a href="{!! url($route_prefix, 'themes') !!}" class="steamerst_link" data-main-link="st_settings">
                            <i class="simple-icon-cursor"></i> <span class="d-inline-block">{!! getLabels('themes') !!}</span>
                        </a>
                    </li><?php
					$class_subnav  = ($controller == "DepartmentController" && in_array($current_action, ['goalcycles']))?"active":""; ?>
						
                    <li class="{!! $class_subnav !!}">
                         <a href="{!! url($route_prefix, 'goalcycles') !!}" class="steamerst_link" data-main-link="st_settings">
                            <i class="simple-icon-cursor"></i> <span class="d-inline-block">{!! getLabels('goal_cycles') !!}</span>
                        </a>
                    </li><?php
					$class_subnav  = ($controller == "DepartmentController" && in_array($current_action, ['perspectives']))?"active":""; ?>
						
                    <!--<li class="{!! $class_subnav !!}">
                         <a href="{!! url($route_prefix, 'perspectives') !!}" class="steamerst_link" data-main-link="st_settings">
                            <i class="simple-icon-cursor"></i> <span class="d-inline-block">{!! getLabels('perspectives') !!}</span>
                        </a>
                    </li>-->
                </ul>
                <ul class="list-unstyled" data-link="roadmap_manager"><?php
					$class_subnav  = ($controller == "DepartmentController
					" && in_array($current_action, ['tree']))?"active":""; ?>
						
                    <li class="{!! $class_subnav !!}">
                        <a href="{!! url($route_prefix, 'tree') !!}" class="steamerst_link" data-main-link="st_roadmaps">
                            <i class="iconsminds-digital-drawing"></i> <span class="d-inline-block">{!! getLabels('Tree View') !!}</span>
                        </a>
                    </li><?php
					$class_subnav  = ($controller == "DepartmentController" && in_array($current_action, ['departmental']))?"active":""; ?>
						
                    <li class="{!! $class_subnav !!}">
                         <a href="{!! url($route_prefix, 'departmental') !!}" class="steamerst_link" data-main-link="st_roadmaps">
                            <i class="simple-icon-envelope-open"></i> <span class="d-inline-block">{!! getLabels('Departmental View') !!}</span>
                        </a>
                    </li>
                </ul>
				<ul class="list-unstyled" data-link="analytic_manager">
					<?php
						$class_subnav  = ($controller == "TeamController" && in_array($current_action, ['startegic_map']))?"active":""; ?>
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('strategic-map')" data-main-link="st_analytics">
								<i class="simple-icon-cursor"></i>
								{!! getLabels('Strategic Map') !!}
							</a>
						</li><?php
						
						$class_subnav  = ($controller == "TeamController" && in_array($current_action, ['scorecard']))?"active":""; ?>
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('scorecard')" data-main-link="st_analytics">
								<i class="simple-icon-cursor"></i>
								{!! getLabels('Scorecard') !!}
							</a>
						</li><?php
					
						$class_subnav  = ($controller == "DepartmentController" && in_array($current_action, ['roadmap']))?"active":""; ?>
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('roadmap')" data-main-link="st_analytics">
								<i class="simple-icon-cursor"></i>
								{!! getLabels('Roadmap') !!}
							</a>
						</li><?php
					
						$class_subnav  = ($controller == "DepartmentController" && in_array($current_action, ['timemap']))?"active":""; ?>
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('timemap')" data-main-link="st_analytics">
								<i class="iconsminds-clock"></i>
								{!! getLabels('TimeMap') !!}
							</a>
						</li><?php
						$class_subnav  = ($controller == "TeamController" && in_array($current_action, ['reports']))?"active":""; ?>
							
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('reports')" data-main-link="st_analytics">
								<i class="simple-icon-cursor"></i>
								{!! getLabels('reports') !!}
							</a>
						</li>
						<?php $class_subnav  = ($controller == "DepartmentController" && in_array($current_action, ['departmental']))?"active":""; ?>
							
						<li class="{!! $class_subnav !!}">
							<a class=""  href="javascript:void(0);" onclick="onFunc('departmental')"  data-main-link="st_analytics">
								<i class="simple-icon-cursor"></i>
								{!! getLabels('Department Charts') !!}
							</a>
						</li>
						<?php $class_subnav  = ($controller == "DepartmentController" && in_array($current_action, [ 'subscription']))?"active":""; ?>
							
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('subscription')"  data-main-link="st_analytics">
								<i class="simple-icon-cursor"></i>
								{!! getLabels('Subscription') !!}
							</a>
						</li>
					</ul>
				<ul class="list-unstyled" data-link="masters">
						<?php $class_subnav  = ($controller == "DepartmentController" && in_array($current_action, ['subscription_plans', 'subscription_plan_update']))?"active":""; ?>
							
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('subscription-plans')"  data-main-link="st_analytics">
								<i class="simple-icon-cursor"></i>
								{!! getLabels('Subscription_plans') !!}
							</a>
						</li>
						<?php $class_subnav  = ($controller == "DepartmentController" && in_array($current_action, ['perspective']))?"active":""; ?>
							
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('perspective')"  data-main-link="st_analytics">
								<i class="simple-icon-cursor"></i>
								{!! getLabels('perspective') !!}
							</a>
						</li>
					</ul>
				<ul class="list-unstyled" data-link="explore_manager">
					<?php
						$class_nav  = ($controller == "ObjectiveController" && in_array($current_action, ['admin_index']))?"active":""; ?>
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('objectives')" data-main-link="st_explore">
								<i class="iconsminds-statistic"></i>
								{!! getLabels('Objectives') !!}
							</a>
						</li><?php
						
						$class_nav  = ($controller == "MeasureController" && in_array($current_action, ['admin_index']))?"active":""; ?>
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('measures')" data-main-link="st_explore">
								<i class="simple-icon-hourglass"></i>
								{!! getLabels('Measures') !!}
							</a>
						</li><?php
					
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['payout_history','payout_history_detail']))?"active":""; ?>
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('initiatives')" data-main-link="st_explore">
								<i class="simple-icon-book-open"></i>
								{!! getLabels('Initiatives') !!}
							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['admin_add_subscriptionlevel', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
							
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('kpis')" data-main-link="st_explore">
								<i class="simple-icon-layers"></i>
								{!! getLabels('KPIs') !!}
							</a>
						</li>
						
					</ul>
						
						
						<ul class="list-unstyled" data-link="subscription_manager">
					 <?php
					
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['my_channel_subscriptions']))?"active":""; ?>
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('members')" data-main-link="st_members">
								<i class="simple-icon-people"></i>
								{!! getLabels('Members') !!}
							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['subscription_list']))?"active":""; ?>
							
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('department')"  data-main-link="st_members"><i class="iconsminds-embassy"></i>{!! getLabels('Departments') !!}
							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['subscription_plans', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
							
						<li class="{!! $class_subnav !!}">
							<a class="" href="javascript:void(0);" onclick="onFunc('team')" data-main-link="st_members">
								<i class="simple-icon-organization"></i>
								{!! getLabels('Teams') !!}
							</a>
						</li>
					
					
                </ul>
            </div>
        </div>
    </div>