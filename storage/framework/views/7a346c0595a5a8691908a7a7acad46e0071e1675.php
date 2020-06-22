<?php if(Auth::check()): ?>
	<div class="modal fade modal-right" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><?php echo getLabels('Change_Password'); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php echo Form::open(array('url' => array($route_prefix.'/'.Auth::User()->uniq_username.'/change-password'), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'name'=>'Search')); ?>

					<?php echo Form::hidden("action_modal", "change-password", array("class"=>"form-control")); ?>

					<div class="modal-body">
						<div class="form-group  position-relative error-l-150">
							<label><?php echo getLabels('Current_Password'); ?></label>
							<?php echo Form::password("current_password", array("class"=>"form-control")); ?>

							<div class="invalid-tooltip"></div>
						</div>
						<div class="form-group  position-relative error-l-150">
							<label><?php echo getLabels('New_Password'); ?></label>
							<?php echo Form::password("new_password", array("class"=>"form-control")); ?>

							<div class="invalid-tooltip"></div>
						</div>

						<div class="form-group  position-relative error-l-150">
							<label><?php echo getLabels('Confirm_New_Password'); ?></label>
							<?php echo Form::password("confirm_new_password", array("class"=>"form-control")); ?>

							<div class="invalid-tooltip"></div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?php echo getLabels('Cancel'); ?></button>
						<button type="submit" class="btn btn-primary"><?php echo getLabels('Submit'); ?></button>
					</div>
				<?php echo Form::close(); ?>

			</div>
		</div>
	</div>
	
	<div class="modal fade bd-example-modal-lg" id="postLiveModal" tabindex="-1" role="dialog" aria-modal="true">
		<div class="modal-dialog modal-lg" style="padding-top:75px;">
			<?php echo Form::open(array('url' => array($route_prefix.'/'.Auth::User()->uniq_username.'/'.env('POSTS_SUFFIX')), 'class' =>'steamerstudio_form needs-validation tooltip-label-right', 'files' => true, 'id'=>'post_form', 'name'=>'Search')); ?>

				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title"><?php echo getLabels('Post_here'); ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body bg_input">
						<label class="form-group has-float-label mb-4">
							<?php echo Form::text('live_url', null, array("id" => "post_live_url", "class" => "form-control")); ?>

							<div class="invalid-tooltip"></div>
							<span><?php echo getLabels('URL_youtube_vimeo_mixer_twitch'); ?> </span>
						</label>
						
						<label class="form-group has-float-label mb-4">
							<?php echo Form::text('title', null, array("class" => "form-control")); ?>

							<div class="invalid-tooltip"></div>
							<span><?php echo getLabels('Title'); ?> (Optional)</span>
						</label>
						
						<label class="form-group position-relative has-float-label mb-4">
							<div  class="popup_gypy popup_gypy_commentbox popup_box giphy_boxcreatepost popup_gypy_pp" style="display:none;position:absolute;top:-260px;right:0;">
								<div class="form-group with-button is-empty" style="margin-bottom: 0px;">
									<?php echo Form::text('gifs', null, array("class"=>"form-control search_gif searchgiphy","rel"=>"", 'placeholder'=>getLabels('search_gifs').'...' )); ?>

									<span class="material-input"></span>
								</div>
								<div class="gif_box blue_side_bar">
									<ul class="giphys"></ul>
								</div>
							</div>
							<div class="emoji_pop_up fform "  rel="createpost" id="emoji_pop_upcreatepost" style="position: absolute;top: -328px; right: 0%;display:none;"></div>
						
							<div class="invalid-tooltip summernote_description"></div>
							<?php echo Form::textarea('description', null, array("class" => " form-control", "id" => "summernote_createpost" )); ?>

							<span><?php echo getLabels('Description'); ?></span>
						</label>
						
						<div class="form-row">
							<?php echo Form::hidden('who_can_see', 1, array('class' => 'who_can_see_input')); ?>

							<?php echo Form::hidden('subscription_level', 0, array('class' => 'subscription_level_input')); ?>

							<?php if(Auth::User()->is_complete_profile): ?>
								<label class="form-group has-float-label mb-6 position-relative error-l-40 col-md-6">
									<?php echo Form::text('scheduled_starttime', null, array('class' => 'input-sm form-control', "id"=>"start_date", 'placeholder'=> '')); ?>

									<div class="invalid-tooltip"></div>
									<span><?php echo getLabels('Schedule'); ?></span>
								</label>
								
								<label class="form-group has-float-label mb-6 position-relative error-l-40 col-md-6">
									<?php echo Form::select('who_can_see_sub_level', ['1'=>'public', '2' => 'Followers', '3'=>'Only Me', '4'=>'Level 1', '5'=>'Level 2', '6'=>'Level 3'], null, array('class' => 'who_can_see_sub_level input-lg form-control')); ?>

									<span><?php echo getLabels('Visible_to'); ?></span>
								</label>
							<?php else: ?>
								<label class="form-group has-float-label mb-6 position-relative error-l-40 col-md-6">
									<?php echo Form::text('scheduled_starttime', null, array('class' => 'input-sm form-control', "id"=>"start_date", 'placeholder'=> '')); ?>

									<div class="invalid-tooltip"></div>
									<span><?php echo getLabels('Schedule'); ?></span>
								</label>
								<label class="form-group has-float-label mb-6 position-relative error-l-40 col-md-6">
									<?php echo Form::select('who_can_see_sub_level', ['1'=>getLabels('public'), '2' => getLabels('followers'), '3'=>getLabels('only_me')], null, array('class' => 'who_can_see_sub_level input-lg form-control')); ?>

									<span><?php echo getLabels('Visible_to'); ?></span>
								</label>
							<?php endif; ?>
						</div>
						
						<div class="form-group">
							<a href="javascript:void(0)" class="btn btn-outline-dark" onclick="$('#pro-image').click()"><i class="simple-icon-picture"></i>&nbsp;&nbsp;<?php echo getLabels('Add_Images'); ?></a>
							<input type="file" accept='image/*' id="pro-image" name="pro-image[]" style="display: none;" class="form-control" multiple>
						</div>
						<div class="preview-images-zone hidden"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?php echo getLabels('Cancel'); ?></button>
						<button type="submit" class="btn btn-primary"><?php echo getLabels('Submit'); ?></button>
					</div>
				</div>
			<?php echo Form::close(); ?>

		</div>
	</div>
	
	<div class="modal fade bd-example-modal-lg" id="updatepostLiveModal" tabindex="-1" role="dialog" aria-modal="true">
		<div class="modal-dialog modal-lg" id="updatepostLiveModalDialog"  style="padding-top:75px;">>
		
		</div>
	</div>


	<div class="modal fade" id="showPostFiles" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="padding:.5rem 1.75rem 0 1.75rem;border-bottom:0;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="modalBodyPostFiles">
					 <div class="glide details">
						<div class="glide__track" data-glide-el="track">
							<ul class="glide__slides" id="glide_image_detail">
								 <li class="glide__slide"></li>
							</ul>
						</div>
					</div>
					<div class="glide thumbs">
						<div class="glide__track" data-glide-el="track">
							<ul class="glide__slides" id="glide_image_thumb">
								 <li class="glide__slide"> </li>
							</ul>
						</div>
						<div class="glide__arrows" data-glide-el="controls">
							<button class="glide__arrow glide__arrow--left" data-glide-dir="<"><i
									class="simple-icon-arrow-left"></i></button>
							<button class="glide__arrow glide__arrow--right" data-glide-dir=">"><i
									class="simple-icon-arrow-right"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
	<div class="modal fade modal-right" id="createGroupModal" tabindex="-1" role="dialog" aria-labelledby="createGroupModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><?php echo getLabels('Create_New_Group'); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php echo Form::open(array('url' => array($route_prefix.'/groups'), 'class' =>'steamerstudio_groupform needs-validation tooltip-label-right', 'name'=>'Search')); ?>

					<div class="modal-body">
						<div class="form-group  position-relative error-l-50">
							<label><?php echo getLabels('Name'); ?></label>
							<?php echo Form::text("name", null, array("class"=>"form-control")); ?>

							<div class="invalid-tooltip"></div>
						</div>
						<div class="form-group  position-relative error-l-50">
							<label><?php echo getLabels('Icon'); ?></label>
							<div class="slim" data-ratio="1:1" id="myCropper" data-size="150,150" data-instant-edit="true" style="height:120px;width:120px;"  data-label="<?php echo getLabels('Drop_your_icon_here'); ?>" data-min-size="120,120">
								<input type="file" name="image"/>
							</div>
							<div class="invalid-tooltip"></div>
						</div>
						<div class="form-group  position-relative error-l-50">
							<label><?php echo getLabels('Members'); ?></label><?php
							 $groupUsers  = allFollowersPluck(); ?>
							<?php echo Form::select('group_members[]', $groupUsers, null, array("class"=>"form-control select2-multiple", "multiple"=>"multiple", "data-width"=>"100%")); ?>

                            <div class="invalid-tooltip"></div>
						</div>
						<div class="form-group  position-relative error-l-50">
							<label><?php echo getLabels('Privacy'); ?></label>
							<?php echo Form::select("privacy", config('constants.GROUPPRIVACY'), null, array("class"=>"form-control")); ?>

							<div class="invalid-tooltip"></div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?php echo getLabels('Cancel'); ?></button>
						<button type="submit" class="btn btn-primary"><?php echo getLabels('Submit'); ?></button>
					</div>
				<?php echo Form::close(); ?>

			</div>
		</div>
	</div>
	
	<div class="modal fade modal-right" id="updateGroupModal" tabindex="-1" role="dialog" aria-modal="true">
		<div class="modal-dialog modal-lg" id="updateGroupModalDialog">
		
		</div>
	</div>
	
	<div class="modal fade modal-right h-100" style="height:100px;" id="shoGroupmembersModal" tabindex="-1" role="dialog" aria-labelledby="shoGroupmembersModal" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><?php echo getLabels('Group_Members'); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body ">
					
				</div>		
			</div>
		</div>
	</div>
	
	<div class="modal fade modal-right h-100" id="inviteMembersModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document" id="inviteMembersDialog">
			
		</div>
	</div>
	
	
	<div class="modal fade bd-example-modal-lg" id="SceduledEventModal" tabindex="-1" role="dialog" aria-modal="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"><?php echo getLabels('Scheduled_Post'); ?></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
				</div>
			</div>
		</div>
	</div>
	
		
		
	
		<div class="modal fade" id="showConfirmationModalsubscription" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalTitleSub"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="modalBodySub">
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary"
							data-dismiss="modal"><?php echo getLabels('No'); ?></button>
						<a href="javascript:void(0);" class="btn btn-primary" title="Confirm" id="confirmURLSub"><?php echo getLabels('Yes'); ?></a>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	
	<div class="modal fade" id="forceLoginModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Login Required !</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						To subscribe this plan, you should login first!
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo getLabels('Close'); ?></button>
						<a href="<?php echo url($route_prefix, 'login'); ?>" class="btn btn-primary steamerst_link" title="Login"><?php echo getLabels('login'); ?></a>
					</div>
				</div>
			</div>
		</div>