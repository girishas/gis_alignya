@foreach($following as $follower)
	<div class="col-12 col-md-6 col-lg-4 pfollower_outer{!! $follower->uniq_username !!}">
		<div class="card d-flex flex-row mb-4">
			<a class="d-flex steamerst_link" href="{!! url($route_prefix.'/'.$follower->uniq_username.'/profile') !!}">
				{!! showImage($follower->photo, "img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center", "","", $follower->first_name, 'users/profile-photo') !!}
			</a>
			<div class=" d-flex flex-grow-1 min-width-zero">
				<div
					class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
					<div class="min-width-zero">
						<a href="{!! url($route_prefix.'/'.$follower->uniq_username.'/profile') !!}" class="steamerst_link">
							<p class="list-item-heading mb-1 truncate">{!! ucwords($follower->first_name." ".$follower->last_name) !!}</p>
						</a>
						<p class="mb-2 text-muted text-small">{!! $follower->city !!}{!! $follower->state?", ".$follower->state:"" !!}{!! $follower->country?", ".$follower->country:"" !!}</p>
                        @if(Route::input('username') == Auth::User()->uniq_username)                  
							<div class="dropdown d-inline-block">
								<button class="btn btn-xs btn-outline-primary dropdown-toggle mb-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									{!! getLabels('following') !!}
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item unfollow_user" rel="{!! $follower->uniq_username !!}" href="javascript:void(0);">{!! getLabels('unfollow') !!}</a>
								</div>
							</div>
						@elseif(!in_array($follower->id, $myfollowers))
							<div id="rfb{!! $follower->uniq_username !!}">
								<button type="button" class="btn btn-xs btn-outline-primary follow_btn" rel="{!! $follower->uniq_username !!}">{!! getLabels('follow') !!}</button>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endforeach