<?php $__env->startSection('content'); ?>
	<?php echo HTML::style('public/slimcropper/css/slim.css'); ?>

	<?php echo HTML::style('public/slimcropper/css/style.css'); ?>

	<?php echo HTML::script('public/slimcropper/js/slim.kickstart.min.js'); ?>

	<style>
		.app-menu{padding-bottom:60px;}
	</style>
	<main><?php
	$group_json = array(); 
	$group_json_members = array(); ?>
        <div class="container-fluid">
            <div class="row app-row">
                <div class="col-12">
                    <div class="mb-2">
                        <h1><?php echo getLabels('Groups'); ?></h1>
                    </div>

                    <div class="mb-2">
                       
                        <div class="collapse d-md-block" id="displayOptions">
							<div class="row">
								<div class="col-9">
									<div class="d-block d-md-inline-block">
										<?php echo Form::open(array('url' => array($route_prefix.'/discover-groups'), 'class' =>'steamerstudio_searchform searchinput', 'name'=>'Search')); ?>

											<?php echo Form::text('group_name', isset($_POST['group_name'])?trim($_POST['group_name']):null, array('placeholder'=> getLabels('Search').'...')); ?>

											<span class="search-icon" id="group_search">
												<i class="simple-icon-magnifier"></i>
											</span>
										<?php echo Form::close(); ?>

									</div>
								</div>
								<div class="col-3" style="text-align:right">
									<a href="<?php echo url($route_prefix.'/discover-groups'); ?>" class="btn btn-xs btn-outline-primary steamerst_link"><?php echo getLabels('see_all'); ?></a>
								</div>
							</div>
                        </div>
                    </div>
                    <div class="separator mb-5"></div>

                    <div class="list disable-text-selection">
						<div class="row" id="groups_mid_data">
							<?php echo $__env->make("Element/conversation/browse_groups", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						</div>
						<div class="ajax-load text-center" rel="1" style="display:none">
							<p><?php echo HTML::image('public/img/loader.gif', getLabels('loading').'...'); ?></p>
						</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="app-menu">
            <ul class="nav nav-tabs card-header-tabs ml-0 mr-0 mb-1" role="tablist">
                <li class="nav-item w-100 text-center">
                    <a class="nav-link active steamerst_link" id="second-tab" href="javascript:void(0);"><?php echo getLabels('groups_you_are_in'); ?></a>
                </li>
            </ul>

            <div class="p-4 h-100">
                <div class="tab-content h-100">
					<div class="tab-pane active fade show mb-7 h-100" id="secondFull" role="tabpanel" aria-labelledby="second-tab"  style="padding-bottom:70px;">
						<div class="border-bottom pb-3 mb-3">
							<a class="btn btn-block btn-outline-primary text-center" onclick="showCreateGroupModal()" href="javascript:void(0);">
								<i class="glyph-icon simple-icon-people"></i>&nbsp; <?php echo getLabels('Create_New_Group'); ?>

							</a>
						</div>
                        <div class="scroll" id="group_list">
							
                            <?php if(!$my_grps->isEmpty()): ?>
								<?php $__currentLoopData = $my_grps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $my_grp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php $group_json[$my_grp->slug]  = $my_grp;
										//$group_json_members[$my_grp->slug]  = $my_grp->groupMembers->toArray();
										$group_json_members[$my_grp->slug]  = $my_grp->groupMembers->toArray(); 
										//pr($group_json_members); die;
											 ?>
									<div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3 chat_list_users <?php echo (!empty($curgroup->slug) and $my_grp->slug == $curgroup->slug)?'active_chat':''; ?>" data-username="<?php echo $my_grp->slug; ?>">
										<a class="d-flex" href="javascript:void(0);">
											<?php if($my_grp->icon and file_exists('public/upload/groups/'.$my_grp->icon)): ?>
												<?php echo HTML::image('public/upload/groups/'.$my_grp->icon, $my_grp->name, array("class"=>"img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall userimage".$my_grp->slug)); ?>

											<?php endif; ?>
										</a>
										<div class="d-flex flex-grow-1 min-width-zero">
											<div class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
												<div class="min-width-zero">
													<a href="javascript:void(0);">
														<p class=" mb-0 truncate" id="msguname<?php echo $my_grp->slug; ?>"><?php echo $my_grp->name; ?></p>
													</a>
													 <p class="mb-1 text-muted text-small" id="maingm<?php echo $my_grp->slug; ?>">
														<a href="javascript:void(0);" onclick="openMembersModal('<?php echo $my_grp->slug; ?>')" title="<?php echo getLabels('click_to_see_all_the_members'); ?>">
														 <?php echo $my_grp->totalMember; ?> <?php echo $my_grp->totalMember > 1?getLabels('Members'):str_singular(getLabels('Members')); ?>

														</a>
													</p>
												</div>
											</div>
											<span class="btn btn-xs btn-dark icon-button" id="countmsg<?php echo $my_grp->slug; ?>" style="margin-left:10px;<?php echo ($my_grp->Totalconversation > 0)?'':'display:none;'; ?>"><?php echo $my_grp->Totalconversation; ?></span>
										</div>
										<div class="btn-group float-md-right mr-1 mb-1">
											<a class="" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo getLabels('action'); ?>">
												<div class="glyph-icon simple-icon-options"></div>
											</a>
											<?php if($my_grp->user_id == Auth::User()->uniq_username): ?> <?php
												$remove_url  = url('group-actions/'.$my_grp->slug);
												$remove_msg = getLabels('are_you_sure_you_want_to_remove_this_group'); ?>
												<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 26px, 0px);">
													<a class="dropdown-item update_group" href="javascript:void(0);" data-link="<?php echo $my_grp->slug; ?>"><?php echo getLabels('update_group'); ?></a>
													<?php if($my_grp->privacy == 3): ?>
														<a class="dropdown-item invite_group_members" href="javascript:void(0);" data-link="<?php echo $my_grp->slug; ?>"><?php echo getLabels('invite_members'); ?></a>
													<?php endif; ?>
													<a class="dropdown-item" href="javascript:void(0);" onclick='showConfirmationModalPost("<?php echo getLabels('remove'); ?>", "<?php echo $remove_msg; ?>", "<?php echo $remove_url; ?>", "<?php echo URL::current(); ?>");'><?php echo getLabels('remove_group'); ?></a>
												</div>
											<?php else: ?>
												<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 26px, 0px);">
													<a class="dropdown-item group_action" href="javascript:void(0);" data-link="<?php echo $my_grp->slug; ?>" data-action="leave"><?php echo getLabels('leave_group'); ?></a>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
                          
                        </div>

                    </div>
                </div>
            </div>

            <a class="app-menu-button d-inline-block d-xl-none" href="javascript:void(0);">
                <i class="simple-icon-options"></i>
            </a>
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
				loadMoreGroups(page);
			}
		});
		
		jQuery('body').on('click', '#group_search', function(e) {
			$('form.searchinput').submit();
		});
		myName   = "<?php echo Auth::User()->uniq_username; ?>";
		otherPersonName = "";
		var json_members = <?php echo json_encode($group_json_members); ?>;
		var group_json = <?php echo json_encode($group_json); ?>;
		function openMembersModal(meslug){
			var selected_members = json_members[meslug];
			var selected_grp 	 = group_json[meslug];
			var modalHtml = '<div class="list disable-text-selection">';
			$.each(selected_members, function(key, val) {
				var member_image = "<?php echo url('public/upload/users/profile-photo'); ?>/"+val.member_user.photo;
				modalHtml += '<div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3">';
				modalHtml += '<a class="d-flex" href="javascript:void(0);"><img alt="Profile Picture" src="'+member_image+'" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall"></a>';
				modalHtml += '<div class="d-flex flex-grow-1 min-width-zero"><div class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero" style="width:80%">';
				modalHtml += '<div class="min-width-zero"><a href="javascript:void(0);"> <p class=" mb-0 truncate">'+val.member_user.first_name+' '+val.member_user.last_name+'</p></a>';
				
				modalHtml += '</div></div>';
				
				if(selected_grp.user_id == myName && val.member_user.uniq_username != myName){
					modalHtml += '<div class="align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero" style="width:20%;float:right;"><a href="javascript:void(0);" class="btn btn-xs btn-outline-dark icon-button removegm" rel="'+val.id+'" style="height:25px;width:25px;line-height:25px;">X</a></div>';
				}
				modalHtml += '</div></div>';
				
				//modalHtml += '<p class="d-sm-inline-block mb-1"><a href="#"><span class="badge badge-pill badge-outline-primary mb-1">'+val.member_user.first_name+' '+val.member_user.last_name+'</span></a></p>';
			});
			modalHtml += "</div>";
			
			$('#shoGroupmembersModal .modal-body').html(modalHtml);
			$('#shoGroupmembersModal').modal('show');
		}
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>