@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('perspectives') !!}</h1>
                     <div class="float-md-right">
                     		<button type="button" class="btn btn-outline-primary mb-1" onclick="addTheme()">Add Perspective</button>
                        </div>
					
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('perspectives') !!}</li>
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
                            {!! Form::open(array('url' => array($route_prefix.'/perspectives'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')) !!}
								<div class="form-body">
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												{!! Form::text('name', isset($_POST['name'])?trim($_POST['name']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_perspective')))!!}
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												{!! Form::select('status', array('' => getLabels('all_status')) + config('constants.STATUS'), isset($_POST['status'])?$_POST['status']:null, array('class' => 'form-control'))!!}
											</div>
										</div>
										
										<div class="col-lg-3">               
											<button class="btn btn-primary mb-1" type="submit">{!! getLabels('Search') !!}</button>
											<a class="btn btn-dark mb-1 steamerst_link" href="{!! url($route_prefix, 'perspectives') !!}">{!! getLabels('show_all') !!}</a>
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
										   <th> {!! getLabels('name') !!} </th>
										   <th class="text-center"> {!! getLabels('status')!!} </th>
											<th> {!! getLabels('action') !!} </th>
										</tr>
									</thead>
									<tbody>
										@if(!$data->isEmpty())
											@foreach($data as $val)
												<tr class="odd gradeX">
													<td>{!! $val->name!!}</td>
													<td class="text-center">{!!config('constants.MASTER_STATUS.'.$val->status)!!}</td>
													<td>
														<a href="javascript:void(0);" onclick="updatetheme({!!$val->id!!})"><i class="heading-icon simple-icon-pencil"></i></a>
														<?php
															$remove_url = url("perspective/remove/".$val->id); 
															$remove_msg = getLabels('are_you_sure?'); 
														?>
														<!--<a onclick = 'showConfirmationModal("Remove", "{!! $remove_msg !!}", "{!! $remove_url !!}");' href="javascript:void(0);"><i class="simple-icon-trash heading-icon"></i></a>-->
														
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
    @include('Element/department/addperspective')
    @include('Element/department/updateperspective')
    @include('Element/js/includejs')
    <script type="text/javascript">
    	function addTheme(){
    		$("#addtheme").modal("show");
    	}
    	function updatetheme(id){
    		$(".theme_id").val(id);
    		var token = "{!!csrf_token()!!}";
	        $.ajax({
	            type:"POST",
	            url: "{!!url('single-perspective-details')!!}"+"/"+id,
	            data:'_token='+token,
	            dataType:'JSON',
	            success: function (response) {
	            	$("#inputThemeName").val(response.name);
	            	$("#theme_status").val(response.status);
	            	$("#updatetheme").modal("show");
	            }
	        });
    	}
    $(document).ready(function(){
    	$("#updatethemehide").click(function(){
    		$("#updatetheme").modal("hide");
    	});
    	$("#addthemehide").click(function(){
    		$("#addtheme").modal("hide");
    	});
    })
    </script>
@stop