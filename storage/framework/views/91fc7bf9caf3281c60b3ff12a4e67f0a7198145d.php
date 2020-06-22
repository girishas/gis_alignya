<nav class="navbar fixed-top">
	
        <div class="d-flex align-items-center navbar-left">
			<?php if(Auth::check()): ?>
				<a href="javascript:void(0);" class="menu-button d-none d-md-block">
					<svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
						<rect x="0.48" y="0.5" width="7" height="1" />
						<rect x="0.48" y="7.5" width="7" height="1" />
						<rect x="0.48" y="15.5" width="7" height="1" />
					</svg>
					<svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
						<rect x="1.56" y="0.5" width="16" height="1" />
						<rect x="1.56" y="7.5" width="16" height="1" />
						<rect x="1.56" y="15.5" width="16" height="1" />
					</svg>
				</a>

				<a href="javascript:void(0);" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
						<rect x="0.5" y="0.5" width="25" height="1" />
						<rect x="0.5" y="7.5" width="25" height="1" />
						<rect x="0.5" y="15.5" width="25" height="1" />
					</svg>
				</a>

			   <div class="search" data-search-path="<?php echo url($route_prefix.'/search'); ?>?q=" style="width:100%;">
					<input placeholder="<?php echo getLabels('Search'); ?>..." class="typehead">
					<span class="search-icon">
						<i class="simple-icon-magnifier"></i>
					</span>
				</div>
			<?php endif; ?>
        </div>

		<?php if(Auth::check()): ?>
			<a class="navbar-logo steamerst_link" href="<?php echo url($route_prefix, 'dashboard'); ?>">
				<span class=" d-none d-xs-block "><b><?php echo HTML::image("public/images/logo.png", "Logo", array("class"=>"", 'style'=>"width:150px;")); ?></b></span>
			</a>
		<?php else: ?>
			<a class="navbar-logo steamerst_link" href="<?php echo url($route_prefix, 'login'); ?>">
				<span class=" d-none d-xs-block "><b><?php echo HTML::image("public/images/logo.png", "Logo", array("class"=>"", 'style'=>"width:150px;")); ?></b></span>
			</a>
		<?php endif; ?>

        <div class="navbar-right"><?php
			/* $getLanguages  = getAllLanguages(); ?>
			
			<div class="btn-group float-none-xs">
				<button class="btn btn-outline-secondary btn-xs dropdown-toggle my_link_xs" id="headerLang" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					@if(session('lang.name'))
						{!! showImage(session('lang.icon'), "img-thumbnail xsmall", "20px","14px", session('lang.name'), 'language') !!}<span class="hidden-xs"> {!! session('lang.name') !!}</span>
					@else
						<?php $lanSelected  = getLanguageByCode('en'); ?>
						{!! showImage($lanSelected->icon, "img-thumbnail xsmall", "20px","14px", $lanSelected->name, 'language') !!}<span class="hidden-xs"> {!! $lanSelected->name !!}</span>
					@endif
				</button>
				<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 26px, 0px);">
					@foreach($getLanguages as $lang)
						<a class="dropdown-item changeLang" href="javascript:void(0);" rel="{!! $lang->id !!}">{!! showImage($lang->icon, "img-thumbnail xsmall", "20px","14px", $lang->name, 'language') !!}<span class="hidden-xs"> {!! $lang->name !!}</span></a>
					@endforeach
				</div>
			</div> */ ?>
			
            <div class="header-icons d-inline-block align-middle">
				<?php /* <div class="position-relative d-inline-block">
					<a class="header-icon btn btn-empty steamerst_link" id="headerMsgButton" href="{!! url($route_prefix, 'messages') !!}">
                        <i class="simple-icon-bubbles"></i>
						<span class="count" id="totalUnreadMessage" style="{!! $totalUnreadMessage > 0?'opacity:1;':'opacity:0' !!}">{!! $totalUnreadMessage  !!}</span>
                    </a>
				</div> */ ?>
				
				<?php if(Auth::check()): ?>
					<div class="position-relative d-inline-block"  id="headertoprequestdiv">
						<?php echo $__env->make('Element/users/headergrouprequest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
					<div class="position-relative d-inline-block" id="headertopdiv">
						<?php echo $__env->make('Element/users/headermsg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					</div>
					<div class="position-relative d-inline-block"><?php
						$unreadNotification = unreadNotificationCount();
						$notificationsG = getNotifications(); 
						 $n = 0;  ?>
						<button class="header-icon btn btn-empty" type="button" id="notificationButton"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="simple-icon-bell"></i>
							<span class="count" id="unreadNotification" style="<?php echo $unreadNotification > 0?'opacity:1;':'opacity:0'; ?>"><?php echo $unreadNotification; ?></span>
						</button>
						<div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="notificationDropdown">
							
							<a  href="javascript:void(0);" onclick="markNotificationRead('all');" class="position-absolute text-primary" style="top:5px;right:10px;"><?php echo getLabels('Mark_all_as_read'); ?></a>
						
							<div class="scroll mt-2" id="my_noti_list">
								<?php if(!$notificationsG->isEmpty()): ?>
									
									<?php $__currentLoopData = $notificationsG; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notify): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="d-flex flex-row mb-3 pb-3 border-bottom">
											<a href="javascript:void(0);">
												<?php echo showImage($notify->User->photo, "img-thumbnail list-thumbnail xsmall border-0 rounded-circle", "","", $notify->User->first_name, 'users/profile-photo'); ?>

											</a>
											<div class="pl-3">
												<?php $notifydetailurl = "javascript:void(0);"; $streameclass = ""; ?>
												<?php if(in_array($notify->type, [1,2,3,7])): ?> <?php 
													$Ndaata  = json_decode($notify->data, true);
													if(!empty($Ndaata['post_id'])){
														$notifydetailurl = url($route_prefix.'/'.Auth::User()->uniq_username.'/posts/'.base64_encode($Ndaata['post_id']));
														$streameclass = "steamerst_link";
													}  ?> 
												<?php elseif(in_array($notify->type, [16])): ?>
													<?php $notifydetailurl = url($route_prefix.'/'.$notify->user_id);
													$streameclass = "steamerst_link";  ?>
												<?php elseif(in_array($notify->type, [12])): ?> <?php 
													$Ndaata  = json_decode($notify->data, true);
													if(!empty($Ndaata['group_id'])){
														$groupInfoN  = getGroupNotificationURL($Ndaata['group_id'], $notify->user_id, $notify->to_user_id);
														$notifydetailurl = $groupInfoN['url'];
														$streameclass = $groupInfoN['class'];
													}  ?> 
												<?php endif; ?>
												<a href="<?php echo $notifydetailurl; ?>" onclick="markNotificationRead(<?php echo $notify->id; ?>);" class="<?php echo $streameclass; ?>">
													<p class="<?php echo ($notify->status == 1)?'font-weight-medium':'font-weight-bold notified notified'.$notify->id; ?> mb-1"><?php echo $notify->message; ?></p>
													<p class="text-muted mb-0 text-small"><?php echo date('d/m/Y H:i:s', strtotime($notify->created_at)); ?></p>
												</a>
											</div>
										</div>
										<?php $n++; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php else: ?>
									<div class="d-flex flex-row mb-3 pb-3 border-bottom">
										<p class="font-weight-medium mb-1 text-light text-center"><?php echo getLabels('No_notifications_yet'); ?></p>
									</div>
								<?php endif; ?>
							</div>
							
							<p class="text-center" rel="<?php echo $n; ?>" id="rel_notifi" style="<?php echo $n > 0?'opacity:1;':'opacity:0'; ?>">
								<a  href="<?php echo url($route_prefix, 'notifications'); ?>"  class="text-primary bold steamerst_link"><?php echo getLabels('View_All_Notifications'); ?></a>
							</p>
						</div>
					</div>
				<?php endif; ?>


            </div>
			
			<?php if(Auth::check()): ?>
				<div class="user d-inline-block">
			<?php else: ?>
				<div class="user d-inline-block" style="margin-right:15px;">
			<?php endif; ?>
				
				<?php if(Auth::check()): ?>
					<button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false">
						<span class="name"><?php echo Auth::check()?Auth::User()->first_name." ".Auth::User()->last_name:""; ?></span>
						<span>
							<?php if(Auth::check()): ?>
								<?php echo showImage(Auth::User()->photo, "", "","", Auth::User()->first_name, 'users/profile-photo'); ?>

							<?php endif; ?>
						</span>
					</button>
					
					<?php if(Auth::check()): ?>
						<div class="dropdown-menu dropdown-menu-right mt-3">
							<a class="dropdown-item steamerst_link" href="<?php echo url($route_prefix.'/'.Auth::User()->uniq_username); ?>"><?php echo getLabels('my_profile'); ?></a>
							<a class="dropdown-item steamerst_link" href="<?php echo url($route_prefix.'/'.Auth::User()->uniq_username.'/update-profile'); ?>"><?php echo getLabels('update_profile'); ?></a>
							<a class="dropdown-item " href="javascript:void(0);" onclick="showChangePasswordModal()"><?php echo getLabels('Change_Password'); ?></a>
							<a class="dropdown-item" href="javascript:void(0);" onclick="logout();"><?php echo getLabels('sign_out'); ?></a>
						</div>
					<?php endif; ?>
				<?php else: ?>
					<a class="btn btn-primary steamerst_link" href="<?php echo url($route_prefix.'/login'); ?>"><?php echo getLabels('login'); ?></a>
				<?php endif; ?>
            </div>
        </div>
    </nav>
	