@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('people_search_results') !!}</h1>
                </div>
            </div>
			
			<div class="row mb-4">
				@if(!$data->isEmpty())
					@foreach($data as $val)
						<div class="col-md-6 col-sm-6 col-lg-6 col-12 mb-4">
							<div class="card d-flex flex-row">
								<a class="d-flex steamerst_link" href="{!! url($route_prefix.'/'.$val->uniq_username) !!}">
									{!! showImage($val->photo, "img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center", "","", $val->first_name, 'users/profile-photo') !!}
                                </a>
								
								<div class=" d-flex flex-grow-1 min-width-zero">
                                    <div class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                        <div class="min-width-zero">
											<a href="{!! url($route_prefix.'/'.$val->uniq_username) !!}" class="steamerst_link">
                                                <p class="list-item-heading mb-1 truncate">{!! ucwords($val->first_name." ".$val->last_name) !!}</p>
                                            </a>
                                            <p class="mb-2 text-muted text-small">{!! $val->city !!}{!! $val->state?", ".$val->state:"" !!}{!! $val->country?", ".$val->country:"" !!}</p>
                                           <div id="followbtnouter{!! $val->uniq_username !!}">
											   @if(in_array($val->id, $following))
													<div class="dropdown d-inline-block">
														<button class="btn btn-xs btn-outline-primary dropdown-toggle mb-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															{!! getLabels('following') !!}
														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
															<a class="dropdown-item unfollow_user" rel="{!! $val->uniq_username !!}" href="javascript:void(0);">{!! getLabels('unfollow') !!}</a>
														</div>
													</div>
												@elseif(in_array($val->id, $follower))
													<div class="dropdown d-inline-block">
														<button class="btn btn-xs btn-outline-primary dropdown-toggle mb-1" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															{!! str_singular(getLabels('followers')) !!}
														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
															<a class="dropdown-item unfollow_user" rel="{!! $val->uniq_username !!}" href="javascript:void(0);">{!! getLabels('unfollow') !!}</a>
														</div>
													</div>
												@else
													<button type="button" class="btn btn-xs btn-outline-primary follow_btn" rel="{!! $val->uniq_username !!}">{!! getLabels('follow') !!}</button>
												@endif
											</div>
										</div>
                                    </div>
                                </div>
							</div>
						</div>
					@endforeach
				@else
					<div class="col-12 mb-4">
						<div class="card ">
							<div class="card-body">
								<div class="text-center">
									{!! getLabels('records_not_found') !!}
								</div>
							</div>
						</div>
					</div>
				@endif
			</div>
			
            <div class="row">
				<div class="col-12 text-center">
					<p class="justify-content-center ">{!! str_replace(array('{FIRST}', '{LAST}', '{TOTAL}'), array($data->firstItem(), $data->lastItem(), $data->total()), getLabels('showing_first_to_last_of_total_records')) !!}</p>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					{!! $data->links('frontend.pagination_custom') !!}
				</div>
			</div>
        </div>
    </main>
@stop