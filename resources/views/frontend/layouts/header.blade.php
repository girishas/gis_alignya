<nav class="navbar fixed-top">
	
        <div class="d-flex align-items-center navbar-left">
			@if(Auth::check())
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
				
			@endif
        </div>

		@if(Auth::check())
			<a class="navbar-logo" href="{!! url($route_prefix, 'dashboard') !!}">
				<span class=" d-none d-xs-block "><img src="{!!url('/public/img/logo.png')!!}" style="width: 130px;"></span>
			</a>
		@else
			<a class="navbar-logo steamerst_link" href="{!! url($route_prefix, 'login') !!}">
				<span class=" d-none d-xs-block "><img src="{!!url('/public/img/logo.png')!!}" style="width: 130px;"></span>
			</a>
		@endif

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
				
				@if(Auth::check())
					@if(Auth::User()->role_id != 1)
					<div class="position-relative d-none d-sm-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-grid"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3  position-absolute" id="iconMenuDropdown" style="height: 200px">
                        

                        <a href="{!!url('profile')!!}" class="icon-menu-item">
                            <i class="iconsminds-male-female d-block"></i>
                            <span>Profile</span>
                        </a>

                        <a href="javascript:void(0);" onclick="showChangePasswordModal()" class="icon-menu-item">
                            <i class="iconsminds-password d-block"></i>
                            <span>Password</span>
                        </a>

                       

                        <a href="{!!url('ideas')!!}" class="icon-menu-item">
                            <i class="iconsminds-air-balloon-1"></i>
                            <span>Idea</span>
                        </a>
                       
                        <a href="{!!url('supports')!!}" class="icon-menu-item">
                            <i class="iconsminds-gear d-block"></i>
                            <span>Support</span>
                        </a>

                    </div>
                </div>
					
				@endif
				@endif


            </div>
			
			@if(Auth::check())
				<div class="user d-inline-block">
			@else
				<div class="user d-inline-block" style="margin-right:15px;">
			@endif
				
				@if(Auth::check())
					<button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
						aria-expanded="false">
						@if(Auth::User()->role_id != 1)
						<span class="name">{!! Auth::check()?Auth::User()->first_name." ".Auth::User()->last_name:"" !!}</span>
						@else
						<span class="name">{!! Auth::check()?Auth::User()->first_name." ".Auth::User()->last_name:"" !!}</span>
						@endif
						
						
						<span>
							@if(Auth::check())
								{!! showImage(Auth::User()->photo, "", "","", Auth::User()->first_name, 'users/profile-photo') !!}
							@endif
						</span>
					</button>
					
					@if(Auth::check())
						<div class="dropdown-menu dropdown-menu-right mt-3">
							@if(Auth::User()->role_id != 1)
							<a class="dropdown-item steamerst_link" href="{!!url('profile')!!}">{!! getLabels('my_profile') !!}</a>
							@endif
							<a class="dropdown-item " href="javascript:void(0);" onclick="showChangePasswordModal()">{!! getLabels('Change_Password') !!}</a>
							<a class="dropdown-item" href="javascript:void(0);" onclick="logout();">{!! getLabels('sign_out') !!}</a>
						</div>
					@endif
				@else
					<a class="btn btn-primary steamerst_link" href="{!! url($route_prefix.'/login') !!}">{!! getLabels('login') !!}</a>
				@endif
            </div>
        </div>
    </nav>
	