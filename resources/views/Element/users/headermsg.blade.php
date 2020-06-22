<?php
	$totalUnreadMessage = totalUnreadMessage();
	$msgHeaders = getMessagesHeader();  ?>
	<button class="header-icon btn btn-empty" type="button" id="headerMsgButton"
		data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<i class="simple-icon-bubbles"></i>
		<span class="count" id="totalUnreadMessage" style="{!! $totalUnreadMessage > 0?'opacity:1;':'opacity:0' !!}">{!! $totalUnreadMessage  !!}</span>
	</button>
	<div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="headerMsgDropdown">
		<div class="scroll"  id="my_msg_list">
			@if(!$msgHeaders->isEmpty())
				@foreach($msgHeaders as $msgHeader)
					<?php $elem = ($msgHeader->group_id)?$msgHeader->group_id:$msgHeader->sender; ?>
					<div class="d-flex flex-row mb-3 pb-3 border-bottom" id="mymsdiv{!! $elem !!}">
						<a href="javascript:void(0);">
							{!! showImage($msgHeader->User->photo, "img-thumbnail list-thumbnail xsmall border-0 rounded-circle", "","", $msgHeader->User->first_name, 'users/profile-photo') !!}
							
						</a>
						<div class="pl-3">
							@if($msgHeader->group_id)
								<a href="{!! url($route_prefix.'/messages/'.$msgHeader->sender) !!}" class="steamerst_link">
							@else
								<a href="{!! url($route_prefix.'/messages/'.$msgHeader->sender) !!}" class="steamerst_link">
							@endif
								<p class="list-item-heading mb-1 truncate">{!! $msgHeader->User->first_name." ".$msgHeader->User->last_name !!}</p>
								<p class="font-weight-medium mb-1">{!! $msgHeader->message !!}</p>
								<p class="text-muted mb-0 text-small">{!! date('d/m/Y H:i:s', strtotime($msgHeader->created_at)) !!}</p>
							</a>
						</div>
					</div>
					
				@endforeach
			@else
				<div class="d-flex flex-row mb-3 pb-3 border-bottom">
					<p class="font-weight-medium mb-1 text-light text-center">{!! getLabels('no_messages_yet') !!}</p>
				</div>
			@endif
			 
		</div>
		<p class="text-center">
			<a  href="{!! url($route_prefix, 'messages') !!}"  class="text-primary bold steamerst_link">{!! getLabels('view_all_messages') !!}</a>
		</p>
	</div>