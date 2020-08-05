@if(empty($_POST))
@extends('frontend/layouts/default')
@endif


@section('content')
	
	<style type="text/css">
     .r-is{
        border: 1px solid #8f8f8f;
    border-radius: 15px;
    color: #3a3a3a;
}

    </style>
  <main>

  <div class="container-fluid">
            <div class="row">
                <div class="col-9">
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
                                         {!! Form::open(array('url' => array($route_prefix.'/addidea'), 'class' =>'alignya_form needs-validation tooltip-label-right', 'files'=>true)) !!}
                                        <div class="modal-body">
                                                <div class="form-group position-relative error-l-100">
                                                    <label>Title</label>
                                                    {!!Form::text('title',null,array('class'=>'form-control'))!!}
                                                    <div class="invalid-tooltip"></div>
                                                </div>
                                                 <div class="form-group position-relative error-l-100">
                                                    <label>Category</label>
                                                    {!!Form::select('category_id',array(''=>'Please Select Category')+$categories, null, array('class'=>'form-control'))!!}
                                                   <div class="invalid-tooltip"></div>
                                                </div>
                                               
                                                <div class="form-group position-relative error-l-100">
                                                    <label>Department</label>
                                                    {!!Form::select('department_id',array('0'=>'All Departments')+$departments, null, array('class'=>'form-control'))!!}
                                                   <div class="invalid-tooltip"></div>
                                                </div>
                                                <div class="form-group ">
                                                    <label>Description</label>
                                                     {!! Form::textarea('description', null, array('rows' => 2, 'class' => 'form-control'))!!}
                                                </div>
                                                 <div class="form-group position-relative error-l-100">
                                                    <label>Status</label>
                                                    {!!Form::select('status',array('0'=>'Select Status')+$status, null, array('class'=>'form-control'))!!}
                                                   <div class="invalid-tooltip"></div>
                                                </div>

                                                
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="mb-2">
                            
                        </div>
                    <div class="separator mb-5"></div>
                    
                    <div class="list disable-text-selection" data-check-all="checkAll">

@if(count($ideas->toArray())>0)
                                @foreach($ideas as $key => $value)
                        <div class="card d-flex flex-row mb-3">
                            <div class="d-flex flex-grow-1 min-width-zero">
                                
                                <div
                                    class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center">
                                      
                                        <span class="align-middle d-inline-block w-30"><a href="{!!url('idea-details/'.$value->id)!!}">{!!$value->title!!}</a></span>
                                    
                                    <p class="mb-0 text-muted text-small  w-xs-100"></p>
                                    <p class="mb-0 text-muted text-small w-15 w-xs-100">Created By {!!$value->created_by!!}</p>
                                    <div class="w-15 w-xs-100">
                                       {!!$value->status_name!!}
                                    </div> <div class="w-15 w-xs-100">
                                      <i class="simple-icon-bubbles"></i> {!!ideacommentscount($value->id)!!} &nbsp; <i class="simple-icon-like"></i> {!!idealikescount($value->id)!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                                @endforeach
                                @else
                               <div
                                    class="card-body align-self-center d-flex flex-column flex-md-row justify-content-between min-width-zero align-items-md-center" style="height: 50px">
                                      <span class="align-middle d-inline-block w-50"><a href="{!!url('idea-details/')!!}"></a></span>
                                      
                                    
                                    <p class="mb-0 text-muted text-small w-50">No Record Found</p>
                                    
                                    </div>
                                </div>
                               @endif
                            </div>
                        </div>
                    </div> 
                
                </div>
            </div>
        </div>
<div class="app-menu">
            <div class="p-4 h-100">
                <div class="scroll">
                    <p class="text-muted text-small">Search</p>
                    {!! Form::open(array('url' => array($route_prefix.'/ideas'), 'class' =>'steamerstudio_searchform', 'name'=>'Search')) !!}

                            <div class="collapse d-md-block" id="displayOptions">
                            <div class="d-block d-md-inline-block">
                                
                                <div class="form-group">
                                    {!! Form::text('title', isset($_POST['title'])?trim($_POST['title']):null, array('class' => 'form-control',  'placeholder'=> getLabels('search_by_name')))!!}
                                </div>
                                 <div class="form-group">
                                   {!! Form::select('status', array('' => getLabels('all_status')) + $status, isset($_POST['status'])?$_POST['status']:null, array('class'=>'form-control'))!!}
                                </div>
                                <br>
                                <br>
                                 <div class="form-group">
                                  
                                   <button class="btn btn-outline-dark  mb-1" type="submit">{!! getLabels('Search') !!}</button>
                                   <a href="{!!url('ideas')!!}"><button class="btn btn-dark  mb-1" type="button">{!! getLabels('show_all') !!}</button></a>
                                </div>

                            </div>
                        </div>
                               
                            {!!Form::close()!!}
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

    </main>
@stop

