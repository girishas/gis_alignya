@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
<style>
#chartdiv {
  width: 100%;
  height: 250px;
}

</style>
<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

@include('Element/objective/view_objective')
@include('Element/objective/add_objective')
@include('Element/objective/scorecards')
@include('Element/objective/add_scorecard')
@include('Element/objective/themes')
@include('Element/objective/add_theme')
@include('Element/objective/add_cycle')
@include('Element/objective/update_objective')
@include('Element/measure/view_measure')
@include('Element/measure/add_measure')       
@include('frontend/objectives/filter')
@include('Element/initiative/add_initiative')
@include('Element/initiative/view_initiative') 
@include('Element/measure/update_task')
@include('Element/measure/update_milestone')
@include('Element/measure/update_measure')
@include('Element/initiative/update_initiative')
@include('Element/measure/add_milestone')
@include('Element/initiative/add_milestone')
@include('Element/initiative/update_milestone')
@include('Element/measure/task')

  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Strategic Map</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Analytics</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Strategic Map</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
             
            <div class="row mb-4">
                <div class="col-lg-12 col-md-12 mb-4">
				{!! Form::open(array('url' => array('/strategic-map'), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
                
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Filters</h5>
                        <div class="row">
                        <div class="col-md-2">
                            <label>Goal Cycle</label>
                            {!! Form::select('cycle_id', array(0=>'Select Goal Cycle')+$al_goal_cycles, isset($_POST['cycle_id'])?$_POST['cycle_id']:null, array('class' => 'form-control select2-single'))!!}
							<!--<select class="form-control select2-single" data-width="100%">
                                <option >5 Year Strategy</option>
                                <option >3 Year Strategy</option>
                                <option >FY-2020</option>
                            </select>-->
                        </div>
                        <div class="col-md-2">
                            <label>Department</label>
                            {!! Form::select('department_id', array(0=>'Select Department')+$all_department, isset($_POST['department_id'])?$_POST['department_id']:null, array('class' => 'form-control select2-single'))!!}
							
                        </div>
                        <div class="col-md-2">
                            <label>Owner</label>
                            {!! Form::select('owner_id', array(0=>'Select Owner')+$all_users, isset($_POST['owner_id'])?$_POST['owner_id']:null, array('class' => 'form-control select2-single'))!!}
							
                        </div>
                        <div class="col-md-2">
                            <label>Perspective</label>
                             {!! Form::select('perspective_id', array(0=>'Select Perspective')+$all_perspective, isset($_POST['perspective_id'])?$_POST['perspective_id']:null, array('class' => 'form-control select2-single'))!!}
							
                        </div>
						
						<div class="col-md-2">
                            <label>Strategic Theme</label>
                             {!! Form::select('theme_id', array(0=>'Select Theme')+$al_themes, isset($_POST['theme_id'])?$_POST['theme_id']:null, array('class' => 'form-control select2-single'))!!}
							
                        </div>
						<div class="col-md-2">
                         
                   <button type="submit" style="width:100%;" class="btn btn-primary">Search</button>
                <a class="btn btn-dark mb-1 steamerst_link" style="width:100%;" href="{!!url('strategic-map')!!}">Show All</a>

							
                        </div>
                    </div>
                    </div>
                </div>
				 {!!Form::close()!!}
				 
                    <div class="card">
                        <div class="card-body">
                                
								 @if(!empty($strategic_data))
                                    @foreach($strategic_data as $skey => $svalue)
										@foreach($svalue as $key => $value)
												@if($key == '0')
												<div class="col-lg-12" style="height: 200px;" >
                            					<h6><b>{!!$value->perspective_name!!}</b></h6>
												<br>
												<div class="row" style="justify-content: center;">
												@endif
												
													<div class="col-lg-2">
                                                        <a href="javascript:void(0);" onclick="viewobjective('{!!$value->id!!}')"><div style="border-radius: 50%;background: {!!$value->bg_color!!};height: 100px;text-align: center;padding-top: 35px;"><b>@if(strlen($value->heading)>40)
                                                    {!!substr($value->heading,0,40)!!}...
                                                    @else
                                                    {!!$value->heading!!}
                                                    @endif</b></div>
                                                 </a> </div>
                                                   
												@if(count($svalue)-1 == $key)
												</div>	
												</div>	
												@endif
										@endforeach
										
									@endforeach
								@endif			
							
                        </div>
                    </div>
                </div>

            
            
            </div>
        </div>

    </main>
    @include('Element/js/includejs')
@stop