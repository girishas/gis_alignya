@extends('frontend/layouts/default')

@section('content')
	<main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="first" role="tabpanel" aria-labelledby="first-tab">
                            <div class="row">
                                <div class="offset-md-2 col-md-8 col-right">
									@if(!$slug)
										<div class="card mb-4">
											<div class="card-body">
												<div class="d-flex justify-content-between align-items-center" style="position:relative;">
													<textarea class="form-control flex-grow-1" placeholder="Say something..." style="resize:none;" onclick="openPostModal();"></textarea>
													<div style="position:absolute;right:10px;" onclick="openPostModal();">
														{!! showImage(Auth::User()->photo, "img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall", "","", Auth::User()->first_name, 'users/profile-photo') !!}
													</div>
												</div>
											</div>
										</div>
									@endif
									<div id="post-data">
										@include("frontend/posts/post_mid")
									</div>
									@if(!$slug)
										<div class="ajax-load text-center" rel="1" style="display:none">
											<p>{!! HTML::image('public/img/loader.gif', getLabels('loading').'...') !!} {!! getLabels('loading') !!}</p>
										</div>
									@endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
	
	<script type="text/javascript">
		var page = 1;
		$(window).scroll(function() {
			if($(window).scrollTop() + $(window).height() >= $(document).height()) {
				if($('.ajax-load').attr('rel') == 1){
					page = 1;
				}
				page++;
				$('.ajax-load').attr('rel', page);
				loadMoreData(page);
			}
		});
	</script>
@stop