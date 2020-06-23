 <div class="modal modal-right" id="myModalUpdateDepartment" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@if($id) Update @else Add @endif Department</h5>
                <button type="button" class="close" id="popupaddhideupdatedepartment" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
             {!! Form::model($parent_department,array('url' => array($route_prefix.'/department/'.$id), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
                
            <div class="modal-body">
                   
                    <div class="container-fluid">
                    <div class="row">
                        
                    <div class="col-lg-12">
                        <div class="form-group">
                        <label>Name</label>
                        {!! Form::text('department_name',null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
                    </div>
                    @if(isset($departments))
                    <div class="form-group ">
                          <label>Choose Parent Department</label>
                          {!! Form::select('parent_department_id', $departments,null, array('class' => 'form-control select2-single', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
                       
                        <div class="invalid-tooltip"></div>
                    </div>
                    @endif
                    @if(isset($all_members))
                    <div class="form-group ">
                        <label>Choose Department Head</label>
                        {!! Form::select('department_head', $all_members,isset($hod)?$hod->id:"", array('class' => 'form-control select2-single', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}                    
                        <div class="invalid-tooltip"></div>
                    </div>
                    
                    <div class="form-group ">
                        <label>Choose Members</label> 
                        <select class="form-control select2-multiple" multiple="multiple" name="member_ids[]" data-width="100%">
                                   <option label="&nbsp;"></option>
                            @if(!empty($all_members))
                            @foreach($all_members as $key_1 => $value_1)
                                @if(!empty($members_pluck))
                                @if(array_search($key_1,$members_pluck->toArray()))
                                    <option value="{!!$key_1!!}" selected="selected">{!!$value_1!!}</option>
                                @else
                                    <option value="{!!$key_1!!}">{!!$value_1!!}</option>
                                @endif
                                @endif
                            @endforeach
                            @endif
                                </select>                   
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