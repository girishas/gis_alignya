@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')

  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Subscription') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix.'/subscriptions/add') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">ADD NEW SUBSCRIPTION</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Subscription') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
				<div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4">Search</h5>
                            {!! Form::open(array('url' => array($route_prefix.'/subscriptions'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')) !!}
								<div class="form-body">
									<div class="row">
										<div class="col-lg-5">
											<div class="form-group">
												{!! Form::text('transaction_id', isset($_POST['transaction_id'])?trim($_POST['transaction_id']):null, array('class' => 'form-control',  'placeholder'=> 'Search By Transaction Id'))!!}
											</div>
										</div>

										<div class="col-lg-4">
											<div class="form-group">
												{!! Form::text('page_creater_id', isset($_POST['page_creater_id'])?trim($_POST['page_creater_id']):null, array('class' => 'form-control',  'placeholder'=> 'Search By Page Creater Id'))!!}
											</div>
										</div>

										
										<div class="col-lg-3">               
											<button class="btn btn-primary mb-1" type="submit">Search</button>
											<a class="btn btn-dark mb-1 steamerst_link" href="{!! url($route_prefix, 'subscriptions') !!}">Show All</a>
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

                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
										<th> {!! SortableTrait::link_to_sorting_action('transaction_id', 'Transaction Id') !!} </th>
										<th> {!! SortableTrait::link_to_sorting_action('page_creater_id', 'Page Creater Id') !!} </th>
										<th> {!! SortableTrait::link_to_sorting_action('subscriber_user_id', 'Subscriber User Id') !!} </th>
										<th> {!! SortableTrait::link_to_sorting_action('gift_user_id', 'Gift User Id') !!} </th>
										<th class="text-center"> {!! SortableTrait::link_to_sorting_action('page_id', 'Page Id') !!} </th>
										<th> {!! getLabels('action') !!} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$data->isEmpty())
										@foreach($data as $val)
											<tr class="odd gradeX"><?php
												$remove_url = url($route_prefix."/subscriptions-remove/".$val->id); ?>
												<td>{!! $val->transaction_id !!}</td>
												<td>{!! $val->page_creater_id !!}</td>
												<td>{!! $val->subscriber_user_id !!}</td>
												<td>{!! $val->gift_user_id !!}</td>
												<td>{!! $val->page_id !!}</td>
												
												<td>
													<div class="btn-group float-none-xs">
														<button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															{!! getLabels('action') !!}
														</button>
														<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
															<a class="steamerst_link dropdown-item" href="{!! url($route_prefix.'/subscriptions/edit/'.$val->id) !!}">{!! getLabels('edit') !!}</a>
															<a class="dropdown-item" onclick = 'showConfirmationModal("<?php echo getLabels('remove'); ?>", "<?php echo getLabels('are_you_sure'); ?>", "{!! $remove_url !!}");' href="javascript:void(0);">{!! getLabels('remove') !!}</a>
														</div>
													</div>
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