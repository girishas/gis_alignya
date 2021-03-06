@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>


@section('content')
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Testimonials') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix.'/testimonials/add') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('add_new_testimonials') !!} </a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Testimonials') !!}</li>
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
                            {!! Form::open(array('url' => array($route_prefix.'/testimonials'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')) !!}
								<div class="form-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												{!! Form::text('name', isset($_POST['name'])?trim($_POST['name']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_name')))!!}
											</div>
										</div>

										<div class="col-lg-3">
											<div class="form-group">
												{!! Form::select('status', array('' => getLabels('all_status')) + config('constants.STATUS'), isset($_POST['status'])?$_POST['status']:null, array('class' => 'form-control'))!!}
											</div>
										</div>
										
										<div class="col-lg-3">               
											<button class="btn btn-primary mb-1" type="submit">{!! getLabels('Search') !!}</button>
											<a class="btn btn-dark mb-1 steamerst_link" href="{!! url($route_prefix, 'testimonials') !!}">{!! getLabels('show_all') !!}</a>
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
                                    	<th> {!! SortableTrait::link_to_sorting_action('image', getLabels('image')) !!} </th>
										<th> {!! SortableTrait::link_to_sorting_action('name', getLabels('Name')) !!} </th>
										<th> {!! SortableTrait::link_to_sorting_action('designation', getLabels('designation')) !!} </th>
										<th> {!! SortableTrait::link_to_sorting_action('content', getLabels('Content')) !!} </th>
										<th class="text-center"> {!! SortableTrait::link_to_sorting_action('status', getLabels('status')) !!} </th>
										<th> {!! getLabels('action') !!} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!$data->isEmpty())
										@foreach($data as $val)
											<tr class="odd gradeX">
												<?php
												$remove_url = url($route_prefix."/testimonials-remove/".$val->id); ?>
												<td>
													<img src="../public/upload/testimonials/{!! $val->image !!}" class='img-circle' width="100px" height="100px">
												</td>
												<td>{!! $val->name !!}</td>
												<td>{!! $val->designation !!}</td>
												<td>{!! $val->content !!}</td>
												<td class="text-center">
													@if($val->status == 1)
														<a class="steamerst_status" href="{!! url($route_prefix.'/testimonials/status/'.$val->id) !!}" title="{!! getLabels('decline') !!}"><span class="badge badge-pill badge-secondary "> {!! config('constants.STATUS.1')!!} </span></a>
													@else
														<a class="steamerst_status" href="{!! url($route_prefix.'/testimonials/status/'.$val->id) !!}" title="{!! getLabels('approve') !!}"><span class="badge badge-pill badge-danger "> {!! config('constants.STATUS.0')!!} </span></a>
													@endif
												</td>
												<td>
													<div class="btn-group float-none-xs">
														<button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															{!! getLabels('action') !!}
														</button>
														<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
															<a class="steamerst_link dropdown-item" href="{!! url($route_prefix.'/testimonials/edit/'.$val->id) !!}">{!! getLabels('edit') !!}</a>
															<a class="dropdown-item" onclick = 'showConfirmationModal("<?php echo  getLabels('remove'); ?>", "<?php echo  getLabels('are_you_sure'); ?>", "{!! $remove_url !!}");' href="javascript:void(0);">{!! getLabels('remove') !!}</a>
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