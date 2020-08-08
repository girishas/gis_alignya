{!! HTML::style('public/slimcropper/css/slim.css') !!}
    {!! HTML::style('public/slimcropper/css/style.css') !!}
    {!! HTML::script('public/slimcropper/js/slim.kickstart.min.js') !!}
<div class="modal" id="updatemember" role="dialog" >
    <div class="modal-dialog" style="max-width: 80%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Member</h5>
                <button type="button" class="close" id="updatememberhide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">  
                    	
                 {!! Form::model($data, array('url' => array($route_prefix.'/members/update/'.$data->id), 'class' =>'alignya_form needs-validation tooltip-label-right', 'name'=>'Search', 'files'=>true)) !!}
                       
                        <div class="form-row">
                            
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputFirstname">{!! getLabels('First Name') !!}</label>
                                {!! Form::text('first_name', null, array('class' => 'form-control', 'id' => 'inputFirstname',  'placeholder'=> ''))!!}
                                <div class="invalid-tooltip"></div>
                            </div>
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputLastname">{!! getLabels('last_name') !!}</label>
                                {!! Form::text('last_name', null, array('class' => 'form-control', 'id' => 'inputLastname',  'placeholder'=> ''))!!}
                                <div class="invalid-tooltip"></div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-40 col-md-6"><?php
                                $is_disabled  = !empty($data->email)?'readonly':""; ?>
                                <label for="inputEmail4">{!! getLabels('email') !!}</label>
                                {!! Form::text('email', null, array('class' => 'form-control', "id"=>"inputEmail4", 'placeholder'=> ''))!!}
                                <div class="invalid-tooltip"></div>
                            </div>
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputMobile">{!! getLabels('contact_number') !!}</label>
                                {!! Form::text('mobile', null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> ''))!!}
                                <div class="invalid-tooltip"></div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputMobile">{!! getLabels('Designation') !!}</label>
                                {!! Form::text('designation', null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> ''))!!}
                                <div class="invalid-tooltip"></div>
                            </div>
                            @if(Auth::User()->role_id == 2)
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputMobile">{!! getLabels('user_type') !!}</label>
                                {!! Form::select('role_id', config('constants.USER_TYPES'),null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> ''))!!}
                                <div class="invalid-tooltip"></div>
                            </div>
                            @endif
                        </div>
                        <div class="form-row">
                         
                            <div class="form-group  position-relative error-l-100 col-md-6">
                                <label for="inputMobile">{!! getLabels('status') !!}</label>
                                {!! Form::select('status', config('constants.STATUS'),null, array('class' => 'form-control', "id"=>"inputMobile", 'placeholder'=> ''))!!}
                                <div class="invalid-tooltip"></div>
                            </div>
                           
                        </div>
                         <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="">{!! getLabels('profile_picture') !!}</label>
                                <div class="slim" data-ratio="1:1" data-instant-edit="true" data-will-remove="profileimageWillBeRemoved">
                                    @if ( $data->photo and file_exists('public/upload/users/profile-photo/'. $data->photo) )
                                        {!! HTML::image('public/upload/users/profile-photo/'. $data->photo, $data->first_name) !!}
                                    @endif
                                    <input type="file" name="photo"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                        <button type="submit" class="btn btn-primary">{!! getLabels('update') !!}</button>&nbsp;&nbsp;
                        <a href="{!! url($route_prefix, 'users') !!}" class="btn btn-dark steamerst_link">{!! getLabels('back') !!}</a>
                        </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@include('Element/js/includejs')
<script type="text/javascript">
    $("#updatememberhide").click(function(){
        $("#updatemember").modal("hide");
    });
</script>