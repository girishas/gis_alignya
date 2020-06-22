<?php $__env->startSection('content'); ?>
	<?php echo HTML::style('public/slimcropper/css/slim.css'); ?>

	<?php echo HTML::style('public/slimcropper/css/style.css'); ?>

	<?php echo HTML::script('public/slimcropper/js/slim.kickstart.min.js'); ?>

	<style>
		.app-menu{padding-bottom:60px;}
	</style><?php
	$group_json = array(); 
	$group_json_members = array(); ?>
	<main>
        <div class="container-fluid">
            <div class="row app-row">
                <div class="col-12 chat-app">
					<div class="d-flex flex-row justify-content-between mb-3 chat-heading-container hidden_0">
						<div class="d-flex flex-row chat-heading">
							<a class="d-flex headingimage" href="javascript:void(0);">
								<?php if($curgroup and $curgroup->icon and file_exists('public/upload/groups/'.$curgroup->icon)): ?>
									<?php echo HTML::image('public/upload/groups/'.$curgroup->icon, $curgroup->name, array("class"=>"img-thumbnail border-0 rounded-circle ml-0 mr-4 list-thumbnail align-self-center small")); ?>

								<?php endif; ?>
							</a>
							<div class=" d-flex min-width-zero">
								<div
									class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
									<div class="min-width-zero">
										<a href="javascript:void(0);">
											<p class="list-item-heading mb-1 truncate headingname"><?php echo $curgroup?$curgroup->name:""; ?></p>
										</a>
										 <p class="mb-1 text-muted text-small maingm"><?php if($curgroup): ?> <?php echo $curgroup->totalMember; ?> <?php echo $curgroup->totalMember > 1?getLabels('Members'):str_singular(getLabels('Members')); ?> <?php endif; ?></p>
										<div id="mSpinner" class="spinner" style="opacity:0;"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="separator mb-5 hidden_0" ></div>
					<?php /* <h1 style="padding-left:12%;font-size:500%;font-weight:800;text-align:center;"><i class="simple-icon-bubbles"></i> <br />Please Start a Chat</h1> */ ?>
                    <div class="scroll" id="scrolle">
                        <div class="scroll-content rounded" id="messages">
							
						</div>
						
                    </div>
					
					
                </div>
            </div>
        </div>

        <div class="app-menu">
            <ul class="nav nav-tabs card-header-tabs ml-0 mr-0 mb-1" role="tablist">
                <li class="nav-item w-50 text-center">
                    <a class="nav-link  steamerst_link" id="first-tab" href="<?php echo url($route_prefix.'/messages'); ?>"><?php echo getLabels('messages'); ?></a>
                </li>
                <li class="nav-item w-50 text-center">
                    <a class="nav-link active steamerst_link" id="second-tab" href="<?php echo url($route_prefix.'/groups'); ?>"><?php echo getLabels('Groups'); ?></a>
                </li>
            </ul>

            <div class="p-4 h-100">
                <?php /* <div class="form-group">
                    <input type="text" class="form-control rounded" placeholder="Search">
                </div> */ ?>
                <div class="tab-content h-100">
                    <div class="tab-pane fade    h-100 mb-7" id="firstFull" role="tabpanel" aria-labelledby="first-tab">
                        <div class="scroll" id="messages_list">
							
                        </div>
                    </div>

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
									<div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3 chat_list_users <?php echo (!empty($curgroup->slug) and $my_grp->slug == $curgroup->slug)?'active_chat':''; ?>" data-username="<?php echo $my_grp->slug; ?>" style="cursor:pointer;" onclick="onUserSelected(this);">
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
													<?php /* <div class="spinner spinner-side" style="opacity:0;" id="mSpinner{!! $val->uniq_username !!}"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div> */ ?>
												</div>
											</div>
											<span class="btn btn-xs btn-dark icon-button" id="countmsg<?php echo $my_grp->slug; ?>" style="margin-left:10px;<?php echo ($my_grp->Totalconversation > 0)?'':'display:none;'; ?>"><?php echo $my_grp->Totalconversation; ?></span>
										</div>
										<div class="btn-group float-md-right mr-1 mb-1">
											<a class="" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="<?php echo getLabels('Action'); ?>">
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
					
		<form onsubmit="return sendMessage();" id="form-send-message" class="hidden_0">
		
			<div class="chat-input-container d-flex justify-content-between align-items-center">
			
					<div id="giphyimgareachatroom" style="display:none;" class="position-absolute"></div>
					<div id="chatimagesouter" class="preview-images-zone position-absolute hidden" style="bottom:92px;width:auto;max-width:50%;background:#232223;border:none;padding:15px;"></div>
					<input type="hidden" name="giphy_image" id="giphy_imagechatroom">
				<input id="message" value="" class="form-control flex-grow-1" type="hidden" placeholder="<?php echo getLabels('say_something'); ?>...">
				<div class="chat_text_area" data-text="Type your message here..." contenteditable="true"></div>
				
				<div class="position-relative" style="width:150px;bottom:-20px;">
					<a href="javascript:void(0);" rel="chatroom" class="btn btn-outline-primary icon-button openemojis" title="<?php echo getLabels('emojis'); ?>">
						<i class="glyph-icon simple-icon-emotsmile"></i>
					</a>	
					<a href="javascript:void(0);" style="padding-top:4px;" rel="chatroom" class="btn btn-outline-primary icon-button opengiphy" title="<?php echo getLabels('post_a_gif'); ?>">
						<i class="material-icons">gif</i>
					</a>
					
					<?php /* for photoes
					<a href="javascript:void(0)" class="btn btn-outline-primary icon-button" onclick="$('#pro-image').click()"><i class="simple-icon-picture"></i></a>
					<input type="file" accept='image/*' id="pro-image" name="pro-image[]" style="display: none;" class="form-control" multiple>
					*/ ?>
				</div>
				<div>
					<button type="submit" class="btn btn-primary icon-button large" style="width:55px;height:55px;">
						<i class="simple-icon-arrow-right"></i>
					</button>
				</div>
				
				<div  class="popup_gypy popup_gypy_commentbox popup_box giphy_boxchatroom popup_gypy_pp popup_gypy_chat">
					<div class="form-group with-button is-empty" style="margin-bottom: 0px;">
						<?php echo Form::text('gifs', null, array("class"=>"form-control search_gif searchgiphy","rel"=>"", 'placeholder'=>getLabels('search_gifs').'...' )); ?>

						<span class="material-input"></span>
					</div>
					<div class="gif_box blue_side_bar">
						<ul class="giphys"></ul>
					</div>
				</div>
				<div class="emoji_pop_up fform show-spinner emoji_pop_up_chat"  rel="chatroom" id="emoji_pop_upchatroom">
					
				</div>
			</div>
			
		</form>
    </main><?php
		$otherPersonName = ($curgroup)?$curgroup->slug:""; 
		$otherPersonFullname = ($curgroup)?$curgroup->name:""; 
		$otherPersonImage = ($curgroup)? url('public/upload/groups/'.$curgroup->icon):""; ?>
	<script type="text/javascript">
		
		var chat_type = "group";
		var myName = "<?php echo Auth()->User()->uniq_username; ?>";
		var myFullname = "<?php echo Auth()->User()->first_name.' '.Auth()->User()->last_name; ?>";
		var myImage = "<?php echo url('public/upload/users/profile-photo/'.Auth()->User()->photo); ?>";
		var otherPersonName = "<?php echo $otherPersonName; ?>";
		var otherPersonFullname = "<?php echo $otherPersonFullname; ?>";
		var otherPersonImage = "<?php echo $otherPersonImage; ?>";
		if(otherPersonName){
			getMessages();
			$('.hidden_0').removeClass('hidden_0');
		}
		enterName();
		var mypageUrl = SITE_URL+'groups';
		
		function reinit(){
			
			chat_type = "group";
			myName = "<?php echo Auth()->User()->uniq_username; ?>";
			myFullname = "<?php echo Auth()->User()->first_name.' '.Auth()->User()->last_name; ?>";
			myImage = "<?php echo url('public/upload/users/profile-photo/'.Auth()->User()->photo); ?>";
			otherPersonName = "<?php echo $otherPersonName; ?>";
			otherPersonFullname = "<?php echo $otherPersonFullname; ?>";
			otherPersonImage = "<?php echo $otherPersonImage; ?>";
			
			mypageUrl = SITE_URL+'groups';
		}
		
		function getUsers(){
			var html = "";
			$.ajax({
				url: server + "/get_users",
				method: "POST",
				data: {'myname':myName},
				success: function (response) {
					var users = JSON.parse(response);
					var html = "";

					for (var a = 0; a < users.length; a++) {
						username = users[a].uniq_username;
						userimage = "<?php echo url('public/upload/users/profile-photo'); ?>/"+users[a].photo;
						userfullname = users[a].first_name+" "+users[a].last_name;
						html += '<div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3 chat_list_users" data-username="' + username + '" onclick="onUserSelected(this);">';
						html += '<a class="d-flex" href="javascript:void(0);"><img alt="Profile Picture" src="'+userimage+'" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall"></a>';
						html += '<div class="d-flex flex-grow-1 min-width-zero"><div class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">';
						html += '<div class="min-width-zero"><a href="javascript:void(0);"> <p class=" mb-0 truncate">'+userfullname+'</p></a>';
						html += '<p class="mb-1 text-muted text-small">14:20</p></div></div></div></div>';
					}
					document.getElementById("messages_list").innerHTML += html;
				}
			});
		}


	  function enterName() {
		io.emit("user_connected", myName);

		return false;
	  }

		function sendMessage() {
			var message = document.getElementById("message").value;
			var gif_image = document.getElementById("giphy_imagechatroom").value;
			if(!message && !gif_image){
				return false;
			}
			if(gif_image){
				gif_image  = '<div><img src="'+gif_image+'"></div>';
				message = gif_image + message;
			}
			document.getElementById("message").value = "";
			document.getElementById("giphy_imagechatroom").value = "";
			$('#giphyimgareachatroom').hide("");
			$('#giphyimgareachatroom').html("");
			
			$('.chat_text_area').html("");
			io.emit("send_message", {
				"sender": myName,
				"receiver": "",
				"group_id": otherPersonName,
				"message": message,
				"chat_type": chat_type,
			});

			var html = "";
			html += messageHTML('sent', message, '', 'Just Now');
			document.getElementById("messages").innerHTML += html;
			$("#scrolle").animate({ scrollTop: $("#scrolle").prop('scrollHeight') - $("#scrolle").position().top }, "slow", function () {
				scrollToBottom();
			});
			moveToTop(otherPersonName);
			return false;
		}
		
		
		
		function scrollToBottom() {
			setTimeout(function () {
				$("#scrolle").animate({ scrollTop: $("#scrolle").prop('scrollHeight') - $("#scrolle").position().top }, "slow");
			}, 500);
		}
		
		
		  
	 

		function onUserSelected(self) {
			//reinit();
			//document.getElementById("form-send-message").style.display = "";
			$('.hidden_0').removeClass('hidden_0');
			document.getElementById("messages").style.display = "";
			document.getElementById("messages").innerHTML = "";
			otherPersonName = self.getAttribute("data-username");
			mypageUrl = SITE_URL+'groups';
			pageUrl = mypageUrl+'/'+otherPersonName;
			window.history.pushState({ path: pageUrl }, '', pageUrl);
			otherPersonFullname = $("#msguname"+otherPersonName).html();
			$(".headingname").html(otherPersonFullname);
			$("#mSpinner").css('opacity', 0);
			totalMembers = $("#maingm"+otherPersonName).html();
			$(".maingm").html(totalMembers);
			
			$('.chat_list_users').removeClass('active_chat');
			$(self).addClass('active_chat');
			
			otherPersonImage  = $('.userimage'+otherPersonName).attr('src');
			var headingimage = '<img src="'+otherPersonImage+'" class="img-thumbnail border-0 rounded-circle ml-0 mr-4 list-thumbnail align-self-center small" alt="'+otherPersonFullname+'">';
			$('.headingimage').html(headingimage);
			getMessages();
			scrollToBottom();
		}
		
		
	
		
		function getMessages(){
		
			$.ajax({
				url: server + "/get_messages_group",
				method: "POST",
				data: {
					"sender": myName,
					"receiver": "",
					"group_id": otherPersonName,
					"chat_type": chat_type,
				},
				success: function (response) {
				  var messages = JSON.parse(response);
				 
				  var html = "";
					//alert(messages.length);
				  for (var a = 0; a < messages.length; a++) {
					var msgDate = new Date(messages[a].created_at);
					var msgDateStr = msgDate.getDate().toString().padStart(2, "0") + '/' + msgDate.getMonth().toString().padStart(2, "0") + '/' + msgDate.getFullYear().toString() + ' '+ msgDate.getHours().toString().padStart(2, "0") + ':' + msgDate.getMinutes().toString().padStart(2, "0");
					if (messages[a].sender == myName) {
						msgtype = "sent";
					} else {
						msgtype = "recieved";
						markasread( messages[a].id);
						unreadcounter( messages[a].group_id, 'minus');
					}
					html += messageHTML(msgtype, messages[a].message, messages[a], msgDateStr);
				  }

				  document.getElementById("messages").innerHTML = html;
				}
			});
		}
		
		
		function messageHTML(type, message, senderInfo, msgDateStr){
			var html = "";
			if(type == 'sent'){
				var floatclass = 'float-right';
				var musername  = myName;
				var muserfname  = myFullname;
				var muserimage  = myImage;
			}else{
				var floatclass = 'float-left';
				var musername  = senderInfo.uniq_username;
				var muserfname  = senderInfo.first_name+" "+senderInfo.last_name;
				var muserimage  = "<?php echo url('public/upload/users/profile-photo'); ?>/"+senderInfo.photo;
			}
			html += '<div class="card d-inline-block mb-3 '+floatclass+' mr-2">';
				   html += '<div class="position-absolute pt-1 pr-2 r-0">';
						html += '<span class="text-extra-small text-muted">'+msgDateStr+'</span>';
					html += '</div>';
				   html += '<div class="card-body">';
						html += '<div class="d-flex flex-row pb-2">';
							html += '<a class="d-flex" href="javascript:void(0);">';
								html += '<img alt="Profile Picture" src="'+muserimage+'" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall">';
							 html += '</a>';
							 html += '<div class=" d-flex flex-grow-1 min-width-zero">';
								 html += '<div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">';
									 html += '<div class="min-width-zero">';
										 html += '<p class="mb-0 truncate list-item-heading">'+muserfname+'</p>';
									 html += '</div>';
								 html += '</div>';
							 html += '</div>';
						 html += '</div>';

						 html += '<div class="chat-text-left">';
							 html += '<p class="mb-0 text-semi-muted">'+message+'</p>';
						 html += '</div>';
					 html += '</div>';
				 html += '</div>';
				html += '<div class="clearfix"></div>';
				return html;
		}
	  
		function moveToTop(userId) {
			if (userId == "") {
				$(".active_chat").each(function() {
					$(this).parent().prepend(this);
				});
			} else {
				$("div[data-username='" + userId + "']").each(function() {
					$(this).parent().prepend(this);
				});
			}
		}
	  
		function markasread(message_id){
			io.emit("read_message", {
				"message_id": message_id
			});
		}
	  
		
	  
		$("body").on('keyup', ".chat_text_area", function(e) {
			var value_input = $.trim($(this).html());
			$('#message').val(value_input);
			//$('.spinner').show();
			io.emit('is_typing',{'type':'keypress','other_id':otherPersonName,'active_user':myName});
		});
		
		io.on('typing_start',function(data){ 
			if(otherPersonName == data.other_id) {
				//if(data.active_user == otherPersonName) {
					$(".spinner").css("opacity", "1");
				//}
			}
		});

	io.on('typing_stop',function(data){
		if(otherPersonName == data.other_id) {
			//if(data.active_user == otherPersonName) {
				$(".spinner").css("opacity", "0");
			//}
		}
	});

	  io.on("user_connected", function (username) {

		var html = "";
		html += '<div class="chat_list" data-username="' + username + '" onclick="onUserSelected(this);">';
			html += '<div class="chat_people">';
				html += '<div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>';
				html += '<div class="chat_ib">';
				  html += '<h5>' + username + '</h5>';
				html += '</div>';
			html += '</div>';
		html += '</div>';
		//document.getElementById("users").innerHTML += html;
	  });
	  
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