@if(empty($_POST))
@extends('frontend/layouts/default')
@endif


@if(empty($_POST))
@section('content')

  <main>
  @endif
  
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Add Company') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'companies') !!}" class="steamerst_link btn btn-primary btn-sm top-right-button mr-1">{!! getLabels('Company') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'companies') !!}">{!! getLabels('Company') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Add Company') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
					{!! Form::open(array('url' => array($route_prefix.'/company/add'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
						
						<div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-12">
								<label for="inputFirstname">{!! getLabels('Company Name') !!}</label>
								{!! Form::text('company_name', null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputFirstname">{!! getLabels('First Name') !!}</label>
								{!! Form::text('first_name', null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputLastname">{!! getLabels('last_name') !!}</label>
								{!! Form::text('last_name', null, array('class' => 'form-control', 'id' => 'inputLastname',  'placeholder'=> ''))!!}
								{!!Form::hidden('user_id',null,array('class'=>'form-control'))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-40 col-md-6">
								<label for="inputEmail4">{!! getLabels('email') !!}</label>
								{!! Form::text('email', null, array('class' => 'form-control', "id"=>"inputEmail4", 'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
                                <label class="">{!! getLabels('password') !!}</label>
                                	{!! Form::password("password",array("class"=>"form-control")) !!}
									<div class="invalid-tooltip"></div>
                                    
								</div>
							
							
						</div>
						<label class="form-group has-float-label position-relative error-l-100 mb-4">Choose Pricing Plan</label>
								
										<div style="display: inline-flex;">
											<div class="custom-control custom-radio">
												
												<input type="radio" id="monthlyplan" name="plan_type" class="custom-control-input plan_type" value="1" checked="checked">
												<label class="custom-control-label" for="monthlyplan">
													Monthly &nbsp;&nbsp;&nbsp;
												</label>
											</div>
											<div class="custom-control custom-radio">
												<input type="radio" id="yearlyplan" name="plan_type" class="custom-control-input plan_type" value="2">
												<label class="custom-control-label" for="yearlyplan">Yerly</label>
											</div>
										</div>
						<div class="form-group">

						<div class="monthlyshow">
											@if(!empty($plans))
											@foreach($plans as $key => $plan)
											<div class="custom-control custom-radio">
												
												<input type="radio" id="jQueryCustomRadio{!!$key!!}" name="plan_id" class="custom-control-input" value="{!!$plan->id!!}">
												
												<label class="custom-control-label" for="jQueryCustomRadio{!!$key!!}">
													{!!$plan->heading!!} ( ${!!$plan->plan_fee!!} per month | Upto {!!$plan->emp_limit!!} Member )
												</label>
											</div>
											@endforeach
										</div>
										<div class= "yearlyshow" style="display: none;">
											@endif
											@if(!empty($yearly))
											@foreach($yearly as $key => $yp)
											<div class="custom-control custom-radio">
												
												<input type="radio" id="yearly{!!$key!!}" name="plan_id" class="custom-control-input" value="{!!$yp->id!!}">
												<label class="custom-control-label" for="yearly{!!$key!!}">
													{!!$yp->heading!!} ( ${!!$yp->plan_fee!!} per month | Upto {!!$yp->emp_limit!!} Member )
												</label>
											</div>
											@endforeach
											@endif
										</div>
										<div class="invalid-tooltip"></div>	
							
						</div>
						
						
						<div class="form-group ">
						<button type="submit" class="btn btn-primary">{!! getLabels('submit') !!}</button>&nbsp;&nbsp;
						<a href="{!! url($route_prefix, 'companies') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
        </div>
	<script>
	$('.plan_type').click(function(){
			if($(this).val() == 2){
				$(".monthlyshow").hide();
				$(".yearlyshow").show();
			}else{
				$(".monthlyshow").show();
				$(".yearlyshow").hide();
			}
		});
</script>	
	@if(empty($_POST))
    </main>
@stop
@endif
