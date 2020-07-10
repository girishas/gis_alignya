@if(!$posts->isEmpty())
@foreach($posts as $post)
	@if($post->postUser->id != Auth::id() and $post->subscription_level > 0)
		<?php $checkAlreadySubscribe  = checkAlreadySubscribe($post->postUser->id);
			if(!empty($checkAlreadySubscribe->level) and $checkAlreadySubscribe->level >= $post->subscription_level){
				$is_allowed_sub = true;
			}else{
				$is_allowed_sub = false;
			} ?>
	@else
		<?php $is_allowed_sub = true; ?>
	@endif
	<div class="card mb-4" id="postcard{!! base64_encode($post->id) !!}">
		<div class="card-body">
			<div class="row">
				<div class="col-10">
					<div class="d-flex flex-row mb-3">
						<a href="javascript:void(0);">
							{!! showImage($post->postUser->photo, "img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall", "","", $post->postUser->first_name, 'users/profile-photo') !!}
						</a>
						<div class="pl-3">
							<a href="{!! url($route_prefix.'/'.$post->postUser->uniq_username) !!}" class="steamerst_link">
								<div class="font-weight-medium mb-0 ">
									{!! $post->postUser->first_name." ".$post->postUser->last_name !!}
									<?php /* <div class="tooltipc">
										{!! $post->postUser->first_name." ".$post->postUser->last_name !!}
										<div class="tooltiptext">
											<div class="card ">
												<div class="row position-relative">
													<div class="col-12">
														{!! showImage($post->postUser->cover_photo, "card-img img-thumbnail", "100%","",$post->postUser->first_name, 'users/cover_photo') !!}
													</div>
													<a class="position-absolute" href="javascript:void(0);" style="top:25%">
														{!! showImage($post->postUser->photo, "img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center", "","", $post->postUser->first_name, 'users/profile-photo') !!}
													</a>
												</div>
												<div class="d-flex flex-row text-center mt-2">	
													<div class="d-flex flex-grow-1 min-width-zero">
														<div class="card-body">
															<div class="min-width-zero">
																<p class="list-item-heading mb-1 truncate">{!! $post->postUser->first_name." ".$post->postUser->last_name !!}</p>
																<p class="mb-2 text-muted text-small">{!! $post->postUser->city !!}{!! $post->postUser->state?", ".$post->postUser->state:"" !!}</p>
																<div class="">
																	<a href="{!! url($route_prefix.'/'.$post->postUser->uniq_username) !!}" class="steamerst_link btn btn-xs btn-outline-primary mr-2">{!! getLabels('profile') !!}</a>
																	
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div> */ ?>
								</div>
							</a>
							<p class="text-muted mb-0 text-small">{!! timeAgo($post->created_at) !!}</p>
						</div>
					</div>
				</div>
				@if(Auth::check() and $post->postUser->id == Auth::id()) <?php
					$remove_url =  url($route_prefix."/post-remove/".base64_encode($post->id));
					$remove_msg = getLabels('remove_post_message');?>
					<div class="col-2">
						<div class="btn-group float-md-right mr-1 mb-1">
							<a class="" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="{!! getLabels('action') !!}">
								<div class="glyph-icon simple-icon-options font24"></div>
							</a>
							<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 26px, 0px);">
								<a class="dropdown-item update_my_post" href="javascript:void(0);" data-link="{!! base64_encode($post->id) !!}" >{!! getLabels('update_post') !!}</a>
								<a class="dropdown-item" href="javascript:void(0);" onclick ='showConfirmationModalPost("<?php echo getLabels('remove'); ?>", "{!! $remove_msg !!}", "{!! $remove_url !!}", "{!! URL::current() !!}");'>{!! getLabels('remove_post') !!}</a>
							</div>
						</div>
					</div>
				@endif
			</div>
			<h4>{!! $post->title !!}</h4>
			@if($is_allowed_sub)
				<p>
					{!! $post->description !!}
				</p>
				@if($post->live_url) <?php 
					/* $videoId  = "5Qlg4VQQUT4";
					$headers = get_headers('http://gdata.youtube.com/feeds/api/videos/' . $videoId);
					echo "<pre>"; print_r($headers); die; */
					$type_of_video = getfiletype($post->live_url);
					$twitchChat = twitchChat($post->live_url); ?>
					<div class="position-relative mb-3">
						<iframe rel=0 class="video-js card-img video-content video_iframe" frameborder="0" allowfullscreen="false"
								src="{!! getPlayVideoURL($post->live_url) !!}">
						</iframe>
						@if($type_of_video == 'twitch' || $type_of_video == 'twitch_clips' || $type_of_video == 'twitch_video')	
							<a href="javascript:void(0);" chat_link="{!! $twitchChat !!}" class="twitch_chat_btn btn btn-block btn-md btn-outline-dark">{!! getLabels('start_twitch_chat') !!}</a>
						@elseif($type_of_video == 'mixer')
							<a href="javascript:void(0);" chat_link="{!! $twitchChat !!}" class="twitch_chat_btn btn btn-block btn-md btn-outline-dark">{!! getLabels('start_mixer_chat') !!}</a>
						@elseif($type_of_video == 'youtube_gaming')
							<a href="javascript:void(0);" chat_link="{!! $twitchChat !!}" class="twitch_chat_btn btn btn-block btn-md btn-outline-dark">{!! getLabels('start_youtube_chat') !!}</a>
						@elseif($type_of_video == 'youtube')
							<a href="javascript:void(0);" chat_link="{!! $twitchChat !!}" class="twitch_chat_btn btn btn-block btn-md btn-outline-dark">{!! getLabels('start_youtube_chat') !!}</a>
						@endif
						@if($type_of_video == 'twitch' || $type_of_video == 'twitch_clips' || $type_of_video == 'twitch_video' || $type_of_video == 'mixer' || $type_of_video == 'youtube_gaming' || $type_of_video == 'youtube')
							<div class="twitch_chat hide_element" style="margin-top:10px;">
								<iframe class="twitch_chat_iframe" src="" frameborder="0" scrolling="no" height="500" width="100%"></iframe>
							</div>
						 @endif
					</div>
				@endif
				@include("frontend/posts/images")
			@else
				<div class="position-relative mb-3">
					<iframe rel=0 class="video-js card-img video-content video_iframe" frameborder="0" allowfullscreen="false"
								src="">
					</iframe>
					<div class="position-absolute" style="top:25%;left:25%;right:25%;bottom:25%;">
						<div class="card">
							<div class="card-body text-center">
								<h4>{!! getLabels('locked_post_message') !!}</h4>
								<a href="{!! url($post->postUser->uniq_username.'/subscriptions') !!}" class="btn btn-outline-primary mt-1 mb-1 steamerst_link">{!! str_replace(array('{LEVEL}'), array($post->subscription_level), getLabels('subscribe_level_plan')) !!}</a>
							</div>
						</div>
					</div>
				</div>
			@endif	
				<div>
					@if($is_allowed_sub)
						@if(in_array(Auth::id(), array_column($post->postLike->toArray(), 'user_id')))
							<div class="post-icon mr-3 d-inline-block text-primary">								
								<a href="javascript:void(0);" title="{!! getLabels('dislike') !!}" class="like_post" rel="{!! $post->id !!}"><i class="simple-icon-heart mr-1 text-primary"></i></a> 
								<span>{!! $post->toTallike !!} {!! $post->toTallike > 1?getLabels('likes'):str_singular(getLabels('likes')) !!}</span>
							</div>
						@else
							<div class="post-icon mr-3 d-inline-block ">
								<a href="javascript:void(0);" title="{!! str_singular(getLabels('likes')) !!}" class="like_post" rel="{!! $post->id !!}"><i class="simple-icon-heart mr-1"></i></a> 
								<span>{!! $post->toTallike !!} {!! $post->toTallike > 1?getLabels('likes'):str_singular(getLabels('likes')) !!}</span>
							</div>
						@endif
					@else
						<div class="post-icon mr-3 d-inline-block ">
							<i class="simple-icon-heart mr-1"></i>
							<span>{!! $post->toTallike !!} {!! $post->toTallike > 1?getLabels('likes'):str_singular(getLabels('likes')) !!}</span>
						</div>
					@endif
					<div class="post-icon d-inline-block" id="pst_cmt_cnt{!! $post->id !!}"><i class="simple-icon-bubble mr-1"></i> <span>{!! $post->totalcomment !!} {!! $post->totalcomment > 1?getLabels('comments'):str_singular(getLabels('comments')) !!}</span></div>
				</div>
			

			<div class="mt-5">
				<?php $loadstyle = "display:none;"; ?>
				@if($post->totalcomment > count($post->postComments))
						<?php $loadstyle = ""; ?>
				@endif
				<div id="load_more_{!!$post->id!!}" class="loadmorebtn text-center" style="{!! $loadstyle !!}">
					<a href="javascript:void(0);" rel="{!! $post->id !!}" data-attr="1" id="load_more_link{!! $post->id !!}" class="btn btn-xs btn-outline-dark mb-4 load_more_link" title="LoadMoreComments">{!! getLabels('load_more_comments') !!}</a>
				</div>
				<div id="commentslist{!! $post->id !!}" class="commentslist"><?php
					$allmycomments  = $post->postComments->reverse(); ?>
					@foreach($allmycomments as $pcomments)
						<div class="d-flex flex-row mb-4 border-bottom" id="pcomment{!!  $post->id.$pcomments->id !!}">
							<a href="javascript:void(0);">
								{!! showImage($pcomments->User->photo, "img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall", "","", $pcomments->User->first_name, 'users/profile-photo') !!}
							</a>
							<div class="pl-3" style="width:100%;position:relative;">
								<a href="{!! url($route_prefix.'/'.$pcomments->User->uniq_username) !!}" class="steamerst_link">
									<p class="font-weight-medium mb-0 ">{!! $pcomments->User->first_name." ".$pcomments->User->last_name !!}</p>
									<p class="text-muted mb-0 text-small">{!! timeAgo($pcomments->created_at) !!}</p>
								</a>
								<p class="mt-3 editablec" id="editable_comment{!! $pcomments->id !!}" style="position:relative;">
									<span class="editable_text">{!! $pcomments->comment !!}</span>
								</p>
								<div id="giphyimgarea{!! $post->id.'_'.$pcomments->id !!}" class="position-relative"></div>
								@if($pcomments->giphy_image)
									<p><img src="{!! $pcomments->giphy_image !!}" alt="{!! $post->title !!}" id="img_giphy{!! $post->id.'_'.$pcomments->id !!}"></p>
								@endif
								<div  class="popup_gypy popup_gypy_commentbox popup_box giphy_box{!! $post->id.'_'.$pcomments->id !!} popup_gypy_pp" style="display:none;position:absolute;top:-260px;right:0;">
									<div class="form-group with-button is-empty" style="margin-bottom: 0px;">
										{!! Form::text('gifs', null, array("class"=>"form-control search_gif searchgiphy","rel"=>"", 'placeholder'=>getLabels('search_gifs').'...' )) !!}
										<span class="material-input"></span>
									</div>
									<div class="gif_box blue_side_bar">
										<ul class="giphys"></ul>
									</div>
								</div>
								<div class="emoji_pop_up fform "  rel="{!! $post->id.'_'.$pcomments->id !!}" id="emoji_pop_up{!! $post->id.'_'.$pcomments->id !!}" style="position: absolute;top: -328px; right: 0%;display:none;"></div>
								
							</div>
							
							
							
							<div class="comment-likes"  style="float:right;">
								@if($is_allowed_sub)
									@if(in_array(Auth::id(), array_column($pcomments->commentLikes->toArray(), 'user_id')))
										<span class="post-icon"><a href="javascript:void(0);" title="{!! getLabels('dislike') !!}" class="like_comment text-primary" data-attr="{!! $post->id !!}" rel="{!! $pcomments->id !!}"><span>{!! $pcomments->TotalCommentLikes !!} {!! $pcomments->TotalCommentLikes > 1?getLabels('likes'):str_singular(getLabels('likes')) !!}</span> <i class="simple-icon-heart ml-2 text-primary"></i></a></span>
									@else
										<span class="post-icon"><a href="javascript:void(0);" title="{!! str_singular(getLabels('likes')) !!}" class="like_comment" data-attr="{!! $post->id !!}" rel="{!! $pcomments->id !!}"><span>{!! $pcomments->TotalCommentLikes !!} {!! $pcomments->TotalCommentLikes > 1?getLabels('likes'):str_singular(getLabels('likes')) !!}</span> <i class="simple-icon-heart ml-2"></i></a></span>
									@endif
								@else
									<span class="post-icon"><span>{!! $pcomments->TotalCommentLikes !!} {!! $pcomments->TotalCommentLikes > 1?getLabels('likes'):str_singular(getLabels('likes')) !!}</span> <i class="simple-icon-heart ml-2"></i></span>
								@endif
								@if($pcomments->user_id == Auth::id())
									<div class="comments_updated_outer mt-4 "><?php
										$remove_url =  url($route_prefix."/comment-remove/".base64_encode($pcomments->id));
										$remove_msg = getLabels('remove_comment_message'); ?>
										<div class="btn-group float-md-right mr-1 mb-1">
											<a class="" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="{!! getLabels('action') !!}">
												<div class="glyph-icon simple-icon-options font18"></div>
											</a>
											<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 26px, 0px);">
												<a class="dropdown-item update_my_comment" href="javascript:void(0);" rel="{!! $post->id !!}" data-link="{!! $pcomments->id !!}" >{!! getLabels('update') !!}</a>
												<a class="dropdown-item" href="javascript:void(0);" onclick ='showConfirmationModal("<?php echo getLabels('remove'); ?>", "{!! $remove_msg !!}", "{!! $remove_url !!}");'>{!! getLabels('remove') !!}</a>
											</div>
										</div>
									</div>
								@endif
							</div>
						</div>
					@endforeach
				</div>

				@if(Auth::check())
					<div class="comment-contaiener" style="position:relative;">
						{!! Form::open(array('url' => array('post_comment'), 'class'=>'stcomment_form needs-validation tooltip-label-right', 'id'=>'stcomment_form'.$post->id)) !!}
							<input type="hidden" name="giphy_image" id="giphy_image{!! $post->id !!}">
							<div class="input-group">
								<input type="hidden" id="post_comment_input{!! $post->id !!}" class="form-control" name="post_comment" placeholder="{!! getLabels('add_a_comment') !!}" autocomplete="off" style="border-right:0px;">
								<div class="comment_text_area" rel="{!! $post->id !!}" contenteditable="true"> </div>
								<div class="invalid-tooltip" id="invalid-tooltip{!! $post->id !!}"></div>
								<span class="input-group-text input-group-append input-group-addon" style="border-radius:0px;padding: 2rem .75rem 0rem .75rem;border-left:0px;border-right:0px;">
									<a href="javascript:void(0);" rel="{!! $post->id !!}" class="openemojis" title="{!! getLabels('emojis') !!}">
										<i class="glyph-icon simple-icon-emotsmile"></i>
									</a>
								</span>
								<span class="input-group-text input-group-append input-group-addon" style="border-radius:0px;padding: 2rem .5rem 0rem 0rem;border-left:0px;">
									<a href="javascript:void(0);" rel="{!! $post->id !!}" class="opengiphy" title="{!! getLabels('post_a_gif') !!}">
										<i class="material-icons" style="padding-bottom:0px;">gif</i>
									</a>
								</span>
								<input type="hidden" name="post_id" value="{!! $post->id !!}">
								<div class="input-group-append">
									@if($is_allowed_sub)
										<button class="btn btn-secondary " type="submit"><i class="simple-icon-arrow-right ml-2"></i></button>
									@else
										<button class="btn btn-secondary " type="button" onclick="showNotificationApp('top', 'right', 'warning', '<?php echo getLabels('error'); ?>!', '<?php echo getLabels('locked_post_message'); ?>');"><i class="simple-icon-arrow-right ml-2"></i></button>
									@endif
								</div>
							</div>
							<?php /* <div class="spinner d-inline-block">
										<div class="bounce1"></div>
										<div class="bounce2"></div>
										<div class="bounce3"></div>
									</div> */ ?>
							
						{!! Form::close() !!}
						<div  class="popup_gypy popup_gypy_commentbox popup_box giphy_box{!! $post->id !!} popup_gypy_pp" style="display:none;position:absolute;top:-310px;right:0%;">
								<div class="form-group with-button is-empty" style="margin-bottom: 0px;">
									{!! Form::text('gifs', null, array("class"=>"form-control search_gif searchgiphy","rel"=>"", 'placeholder'=>getLabels('search_gifs').'...' )) !!}
									<span class="material-input"></span>
								</div>
								<div class="gif_box blue_side_bar">
									<ul class="giphys"></ul>
								</div>
							</div>
							<div class="emoji_pop_up fform show-spinner"  rel="{!! $post->id !!}" id="emoji_pop_up{!! $post->id !!}" style="position: absolute;top:-378px; right:0%;display:none;">
								
							</div>
							
							<?php /* <div class="emoji_pop_up fform show-spinner"  rel="{!! $post->id !!}" id="emoji_pop_up{!! $post->id !!}" style="position: absolute; float: right; margin-top: -378px; right: 25px; top: 0px;display:none;">
								
							</div> */ ?>
						<div id="giphyimgarea{!! $post->id !!}" class="position-relative"></div>
					</div>
				@endif
			</div>
		</div>
	</div>
@endforeach
@endif