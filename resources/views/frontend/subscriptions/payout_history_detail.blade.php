@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
	<style>
		.table tr td, .table tr th{padding-top:15px;padding-bottom:15px;}
	</style>
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
							
							<li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'payout-history') !!}">{!! getLabels('Payout_History') !!}</a>
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
										<th> {!! getLabels('Name') !!} </th>
										<th class="text-center"> {!! getLabels('Subscription_Level') !!} </th>
										<th class="text-center"> {!! getLabels('subscription_amount') !!} </th>
										<th class="text-center"> {!! getLabels('subscription_commission') !!} </th>
										<th class="text-center"> {!! getLabels('commission_amount') !!} </th>
										<th class="text-center"> {!! getLabels('payout_amount') !!} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$data->isEmpty())
										<?php $sum_amount =0;
										$sum_com_per_amount=0; ?>
										@foreach($data as $val) <?php
											$com_percent = isset($level_commission[$val->level])?($level_commission[$val->level]['fees']/100):0;
											$com_percent_exact = isset($level_commission[$val->level])?($level_commission[$val->level]['fees']):0;
											
											$com_fixed = isset($level_commission[$val->level])?($level_commission[$val->level]['fixed_amount']/100):0;
											$com_fixed = number_format((float)$com_fixed, 2, '.', '');
											
											$admin_percent = isset($level_commission[$val->level])?($level_commission[$val->level]['admin_commission']/100):0;
											$admin_percent_exact = isset($level_commission[$val->level])?($level_commission[$val->level]['admin_commission']):0;
											
											$com_percent_amount = $val->amount * $com_percent;
											$admin_percent_amount = $val->amount * $admin_percent;
											
											$sum_com_per_amount += $com_percent_amount + $com_percent_amount + $com_fixed;
											$sum_amount += $sum_amount_show = $val->amount - ($com_percent_amount + $com_percent_amount + $com_fixed); ?>
											
											<tr class="odd gradeX">
												<td>{!! $val->profile_id !!}</td>			
												<td>{!! $val->first_name.' '.$val->last_name !!}</td>
												<td class="text-center">{!! $val->level !!}</td>			
												<td class="text-center">${!! $val->amount !!}</td>			
												<td class="text-center">{!! $com_percent_exact.'% + '.$com_fixed.' cents + '.$admin_percent_exact.'%' !!}</td>			
												<td class="text-center">{!! '$'.$com_percent_amount.' + '.$com_fixed.' cents + $'.$admin_percent_amount !!}</td>			
												<td class="text-center">${!!  number_format((float)$sum_amount_show, 2, '.', '') !!}</td>	
											</tr>
										@endforeach
										<tr class="odd gradeX"><td colspan="7" style="border:0px;"></td></tr>
										<tr class="odd gradeX"><td colspan="7" style="border:0px;"></td></tr>
										<tr class="odd gradeX">
											<td colspan="6" class="text-right text-primary"><h5><strong>{!! getLabels('total') !!}</strong></h5></td>
											<td class="text-right text-primary"><h5> <strong>${!! number_format((float)$sum_amount, 2, '.', '') !!} </strong></h5></td>
										</tr>
									@else
										<tr class="odd gradeX">
											<td colspan="7" class="no_record">{!! getLabels('records_not_found') !!}</td>
										</tr>
									@endif
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
	
@stop