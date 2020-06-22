<?php
	$totalGroupRequestcount = totalGroupRequestcount();
	$groupreqHeaders = getGroupRequestsHeader();  ?>
	<button class="header-icon btn btn-empty" type="button" id="groupRequestButton"
		data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i class="iconsminds-conference"></i>
		<span class="count" style="{!! $totalGroupRequestcount > 0?'opacity:1;':'opacity:0' !!}">{!! $totalGroupRequestcount  !!}</span>
	</button>
	<div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="groupRequestDropdown">
		<div class="scroll">
			@if(!$groupreqHeaders->isEmpty())
				@foreach($groupreqHeaders as $groupreqHeader)
					@if($groupreqHeader->user_id == Auth::User()->uniq_username)
						<div class="d-flex flex-row mb-3 pb-3 border-bottom">
							<a href="javascript:void(0);">
								{!! showImage($groupreqHeader->memberUser->photo, "img-thumbnail list-thumbnail xsmall border-0 rounded-circle", "","", $groupreqHeader->memberUser->first_name, 'users/profile-photo') !!}
							</a>
							<div class="pl-3">
								<a href="javascript:void(0);">
									<p class="font-weight-medium mb-1 text-small">
										{!! str_replace(array('{MEMBER}', '{GROUP}'), array($groupreqHeader->memberUser->first_name." ".$groupreqHeader->memberUser->last_name,  $groupreqHeader->name), getLabels('member_sent_request_to_join_group_group')) !!}
									</p>
								</a>
								<div class="mb-1">
									<a href="javascript:void(0);" onclick="joingroup(1, {!! $groupreqHeader->id !!});" class="btn btn-outline-primary btn-xs">{!! getLabels('approve') !!}</a>
									<a href="javascript:void(0);" onclick="joingroup(2, {!! $groupreqHeader->id !!});"  class="btn btn-outline-danger btn-xs">{!! getLabels('decline') !!}</a>
								</div>
							</div>
						</div>
					@else
						<div class="d-flex flex-row mb-3 pb-3 border-bottom">
							<a href="javascript:void(0);">
								{!! showImage($groupreqHeader->icon, "img-thumbnail list-thumbnail xsmall border-0 rounded-circle", "","", $groupreqHeader->name, 'groups') !!}
							</a>
							<div class="pl-3">
								<a href="javascript:void(0);">
									<p class="font-weight-medium mb-1 text-small">
										{!! str_replace(array('{GROUP}'), array($groupreqHeader->name), getLabels('you_are_invited_to_join_group')) !!}
									</p>
								</a>
								<div class="mb-1">
									<a href="javascript:void(0);" onclick="joingroup(1, {!! $groupreqHeader->id !!});" class="btn btn-outline-primary btn-xs">{!! getLabels('accept') !!}</a>
									<a href="javascript:void(0);" onclick="joingroup(2, {!! $groupreqHeader->id !!});"  class="btn btn-outline-danger btn-xs">{!! getLabels('reject') !!}</a>
								</div>
							</div>
						</div>
					@endif
					
				@endforeach
			@else
				<div class="d-flex flex-row mb-3 pb-3 border-bottom">
					<p class="font-weight-medium mb-1 text-light text-center">{!! getLabels('no_requests_yet') !!}.</p>
				</div>
			@endif
			 
		</div>
		<p class="text-center">
			<a  href="{!! url($route_prefix, 'group-request') !!}"  class="text-primary bold steamerst_link">{!! getLabels('view_all_request') !!}</a>
		</p>
	</div>