<div class="modal modal-right" id="addtheme" role="dialog" >
    <div class="modal-dialog" style=" height: fit-content;">
        <div class="modal-content" style="background: #82bdb5">
            <div class="modal-header">
                <h5 class="modal-title">Add Theme</h5>
                <button type="button" class="close" onclick="hideaddtheme()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group ">
                        <label>Name</label>
                        {!! Form::text('theme_name',null, array('class' => 'form-control', 'id' => 'themename'))!!}                     
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="form-group ">
                        <label>Summary</label>
                        {!! Form::textarea('theme_summary',null, array('rows' => 2,'class' => 'form-control', 'id' => 'themesummary'))!!}                     
                        <div class="invalid-tooltip"></div>
                    </div>
                    <div class="form-group">
                        <button type="button" onclick="submitaddtheme()" class="btn btn-primary">Submit</button>                                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>