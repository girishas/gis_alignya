@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Email_Templates') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix.'/templates/add') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('add_email_template') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Email_Templates') !!}</li>
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
                            {!! Form::open(array('url' => array($route_prefix.'/templates'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')) !!}
								<div class="form-body">
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">
												{!! Form::text('name', isset($_POST['name'])?trim($_POST['name']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_name')))!!}
											</div>
										</div>
										
										<div class="col-lg-4">
											<div class="form-group">
												{!! Form::text('subject', isset($_POST['subject'])?trim($_POST['subject']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_subject')))!!}
											</div>
										</div>
										
										<div class="col-lg-3">               
											<button class="btn btn-primary mb-1" type="submit">{!! getLabels('Search') !!}</button>
											<a class="btn btn-dark mb-1 steamerst_link" href="{!! url($route_prefix, 'templates') !!}">{!! getLabels('show_all') !!}</a>
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
											<th> {!! SortableTrait::link_to_sorting_action('name',  getLabels('Name')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('subject_en', getLabels('subject')) !!} </th>
											<th> {!! SortableTrait::link_to_sorting_action('slug', getLabels('slug')) !!} </th>
											<th> {!! getLabels('action') !!} </th>
										</tr>
									</thead>
									<tbody>
										@if(!$data->isEmpty())
											@foreach($data as $val)
												<tr class="odd gradeX"><?php
													$remove_url = url($route_prefix."/page-remove/".$val->id); ?>
													<td>{!! $val->name !!}</td>
													<td>{!! $val->subject_en !!}
														<?php/* <p><strong>{!! getLabels('english') !!}</strong> : {!! $val->subject_en !!}</p>
														<p><strong>{!! getLabels('spanish') !!}</strong> : {!! $val->subject_sp !!}</p>
														<p><strong>{!! getLabels('french') !!}</strong> : {!! $val->subject_fr !!}</p> */ ?>
													</td>
													<td>{!! $val->slug !!}</td>
													<td>
														<div class="btn-group float-none-xs">
															<button class="btn btn-outline-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																{!! getLabels('action') !!}
															</button>
															<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 25px, 0px);">
																<a class="steamerst_link dropdown-item" href="{!! url($route_prefix.'/templates/edit/'.$val->slug) !!}">{!! getLabels('edit') !!}</a>
																<a class="steamerst_link dropdown-item" href="{!! url($route_prefix.'/templates/view/'.$val->slug) !!}">{!! getLabels('view') !!}</a>
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
@stop