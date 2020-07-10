@extends('frontend/layouts/default')

@section('content')
	{!! HTML::style('public/slimcropper/css/slim.css') !!}
	{!! HTML::style('public/slimcropper/css/style.css') !!}
	{!! HTML::script('public/slimcropper/js/slim.kickstart.min.js') !!}
	<style>
		.app-menu{padding-bottom:60px;}
	</style>
	<main>
        <div class="container-fluid">
            <div class="row app-row">
                <div class="col-12 chat-app">
					<div class="d-flex flex-row justify-content-between mb-3 chat-heading-container hidden_0">
						<div class="d-flex flex-row chat-heading">
							<a class="d-flex headingimage" href="javascript:void(0);">
								@if($user)
									{!! showImage($user->photo, "img-thumbnail border-0 rounded-circle ml-0 mr-4 list-thumbnail align-self-center small", "","",$user->first_name, 'users/profile-photo') !!}
								@endif
							</a>
							<div class=" d-flex min-width-zero">
								<div
									class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
									<div class="min-width-zero">
										<a href="javascript:void(0);">
											<p class="list-item-heading mb-1 truncate headingname">@if($user)  {!! $user->first_name." ".$user->last_name !!} @endif</p>
										</a>
										<div id="mSpinner" class="spinner" style="opacity:0;"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="separator mb-5 hidden_0"></div>
					<?php /* <h1 class="align-self-center d-flex flex-column hidden_1 no_messageh1" style=""><i class="simple-icon-bubbles"></i> <br />Select a Conversation</h1> */ ?>
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
                    <a class="nav-link active steamerst_link" id="first-tab" href="{!! url($route_prefix.'/messages') !!}">{!! getLabels('messages') !!}</a>
                </li>
                <li class="nav-item w-50 text-center">
                    <a class="nav-link steamerst_link" id="second-tab" href="{!! url($route_prefix.'/groups') !!}">{!! getLabels('Groups') !!}</a>
                </li>
            </ul>

            <div class="p-4 h-100">
                <?php /* <div class="form-group">
                    <input type="text" class="form-control rounded" placeholder="Search">
                </div> */ ?>
                <div class="tab-content h-100">
                    <div class="tab-pane fade show active  h-100 mb-7" id="firstFull" role="tabpanel" aria-labelledby="first-tab">
                        <div class="scroll" id="messages_list">
							@if(!$data->isEmpty())
								@foreach($data as $val)
									
									<div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3 chat_list_users {!! (!empty($user->uniq_username) and $val->uniq_username == $user->uniq_username)?'active_chat':'' !!}" data-username="{!! $val->uniq_username !!}" style="cursor:pointer;" onclick="onUserSelected(this);">
										<a class="d-flex" href="javascript:void(0);">
											{!! showImage($val->photo, "img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall userimage".$val->uniq_username, "","",$val->first_name, 'users/profile-photo') !!}
										</a>
										<div class="d-flex flex-grow-1 min-width-zero">
											<div class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
												<div class="min-width-zero">
													<a href="javascript:void(0);">
														<p class=" mb-0 truncate" id="msguname{!! $val->uniq_username !!}">{!! $val->first_name." ".$val->last_name !!}</p>
													</a>
													<?php /* <div class="spinner spinner-side" style="opacity:0;" id="mSpinner{!! $val->uniq_username !!}"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div> */ ?>
												</div>
											</div>
											<span class="btn btn-xs btn-dark icon-button" id="countmsg{!! $val->uniq_username !!}" style="margin-left:10px;{!! ($val->Totalconversation > 0)?'':'display:none;' !!}">{!! $val->Totalconversation !!}</span>
										</div>
									</div>
								@endforeach
							@endif
                        </div>
                    </div>

                    <div class="tab-pane fade mb-7 h-100" id="secondFull" role="tabpanel" aria-labelledby="second-tab"  style="padding-bottom:70px;">
						<div class="border-bottom pb-3 mb-3">
							<a class="btn btn-block btn-outline-primary text-center" onclick="showCreateGroupModal()" href="javascript:void(0);">
								<i class="glyph-icon simple-icon-people"></i>&nbsp; {!! getLabels('Create_New_Group') !!}
							</a>
						</div>
                        <div class="scroll" id="group_list">

                            @if(!$my_grps->isEmpty())
								@foreach($my_grps as $my_grp)
									<div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3 chat_list_users" data-username="{!! $my_grp->slug !!}" style="cursor:pointer;" onclick="onUserSelected(this);">
										<a class="d-flex" href="javascript:void(0);">
											@if($my_grp->icon and file_exists('public/upload/groups/'.$my_grp->icon))
												{!! HTML::image('public/upload/groups/'.$my_grp->icon, $my_grp->name, array("class"=>"img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall userimage".$my_grp->slug)) !!}
											@endif
										</a>
										<div class="d-flex flex-grow-1 min-width-zero">
											<div class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
												<div class="min-width-zero">
													<a href="javascript:void(0);">
														<p class=" mb-0 truncate" id="msguname{!! $my_grp->slug !!}">{!! $my_grp->name !!}</p>
													</a>
													 <p class="mb-1 text-muted text-small">{!! $my_grp->totalMember !!} {!! $my_grp->totalMember > 1?getLabels('Members'):str_singular(getLabels('Members')) !!}</p>
													<?php /* <div class="spinner spinner-side" style="opacity:0;" id="mSpinner{!! $val->uniq_username !!}"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div> */ ?>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@endif
                          
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
				<input id="message" value="" class="form-control flex-grow-1" type="hidden" placeholder="{!! getLabels('say_something') !!}...">
				<div class="chat_text_area" data-text="Type your message here..." contenteditable="true"></div>
				
				<div class="position-relative" style="width:150px;bottom:-20px;">
					<a href="javascript:void(0);" rel="chatroom" class="btn btn-outline-primary icon-button openemojis" title="{!! getLabels('emojis') !!}">
						<i class="glyph-icon simple-icon-emotsmile"></i>
					</a>	
					<a href="javascript:void(0);" style="padding-top:4px;" rel="chatroom" class="btn btn-outline-primary icon-button opengiphy" title="{!! getLabels('post_a_gif') !!}">
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
						{!! Form::text('gifs', null, array("class"=>"form-control search_gif searchgiphy","rel"=>"", 'placeholder'=>getLabels('search_gifs').'...' )) !!}
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
		$otherPersonName = ($user)?$user->uniq_username:""; 
		$otherPersonFullname = ($user)?$user->first_name.' '.$user->last_name:""; 
		$otherPersonImage = ($user)? url('public/upload/users/profile-photo/'.$user->photo):""; ?>
	<script type="text/javascript">
		myName = "{!! Auth()->User()->uniq_username !!}";
		myFullname = "{!! Auth()->User()->first_name.' '.Auth()->User()->last_name !!}";
		myImage = "{!! url('public/upload/users/profile-photo/'.Auth()->User()->photo) !!}";
		
		var otherPersonName = "{!! $otherPersonName !!}";
		var otherPersonFullname = "{!! $otherPersonFullname !!}";
		var otherPersonImage = "{!! $otherPersonImage !!}";
		if(otherPersonName){
			getMessages();
			$('.hidden_0').removeClass('hidden_0');
		}
		enterName();
		var mypageUrl = SITE_URL+'messages';
		function reinit(){
			chat_type = "group";
			myName = "{!! Auth()->User()->uniq_username !!}";
			myFullname = "{!! Auth()->User()->first_name.' '.Auth()->User()->last_name !!}";
			myImage = "{!! url('public/upload/users/profile-photo/'.Auth()->User()->photo) !!}";
			otherPersonName = "{!! $otherPersonName !!}";
			otherPersonFullname = "{!! $otherPersonFullname !!}";
			otherPersonImage = "{!! $otherPersonImage !!}";
			
			mypageUrl = SITE_URL+'messages';
		}
		
		
		//getUsers();
		$('body').on('click', '.nav_link_chat', function(e){
			clicked_id  = $(this).attr('id');
			mypageUrl = SITE_URL+'messages';
			if(clicked_id == 'second-tab'){
				mypageUrl = SITE_URL+'groups';
			}
			window.history.pushState({ path: mypageUrl }, '', mypageUrl);
		});
		
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
						userimage = "{!! url('public/upload/users/profile-photo') !!}/"+users[a].photo;
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
				"receiver": otherPersonName,
				"message": message,
			});

			var html = "";
			html += messageHTML('sent', message, 'Just Now');
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
		
		/* io.on("message_received", function (data) {
			
			moveToTop(data.sender);
			var html="";
			if(otherPersonName == data.sender){
				html = messageHTML('received', data.message);
				markasread( data.id);
			}else{
				unreadcounter(data.sender, 'plus');
			}
			document.getElementById("messages").innerHTML += html;
			//document.getElementById("form-send-message").style.display = "";
			document.getElementById("messages").style.display = "";
			
			$("#scrolle").animate({ scrollTop: $("#scrolle").prop('scrollHeight') - $("#scrolle").position().top }, "slow", function () {
				scrollToBottom();
			});
			
		}); */
		  
	 

		function onUserSelected(self) {
			mypageUrl = SITE_URL+'messages';
			$('.hidden_0').removeClass('hidden_0');
			//document.getElementById("form-send-message").style.display = "";
			document.getElementById("messages").style.display = "";
			document.getElementById("messages").innerHTML = "";
			otherPersonName = self.getAttribute("data-username");
			
			pageUrl = mypageUrl+'/'+otherPersonName;
			window.history.pushState({ path: pageUrl }, '', pageUrl);
			otherPersonFullname = $("#msguname"+otherPersonName).html();
			$(".headingname").html(otherPersonFullname);
			$("#mSpinner").css('opacity', 0);
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
				url: server + "/get_messages",
				method: "POST",
				data: {
				  "sender": myName,
				  "receiver": otherPersonName
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
						unreadcounter( messages[a].sender, 'minus');
					}
					html += messageHTML(msgtype, messages[a].message, msgDateStr);
				  }

				  document.getElementById("messages").innerHTML = html;
				}
			});
		}
		
		
		function messageHTML(type, message, msgDateStr){
			var html = "";
			if(type == 'sent'){
				var floatclass = 'float-right';
				var musername  = myName;
				var muserfname  = myFullname;
				var muserimage  = myImage;
			}else{
				var floatclass = 'float-left';
				var musername  = otherPersonName;
				var muserfname  = otherPersonFullname;
				var muserimage  = otherPersonImage;
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
	  
		function unreadcounter(eleid, type){
			var countMsg = 0;
			var countMsgTotal = 0;
			if($('#totalUnreadMessage').text()){
				countMsgTotal = parseInt($('#totalUnreadMessage').text());
			}
			if($('#countmsg'+eleid).text()){
				countMsg = parseInt($('#countmsg'+eleid).text());
			}
			if(type == 'minus'){
				countMsg--;
				countMsgTotal--;
			}else{
				countMsg++;
				countMsgTotal++;
			}
			if(countMsgTotal > 0){
				$('#totalUnreadMessage').css('opacity', 1);
			}else{
				$('#totalUnreadMessage').css('opacity', 0);
			}
			$('#totalUnreadMessage').text(countMsgTotal);
			if(countMsg > 0){
				$('#countmsg'+eleid).show();
			}else{
				$('#countmsg'+eleid).hide();
			}
			
			$('#countmsg'+eleid).text(countMsg);
		}
	  
		$("body").on('keyup', ".chat_text_area", function(e) {
			var value_input = $.trim($(this).html());
			$('#message').val(value_input);
			//$('.spinner').show();
			io.emit('is_typing',{'type':'keypress','other_id':otherPersonName,'active_user':myName});
		});
		
		io.on('typing_start',function(data){ 
			if(myName == data.other_id) {
				if(data.active_user == otherPersonName) {
					$(".spinner").css("opacity", "1");
				}
			}
		});

	io.on('typing_stop',function(data){
		if(myName == data.other_id) {
			if(data.active_user == otherPersonName) {
				$(".spinner").css("opacity", "0");
			}
		}
	});

	  io.on("user_connected", function (username) {

		var html = "";
		html += '<div class="chat_list" data-username="' + username + '" onclick="onUserSelected(this);">';
			html += '<div class="chat_people">';
				html += '<div class="chat_img"> <img src="images/user-profile.png" alt="sunil"> </div>';
				html += '<div class="chat_ib">';
				  html += '<h5>' + username + '</h5>';
				html += '</div>';
			html += '</div>';
		html += '</div>';
		//document.getElementById("users").innerHTML += html;
	  });
	</script>
@stop