<?php
	$action 				= (Route::currentRouteAction())?explode('@', Route::currentRouteAction()):'';
	$controllerString		= (isset($action[0]) and $action[0])?$action[0]:'';
	$controllerArr   		= explode("\\", $controllerString);
	$controller  			= array_last($controllerArr);
	$current_action 		= (isset($action[1]) and $action[1])?$action[1]:''; 
	$slug_get 				= Route::input('slug'); ?>
<div class="menu">
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled"><?php
					
					$class_nav  = ($controller == "UserController" && in_array($current_action, ['dashboard']))?"active":""; ?>
                    <li class="{!! $class_nav !!}" id="st_dashboard">
                      <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}" >
                            <i class="iconsminds-shop-4"></i>
                            {!! getLabels('Dashboard') !!}
                        </a>
                    </li>
					@if(Auth::check())
						<?php
						$class_nav  = ($controller == "PostController" && in_array($current_action, ['index']))?"active":""; ?>
						<li class="{!! $class_nav !!}" id="st_posts">
						  <a class="steamerst_link" href="{!! url($route_prefix.'/'.Auth::User()->uniq_username) !!}" >
								<i class="simple-icon-home"></i>
								{!! getLabels('Posts') !!}
							</a>
						</li><?php
						$class_nav  = ($controller == "ConversationController" && in_array($current_action, ['discover_groups']))?"active":""; ?>
						
						<li class="{!! $class_nav !!}" id="st_groups">
						  <a class="steamerst_link" href="{!! url($route_prefix.'/discover-groups') !!}" >
								<i class="iconsminds-conference"></i>
								{!! getLabels('Groups') !!}
							</a>
						</li><?php
						
						$class_nav  = ($controller == "ConversationController" && in_array($current_action, ['index']))?"active":""; ?>
						
						<li class="{!! $class_nav !!}" id="st_messages">
						  <a class="steamerst_link" href="{!! url($route_prefix.'/messages') !!}" >
								<i class="simple-icon-bubbles"></i>
								{!! getLabels('messages') !!}
							</a>
						</li>
					@endif 
					@if(Auth::check() and Auth::User()->role_id == 1)<?php
						$class_nav  = (($controller == "UserController" && in_array($current_action, ['admin_index'])) OR (strpos(URL::current(),'users') !== false))?"active":""; ?>
						
						<li class="{!! $class_nav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'users') !!}">
								<i class="iconsminds-male-female"></i>
								{!! getLabels('Users') !!}
							</a>
						</li><?php
						$class_nav  = (($controller == "PageController" OR  $controller == "TemplateController" ) && in_array($current_action, ['admin_view', 'admin_index', 'admin_add', 'admin_edit']))?"active":""; ?>
						
						<li class="{!! $class_nav !!}" id="st_content">
							<a href="#content_manager">
								<i class="iconsminds-library"></i>
								<span>{!! getLabels('Content') !!}</span>
							</a>
						</li><?php
						
						$class_nav  = ($controller == "SettingController" && in_array($current_action, ['admin_languages', 'admin_edit_language', 'admin_add_language']))?"active":""; ?>
						
						<li class="{!! $class_nav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'languages') !!}">
								<i class="iconsminds-sound"></i>
								{!! getLabels('Languages') !!}
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

						<li class="{!! $class_nav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'labels') !!}">
								<i class="simple-icon-docs"></i>
								{!! getLabels('Labels') !!}
							</a>
						</li><?php
						$class_nav  = ($controller == "SettingController" && in_array($current_action, ['admin_add_page_images', 'admin_edit_page_images', 'admin_page_images']))?"active":""; ?>	

						<li class="{!! $class_nav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'page_images') !!}">
								<i class="simple-icon-picture"></i>
								{!! getLabels('Page_Images') !!}
							</a>
						</li><?php
						$class_nav  = ($controller == "SettingController" && in_array($current_action, ['admin_add_testimonials', 'admin_testimonials', 'admin_edit_testimonials']))?"active":""; ?>	

						<li class="{!! $class_nav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'testimonials') !!}">
								<i class="simple-icon-list"></i>
								{!! getLabels('Testimonials') !!}
							</a>
						</li><?php
						$class_nav  = ($controller == "SettingController" && in_array($current_action, ['admin_add_faqs', 'admin_faqs', 'admin_edit_faqs']))?"active":""; ?>
						<li class="{!! $class_nav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'faqs') !!}">
								<i class="simple-icon-question"></i>
								{!! getLabels('Faqs') !!}
							</a>
						</li><?php
						$class_nav  = ($controller == "SubscriptionController" && in_array($current_action, ['payouts_amount_details', 'payout_history_detail', 'transaction_manager', 'admin_payouts', 'payout_history', 'admin_add_subscriptions', 'admin_subscriptions', 'admin_edit_subscriptions', 'admin_add_subscriptionlevel', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
						
						<li class="{!! $class_nav !!}" id="st_subscription">
							<a href="#subscription_manager">
								<i class="iconsminds-money-bag"></i>
								<span>{!! getLabels('Transactions') !!}</span>
							</a>
						</li><?php
						$class_nav  = ($controller == "SettingController" && in_array($current_action, ['admin_update']))?"active":""; ?>
						
						<li class="{!! $class_nav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'settings') !!}">
								<i class="simple-icon-settings"></i>
								{!! getLabels('Settings') !!}
							</a>
						</li><?php
						$class_nav  = ($controller == "BadgeController" && in_array($current_action, ['admin_index', 'admin_add', 'admin_edit']))?"active":""; ?>
						
						<?php /* <li class="{!! $class_nav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'badges') !!}">
								<i class="simple-icon-badge"></i>
								Badges
							</a>
						</li> */ ?>
					@elseif(Auth::check() and Auth::User()->role_id == 2) <?php
						$class_nav  = ($controller == "SubscriptionController" && in_array($current_action, ['subscription_plans', 'my_channel_subscriptions', 'subscription_list', 'transaction_history', 'admin_edit_subscriptions', 'admin_add_subscriptionlevel', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
						
						<li class="{!! $class_nav !!}" id="st_subscription">
							<a href="#subscription_manager">
								<i class="iconsminds-money-bag"></i>
								<span>{!! getLabels('Subscriptions') !!}</span>
							</a>
						</li>
					@endif
					
                </ul>
            </div>
        </div>

        <div class="sub-menu">
            <div class="scroll">
				<ul class="list-unstyled" data-link="content_manager"><?php
					$class_subnav  = ($controller == "PageController" && in_array($current_action, ['admin_index', 'admin_add', 'admin_edit']))?"active":""; ?>
						
                    <li class="{!! $class_subnav !!}">
                        <a href="{!! url($route_prefix, 'pages') !!}" class="steamerst_link" data-main-link="st_content">
                            <i class="iconsminds-digital-drawing"></i> <span class="d-inline-block">{!! getLabels('Pages') !!}</span>
                        </a>
                    </li><?php
					$class_subnav  = ($controller == "TemplateController" && in_array($current_action, ['admin_index', 'admin_add', 'admin_edit', 'admin_view']))?"active":""; ?>
						
                    <li class="{!! $class_subnav !!}">
                         <a href="{!! url($route_prefix, 'templates') !!}" class="steamerst_link" data-main-link="st_content">
                            <i class="simple-icon-envelope-open"></i> <span class="d-inline-block">{!! getLabels('Email_Templates') !!}</span>
                        </a>
                    </li>
                </ul>
				<ul class="list-unstyled" data-link="subscription_manager"><?php
					/* $class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['admin_add_subscriptions', 'admin_subscriptions', 'admin_edit_subscriptions']))?"active":""; ?>
					<li class="{!! $class_subnav !!}">
						<a class="steamerst_link" href="{!! url($route_prefix, 'subscriptions') !!}" data-main-link="st_subscription">
							<i class="iconsminds-money-bag"></i>
							Subscriptions
						</a>
					</li> */ ?>
					
					
					@if(Auth::check() and Auth::User()->role_id == 1)<?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['transaction_manager']))?"active":""; ?>
						<li class="{!! $class_subnav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'transaction-manager') !!}" data-main-link="st_subscription">
								<i class="iconsminds-money-bag"></i>
								{!! getLabels('Transactions') !!}
							</a>
						</li><?php
						
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['admin_payouts', 'payouts_amount_details']))?"active":""; ?>
						<li class="{!! $class_subnav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'payouts') !!}" data-main-link="st_subscription">
								<i class="iconsminds-money-bag"></i>
								{!! getLabels('Payouts') !!}
							</a>
						</li><?php
					
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['payout_history','payout_history_detail']))?"active":""; ?>
						<li class="{!! $class_subnav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'payout-history') !!}" data-main-link="st_subscription">
								<i class="iconsminds-money-bag"></i>
								{!! getLabels('Payout_History') !!}
							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['admin_add_subscriptionlevel', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
							
						<li class="{!! $class_subnav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'subscriptionlevel') !!}"  data-main-link="st_subscription">
								<i class="simple-icon-cursor"></i>
								{!! getLabels('Subscription_Level') !!}
							</a>
						</li>
					@elseif(Auth::check() and Auth::User()->role_id == 2) <?php
					
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['my_channel_subscriptions']))?"active":""; ?>
						<li class="{!! $class_subnav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix.'/my-channel-subscriptions') !!}" data-main-link="st_subscription">
								<i class="iconsminds-money-bag"></i>
								{!! getLabels('My_Channel_Subscriptions') !!}
							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['subscription_list']))?"active":""; ?>
							
						<li class="{!! $class_subnav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'my-subscriptions') !!}"  data-main-link="st_subscription">
								<i class="simple-icon-cursor"></i>
								{!! getLabels('My_Subscriptions') !!}
							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['subscription_plans', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
							
						<li class="{!! $class_subnav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'subscription-plans') !!}"  data-main-link="st_subscription">
								<i class="simple-icon-cursor"></i>
								{!! getLabels('Subscription_Plans') !!}
							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['transaction_history']))?"active":""; ?>
							
						<li class="{!! $class_subnav !!}">
							<a class="steamerst_link" href="{!! url($route_prefix, 'transaction-history') !!}"  data-main-link="st_subscription">
								<i class="simple-icon-cursor"></i>
								{!! getLabels('Transaction_History') !!}
							</a>
						</li>
					
					@endif
                </ul>
            </div>
        </div>
    </div>