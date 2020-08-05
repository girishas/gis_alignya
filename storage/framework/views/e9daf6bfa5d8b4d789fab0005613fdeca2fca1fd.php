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
				
			<?php endif; ?>
        </div>

		<?php if(Auth::check()): ?>
			<a class="navbar-logo" href="<?php echo url($route_prefix, 'dashboard'); ?>">
				<span class=" d-none d-xs-block "><img src="<?php echo url('/public/img/logo.png'); ?>" style="width: 130px;"></span>
			</a>
		<?php else: ?>
			<a class="navbar-logo steamerst_link" href="<?php echo url($route_prefix, 'login'); ?>">
				<span class=" d-none d-xs-block "><img src="<?php echo url('/public/img/logo.png'); ?>" style="width: 130px;"></span>
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
					<?php if(Auth::User()->role_id != 1): ?>
					<div class="position-relative d-none d-sm-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-grid"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3  position-absolute" id="iconMenuDropdown" style="height: 200px">
                        

                        <a href="<?php echo url('profile'); ?>" class="icon-menu-item">
                            <i class="iconsminds-male-female d-block"></i>
                            <span>Profile</span>
                        </a>

                        <a href="javascript:void(0);" onclick="showChangePasswordModal()" class="icon-menu-item">
                            <i class="iconsminds-password d-block"></i>
                            <span>Password</span>
                        </a>

                       

                        <a href="<?php echo url('ideas'); ?>" class="icon-menu-item">
                            <i class="iconsminds-air-balloon-1"></i>
                            <span>Idea</span>
                        </a>
                       
                        <a href="<?php echo url('supports'); ?>" class="icon-menu-item">
                            <i class="iconsminds-gear d-block"></i>
                            <span>Support</span>
                        </a>

                    </div>
                </div>
					
				<?php endif; ?>
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
							<?php if(Auth::User()->role_id != 1): ?>
							<a class="dropdown-item steamerst_link" href="<?php echo url('profile'); ?>"><?php echo getLabels('my_profile'); ?></a>
							<?php endif; ?>
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
	