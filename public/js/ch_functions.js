io.on("message_received_group", function (data) {
	if(data.sender != myName && data.receiver == myName){
		
		moveToTop(data.group_id);
		senderInfo = JSON.parse(data.senderInfo);
		var html="";
		if(otherPersonName == data.group_id){
			html = messageHTML('received', data.message, senderInfo , 'Just Now');
			markasread( data.id);
		}else{
			unreadcounter(data.group_id, 'plus');
		}
		document.getElementById("messages").innerHTML += html;
		//document.getElementById("form-send-message").style.display = "";
		document.getElementById("messages").style.display = "";
		replaceHtml();
		$("#scrolle").animate({ scrollTop: $("#scrolle").prop('scrollHeight') - $("#scrolle").position().top }, "slow", function () {
			scrollToBottom();
		});
	}
});

function replaceHtml(){
	$.ajax({
		type:"GET",
		url: SITE_URL_BASE+'messageheader',
		success: function (response) {
			$('#headertopdiv').html(response);
			reIntializeDoreFunction();
		},
		error: function(xhr, ajaxOptions, thrownError) {
		  console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});

}
/* io.on('increase_header',function(data){ 
	alert(myName);
	alert(data.receiver);
	if(myName == data.receiver)
		var countMsgTotal = 0;
		if($('#totalUnreadMessage').text()){
			countMsgTotal = parseInt($('#totalUnreadMessage').text());
		}
		countMsgTotal++;
		if(countMsgTotal > 0){
			$('#totalUnreadMessage').css('opacity', 1);
		}else{
			$('#totalUnreadMessage').css('opacity', 0);
		}
		$('#totalUnreadMessage').text(countMsgTotal);
	}
}); */

io.on("message_received", function (data) {
	
	moveToTop(data.sender);
	var html="";
	if(otherPersonName == data.sender){
		html = messageHTML('received', data.message, 'Just Now');
		markasread( data.id);
	}else{
		unreadcounter(data.sender, 'plus');
	}
	document.getElementById("messages").innerHTML += html;
	//document.getElementById("form-send-message").style.display = "";
	document.getElementById("messages").style.display = "";
	if(data.sender != myName && data.receiver == myName){
		replaceHtml();
	}
	$("#scrolle").animate({ scrollTop: $("#scrolle").prop('scrollHeight') - $("#scrolle").position().top }, "slow", function () {
		scrollToBottom();
	});
	
});


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


function joingroup(type, member){
	$.ajax({
		type:"POST",
		url: SITE_URL_BASE+'join-group-request',
		data:'type='+type+'&member='+member,
		success: function (response) {
			if(response.type == 'success'){
				$('#headertoprequestdiv').html(response.html);
				$('#grtp'+member).remove();
				if(type == "1"){
					io.emit('new_notification', response.notification);
				}
				reIntializeDoreFunction();
			}
		}
	})
	
}
	
	$("body").on('click', ".joinagrp", function(e) {
		var grp_slug  = $(this).attr('rel');
		var elementC   =  $(this);
		$.ajax({
			type:"POST",
			url: SITE_URL_BASE+'join-group',
			data:'group='+grp_slug,
			success: function (response) {
				if(response.type == 'error'){
					errors = response.error;
					showNotificationApp('top', 'left', 'danger', 'Error', response.message);
				}else if(response.type == 'success'){
					elementC.html(response.btn_name);
					elementC.removeClass('joinagrp');
					showNotificationApp('top', 'right', 'primary', 'Success', response.message);
					io.emit('new_notification', response.notification);
					if(response.privacy == "1"){
						appendGroupHTML(response.group);
					}
				}
			},
			 error: function(xhr, ajaxOptions, thrownError) {
				showNotificationApp('top', 'left', 'danger', 'Error', "Something went Wrong.");
			}
		});
	});
	
	
	$("body").on('click', ".removegm", function(e) {
		var member  = $(this).attr('rel');
		var elementC   =  $(this);
		$.ajax({
			type:"POST",
			url: SITE_URL_BASE+'remove-member',
			data:'member='+member,
			success: function (response) {
				if(response.type == 'success'){
					elementC.closest('div.flex-row').remove();
					$('#maingm'+response.grp_slug).children('a').html(response.totalMember);
					json_members[response.grp_slug] = response.groupMembers;
					if(otherPersonName == response.grp_slug){
						$('.maingm').children('a').html(response.totalMember);
					}
				}
			},
			 error: function(xhr, ajaxOptions, thrownError) {
				showNotificationApp('top', 'left', 'danger', 'Error', "Something went Wrong.");
			}
		}); 
	});
	

	$("body").on('click', ".group_action", function(e) {
		var group  = $(this).attr('data-link');
		var action  = $(this).attr('data-action');
		var elementC   =  $(this);
		
		$.ajax({
			type:"POST",
			url: SITE_URL_BASE+'group-actions',
			data:'group='+group+'&action='+action,
			success: function (response) {
				if(response.type == 'success'){
					elementC.closest('div.chat_list_users').remove();
					if(otherPersonName == group){
						pageUrl = SITE_URL_BASE + 'groups';
						$.cergis.loadContent();
						e.preventDefault();
					}
				}
			},
			 error: function(xhr, ajaxOptions, thrownError) {
				showNotificationApp('top', 'left', 'danger', 'Error', "Something went Wrong.");
			}
		}); 
	});
	

	//update Group
	jQuery('body').on('click', '.invite_group_members', function(e) {
		
		var url_slug = $(this).attr('data-link');
		$.ajax({
			url: SITE_URL_BASE + "invite-frinds-mid/"+url_slug, 
			type: 'GET',
			success: function (response) {
				$('#inviteMembersModal').modal('show');
				$("#inviteMembersDialog").html(response.html);
				reloadFunction();
			}
		});
		
	});
	
	
	$("body").on('submit', ".steamerstudio_inviteform", function(e) {
		e.preventDefault();
		var form_action = $(this).attr('action');
		data = $(this).serialize();
		$.ajax({
			type:"POST",
			url: form_action,
			data:data,
			success: function (response) {
				if(response.type == 'error'){
					errors = response.error;
					showNotificationApp('top', 'left', 'danger', 'Error', response.message);
				}else if(response.type == 'success'){
					$('#inviteMembersModal').modal('hide');
					$('#inviteMembersDialog').html('');
					if(response.notification_count > 0){
						$.each(response.notifications, function(i, notification) {
							io.emit('new_notification', notification);
						});
					}
					showNotificationApp('top', 'right', 'primary', 'Success', response.message);
				}
			},
			 error: function(xhr, ajaxOptions, thrownError) {
				showNotificationApp('top', 'left', 'danger', 'Error', "Something went Wrong.");
			}
		});
	});
	
	
	//update Group
	jQuery('body').on('click', '.update_group', function(e) {
		var url_slug = $(this).attr('data-link');
		$.ajax({
			url: SITE_URL_BASE + "update-group/"+url_slug, 
			type: 'GET',
			success: function (response) {
				$('#updateGroupModal').modal('show');
				$("#updateGroupModalDialog").html(response.html);
				reloadFunction();
			}
		});
		
	});
	
	
	
	
	
	
	//create new group 
  
	$("body").on('submit', ".steamerstudio_groupform", function(e) {
		e.preventDefault();
		var form_action = $(this).attr('action');
		data = $(this).serialize();
		$.ajax({
			type:"POST",
			url: form_action,
			data:data,
			success: function (response) {
				if(response.type == 'error'){
					errors = response.error;
					$.each(errors, function(key,value) {
						$('input[name="'+key+'"]').next('div.invalid-tooltip').css('display', 'block');
						$('input[name="'+key+'"]').next('div.invalid-tooltip').html(value[0]);
						
					});
					showNotificationApp('top', 'left', 'danger', 'Error', response.message);
				}else if(response.type == 'success'){
					console.log(response.group);
					var group = response.group;
					gslug = group.slug;
					gimage = SITE_URL_BASE + "public/upload/groups/"+group.icon;
					gname = group.name;
					
					var membersT = " Members";
					if(response.totalMember <= 1){
						membersT = " Member";
					}
						
					if(response.action == 'update'){
						$('#updateGroupModal').modal('hide');
						$('#updateGroupModalDialog').html('');
						
						$('.userimage'+gslug).attr('src', gimage);
						$('#msguname'+gslug).html(gname);
						if(otherPersonName == gslug){
							$('.headingimage').children('img').attr('src', gimage);
							$('.headingname').html(gname);
						}
						showNotificationApp('top', 'right', 'primary', 'Success', response.message);
					}else{
						$("form.steamerstudio_groupform input").val("");
						$("form.steamerstudio_groupform select").val(1);
						$('form.steamerstudio_groupform .select2-multiple').val(null).trigger('change');
						$('#createGroupModal').modal('hide');
						showNotificationApp('top', 'right', 'primary', 'Success', response.message);
						if(response.notification_count > 0){
							$.each(response.notifications, function(i, notification) {
								io.emit('new_notification', notification);
							});
						}
						
						var html = "";
						html += '<div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3 chat_list_users" data-username="' + gslug + '" style="cursor:pointer;" onclick="onUserSelected(this);">';
						html += '<a class="d-flex" href="javascript:void(0);"><img alt="Profile Picture" src="'+gimage+'" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall userimage'+gslug+'"></a>';
						html += '<div class="d-flex flex-grow-1 min-width-zero"><div class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">';
						html += '<div class="min-width-zero"><a href="javascript:void(0);"> <p class=" mb-0 truncate" id="msguname'+gslug+'">'+gname+'</p></a>';
						html += '<p class="mb-1 text-muted text-small">'+response.totalMember + membersT+'</p>';
						html += '</div></div></div></div>';
						//document.getElementById("group_list").innerHTML += html;
						document.getElementById("group_list").innerHTML += response.group_html;
						$("#group_list").animate({ scrollTop: $("#group_list").prop('scrollHeight') - $("#group_list").position().top }, "slow", function () {
							//scrollToBottom();
						});
						json_members[gslug] = response.group_members;
						group_json[gslug] = group;
					}
					var cropper = new Slim(document.getElementById('myCropper'));
					// Destroy the cropper
					cropper.remove();
					
					
				}
			},
			 error: function(xhr, ajaxOptions, thrownError) {
				showNotificationApp('top', 'left', 'danger', 'Error', "Something went Wrong.");
			}
		});
	});
	
	
	
	function appendGroupHTML(group){
		console.log(group);
		var html = "";

		gslug = group.slug;
		gimage = SITE_URL_BASE + "public/upload/groups/"+group.icon;
		gname = group.name;
		var membersT = " Members";
		if(group.totalMember <= 1){
			membersT = " Member";
		}
		html += '<div class="d-flex flex-row mb-1 border-bottom pb-3 mb-3 chat_list_users" data-username="' + gslug + '" style="cursor:pointer;" onclick="onUserSelected(this);">';
		html += '<a class="d-flex" href="javascript:void(0);"><img alt="Profile Picture" src="'+gimage+'" class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall userimage'+gslug+'"></a>';
		html += '<div class="d-flex flex-grow-1 min-width-zero"><div class="pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">';
		html += '<div class="min-width-zero"><a href="javascript:void(0);"> <p class=" mb-0 truncate" id="msguname'+gslug+'">'+gname+'</p></a>';
		html += '<p class="mb-1 text-muted text-small">'+group.totalMember + membersT+'</p>';
		html += '</div></div></div></div>';
		document.getElementById("group_list").innerHTML += html;
		$("#group_list").animate({ scrollTop: $("#group_list").prop('scrollHeight') - $("#group_list").position().top }, "slow", function () {
			//scrollToBottom();
		});

	}