<nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
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

           <div class="search" data-search-path="{!! url($route_prefix.'/search') !!}?q=" style="width:100%;">
                <input placeholder="{!! getLabels('Search') !!}..." class="typehead">
                <span class="search-icon">
                    <i class="simple-icon-magnifier"></i>
                </span>
            </div>

           
        </div>


        <a class="navbar-logo steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">
			<span class=" d-none d-xs-block fontLogo"><b>{!! config('constants.SITE_TITLE') !!}</b></span>
        </a>

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
					<div class="position-relative d-inline-block"  id="headertoprequestdiv">
						@include('Element/users/headergrouprequest')
					</div>
					<div class="position-relative d-inline-block" id="headertopdiv">
						@include('Element/users/headermsg')
					</div>
					<div class="position-relative d-inline-block"><?php
						$unreadNotification = unreadNotificationCount();
						$notificationsG = getNotifications(); 
						 $n = 0;  ?>
						<button class="header-icon btn btn-empty" type="button" id="notificationButton"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="simple-icon-bell"></i>
							<span class="count" id="unreadNotification" style="{!! $unreadNotification > 0?'opacity:1;':'opacity:0' !!}">{!! $unreadNotification  !!}</span>
						</button>
						<div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="notificationDropdown">
							
							<a  href="javascript:void(0);" onclick="markNotificationRead('all');" class="position-absolute text-primary" style="top:5px;right:10px;">{!! getLabels('Mark_all_as_read') !!}</a>
						
							<div class="scroll mt-2" id="my_noti_list">
								@if(!$notificationsG->isEmpty())
									
									@foreach($notificationsG as $notify)
										<div class="d-flex flex-row mb-3 pb-3 border-bottom">
											<a href="javascript:void(0);">
												{!! showImage($notify->User->photo, "img-thumbnail list-thumbnail xsmall border-0 rounded-circle", "","", $notify->User->first_name, 'users/profile-photo') !!}
											</a>
											<div class="pl-3">
											   <a href="javascript:void(0);">
													<p class="font-weight-medium mb-1">{!! $notify->message !!}</p>
													<p class="text-muted mb-0 text-small">{!! date('d/m/Y H:i:s', strtotime($notify->created_at)) !!}</p>
												</a>
											</div>
										</div>
										<?php $n++; ?>
									@endforeach
								@else
									<div class="d-flex flex-row mb-3 pb-3 border-bottom">
										<p class="font-weight-medium mb-1 text-light text-center">{!! getLabels('No_notifications_yet') !!}</p>
									</div>
								@endif
							</div>
							
							<p class="text-center" rel="{!! $n !!}" id="rel_notifi" style="{!! $n > 0?'opacity:1;':'opacity:0' !!}">
								<a  href="{!! url($route_prefix, 'notifications') !!}"  class="text-primary bold steamerst_link">{!! getLabels('View_All_Notifications') !!}</a>
							</p>
						</div>
					</div>
				@endif


            </div>

            <div class="user d-inline-block">
                <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="name">{!! Auth::check()?Auth::User()->first_name." ".Auth::User()->last_name:"" !!}</span>
                    <span>
						@if(Auth::check())
							{!! showImage(Auth::User()->photo, "", "","", Auth::User()->first_name, 'users/profile-photo') !!}
                        @endif
                    </span>
                </button>
				
				@if(Auth::check())
					<div class="dropdown-menu dropdown-menu-right mt-3">
						<a class="dropdown-item steamerst_link" href="{!! url($route_prefix.'/'.Auth::User()->uniq_username) !!}">{!! getLabels('Posts') !!}</a>
						<a class="dropdown-item steamerst_link" href="{!! url($route_prefix.'/'.Auth::User()->uniq_username.'/myprofile') !!}">{!! getLabels('my_profile') !!}</a>
						<a class="dropdown-item steamerst_link" href="{!! url($route_prefix.'/'.Auth::User()->uniq_username.'/update-profile') !!}">{!! getLabels('update_profile') !!}</a>
						<a class="dropdown-item " href="javascript:void(0);" onclick="showChangePasswordModal()">{!! getLabels('Change_Password') !!}</a>
						<a class="dropdown-item" href="javascript:void(0);" onclick="logout();">{!! getLabels('sign_out') !!}</a>
					</div>
				@endif
            </div>
        </div>
    </nav>
	