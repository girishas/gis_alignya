<div class="modal" id="updatescorecards" role="dialog" >
    <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Scorecard</h5>
                <button type="button" class="close" id="updatescorecardhide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                        	
                   {!! Form::open(array('url' => array($route_prefix.'/scorecards/new'), 'class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
                        <input type="hidden" name="id" class="scorecard_id">
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-12">
                                <label for="inputScorecardName">{!! getLabels('Scorecard Name') !!}</label>
                                {!! Form::text('name', null, array('class' => 'form-control', 'id' => 'inputScorecardName',  'placeholder'=> ''))!!}
                                 <div class="invalid-tooltip"></div>
                            </div>   
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            {!!Form::select('status',config('constants.MASTER_STATUS'),null,array('class'=>'form-control','id'=>'scorecard_status'))!!}
                            
                        </div>
                        <div class="form-group  position-relative error-l-100">
                        <button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
                        <a href="{!! url($route_prefix, 'scorecards') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
                        </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>