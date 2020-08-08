<div class="modal modal-right" id="myModalUpdateTeam" role="dialog" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Team</h5>
                                            <button type="button" class="close" id="popupupdatehideteam" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                         {!! Form::model($team_detail,array('url' => array($route_prefix.'/team/'.(isset($team_detail->id) && !empty($team_detail)?$team_detail->id:$id)), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
                                        <div class="modal-body">
                                            
                                            <div class="container-fluid">
                                                <div class="row">
                                                    
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                    <label>Name</label>
                                                    {!! Form::text('team_name',null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
                                                </div>
                                                 <div class="form-group ">
                                                      <label>Choose Team Lead</label>
                                                {!! Form::select('team_head', $teamleads,null, array('class' => 'form-control select2-single', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
                                            
                                <div class="invalid-tooltip"></div>
								@if($errors->first('team_head'))<div class="error">{!!$errors->first('team_head')!!}</div>@endif
                            </div>
							 @if(count($departments)>0)
                                <div class="form-group ">
                                                      <label>Choose Department</label>
                               {!! Form::select('department_id', $departments,null, array('class' => 'form-control select2-single', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}                  
                                <div class="invalid-tooltip"></div>
								@if($errors->first('department_id'))<div class="error">{!!$errors->first('department_id')!!}</div>@endif
                            </div>
							@endif

                            <div class="form-group ">
                                                      <label>Choose Members</label>
                               <select class="form-control select2-multiple" multiple="multiple" name="member_ids[]" data-width="100%">
                                   <option label="&nbsp;"></option>
                            @if(!empty($all_members))
                            @foreach($all_members as $key_1 => $value_1)
                                @if(!empty($team_members_pluck))
                                @if(array_search($key_1,$team_members_pluck->toArray()))
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