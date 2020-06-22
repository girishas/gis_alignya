<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title">{!! getLabels('invite_members') !!}</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@if(!$all_users->isEmpty())
		{!! Form::open(array('url' => array('invite-frinds-mid/'.$slug), 'class' =>'steamerstudio_inviteform needs-validation tooltip-label-right', 'name'=>'Search')) !!}
			<div class="modal-body ">
				<div class="row">
					<div class="col-12 mb-4">
						<div class="top-right-button-container">
							<div class="btn btn-primary btn-lg pl-0 pr-2 check-button">
								<label class="custom-control custom-checkbox mb-0 d-inline-block">
									<input type="checkbox" class="custom-control-input" id="checkAll">
									<span class="custom-control-label">&nbsp;</span>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 list" data-check-all="checkAll">
						@foreach($all_users as $all_user)
							<div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3">
								<a class="d-flex" href="javascript:void(0);">
									{!! showImage($all_user->photo, "img-thumbnail border-0 rounded-circle ml-0 mr-4 list-thumbnail align-self-center xsmall", "","",$all_user->first_name, 'users/profile-photo') !!}
								</a>
								<div class="d-flex flex-grow-1 min-width-zero">
									<div class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
										<div class="min-width-zero">
											<a href="javascript:void(0);"> 
												<p class=" mb-0 truncate">{!! $all_user->first_name." ".$all_user->last_name !!}</p>
											</a>
										</div>
									</div>
								</div>
								<label class="custom-control custom-checkbox mb-1 align-self-center pr-2">
									<input type="checkbox" value="{!! $all_user->uniq_username !!}"  name="invites[]" class="custom-control-input">
									<span class="custom-control-label">&nbsp;</span>
								</label>
							</div>
						@endforeach

					</div>
				</div>
			</div>	
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-primary" data-dismiss="modal">{!! getLabels('Cancel') !!}</button>
				<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>
			</div>
		@else
			<div class="row">
				<div class="col-12">
					<p class="list-item-heading mb-1 text-center mt-3">{!! getLabels('no_followers_to_invite') !!}</p>
				</div>
			</div>
		@endif
	{!! Form::close() !!}
</div>