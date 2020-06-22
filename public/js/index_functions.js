jQuery(document).ready(function(){
	
	

	jQuery('#summernote_createpost').summernote({
		height: 100,
		popover: {
			image: [],
			link: [],
			air: []
		},
		toolbar: [
			['font', ['bold', 'underline', 'italic', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['insert', ['picture']],
			['mybutton', ['emojis', 'giphys']],
		],
		 buttons: {
			emojis: emojisButton,
			giphys: giphyButton,
		  }
	});
	
	jQuery('.summernote').summernote({
		height: 100,
		popover: {
			image: [],
			link: [],
			air: []
		},
		toolbar: [
			['font', ['bold', 'underline', 'italic', 'clear']],
			// ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['insert', ['picture']],
		],
	});
	
	
	jQuery('body').on('change', '.who_can_see_sub_level', function(e) {
		var selectedval  = $(this).val();
		selectedval = parseInt(selectedval);
		if(selectedval >= 4){
			$('.who_can_see_input').val(1);
			$('.subscription_level_input').val(selectedval - 3);
		}else{
			$('.who_can_see_input').val(selectedval);
			$('.subscription_level_input').val(0);
		}
	
	});
	
	
	jQuery('body').on('click', '.changeLang', function(e) {
		var langhtml  = $(this).html();
		$('#headerLang').html(langhtml);
		var langrel  = $(this).attr('rel');
		$.ajax({
			url: SITE_URL_BASE+'system-lang',
			type: "POST",
			data: "lang="+langrel,
			dataType :'json',
			beforeSend: function(){
				$('body').addClass('show-spinner');
			}
		}).done(function(response){
			if(response.type == 'success'){
				jQuery('#main-content-navigation').html(response.header);
				jQuery('#main-content-navigation').append(response.navigation);
				pageUrl = window.location;
				new $.dore(this);
				$.cergis.loadContent();
				e.preventDefault();
				$('body').removeClass('show-spinner');
			}
			
	    }).fail(function(jqXHR, ajaxOptions, thrownError){
	       $('body').removeClass('show-spinner');
	    });
	});
	
	/* https://miamarti.github.io/Material-DateTimePicker/app/ 
		https://designlink.work/en-US/bootstrap-material-datepicker/
		*/
	jQuery('#start_date,#start_date_update').bootstrapMaterialDatePicker({ 
		format : 'YYYY-MM-DD H:mm:ss', 
		minDate: moment(),
		shortTime:false,
		switchOnClick:true,
		autoClose:true
	});
	
	//update comment
	jQuery('body').on('click', '.update_my_comment', function(e) {
		$('.editable_form').remove();
		$('.editable_text').show();
		var url_slug = $(this).attr('data-link');
		var post_id = $(this).attr('rel');
		var comment = $("#editable_comment"+url_slug).children('span.editable_text').html();
		$("#editable_comment"+url_slug).children('span.editable_text').hide();
		var form_html  = '<span class="editable_form"><form method="POST" action="javascript:void(0);" accept-charset="UTF-8" class="stcomment_form needs-validation tooltip-label-right" id="stcomment_form'+post_id+'_'+url_slug+'">';
		form_html  += '<div class="comment-contaiener"><input type="hidden" name="giphy_image" id="giphy_image'+post_id+'_'+url_slug+'">';
		form_html  += '<div class="input-group"><input type="hidden" id="post_comment_input'+post_id+'_'+url_slug+'" class="form-control" name="post_comment"><div style="" class="comment_text_area" rel="'+post_id+'_'+url_slug+'" contenteditable="true">'+$.trim(comment)+'</div><div class="invalid-tooltip" id="invalid-tooltipc'+url_slug+'" ></div><input type="hidden" name="post_id" value="'+post_id+'"><input type="hidden" name="comment_id" value="'+url_slug+'">';
		form_html  += '<span class="input-group-text input-group-append input-group-addon" style="border-radius:0px;padding: 2rem .75rem 0rem .75rem;border-left:0px;border-right:0px;"><a href="javascript:void(0);" rel="'+post_id+'_'+url_slug+'" class="openemojis" title="Emojis"><i class="glyph-icon simple-icon-emotsmile"></i></a></span>';
		form_html  += '<span class="input-group-text input-group-append input-group-addon" style="border-radius:0px;padding: 2rem .5rem 0rem 0rem;border-left:0px;"><a href="javascript:void(0);" rel="'+post_id+'_'+url_slug+'" class="opengiphy" title="Post a GIF"><i class="material-icons" style="padding-bottom:0px;">gif</i></a></span>';
		form_html  += '<div class="input-group-append"><button class="btn btn-secondary" type="submit"><span class="d-inline-block"></span> <i class="simple-icon-arrow-right ml-2"></i></button></div></div></div></form></span>';
		$("#editable_comment"+url_slug).append(form_html);
		$('#post_comment_input'+post_id+'_'+url_slug).val(comment);
	});
	
	
	var elempm = document.getElementById('pro-image');
	if(typeof elempm !== 'undefined' && elempm !== null) {
		elempm.addEventListener('change', readImage, false);
	}
	jQuery( ".preview-images-zone" ).sortable();
	
	jQuery(document).on('click', '.image-cancel', function() {
		let no = $(this).data('no');
		$(".preview-image.preview-show-"+no).remove();
		var numItems = $('.image-zone').length;
		if(numItems == 0){
			$( ".preview-images-zone" ).addClass('hidden');
		}
	});
	
	
	jQuery('body').on('click', '.follow_btn', function() {
		var follow_user = $(this).attr('rel');
		var followbtn = $(this);
		$.ajax({
			url: SITE_URL+'follow-user/'+follow_user,
			type: "get",
			dataType :'json',
			beforeSend: function(){
				$(followbtn).addClass('disabled');
			}
		}).done(function(data){
			if(data.type == 'success'){
				$('#followbtnouter'+follow_user).html(data.html);
				$('#rfb'+follow_user).remove();
				if($(".rfbsub").length == 0){
					$('#rfbwhotofollow').remove();
				}
				newURL = location.pathname;
				io.emit('new_notification', data.notification);
				if(newURL.includes("myprofile")){
					pageUrl  = newURL;
					$.cergis.loadContent();
					e.preventDefault();
				}
			}
	    }).fail(function(jqXHR, ajaxOptions, thrownError){
	        $(followbtn).removeClass('disabled');
	    });
	});
	
		
	jQuery('body').on('click', '.unfollow_user', function() {
		var follow_user = $(this).attr('rel');
		var followbtn = $(this);
		$.ajax({
			url: SITE_URL+'unfollow-user/'+follow_user,
			type: "get",
			dataType :'json',
			beforeSend: function(){
				$(followbtn).addClass('disabled');
			}
		}).done(function(data){
			if(data.type == 'success'){
				$('#followbtnouter'+follow_user).html(data.html);
				$('.pfollower_outer'+follow_user).remove();
			}
	    }).fail(function(jqXHR, ajaxOptions, thrownError){
			$(followbtn).removeClass('disabled');
	    });
	});
	
	
	//Load EMojis
	jQuery('body').on('click', '.openemojis', function(e) {
		$('.emoji_pop_up').html("");
		var rel_emojis = $(this).attr('rel');
		$('#emoji_pop_up'+rel_emojis).toggle();
		$('.emoji_pop_up').not('#emoji_pop_up'+rel_emojis).hide();
		getemojis(rel_emojis);
		
		/* if($('#emoji_pop_up'+rel_emojis).is(':visible')){
			//getemojis(rel_emojis);
			if(localStorage.getItem("emoji_popup_data")){
				$('#emoji_pop_up'+rel_emojis).html(localStorage.getItem("emoji_popup_data"));
			}else{
				getemojis(rel_emojis);
			}
			putRecentEmojis();
		} */
	});
	
	
	$("body").on('keyup', ".comment_text_area", function(e) {
		var input_rel = $(this).attr('rel');
		var value_input = $.trim($(this).html());
		$('#post_comment_input'+input_rel).val(value_input);
	});
	
	

/* $('div[contenteditable]').keydown(function(e) {
	$(this).html();
	
    // trap the return key being pressed
   // document.execCommand('insertHTML', false, 'br');
}); */
	jQuery('body').on('click', '.emoji_click', function(e) {
		var clicked_img = $(this).attr('rel');
		var emoji_pop_rel = $(this).closest('div.emoji_pop_up').attr('rel');
		if(emoji_pop_rel == 'createpost' || emoji_pop_rel == 'updatepost' ){
			var summernote_msg  =' <img src="'+clicked_img+'" class="comment_text_area_img"> ';
			$('#summernote_'+emoji_pop_rel).summernote('editor.pasteHTML', summernote_msg);
			//$('#summernote_createpost').summernote('editor.insertImage', clicked_img);
			return true;
		}
		var myEle = document.getElementById("form-send-message");
		if(myEle){
			var input_value = $('#message').val();
			input_value  +=' <img src="'+clicked_img+'" class="comment_text_area_img"> ';
			$('#message').val(input_value);
			$('div.chat_text_area').html(input_value);
		}else{
			var input_value = $('#stcomment_form'+emoji_pop_rel).find('input[name=post_comment]').val();
			input_value  +=' <img src="'+clicked_img+'" class="comment_text_area_img"> ';
			$('#stcomment_form'+emoji_pop_rel).find('input[name=post_comment]').val(input_value);
			$('#stcomment_form'+emoji_pop_rel).find('div.comment_text_area').html(input_value);
		}
		
		if(localStorage.getItem("recent_emojis")){
			var str_recent = localStorage.getItem("recent_emojis");
			var arr = str_recent.split(",");
			
			var index = arr.indexOf(clicked_img);
			if (index > -1) {
				arr.splice(index, 1);
			}
			if(arr.length > 5){
				arr.length = 5;
			}
			var recent_emojis = clicked_img+','+arr.join(',');
		}else{
			var recent_emojis = clicked_img;
		}
		localStorage.setItem("recent_emojis", recent_emojis);
		putRecentEmojis();
	});
	
	jQuery('body').on('click', '.goto_class', function(e) {
		var clicked = "f"+$(this).attr('id');
		$(".ttrr").scrollTo("#"+clicked,800);
		$('.goto_class').removeClass("active");
		$(this).addClass("active");
	});
	
	function putRecentEmojis(){
		
		if(localStorage.getItem("recent_emojis")){
			var str_recent = localStorage.getItem("recent_emojis");
			//alert(str_recent);
			var arr = str_recent.split(",");
			if(arr.length > 0){
				var recenthtml = '<h3 class="emoji_heading" style="text-transform: capitalize;">Recent Emojis</h3>';    
				$.each(arr, function(key, val) {
					recenthtml += '<span rel="'+val+'" class="emoji_click"><div class="emoji_div"><img class="emoji_icon" rel="'+val+'" src="'+val+'"></div></span>';
				});
				
				$('#fgoto_recent_emoji').html(recenthtml);
			}
		}
	}
	
	function getemojis(rel_emojis){
		$.ajax({
			url: SITE_URL_BASE + "getemojis", 
			type: 'POST',
			beforeSend: function(){
				$('#emoji_pop_up'+rel_emojis).html('<span class="position-absolute loading"></span>');
	        },
			success: function (response) {
				localStorage.setItem("emoji_popup_data", response.html)
				$('#emoji_pop_up'+rel_emojis).html(response.html);
				putRecentEmojis();
				return true;
			}
			});
		
	}
	
	
	
	//Load Giphy
	var gif_keyword=''; var gif_offset = 0; var rel_post_id = 0;
	jQuery('body').on('click', '.opengiphy', function(e) {
		var rel = $(this).attr('rel');
		//alert(rel);
		rel_post_id = rel;
		$('.popup_gypy').not('.giphy_box'+rel).hide();
		//$('#postLiveModal').css('padding-top', '120px');
		$('.giphy_box'+rel).toggle();
		$('.gif_box,.popup_gypy').css('height','334px');
		$('.gif_box,.popup_gypy').css('height','300px');
		$('.trading').show();
		gif_offset = 0;
		gif_keyword='';
		getgifs();
	});
	
	jQuery('body').on('keypress', '.searchgiphy', function(e) {
		gif_offset = 0;
		gif_keyword = $(this).val();
		getgifs();
	});
	
	
	
	$('.gif_box').on('scroll', function(e) {
		//alert($(this).innerHeight());
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
			gif_offset = gif_offset+6;
            getgifs();
        }
    })
	
	function getgifs(){
		$.ajax({
			url: SITE_URL_BASE + "getgifs", 
			type: 'POST',
			data: 'keyword='+gif_keyword+'&offset='+gif_offset,
			dataType: 'json',
			beforeSend: function(){
				$('.giphy_box'+rel_post_id).append('<span class="position-absolute loading"></span>');
	        },
			success: function (response) {
				$('.giphy_box'+rel_post_id+ ' .loading').remove();
				if(gif_offset == 0){
					$('ul.giphys').html("");
				}
				$.each(response.data, function(i, data2) {
					imgurl = data2.images.fixed_width.url;
					html  = '<li style="text-align:center;"><a href="javascript:void(0);" rel_embed="'+imgurl+'" rel_post_id="'+rel_post_id+'" class="add_giphy img-responsive"><img src="'+imgurl+'"></a></li>';
					$('ul.giphys').append(html);
				});
			}
		});
	}
	
	
	jQuery('body').on('click', '.add_giphy', function(e) {
		var giphy_img  = $(this).attr('rel_embed');
		var rel_post_id  = $(this).attr('rel_post_id');
		if(rel_post_id == 'createpost' || rel_post_id == 'updatepost' ){
			
			if(rel_post_id == 'createpost'){
				if(createdgmexist === true) {
					$("#giphyimgarea" + rel_post_id).html('<img style="padding-top:10px;" src="'+giphy_img+'" itemprop="image"><a href="javascript:void(0);" rel="'+rel_post_id+'" class="removeGIF btn btn-xs btn-outline-light icon-button position-absolute" style="top:0px;left:200px;">X</a>');
					$('#summernote_'+rel_post_id).trigger('summernote.change');
					return true;
				}
				createdgmexist = true;
			}else if(rel_post_id == 'updatepost'){
				$(document).ajaxComplete(function() {
					if ($(".giphyimgcreatepost").length) {
						updatedgmexist = true;
					}
				});
				if ($(".giphyimgcreatepost").length) {
						updatedgmexist = true;
					}
				if(updatedgmexist  === true) {
					//alert("giphyimgarea" + rel_post_id);
					$(".giphyimgcreatepost").html('<img style="padding-top:10px;" src="'+giphy_img+'" itemprop="image"><a href="javascript:void(0);" rel="'+rel_post_id+'" class="removeGIF btn btn-xs btn-outline-light icon-button position-absolute" style="top:0px;left:200px;">X</a>');
					$('.summernote_update').trigger('summernote.change');
					return true;
				}
				updatedgmexist = true;
			}
			var summernote_msg  =' <div class="giphyimgcreatepost position-relative" id="giphyimgarea'+rel_post_id+'"><img style="padding-top:10px;" src="'+giphy_img+'" itemprop="image"><a href="javascript:void(0);" rel="'+rel_post_id+'" class="removeGIF btn btn-xs btn-outline-light icon-button position-absolute" style="top:0px;left:200px;">X</a></div> ';
			$('#summernote_'+rel_post_id).summernote('editor.pasteHTML', summernote_msg);
			//$('#summernote_createpost').summernote('editor.insertImage', clicked_img);
			return true;
		}
		$('#giphy_image'+rel_post_id).val(giphy_img);
		$('.giphy_box'+rel_post_id).hide();
		//$('#stcomment_form'+rel_post_id).submit();"
		if(rel_post_id == 'chatroom'){
			$('#giphyimgarea'+rel_post_id).show();
			$('#chatimagesouter').css('margin-left','240px');
		}
		$('#giphyimgarea'+rel_post_id).html('<img style="padding-top:10px;" src="'+giphy_img+'"><a href="javascript:void(0);" rel="'+rel_post_id+'" class="removeGIF btn btn-xs btn-outline-light icon-button position-absolute" style="top:0px;left:200px;">X</a>');
		
		/* input_value = $('#stcomment_form'+rel_post_id).find('input[name=post_comment]').val();
		input_value += '<img src="'+giphy_img+'" class="">';
		$('#stcomment_form'+rel_post_id).find('div.comment_text_area').html(input_value); */
	});
	
	jQuery('body').on('click', '.removeGIF', function(e) {
		eleID  = $(this).attr('rel');
		if(eleID == 'chatroom'){
			$('#giphyimgarea'+eleID).hide();
			$('#chatimagesouter').css('margin-left','0px');
		}
		$('#giphyimgarea'+eleID).html("");
		$('#giphy_image'+eleID).val("");
	});
	/* End Giphy */
	
	//Like/Dislike post
	jQuery('body').on('click', '.like_post', function(e) {
		cObject = $(this);
		var post_id = $(this).attr('rel');
		$.ajax({
			url: SITE_URL_BASE + "post_like", 
			type: 'post',
			data: "post_id="+post_id,
			dataType: 'json',
			success: function (response) {
				
				if(response.action == 'like'){
					cObject.children('i').addClass('text-primary');
					cObject.parent('div').addClass('text-primary');
					cObject.attr('title', 'Dislike');
					io.emit('new_notification', response.notification);
				}else{
					cObject.children('i').removeClass('text-primary');
					cObject.parent('div').removeClass('text-primary');
					cObject.attr('title', 'Like');
				}
				cObject.next('span').html(response.total_likes);
			}
		});
	});
	
	//validate Live video URL
	jQuery('body').on('blur', '#post_live_url,#post_live_url_update', function(e) {
		var href = $(this).val();
		
		var isValidated = false;
		if (href.match(/\:\/\/.*(youtube\.com)/i) || href.match(/\:\/\/.*(youtu\.be)/i) || href.match(/\:\/\/.*(vimeo\.com)/i) || href.match(/\:\/\/.*(mixer\.com)/i) || href.match(/\:\/\/.*(twitch\.tv)/i)){
			isValidated = true;
		}
		if(!isValidated){
			$(this).val("");
			$(this).next('div.invalid-tooltip').css('display', 'block');
			$(this).next('div.invalid-tooltip').html("Please provide a valid video url of Youtube/Vimeo/Mixer/Twitch");
		}
	});
	
	
	//Like/Dislike coment
	jQuery('body').on('click', '.like_comment', function(e) {
		cObject = $(this);
		var comment_id = $(this).attr('rel');
		var post_id = $(this).attr('data-attr');
		$.ajax({
			url: SITE_URL_BASE + "comment_like", 
			type: 'post',
			data: "comment_id="+comment_id+"&post_id="+post_id,
			dataType: 'json',
			success: function (response) {
				
				if(response.action == 'like'){
					cObject.addClass('text-primary');
					cObject.children('i').addClass('text-primary');
					cObject.parent('div').addClass('text-primary');
					cObject.attr('title', 'Dislike');
					io.emit('new_notification', response.notification);
				}else{
					cObject.removeClass('text-primary');
					cObject.children('i').removeClass('text-primary');
					cObject.parent('div').removeClass('text-primary');
					cObject.attr('title', 'Like');
				}
				cObject.children('span').html(response.total_likes);
			}
		});
	});
	
	
	//update post
	jQuery('body').on('click', '.update_my_post', function(e) {
		var url_slug = $(this).attr('data-link');
		$.ajax({
			url: SITE_URL_BASE + "update-post/"+url_slug, 
			type: 'GET',
			success: function (response) {
				$('#updatepostLiveModal').modal('show');
				$("#updatepostLiveModalDialog").html(response.html);
				reloadFunction();
			}
		});
		
	});
	
	
	
	
	
	jQuery('body').on('keypress', '.stcomment_form .form-control', function(e) {
		$(this).next('div.invalid-tooltip').css('display', 'none');
		$(this).next('div.invalid-tooltip').html("");
	});
	
	jQuery('body').on('submit', '.stcomment_form', function(e) {
		e.preventDefault();
		var emptyvalue = false;
		var post_id;
		var comment_id = "";
		$.each($(this).serializeArray(), function(i, field) {
			if(field.name == 'post_id'){
				post_id = field.value;
			}
			if(field.name == 'comment_id'){
				comment_id = field.value;
			}
			if(field.name == 'post_comment' && field.value == ""){
				emptyvalue = true;
			}
			
		});
		var giphy_image_post = $('#giphy_image'+rel_post_id).val();
		
		if(emptyvalue && giphy_image_post == ''){
			if(comment_id){
				$('#invalid-tooltipc'+comment_id).css('display', 'block');
				$('#invalid-tooltipc'+comment_id).html("Comment field is empty.");
			}else{
				$('#invalid-tooltip'+post_id).css('display', 'block');
				$('#invalid-tooltip'+post_id).html("Comment field is empty.");
			}
			
			return false;
		}
		cObject = $(this);
		data = $(this).serialize();
		
		$.ajax({
			url: SITE_URL_BASE + "post_comment", 
			type: 'post',
			data: data,
			dataType: 'json',
			success: function (response) {
				$('#giphy_image'+rel_post_id).val("");
				$('#giphyimgarea'+rel_post_id).html("");
				if(response.comment_type == 'update'){
					$('.editable_form').remove();
					if(response.giphy_image){
						if($("#img_giphy"+rel_post_id).length){
							$("#img_giphy"+rel_post_id).attr("src", response.giphy_image);
						}else{
							$("#editable_comment"+response.comment_id).after('<p><img src="'+response.giphy_image+'" id="img_giphy'+rel_post_id+'"></p>');
						}
					}
					$("#editable_comment"+response.comment_id).children('span.editable_text').html(response.postcomment);
					$("#editable_comment"+response.comment_id).children('span.editable_text').show();
				}else{
					$('#stcomment_form'+response.post_id+' input[name="post_comment"]').val("");
					$('#stcomment_form'+response.post_id+' div.comment_text_area').html("");
					$('#pst_cmt_cnt'+response.post_id).html(response.total_comments);
					$("#commentslist"+response.post_id).html(response.html);
					io.emit('new_notification', response.notification);
					$('html, body').animate({
						scrollTop: $("#commentslist"+response.post_id).offset().top
					  }, 1000);
					if(response.load_more == 'display'){
						$('#load_more_link'+response.post_id).removeClass('disabled');
						$('#load_more_link'+response.post_id).html("Load more comments");
						$('#load_more_link'+response.post_id).attr("data-attr", 1);
						$('#load_more_'+response.post_id).show();
					}
				}
			}
		});
	});
	
	
});


var num = 1;
function readImage() {
	if (window.File && window.FileList && window.FileReader) {
		
		var files = event.target.files; //FileList object
		var output = $(".preview-images-zone");
		$( ".preview-images-zone" ).removeClass('hidden');
		
		var form_data = new FormData();

		for (let i = 0; i < files.length; i++) {
			var file = files[i];
			if (!file.type.match('image')) continue;
			form_data.append("files[]", file);
			var picReader = new FileReader();
			
			picReader.addEventListener('load', function (event) {
				var picFile = event.target;
				var html =  '<div class="preview-image preview-show-' + num + '">' +
							'<div class="image-cancel" data-no="' + num + '">x</div>' +
							'<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
							'</div>';

				output.append(html);
				num = num + 1;
			});

			picReader.readAsDataURL(file);
		}
		
		$.ajax({
			url: SITE_URL+'ajaxfileupload', 
			type: 'post',
			data: form_data,
			dataType: 'json',
			contentType: false,
			processData: false,
			success: function (response) {
			}
		});

		//$("#pro-image").val(inputfiles.files);
	} else {
		console.log('Browser not support');
	}
}




// When the user clicks anywhere outside of the modal, close it
window.onclick = function(e) {
	var container_popup = $('.emoji_pop_up');
	var popup_gypy = $('.popup_gypy');
	var openemojis = $('.openemojis');
	var opengiphy = $('.opengiphy');

	if (!openemojis.is(e.target) && !container_popup.is(e.target) && container_popup.has(e.target).length === 0 && openemojis.has(e.target).length === 0) {
		container_popup.html("");
		container_popup.hide();
	}
	
	if (!opengiphy.is(e.target) && !popup_gypy.is(e.target) && popup_gypy.has(e.target).length === 0 && opengiphy.has(e.target).length === 0) {
		popup_gypy.hide();
	}
}


	
	
	
	jQuery('body').on('click', '.twitch_chat_btn', function(e) {
		var chat_link = $(this).attr('chat_link');
		btn_text  = $(this).html();
		/* var rel = $(this).attr('rel');
		if($('#twitch_chat'+rel).hasClass("hide_element")){
			$(this).next('div.twitch_chat').removeClass('hide_element');
		} else{
			$(this).next('div.twitch_chat').addClass('hide_element');
		} */
		$(this).next('div.twitch_chat').toggle();
		$(this).next('div.twitch_chat').children('iframe').attr('src', chat_link);
		if($(this).next('div.twitch_chat').is(':visible')){
			btn_text = btn_text.replace("Start", "Stop");
		}else{
			btn_text = btn_text.replace("Stop", "Start");
		}
		$(this).html(btn_text);
	});
	
	
	jQuery('body').on('click', '.load_more_link', function(e) {
		htmlelement = $(this); 
		var pagec  = $(this).attr("data-attr");
		pagec++;
		$(this).attr("data-attr", pagec);
		var post_id  = $(this).attr("rel");
		$.ajax(
	        {
	            url: SITE_URL_BASE+'more-comments/'+post_id+'?page=' + pagec,
	            type: "get",
				 beforeSend: function()
	            {
				
					$(htmlelement).html('Loading more comments ...');
	               $(htmlelement).addClass('disabled');
	            }
	        })
	        .done(function(data)
	        {
				if(data.html == ""){
	               // $(htmlelement).html("No more records found");
	                return true;
	            }
				if(data.last_page > data.current_page){
				   $(htmlelement).removeClass('disabled');
					$(htmlelement).html("Load more comments");
				}else{
					 $('#load_more_'+post_id).hide();
				}
	            $("#commentslist"+post_id).prepend(data.html);
	        })
	        .fail(function(jqXHR, ajaxOptions, thrownError)
	        {
	              $(htmlelement).html('server not responding...');
	        });
	});
	
	
	io.on('received_notification',function(data){ 
		
		if(myName == data.to_user_id) {
			var ncount = $("#unreadNotification").text();
			if(ncount){
				ncount = parseInt(ncount);
				ncount++;
			}else{
				ncount = 1;
			}
			$("#unreadNotification").css('opacity', 1);
			$("#unreadNotification").text(ncount);
			var nhtml = "";
			var imagepath = SITE_URL_BASE + "public/upload/users/profile-photo/" + data.user.photo;
			var notiDate = new Date(data.created_at);
			var notiDateStr = notiDate.getDate().toString().padStart(2, "0") + '/' + notiDate.getMonth().toString().padStart(2, "0") + '/' + notiDate.getFullYear().toString() + ' '+ notiDate.getHours().toString().padStart(2, "0") + ':' + notiDate.getMinutes().toString().padStart(2, "0");
					
			nhtml += '<div class="d-flex flex-row mb-3 pb-3 border-bottom">';
			nhtml += '<a href="javascript:void(0);">';
			nhtml += '<img src="' + imagepath + '" class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle" alt="' + data.user.first_name + '">';
			nhtml += '</a>';
			nhtml += '<div class="pl-3">';
			nhtml += '<a href="javascript:void(0);">';
			nhtml += '<p class="font-weight-medium mb-1">' + data.message + '</p>';
			nhtml += '<p class="text-muted mb-0 text-small">' + notiDateStr + '</p>';
			nhtml += '</a>';
			nhtml += '</div>';
			nhtml += '</div>';
			var reln =  $('#rel_notifi').attr('rel');
			reln = parseInt(reln);
			if(reln > 0){
				$('#my_noti_list').prepend(nhtml);
			}else{
				$('#rel_notifi').attr('rel', 1);
				$('#rel_notifi').css('opacity', 1);
				$('#my_noti_list').html(nhtml);
			}
			messageRequests();
		}
	});
	
	
	function messageRequests(){
		$.ajax({
			type:"GET",
			url: SITE_URL_BASE+'messageRequests',
			success: function (response) {
				$('#headertoprequestdiv').html(response);
				reIntializeDoreFunction();
			},
			error: function(xhr, ajaxOptions, thrownError) {
			  console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
	
	function markNotificationRead(notification_id){
		$.ajax({
			url: SITE_URL_BASE + 'marknotificationsread',
 			type: "POST",
			data:'notification_id='+notification_id,
			dataType:'json',
		}).done(function(data){
			
			if(parseInt(data.count) > 0){
				$("#unreadNotification").text(data.count);
				var notified = notification_id;
			}else{
				$("#unreadNotification").css('opacity', 0);
				$("#unreadNotification").text("");
				var notified = "";
			}
			$('.notified'+notified).removeClass('font-weight-bold');
			$('.notified'+notified).addClass('font-weight-medium');
			
		}).fail(function(jqXHR, ajaxOptions, thrownError){
			//$('.ajax-load').html('server not responding...');
		});
		
	}
	
	function showPostFilesModal(html_detail, rel){
		$('#glide_image_detail').html(html_detail.detail);
		$('#glide_image_thumb').html(html_detail.thumb);
		$('#showPostFiles').modal('show');
		new $.dore(this);
	}
	
	
	function loadMoreData(page){
		$.ajax({
			url: '?page=' + page,
			type: "get",
			 beforeSend: function()
			{
				$('.ajax-load').show();
			}
		}).done(function(data){
			if(data.html == ""){
				$('.ajax-load').html("");
				return true;
			}
			$('.ajax-load').hide();
			$("#post-data").append(data.html);
		}).fail(function(jqXHR, ajaxOptions, thrownError){
			$('.ajax-load').html('server not responding...');
		});
	}
	
	
	function loadMoreGroups(page){
		$.ajax({
			url: '?page=' + page,
			type: "get",
			 beforeSend: function()
			{
				$('.ajax-load').show();
			}
		}).done(function(data){
			if(data.html == ""){
				$('.ajax-load').html("");
				return true;
			}
			$('.ajax-load').hide();
			$("#groups_mid_data").append(data.html);
		}).fail(function(jqXHR, ajaxOptions, thrownError){
			$('.ajax-load').html('server not responding...');
		});
	}
	
	function loadMoreFollowers(f_page){
		$.ajax({
			url: '?fpage=' + f_page,
			type: "get",
			 beforeSend: function()
			{
				$('.ajax-loadfollower').show();
			}
		}).done(function(data){
			if(data.html == ""){
				$('.ajax-loadfollower').html("");
				return true;
			}
			$('.ajax-loadfollower').hide();
			$("#followers_list").append(data.html);
			followers_totalpage = data.total_page;
		}).fail(function(jqXHR, ajaxOptions, thrownError){
			$('.ajax-loadfollower').html('server not responding...');
		});
	}


	function loadMoreFollowing(fi_page){
		$.ajax({
			url: '?fipage=' + fi_page,
			type: "get",
			 beforeSend: function()
			{
				$('.ajax-loadfollowing').show();
			}
		}).done(function(data){
			if(data.html == ""){
				$('.ajax-loadfollowing').html("");
				return true;
			}
			$('.ajax-loadfollowing').hide();
			$("#following_list").append(data.html);
			following_totalpage = data.total_page;
		}).fail(function(jqXHR, ajaxOptions, thrownError){
			$('.ajax-loadfollowing').html('server not responding...');
		});
	}
	
	function checkiframeerror(e){
		var html = e.children().html();
		alert(html);
	}
	
	function reloadFunction(){
		jQuery('.summernote').summernote({
			height: 100,
			popover: {
				image: [],
				link: [],
				air: []
			},
			toolbar: [
				['font', ['bold', 'underline', 'italic', 'clear']],
				// ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
				['fontname', ['fontname']],
				['color', ['color']],
				['insert', ['picture']],
			],
		});
		/* https://miamarti.github.io/Material-DateTimePicker/app/ 
			https://designlink.work/en-US/bootstrap-material-datepicker/
			*/
		jQuery('#start_date,#start_date_update').bootstrapMaterialDatePicker({ 
			format : 'YYYY-MM-DD H:mm:ss', 
			minDate: moment(),
			shortTime:false,
			switchOnClick:true,
			autoClose:true
		});
		document.getElementById('pro-image').addEventListener('change', readImage, false);
		jQuery( ".preview-images-zone" ).sortable();
		
		jQuery(document).on('click', '.image-cancel', function() {
			let no = $(this).data('no');
			$(".preview-image.preview-show-"+no).remove();
			var numItems = $('.image-zone').length;
			if(numItems == 0){
				$( ".preview-images-zone" ).addClass('hidden');
			}
		});
		$shiftSelect = $(".list").shiftSelectable();
		$shiftSelect.data("shiftSelectable").update();
	}
	
	var win="";
	function applogin(dd){  
		 var url = jQuery(dd).attr('rel'); 
		 
		 var w_left = (screen.width/4);
		 var w_top = (screen.height/4);

	   win=  window.open(url,'targetWindow','toolbar=no,titlebar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=900,height=500,top='+w_top+',left='+w_left+'');
	 }
	 
	  var timer = setInterval(function (e) {
    if (win.closed) {
        clearInterval(timer);
		pageUrl = SITE_URL+'login';
       $.cergis.loadContent();
		e.preventDefault();
    }
}, 100);


