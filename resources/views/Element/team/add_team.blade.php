<div class="modal modal-right" id="myModalAddTeam" role="dialog" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Team</h5>
                                            <button type="button" class="close" id="popupaddhideteam" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @if(session('errormessageadd'))
                                        <div class="alert alert-danger" role="alert">
                                          {!!session('errormessageadd')!!}
                                        </div>
                                        @endif
                                         {!! Form::open(array('url' => array($route_prefix.'/team'), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
                                        <div class="modal-body">
                                            
                                            <div class="container-fluid">
                                                <div class="row">
                                                    
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                    <label>Name</label>
                                                    {!! Form::text('team_name',null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
                                                    @if($errors->first('team_name'))<div class="error">{!!$errors->first('team_name')!!}</div>@endif
                                                </div>
                                                 <div class="form-group ">
                                                      <label>Choose Team Lead</label>
                                                {!! Form::select('team_head', $teamleads,null, array('class' => 'form-control select2-single', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
                                            
                                <div class="invalid-tooltip"></div>
                            </div>
                                <div class="form-group ">
                                                      <label>Choose Department</label>
                               {!! Form::select('department_id', $departments,null, array('class' => 'form-control select2-single', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}                  
                                <div class="invalid-tooltip"></div>
                            </div>

                            <div class="form-group ">
                                                      <label>Choose Members</label>
                               {!! Form::select('member_ids[]', $all_members,null, array('class' => 'form-control select2-multiple', 'id' => 'inputFirstname',  "multiple" => 'multiple'))!!}                      
                                <div class="invalid-tooltip"></div>
                            </div>
                                                

                          
                                                
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