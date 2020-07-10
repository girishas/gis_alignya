@extends('frontend/layouts/default')

@section('content')
	<style>
		.stripe-button{background:transparent;border:0;}
	</style>
  <main>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h1>{!! $page_title !!} </h1>
				<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
					<ol class="breadcrumb pt-0">
						<li class="breadcrumb-item">
							<a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
						</li>
						  <li class="breadcrumb-item">
							<a class="steamerst_link" href="{!! url($username.'/subscriptions') !!}">{!! getLabels('Subscriptions') !!}</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{!! $page_title !!}</li>
					</ol>
				</nav>
				<div class="separator mb-5"></div>
			</div>
		</div>
			
			
		<div class="card mb-4">
			<div class="card-body">
				
				{!! Form::open(array('url' => array($username.'/payout-subscription'), 'class' =>' needs-validation tooltip-right-bottom post_forms', 'name'=>'Search')) !!}
					<div class="form-group has-top-label position-relative error-l-50">
						{!! Form::text('email', !empty($userDetails['payer_email'])?$userDetails['payer_email']:NULL, array("class" => "form-control emailClass")) !!}  	
						<div class="invalid-tooltip"></div>
						<span>{!! getLabels('email') !!}</span>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group has-top-label">
								{!! Form::text('first_name', !empty($userDetails['first_name'])?$userDetails['first_name']:NULL, array('class' => 'form-control firstNameClass')) !!}	
								<span>{!! getLabels('first_name') !!}</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group has-top-label">
								{!! Form::text('last_name', !empty($userDetails['last_name'])?$userDetails['last_name']:NULL, array("class" => "form-control emailClass")) !!}  	
								<span>{!! getLabels('last_name') !!}</span>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group has-top-label">
								{!! Form::text('street', !empty($userDetails['address_street'])?$userDetails['address_street']:NULL, array("class" => "form-control streetClass")) !!}  	
								<span>{!! getLabels('street') !!}</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group has-top-label">
								{!! Form::text('city', !empty($userDetails['address_city'])?$userDetails['address_city']:NULL, array("class" => "form-control cityClass")) !!}  	
								<span>{!! getLabels('city') !!}</span>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-4">
							<div class="form-group has-top-label">
								{!! Form::text('state', !empty($userDetails['address_state'])?$userDetails['address_state']:NULL, array('class' => 'form-control stateClass')) !!}
								<span>{!! getLabels('state') !!}</span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group has-top-label">
								{!! Form::text('zipcode', !empty($userDetails['address_zip'])?$userDetails['address_zip']:NULL, array('class' => 'form-control zipcodeClass')) !!}	
								<span>{!! getLabels('zipcode') !!}</span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group has-top-label">
								{!! Form::select('country_code',array(""=>getLabels('select_country'))+getCountries(), !empty($userDetails['address_country_code'])?$userDetails['address_country_code']:NULL, array('class' => 'selectClass1 form-control countryClass')) !!}
								<span>{!! getLabels('country') !!}</span>
							</div>
						</div>
					</div>
					
	
					<div class="form-group">
						<h2><span class="badge badge-pill badge-outline-dark mb-1">{!! getLabels('subscription_amount') !!} : ${!! $amount !!} / {!! getLabels('month') !!}</span></h2>
					</div>
				
				
				
				
				<?php  
					$level_id = $level;
					
					$planPricefromPlanID   = planPricefromPlanID($plan_id,$amount,$level_id);
					
					$stripe_plan_id = !empty($planPricefromPlanID->plan_id)?$planPricefromPlanID->plan_id:""; 
					$plan_name = !empty($planPricefromPlanID->plan_name)?$planPricefromPlanID->plan_name:""; 
					$price = !empty($planPricefromPlanID->price)?$planPricefromPlanID->price:0; ?>
					<input name="plan" type="hidden" value="<?php echo $stripe_plan_id; ?>" />
					<input name="subscription_plan_id" type="hidden" value="<?php echo $plan_id; ?>" />
					<input name="plan_name" type="hidden" value="<?php echo $plan_name; ?>" />
					<input name="plan_price" type="hidden" value="<?php echo $price; ?>" />
					<input type="hidden" name="page_creater_id" value="<?php echo $user_id; ?>">
					<input type="hidden" name="level" value="{!! $level_id !!}">
					<div class="pricing-list">											
						<div class="pricing-footer ">
							<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
							data-key="{!! env('STRIPE_KEY') !!}"
							data-image=""
							data-email="<?php echo Auth::User()->email; ?>"
							data-name="<?php echo Auth::User()->first_name.' '.Auth::User()->last_name; ?>"
							data-description="<?php echo $plan_name; ?>"
							data-panel-label="Pay $<?php echo $price; ?>"
							data-label="Pay $<?php echo $price; ?>"
							data-locale="auto">
							</script>
						</div>
					</div>
				{!! Form::close() !!}	
				
			<div class="form-group text-right">
					<?php
					$paypal_url = 'http://www.sandbox.paypal.com/cgi-bin/webscr';
					$merchant_email = 'gaurav2212016-facilitator@outlook.com'; 
					$cancelURL = url($username.'/payment-subscribe');
					$item_name = $level_id;
					$successURL = url($username.'/payment-subscribe/success');
					$notifyURL     = url('payment-subscribe/paypal_ipn');
					$total_cycle = 12;
					$product_name = $plan_name;
					$product_currency = 'USD';
					$price_id = session('amount');
					$cycle = 'M'; ?>
							
					{!! Form::open(array('url' => url($paypal_url),'class'=>'post_forms', 'name'=>'paypalbuttonForm')) !!}
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<input type="hidden" name="business" value='<?php echo $merchant_email; ?>'>
								<input type="hidden" name="cmd" value="_xclick-subscriptions">
								<input type="hidden" name="transaction_id" value="789654123">
								<input type="hidden" name="item_name" value="<?php echo $item_name; ?>">
								<input type="hidden" name="item_number" value="Subscription">
								<input type="hidden" name="a3" value='<?php echo $price; ?>'>
								<input type="hidden" name="p3" value="1">
								<input type="hidden" name="t3" value='<?php echo $cycle; ?>'>
								<input type="hidden" name="src" value="1">
								<input type="hidden" name="custom" value="<?php echo $user_id; ?>">
								<input type="hidden" name="cancel_return" value="<?php echo $cancelURL; ?>">
								<input type="hidden" name="return" value="<?php echo $successURL; ?>">
								<input type="hidden" name="notify_url" value="<?php echo $notifyURL; ?>">				
								
								
								<!--<input type="image" name="submit"
								src="http://www.paypalobjects.com/en_US/i/btn/btn_subscribe_LG.gif"
								alt="Subscribe" style="width:unset">
								<img alt="" width="1" height="1"
								src="http://www.paypalobjects.com/en_US/i/scr/pixel.gif" >-->
							</div>
						
						
						</div>
					{!! Form::close() !!} 
					<button type="button" name="submit"  class="btn btn-lg btn-primary checkval">{!! getLabels('pay_by_paypal') !!}</button>
				</div>
			</div>
		</div>
    </div>

