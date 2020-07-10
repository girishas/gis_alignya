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
                            {!! Form::open(array('url' => array($route_prefix.'/my-subscriptions'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')) !!}
								<div class="form-body">
									<div class="input-group">
										{!! Form::text('keyword', isset($_POST['keyword'])?trim($_POST['keyword']):null, array('class' => 'form-control',  'placeholder'=> getLabels('keyword')))!!}
										<div class="input-group-append">
											<button class="btn btn-outline-secondary" type="submit">{!! getLabels('Search') !!}</button>
											<a class="btn btn-outline-secondary  steamerst_link" href="{!! url($route_prefix, 'my-subscriptions') !!}">{!! getLabels('clear_search') !!}</a>
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
											<th> {!! SortableTrait::link_to_sorting_action('transaction_id', getLabels('transaction_id')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('plan_name', getLabels('plan_name')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('level', getLabels('level')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('first_name', getLabels('channel_owner')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('created_at', getLabels('renew')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('status', getLabels('status')) !!} </th>
											<th> Action </th>
										</tr>
									</thead>
									<tbody>
										@if(!$data->isEmpty())
											@foreach($data as $val) 
												<tr class="odd gradeX">
													<td>{!! $val->transaction_id !!}</td>
													<td>{!! $val->plan_name !!} <br /> ${!! $val->amount !!} / {!! getLabels('month') !!}</td>
													<td>{!! config('constants.LEVELS.'.$val->level)  !!}</td>
													<td>{!! $val->first_name." ".$val->last_name !!}</td>
													<td>{!! date("d M Y", strtotime("+1 month", strtotime($val->created_at))) !!}</td>
													<td>
														@if($val->status==1)
															{!! getLabels('subscribed') !!}
														@elseif($val->status==0)
															{!! getLabels('unsubscribed') !!}
														@endif
													</td>
													<td>
														@if($val->status==1)
															<a href="javascript:void(0);"  onClick="cancelAppPayment({!! $val->id !!}, 'unsubscribes', {!! $val->plan_id !!}, '{!! $val->uniq_username !!}')" class="btn btn-outline-primary">{!! getLabels('unsubscribe') !!}</a>
														@else
															<p>NA</p>
														@endif
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
	
	<script type="text/javascript">
		var token = "{!! csrf_token() !!}";
		var url="";
		var redirectUrl="{!! url('my-subscriptions') !!}";
		var id = "";
		var data = "";
		var text_ask ="";
		var prefix  = "";
		var ptype = "";
		function cancelAppPayment(sub_id, type, planId, username){
			ptype = type;
			prefix = username;
			token = "{!! csrf_token() !!}";
			if(type == 'unsubscribes'){
				id = sub_id;
				url = SITE_URL_BASE+prefix+"/unsubscribe/"+id;		
				text_ask = "{!!getLabels('unsubscribe_message')!!}";			
				data = {_token:token};			
			}
			showConfirmationModalsubscription("{!! getLabels('confirm') !!}", text_ask);
		}
		
		
		function showConfirmationModalsubscription(title, message){
			$('#modalTitleSub').html(title);
			$('#modalBodySub').html(message);
			$('#showConfirmationModalsubscription').modal('show');
		}
		
		$("body").on('click', "#confirmURLSub", function(e) {
			$('#showConfirmationModalsubscription').modal('hide');
			$.ajax({
				method:"POST",
				url:url,
				data:data,
				success:function(response){						
					if(response){
						pageUrl = redirectUrl;
						$.cergis.loadContent();
						e.preventDefault();
						if(ptype == 'unsubscribes'){
							showNotificationApp('top', 'right', 'primary', "{!! getLabels('success') !!}!", "{!! getLabels('current_plan_unsubscribed') !!}");
						}
					}										
				},
				error:function(){
					showNotificationApp('top', 'right', 'danger', "{!! getLabels('error') !!}!", "{!! getLabels('something_went_wrong') !!}");
				}
			});	
		});
		
	</script>
@stop