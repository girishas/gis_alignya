<div class="modal" id="viewmember" role="dialog" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title">View Member</h5> -->
                <button type="button" class="close" id="viewmemberhide" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                @if ($data->photo and file_exists('public/upload/users/profile-photo/'. $data->photo) )
                    <img alt="Profile" src="{!!url('public/upload/users/profile-photo/'. $data->photo)!!}" class="img-thumbnail card-img social-profile-img">                 
                @else
                    <img alt="Profile" src="{!!url('/img/no_images.png')!!}" class="img-thumbnail card-img social-profile-img">
                @endif

                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="text-center pt-4">
                                                <p class="list-item-heading pt-2">{!!$data->first_name.' '.$data->last_name!!}</p>
                                            </div>
                                            <p class="text-muted text-small mb-2">Email</p>
                                            <p class="mb-3">{!!$data->email!!}</p>

                                            <p class="text-muted text-small mb-2">Usertype</p>
                                            <p class="mb-3">
                                                {!!config('constants.USER_TYPES.'.$data->role_id)!!}
                                            </p>
                                            <p class="text-muted text-small mb-2">Contact</p>
                                            <p class="mb-3">
                                                {!!$data->mobile!!}
                                            </p>
                                            <p class="text-muted text-small mb-2">Designation</p>
                                            <p class="mb-3">
                                                {!!$data->designation!!}
                                            </p>
                                        </div>
                                    </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#viewmemberhide").click(function(){
        $("#viewmember").modal("hide");
    });
</script>