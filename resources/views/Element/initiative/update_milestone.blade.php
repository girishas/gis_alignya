<div class="modal modal-right" id="updatemilestoneini" role="dialog" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Milestone</h5>
                <button type="button" class="close" id="popup3hideupdate" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                {!! Form::open(array('url' => array($route_prefix.'/addmilestoneinitiative'), 'class' =>' needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
                    
                    <div class="container-fluid">
                    <div class="row">
                        
                    <div class="col-lg-8">
                        <div class="form-group">
                        <label>Milestone Name</label>
                        {!!Form::text('milestone_name', null, array('class'=>'form-control','id'=>'milestonenameini'))!!}
                        <input type="hidden" name="initiative_id" id="ini_idformilestoneup">
                        <input type="hidden" name="id" id="milestone_id_ini">
                    </div>
                     <div class="form-group ">
                        <label>Start Date</label>
                        {!!Form::text('start_date', null, array('class'=>'form-control datepicker','id'=>'start_date_ini'))!!}
                        
                        <div class="invalid-tooltip"></div>
                        </div>
                        <div class="form-group ">
                            <label>End Date</label>
                        {!!Form::text('end_date', null, array('class'=>'form-control datepicker','id'=>'end_date_ini'))!!}
                            <div class="invalid-tooltip"></div>
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn btn-primary">Submit</button>
                                        
                            <div class="invalid-tooltip"></div>
                        </div>

                    </div>
                   
                    </div>
                    </div>
               {!!Form::close()!!}
            </div>
           
        </div>
    </div>
</div>