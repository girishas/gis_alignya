@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! $page_title !!}</h1>
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

                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
										<th> {!! getLabels('id') !!} </th>
										<th> {!! getLabels('profile_id') !!} </th>
										<th> {!! getLabels('price') !!} </th>
										<th> {!! str_singular(getLabels('Subscription_Plans')) !!} </th>
										<th> {!! getLabels('status') !!} </th>
										<th> {!! getLabels('subscriber_name') !!} </th>
										<?php /* <th> Invoice </th> */ ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$data->isEmpty())
										@foreach($data as $val)
											<tr class="odd gradeX"><?php 
												$plan = getPlanDetailsByID($val->id); ?>
												<td>{!! $val->subscription_id !!}</td>
												<td>{!! $val->profile_id !!}</td>								
												<td>${!! $val->amount !!}</td>
												<td>{!! $plan->name !!} <br /> {!! number_format($plan->price, 2) !!}/month</td>
												<td>{!! $val->profile_status !!}</td>
												<td><?php
													$user = getUserDetail($val->subscriber_user_id); ?>
													@if(!empty($user->first_name))
														{!! $user->first_name." ".$user->last_name !!}
													@endif
												</td>
												<?php /* <td><button class="btn btn-primary invoiceLayer" rel="{!! $val->profile_id !!}"><i class="simple-icon-eye"></i></button></td>	*/ ?>
											</tr>
										@endforeach
									@else
									<tr class="odd gradeX">
										<td colspan="6" class="no_record">{!! getLabels('records_not_found') !!}</td>
									</tr>
								@endif
                                </tbody>
                            </table>
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