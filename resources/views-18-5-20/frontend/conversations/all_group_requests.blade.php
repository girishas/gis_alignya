@extends('frontend/layouts/default')

@section('content')
	<main>
        <div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1>{!! getLabels('all_group_requests') !!}</h1>
						<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                            <ol class="breadcrumb pt-0">
                               <li class="breadcrumb-item">
									<a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
								</li>
                                <li class="breadcrumb-item active" aria-current="page">{!! getLabels('all_group_requests') !!}</li>
                            </ol>
                        </nav>
                    </div>
					<div class="float-md-right mb-3">
						<span class="text-muted text-small">{!! str_replace(array('{FIRST}', '{LAST}', '{TOTAL}'), array($data->firstItem(), $data->lastItem(), $data->total()), getLabels('showing_first_to_last_of_total_records')) !!}</span>
					</div>
				</div>
			</div>
                    <div class="separator mb-5"></div>
                </div>
            </div>
		
            <div class="row">
                <div class="col-12 list">
					@if(!$data->isEmpty())
						@foreach($data as $val)
							
							@if($val->user_id == Auth::User()->uniq_username)
								<div class="card d-flex flex-row mb-3" id="grtp{!! $val->id !!}">
									<div class="card-body d-flex flex-row">
										<a href="javascript:void(0);">
											{!! showImage($val->memberUser->photo, "img-thumbnail list-thumbnail xsmall border-0 rounded-circle", "","", $val->memberUser->first_name, 'users/profile-photo') !!}
										</a>
										<div class="pl-3">
										   <a href="javascript:void(0);">
												<p class="font-weight-medium mb-1">{!! str_replace(array('{MEMBER}', '{GROUP}'), array($val->memberUser->first_name." ".$val->memberUser->last_name, $val->name), getLabels('member_sent_request_to_join_group_group')) !!}</p>
												<p class="text-muted mb-0 text-small">{!! timeAgo($val->created_at) !!}</p>
											</a>
										</div>
									</div>
									<div class="custom-control mb-1 align-self-center pr-4">
										<a href="javascript:void(0);" onclick="joingroup(1, {!! $val->id !!});" class="btn btn-outline-primary btn-xs">{!! getLabels('approve') !!}</a>&nbsp;
										<a href="javascript:void(0);" onclick="joingroup(2, {!! $val->id !!});"  class="btn btn-outline-danger btn-xs">{!! getLabels('decline') !!}</a>
									</div>
								</div>
							
							@else
								<div class="card d-flex flex-row mb-3" id="grtp{!! $val->id !!}">
									<div class="card-body d-flex flex-row">
										<a href="javascript:void(0);">
											{!! showImage($val->icon, "img-thumbnail list-thumbnail xsmall border-0 rounded-circle", "","", $val->name, 'groups') !!}
										</a>
										<div class="pl-3">
										   <a href="javascript:void(0);">
												<p class="font-weight-medium mb-1">{!! str_replace(array('{GROUP}'), array($val->name), getLabels('you_are_invited_to_join_group')) !!}</p>
												<p class="text-muted mb-0 text-small">{!! timeAgo($val->created_at) !!}</p>
											</a>
										</div>
									</div>
									<div class="custom-control mb-1 align-self-center pr-4">
										<a href="javascript:void(0);" onclick="joingroup(1, {!! $val->id !!});" class="btn btn-outline-primary btn-xs">{!! getLabels('accept') !!}</a>&nbsp;
										<a href="javascript:void(0);" onclick="joingroup(2, {!! $val->id !!});"  class="btn btn-outline-danger btn-xs">{!! getLabels('reject') !!}</a>
									</div>
								</div>
							@endif
							
						@endforeach
					@else
						<div class="card d-flex flex-row mb-3">
							<div class="card-body d-flex flex-row">
								<p class="font-weight-medium mb-1">{!! getLabels('no_requests_yet') !!}. </p>
							</div>
						</div>
					@endif

                    <nav class="mt-4 mb-3">
                        <div class="row">
							<div class="col-12">
								{!! $data->links('frontend.pagination_custom') !!}
							</div>
						</div>
                    </nav>
                </div>
            </div>
        </div>
    </main>
@stop