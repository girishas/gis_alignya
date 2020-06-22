$.cergis = $.cergis || {};
$.cergis.loadContent = function () {
	
   //startLoadingBar();
    $.ajax({
        url: pageUrl,
		beforeSend: function(){
			$('body').addClass('show-spinner');
		},
        success: function (data) {
			$('#main-content').html(data);
			$('body').removeClass("show-spinner");
			reIntializeDoreFunction();
			// new $.dore(this);
			
			if(pageUrl.includes("messages") || pageUrl.includes("groups")){
				reinit();
			}
			
	 
			
            // hide ajax loader
            //$('.ajax-loader').hide();
        }, error: function(xhr, ajaxOptions, thrownError) {
			pageUrl = SITE_URL+"page-not-found";
			$.cergis.loadContent();
			e.preventDefault();
		}
    });
    if (pageUrl != window.location) {
        window.history.pushState({ path: pageUrl }, '', pageUrl);
    }
	
}
$.cergis.backForwardButtons = function () {
	 $(window).on('popstate', function () {
		$.ajax({
            url: location.pathname,
            success: function (data) {
                $('#main-content').html(data);
				$('html,body').animate({
					scrollTop: $("html").offset().top
				}, 'fast');
				//console.log(location);
				//alert(location.pathname);
				 //new $.dore(this);
				 reIntializeDoreFunction();
				 $('body').removeClass("show-spinner");
            }
        });
    });
	
}
$("body").on('click', ".steamerst_link", function(e) {
	 $(this).addClass("show-spinner");
	var target = $( e.target );
	$('.modal').modal('hide');
	pageUrl = $(this).attr('href');
	if ( target.is( ".main-menu .scroll ul li a" ) || target.is( ".main-menu .scroll ul li a i" )) {
		$('.menu li').removeClass('active');
		$(this).parent('li').addClass('active');
	}
	
	if ( target.is( ".sub-menu .scroll ul li a" ) || target.is( ".sub-menu .scroll ul li a span" ) || target.is( ".sub-menu .scroll ul li a i" )) {
		$('.menu li').removeClass('active');
		var main_link_id = $(this).attr('data-main-link');
		$(this).parent('li').addClass('active');
		$("#"+main_link_id).addClass('active');
	}
	
	if(target.is( ".breadcrumb-item a" ) && $(this).text() == "Dashboard"){
		$('.menu li').removeClass('active');
		$('#st_dashboard').addClass('active');
	}
	
	
	if(target.is( ".dropdown-menu-right a" )){
		$('.menu li').removeClass('active');
	}
	 
    $.cergis.loadContent();
    e.preventDefault();
	$('html,body').animate({
		scrollTop: $("html").offset().top
	}, 'fast');
	//$(this).removeClass("show-spinner");
});

$("body").on('click', ".steamerst_status", function(e) {
	$('.modal').modal('hide');
	pageUrl = $(this).attr('href');
	pageUrlpost = $(this).attr('data-link');
	 $.ajax({
		type:"GET",
        url: pageUrl,
		dataType:"json",
		beforeSend: function(){
			$('body').addClass('show-spinner');
		},
        success: function (data) {
			pageUrl = data.url;
			if(pageUrl == 'comment_remove'){
				if(data.type == 'error') return false;
				var lost_id = data.lost_id;
				var parent_id = data.parent_id;
				$('#pcomment'+parent_id+lost_id).remove();
				var matched = $("#commentslist"+parent_id+" div.d-flex");
				$('#pst_cmt_cnt'+parent_id).children('span').html(data.total_comments);
				if(matched.length < 2){
					reloadcomments(parent_id, 1);
				}
				
			}else{
				if(pageUrlpost){
					pageUrl = pageUrlpost;
				}
				$.cergis.loadContent();
			}
			alert_class = 'primary';
			alert_title = data.title;
			if(data.type == 'error'){
				alert_class = 'danger';
			}
			showNotificationApp('top', 'right', alert_class, alert_title, data.message);
			$('body').removeClass("show-spinner");
        }
    });
   
    e.preventDefault();
});

 
$("body").on('click', ".pagination a", function(e) {
    pageUrl = $(this).attr('href');
    $.cergis.loadContent();
    e.preventDefault();
});

$.cergis.backForwardButtons();



$("body").on('keyup', ".steamerstudio_form input,.note-editable", function(e) {
	if($(this).hasClass('note-editable')){
		$('.summernote_description').css('display', 'none');
	}
	$(this).next('div.invalid-tooltip').css('display', 'none');
});
	
