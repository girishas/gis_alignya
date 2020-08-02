<?php if(empty($_POST)): ?>

<?php endif; ?>


<?php if(empty($_POST)): ?>
<?php $__env->startSection('content'); ?>
	
	
  <main>
  <?php endif; ?>
  <div class="container-fluid">
            <div class="row app-row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1>Ideas</h1>
                        <div class="top-right-button-container">
                            <button type="button" class="btn btn-outline-primary btn-sm top-right-button  mr-1"
                                data-toggle="modal" data-backdrop="static" data-target="#exampleModal">ADD A NEW IDEA</button>
                            <div class="modal fade modal-right" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                         <?php echo Form::open(array('url' => array($route_prefix.'/addidea'), 'class' =>'alignya_form needs-validation tooltip-label-right', 'files'=>true)); ?>

                                        <div class="modal-body">
                                                <div class="form-group position-relative error-l-100">
                                                    <label>Title</label>
                                                    <?php echo Form::text('title',null,array('class'=>'form-control')); ?>

                                                    <div class="invalid-tooltip"></div>
                                                </div>
                                                <div class="form-group ">
                                                    <label>Description</label>
                                                     <?php echo Form::textarea('description', null, array('rows' => 2, 'class' => 'form-control')); ?>

                                                </div>

                                                <div class="form-group position-relative error-l-100">
                                                    <label>Department</label>
                                                    <?php echo Form::select('department_id',array(''=>'Please Select Department')+$departments, null, array('class'=>'form-control')); ?>

                                                   <div class="invalid-tooltip"></div>
                                                </div>


                                                <div class="form-group">
                                                    <label></label>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customCheck1" name="is_popular">
                                                        <label class="custom-control-label"
                                                            for="customCheck1">Is Popular</label>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        <?php echo Form::close(); ?>

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="mb-2">
                        <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
                            role="button" aria-expanded="true" aria-controls="displayOptions">
                            Display Options
                            <i class="simple-icon-arrow-down align-middle"></i>
                        </a>
                        <div class="collapse d-md-block" id="displayOptions">
                            <div class="d-block d-md-inline-block">
                                <div class="btn-group float-md-left mr-1 mb-1">
                                    <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Order By
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                    </div>
                                </div>
                                <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                    <input placeholder="Search Ideas...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="separator mb-5"></div>

                    <div class="list disable-text-selection" data-check-all="checkAll">
                        <div class="card d-flex flex-row mb-3">
                            <div class="d-flex flex-grow-1 min-width-zero">
                                <div
                                    class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                      
                                        <span class="align-middle d-inline-block w-15">France Launch</span>
                                    
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">As part of informationalization</p>
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">Created 2 days ago By Brayan</p>
                                    <div class="w-15 w-xs-100">
                                       <i class="simple-icon-bubbles"></i> 23
                                    </div> <div class="w-15 w-xs-100">
                                       <i class="simple-icon-like"></i> 16
                                    </div>
                                </div>
                               
                            </div>
                        </div>

                        <div class="card d-flex flex-row mb-3">
                            <div class="d-flex flex-grow-1 min-width-zero">
                               <div
                                    class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                      
                                        <span class="align-middle d-inline-block w-15">Maxico Launch</span>
                                    
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">As part of informationalization </p>
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">Created 2 days ago By Brayan</p>
                                    <div class="w-15 w-xs-100">
                                       <i class="simple-icon-bubbles"></i> 23
                                    </div> <div class="w-15 w-xs-100">
                                       <i class="simple-icon-like"></i> 16
                                    </div>
                                </div>
                               
                            </div>
                        </div>

                        <div class="card d-flex flex-row mb-3">
                            <div class="d-flex flex-grow-1 min-width-zero">
                               <div
                                    class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                      
                                        <span class="align-middle d-inline-block w-15">Self Service Mentor Application</span>
                                    
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">As part of informationalization</p>
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">Created 2 days ago By Brayan</p>
                                    <div class="w-15 w-xs-100">
                                       <i class="simple-icon-bubbles"></i> 23
                                    </div> <div class="w-15 w-xs-100">
                                       <i class="simple-icon-like"></i> 16
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="app-menu">
            <div class="p-4 h-100">
                <div class="scroll">
                    <p class="text-muted text-small">Filter By Status</p>
                    <ul class="list-unstyled mb-5">
                        <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input" id="status<?php echo $key; ?>">
                                <label class="custom-control-label" for="status<?php echo $key; ?>"><?php echo $value; ?></label>
                                
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
            <a class="app-menu-button d-inline-block d-xl-none" href="#">
                <i class="simple-icon-options"></i>
            </a>
        </div>

   </div>
            </div>
        </div>
<script type="text/javascript">
    $("body").on('submit', ".alignya_form", function(e) {
        $("div.invalid-tooltip").css("display",'none');
    e.preventDefault();
    
    var form_action = $(this).attr('action');
    data = $(this).serialize();
    
   
    $.ajax({
        type:"POST",
        url: form_action,
        data:data,
        beforeSend: function(){
            $('body').addClass('show-spinner');
        },
        success: function (response) {
            if(response.type == 'error'){
                errors = response.error;
                $.each(errors, function(key,value) {
                    $('input[name="'+key+'"]').next('div.invalid-tooltip').css('display', 'block');
                    $('input[name="'+key+'"]').next('div.invalid-tooltip').html(value[0]);
                    $('select[name="'+key+'"]').next('div.invalid-tooltip').css('display', 'block');
                    $('select[name="'+key+'"]').next('div.invalid-tooltip').html(value[0]);
                    $('.summernote_'+key).css('display', 'block');
                    $('.summernote_'+key).html(value[0]);
                    $('textarea[name="'+key+'"]').next('div.invalid-tooltip').css('display', 'block');
                    $('textarea[name="'+key+'"]').next('div.invalid-tooltip').html(value[0]);
                });
                showNotificationApp('top', 'right', 'danger', 'Error', response.message);
            }else if(response.type == 'success'){
                pageUrl = response.url;
                var lastslashindex = pageUrl.lastIndexOf('/');
                var resultName= pageUrl.substring(lastslashindex  + 1);
                $('#myModalAddObjective').modal('hide');
                $('#updateobjectivemodal').modal('hide');
                $('#myModalAddMeasure').modal('hide');
                $('#myModalUpdateMeasure').modal('hide');
                $('#myModalAddInitiative').modal('hide');
                $('#myModalAddKPI').modal('hide');
                $('#myModalUpdateKPI').modal('hide');
                $('#myModalUpdateInitiative').modal('hide');
                $('#updateMilestoneMeasureView').modal('hide');
                $('#myModalAddTask').modal('hide');
                $('#myModalUpdateTask').modal('hide');
                $('#updatemilestoneini').modal('hide');
                $('#addMilestoneMeasureView').modal('hide');
                $('#myModal2').modal('hide');
                
                $("form").trigger("reset");
                if(pageUrl == "close_modal"){
                    if(response.popup_name == "objective"){
                       // $("form.alignya_form .select2-multiple").val(null).trigger('change');
                        viewobjective(localStorage.getItem('popup_id'));
                    }else if(response.popup_name == "measures"){
                        if(window.location.href.indexOf('objectives') !== -1){
                      viewobjective(localStorage.getItem('popup_id'));
                      }else if(window.location.href.indexOf('measures') !== -1){
                          viewMeasure(localStorage.getItem('popup_id'));
                      }else if(window.location.href.indexOf('initiatives') !== -1){
                          view_initiativepop(localStorage.getItem('popup_id'));
                      }
                    }else if(response.popup_name == "initiative"){
                        view_initiativepop(localStorage.getItem('popup_id'));
                    }

                    return false;
                }else{
                    window.location.reload();
                }
                
                $.cergis.loadContent();
                e.preventDefault();
                if(response.message){
                    showNotificationApp('top', 'right', 'primary', 'Success', response.message);
                }
                $('.slim-popover').remove();
                
                $('html,body').animate({
                    scrollTop: $("html").offset().top
                }, 'fast');
            }
            $('body').removeClass("show-spinner");
            
        },
         error: function(xhr, ajaxOptions, thrownError) {
          alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});
</script>
	<?php if(empty($_POST)): ?>
    </main>
<?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>