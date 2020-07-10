@extends('frontend/layouts/default')

@section('content')
	<main>
        <div class="container-fluid disable-text-selection">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1>{!! getLabels('notifications') !!}</h1>
						 <div class="top-right-button-container">
                            <button type="button" class="btn btn-primary btn-lg top-right-button mr-1" onclick="markNotificationRead('all');">{!! getLabels('Mark_all_as_read') !!}</button>
                        </div>
                        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                            <ol class="breadcrumb pt-0">
                               <li class="breadcrumb-item">
									<a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
								</li>
                                <li class="breadcrumb-item active" aria-current="page">{!! getLabels('notifications') !!}</li>
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
							<div class="card d-flex flex-row mb-3">
								<div class="card-body d-flex flex-row">
									<a href="javascript:void(0);">
										{!! showImage($val->User->photo, "img-thumbnail list-thumbnail xsmall border-0 rounded-circle", "","", $val->User->first_name, 'users/profile-photo') !!}
									</a>
									<div class="pl-3">
									   <a href="javascript:void(0);">
											<p class="font-weight-medium mb-1">{!! $val->message !!}</p>
											<p class="text-muted mb-0 text-small">{!! timeAgo($val->created_at) !!}</p>
										</a>
									</div>
								</div>
							</div>
						@endforeach
					@else
						<div class="card d-flex flex-row mb-3">
							<div class="card-body d-flex flex-row">
								<p class="font-weight-medium mb-1">{!! getLabels('No_notifications_yet') !!}. </p>
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