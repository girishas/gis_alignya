 <div class="modal modal-right" id="myModalAddKPI" role="dialog" >
        <div class="modal-dialog" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add KPI</h5>
                    <button type="button" class="close" id="popupaddhidekpi" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <form>
                        <div class="container-fluid">
                        <div class="row">
                            
                        <div class="col-lg-8">
                            <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                       
                        <div class="form-group">
                            <label>Cycle</label>
                            <select class="form-control">
                                <option label="&nbsp;">&nbsp;</option>
                                <option value="Flexbox">FY2020-Q1</option>
                                <option value="Sass">FY2020-Q2</option>
                                <option value="React">FY2020-Q3</option>
                            </select>
                        </div>
                         
    <div class="form-group">    
        <label>Ownership</label>
            <br>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-primary active">
                    <input type="radio" name="options" id="option1" value="1" checked> Department
                </label>
                <label class="btn btn-primary">
                    <input type="radio" name="options" value="2" id="option2"> Team
                </label>
                <label class="btn btn-primary">
                    <input type="radio" name="options" value="3" id="option3"> Individual
                </label>
            </div>
        </div>

    <div class="form-group ">
        <select class="form-control select2-single" name="department_head" data-width="100%">
            <option label="&nbsp;"></option>
            <option value="1" >dep1</option>
            <option value="1" >dep1</option>
            <option value="1" >dep1</option>
            <option value="1" >dep1</option>
            <option value="1" >dep1</option>
            
            
        </select>                       
        <div class="invalid-tooltip"></div>
    </div>

                            
                        </div>
                       
                        </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-primary">Submit</button>
                    
                </div>
            </div>
        </div>
    </div>