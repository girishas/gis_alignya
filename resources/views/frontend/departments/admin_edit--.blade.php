@if(empty($_POST))
@extends('frontend/layouts/default')
@endif


@if(empty($_POST))
@section('content')
	{!! HTML::style('public/slimcropper/css/slim.css') !!}
	{!! HTML::style('public/slimcropper/css/style.css') !!}
	{!! HTML::script('public/slimcropper/js/slim.kickstart.min.js') !!}
	
  <main>
  @endif
  
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>{!! getLabels('Update Department') !!}</h1>
					<div class="text-zero top-right-button-container">
						<a href="{!! url($route_prefix, 'departments') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1">{!! getLabels('Department') !!}</a>
                    </div>
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
                            </li>
                              <li class="breadcrumb-item">
                                <a class="steamerst_link" href="{!! url($route_prefix, 'departments') !!}">{!! getLabels('Department') !!}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{!! getLabels('Update Department') !!}</li>
                        </ol>
                    </nav>
                    <div class="separator mb-5"></div>
                </div>
            </div>
			
			
           <div class="card mb-4">
				<div class="card-body">
					
	
					{!! Form::model($data, array('url' => array($route_prefix.'/department/update/'.$data->id), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
						<div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputFirstname">{!! getLabels('Department Name') !!}</label>
								{!! Form::text('department_name', null, array('class' => 'form-control', 'id' => 'inputTeamname',  'placeholder'=> ''))!!}
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMembers">{!! getLabels('Parent Department') !!}</label>
                                <select class="form-control select2-single" name="parent_department_id" data-width="100%">
                                	<option value="0">Root Department</option>
                                	@foreach($Parentdepartments as $key => $value)
                                    	<option value="{!!$key!!}">{!!$value!!}</option>
                                    @endforeach
                                </select>						
								<div class="invalid-tooltip"></div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMembers">{!! getLabels('Department Head') !!}</label>
                                <select class="form-control select2-single" name="department_head" data-width="100%">
                                	<option label="&nbsp;"></option>
                                	@foreach($members as $key => $value)
                                		@if($key == $department_head->member_id)
                                    		<option value="{!!$key!!}" selected="selected">{!!$value!!}</option>
                                    	@else
                                    		<option value="{!!$key!!}">{!!$value!!}</option>
                                    	@endif
                                    @endforeach
                                </select>						
								<div class="invalid-tooltip"></div>
							</div>
							<div class="form-group  position-relative error-l-100 col-md-6">
								<label for="inputMembers">{!! getLabels('Department Members') !!}</label>
                                <select name = "department_members[]" class="form-control select2-multiple" multiple="multiple" data-width="100%">
                                	@foreach($members as $key => $value)
                                		@if(in_array($key,$selected_members))
                                    		<option value="{!!$key!!}" selected="selected">{!!$value!!}</option>
                                    	@else
                                    		<option value="{!!$key!!}">{!!$value!!}</option>
                                    	@endif
                                    @endforeach
                                </select>
							</div>							
						</div>
						<div class="form-group ">
						<button type="submit" class="btn btn-primary">{!! getLabels('update') !!}</button>&nbsp;&nbsp;
						<a href="{!! url($route_prefix, 'users') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
        </div>
		<script type="text/javascript">
			var user_id  = "{!! $data->id !!}"
			function profileimageWillBeRemoved(data, remove) {
				removeImage(data, remove, 'photo', user_id);
			}
			
			function coverimageWillBeRemoved(data, remove){
				removeImage(data, remove, 'cover_photo', user_id);
			}
			
			function removeImage(data, remove, image_type, user_id){
				form_action = "{!! url($route_prefix.'/delete-user-photo') !!}"
				$.ajax({
					type:"POST",
					url: form_action,
					data:"user_id="+user_id+"&image_type="+image_type,
					success: function (response) {
						if(response.type == 'success'){
							remove();
						}
					},
					 error: function(xhr, ajaxOptions, thrownError) {
					  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});
			}
		</script>
	@if(empty($_POST))
    </main>
@stop
@endif