</main>
<script type="text/javascript">
	function popupOpen(){
		jQuery('.alert-danger').hide();
		jQuery('.alert-danger').html('');
		var token = "{!! csrf_token() !!}";
		var email = $(".emailClass").val();
		var firstName = $(".firstNameClass").val();
		var street = $(".streetClass").val();
		var city = $(".cityClass").val();
		var state = $(".stateClass").val();
		var zipcode = $(".zipcodeClass").val();
		var country = $(".countryClass").val();
		
			$.ajax({
				type:"POST",
				url:site_url +"/billing-validation-check",
				data : '_token='+token+'&email='+email+"&firstName="+firstName+"&street="+street+"&city="+city+"&state="+state+"&zipcode="+zipcode+"&country="+country,
				datatype : "html",
				success:function(response){	
					if(response=='success'){
						$("#paypal_popup").modal('show');
						$(".getEmailClass").html(email);
					}else{
					jQuery.each(JSON.parse(response), function(key, value){
						jQuery('.alert-danger').show();
						jQuery('.alert-danger').append('<p>'+value+'</p>');
					});
					}					
				}
			});		
		
	}
	
	jQuery("#check").click(function(){
		if ($('#check_id').is(":checked")){
			window.location=site_url+"/subscriptions";
			return true;
		}else{
			$(".error_message_show").text('Please accept terms & conditions');
			return false;
		}
	 });
	 
	
	
	jQuery(document).on('click','.checkval', function(){
		var email = $(".emailClass").val();
		var firstName = $(".firstNameClass").val();
		var street = $(".streetClass").val();
		var city = $(".cityClass").val();
		var state = $(".stateClass").val();
		var zipcode = $(".zipcodeClass").val();
		var country = $(".countryClass option:selected").val();
		if((email == "") || (firstName == "") || (street == "") || (city == "") || (state == "") || (zipcode == "") || (country == "")){
			$(".alert-danger").html("{!! getLabels('all_fields_mandatory') !!}");
			jQuery('.alert-danger').show();
		}else{
			$("form[name='paypalbuttonForm']").submit();
			
		}
	});
</script>
@stop