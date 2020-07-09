<div class="modal modal-right" id="scorecardslist" role="dialog" >
    <div class="modal-dialog" style=" height: fit-content;">
        <div class="modal-content" style="background: #dee6ed">
            <div class="modal-header">
                <h5 class="modal-title">Scorecard</h5>
                <button type="button" class="close" id="popupaddhideObjective" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group ">
                    <label>Choose scorecards</label>
                    <?php echo Form::select('scorecard[]',$scorecards,null, array('class' => 'form-control select2-multiple', 'id' => 'inputFirstname',  "multiple" => 'multiple')); ?>                     
                    <div class="invalid-tooltip"></div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary">Submit</button>                                        
                </div>
                <div style="height: 20px"></div>
                 <div>
                    <button type="button" class="btn btn-primary" onclick="addmorescorecard()">Add More Scorecard</button>                                        
                </div>
            </div>
        </div>
    </div>
</div>