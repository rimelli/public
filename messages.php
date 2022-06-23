<?php
include("includes/header.php");

// $message_obj = new Message($con, $userLoggedIn);

$chatRoom = new ChatRooms($con, $userLoggedIn);

$userClass = new User($con, $userLoggedIn);
if (isset($_GET['u'])) {
	$user_to = Security::int_only($_GET['u']);
	$room = $chatRoom->checkPrivateChatRoom($user_to, $userLoggedIn);
	if ($room) {
		header("Location: /messages.php?conversation=" . $room['group_slug']);
		exit();
		// print_r($room);
	} else {
		$e2e_key = Security::generateRandomKey(32);
		$e2e_key = Security::aes_gcm_encrypt($e2e_key, $master_key);
		$slug = Security::guidv4();
		$group = $chatRoom->createRoom($slug, $e2e_key);
		if ($group) {
			$chatRoom->addUsertoRoom($group, $user_to);
			$chatRoom->addUsertoRoom($group, $userLoggedIn);
			header("Location: /messages.php?conversation=" . $slug);
			exit();
		} else {
			echo 'No User Found';
			http_response_code(404);
			exit();
		}

		// echo 'no room found';
	}
} else if ($_GET['conversation']) {
	$conv_id = Security::input_secure($_GET['conversation']);
	$currentRoom = $chatRoom->getChatRoomInfo($conv_id);

	if ($currentRoom) {
		$messages = $chatRoom->getChatMessages($conv_id);
		$e2e_key = Security::aes_gcm_decrypt($currentRoom['e2e_key'], $master_key);
		$profile = $chatRoom->getChatUserProfile($currentRoom['group_id'], $userLoggedIn);
		$chatrooms = $chatRoom->getChatRooms($userLoggedIn);
		$token = Security::guidv4();
		$userClass->updateUserTokenID($token);
		$chats = [];
		foreach ($chatrooms as $chat) {
			if ($chat['group_type'] == 'private') {
				$pro = $chatRoom->getChatUserProfile($chat['group_id'], $userLoggedIn);
				$last_message = $chatRoom->getLastGroupMessage($chat['group_id']);
				$chat['profile'] = $pro;
				$chat['last_message'] = $last_message;
				array_push($chats, $chat);
			} else {
				$last_message = $chatRoom->getLastGroupMessage($chat['group_id']);
				$chat['last_message'] = $last_message;
				array_push($chats, $chat);
			}
		}
	}else{
		echo 'This Converstaion Not Found';
		http_response_code(404);
		exit();
	}
	// echo '<pre>';
	// print_r($messages);
	// die();
} else {
	$chatrooms = $chatRoom->getChatRooms($userLoggedIn);
	if ($chatrooms) {

		header("Location: /messages.php?conversation=" . $chatrooms[0]['group_slug']);
		exit();
	}
	// $user_to = $message_obj->getMostRecentUser();
}
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

	<style>
		.custom-message-area {
			overflow-x: hidden;
			border: 2px solid #f4f4f4;
			border-radius: 10px;
			padding: 15px 10px;
		}

		/* width */
		.scroll-bar::-webkit-scrollbar {
			width: 5px;
		}

		/* Track */
		.scroll-bar::-webkit-scrollbar-track {
			/* box-shadow: inset 5px 5px 5px grey; */
			background-color: #f0f0f0;
			border-radius: 10px;
		}

		/* Handle */
		.scroll-bar::-webkit-scrollbar-thumb {
			background: #999;
			border-radius: 10px;
		}

		.scroll-bar::-webkit-scrollbar-thumb:hover {
			background: #555;
		}

		.message-time {
			font-size: 12px;
			position: absolute;
			left: auto;
			right: 70px;
			bottom: -25px;
			top: auto;
		}

		.message-time-other {
			font-size: 12px;
			position: absolute;
			left: 70px;
			bottom: -25px;
			top: auto;
		}
	</style>

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
				<div class="dashboard-content-inner">

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
									<div class="user_details column scroll-bar" id="conversations" style="overflow-y: scroll; max-height:650px;">

										<div class="loaded_conversations">
											<?php
											// echo $message_obj->getConvos(); 
											if ($chats) {
												foreach ($chats as $chat) {
													if (!isset($chat['last_message']['body'])) {
														$chat['last_message']['body'] = 'No Messages Found.';
														$chat['last_message']['user_id'] = '';
													}
													// echo '<pre>';
													// print_r($chat);
													if ($chat['group_type'] == 'private') {
											?>

														<li><a href='messages.php?conversation=<?= $chat['group_slug'] ?>'>
																<div class='message-avatar'>
																	<i class='status-icon status-online'></i><img src='<?= $chat['profile']['profile_pic'] ?>'>
																</div>
																<div class='message-by'>
																	<div class='message-by-headline'>
																		<h5><?= $chat['profile']['first_name'] . ' ' . $chat['profile']['last_name'] ?></h5><span class='timestamp_smaller' id='grey'> <?= (isset($chat['last_message']['date'])) ? $chatRoom->calculateTimeAgo($chat['last_message']['date']) : '' ?></span>
																	</div>
																	<p id='grey' style='margin: 0;'><?= ($chat['last_message']['user_id'] == $userLoggedIn) ? 'You said: ' . Security::aes_gcm_decrypt($chat['last_message']['body'], Security::aes_gcm_decrypt($chat['e2e_key'], $master_key)) : 'They said: ' . Security::aes_gcm_decrypt($chat['last_message']['body'], Security::aes_gcm_decrypt($chat['e2e_key'], $master_key)) ?> </p>
																</div>
															</a></li>
													<?php } else { ?>
														<li><a href='messages.php?conversation=<?= $chat['group_slug'] ?>'>
																<div class='message-avatar'>
																	<i class='status-icon status-online'></i><img src='<?= $chat['group_avater'] ?>'>
																</div>
																<div class='message-by'>
																	<div class='message-by-headline'>
																		<h5><?= $chat['group_name'] ?></h5><span class='timestamp_smaller' id='grey'> <?= (isset($chat['last_message']['date'])) ? $chatRoom->calculateTimeAgo($chat['last_message']['date']) : '' ?></span>
																	</div>
																	<p id='grey' style='margin: 0;'><?= ($chat['last_message']['user_id'] == $userLoggedIn) ? 'You said: ' . Security::aes_gcm_decrypt($chat['last_message']['body'], Security::aes_gcm_decrypt($chat['e2e_key'], $master_key)) : 'They said: ' . Security::aes_gcm_decrypt($chat['last_message']['body'], Security::aes_gcm_decrypt($chat['e2e_key'], $master_key)) ?> </p>
																</div>
															</a></li>
											<?php }
												}
											}
											?>
										</div>

									</div>
								</ul>
							</div>
							<!-- Messages / End -->

							<!-- Message Content -->
							<div class="message-content" style="overflow:visible;">

								<div class="messages-headline">
									<?php
									if (isset($currentRoom['group_type']) && $currentRoom['group_type'] == 'private') {
										echo "<h4>You and <a href='#'>" . $profile['first_name'] . ' ' . $profile['last_name'] . "</a></h4><br>";
									} else {
										$group_name = $currentRoom['group_name'];
										echo "<h4> $group_name</h4>";
									}
									?>
									<a href="#" class="message-action"><i class="icon-feather-trash-2"></i> Delete Conversation</a>
								</div>

								<!-- Message Content Inner -->
								<div class="message-content-inner">

									<div class='loaded_messages custom-message-area scroll-bar' id='scroll_messages'>
										<?php
										if ($messages) {
											foreach ($messages as $message) {
												if ($message['user_id'] == $userLoggedIn) {
										?>
													<div class='message-bubble me' style="margin-bottom:30px;">
														<div class='message-bubble-inner'>
															<div class='message-avatar'>
																<img src='<?= $user['profile_pic'] ?>'>
															</div>
															<div class='message-text'>
																<?= Security::aes_gcm_decrypt($message['body'], $e2e_key) ?>
															</div>
														</div>
														<div class="message-time"><?= 'Me at: ' . date('d-m-Y h:i a', strtotime($message['date'])) ?></div>
													</div>
												<?php } else { ?>
													<div class='message-bubble' style="margin-bottom:30px;">
														<div class='message-bubble-inner'>
															<div class='message-avatar'>
																<img src='<?= $profile['profile_pic'] ?>'>
															</div>
															<div class='message-text'>
																<?= Security::aes_gcm_decrypt($message['body'], $e2e_key) ?>
															</div>
														</div>
														<div class="message-time-other"><strong><?= $profile['first_name'] . ' ' . $profile['last_name'] . ' at: ' ?></strong><?= date('d-m-Y h:i a', strtotime($message['date'])) ?></div>
													</div>
										<?php
												}
											}
										} else {
											echo '<p style="text-align:center;">No Messages Found.<p>';
										}
										?>
									</div>
									<!-- Message Content Inner / End -->

									<!-- Reply Area -->
									<form action="" method="POST" enctype="multipart/form-data" name="imgForm" style="overflow: visible;">
										<?php

										echo "<textarea name='message_body' id='message_textarea' placeholder='Write your message...'></textarea>";
										?>
										<input type='button' name='post_message' class='info' id='message_submit' value='Send' style="margin-bottom:10px">
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

		<script type="text/javascript">
			$(document).ready(function() {
				var div = document.getElementById("scroll_messages");

				if (div != null) {
					div.scrollTop = div.scrollHeight;
					console.log('done');
				}

				const scrollDown = () => {

					div.scrollTop = div.scrollHeight;
				}
				var userLoggedIn = "<?= $userLoggedIn ?>";

				var group_id = "<?= $currentRoom['group_id'] ?>";

				var conn = new WebSocket('ws://localhost:8080?token=<?= $token ?>');
				conn.onopen = function(e) {
					console.log("Connection established!");
				};

				conn.onmessage = function(e) {
					console.log(e.data);

					var data = JSON.parse(e.data);

					var row_class = '';

					var time_class = '';

					if (data.from == 'Me') {
						row_class = 'me';
						time_class = 'message-time';
					} else {
						time_class = 'message-time-other';
					}

					var html_data = "	<div class='message-bubble " + row_class + "' style='margin-bottom:30px;'><div class='message-bubble-inner'><div class='message-avatar'><img src='" + data.profile_pic + "'></div><div class='message-text'>" + data.message + "</div></div><div class='" + time_class + "'> <strong>" + data.from + " at: </strong> " + data.date + " </div></div>";

					$('#scroll_messages').append(html_data);
					scrollDown();

					$("textarea").val("");
				};

				// $('#chat_form').parsley();

				// $('#messages_area').scrollTop($('#messages_area')[0].scrollHeight);

				$('#message_submit').on('click', function(event) {

					event.preventDefault();

					var message = $("textarea").val();

					var data = {
						groupID: group_id,
						fromUser: userLoggedIn,
						msg: message
					};

					conn.send(JSON.stringify(data));



				});

				$('#logout').click(function() {

					user_id = $('#login_user_id').val();

					$.ajax({
						url: "action.php",
						method: "POST",
						data: {
							user_id: user_id,
							action: 'leave'
						},
						success: function(data) {
							var response = JSON.parse(data);

							if (response.status == 1) {
								conn.close();
								location = 'index.php';
							}
						}
					})

				});

			});
		</script>
		<script>
			var userLoggedIn = "<?= $userLoggedIn ?>";

			var group_id = "<?= $currentRoom['group_id'] ?>";

			const sendMessage = () => {

				var body = $("textarea").val();

				var form = document.forms.namedItem("imgForm");

				var formData = new FormData(form);

				var otherData = [];

				otherData.push({
					"me": userLoggedIn,
					"body": body,
					"friend": userTo
				});

				formData.append('otherData', JSON.stringify(otherData));

				$.ajax({
					type: "POST",
					url: "includes/handlers/send_message.php",
					data: formData,
					contentType: false,
					processData: false,
					success: (function(data) {

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

				$.post("includes/handlers/get_messages.php", {
					me: userLoggedIn,
					friend: userTo
				}, function(result) {

					$(".loaded_messages").append(result);

					var all_elements = $(".loaded_messages").children();

					all_elements.each(function() {
						var el_id = this.id;

						// data("verified") prevents the removal triggered by its duplicate, if any.
						$(this).data("verified", true);

						all_elements.each(function() {
							if (el_id == this.id && !$(this).data("verified")) {
								$(this).remove();
							}
						});
					});

					// Turn all "surviving" element's data("verified") to false for future "clean".
					$(".loaded_messages").children().each(function() {
						$(this).data("verified", false);
					});

				});
			}

			// setInterval(getMessages, 500);


			const getConvos = () => {

				$.post("includes/handlers/get_convos.php", {
					me: userLoggedIn
				}, function(data) {

					$(".loaded_conversations").html(data);

				});
			}

			// setInterval(getConvos, 2000);

			const checkSeen = () => {

				$.post("includes/handlers/check_seen.php", {
					me: userLoggedIn,
					friend: userTo
				}, function(data) {

					$(".checkSeen").html(data);

				});
			}

			setInterval(checkSeen, 4000);


			$(function() {

				$(document).keypress(function(e) {

					if (e.keyCode === 13 && e.shiftKey === false && $("#message_textarea").is(":focus")) {

						e.preventDefault();

						$("#message_submit").click();

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