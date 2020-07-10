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
										<th> {!! SortableTrait::link_to_sorting_action('first_name', getLabels('receiver_name')) !!} </th>
										<th> {!! SortableTrait::link_to_sorting_action('payout_email', getLabels('receiver_email')) !!} </th>
										<th> {!! SortableTrait::link_to_sorting_action('total_amount_paid', getLabels('amount')) !!} </th>
										<th> {!! SortableTrait::link_to_sorting_action('payment_status', getLabels('payout_status')) !!} </th>
										<th> {!! getLabels('action') !!} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$data->isEmpty())
										@foreach($data as $val)
											<tr class="odd gradeX">
												<td>{!! $val->first_name." ".$val->last_name !!}</td>
												<td><a href="mailto:{!! $val->payout_email !!}">{!! $val->payout_email !!}</a></td>
												<td>${!! number_format($val->total_amount_paid, 2) !!}</td>
												<td>{!! $val->payment_status !!}
												<td>
													<a href="{!!url($route_prefix.'/payout-history-detail/'.$val->id)!!}" class="btn btn-outline-primary steamerst_link">{!! getLabels('view') !!} </a>
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