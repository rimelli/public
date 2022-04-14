<?php
include("includes/header.php");

$message_obj = new Message($con, $userLoggedIn);

if (isset($_GET['profile_username'])) {

	$username = $_GET['profile_username'];
	$user_details_query = $con->prepare("SELECT * FROM users WHERE username=?");
	$user_details_query->execute([$username]);

	if ($user_details_query->rowCount() == 0) {
		echo "User does not exist";
		exit();
	}

	$user_array = $user_details_query->fetch();
	$user_id = $user_array['user_id'];

	$individual_array_query = $con->prepare("SELECT * FROM individuals WHERE user_id=?");
	$individual_array_query->execute([$user_id]);
	$individual_array = $individual_array_query->fetch();

	$galleries_query = $con->prepare("SELECT id, filename, original, type FROM profile_galleries WHERE user_id=? ORDER BY id DESC");
	$galleries_query->execute([$user_id]);
	$galleries = $galleries_query->fetchAll();

	//  Update profile views
	$visitor_id = $userLoggedIn;

	if (!$id && $visitor_id != $user_id) {
		$stats = $con->prepare("UPDATE stats SET hits = hits + 1 WHERE day=CURDATE() AND user_id=?");
		$stats->execute([$user_id]);
		$id = $stats->rowCount();
	} elseif (!$id && $visitor_id != $user_id) {
		$stats = $con->prepare("INSERT INTO stats (day, user_id) VALUES (CURDATE(), ?)");
		$stats->execute([$user_id]);
	}
}

//Behavior when clicking on Unfollow button
if (isset($_POST['remove_following'])) {
	$user = new User($con, $userLoggedIn);
	$user->removeFollowing($user_id);
}

//Behavior when clicking on Follow button
if (isset($_POST['add_following'])) {
	$user = new User($con, $userLoggedIn);
	$user->sendFollow($user_id);
}

if (isset($_POST['post_message'])) {
	if (isset($_POST['message_body'])) {
		$body = $_POST['message_body'];
		$date = date("Y-m-d H:i:s");
		$message_obj->sendMessage($username, $body, $date, '');
	}

	$link = '#profileTabs a[href="#messages_div"]';
	echo "<script>
				$(function() {
					$('" . $link . "').tab('show');
				});
			  </script>";
}
?>



<!doctype html>
<html lang="en">

<head>

	<!-- Basic Page Needs
================================================== -->
	<title>Website</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
================================================== -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/colors/blue.css">
	<link rel="stylesheet" href="assets/icon-set/style.css">
	<link rel="stylesheet" href="assets/vendor/@fancyapps/fancybox/dist/jquery.fancybox.min.css">

</head>

<body class="gray">


	<!-- Wrapper -->
	<div id="wrapper">


		<!-- Component Block -->
		<div id="component-7" class="hs-docs-content-divider">

			<!-- Tab Wrapper -->
			<div class="tab-wrapper">

				<!-- Tab Content -->
				<div class="tab-content" id="pills-tabContent-7">
					<div class="tab-pane fade p-4 show active" id="pills-result-7" role="tabpanel" aria-labelledby="pills-result-tab-7">
						<!-- Page Header -->
						<div class="container space-1">
							<div>
								<!-- Profile Cover -->
								<div class="profile-cover">
									<div class="profile-cover-img-wrapper">
										<img class="profile-cover-img" src="<?php echo $user_array['profile_background']; ?>" alt="Image Description">
									</div>
									<?php if ($userLoggedIn == $user_array['user_id']) { ?>
										<form action="upload_cover_pic.php" method="POST" enctype="multipart/form-data" id="cover-img">
											<input class="file-upload" type="file" accept="image/*" id="profileCoverUploader" name="image" />
											<label class="custom-file-btn-label btn btn-sm btn-white" for="profileCoverUploader" style="float: right;">
												<i class="tio-add-photo"></i>
												<span class="d-none d-sm-inline-block ml-1">Update your cover image</span>
											</label>
										</form>
									<?php } ?>
								</div>
								<!-- End Profile Cover -->

								<!-- Media -->
								<div class="d-sm-flex align-items-lg-center pt-1 px-3 pb-3">
									<div class="mb-2 mb-sm-0 mr-4 profile-header-pic">
										<img src="<?php echo $user_array['profile_pic']; ?>" alt="Image Description">
									</div>

									<div class="media-body">
										<div class="row">
											<div class="col-lg mb-3 mb-lg-0">
												<h2 class="h2 mb-1">
													<a href="<?php echo $username; ?>"><?php
																						echo $user_array['first_name'] . " " . $user_array['last_name'];

																						?></a> <?php
																								$profile_ver_obj = new User($con, $user_array['user_id']);
																								if ($profile_ver_obj->isVerified()) {
																									echo '<i class="tio-verified tio-lg text-primary" data-toggle="tooltip" data-placement="top" title="Verified"></i>';
																								} ?>
													<span class="profile-tagline"><?php echo $user_array['tagline']; ?></span>
												</h2>


											</div>
											<!-- End Row -->
										</div>
									</div>
									<!-- End Media -->

									<!-- Buttons -->
									<div class="always-visible margin-top-25 margin-bottom-5">
										<?php
										$profile_user_obj = new User($con, $user_id);
										if ($profile_user_obj->isClosed()) {
											header("Location: user_closed.php");
										}

										$logged_in_user_obj = new User($con, $userLoggedIn);

										if ($userLoggedIn != $user_id) {

											echo '<a href="#small-dialog" class="popup-with-zoom-anim button dark ripple-effect"><i class="icon-feather-mail"></i> Send Message</a>';

											if ($logged_in_user_obj->isFollowing($user_id)) {
												echo '<button onclick="followUser(' . $user_id . ')" name="remove_following" id="followBtnClass" class="following-btn margin-left-10"><a class="button ripple-effect" id="followBtn"><i class="icon-feather-user-check"></i> Following</a></button>';
											} else
												echo '<button onclick="followUser(' . $user_id . ')" name="add_following" id="followBtnClass" class="follow-btn margin-left-10"><a class="button ripple-effect" id="followBtn"><i class="icon-feather-user"></i> Follow</a></button>';
										} ?>
									</div>
								</div>
							</div>
							<!-- End Page Header -->
						</div>
						<div class="tab-pane fade" id="pills-html-7" role="tabpanel" aria-labelledby="pills-html-tab-7">
							<pre>
                    <code class="language-html" data-lang="html">
                      
                    </code>
                  </pre>
						</div>
					</div>
					<!-- End Tab Content -->
				</div>
				<!-- End Tab Wrapper -->
			</div>
			<!-- End Component Block -->


			<!-- Page Content
================================================== -->

			<!-- Tabs & Toggles
================================================== -->
			<!-- Container -->
			<div class="container mb-5">
				<div class="row">

					<div class="col-xl-12 col-md-12">

						<!-- Nav -->
						<?php include("partials/profile_menu.php"); ?>
						<!-- End Nav -->

					</div>

				</div>
			</div>
			<!-- Container / End -->


		</div>
		<!-- Wrapper / End -->





		<!-- Scripts
================================================== -->
		<script src="assets/js/jquery-3.5.1.min.js"></script>
		<script src="assets/js/jquery-migrate-3.3.1.min.js"></script>
		<script src="assets/js/mmenu.min.js"></script>
		<script src="assets/js/tippy.all.min.js"></script>
		<script src="assets/js/simplebar.min.js"></script>
		<script src="assets/js/bootstrap-slider.min.js"></script>
		<script src="assets/js/bootstrap-select.min.js"></script>
		<script src="assets/vendor/hs-unfold/dist/hs-unfold.min.js"></script>
		<script src="assets/js/snackbar.js"></script>
		<script src="assets/js/clipboard.min.js"></script>
		<script src="assets/js/counterup.min.js"></script>
		<script src="assets/js/magnific-popup.min.js"></script>
		<script src="assets/js/slick.min.js"></script>
		<script src="assets/js/custom.js"></script>
		<script src="assets/js/script.js"></script>
		<script src="assets/hs-nav-scroller/dist/hs-nav-scroller.min.js"></script>
		<script src="assets/vendor/@fancyapps/fancybox/dist/jquery.fancybox.min.js"></script>

		<script src="assets/js/front/hs.core.js"></script>
		<script src="assets/js/front/hs.fancybox.js"></script>

		<!-- JS Plugins Init. -->
		<script>
			function followUser(user_id) {
				var fbtn = $('#followBtn');
				var fbtnClass = $('#followBtnClass');
				var btntext = fbtn.text().trim()

				if (btntext == 'Follow') {

					$.ajax({
						url: "xhr/follow.php",
						type: "POST",
						data: {
							add_following: user_id
						},
						cache: false,

						success: function(response) {
							console.log(response);
							fbtnClass.removeClass('follow-btn');
							fbtnClass.addClass('following-btn');
							fbtn.html('<i class="icon-feather-user-check"></i> Following');
						}
					});

				}else{
					$.ajax({
						url: "xhr/follow.php",
						type: "POST",
						data: {
							remove_following: user_id
						},
						cache: false,

						success: function(response) {
							console.log(response);
							fbtnClass.addClass('follow-btn');
							fbtnClass.removeClass('following-btn');
							fbtn.html('<i class="icon-feather-user"></i> Follow');
						}
					});
				}
				// console.log(fbtn);

			}
			$(document).on('ready', function() {


				// INITIALIZATION OF UNFOLD
				// =======================================================
				$('.js-hs-unfold-invoker').each(function() {
					var unfold = new HSUnfold($(this)).init();
				});

				// INITIALIZATION OF NAV SCROLLER
				// =======================================================
				$('.js-nav-scroller').each(function() {
					new HsNavScroller($(this)).init()
				});


				// INITIALIZATION OF FANCYBOX
				// =======================================================
				$('.js-fancybox').each(function() {
					var fancybox = $.HSCore.components.HSFancyBox.init($(this));
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

			// Snackbar for "place a bid" button
			$('#snackbar-place-bid').click(function() {
				Snackbar.show({
					text: 'Your bid has been placed!',
				});
			});


			// Snackbar for copy to clipboard button
			$('.copy-url-button').click(function() {
				Snackbar.show({
					text: 'Copied to clipboard!',
				});
			});
		</script>

		<script>
			document.getElementById("profileCoverUploader").onchange = function() {
				document.getElementById("cover-img").submit();
			};
		</script>

		<script>
			$(function() {

				var userLoggedIn = '<?php echo $userLoggedIn; ?>';
				var profileUsername = '<?php echo $username; ?>';
				var inProgress = false;

				loadPosts(); //Load first posts

				$(window).scroll(function() {
					var bottomElement = $(".status_post").last();
					var noMorePosts = $('.posts_area').find('.noMorePosts').val();

					// isElementInViewport uses getBoundingClientRect(), which requires the HTML DOM object, not the jQuery object. The jQuery equivalent is using [0] as shown below.
					if (isElementInView(bottomElement[0]) && noMorePosts == 'false') {
						loadPosts();
					}
				});

				function loadPosts() {
					if (inProgress) { //If it is already in the process of loading some posts, just return
						return;
					}

					inProgress = true;
					$('#loading').show();

					var page = $('.posts_area').find('.nextPage').val() || 1; //If .nextPage couldn't be found, it must not be on the page yet (it must be the first time loading posts), so use the value '1'

					$.ajax({
						url: "includes/handlers/ajax_load_profile_posts.php",
						type: "POST",
						data: "page=" + page + "&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
						cache: false,

						success: function(response) {
							$('.posts_area').find('.nextPage').remove(); //Removes current .nextpage
							$('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage
							$('.posts_area').find('.noMorePostsText').remove(); //Removes current .nextpage

							$('#loading').hide();
							$(".posts_area").append(response);

							inProgress = false;
						}
					});
				}

				//Check if the element is in view
				function isElementInView(el) {
					if (el == null) {
						return;
					}

					var rect = el.getBoundingClientRect();

					return (
						rect.top >= 0 &&
						rect.left >= 0 &&
						rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && //* or $(window).height()
						rect.right <= (window.innerWidth || document.documentElement.clientWidth) //* or $(window).width()
					);
				}
			});
		</script>

</body>

</html>