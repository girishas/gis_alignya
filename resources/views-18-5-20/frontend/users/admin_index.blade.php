@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Users') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix.'/users/new') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('add_new') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Users') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			<div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4">{!! getLabels('Search') !!}</h5>
                            {!! Form::open(array('url' => array($route_prefix.'/users'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')) !!}
								<div class="form-body">
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												{!! Form::text('first_name', isset($_POST['first_name'])?trim($_POST['first_name']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_name')))!!}
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												{!! Form::text('email', isset($_POST['email'])?trim($_POST['email']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_email')))!!}
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												{!! Form::select('status', array('' => getLabels('all_status')) + config('constants.STATUS'), isset($_POST['status'])?$_POST['status']:null, array('class' => 'form-control'))!!}
											</div>
										</div>
										
										<div class="col-lg-3">               
											<button class="btn btn-primary mb-1" type="submit">{!! getLabels('Search') !!}</button>
											<a class="btn btn-dark mb-1 steamerst_link" href="{!! url($route_prefix, 'users') !!}">{!! getLabels('show_all') !!}</a>
										</div>
									</div>
								</div>
							{!!Form::close()!!}
                        </div>
                    </div>
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
										   <th> {!! SortableTrait::link_to_sorting_action('first_name',  getLabels('name')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('email',  getLabels('email')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('mobile', getLabels('contact_number')) !!} </th>
											<th class="text-center"> {!! SortableTrait::link_to_sorting_action('status', getLabels('status')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('created_at', getLabels('joined_on')) !!} </th>
											<th> {!! getLabels('action') !!} </th>
										</tr>
									</thead>
									<tbody>
										@if(!$data->isEmpty())
											@foreach($data as $val)
												<tr class="odd gradeX">
													<td>{!! $val->first_name." ".$val->last_name !!}</td>
													<td>
														<a href="mailto:{!! $val->email !!}"> {!! $val->email !!} </a>
													</td>
													<td>{!! $val->mobile !!}</td>
													<td class="text-center">
														@if($val->status == 1)
															<a class="steamerst_status" href="{!! url($route_prefix.'/users/status/'.$val->role_id.'/'.$val->id) !!}" title="{!! getLabels('decline') !!}"><span class="badge badge-pill badge-secondary "> {!! getLabels('approved') !!} </span></a>
														@else
															<a class="steamerst_status" href="{!! url($route_prefix.'/users/status/'.$val->role_id.'/'.$val->id) !!}" title="{!! getLabels('approve') !!}"><span class="badge badge-pill badge-danger "> {!! getLabels('declined') !!} </span></a>
														@endif
													</td>
													<td> <?php
														echo date('F d, Y', strtotime($val->created_at)); ?>
													</td>
													<td>
														<div class="btn-group float-none-xs">
															<button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																{!! getLabels('action') !!}
															</button>
															<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
																<a class="steamerst_link dropdown-item" href="{!! url($route_prefix.'/users/update/'.$val->id) !!}">{!! getLabels('edit') !!}</a>
																<a class="dropdown-item steamerst_link" href="{!! url($route_prefix.'/'.$val->uniq_username.'/profile') !!}">{!! getLabels('view') !!}</a>
																<a class="steamerst_link dropdown-item" href="{!! url($route_prefix.'/users-chnagepassword/'.$val->uniq_username) !!}">{!! getLabels('Change_Password') !!}</a>
															</div>
														</div>
													</td>
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
							<br />
							
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
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop