<div class="modal" id="addtheme" role="dialog" >
    <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Perspective</h5>
                <button type="button" class="close" id="addthemehide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                        	
                   {!! Form::open(array('url' => array($route_prefix.'/perspectives/new'), 'class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
                        
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-12">
                                <label for="inputFirstname">{!! getLabels('Name') !!}</label>
                                {!! Form::text('name', null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
                                 <div class="invalid-tooltip"></div>
                            </div>   
                        </div>
                        
                        <div class="form-group  position-relative error-l-100">
                        <button type="submit" class="btn btn-primary">{!! getLabels('Submit') !!}</button>&nbsp;&nbsp;
                        <a href="{!! url($route_prefix, 'perspectives') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
                        </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>