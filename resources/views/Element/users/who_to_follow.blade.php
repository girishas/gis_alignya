<?php $whotofollows  = who_to_follow(); ?>
@if(!$whotofollows->isEmpty())
	<div class="card mb-4 d-none d-lg-block" id="rfbwhotofollow">
		<div class="card-body">
			<h5 class="card-title">{!! getLabels('who_to_follow') !!}</h5>
			
			@foreach($whotofollows as $whotofollow)
				<div class="d-flex flex-row mb-3 pb-3 border-bottom justify-content-between align-items-center rfbsub" id="rfb{!! $whotofollow->uniq_username !!}">
					<a href="{!! url($route_prefix.'/'.$whotofollow->uniq_username) !!}" class="steamerst_link">
						{!! showImage($whotofollow->photo, "img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall", "","", $whotofollow->first_name, 'users/profile-photo') !!}
					</a>
					<div class="pl-3 flex-fill">
						<a href="{!! url($route_prefix.'/'.$whotofollow->uniq_username) !!}" class="steamerst_link">
							<p class="font-weight-medium mb-0">{!! ucwords($whotofollow->first_name." ".$whotofollow->last_name) !!}</p>
							<p class="text-muted mb-0 text-small">{!! $whotofollow->city !!}{!! $whotofollow->state?", ".$whotofollow->state:"" !!}{!! $whotofollow->country?", ".$whotofollow->country:"" !!}</p>
						</a>
					</div>
					<div>
						<a href="javascript:void(0);" class="btn btn-xs btn-outline-primary follow_btn" rel="{!! $whotofollow->uniq_username !!}">{!! getLabels('follow') !!}</a>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@endif