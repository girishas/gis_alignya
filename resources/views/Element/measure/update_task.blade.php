<div class="modal modal-right" id="myModalUpdateTask" role="dialog" >
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Task</h5>
                    <button type="button" class="close" id="popupaddhideupdateTask" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if(session('adderrormessage'))
                    <div class="alert alert-danger" role="alert">
                        {!! session('adderrormessage') !!}
                    </div>    
                    @endif 
                <div class="modal-body">
                	 
                    {!! Form::open(array('url' => array($route_prefix.'/addtask'), 'class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
                                        
                    	<div class="container-fluid">
                    	<div class="row">
                    		
                    	<div class="col-lg-12">
                    		<div class="form-group">
                            <label>Title</label>
                            {!!Form::text('task_name',null,array('required'=>'required','class'=>'form-control','id'=>'task_name_update_id'))!!}
                            @if($errors->first('task_name'))<div class="error">{!!$errors->first('task_name')!!}</div>@endif
                            <input type="hidden" name="task_id" id="update_task_id">
                             <input type="hidden" name="is_popup" class="is_popup">
                        </div>
                        <div class="form-group">
                            <label>Owners</label>
							<?php   $contributers = Contributers();
									print_r($contributers);
							?>
							{!!Form::select('owners[]',$contributers,null,array('class'=>'form-control select2-multiple','multiple'=>'multiple','id'=>'contributer_id'))!!}
                                                  
                        </div>
                        <div class="form-group">
                            <label for="inputAboutYou">{!! getLabels('summary') !!}</label>
                        {!! Form::textarea('description', null, array('rows' => 2, 'class' => 'form-control', "id"=>"task_description_update_id", 'placeholder'=> ''))!!}
                        </div>
                        
    						
                        </div>
                        </div>
                        </div>
                        <div class="col-lg-12">
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    {!!Form::close()!!}
                </div>
                
            </div>
        </div>
		{!! HTML::style('public/css/vendor/select2.min.css') !!}
			{!! HTML::style('public/css/vendor/select2-bootstrap.min.css') !!}
			{!! HTML::script('public/js/vendor/select2.full.js') !!}
			
    </div>
    