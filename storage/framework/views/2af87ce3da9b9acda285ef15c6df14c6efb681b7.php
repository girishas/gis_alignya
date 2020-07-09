<div class="modal modal-right" id="themelistpop" role="dialog" >
    <div class="modal-dialog" style=" height: fit-content;">
        <div class="modal-content" style="background: #dee6ed">
            <div class="modal-header">
                <h5 class="modal-title">Theme</h5>
                <button type="button" class="close" onclick="hidethemelistpop()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group ">
                    <label>Select Theme</label>
                   <select class="form-control select2-single" name="theme_id" data-width="100%" id="themelist">
                       
                   </select>                    
                    <div class="invalid-tooltip"></div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="submitthemeid()">Submit</button>                                        
                </div>
                <div style="height: 20px"></div>
                 <div>
                    <button type="button" class="btn btn-primary" onclick="addmoretheme()">Add More Theme</button>                                       
                </div>
            </div>
        </div>
    </div>
</div>