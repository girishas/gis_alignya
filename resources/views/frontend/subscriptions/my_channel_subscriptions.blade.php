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
			
			<div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4">{!! getLabels('Search') !!}</h5>
                            {!! Form::open(array('url' => array($route_prefix.'/my-channel-subscriptions'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')) !!}
								<div class="form-body">
									<div class="input-group">
										{!! Form::text('keyword', isset($_POST['keyword'])?trim($_POST['keyword']):null, array('class' => 'form-control',  'placeholder'=> getLabels('keyword')))!!}
										<div class="input-group-append">
											<button class="btn btn-outline-secondary" type="submit">{!! getLabels('Search') !!}</button>
											<a class="btn btn-outline-secondary  steamerst_link" href="{!! url($route_prefix, 'my-channel-subscriptions') !!}">{!! getLabels('clear_search') !!}</a>
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
											<th> {!! SortableTrait::link_to_sorting_action('plan_name', getLabels('plan_name')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('subscriber_first_name', getLabels('subscriber_name')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('level', getLabels('Subscription_Level')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('amount', getLabels('price')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('created_at', getLabels('subscribed_at')) !!} </th>
										</tr>
									</thead>
									<tbody>
										@if(!$data->isEmpty())
											@foreach($data as $val) 
												<tr class="odd gradeX">
													<td>{!! $val->plan_name !!}</td>
													<td>{!! $val->subscriber_first_name." ".$val->subscriber_last_name !!}</td>
													<td>{!! config('constants.LEVELS.'.$val->level)  !!}</td>
													<td>${!! $val->amount !!} / {!! getLabels('month') !!}</td>
													<td>{!! date('d M Y',strtotime($val->created_at)) !!}</td>
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