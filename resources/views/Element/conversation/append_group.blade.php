<?php //$group_json[$group->slug]  = $group;
	//$group_json_members[$group->slug]  = $group->groupMembers->toArray();
	//$group_json_members[$group->slug]  = $group->groupMembers->toArray(); 
	//pr($group_json_members); die;
		 ?>
<div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3 chat_list_users" data-username="{!! $group->slug !!}" style="cursor:pointer;" onclick="onUserSelected(this);">
	<a class="d-flex" href="javascript:void(0);">
		@if($group->icon and file_exists('public/upload/groups/'.$group->icon))
			{!! HTML::image('public/upload/groups/'.$group->icon, $group->name, array("class"=>"img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall userimage".$group->slug)) !!}
		@endif
	</a>
	<div class="d-flex flex-grow-1 min-width-zero">
		<div class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
			<div class="min-width-zero">
				<a href="javascript:void(0);">
					<p class=" mb-0 truncate" id="msguname{!! $group->slug !!}">{!! $group->name !!}</p>
				</a>
				 <p class="mb-1 text-muted text-small" id="maingm{!! $group->slug !!}">
					<a href="javascript:void(0);" onclick="openMembersModal('{!!  $group->slug !!}')" title="{!! getLabels('click_to_see_all_the_members') !!}">
					 {!! $group->totalMember !!} {!! $group->totalMember > 1?getLabels('Members'):str_singular(getLabels('Members')) !!}
					</a>
				</p>
				<?php /* <div class="spinner spinner-side" style="opacity:0;" id="mSpinner{!! $val->uniq_username !!}"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div> */ ?>
			</div>
		</div>
		<span class="btn btn-xs btn-dark icon-button" id="countmsg{!! $group->slug !!}" style="margin-left:10px;{!! ($group->Totalconversation > 0)?'':'display:none;' !!}">{!! $group->Totalconversation !!}</span>
	</div>
	<div class="btn-group float-md-right mr-1 mb-1">
		<a class="" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="{!! getLabels('action') !!}">
			<div class="glyph-icon simple-icon-options"></div>
		</a>
		@if($group->user_id == Auth::User()->uniq_username) <?php
			$remove_url  = url('group-actions/'.$group->slug);
			$remove_msg = getLabels('are_you_sure_you_want_to_remove_this_group'); ?>
			<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 26px, 0px);">
				<a class="dropdown-item update_group" href="javascript:void(0);" data-link="{!! $group->slug !!}">{!! getLabels('update_group') !!}</a>
				@if($group->privacy == 3)
					<a class="dropdown-item invite_group_members" href="javascript:void(0);" data-link="{!! $group->slug !!}">{!! getLabels('invite_members') !!}</a>
				@endif
				<a class="dropdown-item" href="javascript:void(0);" onclick='showConfirmationModalPost("<?php echo getLabels('remove'); ?>", "{!! $remove_msg !!}", "{!! $remove_url !!}", "{!! URL::current() !!}");'>{!! getLabels('remove_group') !!}</a>
			</div>
		@else
			<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 26px, 0px);">
				<a class="dropdown-item group_action" href="javascript:void(0);" data-link="{!! $group->slug !!}" data-action="leave">{!! getLabels('leave_group') !!}</a>
			</div>
		@endif
	</div>
</div>