$("body").on('submit', ".steamerstudio_form", function(e) {
	e.preventDefault();
	//startLoadingBar(); 
	if ($('#summernote_createpost').summernote('isEmpty')) {
        $('#summernote_createpost').val("");
    }
	
	if ($('.summernote_update').summernote('isEmpty')) {
        $('.summernote_update').val("");
    }
	
	var form_action = $(this).attr('action');
	data = $(this).serialize();
	//console.log(data);
	var action_modal = $('input[name="action_modal"]').val();
	if(action_modal != "change-password"){
		if (form_action != window.location) {
			window.history.pushState({ path: form_action }, '', form_action);
		}
	}
	$.ajax({
		type:"POST",
		url: form_action,
		data:data,
		beforeSend: function(){
			$('body').addClass('show-spinner');
		},
		success: function (response) {
			if(response.type == 'error'){
				errors = response.error;
				$.each(errors, function(key,value) {
					$('input[name="'+key+'"]').next('div.invalid-tooltip').css('display', 'block');
					$('input[name="'+key+'"]').next('div.invalid-tooltip').html(value[0]);
					
					$('.summernote_'+key).css('display', 'block');
					$('.summernote_'+key).html(value[0]);
					$('textarea[name="'+key+'"]').next('div.invalid-tooltip').css('display', 'block');
					$('textarea[name="'+key+'"]').next('div.invalid-tooltip').html(value[0]);
				});
				showNotificationApp('top', 'right', 'danger', 'Error', response.message);
			}else if(response.type == 'success'){
				pageUrl = response.url;
				var lastslashindex = pageUrl.lastIndexOf('/');
				var resultName= pageUrl.substring(lastslashindex  + 1);
				
				if(pageUrl == "close_modal"){
					$('#changePasswordModal').modal('hide');
					pageUrl = window.location;
				}else if(response.modals == 'posts'){
					$("#post_form").trigger("reset");
					$(".summernote").summernote("reset");
					$(".preview-images-zone").html("");
					$(".preview-images-zone").addClass("hidden");
					$('#postLiveModal').modal('hide');
					$('#updatepostLiveModal').modal('hide');
					if(response.notification_count > 0){
						$.each(response.notifications, function(i, notification) {
							io.emit('new_notification', notification);
						});
					}
					pageUrl = window.location;
				}
				
				$.cergis.loadContent();
				e.preventDefault();
				if(response.message){
					showNotificationApp('top', 'right', 'primary', 'Success', response.message);
				}
				$('.slim-popover').remove();
				//$( "html" ).scrollTop(0);
				$('html,body').animate({
					scrollTop: $("html").offset().top
				}, 'fast');
			}
			$('body').removeClass("show-spinner");
			
		},
		 error: function(xhr, ajaxOptions, thrownError) {
		  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});



$("body").on('submit', ".steamerstudio_searchform", function(e) {
	e.preventDefault();
			
	var form_action = $(this).attr('action');
	data = $(this).serialize();
	if (form_action != window.location) {
		window.history.pushState({ path: form_action }, '', form_action);
	}
	$.ajax({
		type:"POST",
		url: form_action,
		data:data,beforeSend: function(){
			$('body').addClass('show-spinner');
		},
		success: function (response) {
			$('#main-content').html(response);
			$('body').removeClass("show-spinner");
			//new $.dore(this);
			reIntializeDoreFunction();
		},
		 error: function(xhr, ajaxOptions, thrownError) {
		  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$("body").on('click', "#dropdownMenu4", function(e) {
	$('#icon_header').toggleClass('fa-chevron-down fa-chevron-up');
});
			
function startLoadingBar() {
	// only add progress bar if added yet.
	$("#loading-bar").show();
	$("#loading-bar").width((50 + Math.random() * 30) + "%");
}
function stopLoadingBar() {
	//End loading animation
	$("#loading-bar").width("101%").delay(200).fadeOut(400, function() {
		$(this).width("0");
	});
}

function logout(){
	$.ajax({
        url: SITE_URL+'logout',
        success: function (data) {
			pageUrl = SITE_URL+'login';
		    $.cergis.loadContent();
        }
    });
}

function showNotificationApp(placementFrom, placementAlign, type, title, message) {
      $.notify(
        {
          title: title,
          message: message,
          target: "_blank"
        },
        {
          element: "body",
          position: null,
          type: type,
          allow_dismiss: true,
          newest_on_top: false,
          showProgressbar: false,
          placement: {
            from: placementFrom,
            align: placementAlign
          },
          offset: 20,
          spacing: 10,
          z_index: 1031,
          delay: 4000,
          timer: 2000,
          url_target: "_blank",
          mouse_over: null,
          animate: {
            enter: "animated fadeInDown",
            exit: "animated fadeOutUp"
          },
          onShow: null,
          onShown: null,
          onClose: null,
          onClosed: null,
          icon_type: "class",
          template:
            '<div data-notify="container" class="col-11 col-sm-3 alert  alert-{0} " role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            "</div>" +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            "</div>"
        }
      );
    }
	
	
	function showConfirmationModal(title, message, url){
		$('#modalTitle').html(title);
		$('#modalBody').html(message);
		$('#confirmURL').attr('href', url);
		$('#showConfirmationModal').modal('show');
	}
	
	function showConfirmationModalPost(title, message, url, cur_url){
		$('#modalTitle').html(title);
		$('#modalBody').html(message);
		$('#confirmURL').attr('href', url);
		$('#confirmURL').attr('data-link', cur_url);
		$('#showConfirmationModal').modal('show');
	}
	
	function showChangePasswordModal(){
		$('#changePasswordModal').modal('show');
		//$('#changePasswordModal').modal({backdrop:'static', keyboard: false}, 'show');
	}
	
	function forceLoginModal(){
		$('#forceLoginModal').modal('show');
	}
	
	function showCreateGroupModal(){
		$('#createGroupModal').modal('show');
		//$('#createGroupModal').modal({backdrop:'static', keyboard: false}, 'show');
	}
	
	
	function openPostModal(){
		$('#postLiveModal').modal('show');
		//$('#postLiveModal').modal({backdrop:'static', keyboard: false}, 'show');
		reloadFunction();
	}
	
	
	function openSceduledEventModal(event){
		var postDate  = new Date(event.start);
		var postDateStr = postDate.getDate().toString().padStart(2, "0") + '/' + postDate.getMonth().toString().padStart(2, "0") + '/' + postDate.getFullYear().toString() + ' '+ postDate.getHours().toString().padStart(2, "0") + ':' + postDate.getMinutes().toString().padStart(2, "0");
		var imgpath  = SITE_URL_BASE+'public/upload/users/profile-photo/'+event.photo;
		var modalhtml = '<div class=" d-flex flex-row mb-4">';
        modalhtml     += '<a class="d-flex" href="javascript:void(0);">';
        modalhtml     += '<img alt="Profile" src="'+imgpath+'" class="img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center">';
                                modalhtml     += '</a>';
                                modalhtml     += '<div class=" d-flex flex-grow-1 min-width-zero">';
                                    modalhtml     += '<div class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">';
                                        modalhtml     += '<div class="min-width-zero">';
                                            modalhtml     += '<a href="javascript:void(0);">';
                                               modalhtml     += ' <p class="list-item-heading mb-1">'+event.title+'</p>';
                                            modalhtml     += '</a>';
                                            modalhtml     += '<p class="mb-2 text-muted text-small">Sceduled By : '+event.first_name+' '+event.last_name+'</p>';
											  modalhtml     += '<p class="text-primary text-small font-weight-medium d-none d-sm-block">Sceduled On : '+postDateStr+'</p>';
                                        modalhtml     += '</div>';
                                   modalhtml     += ' </div>';
                                modalhtml     += '</div>';
                            modalhtml     += '</div>';
		$('#SceduledEventModal .modal-body').html(modalhtml);
		$('#SceduledEventModal').modal('show');
	}
	
	
	function reloadcomments(post_id, pageno){
		$.ajax(
		{
			url: SITE_URL_BASE+'more-comments/'+post_id+'?page=' + pageno,
			type: "get",
		})
		.done(function(data)
		{
			if(data.html == ""){
				$('#load_more_'+post_id).hide();
				return true;
			}
		   $("#commentslist"+post_id).html(data.html);
		   $("#load_more_link"+post_id).attr("data-attr", "1");
		});
	}
	
	$("body").on("click", ".app-menu-button", function (event) {
      event.preventDefault();
      if ($(".app-menu").hasClass("shown")) {
        $(".app-menu").removeClass("shown");
      } else {
        $(".app-menu").addClass("shown");
      }
    });
	
	var emojisButton = function (context) {
		var ui = $.summernote.ui;

		// create button
		var button = ui.button({
			contents: '<a href="javascript:void(0);" rel="createpost" class="openemojis" ><i class="glyph-icon simple-icon-emotsmile"></i></a>',
			tooltip: 'Emojis'
		});

		return button.render();   // return button as jquery object
	};
	
	var giphyButton = function (context) {
		var ui = $.summernote.ui;

		// create button
		var button = ui.button({
			contents: '<a href="javascript:void(0);" rel="createpost" class="opengiphy"><i class="material-icons" style="">gif</i></a>',
			tooltip: 'Post a GIF'
		});

		return button.render();   // return button as jquery object
	};
	
	
	var emojisButtonUpdate = function (context) {
		var ui = $.summernote.ui;

		// create button
		var button = ui.button({
			contents: '<a href="javascript:void(0);" rel="updatepost" class="openemojis" ><i class="glyph-icon simple-icon-emotsmile"></i></a>',
			tooltip: 'Emojis'
		});

		return button.render();   // return button as jquery object
	};
	
	var giphyButtonUpdate = function (context) {
		var ui = $.summernote.ui;

		// create button
		var button = ui.button({
			contents: '<a href="javascript:void(0);" rel="updatepost" class="opengiphy"><i class="material-icons" style="">gif</i></a>',
			tooltip: 'Post a GIF'
		});

		return button.render();   // return button as jquery object
	};
   
	function reIntializeDoreFunction(){
		updatedgmexist = false;
		createdgmexist = false;
	
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
		/* 03.10. Calendar */
		 $(".calendar").fullCalendar({
			themeSystem: "bootstrap4",
			height: "auto",
			isRTL: false,
			eventLimit: 2,
			buttonText: {
			  today: "Today",
			  month: "Month",
			  week: "Week",
			  day: "Day",
			  list: "List"
			},
			bootstrapFontAwesome: {
			  prev: " simple-icon-arrow-left",
			  next: " simple-icon-arrow-right",
			  prevYear: " simple-icon-control-start",
			  nextYear: " simple-icon-control-end"
			},
			eventClick: function(event, element) {
				openSceduledEventModal(event);
			},
			
			events: SITE_URL_BASE+"json_posts",
			eventRender: function(event, element)
			{ 
				var eventDate = new Date(event.start);
				var eventDateStr = eventDate.getHours().toString().padStart(2, "0") + ':' + eventDate.getMinutes().toString().padStart(2, "0");
				element.find('span.fc-time').html(eventDateStr); 
				element.find('span.fc-title').html("<br />"+event.title); 
			},
		  });
		
		 direction = "ltr";
		  // Details Images
		  if ($(".glide.details").length > 0) {
			var glideThumbCountMax = 5;
			var glideLength = $(".glide.thumbs li").length;
			var perView = Math.min(glideThumbCountMax, glideLength);

			var glideLarge = new Glide(".glide.details", {
			  bound: true,
			  rewind: false,
			  focusAt: 0,
			  perView: 1,
			  startAt: 0,
			  direction: direction,
			});

			var glideThumbs = new Glide(".glide.thumbs", {
			  bound: true,
			  rewind: false,
			  perView: perView,
			  perTouch: 1,
			  focusAt: 0,
			  startAt: 0,
			  direction: direction,
			  breakpoints: {
				576: {
				  perView: Math.min(4, glideLength)
				},
				420: {
				  perView: Math.min(3, glideLength)
				}
			  }
			});

			$(".glide.thumbs").css("width", perView * 70);
			addActiveThumbClass(0);

			$(".glide.thumbs li").on("click", function (event) {
			  var clickedIndex = $(event.currentTarget).index();
			  glideLarge.go("=" + clickedIndex);
			  addActiveThumbClass(clickedIndex);
			});

			glideLarge.on(["swipe.end"], function () {
			  addActiveThumbClass(glideLarge.index);
			});

			glideThumbs.on("resize", function () {
			  perView = Math.min(glideThumbs.settings.perView, glideLength);
			  $(".glide.thumbs").css("width", perView * 70);
			  if (perView >= $(".glide.thumbs li").length) {
				$(".glide.thumbs .glide__arrows").css("display", "none");
			  } else {
				$(".glide.thumbs .glide__arrows").css("display", "block");
			  }
			});

			function addActiveThumbClass(index) {
			  $(".glide.thumbs li").removeClass("active");
			  $($(".glide.thumbs li")[index]).addClass("active");
			  var gap = glideThumbs.index + perView;
			  if (index >= gap) {
				glideThumbs.go(">");
			  }
			  if (index < glideThumbs.index) {
				glideThumbs.go("<");
			  }
			}
			glideThumbs.mount();
			glideLarge.mount();
		  }
		  
		  

		  // Dashboard Numbers
		  if ($(".glide.dashboard-numbers").length > 0) {
			new Glide(".glide.dashboard-numbers", {
			  bound: true,
			  rewind: false,
			  perView: 4,
			  perTouch: 1,
			  focusAt: 0,
			  startAt: 0,
			  direction: direction,
			  gap: 7,
			  breakpoints: {
				1800: {
				  perView: 3
				},
				576: {
				  perView: 2
				},
				320: {
				  perView: 1
				}
			  }
			}).mount();
		  }

		  // Dashboard Best Rated
		  if ($(".best-rated-items").length > 0) {
			new Glide(".best-rated-items", {
			  gap: 10,
			  perView: 1,
			  direction: direction,
			  type: "carousel",
			  peek: { before: 0, after: 100 },
			  breakpoints: {
				480: { perView: 1 },
				992: { perView: 2 },
				1200: { perView: 1 }
			  },
			}).mount();
		  }


		  if ($(".glide.basic").length > 0) {
			new Glide(".glide.basic", {
			  gap: 0,
			  rewind: false,
			  bound: true,
			  perView: 3,
			  direction: direction,
			  breakpoints: {
				600: { perView: 1 },
				1000: { perView: 2 }
			  },
			}).mount();
		  }

		  if ($(".glide.center").length > 0) {
			new Glide(".glide.center", {
			  gap: 0,
			  type: "carousel",
			  perView: 4,
			  direction: direction,
			  peek: { before: 50, after: 50 },
			  breakpoints: {
				600: { perView: 1 },
				1000: { perView: 2 }
			  },
			}).mount();
		  }

		  if ($(".glide.single").length > 0) {
			new Glide(".glide.single", {
			  gap: 0,
			  type: "carousel",
			  perView: 1,
			  direction: direction,
			}).mount();
		  }



		  if ($(".glide.gallery").length > 0) {
			var enableClick = true;
			var glideGallery = new Glide(".glide.gallery", {
			  gap: 10,
			  perTouch: 1,
			  perView: 1,
			  type: "carousel",
			  peek: { before: 100, after: 100 },
			  direction: direction
			})

			glideGallery.on(["swipe.move"], function () {
			  enableClick = false;
			});

			glideGallery.on(["run.after"], function () {
			  enableClick = true;
			});

			glideGallery.mount();

			$(".glide.gallery").get(0).addEventListener('click', function (event) {
			  if (!enableClick) {
				event.stopPropagation();
				event.preventDefault();
				return false;
			  } else {
				return true;
			  }
			}, true);

		  }
		  
		   var chatAppScroll;
		  $(".scroll").each(function () {
			if ($(this).parents(".chat-app").length > 0) {
			  var scrollElement = $(this)[0];
			  var $scrollContent = $(this).find(".scroll-content");
			  var initialized = false;

			  function createChatAppScroll() {
				chatAppScroll = new PerfectScrollbar(scrollElement, { suppressScrollX: true });
				chatAppScroll.isRtl = false;
				initialized = false;
			  }

			  function calculateHeight() {
				var elementsHeight = 0;
				if ($("main").length > 0) {
				  elementsHeight += parseInt($("main").css("margin-top"));
				}
				if ($(".chat-input-container").length > 0) {
				  elementsHeight += $(".chat-input-container").outerHeight(true);
				}
				if ($(".chat-heading-container").length > 0) {
				  elementsHeight += $(".chat-heading-container").outerHeight(true);
				}
				if ($(".separator").length > 0) {
				  elementsHeight += $(".separator").outerHeight(true);
				}
				$(".chat-app .scroll").css("height", (window.innerHeight - elementsHeight) + "px");

				if (chatAppScroll) {
				  $(".chat-app .scroll").scrollTop(
					$(".chat-app .scroll").prop("scrollHeight")
				  );
				  chatAppScroll.update();
				}
				if (window.innerWidth < 576) {
				  if (chatAppScroll) {
					chatAppScroll.destroy();
					chatAppScroll = null;
				  }
				  $(".chat-app .scroll-content > div:last-of-type").css("padding-bottom", ($(".chat-input-container").outerHeight(true)) + "px");

				  if (!initialized) {
					setTimeout(function () {
					  $("html, body").animate({ scrollTop: $(document).height() + 30 }, 100);
					}, 300);
					initialized = true;
				  }
				} else {
				  if (!chatAppScroll) {
					createChatAppScroll();
				  }
				  $(".chat-app .scroll-content > div:last-of-type").css("padding-bottom", 0);
				}
			  }
			  $(window).on("resize", function (event) {
				calculateHeight();
			  });
			  calculateHeight();

			  return;
			}
			var ps = new PerfectScrollbar($(this)[0], { suppressScrollX: true });
			ps.isRtl = false;
		  });
		  
		  $(".select2-single, .select2-multiple").select2({
			theme: "bootstrap",
			dir: direction,
			placeholder: "",
			maximumSelectionSize: 400,
			containerCssClass: ":all:"
		  });
		  
		   baguetteBox.run('.gallery');
			baguetteBox.run('.lightbox');
	
	}