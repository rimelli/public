<?php
include("includes/header.php");

$message_obj = new Message($con, $userLoggedIn);

if(isset($_GET['u']))
	$user_to = $_GET['u'];
else {
	$user_to = $message_obj->getMostRecentUser();
	if($user_to == false)
		$user_to = 'new';
}
if($user_to != "new")
	$user_to_obj = new User($con, $user_to);
?>




<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>Hireo</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/colors/blue.css">

</head>
<body class="gray">

<!-- Wrapper -->
<div id="wrapper">


<!-- Dashboard Container -->
<div class="dashboard-container">

	<?php include("includes/side_menu.php"); ?>

	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container">
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Messages</h3>
			</div>
	
				<div class="messages-container margin-top-0">

					<div class="messages-container-inner">

						<!-- Messages -->
						<div class="messages-inbox">
							<div class="messages-headline">
								<div class="input-with-icon">
										<input id="autocomplete-input" type="text" placeholder="Search">
									<i class="icon-material-outline-search"></i>
								</div>
							</div>

							<ul>
								<div class="user_details column" id="conversations">
								
									<div class="loaded_conversations">
										<?php echo $message_obj->getConvos(); ?>
									</div>
								
								</div>
							</ul>
						</div>
						<!-- Messages / End -->

						<!-- Message Content -->
						<div class="message-content">

							<div class="messages-headline">
								<?php 
									if($user_to != "new") {
										echo "<h4>You and <a href='$user_to'>" . $user_to_obj->getFirstAndLastName() . "</a></h4><br>";
									}
									else {
										echo "<h4>New Message</h4>";
									}
								?>
								<a href="#" class="message-action"><i class="icon-feather-trash-2"></i> Delete Conversation</a>
							</div>
							
							<!-- Message Content Inner -->
							<div class="message-content-inner">

								<?php 
									if($user_to != "new") {

										echo "<div class='loaded_messages' id='scroll_messages'>";
											echo $message_obj->getMessages($user_to);
											echo "</div>";
									}
									else {
										echo "<h4>New Message</h4>";
									}
								?>
							</div>
							<!-- Message Content Inner / End -->
							
							<!-- Reply Area -->
							<form action="" method="POST" enctype="multipart/form-data" name="imgForm">
								<?php 
				 
									if($user_to == "new") {
									echo "Select the friend you would like to message <br><br>";
									?> 
									
									To: <input type='text' onkeyup='getUser(this.value, "<?php echo $userLoggedIn;?>")' name='q' placeholder='Name' autocomplete='off' id='search_text_input'>
				 
									<?php
									echo "<div class='results'></div>";
								}
				 
								else {
									echo "<textarea name='message_body' id='message_textarea' placeholder='Write your message...'></textarea>";
									?>
									<input type='button' onclick="sendMessage()" name='post_message' class='info' id='message_submit' value='Send'>
									<?php
									echo "<div class='uploadButton margin-top-0'>
											<input form='index-post' class='uploadButton-input' type='file' name='fileToUpload' id='fileToUpload' accept='image/*, application/pdf' multiple/>
											<label class='uploadButton-button ripple-effect' for='fileToUpload'>Upload</label>
											<span class='uploadButton-file-name'>Maximum file size: 10 MB</span>
										</div>";
								}
				 
								?>	
							</form>

						</div>
						<!-- Message Content -->

					</div>
			</div>
			<!-- Messages Container / End -->



			
			<!-- Footer -->
			<?php include("includes/footer.php"); ?>
			<!-- Footer / End -->

		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->

</div>
<!-- Wrapper / End -->


<!-- Apply for a job popup
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab">Add Note</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h3>Do Not Forget 😎</h3>
				</div>
					
				<!-- Form -->
				<form method="post" id="add-note">

					<select class="selectpicker with-border default margin-bottom-20" data-size="7" title="Priority">
						<option>Low Priority</option>
						<option>Medium Priority</option>
						<option>High Priority</option>
					</select>

					<textarea name="textarea" cols="10" placeholder="Note" class="with-border"></textarea>

				</form>
				
				<!-- Button -->
				<button class="button full-width button-sliding-icon ripple-effect" type="submit" form="add-note">Add Note <i class="icon-material-outline-arrow-right-alt"></i></button>

			</div>

		</div>
	</div>
