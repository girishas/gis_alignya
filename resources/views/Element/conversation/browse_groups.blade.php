@if(!$data->isEmpty())
	@foreach($data as $val)
		<div class="col-md-6 col-sm-6 col-lg-6 col-12 ">
			<div class="card d-flex flex-row mb-2">
				<a class="d-flex" href="javascript:void(0);">
					{!! showImage($val->icon, 'img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center', "", "", $val->name, 'groups') !!}
				</a>
				<div class=" d-flex flex-grow-1 min-width-zero">
					<div class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
						<div class="min-width-zero">
							<a href="javascript:void(0);">
								<p class="list-item-heading mb-1 truncate">{!! $val->name !!}</p>
							</a>
							<p class="mb-2 text-muted text-small"> {!! $val->totalMember !!} {!! $val->totalMember > 1?getLabels('Members'):str_singular(getLabels('Members')) !!}</p>
							@if($val->privacy == 1)
								<a href="javascript:void(0);" rel="{!! $val->slug !!}" class="btn btn-xs btn-outline-primary joinagrp">{!! getLabels('join') !!}</a>
							@elseif($val->privacy == 2)
								<?php $isgroupMember = isGroupMember($val->slug); ?>
								@if(isset($isgroupMember->is_active))
									<a href="javascript:void(0);" rel="{!! $val->slug !!}" class="btn btn-xs btn-outline-primary">{!! getLabels('requested') !!}</a>
								@else
									<a href="javascript:void(0);" rel="{!! $val->slug !!}" class="btn btn-xs btn-outline-primary joinagrp">{!! getLabels('send_request') !!}</a>
								@endif
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
@elseif(!isset($_GET['page']) OR (isset($_GET['page']) and $_GET['page'] == 1))
	<div class="col-12 ">
		<div class="card d-flex flex-row mb-2">
			<div class="card-body">
				{!! getLabels('no_results_to_show') !!}
			</div>
		</div>
	</div>
@endif