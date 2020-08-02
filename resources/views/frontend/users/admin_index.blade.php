@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
  <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Members') !!}</h1>
                     <div class="float-md-right">
                     		@if($data->total() < getEmpLimit(Auth::User()->company_id))
							<button type="button" class="btn btn-outline-primary mb-1" onclick="addMember()">Add Member</button>
							<button type="button" class="btn btn-outline-primary mb-1" onclick="importcsv()">Import Members</button>
							@endif
							
							
							<a href="{!!url('department')!!}"><button type="button" class="btn btn-primary mb-1">Departments</button></a>
							<a href="{!!url('team')!!}"><button type="button" class="btn btn-primary mb-1">Teams</button></a>
							
							
                            
                        </div>
					
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                            
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Members') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
            @if(session('message'))
			<div class="alert alert-success alert-dismissible" role="alert" style="z-index: unset;">
				{!! session('message') !!}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			@endif

			@if(Auth::User()->current_membership_plan == 1 || Auth::User()->current_membership_plan == 4)
			<div class="alert alert-warning alert-dismissible" role="alert" style="z-index: unset;">
				Upgrade your membership for add more team members. <a href="{!!url('subscription')!!}">Click Here</a>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			@endif
			<div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body">

                            <h5 class="mb-4">{!! getLabels('Search') !!}</h5>
                            {!! Form::open(array('url' => array($route_prefix.'/members'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')) !!}
								<div class="form-body">
									<div class="row">
										<div class="col-lg-3">
											<div class="form-group">
												{!! Form::text('first_name', isset($_POST['first_name'])?trim($_POST['first_name']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_name')))!!}
											</div>
										</div>
										<div class="col-lg-3">
											<div class="form-group">
												{!! Form::text('email', isset($_POST['email'])?trim($_POST['email']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_email')))!!}
											</div>
										</div>
										
										<div class="col-lg-2">
											<div class="form-group">
												{!! Form::select('status', array('' => getLabels('all_status')) + config('constants.STATUS'), isset($_POST['status'])?$_POST['status']:null, array('class' => 'form-control'))!!}
											</div>
										</div>
										
										<div class="col-lg-3">               
											<button class="btn btn-primary mb-1" type="submit">{!! getLabels('Search') !!}</button>
											<a class="btn btn-dark mb-1 steamerst_link" href="{!! url($route_prefix, 'members') !!}">{!! getLabels('show_all') !!}</a>
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
											<th> {!! getLabels('email') !!} </th>
											<th> {!! getLabels('user_type') !!} </th>
											<th class="text-center"> {!! getLabels('designation')!!} </th>
											<th class="text-center"> {!! getLabels('status')!!} </th>
											<th> {!! getLabels('action') !!} </th>
										</tr>
									</thead>
									<tbody>
										@if(!$data->isEmpty())
											@foreach($data as $val)
												<tr class="odd gradeX">
													<td>{!! $val->first_name." ".$val->last_name !!}</td>
													<td>
														<a href="mailto:{!! $val->email !!}"> {!! $val->email !!} </a>
													</td>
													<td>{!! config('constants.USER_TYPES.'.$val->role_id) !!}</td>
													<td class="text-center">
														{!!$val->designation!!}
													</td>
													<td class="text-center">{!!config('constants.STATUS.'.$val->status)!!}</td>
													<td>
														<a href="javascript:void(0);" onclick="updatemember({!!$val->id!!})"><i class="heading-icon simple-icon-pencil"></i></a>
																<a href="javascript:void(0);" onclick="viewmember({!!$val->id!!})"><i class="heading-icon iconsminds-information"></i></a>
																
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
    @include('Element/users/addmember')
    @include('Element/users/importmember')
    @include('Element/js/includejs')
    <div id="viewMemberShow"></div>
    <div id="modalShow"></div>
    <script type="text/javascript">
    	$(document).ready(function(){
    		var erroradd = "{!!session('errormessageadd')?session('errormessageadd'):''!!}";
    		if(erroradd != ""){
    			addMember();
    		}
    		var errorupdate = "{!!session('errormessageupdate')?session('errormessageupdate'):''!!}";
    		if(errorupdate != ""){
    			$("#updatemember").modal("show");
    		}
    		$("#importmemberhide").click(function(){
    			$("#importmember").modal("hide");
    		})
    		var rejected = <?=json_encode(session('rejected_arr'))?>;
    		var errormessage = "{!!session('errormessage')?session('errormessage'):''!!}";
    		if(rejected != null || errormessage != ''){
    			importcsv();
    		}

    	});
    	function addMember(){
    		$("#addmember").modal("show");
    	}
    	$("#addmemberhide").click(function(){
    		$("#addmember").modal("hide");
    	});
    	function updatemember(id){
    		var token = "{!!csrf_token()!!}";
	        $.ajax({
	            type:"POST",
	            url: "{!!url('/setuserdatasession')!!}",
	            data:'_token='+token+'&id='+id,
	            dataType:'html',
	            success: function (response) {
	            	$("#modalShow").html(response);
    				$("#updatemember").modal("show");
	            }  
	        });
    	}

    	function viewmember(id){
    		var token = "{!!csrf_token()!!}";
	        $.ajax({
	            type:"POST",
	            url: "{!!url('/viewmember')!!}",
	            data:'_token='+token+'&id='+id,
	            dataType:'html',
	            success: function (response) {
	            	$("#viewMemberShow").html(response);
    				$("#viewmember").modal("show");
	            }  
	        });
    	}

    	function importcsv(){
    		$("#importmember").modal("show");
    	}
    	
    </script>
@stop