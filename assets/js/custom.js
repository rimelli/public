/* ----------------- Start Document ----------------- */
(function($){
"use strict";

$(document).ready(function(){
	
	/*--------------------------------------------------*/
	/*  Mobile Menu - mmenu.js
	/*--------------------------------------------------*/
	$(function() {
		function mmenuInit() {
			var wi = $(window).width();
			if(wi <= '1099') {

				$(".mmenu-init" ).remove();
				$("#navigation").clone().addClass("mmenu-init").insertBefore("#navigation").removeAttr('id').removeClass('style-1 style-2')
								.find('ul, div').removeClass('style-1 style-2 mega-menu mega-menu-content mega-menu-section').removeAttr('id');
				$(".mmenu-init").find("ul").addClass("mm-listview");
				$(".mmenu-init").find(".mobile-styles .mm-listview").unwrap();


				$(".mmenu-init").mmenu({
				 	"counters": true
				}, {
				 // configuration
				 offCanvas: {
				    pageNodetype: "#wrapper"
				 }
				});

				var mmenuAPI = $(".mmenu-init").data( "mmenu" );
				var $icon = $(".mmenu-trigger .hamburger");

				$(".mmenu-trigger").on('click', function() {
					mmenuAPI.open();
				});

			}
			$(".mm-next").addClass("mm-fullsubopen");
		}
		mmenuInit();
		$(window).resize(function() { mmenuInit(); });
	});


	/*--------------------------------------------------*/
	/*  Sticky Header
	/*--------------------------------------------------*/
	function stickyHeader() {

		$(window).on('scroll load', function() {

			if($(window).width() < '1099') { 
				$("#header-container").removeClass("cloned");
			}
			
			if($(window).width() > '1099') {

				// CSS adjustment
				$("#header-container").css({
					position: 'fixed',
				});
		
				var headerOffset = $("#header-container").height();

				if($(window).scrollTop() >= headerOffset){
					$("#header-container").addClass('cloned');
					$(".wrapper-with-transparent-header #header-container").addClass('cloned').removeClass("transparent-header unsticky");
				} else {
					$("#header-container").removeClass("cloned");
					$(".wrapper-with-transparent-header #header-container").addClass('transparent-header unsticky').removeClass("cloned");
				}

				// Sticky Logo
				var transparentLogo = $('#header-container #logo img').attr('data-transparent-logo');
				var stickyLogo = $('#header-container #logo img').attr('data-sticky-logo');

				if( $('.wrapper-with-transparent-header #header-container').hasClass('cloned')) {
					$("#header-container.cloned #logo img").attr("src", stickyLogo);
				} 

				if( $('.wrapper-with-transparent-header #header-container').hasClass('transparent-header')) {
					$("#header-container #logo img").attr("src", transparentLogo);
				} 

				$(window).on('load resize', function() {
				    var headerOffset = $("#header-container").height();
				    $("#wrapper").css({'padding-top': headerOffset});
				});
			}
		});
	}

	// Sticky Header Init
	stickyHeader();


	/*--------------------------------------------------*/
	/*  Transparent Header Spacer Adjustment
	/*--------------------------------------------------*/
	$(window).on('load resize', function() {
		var transparentHeaderHeight = $('.transparent-header').outerHeight();
		$('.transparent-header-spacer').css({
			height: transparentHeaderHeight,
		});
	});


	/*----------------------------------------------------*/
	/*  Back to Top
	/*----------------------------------------------------*/

	// Button
	function backToTop() {
		$('body').append('<div id="backtotop"><a href="#"></a></div>');
	}
	backToTop();

	// Showing Button
	var pxShow = 600; // height on which the button will show
	var scrollSpeed = 500; // how slow / fast you want the button to scroll to top.

	$(window).scroll(function(){
	 if($(window).scrollTop() >= pxShow){
		$("#backtotop").addClass('visible');
	 } else {
		$("#backtotop").removeClass('visible');
	 }
	});

	$('#backtotop a').on('click', function(){
	 $('html, body').animate({scrollTop:0}, scrollSpeed);
	 return false;
	});
	

	/*--------------------------------------------------*/
	/*  Ripple Effect
	/*--------------------------------------------------*/
	$('.ripple-effect, .ripple-effect-dark').on('click', function(e) {
		var rippleDiv = $('<span class="ripple-overlay">'),
			rippleOffset = $(this).offset(),
			rippleY = e.pageY - rippleOffset.top,
			rippleX = e.pageX - rippleOffset.left;

		rippleDiv.css({
			top: rippleY - (rippleDiv.height() / 2),
			left: rippleX - (rippleDiv.width() / 2),
			// background: $(this).data("ripple-color");
		}).appendTo($(this));

		window.setTimeout(function() {
			rippleDiv.remove();
		}, 800);
	});


	/*--------------------------------------------------*/
	/*  Interactive Effects
	/*--------------------------------------------------*/
	$(".switch, .radio").each(function() {
		var intElem = $(this);
		intElem.on('click', function() {
			intElem.addClass('interactive-effect');
		   setTimeout(function() {
					intElem.removeClass('interactive-effect');
		   }, 400);
		});
	});


	/*--------------------------------------------------*/
	/*  Sliding Button Icon
	/*--------------------------------------------------*/
	$(window).on('load', function() {
		$(".button.button-sliding-icon").not(".task-listing .button.button-sliding-icon").each(function() {
			var buttonWidth = $(this).outerWidth()+30;
			$(this).css('width',buttonWidth);
		});
	});


	/*--------------------------------------------------*/
 	/*  Remove Post
 	/*--------------------------------------------------*/	
     $(document).on('click', '.post-remove', function(e){ 
     	e.preventDefault();	
 		var post_id = $(e.target).data("post_id");	
 		$.get(`includes/form_handlers/delete_post.php?post_id=${post_id}`);
 		console.log(post_id+ " Post Deleted.");

 			$(`#post_${post_id}`).fadeOut();
 			$('.mfp-close').click();

 	});


  /*--------------------------------------------------*/
 	/*  Remove Note
 	/*--------------------------------------------------*/	
     $(document).on('click', '.note-remove', function(e){ 
     	e.preventDefault();	
 		var note_id = $(e.target).data("note_id");	
 		$.get(`includes/form_handlers/delete_note.php?note_id=${note_id}`);
 		console.log(note_id+ " Note Deleted.");

 			$(`#note_${note_id}`).fadeOut();
 			$('.mfp-close').click();

 	});


	/*--------------------------------------------------*/
	/*  Bookmark Actions
	/*--------------------------------------------------*/
    $(document).on('click', '.bookmark-icon-job, .job-bookmark-remove', function(e){ 
    	e.preventDefault();	
		let type = ($(e.target).hasClass('job-bookmark-remove') || $(e.target).hasClass('icon-feather-trash-2')) ? 'delete' : 'toggle', job_id = $(e.target).data("job_id");	

		$.get(`filter_jobs.php?job_id=${job_id}`);

		if (type == 'delete'){
			$(`#bookmark_${job_id}`).fadeOut();
		}else{
			$(this).toggleClass('bookmarked');
		}

	});


	/*--------------------------------------------------*/
  /*  Bookmark Actions
  /*--------------------------------------------------*/
    $(document).on('click', '.bookmark-icon-event, .event-bookmark-remove', function(e){ 
      e.preventDefault(); 
    let type = ($(e.target).hasClass('event-bookmark-remove') || $(e.target).hasClass('icon-feather-trash-2')) ? 'delete' : 'toggle', event_id = $(e.target).data("event_id");  

    $.get(`filter_events.php?event_id=${event_id}`);

    if (type == 'delete'){
      $(`#bookmark_${event_id}`).fadeOut();
    }else{
      $(this).toggleClass('bookmarked');
    }

  });

	/*--------------------------------------------------*/
	/*  Bookmark Actions
	/*--------------------------------------------------*/
    $(document).on('click', '.bookmark-icon-profile, .profile-bookmark-remove', function(e){ 
    	e.preventDefault();	
		let type = ($(e.target).hasClass('profile-bookmark-remove') || $(e.target).hasClass('icon-feather-trash-2')) ? 'delete' : 'toggle', profile_id = $(e.target).data("profile_id");	

		$.get(`profile_bookmark.php?profile_id=${profile_id}`);

		if (type == 'delete'){
			$(`#bookmark_${profile_id}`).fadeOut();
		}else{
			$(this).toggleClass('bookmarked');
		}

	});


  /*--------------------------------------------------*/
	/*  Contact form submission
	/*--------------------------------------------------*/
	$('#contactform').on('submit', function(e) {
		e.preventDefault();		

		let jobPostOverlay = $('#job-post-overlay'), 
			jobPostLoader = $('#job-post-loader')
		
		jobPostLoader.html(`<i class="fas fa-circle-notch fa-spin"></i><ul><li>Sending message</li><li>Please wait ...</li></ul>`);
		jobPostOverlay.css('display', 'block');
		jobPostLoader.css('display', 'flex');

		$.post('contact_update.php', $(e.target).serialize(), data => {			
			setTimeout(() => {
				let message = '';

				if (data == 'message_sent'){
					message = '<i class="fas fa-check-circle"></i><ul><li>Message sent with success</li>';
				}else{
					message = `<i class="fas fa-exclamation-circle"></i><ul><li>${data}</li>`;
				}

				message += '<li><a href="#" id="jobs-post-submit-close">Click here</a> to close.</li></ul>';
				
				jobPostLoader.html(message);
				
				if (data == 'message_sent'){
					$(e.target).trigger('reset');	
					$(".selectpicker").val('default').selectpicker("refresh");
				}

			}, 1000);			

		});
				
	});

	$(document).on('click', '#jobs-post-submit-close', function(e){ 
    	e.preventDefault();	

		$('#job-post-overlay').css('display', 'none');
		$('#job-post-loader').css('display', 'none');

	});



	/*--------------------------------------------------*/
	/*  Settings form submission
	/*--------------------------------------------------*/
	$('.settings-form').on('submit', function(e) {
		e.preventDefault();

		let button = $(e.target).find($('.save-details')), return_message = $(e.target).find($('.return-message'));

		return_message.html('');

		button.prop('disabled', true);
		button.find($('.icon-feather-save')).hide();
		button.find($('.icon-material-outline-add')).hide();
		button.find($('.fa-spin')).show();

		$.post('settings_update.php', $(e.target).serialize(), data => {			
			setTimeout(() => {
				return_message.html(data);
				button.prop('disabled', false);
				button.find($('.icon-feather-save')).show();
				button.find($('.icon-material-outline-add')).show();
				button.find($('.fa-spin')).hide();

			}, 1000);			

		});
				
	});


	/*--------------------------------------------------*/
	/*  Form submission
	/*--------------------------------------------------*/
	$('.add-teams-form').on('submit', function(e) {
		e.preventDefault();

		let button = $(e.target).find($('.save-details')), return_message = $(e.target).find($('.return-message'));
		let inputs = document.getElementById("add-teams-form").elements;
		let teamName = inputs["team_name"].value;

		return_message.html('');

		button.prop('disabled', true);
		button.find($('.icon-feather-save')).hide();
		button.find($('.icon-material-outline-add')).hide();
		button.find($('.fa-spin')).show();

		$.post('settings_update.php', $(e.target).serialize(), data => {			
			setTimeout(() => {
				return_message.html(data);
				button.prop('disabled', false);
				button.find($('.icon-feather-save')).show();
				button.find($('.icon-material-outline-add')).show();
				button.find($('.fa-spin')).hide();

			}, 1000);			

		});

		let html = '';

		html += `<div class="col-xl-3"><div class="companies-list"><a href="teams.php" class="company"><div class="company-inner-alignment"><h4 class="margin-bottom-10">${teamName}</h4>
							<span class="company-not-rated">0 Players</span></div></a></div></div>`;

		$('#teams-container').append(html);
				
	});


	/*--------------------------------------------------*/
	/*  Settings form submission
	/*--------------------------------------------------*/
	$('.remove-team-form').on('submit', function(e) {
		e.preventDefault();

		let button = $(e.target).find($('.save-details')), return_message = $(e.target).find($('.return-message'));
		let inputs = document.getElementById("remove-team-form").elements;
		let teamId = inputs["team_id"].value;

		return_message.html('');

		button.prop('disabled', true);
		button.find($('.icon-feather-save')).hide();
		button.find($('.icon-material-outline-add')).hide();
		button.find($('.icon-feather-trash-2')).hide();
		button.find($('.fa-spin')).show();

		$.post('settings_update.php', $(e.target).serialize(), data => {			
			setTimeout(() => {
				return_message.html(data);
				button.prop('disabled', false);
				button.find($('.icon-feather-save')).show();
				button.find($('.icon-material-outline-add')).show();
				button.find($('.icon-feather-trash-2')).show();
				button.find($('.fa-spin')).hide();

			}, 1000);

			$(`#team_${teamId}`).fadeOut();

		});
				
	});


	/*--------------------------------------------------*/
	/*  Settings form submission
	/*--------------------------------------------------*/
	$('.remove-player-form').on('submit', function(e) {
		e.preventDefault();

		let button = $(e.target).find($('.save-details')), return_message = $(e.target).find($('.return-message'));
		let inputs = document.getElementById("remove-player-form").elements;
		let playerId = inputs["player_id"].value;

		return_message.html('');

		button.prop('disabled', true);
		button.find($('.icon-feather-save')).hide();
		button.find($('.icon-material-outline-add')).hide();
		button.find($('.icon-feather-trash-2')).hide();
		button.find($('.fa-spin')).show();

		$.post('settings_update.php', $(e.target).serialize(), data => {			
			setTimeout(() => {
				return_message.html(data);
				button.prop('disabled', false);
				button.find($('.icon-feather-save')).show();
				button.find($('.icon-material-outline-add')).show();
				button.find($('.icon-feather-trash-2')).show();
				button.find($('.fa-spin')).hide();

			}, 1000);

			$(`#player_${playerId}`).fadeOut();

		});
				
	});


	/*--------------------------------------------------*/
	/*  Form submission
	/*--------------------------------------------------*/
	$('.add-players-form').on('submit', function(e) {
		e.preventDefault();

		let button = $(e.target).find($('.save-details')), return_message = $(e.target).find($('.return-message'));
		let inputs = document.getElementById("add-players-form").elements;
		let playerName = inputs["player_name"].value;
		let playerPosition = inputs["player_position"].value;

		return_message.html('');

		button.prop('disabled', true);
		button.find($('.icon-feather-save')).hide();
		button.find($('.icon-material-outline-add')).hide();
		button.find($('.fa-spin')).show();

		$.post('settings_update.php', $(e.target).serialize(), data => {			
			setTimeout(() => {
				return_message.html(data);
				button.prop('disabled', false);
				button.find($('.icon-feather-save')).show();
				button.find($('.icon-material-outline-add')).show();
				button.find($('.fa-spin')).hide();

			}, 1000);			

		});

		let html = '';

		html += `<tr><td>${playerName}</td><td></td><td>${playerPosition}</td></tr>`;

		$('#players-container').append(html);
				
	});


	/*--------------------------------------------------*/
	/*  Form submission
	/*--------------------------------------------------*/
	$('.add-fixture-form').on('submit', function(e) {
		e.preventDefault();

		let button = $(e.target).find($('.save-details')), return_message = $(e.target).find($('.return-message'));
		let inputs = document.getElementById("add-fixture-form").elements;
		let otherTeam = inputs["other_team"].value;

		return_message.html('');

		button.prop('disabled', true);
		button.find($('.icon-feather-save')).hide();
		button.find($('.icon-material-outline-add')).hide();
		button.find($('.fa-spin')).show();

		$.post('settings_update.php', $(e.target).serialize(), data => {			
			setTimeout(() => {
				return_message.html(data);
				button.prop('disabled', false);
				button.find($('.icon-feather-save')).show();
				button.find($('.icon-material-outline-add')).show();
				button.find($('.fa-spin')).hide();

			}, 1000);			

		});

		let html = '';

		html += `<div class="col-xl-3"><div class="companies-list"><a href="fixtures.php" class="company"><div class="company-inner-alignment"><h4 class="margin-bottom-10"><span>X </span>${otherTeam}</h4></div></a></div></div>`;

		$('#fixtures-container').append(html);
				
	});


	/*--------------------------------------------------*/
	/*  Settings form submission
	/*--------------------------------------------------*/
	$('.remove-fixture-form').on('submit', function(e) {
		e.preventDefault();

		let button = $(e.target).find($('.save-details')), return_message = $(e.target).find($('.return-message'));
		let inputs = document.getElementById("remove-fixture-form").elements;
		let fixtureId = inputs["fixture_id"].value;

		return_message.html('');

		button.prop('disabled', true);
		button.find($('.icon-feather-save')).hide();
		button.find($('.icon-material-outline-add')).hide();
		button.find($('.icon-feather-trash-2')).hide();
		button.find($('.fa-spin')).show();

		$.post('settings_update.php', $(e.target).serialize(), data => {			
			setTimeout(() => {
				return_message.html(data);
				button.prop('disabled', false);
				button.find($('.icon-feather-save')).show();
				button.find($('.icon-material-outline-add')).show();
				button.find($('.icon-feather-trash-2')).show();
				button.find($('.fa-spin')).hide();

			}, 1000);

			$(`#fixture_${fixtureId}`).fadeOut();

		});
				
	});


	/*--------------------------------------------------*/
	/*  Child form submission
	/*--------------------------------------------------*/
	$('.child-form').on('submit', function(e) {
		e.preventDefault();

		let button = $(e.target).find($('.save-details')), return_message = $(e.target).find($('.return-message'));
		let inputs = document.getElementById("child-form").elements;
		let childName = inputs["first_name_child"].value;
		let childLastName = inputs["last_name_child"].value;

		return_message.html('');

		button.prop('disabled', true);
		button.find($('.icon-feather-save')).hide();
		button.find($('.icon-material-outline-add')).hide();
		button.find($('.fa-spin')).show();

		$.post('settings_update.php', $(e.target).serialize(), data => {			
			setTimeout(() => {
				return_message.html(data);
				button.prop('disabled', false);
				button.find($('.icon-feather-save')).show();
				button.find($('.icon-material-outline-add')).show();
				button.find($('.fa-spin')).hide();

			}, 1000);			

		});

		let html = '';

		html += `<div class="attachment-box ripple-effect" id="child-container" style="display: inline-grid;"><p>${childName} ${childLastName}</p></div>`;

		$('#child-container').prepend(html);
				
	});


	/*--------------------------------------------------*/
	/*  Child Delete
	/*--------------------------------------------------*/
	$(document).on('click', '.remove-child', function(e){ 
    	e.preventDefault();	
		let child_id = $(e.target).data("id");	

		if (child_id){
			$.get(`settings_update.php?remove_child_id=${child_id}`);			
			$(`#child_${child_id}`).fadeOut();

		}

	});
	

	/*--------------------------------------------------*/
	/*  Settings Attachment Upload
	/*--------------------------------------------------*/
	$('#attachment-upload').on('change', function(e) {
		if ($(e.target)[0].files.length > 0){
			let formData = new FormData(), button = $('#attachment-upload-label');

			for (let x = 0, l = $(e.target)[0].files.length; x < l; x++){	
				formData.append(`attachments[${x}]`, $(e.target)[0].files[x]);						
			}
			
			button.find($('.ico-save')).hide();
			button.find($('.fa-spin')).show();

			$.ajax({
				url : 'settings_update.php',
				type : 'POST',
				data : formData,
				processData: false, 
				contentType: false, 
				success : function(data) {
					setTimeout(() => {
						let ret = $.parseJSON(data), button = $('#attachment-upload-label'), upload = $('#attachment-upload');

						upload.val('');
						$('.uploadButton-file-name').html('');
						
						button.find($('.ico-save')).show();
						button.find($('.fa-spin')).hide();

						if (ret.length){
							let html = '';
							ret.forEach(attachment => {
								html += `<div class="attachment-box ripple-effect" id="attachment_${attachment[0]}">`; 
								html += `<span><a href="settings_update.php?download_attachment_id=${attachment[0]}">${attachment[1]}</a></span>`;
								html += `<i>${attachment[2].toUpperCase()}</i><button class="remove-attachment" data-tippy-placement="top" data-id="${attachment[0]}" title="Remove"></button>`;
								html += '</div>';

							});

							$('#attachments-container').prepend(html);

						}

					}, 1000);	

				}

			});

		}

	});

	/*--------------------------------------------------*/
	/*  Settings Attachment Delete
	/*--------------------------------------------------*/
	$(document).on('click', '.remove-attachment', function(e){ 
    	e.preventDefault();	
		let attachment_id = $(e.target).data("id");	

		if (attachment_id){
			$.get(`settings_update.php?remove_attachment_id=${attachment_id}`);			
			$(`#attachment_${attachment_id}`).fadeOut();

		}

	});

	/*--------------------------------------------------*/
	/*  Job deletion
	/*--------------------------------------------------*/
	$(document).on('click', '.job-deletion', function(e){ 
    	e.preventDefault();	
		let job_id = $(e.target).data("job_id");	

		let jobPostOverlay = $('#job-post-overlay'), 
			jobPostDelete = $('#job-post-delete');

		jobPostDelete.html(`<ul><li>Are you sure you want to delete this job?</li>` + 
						   `<li class="q"><a href="#" class="job-deletion-confirm" data-job_id="${job_id}">YES</a><a class="job-deletion-close" href="#">NO</a></li></ul>`);	

		jobPostOverlay.css('display', 'block');
		jobPostDelete.css('display', 'flex');

	});

	$(document).on('click', '.job-deletion-confirm', function(e){ 
    	e.preventDefault();	
		let job_id = $(e.target).data("job_id");	

		let jobPostOverlay = $('#job-post-overlay'), 
			jobPostDelete = $('#job-post-delete');

		jobPostDelete.css('height', '80px');
		jobPostDelete.css('margin', '-40px 0 0 -150px');
		jobPostDelete.html(`<i class="fas fa-circle-notch fa-spin"></i><ul><li>Deleting job</li><li>Please wait ...</li></ul>`);	

		$.get(`jobs_update.php?job_delete_id=${job_id}`, data => {			
			setTimeout(() => {
				let message = '';

				if (data == 'job_deleted'){
					$(`#job_${job_id}`).fadeOut();
					message = '<i class="fas fa-check-circle"></i><ul><li>Job deleted with success</li>';	

				}else{
					message = `<i class="fas fa-exclamation-circle"></i><ul><li>${data}</li>`;

				}

				message += '<li class="r"><a href="#" class="job-deletion-close">Click here</a> to close.</li></ul>';				
				jobPostDelete.html(message);				

			}, 1000);			

		});

	});

	$(document).on('click', '.job-deletion-close', function(e){ 
    	e.preventDefault();	

		$('#job-post-overlay').css('display', 'none');
		$('#job-post-delete').css('display', 'none');
		$('#job-post-delete').css('height', '120px');
		$('#job-post-delete').css('margin', '-60px 0 0 -150px');

	});

	/*--------------------------------------------------*/
	/*  Job post form submission
	/*--------------------------------------------------*/
	$('#jobs-post-submit').on('submit', function(e) {
		e.preventDefault();		

		let jobPostOverlay = $('#job-post-overlay'), 
			jobPostLoader = $('#job-post-loader'), 
			type = $(e.target).find('input[name="post_job"]').length > 0 ? 'add' : 'edit';
		
		jobPostLoader.html(`<i class="fas fa-circle-notch fa-spin"></i><ul><li>${type == 'add' ? 'Creating a new job' : 'Editing job'}</li><li>Please wait ...</li></ul>`);
		jobPostOverlay.css('display', 'block');
		jobPostLoader.css('display', 'flex');

		$.post('jobs_update.php', $(e.target).serialize(), data => {			
			setTimeout(() => {
				let message = '';

				if (data == 'job_added'){
					message = '<i class="fas fa-check-circle"></i><ul><li>Job created with success</li>';
				}else if (data == 'job_edited'){
					message = '<i class="fas fa-check-circle"></i><ul><li>Job edited with success</li>';	
				}else{
					message = `<i class="fas fa-exclamation-circle"></i><ul><li>${data}</li>`;
				}

				message += '<li><a href="#" id="jobs-post-submit-close">Click here</a> to close.</li></ul>';
				
				jobPostLoader.html(message);
				
				if (data == 'job_added'){
					$(e.target).trigger('reset');	
					$(".selectpicker").val('default').selectpicker("refresh");			
				}

			}, 1000);			

		});
				
	});

	$(document).on('click', '#jobs-post-submit-close', function(e){ 
    	e.preventDefault();	

		$('#job-post-overlay').css('display', 'none');
		$('#job-post-loader').css('display', 'none');

	});


	/*--------------------------------------------------*/
	/*  Event post form submission
	/*--------------------------------------------------*/
	$('#events-post-submit').on('submit', function(e) {
		e.preventDefault();		

		let eventPostOverlay = $('#post-overlay'), 
			eventPostLoader = $('#post-loader'), 
			type = $(e.target).find('input[name="post_event"]').length > 0 ? 'add' : 'edit';
		
		eventPostLoader.html(`<i class="fas fa-circle-notch fa-spin"></i><ul><li>${type == 'add' ? 'Creating a new event' : 'Editing event'}</li><li>Please wait ...</li></ul>`);
		eventPostOverlay.css('display', 'block');
		eventPostLoader.css('display', 'flex');

		$.post('events_update.php', $(e.target).serialize(), data => {			
			setTimeout(() => {
				let message = '';

				if (data == 'event_added'){
					message = '<i class="fas fa-check-circle"></i><ul><li>Event created with success</li>';
				}else if (data == 'job_edited'){
					message = '<i class="fas fa-check-circle"></i><ul><li>Event edited with success</li>';	
				}else{
					message = `<i class="fas fa-exclamation-circle"></i><ul><li>${data}</li>`;
				}

				message += '<li><a href="#" id="events-post-submit-close">Click here</a> to close.</li></ul>';
				
				eventPostLoader.html(message);
				
				if (data == 'event_added'){
					$(e.target).trigger('reset');	
					$(".selectpicker").val('default').selectpicker("refresh");			
				}

			}, 1000);			

		});
				
	});

	$(document).on('click', '#events-post-submit-close', function(e){ 
    	e.preventDefault();	

		$('#post-overlay').css('display', 'none');
		$('#post-loader').css('display', 'none');

	});


	/*--------------------------------------------------*/
	/*  Event deletion
	/*--------------------------------------------------*/
	$(document).on('click', '.event-deletion', function(e){ 
    	e.preventDefault();	
		let event_id = $(e.target).data("event_id");	

		let eventPostOverlay = $('#post-overlay'), 
			eventPostDelete = $('#event-post-delete');

		eventPostDelete.html(`<ul><li>Are you sure you want to delete this event?</li>` + 
						   `<li class="q"><a href="#" class="event-deletion-confirm" data-event_id="${event_id}">YES</a><a class="event-deletion-close" href="#">NO</a></li></ul>`);	

		eventPostOverlay.css('display', 'block');
		eventPostDelete.css('display', 'flex');

	});

	$(document).on('click', '.event-deletion-confirm', function(e){ 
    	e.preventDefault();	
		let event_id = $(e.target).data("event_id");	

		let eventPostOverlay = $('#event-post-overlay'), 
			eventPostDelete = $('#event-post-delete');

		eventPostDelete.css('height', '80px');
		eventPostDelete.css('margin', '-40px 0 0 -150px');
		eventPostDelete.html(`<i class="fas fa-circle-notch fa-spin"></i><ul><li>Deleting event</li><li>Please wait ...</li></ul>`);	

		$.get(`events_update.php?event_delete_id=${event_id}`, data => {			
			setTimeout(() => {
				let message = '';

				if (data == 'event_deleted'){
					$(`#event_${event_id}`).fadeOut();
					message = '<i class="fas fa-check-circle"></i><ul><li>Event deleted with success</li>';	

				}else{
					message = `<i class="fas fa-exclamation-circle"></i><ul><li>${data}</li>`;

				}

				message += '<li class="r"><a href="#" class="event-deletion-close">Click here</a> to close.</li></ul>';				
				eventPostDelete.html(message);				

			}, 1000);			

		});

	});

	$(document).on('click', '.event-deletion-close', function(e){ 
    	e.preventDefault();	

		$('#post-overlay').css('display', 'none');
		$('#event-post-delete').css('display', 'none');
		$('#event-post-delete').css('height', '120px');
		$('#event-post-delete').css('margin', '-60px 0 0 -150px');

	});


	/*--------------------------------------------------*/
	/*  Gallery Upload
	/*--------------------------------------------------*/
	$('#gallery-upload').on('change', function(e) {
		if ($(e.target)[0].files.length > 0){
			let formData = new FormData(), button = $('#gallery-upload-label');

			for (let x = 0, l = $(e.target)[0].files.length; x < l; x++){	
				formData.append(`galleries[${x}]`, $(e.target)[0].files[x]);						
			}
			
			button.find($('.ico-save')).hide();
			button.find($('.fa-spin')).show();

			$.ajax({
				url : 'gallery_update.php',
				type : 'POST',
				data : formData,
				processData: false, 
				contentType: false, 
				success : function(data) {
					setTimeout(() => {
						let ret = $.parseJSON(data), button = $('#gallery-upload-label'), upload = $('#gallery-upload');

						upload.val('');
						$('.uploadButton-file-name').html('');
						
						button.find($('.ico-save')).show();
						button.find($('.fa-spin')).hide();

						if (ret.length){
							let html = '';
							ret.forEach(gallery => {
								html+=`<div class="gallery" id="gallery_${gallery[0]}">
                          <img class="gallery-img" src="${gallery[1]}" alt="Image" width="600" height="400">
                        </div>
                        <a href="#" data-id="${gallery[0]}" class="remove-gallery" style="height: 20px;">
                              <i class="icon-feather-trash-2 remove-gallery" data-id="${gallery[0]}" id="del_${gallery[0]}" title="Remove" data-tippy-placement="left"></i>
                            </a>`;

							});

							$('#galleries-container').prepend(html);

						}

					}, 1000);	

				}

			});

		}

	});

	/*--------------------------------------------------*/
	/*  Gallery Delete
	/*--------------------------------------------------*/
	$(document).on('click', '.remove-gallery', function(e){ 
    	e.preventDefault();	
		let gallery_id = $(e.target).data("id");	

		if (gallery_id){
			$.get(`gallery_update.php?remove_gallery_id=${gallery_id}`);			
			$(`#gallery_${gallery_id}`).fadeOut();
			$(`#del_${gallery_id}`).fadeOut();

		}

	});


	/*--------------------------------------------------*/
	/*  Work Experience Delete
	/*--------------------------------------------------*/
	$(document).on('click', '.remove-work', function(e){ 
    	e.preventDefault();	
		let work_id = $(e.target).data("id");	

		if (work_id){
			$.get(`work_update.php?remove_work_id=${work_id}`);			
			$(`#work_${work_id}`).fadeOut();
			$(`#del_${work_id}`).fadeOut();

		}

	});


	/*--------------------------------------------------*/
	/*  Education Delete
	/*--------------------------------------------------*/
	$(document).on('click', '.remove-edu', function(e){ 
    	e.preventDefault();	
		let edu_id = $(e.target).data("id");	

		if (edu_id){
			$.get(`edu_update.php?remove_edu_id=${edu_id}`);			
			$(`#edu_${edu_id}`).fadeOut();
			$(`#del_${edu_id}`).fadeOut();

		}

	});


	/*--------------------------------------------------*/
	/*  Contact Delete
	/*--------------------------------------------------*/
	$(document).on('click', '.remove-contact', function(e){ 
    	e.preventDefault();	
		let contact_id = $(e.target).data("id");	

		if (contact_id){
			$.get(`contacts_update.php?remove_contact_id=${contact_id}`);			
			$(`#contact_${contact_id}`).fadeOut();
			$(`#del_${contact_id}`).fadeOut();

		}

	});


	/*----------------------------------------------------*/
	/*  Notifications Boxes
	/*----------------------------------------------------*/
	$("a.close").removeAttr("href").on('click', function(){
		function slideFade(elem) {
			var fadeOut = { opacity: 0, transition: 'opacity 0.5s' };
			elem.css(fadeOut).slideUp();
		}
		slideFade($(this).parent());
	});

	/*--------------------------------------------------*/
	/*  Notification Dropdowns
	/*--------------------------------------------------*/
	$(".header-notifications").each(function() {
		var userMenu = $(this);
		var userMenuTrigger = $(this).find('.header-notifications-trigger a');

		$(userMenuTrigger).on('click', function(event) {
			event.preventDefault();

			if ( $(this).closest(".header-notifications").is(".active") ) {
	            close_user_dropdown();
	        } else {
	            close_user_dropdown();
	            userMenu.addClass('active');
	        }
		});
	});

	// Closing function
    function close_user_dropdown() {
		$('.header-notifications').removeClass("active");
    }

    // Closes notification dropdown on click outside the container
	var mouse_is_inside = false;

	$( ".header-notifications" ).on( "mouseenter", function() {
	  mouse_is_inside=true;
	});
	$( ".header-notifications" ).on( "mouseleave", function() {
	  mouse_is_inside=false;
	});

	$("body").mouseup(function(){
	    if(! mouse_is_inside) close_user_dropdown();
	});

	// Close with ESC
	$(document).keyup(function(e) { 
		if (e.keyCode == 27) {
			close_user_dropdown();
		}
	});


	/*--------------------------------------------------*/
	/*  User Status Switch
	/*--------------------------------------------------*/
	if ($('.status-switch label.user-invisible').hasClass('current-status')) {
		$('.status-indicator').addClass('right');
	}

	$('.status-switch label.user-invisible').on('click', function(){
		$('.status-indicator').addClass('right');
		$('.status-switch label').removeClass('current-status');
		$('.user-invisible').addClass('current-status');
	});

	$('.status-switch label.user-online').on('click', function(){
		$('.status-indicator').removeClass('right');
		$('.status-switch label').removeClass('current-status');
		$('.user-online').addClass('current-status');
	});


	/*--------------------------------------------------*/
	/*  Full Screen Page Scripts
	/*--------------------------------------------------*/

	// Wrapper Height (window height - header height)
	function wrapperHeight() {
		var headerHeight = $("#header-container").outerHeight();
		var windowHeight = $(window).outerHeight() - headerHeight;
		$('.full-page-content-container, .dashboard-content-container, .dashboard-sidebar-inner, .dashboard-container, .full-page-container').css({ height: windowHeight });
		$('.dashboard-content-inner').css({ 'min-height': windowHeight });
	}

	// Enabling Scrollbar
	function fullPageScrollbar() {
		$(".full-page-sidebar-inner, .dashboard-sidebar-inner").each(function() {

			var headerHeight = $("#header-container").outerHeight();
			var windowHeight = $(window).outerHeight() - headerHeight;
			var sidebarContainerHeight = $(this).find(".sidebar-container, .dashboard-nav-container").outerHeight();

			// Enables scrollbar if sidebar is higher than wrapper
			if (sidebarContainerHeight > windowHeight) {
				$(this).css({ height: windowHeight });
		
			} else {
				$(this).find('.simplebar-track').hide();
			}
		});
	}

	// Init
	$(window).on('load resize', function() {
		wrapperHeight();
		fullPageScrollbar();
	});
	wrapperHeight();
	fullPageScrollbar();

	// Sliding Sidebar 
	$('.enable-filters-button').on('click', function(){
		$('.full-page-sidebar').toggleClass("enabled-sidebar");
		$(this).toggleClass("active");
		$('.filter-button-tooltip').removeClass('tooltip-visible');
	});

	/*  Enable Filters Button Tooltip */
	$(window).on('load', function() {
		$('.filter-button-tooltip').css({
			left: $('.enable-filters-button').outerWidth() + 48
		})
		.addClass('tooltip-visible');
	});

	// Avatar Switcher
	function avatarSwitcher() {
	    var readURL = function(input) {
	        if (input.files && input.files[0]) {
	            var reader = new FileReader();

	            reader.onload = function (e) {
	                $('.profile-pic').attr('src', e.target.result);
	            };
	    
	            reader.readAsDataURL(input.files[0]);
	        }
	    };
	   
	    $(".file-upload").on('change', function(){
	        readURL(this);
	    });
	    
	    $(".upload-button").on('click', function() {
	       $(".file-upload").click();
	    });
	} avatarSwitcher();


	/*----------------------------------------------------*/
	/* Dashboard Scripts
	/*----------------------------------------------------*/

	// Dashboard Nav Submenus
    $('.dashboard-nav ul li a').on('click', function(e){
		if($(this).closest("li").children("ul").length) {
			if ( $(this).closest("li").is(".active-submenu") ) {
	           $('.dashboard-nav ul li').removeClass('active-submenu');
	        } else {
	            $('.dashboard-nav ul li').removeClass('active-submenu');
	            $(this).parent('li').addClass('active-submenu');
	        }
	        e.preventDefault();
		}
	});


	// Responsive Dashboard Nav Trigger
    $('.dashboard-responsive-nav-trigger').on('click', function(e){
    	e.preventDefault();
		$(this).toggleClass('active');

		var dashboardNavContainer = $('body').find(".dashboard-nav");

		if( $(this).hasClass('active') ){
			$(dashboardNavContainer).addClass('active');
		} else {
			$(dashboardNavContainer).removeClass('active');
		}

		$('.dashboard-responsive-nav-trigger .hamburger').toggleClass('is-active');

	});

	// Fun Facts
	function funFacts() {
		/*jslint bitwise: true */
		function hexToRgbA(hex){
		    var c;
		    if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
		        c= hex.substring(1).split('');
		        if(c.length== 3){
		            c= [c[0], c[0], c[1], c[1], c[2], c[2]];
		        }
		        c= '0x'+c.join('');
		        return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',0.07)';
		    }
		}

		$(".fun-fact").each(function() {
			var factColor = $(this).attr('data-fun-fact-color');

	        if(factColor !== undefined) {
	        	$(this).find(".fun-fact-icon").css('background-color', hexToRgbA(factColor));
	            $(this).find("i").css('color', factColor);
	        }
		});

	} funFacts();


	// Notes & Messages Scrollbar
	$(window).on('load resize', function() {
		var winwidth = $(window).width();
		if ( winwidth > 1199) {

			// Notes
			$('.row').each(function() {
				var mbh = $(this).find('.main-box-in-row').outerHeight();
				var cbh = $(this).find('.child-box-in-row').outerHeight();
				if ( mbh < cbh ) {
					var headerBoxHeight = $(this).find('.child-box-in-row .headline').outerHeight();
					var mainBoxHeight = $(this).find('.main-box-in-row').outerHeight() - headerBoxHeight + 39;

					$(this).find('.child-box-in-row .content')
							.wrap('<div class="dashboard-box-scrollbar" style="max-height: '+mainBoxHeight+'px" data-simplebar></div>');
				}
			});

			// Messages Sidebar
			// var messagesList = $(".messages-inbox").outerHeight();
			// var messageWrap = $(".message-content").outerHeight();
			// if ( messagesList > messagesWrap) {
			// 	$(messagesList).css({
			// 		'max-height': messageWrap,
			// 	});
			// }
		}
	});

	// Mobile Adjustment for Single Button Icon in Dashboard Box
	$('.buttons-to-right').each(function() {
		var btr = $(this).width();
		if (btr < 36) {
			$(this).addClass('single-right-button');
		}
	});

	// Small Footer Adjustment
	$(window).on('load resize', function() {
		var smallFooterHeight = $('.small-footer').outerHeight();
		$('.dashboard-footer-spacer').css({
			'padding-top': smallFooterHeight + 45
		});
	});


	// Auto Resizing Message Input Field
    /* global jQuery */
	jQuery.each(jQuery('textarea[data-autoresize]'), function() {
		var offset = this.offsetHeight - this.clientHeight;

		var resizeTextarea = function(el) {
		    jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
		};
		jQuery(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');
	});


	/*--------------------------------------------------*/
	/*  Star Rating
	/*--------------------------------------------------*/
	function starRating(ratingElem) {

		$(ratingElem).each(function() {

			var dataRating = $(this).attr('data-rating');

			// Rating Stars Output
			function starsOutput(firstStar, secondStar, thirdStar, fourthStar, fifthStar) {
				return(''+
					'<span class="'+firstStar+'"></span>'+
					'<span class="'+secondStar+'"></span>'+
					'<span class="'+thirdStar+'"></span>'+
					'<span class="'+fourthStar+'"></span>'+
					'<span class="'+fifthStar+'"></span>');
			}

			var fiveStars = starsOutput('star','star','star','star','star');

			var fourHalfStars = starsOutput('star','star','star','star','star half');
			var fourStars = starsOutput('star','star','star','star','star empty');

			var threeHalfStars = starsOutput('star','star','star','star half','star empty');
			var threeStars = starsOutput('star','star','star','star empty','star empty');

			var twoHalfStars = starsOutput('star','star','star half','star empty','star empty');
			var twoStars = starsOutput('star','star','star empty','star empty','star empty');

			var oneHalfStar = starsOutput('star','star half','star empty','star empty','star empty');
			var oneStar = starsOutput('star','star empty','star empty','star empty','star empty');

			// Rules
	        if (dataRating >= 4.75) {
	            $(this).append(fiveStars);
	        } else if (dataRating >= 4.25) {
	            $(this).append(fourHalfStars);
	        } else if (dataRating >= 3.75) {
	            $(this).append(fourStars);
	        } else if (dataRating >= 3.25) {
	            $(this).append(threeHalfStars);
	        } else if (dataRating >= 2.75) {
	            $(this).append(threeStars);
	        } else if (dataRating >= 2.25) {
	            $(this).append(twoHalfStars);
	        } else if (dataRating >= 1.75) {
	            $(this).append(twoStars);
	        } else if (dataRating >= 1.25) {
	            $(this).append(oneHalfStar);
	        } else if (dataRating < 1.25) {
	            $(this).append(oneStar);
	        }

		});

	} starRating('.star-rating');


	/*--------------------------------------------------*/
	/*  Enabling Scrollbar in User Menu
	/*--------------------------------------------------*/
	function userMenuScrollbar() {
		$(".header-notifications-scroll").each(function() {
			var scrollContainerList = $(this).find('ul');
			var itemsCount = scrollContainerList.children("li").length;
      var notificationItems;
      
			// Determines how many items are displayed based on items height
      /* jshint shadow:true */
			if (scrollContainerList.children("li").outerHeight() > 140) {
				var notificationItems = 2;
			} else {
				var notificationItems = 3;
			}
    
      
			// Enables scrollbar if more than 2 items
			if (itemsCount > notificationItems) {

			    var listHeight = 0;

			    $(scrollContainerList).find('li:lt('+notificationItems+')').each(function() {
			       listHeight += $(this).height();
			    });

				$(this).css({ height: listHeight });
		
			} else {
				$(this).css({ height: 'auto' });
				$(this).find('.simplebar-track').hide();
			}
		});
	}

	// Init
	userMenuScrollbar();


	/*--------------------------------------------------*/
	/*  Tippy JS 
	/*--------------------------------------------------*/
    /* global tippy */
	tippy('[data-tippy-placement]', {
		delay: 100,
		arrow: true,
		arrowType: 'sharp',
		size: 'regular',
		duration: 200,

		// 'shift-toward', 'fade', 'scale', 'perspective'
		animation: 'shift-away',

		animateFill: true,
		theme: 'dark',

		// How far the tooltip is from its reference element in pixels 
		distance: 10,

	});


	/*----------------------------------------------------*/
	/*	Accordion @Lewis Briffa
	/*----------------------------------------------------*/
	var accordion = (function(){
	  
	  var $accordion = $('.js-accordion');
	  var $accordion_header = $accordion.find('.js-accordion-header');
	 
	  // default settings 
	  var settings = {
	    // animation speed
	    speed: 400,
	    
	    // close all other accordion items if true
	    oneOpen: false
	  };
	    
	  return {
	    // pass configurable object literal
	    init: function($settings) {
	      $accordion_header.on('click', function() {
	        accordion.toggle($(this));
	      });
	      
	      $.extend(settings, $settings); 
	      
	      // ensure only one accordion is active if oneOpen is true
	      if(settings.oneOpen && $('.js-accordion-item.active').length > 1) {
	        $('.js-accordion-item.active:not(:first)').removeClass('active');
	      }
	      
	      // reveal the active accordion bodies
	      $('.js-accordion-item.active').find('> .js-accordion-body').show();
	    },
	    toggle: function($this) {
	            
	      if(settings.oneOpen && $this[0] != $this.closest('.js-accordion').find('> .js-accordion-item.active > .js-accordion-header')[0]) {
	        $this.closest('.js-accordion')
	               .find('> .js-accordion-item') 
	               .removeClass('active')
	               .find('.js-accordion-body')
	               .slideUp();
	      }
	      
	      // show/hide the clicked accordion item
	      $this.closest('.js-accordion-item').toggleClass('active');
	      $this.next().stop().slideToggle(settings.speed);
	    }
	  };
	})();

	$(document).ready(function(){
	  accordion.init({ speed: 300, oneOpen: true });
	});


	/*--------------------------------------------------*/
	/*  Tabs
	/*--------------------------------------------------*/
	$(window).on('load resize', function() {
	if ($(".tabs")[0]){
		$('.tabs').each(function() {
			
			  var thisTab = $(this);

			  // Intial Border Position
			  var activePos = thisTab.find('.tabs-header .active').position();

			  function changePos() {

			    // Update Position
			    activePos = thisTab.find('.tabs-header .active').position();

			    // Change Position & Width
			    thisTab.find('.tab-hover').stop().css({
			      left: activePos.left,
			      width: thisTab.find('.tabs-header .active').width()
			    });
			  }

			  changePos();

			  // Intial Tab Height
			  var tabHeight = thisTab.find('.tab.active').outerHeight();

			  // Animate Tab Height
			  function animateTabHeight() {

			    // Update Tab Height
			    tabHeight = thisTab.find('.tab.active').outerHeight();

			    // Animate Height
			    thisTab.find('.tabs-content').stop().css({
			      height: tabHeight + 'px'
			    });
			  }

			  animateTabHeight();

			  // Change Tab
			  function changeTab() {
			    var getTabId = thisTab.find('.tabs-header .active a').attr('data-tab-id');

			    // Remove Active State
			    thisTab.find('.tab').stop().fadeOut(300, function () {
			      // Remove Class
			      $(this).removeClass('active');
			    }).hide();

			    thisTab.find('.tab[data-tab-id=' + getTabId + ']').stop().fadeIn(300, function () {
			      // Add Class
			      $(this).addClass('active');

			      // Animate Height
			      animateTabHeight();
			    });
			  }

			  // Tabs
			  thisTab.find('.tabs-header a').on('click', function (e) {
			    e.preventDefault();

			    // Tab Id
			    var tabId = $(this).attr('data-tab-id');

			    // Remove Active State
			    thisTab.find('.tabs-header a').stop().parent().removeClass('active');

			    // Add Active State
			    $(this).stop().parent().addClass('active');

			    changePos();

			    // Update Current Itm
			    tabCurrentItem = tabItems.filter('.active');

			    // Remove Active State
			    thisTab.find('.tab').stop().fadeOut(300, function () {
			      // Remove Class
			      $(this).removeClass('active');
			    }).hide();

			    // Add Active State
			    thisTab.find('.tab[data-tab-id="' + tabId + '"]').stop().fadeIn(300, function () {
			      // Add Class
			      $(this).addClass('active');

			      // Animate Height
			      animateTabHeight();
			    });
			  });

			  // Tab Items
			  var tabItems = thisTab.find('.tabs-header ul li');

			  // Tab Current Item
			  var tabCurrentItem = tabItems.filter('.active');

			  // Next Button
			  thisTab.find('.tab-next').on('click', function (e) {
			    e.preventDefault();

			    var nextItem = tabCurrentItem.next();

			    tabCurrentItem.removeClass('active');

			    if (nextItem.length) {
			      tabCurrentItem = nextItem.addClass('active');
			    } else {
			      tabCurrentItem = tabItems.first().addClass('active');
			    }

			    changePos();
			    changeTab();
			  });

			  // Prev Button
			  thisTab.find('.tab-prev').on('click', function (e) {
			    e.preventDefault();

			    var prevItem = tabCurrentItem.prev();

			    tabCurrentItem.removeClass('active');

			    if (prevItem.length) {
			      tabCurrentItem = prevItem.addClass('active');
			    } else {
			      tabCurrentItem = tabItems.last().addClass('active');
			    }

			    changePos();
			    changeTab();
			  });
	  	});
	}
	});


	/*--------------------------------------------------*/
	/*  Keywords
	/*--------------------------------------------------*/
	$(".keywords-container").each(function() {

		var keywordInput = $(this).find(".keyword-input");
		var keywordsList = $(this).find(".keywords-list");

		// adding keyword
		function addKeyword() {
			var $newKeyword = $("<span class='keyword'><span class='keyword-remove'></span><span class='keyword-text'>"+ keywordInput.val() +"</span></span>");
			keywordsList.append($newKeyword).trigger('resizeContainer');
			keywordInput.val("");
		}

		// add via enter key
		keywordInput.on('keyup', function(e){
			if((e.keyCode == 13) && (keywordInput.val()!=="")){
				addKeyword();
			}
		});

		// add via button
		$('.keyword-input-button').on('click', function(){ 
			if((keywordInput.val()!=="")){
				addKeyword();
			}
		});

		// removing keyword
		$(document).on("click",".keyword-remove", function(){
			$(this).parent().addClass('keyword-removed');

			function removeFromMarkup(){
			  $(".keyword-removed").remove();
			}
			setTimeout(removeFromMarkup, 500);
			keywordsList.css({'height':'auto'}).height();
		});


		// animating container height
		keywordsList.on('resizeContainer', function(){
		    var heightnow = $(this).height();
		    var heightfull = $(this).css({'max-height':'auto', 'height':'auto'}).height();

			$(this).css({ 'height' : heightnow }).animate({ 'height': heightfull }, 200);
		});

		$(window).on('resize', function() {
			keywordsList.css({'height':'auto'}).height();
		});

		// Auto Height for keywords that are pre-added
		$(window).on('load', function() {
			var keywordCount = $('.keywords-list').children("span").length;

			// Enables scrollbar if more than 3 items
			if (keywordCount > 0) {
				keywordsList.css({'height':'auto'}).height();
		
			} 
		});

	});


	/*--------------------------------------------------*/
	/*  Bootstrap Range Slider
	/*--------------------------------------------------*/

	// Thousand Separator
	function ThousandSeparator(nStr) {
	    nStr += '';
	    var x = nStr.split('.');
	    var x1 = x[0];
	    var x2 = x.length > 1 ? '.' + x[1] : '';
	    var rgx = /(\d+)(\d{3})/;
	    while (rgx.test(x1)) {
	        x1 = x1.replace(rgx, '$1' + ',' + '$2');
	    }
	    return x1 + x2;
	}

	// Bidding Slider Average Value
	var avgValue = (parseInt($('.bidding-slider').attr("data-slider-min")) + parseInt($('.bidding-slider').attr("data-slider-max")))/2;
	if ($('.bidding-slider').data("slider-value") === 'auto') {
		$('.bidding-slider').attr({'data-slider-value': avgValue});
	}

	// Bidding Slider Init
	$('.bidding-slider').slider();

	$(".bidding-slider").on("slide", function(slideEvt) {
		$("#biddingVal").text(ThousandSeparator(parseInt(slideEvt.value)));
	});
	$("#biddingVal").text(ThousandSeparator(parseInt($('.bidding-slider').val())));


	// Default Bootstrap Range Slider
	var currencyAttr = $(".range-slider").attr('data-slider-currency');
	
	$(".range-slider").slider({
		formatter: function(value) {
			return currencyAttr + ThousandSeparator(parseInt(value[0])) + " - " + currencyAttr + ThousandSeparator(parseInt(value[1]));
		}
	});
	
	$(".range-slider-single").slider();


	/*----------------------------------------------------*/
	/*  Payment Accordion
	/*----------------------------------------------------*/
    var radios = document.querySelectorAll('.payment-tab-trigger > input');
 
    for (var i = 0; i < radios.length; i++) {
        radios[i].addEventListener('change', expandAccordion);
    }
 
    function expandAccordion (event) {
      /* jshint validthis: true */
      var tabber = this.closest('.payment');
      var allTabs = tabber.querySelectorAll('.payment-tab');
      for (var i = 0; i < allTabs.length; i++) {
        allTabs[i].classList.remove('payment-tab-active');
      }
      event.target.parentNode.parentNode.classList.add('payment-tab-active');
    }

	$('.billing-cycle-radios').on("click", function() {
		if($('.billed-yearly-radio input').is(':checked')) { $('.pricing-plans-container').addClass('billed-yearly'); }
		if($('.billed-monthly-radio input').is(':checked')) { $('.pricing-plans-container').removeClass('billed-yearly'); }
	});


	/*--------------------------------------------------*/
	/*  Quantity Buttons
	/*--------------------------------------------------*/
	function qtySum(){
	    var arr = document.getElementsByName('qtyInput');
	    var tot=0;
	    for(var i=0;i<arr.length;i++){
	        if(parseInt(arr[i].value))
	            tot += parseInt(arr[i].value);
	    }
	} 
	qtySum();

   $(".qtyDec, .qtyInc").on("click", function() {

      var $button = $(this);
      var oldValue = $button.parent().find("input").val();

      if ($button.hasClass('qtyInc')) {
          $button.parent().find("input").val(parseFloat(oldValue) + 1);
      } else {
         if (oldValue > 1) {
            $button.parent().find("input").val(parseFloat(oldValue) - 1);
         } else {
            $button.parent().find("input").val(1);
         }
      }

      qtySum();
      $(".qtyTotal").addClass("rotate-x");

   });


	/*----------------------------------------------------*/
	/*  Inline CSS replacement for backgrounds
	/*----------------------------------------------------*/
	function inlineBG() {

		// Common Inline CSS
		$(".single-page-header, .intro-banner").each(function() {
			var attrImageBG = $(this).attr('data-background-image');

	        if(attrImageBG !== undefined) {
	        	$(this).append('<div class="background-image-container"></div>');
	            $('.background-image-container').css('background-image', 'url('+attrImageBG+')');
	        }
		});

	} inlineBG();

	// Fix for intro banner with label
	$(".intro-search-field").each(function() {
		var bannerLabel = $(this).children("label").length;
		if ( bannerLabel > 0 ){
		    $(this).addClass("with-label");
		}
	});

	// Photo Boxes
	$(".photo-box, .photo-section, .video-container").each(function() {
		var photoBox = $(this);
		var photoBoxBG = $(this).attr('data-background-image');

        if(photoBox !== undefined) {
            $(this).css('background-image', 'url('+photoBoxBG+')');
        }
	});


	/*----------------------------------------------------*/
	/*  Share URL and Buttons
	/*----------------------------------------------------*/
  /* global ClipboardJS */
	$('.copy-url input').val(window.location.href);
	new ClipboardJS('.copy-url-button');

	$(".share-buttons-icons a").each(function() {
		var buttonBG = $(this).attr("data-button-color");
        if(buttonBG !== undefined) {
        	$(this).css('background-color',buttonBG);
        }
	});


	/*----------------------------------------------------*/
	/*  Tabs
	/*----------------------------------------------------*/
	var $tabsNav    = $('.popup-tabs-nav'),
	$tabsNavLis = $tabsNav.children('li');

	$tabsNav.each(function() {
		 var $this = $(this);

		 $this.next().children('.popup-tab-content').stop(true,true).hide().first().show();
		 $this.children('li').first().addClass('active').stop(true,true).show();
	});

	$tabsNavLis.on('click', function(e) {
		 var $this = $(this);

		 $this.siblings().removeClass('active').end().addClass('active');

		 $this.parent().next().children('.popup-tab-content').stop(true,true).hide()
		 .siblings( $this.find('a').attr('href') ).fadeIn();

		 e.preventDefault();
	});

	var hash = window.location.hash;
	var anchor = $('.tabs-nav a[href="' + hash + '"]');
	if (anchor.length === 0) {
		 $(".popup-tabs-nav li:first").addClass("active").show(); //Activate first tab
		 $(".popup-tab-content:first").show(); //Show first tab content
	} else {
		 anchor.parent('li').click();
	}

	// Link to Register Tab
	$('.register-tab').on('click', function(event) {
		event.preventDefault();
		$(".popup-tab-content").hide();
		$("#register.popup-tab-content").show();
		$("body").find('.popup-tabs-nav a[href="#register"]').parent("li").click();
	});

	// Disable tabs if there's only one tab
	$('.popup-tabs-nav').each(function() {
		var listCount = $(this).find("li").length;
		if ( listCount < 2 ) {
			$(this).css({
				'pointer-events': 'none'
			});
		}
	});


  	/*----------------------------------------------------*/
    /*  Indicator Bar
    /*----------------------------------------------------*/
	$('.indicator-bar').each(function() {
		var indicatorLenght = $(this).attr('data-indicator-percentage');
		$(this).find("span").css({
			width: indicatorLenght + "%"
		});
	});


    /*----------------------------------------------------*/
    /*  Custom Upload Button
    /*----------------------------------------------------*/

	var uploadButton = {
		$button    : $('.uploadButton-input'),
		$nameField : $('.uploadButton-file-name')
	};

	uploadButton.$button.on('change',function() {
		_populateFileField($(this));
	});

	function _populateFileField($button) {
		var selectedFile = [];
	    for (var i = 0; i < $button.get(0).files.length; ++i) {
	        selectedFile.push($button.get(0).files[i].name +'<br>');
	    }
	    uploadButton.$nameField.html(selectedFile);
	}


  	/*----------------------------------------------------*/
    /*  Slick Carousel
    /*----------------------------------------------------*/
	$('.default-slick-carousel').slick({
		infinite: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		dots: false,
		arrows: true,
		adaptiveHeight: true,
		responsive: [
		    {
		      breakpoint: 1292,
		      settings: {
		        dots: true,
		    	arrows: false
		      }
		    },
		    {
		      breakpoint: 993,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2,
		        dots: true,
		    	arrows: false
		      }
		    },
		    {
		      breakpoint: 769,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1,
		        dots: true,
		   		arrows: false
		      }
		    }
	  ]
	});


	$('.testimonial-carousel').slick({
	  centerMode: true,
	  centerPadding: '30%',
	  slidesToShow: 1,
	  dots: false,
	  arrows: true,
	  adaptiveHeight: true,
	  responsive: [
		{
		  breakpoint: 1600,
		  settings: {
			  centerPadding: '21%',
			  slidesToShow: 1,
		  }
		},
		{
		  breakpoint: 993,
		  settings: {
		    centerPadding: '15%',
		    slidesToShow: 1,
		  }
		},
		{
		  breakpoint: 769,
		  settings: {
		    centerPadding: '5%',
		    dots: true,
		    arrows: false
		  }
		}
	  ]
	});


	$('.logo-carousel').slick({
		infinite: true,
		slidesToShow: 5,
		slidesToScroll: 1,
		dots: false,
		arrows: true,
		responsive: [
			{
			  breakpoint: 1365,
			  settings: {
				slidesToShow: 5,
				dots: true,
				arrows: false
			  }
			},
			{
			  breakpoint: 992,
			  settings: {
				slidesToShow: 3,
				dots: true,
				arrows: false
			  }
			},
			{
			  breakpoint: 768,
			  settings: {
				slidesToShow: 1,
				dots: true,
				arrows: false
			  }
			}
		]
	});

	$('.blog-carousel').slick({
		infinite: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		dots: false,
		arrows: true,
		responsive: [
			{
			  breakpoint: 1365,
			  settings: {
				slidesToShow: 3,
				dots: true,
				arrows: false
			  }
			},
			{
			  breakpoint: 992,
			  settings: {
				slidesToShow: 2,
				dots: true,
				arrows: false
			  }
			},
			{
			  breakpoint: 768,
			  settings: {
				slidesToShow: 1,
				dots: true,
				arrows: false
			  }
			}
		]
	});

  	/*----------------------------------------------------*/
    /*  Magnific Popup
    /*----------------------------------------------------*/
	$('.mfp-gallery-container').each(function() { // the containers for all your galleries

		$(this).magnificPopup({
			 type: 'image',
			 delegate: 'a.mfp-gallery',

			 fixedContentPos: true,
			 fixedBgPos: true,

			 overflowY: 'auto',

			 closeBtnInside: false,
			 preloader: true,

			 removalDelay: 0,
			 mainClass: 'mfp-fade',

			 gallery:{enabled:true, tCounter: ''}
		});
	});

	$('.popup-with-zoom-anim').magnificPopup({
		 type: 'inline',

		 fixedContentPos: false,
		 fixedBgPos: true,

		 overflowY: 'auto',

		 closeBtnInside: true,
		 preloader: false,

		 midClick: true,
		 removalDelay: 300,
		 mainClass: 'my-mfp-zoom-in'
	});

	$('.mfp-image').magnificPopup({
		 type: 'image',
		 closeOnContentClick: true,
		 mainClass: 'mfp-fade',
		 image: {
			  verticalFit: true
		 }
	});

	$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
		 disableOn: 700,
		 type: 'iframe',
		 mainClass: 'mfp-fade',
		 removalDelay: 160,
		 preloader: false,

		 fixedContentPos: false
	});



// ------------------ End Document ------------------ //
});

})(this.jQuery);

