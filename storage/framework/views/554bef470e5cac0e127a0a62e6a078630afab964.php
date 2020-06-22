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
                    <li class="<?php echo $class_nav; ?>" id="st_dashboard">
                      <a class="steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>" >
                            <i class="iconsminds-shop-4"></i>
                            <?php echo getLabels('Dashboard'); ?>

                        </a>
                    </li>
					 
					<?php if(Auth::check() and Auth::User()->role_id == 1): ?><?php
						$class_nav  = (($controller == "UserController" && in_array($current_action, ['admin_index'])) OR (strpos(URL::current(),'users') !== false))?"active":""; ?>
						
						<li class="<?php echo $class_nav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'members'); ?>">
								<i class="iconsminds-male-female"></i>
								<?php echo getLabels('Members'); ?>

							</a>
						</li>
					<?php elseif(Auth::check() and Auth::User()->role_id == 2): ?> <?php
						$class_nav  = ($controller == "SubscriptionController" && in_array($current_action, ['subscription_plans', 'my_channel_subscriptions', 'subscription_list', 'transaction_history', 'admin_edit_subscriptions', 'admin_add_subscriptionlevel', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
						
						<li class="<?php echo $class_nav; ?>" id="st_subscription">
							<a href="#subscription_manager">
								<i class="iconsminds-money-bag"></i>
								<span><?php echo getLabels('Subscriptions'); ?></span>
							</a>
						</li>
					<?php endif; ?>
					
                </ul>
            </div>
        </div>

        <div class="sub-menu">
            <div class="scroll">
				<ul class="list-unstyled" data-link="content_manager"><?php
					$class_subnav  = ($controller == "PageController" && in_array($current_action, ['admin_index', 'admin_add', 'admin_edit']))?"active":""; ?>
						
                    <li class="<?php echo $class_subnav; ?>">
                        <a href="<?php echo url($route_prefix, 'pages'); ?>" class="steamerst_link" data-main-link="st_content">
                            <i class="iconsminds-digital-drawing"></i> <span class="d-inline-block"><?php echo getLabels('Pages'); ?></span>
                        </a>
                    </li><?php
					$class_subnav  = ($controller == "TemplateController" && in_array($current_action, ['admin_index', 'admin_add', 'admin_edit', 'admin_view']))?"active":""; ?>
						
                    <li class="<?php echo $class_subnav; ?>">
                         <a href="<?php echo url($route_prefix, 'templates'); ?>" class="steamerst_link" data-main-link="st_content">
                            <i class="simple-icon-envelope-open"></i> <span class="d-inline-block"><?php echo getLabels('Email_Templates'); ?></span>
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
					
					
					<?php if(Auth::check() and Auth::User()->role_id == 1): ?><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['transaction_manager']))?"active":""; ?>
						<li class="<?php echo $class_subnav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'transaction-manager'); ?>" data-main-link="st_subscription">
								<i class="iconsminds-money-bag"></i>
								<?php echo getLabels('Transactions'); ?>

							</a>
						</li><?php
						
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['admin_payouts', 'payouts_amount_details']))?"active":""; ?>
						<li class="<?php echo $class_subnav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'payouts'); ?>" data-main-link="st_subscription">
								<i class="iconsminds-money-bag"></i>
								<?php echo getLabels('Payouts'); ?>

							</a>
						</li><?php
					
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['payout_history','payout_history_detail']))?"active":""; ?>
						<li class="<?php echo $class_subnav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'payout-history'); ?>" data-main-link="st_subscription">
								<i class="iconsminds-money-bag"></i>
								<?php echo getLabels('Payout_History'); ?>

							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['admin_add_subscriptionlevel', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
							
						<li class="<?php echo $class_subnav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'subscriptionlevel'); ?>"  data-main-link="st_subscription">
								<i class="simple-icon-cursor"></i>
								<?php echo getLabels('Subscription_Level'); ?>

							</a>
						</li>
					<?php elseif(Auth::check() and Auth::User()->role_id == 2): ?> <?php
					
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['my_channel_subscriptions']))?"active":""; ?>
						<li class="<?php echo $class_subnav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix.'/my-channel-subscriptions'); ?>" data-main-link="st_subscription">
								<i class="iconsminds-money-bag"></i>
								<?php echo getLabels('My_Channel_Subscriptions'); ?>

							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['subscription_list']))?"active":""; ?>
							
						<li class="<?php echo $class_subnav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'my-subscriptions'); ?>"  data-main-link="st_subscription">
								<i class="simple-icon-cursor"></i>
								<?php echo getLabels('My_Subscriptions'); ?>

							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['subscription_plans', 'admin_subscriptionlevel', 'admin_edit_subscriptionlevel']))?"active":""; ?>
							
						<li class="<?php echo $class_subnav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'subscription-plans'); ?>"  data-main-link="st_subscription">
								<i class="simple-icon-cursor"></i>
								<?php echo getLabels('Subscription_Plans'); ?>

							</a>
						</li><?php
						$class_subnav  = ($controller == "SubscriptionController" && in_array($current_action, ['transaction_history']))?"active":""; ?>
							
						<li class="<?php echo $class_subnav; ?>">
							<a class="steamerst_link" href="<?php echo url($route_prefix, 'transaction-history'); ?>"  data-main-link="st_subscription">
								<i class="simple-icon-cursor"></i>
								<?php echo getLabels('Transaction_History'); ?>

							</a>
						</li>
					
					<?php endif; ?>
                </ul>
            </div>
        </div>
    </div>