@extends('frontend/layouts/default')

@section('content')
	<style>
		.price-feature-list p{margin-bottom:5px;}
	</style>
	@if(Auth::check())
		<main>
	@else
		<div class="mt-5 mb-5" style="margin-top:6rem !important;">
	@endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1>{!! $page_title !!}</h1>
                    </div>
                    <div class="tab-content mb-5">
                        <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                            <div class="row">
                                <div class="col-12 mb-5">
									{!! showImage($user->cover_photo, "social-header card-img", "","",$user->first_name, 'users/cover_photo') !!}
                                </div>
                                <div class="col-12 col-lg-5 col-xl-4 col-left">
                                    <a href="{!! url($route_prefix.'/profile/'.$user->uniq_username) !!}" class="steamerst_link">
										{!! showImage($user->photo, "img-thumbnail card-img social-profile-img", "","",$user->first_name, 'users/profile-photo') !!}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			@if(!Auth::check())
			<div class="row">
				<div class="offset-md-1 col-md-10">
				@endif
			<div class="row equal-height-container mt-5"><?php
				$i = 1; 
				//$plan_id = session()->get('plan_id');
				$page_creator_id = $user->id;
				
				$checkAlready = checkAlreadySubscribe($page_creator_id); ?>
				@if($data)
					@foreach($data as $val)
						<div class="col-md-12 col-lg-4 mb-4 col-item">
							<div class="card">
								<div
									class="card-body pt-5 pb-5 d-flex flex-lg-column flex-md-row flex-sm-row flex-column">
									<div class="price-top-part">
										@if($val['image'] and file_exists('public/upload/plans/'.$val['image']))
											{!! showImage($val['image'], "list-thumbnail border-0 mb-2", "", "", $val['name'], 'plans') !!}
										@else
											<i class="iconsminds-male large-icon"></i>
										@endif
										<h5 class="mb-0 font-weight-semibold color-theme-1 mb-4">{!! $val['name'] !!}</h5>
										<p class="text-large mb-2 text-default">${!! $val['price'] !!}</p>
										<p class="text-muted text-small">{!! getLabels('per_month') !!}</p>
									</div>
									<div class="pl-3 pr-3 pt-3 pb-0 d-flex price-feature-list flex-column flex-grow-1 text-center">
										{!! $val['description'] !!}
										<div class="text-center">
											@if(Auth::check())
												{!! Form::open(array('url' => url($username.'/payment-subscribe'),'class'=>'steamerstudio_form')) !!}
													<input type="hidden" name="level" id = "level_{!! $i !!}" value="{!! $val['level_id'] !!}">
													<input type="hidden" name="amount" id = "amount_{!!$i!!}" value="{!! $val['price'] !!}">
													<input type="hidden" name="user_id" value="{!! $user->id !!}">
													<input type="hidden" name="plan_id" value="{!! $val['id'] !!}">
													<?php $datat = isSubscribe($val['id'], $val['level_id'], $user->id); ?>
												
													@if(!empty($datat))
														<button type="button" class="pricingTable-signup btn btn-link btn-empty btn-lg text-uppercase" >{!! getLabels('subscribed') !!} <i class="simple-icon-check"></i></button><br>
														<a href="javascript::void(0);" class="btn btn-link btn-empty btn-lg text-uppercase" style="color:#dc3545;" onclick="unsubscribe({{$datat->id}},'unsubscribes', {!! $val['id'] !!})">{!! getLabels('unsubscribe') !!} <i class="simple-icon-arrow-right"></i></a>
													@else
														@if(!empty($checkAlready))
															<button type="button" class="pricingTable-signup btn btn-link btn-empty btn-lg text-uppercase" onclick="unsubscribe({!!$i!!},'new', {!! $val['id'] !!})">{!! getLabels('subscribe') !!} <i class="simple-icon-arrow-right"></i></button>
														@else
															<button type="submit" class="btn btn-link btn-empty btn-lg text-uppercase">{!! getLabels('subscribe') !!} <i class="simple-icon-arrow-right"></i></button>
														@endif
													@endif
												{!! Form::close() !!}
											@else
												<button type="button" class="btn btn-link btn-empty btn-lg text-uppercase" onclick="forceLoginModal();">{!! getLabels('subscribe') !!} <i class="simple-icon-arrow-right"></i></button>
											@endif
											
										</div>
									</div>
								</div>
							</div>
						</div><?php
						$i++; ?>
					@endforeach
				@endif
			</div>
			@if(!Auth::check())
			</div>
			</div>
			@endif
        </div>
    @if(Auth::check())
		</main>
	@else
		</div>
	@endif
	<script type="text/javascript">
		var token = "{!! csrf_token() !!}";
		var url="";
		var redirectUrl="";
		var id = "";
		var data = "";
		var text_ask ="";
		var prefix  = "{!! $username !!}";
		var ptype = "";
		function unsubscribe(sub_id, type, planId){
			ptype = type;
			token = "{!! csrf_token() !!}";
			if(type == 'unsubscribes'){
				id = sub_id;
				url = SITE_URL_BASE+prefix+"/unsubscribe/"+id;
				redirectUrl = "{!! url($username.'/subscriptions') !!}";			
				text_ask = "{!!getLabels('unsubscribe_message')!!}";			
				data = {_token:token};			
			}else if(type=='new'){
				var pageCreatorId = "{!!$page_creator_id!!}";
				url = SITE_URL_BASE+prefix+"/payment-subscribe";
				redirectUrl = "{!!url($username.'/payment-subscribe')!!}";
				text_ask = "{!!getLabels('newsubscribe_message')!!}";
				id = sub_id;		
				var amount = $("#amount_"+id).val();
				var level = $("#level_"+id).val();
				data = {_token:token,plan_id:planId,user_id:pageCreatorId,level:level,amount:amount,typesub:type};
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