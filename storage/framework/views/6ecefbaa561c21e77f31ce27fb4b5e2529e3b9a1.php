<?php $__currentLoopData = $comments->reverse(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pcomments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="d-flex flex-row mb-4 border-bottom" id="pcomment<?php echo $pcomments->post_id.$pcomments->id; ?>">
		<a href="javascript:void(0);">
			<?php echo showImage($pcomments->User->photo, "img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall", "","", $pcomments->User->first_name, 'users/profile-photo'); ?>

		</a>
		<div class="pl-3" style="width:100%;position:relative;">
			<a href="<?php echo url($route_prefix.'/'.$pcomments->User->uniq_username); ?>" class="steamerst_link">
				<p class="font-weight-medium mb-0 "><?php echo $pcomments->User->first_name." ".$pcomments->User->last_name; ?></p>
				<p class="text-muted mb-0 text-small"><?php echo timeAgo($pcomments->created_at); ?></p>
			</a>
			<p class="mt-3 editablec" id="editable_comment<?php echo $pcomments->id; ?>">
				<span class="editable_text"><?php echo $pcomments->comment; ?></span>
			</p>
			<div id="giphyimgarea<?php echo $pcomments->post_id.'_'.$pcomments->id; ?>" class="position-relative"></div>
			<?php if($pcomments->giphy_image): ?>
				<p><img src="<?php echo $pcomments->giphy_image; ?>"  id="img_giphy<?php echo $pcomments->post_id.'_'.$pcomments->id; ?>"></p>
			<?php endif; ?>
			<div  class="popup_gypy popup_gypy_commentbox popup_box giphy_box<?php echo $pcomments->post_id.'_'.$pcomments->id; ?> popup_gypy_pp" style="display:none;position:absolute;top:-260px;right:0;">
				<div class="form-group with-button is-empty" style="margin-bottom: 0px;">
					<?php echo Form::text('gifs', null, array("class"=>"form-control search_gif searchgiphy","rel"=>"", 'placeholder'=>getLabels('search_gifs').'...' )); ?>

					<span class="material-input"></span>
				</div>
				<div class="gif_box blue_side_bar">
					<ul class="giphys"></ul>
				</div>
			</div>
			<div class="emoji_pop_up fform"  rel="<?php echo $pcomments->post_id.'_'.$pcomments->id; ?>" id="emoji_pop_up<?php echo $pcomments->post_id.'_'.$pcomments->id; ?>" style="position: absolute;top: -328px; right: 0%;display:none;"></div>
		</div>
		<div class="comment-likes" style="float:right;">
			<?php if(in_array(Auth::id(), array_column($pcomments->commentLikes->toArray(), 'user_id'))): ?>
				<span class="post-icon"><a href="javascript:void(0);" title="<?php echo getLabels('dislike'); ?>" class="like_comment text-primary" data-attr="<?php echo $pcomments->post_id; ?>" rel="<?php echo $pcomments->id; ?>"><span><?php echo $pcomments->TotalCommentLikes; ?> <?php echo $pcomments->TotalCommentLikes > 1?getLabels('likes'):str_singular(getLabels('likes')); ?></span> <i class="simple-icon-heart ml-2 text-primary"></i></a></span>
			<?php else: ?>
				<span class="post-icon"><a href="javascript:void(0);" title="<?php echo str_singular(getLabels('likes')); ?>" class="like_comment" data-attr="<?php echo $pcomments->post_id; ?>" rel="<?php echo $pcomments->id; ?>"><span><?php echo $pcomments->TotalCommentLikes; ?> <?php echo $pcomments->TotalCommentLikes > 1?getLabels('likes'):str_singular(getLabels('likes')); ?></span> <i class="simple-icon-heart ml-2"></i></a></span>
			<?php endif; ?>
			
			<?php if($pcomments->user_id == Auth::id()): ?>
				<div class="comments_updated_outer mt-4"><?php
					$remove_url =  url($route_prefix."/comment-remove/".base64_encode($pcomments->id)); ?>
					<div class="btn-group float-md-right mr-1 mb-1">
						<a class="" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo getLabels('action'); ?>">
							<div class="glyph-icon simple-icon-options font18"></div>
						</a>
						<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 26px, 0px);">
							<a class="dropdown-item update_my_comment" href="javascript:void(0);" rel="<?php echo $pcomments->post_id; ?>" data-link="<?php echo $pcomments->id; ?>" ><?php echo getLabels('update'); ?></a>
							<a class="dropdown-item" href="javascript:void(0);" onclick ='showConfirmationModal("<?php echo getLabels('remove'); ?>", "<?php echo getLabels('remove_comment_message'); ?>", "<?php echo $remove_url; ?>");'><?php echo getLabels('remove'); ?></a>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>