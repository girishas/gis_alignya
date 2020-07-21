@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Subscription_plans') !!}</h1>
                    
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Subscription_plans') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
            @if(session('message'))
			<div class="alert alert-success" role="alert" style="z-index: unset;">
				{!! session('message') !!}
			</div>
			@endif
			
            <div class="row mb-4">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">
							<div class="table-responsive">
								<table class="table">
									<thead class="thead-light">
										<tr>
										   <th> {!! getLabels('name') !!} </th>
											<th> {!! getLabels('emp_limit') !!} </th>
											<th> {!! getLabels('plan_fees') !!} </th>
											<th class="text-center"> {!! getLabels('period')!!} </th>
											<th class="text-center"> {!! getLabels('status')!!} </th>
											<th> {!! getLabels('action') !!} </th>
										</tr>
									</thead>
									<tbody>
										@if(!$data->isEmpty())
											@foreach($data as $val)
											
												<tr class="odd gradeX">
													<td>{!!$val->heading!!}</td>
													<td>{!!$val->emp_limit!!}
													</td>
													<td>{!!'$'.$val->plan_fee!!}</td>
													<td class="text-center">
														{!!config('constants.PLAN_PERIOD.'.$val->period)!!}
													</td>
													<td class="text-center"><span class="badge badge-pill badge-primary" style="background: #4dd0e1 !important">{!!config('constants.STATUS.'.$val->status)!!}</span></td>
													<td>
														<a href="{!!url($route_prefix.'/subscription-plan/update/'.$val->id)!!}"><i class="heading-icon simple-icon-pencil"></i></a>
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