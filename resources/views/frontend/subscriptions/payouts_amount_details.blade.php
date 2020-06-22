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
                                <a class="steamerst_link" href="{!! url($route_prefix, 'payouts') !!}">{!! getLabels('Payouts') !!}</a>
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
                                    @if(!$payouts->isEmpty())
										<?php $sum_amount =0;
										$sum_com_per_amount=0; ?>
										@foreach($payouts as $val) <?php
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
										@if($sum_amount > $setting_array['payout_minimum'])
											@if($sum_amount > 0 ) 
												<tr class="event-item">						
													<td colspan="7" class="text-right"><button class='btn btn-outline-primary btn-lg' id="paymentDone">{!! getLabel('pay') !!}</button></td>
												</tr>
											@endif
										@else
											<tr class="event-item">						
												<td colspan="7" class="text-right"><strong>{!! getLabel('payout_minimum') .' : $'.$setting_array['payout_minimum'] !!}</strong></td>
											</tr>
										@endif
									@else
										<tr class="odd gradeX">
											<td colspan="7" class="no_record">{!! getLabels('records_not_found') !!}</td>
										</tr>
									@endif
                                </tbody>
								
                            </table> 
							
							<div class="modal fade modal-right" id="createPaymentModal" tabindex="-1" role="dialog" aria-labelledby="createPaymentModal" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">{!! getLabels('pay') !!} : ${!! number_format($sum_amount, 2) !!}</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										{!! Form::open(array('url' => array($route_prefix.'/payouttoowner/'.$username), 'class' =>'steamerstudio_payform needs-validation tooltip-label-right', 'name'=>'Search')) !!}
											<div class="modal-body">
												{!! Form::hidden("user_id", $username) !!}
												{!! Form::hidden("total_amount_paid", $sum_amount) !!}
												{!! Form::hidden("total_commission", $sum_com_per_amount) !!}
												<div class="form-group  position-relative error-l-50">
													<label>{!! getLabels('transaction_id') !!}</label>
													{!! Form::textarea("transaction_id", null, array("rows" => 2, "class"=>"form-control")) !!}
													<div class="invalid-tooltip"></div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-outline-primary" data-dismiss="modal">{!! getLabels('Cancel') !!}</button>
												<button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>
											</div>
										{!! Form::close() !!}
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
	<script type="text/javascript">
		$("body").on('click', "#paymentDone", function(e) {
			$('#createPaymentModal').modal({backdrop:'static', keyboard: false}, 'show');
		});
		
		$("body").on('submit', ".steamerstudio_payform", function(e) {
			e.preventDefault();
			var form_action = $(this).attr('action');
			data = $(this).serialize();
			$.ajax({
				type:"POST",
				url: form_action,
				data:data,
				success: function (response) {
					if(response.type == 'error'){
						errors = response.error;
						$.each(errors, function(key,value) {
							$('input[name="'+key+'"]').next('div.invalid-tooltip').css('display', 'block');
							$('input[name="'+key+'"]').next('div.invalid-tooltip').html(value[0]);
							
						});
						showNotificationApp('top', 'left', 'danger', "{!! getLabels('error') !!}", response.message);
					}else if(response.type == 'success'){
						$('#createPaymentModal').modal('hide');
						showNotificationApp('top', 'right', 'primary', "{!! getLabels('success') !!}", response.message);
						
						pageUrl =  response.url;
						$.cergis.loadContent();
						e.preventDefault();
					}
				},
				 error: function(xhr, ajaxOptions, thrownError) {
					showNotificationApp('top', 'left', 'danger', "{!! getLabels('error') !!}", "{!! getLabels('something_went_wrong') !!}");
				}
			});
		});
	</script>
@stop