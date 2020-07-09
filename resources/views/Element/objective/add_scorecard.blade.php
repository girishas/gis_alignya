<div class="modal modal-right" id="addscorecard" role="dialog" >
    <div class="modal-dialog" style=" height: fit-content;">
        <div class="modal-content" style="background: #82bdb5">
            <div class="modal-header">
                <h5 class="modal-title">Add Scorecard</h5>
                <button type="button" class="close" onclick="hideaddscorecard()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group ">
                        <label>Name</label>
                        {!! Form::text('name',null, array('class' => 'form-control', 'id' => 'scorecardname'))!!}                     
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="form-group ">
                        <label>Status</label>
                        {!! Form::select('status',config('constants.SCORECARD_STATUS'),null, array('class' => 'form-control', 'id' => 'scorecardstatus'))!!}                     
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="form-group">
                        <button type="button" onclick="submitaddscorecard()" class="btn btn-primary">Submit</button>                                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>