</div>
<!-- Apply for a job popup / End -->


<!-- Scripts
================================================== -->
<script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="assets/js/jquery-migrate-3.3.1.min.js"></script>
<script src="assets/js/mmenu.min.js"></script>
<script src="assets/js/tippy.all.min.js"></script>
<script src="assets/js/simplebar.min.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script>
<script src="assets/js/bootstrap-select.min.js"></script>
<script src="assets/js/snackbar.js"></script>
<script src="assets/js/clipboard.min.js"></script>
<script src="assets/js/counterup.min.js"></script>
<script src="assets/js/magnific-popup.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/custom.js"></script>


<script>
 
	var div = document.getElementById("scroll_messages");
 
	if(div != null) {
		div.scrollTop = div.scrollHeight;
	}
 
	var userTo = "<?php echo $user_to; ?>";
 
	const sendMessage = () => {
 
		var body = $("textarea").val();
 
                var form = document.forms.namedItem("imgForm");
 
		var formData = new FormData(form);
 
		var otherData = [];
 
		otherData.push({"me":userLoggedIn, "body":body, "friend":userTo});
 
		formData.append('otherData', JSON.stringify(otherData));
 
		$.ajax({
	        type: "POST",
	        url: "includes/handlers/send_message.php",
	        data: formData,
	        contentType: false,
	        processData: false,   
    		success:(function(data) {
        	
        		$("textarea").val("");
 
			$(".checkSeen").remove();
    		})
		});
 
		const scrollDown = () => {
 
			div.scrollTop = div.scrollHeight;
		}
 
		setTimeout(scrollDown, 800);
 
		var file = document.getElementById("fileToUpload");	
		file.value = file.defaultValue;
	}
 
	const getMessages = () => {
 
		$.post("includes/handlers/get_messages.php", {me:userLoggedIn, friend:userTo}, function(result){
 
			$(".loaded_messages").append(result);
 
			  var all_elements = $(".loaded_messages").children();
 
			  all_elements.each(function(){
			    var el_id = this.id;
			    
			    // data("verified") prevents the removal triggered by its duplicate, if any.
			    $(this).data("verified",true);
 
			    all_elements.each(function(){
			      if(el_id==this.id && !$(this).data("verified")){
			        $(this).remove();
			      }
			    });
			  });
			  
			  // Turn all "surviving" element's data("verified") to false for future "clean".
			  $(".loaded_messages").children().each(function(){
			    $(this).data("verified",false);
			  });
		
		});
	}
 
	setInterval(getMessages, 500);
 
 
	const getConvos = () => {
 
		$.post("includes/handlers/get_convos.php", {me:userLoggedIn}, function(data){
 
			$(".loaded_conversations").html(data);
 
		});
	}
 
	setInterval(getConvos, 2000);
 
	const checkSeen = () => {
 
		$.post("includes/handlers/check_seen.php", {me:userLoggedIn, friend:userTo}, function(data){
 
			$(".checkSeen").html(data);
			
		});
	}
 
	setInterval(checkSeen, 4000);
	
 
	$(function(){
	
		$(document).keypress(function(e){
 
			if(e.keyCode === 13 && e.shiftKey === false && $("#message_textarea").is(":focus")) {
 
				e.preventDefault();
 
				$("#message_submit").click();
 
				const scrollDown = () => {
 
					div.scrollTop = div.scrollHeight;
				}
 
				setTimeout(scrollDown, 800);	
			}
 
		});
 
	});
 
</script>

<!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
<script>
// Snackbar for user status switcher
$('#snackbar-user-status label').click(function() { 
	Snackbar.show({
		text: 'Your status has been changed!',
		pos: 'bottom-center',
		showAction: false,
		actionText: "Dismiss",
		duration: 3000,
		textColor: '#fff',
		backgroundColor: '#383838'
	}); 
}); 
</script>


</body>
</html>