<div class="modal" id="importmember" role="dialog" >
    <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Member</h5>
                <button type="button" class="close" id="importmemberhide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">   	
                   {!! Form::open(array('url' => array($route_prefix.'/import-members'), 'class' =>' needs-validation tooltip-label-right', 'name'=>'', 'files'=>true)) !!}
                    <div class="form-row">
                           <div class="form-group position-relative error-l-100 col-md-6">
                                <label for="">{!! getLabels('members_csv') !!}</label><br>
                                <input type="file" name="csv" > <br/>
                                @if($errors->first('csv'))<div class="errors" style="color: red">{!!$errors->first('csv')!!}</div>@endif
                            </div>  
                            <div class="form-group col-md-6">
                               
                                <a href = "{!!url('public/upload/import.csv')!!}"><button type="button" class="btn float-right btn-primary">{!! getLabels('download_sample_csv') !!}</button></a>
                            </div>                          
                        </div>
                        <div class="form-group  position-relative error-l-100">
                        <button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
                        <a href="{!! url($route_prefix, 'members') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
                        </div>
                    {!! Form::close() !!}
                    @if(!empty(session('rejected_arr')))
                    
                    <label><h3>{!! getLabels('Rejected Records') !!}</h3></label>
            
                    <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                           <th> {!! getLabels('name') !!} </th>
                                            <th> {!! getLabels('email') !!} </th>
                                            <th> {!! getLabels('user_type') !!} </th>
                                            <th class="text-center"> {!! getLabels('designation')!!} </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!$data->isEmpty())
                                            @foreach(session('rejected_arr') as $val)
                                                <tr class="odd gradeX">
                                                    <td>{!! $val['0']." ".$val['1'] !!}</td>
                                                    <td>
                                                        <a href="mailto:{!! $val['3'] !!}"> {!! $val['3'] !!} </a>
                                                    </td>
                                                    <td>{!! config('constants.USER_TYPES.'.$val['4']) !!}</td>
                                                    <td class="text-center">
                                                        {!!$val['5']!!}
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
                    @endif
            </div>
        </div>
    </div>
</div>