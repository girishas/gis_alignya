@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>
@section('content')
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! $page_title !!}</h1>
					<div class="text-zero top-right-button-container">
						@if(Auth::User()->is_complete_profile)
							<a href="{!! url($route_prefix.'/add-subscription-plan') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('create_new_plan') !!}</a>
						@else
							<a href="{!! url($route_prefix.'/'.Auth::User()->uniq_username.'/update-profile') !!}" onclick="showNotificationApp('top', 'right', 'danger', '<?php echo getLabels('error'); ?>!', '<?php echo getLabels('complete_profile_notification'); ?>');" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('create_new_plan') !!}</a>
						@endif
					</div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">{!! $page_title !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
            <div class="row mb-4">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead class="thead-light">
										<tr>
											<th> {!! getLabels('image') !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('level_id',  getLabels('level')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('price', getLabels('price')) !!} </th>
											<th> {!! getLabels('fees') !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('description', getLabels('Description')) !!} </th>
											<th> {!! getLabels('action') !!} </th>
										</tr>
									</thead>
									<tbody>
										@if(!$data->isEmpty())
											@foreach($data as $val) <?php
												$leveldata = getLevelFees($val->level_id); ?>
												<tr class="odd gradeX">
													<td style="max-width:100px;">
														@if ( !empty($val->image) and file_exists('public/upload/plans/'. $val->image) )
															{!! HTML::image('public/upload/plans/'. $val->image, $val->name, array('class' => 'list-thumbnail border-0')) !!}
														@endif
													</td>
													<td>{!! config('constants.LEVELS.'.$val->level_id)  !!}</td>
													<td>${!! $val->price !!}</td>
													<td>
														@if(!empty($leveldata->fees))
															{!! $leveldata->fees !!}% + {!! $leveldata->fixed_amount !!} cents
														@endif
													</td>
													<td>{!! html_entity_decode($val->description) !!}</td>		
													<td><a class="steamerst_link btn btn-outline-primary btn-xs" href="{!! url($route_prefix.'/add-subscription-plan/'.$val->id) !!}">Edit</a></td>
												</tr>
											@endforeach
										@else
											<tr class="odd gradeX">
												<td colspan="6" class="no_record">{!! getLabels('records_not_found') !!}</td>
											</tr>
										@endif
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
    </main>
@stop