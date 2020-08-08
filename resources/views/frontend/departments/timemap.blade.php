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
                    <h1>Time Map</h1>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Analytics</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Time Map</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
             
            <div class="row mb-4">
                <div class="col-lg-12 col-md-12 mb-4">
                {!! Form::open(array('url' => array('/timemap'), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
                
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
                <a class="btn btn-dark mb-1 steamerst_link mt-2" style="width:100%;" href="{!!url('timemap')!!}">Show All</a>

							
                        </div>
                    </div>
                    </div>
                </div>
				 {!!Form::close()!!}
				    <div class="card">
                        <div class="card-body">
                           
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Goal Cycle</th>
                                        <th scope="col">Objective</th>
                                        <th scope="col">Measure</th>
                                        <th scope="col">Initiative</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($timemap_data))
                                    @foreach($timemap_data as $skey => $svalue)
										@foreach($svalue as $key => $value)
											<tr>
												@if($key == '0')
												<th scope="row">{!!$value->cycle_name!!}</th>
												@else
												<th scope="row"></th>
												@endif
												<td><a href="javascript:void(0);" onclick="viewobjective('{!!$value->id!!}')"><i class="{!!$value->icons !!} heading-icon" style="color:{!!$value->bg_color!!}"></i> {!!$value->heading!!}</a></td>
												<td></td>
												<td></td>
											</tr>
											@foreach($value->getMeasures as $mKey=>$mValue)
											<tr>
												<th scope="row"></th>
												<td><a href="javascript:void(0);" onclick="viewobjective('{!!$value->id!!}')"><i class="{!!$value->icons !!} heading-icon" style="color:{!!$value->bg_color!!}"></i> {!!$value->heading!!}</a></td>
												<td><a href="javascript:void(0);" onclick="viewMeasure('{!!$mValue->id!!}')"><i class="{!!$mValue->icons !!} heading-icon" style="color:{!!$mValue->bg_color!!}"></i> {!!$mValue->heading!!}</a></td>
												<td></td>
											</tr>
											@endforeach
											@foreach($value->getInitiatives as $iKey=>$iValue)
											<tr>
												<th scope="row"></th>
												<td><a href="javascript:void(0);" onclick="viewobjective('{!!$value->id!!}')"><i class="{!!$value->icons !!} heading-icon" style="color:{!!$value->bg_color!!}"></i> {!!$value->heading!!}</a></td>
												<td></td>
												<td><a href="javascript:void(0);" onclick="view_initiativepop('{!!$iValue->id!!}')"><i class="{!!$iValue->icons !!} heading-icon" style="color:{!!$iValue->bg_color!!}"></i> {!!$iValue->heading!!}</a></td>
											</tr>
											@endforeach
										@endforeach
									@endforeach
                                    @endif
								</tbody>
                            </table>
                        </div>
                    </div>
                </div>

            
            
            </div>
        </div>

    </main>
    @include('Element/js/includejs')
@stop