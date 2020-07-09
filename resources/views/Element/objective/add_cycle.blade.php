<div class="modal modal-right" id="addcycle" role="dialog" >
    <div class="modal-dialog" style=" height: fit-content;">
        <div class="modal-content" style="background: #82bdb5">
            <div class="modal-header">
                <h5 class="modal-title">Add Cycle</h5>
                <button type="button" class="close" onclick="hideaddcycle()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group ">
                        <label>Name</label>
                        {!! Form::text('cycle_name',null, array('class' => 'form-control', 'id' => 'cyclename'))!!}                     
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="form-group ">
                        <label>Number of Months</label>
                        {!! Form::number('no_months',null, array('class' => 'form-control', 'id' => 'numberofmonth'))!!}                     
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="form-group">
                        <button type="button" onclick="submitaddcycle()" class="btn btn-primary">Submit</button>                                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>