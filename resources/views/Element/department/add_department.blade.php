 <div class="modal modal-right" id="myModalAddDepartment" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Department</h5>
                <button type="button" class="close" id="popupaddhidedepartment" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(session('errormessageadd'))
            <div class="alert alert-danger" role="alert">
                {!! session('errormessageadd') !!}
            </div>    
            @endif
             {!! Form::open(array('url' => array($route_prefix.'/department'), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
                
            <div class="modal-body">
                   
                    <div class="container-fluid">
                    <div class="row">
                        
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label>Name</label>
                        {!! Form::text('department_name',null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
                         @if($errors->first('department_name'))<div class="error">{!!$errors->first('department_name')!!}</div>@endif
                    </div>
                    @if(isset($departments))
                    <div class="form-group ">
                          <label>Choose Parent Department</label>
                          {!! Form::select('parent_department_id', $departments,null, array('class' => 'form-control select2-single', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
                       
                        <div class="invalid-tooltip"></div>
                    </div>
                    @endif
                    @if(isset($department_head))
                    <div class="form-group ">
                        <label>Choose Department Head</label>
                        {!! Form::select('department_head', $department_head,null, array('class' => 'form-control select2-single', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}                    
                        <div class="invalid-tooltip"></div>
                    </div>
                    
                    <div class="form-group ">
                        <label>Choose Members</label>
                        {!! Form::select('member_ids[]', $all_members,null, array('class' => 'form-control select2-multiple', 'id' => 'inputFirstname',  "multiple" => 'multiple'))!!}                     
                        <div class="invalid-tooltip"></div>
                    </div>
                    @endif


                    
                    </div>
                   
                    </div>
                    </div>
                
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Submit</button>
                
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>