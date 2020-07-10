@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>
@section('content')
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Subscription_Level') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix.'/subscriptionlevel/add') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('add_level_commission') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Subscription_Level') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			<?php /*<div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4">Search</h5>
                            {!! Form::open(array('url' => array($route_prefix.'/subscriptionlevel'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')) !!}
								<div class="form-body">
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group">
												{!! Form::text('fees', isset($_POST['fees'])?trim($_POST['fees']):null, array('class' => 'form-control',  'placeholder'=> 'Search By Fees'))!!}
											</div>
										</div>

										<div class="col-lg-4">
											<div class="form-group">
												{!! Form::text('fixed_amount', isset($_POST['fixed_amount'])?trim($_POST['fixed_amount']):null, array('class' => 'form-control',  'placeholder'=> 'Search By Page Fixed Amount'))!!}
											</div>
										</div>

										
										<div class="col-lg-3">               
											<button class="btn btn-primary mb-1" type="submit">Search</button>
											<a class="btn btn-dark mb-1 steamerst_link" href="{!! url($route_prefix, 'subscriptionlevel') !!}">Show All</a>
										</div>
									</div>
								</div>
							{!!Form::close()!!}
                        </div>
                    </div>
				</div>
			</div> */ ?>
			
			
            <div class="row mb-4">
                <div class="col-12 ">
                    <div class="card">
                        <div class="card-body">

                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
										<th> {!! SortableTrait::link_to_sorting_action('level_id', getLabels('level')) !!} </th>
										<th> {!! SortableTrait::link_to_sorting_action('fees', getLabels('processing_fees')) !!} </th>
										<th> {!! SortableTrait::link_to_sorting_action('fixed_amount', getLabels('fixed_amount')) !!} </th>
										<th> {!! SortableTrait::link_to_sorting_action('admin_commission', getLabels('admin_commission')) !!} </th>
										<th> {!! getLabels('action') !!} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$data->isEmpty())
										@foreach($data as $val)
											<tr class="odd gradeX">
												<td>{!! config('constants.LEVELS.'.$val->level_id)  !!}</td>
												<td>{!! $val->fees !!}%</td>
												<td>{!! $val->fixed_amount !!} cents</td>
												<td>{!! $val->admin_commission !!}%</td>	
												<td><a class="steamerst_link btn btn-outline-primary btn-xs" href="{!! url($route_prefix.'/subscriptionlevel/edit/'.$val->id) !!}">{!! getLabels('edit') !!}</a></td>
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