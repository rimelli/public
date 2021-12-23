<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
include("includes/classes/Notification.php");
include("includes/classes/Job.php");

if (isset($_SESSION['user_id'])) {
	$userLoggedIn = $_SESSION['user_id'];
	$user_details_query = $con->prepare("SELECT * FROM users WHERE user_id=?");
	$user_details_query->execute([$userLoggedIn]);
	$user = $user_details_query->fetch();

	$individual_user_details_query = $con->prepare("SELECT * FROM individuals WHERE user_id=?");
	$individual_user_details_query->execute([$userLoggedIn]);
	$individual_user = $individual_user_details_query->fetch();
	
}
else {
	header("Location: home.php");
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

<!-- FontAwesome
================================================== -->
<script src="https://kit.fontawesome.com/1a2275be55.js" crossorigin="anonymous"></script>

<!-- Javascript
================================================== -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/jquery.Jcrop.js"></script>
<script src="assets/js/jcrop_bits.js"></script>

<!-- CSS
================================================== -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/colors/blue.css">
<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css">
<link rel="stylesheet" href="assets/css/docs.css">
<link rel="stylesheet" href="assets/css/theme.css">
<link rel="stylesheet" href="assets/vendor/quill/dist/quill.snow.css">

</head>
<body>


<!-- Header Container
================================================== -->
<header id="header-container" class="fullwidth dashboard-header">

	<!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a href="index.php"><h1>Home</h1></a>
				</div>

				<!-- Main Navigation -->
				<nav id="navigation">
					<ul id="responsive">

						<li><a href="index.php" class="current">Home</a></li>

					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->

			<?php 
			//Unread messages
			$messages = new Message($con, $userLoggedIn);
			$num_messages = $messages->getUnreadNumber();

			//Unread notifications
			$notifications = new Notification($con, $userLoggedIn);
			$num_notifications = $notifications->getUnreadNumber();
			?>


			<!-- Right Side Content / End -->
			<div class="right-side">

				<!--  User Notifications -->
				<div class="header-widget hide-on-mobile">
					
					<!-- Messages -->
					<div class="header-notifications">
						<div class="header-notifications-trigger">
							<a href="#" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')"><i class="icon-feather-mail"></i>
								<?php
								if($num_messages > 0)
								echo '<span class="nav-tag">' . $num_messages . '</span>';
								?>
							</a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<div class="header-notifications-headline">
								<h4>Messages</h4>
								<button class="mark-as-read ripple-effect-dark" title="Mark all as read" data-tippy-placement="left">
									<i class="icon-feather-check-square"></i>
								</button>
							</div>

							<div class="header-notifications-content">
								<div class="header-notifications-scroll">
									<ul>
										<!-- Message -->
										<div class="dropdown_data_window"></div>
										<input type="hidden" id="dropdown_data_type" value="">
									</ul>
								</div>
							</div>

							<a href="messages.php" class="header-notifications-button ripple-effect button-sliding-icon">View All Messages<i class="icon-material-outline-arrow-right-alt"></i></a>
						</div>
					</div>
					

					<!-- Notifications -->
					<div class="header-notifications">
						<!-- Trigger -->
						<div class="header-notifications-trigger">
							<a href="#" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'notification')"><i class="icon-feather-bell"></i>
								<?php
								if($num_notifications > 0)
								echo '<span class="nav-tag">' . $num_notifications . '</span>';
								?>
							</a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<div class="header-notifications-headline">
								<h4>Notifications</h4>
								<button class="mark-as-read ripple-effect-dark" title="Mark all as read" data-tippy-placement="left">
									<i class="icon-feather-check-square"></i>
								</button>
							</div>

							<div class="header-notifications-content" data-simplebar>
								<div class="header-notifications-scroll">
									<ul>
										<!-- Notification -->
										<div class="dropdown_data_window"></div>
										<input type="hidden" id="dropdown_data_type" value="">
									</ul>
								</div>
							</div>

						</div>
					</div>

				</div>
				<!--  User Notifications / End -->

				

				<!-- Search Menu -->
				<div class="header-widget">

					<!-- Notifications -->
					<div class="header-notifications">

						<!-- Trigger -->
						<div class="header-notifications-trigger">
							<a href="#"><i class="icon-feather-search"></i></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<div class="header-notifications-headline">
								<form action="search.php" method="GET">
									<div class="input-with-icon">
										<input class="search-bar-input" id="search-bar-input" type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search" autocomplete="off">
										<i class="icon-feather-search" name="q"></i>
									</div>
								</form>
							</div>

							<div class="header-notifications-content">

								<div class="header-notifications-scroll" data-simplebar>
								
									<div class="search_results">	
									</div>

									<div class="search_results_footer_empty">	
									</div>

								</div>
							</div>

						</div>
					</div>
				</div>
				<!-- Search Menu / End -->


				<!-- User Menu -->
				<div class="header-widget">

					<!-- Messages -->
					<div class="header-notifications user-menu">
						<div class="header-notifications-trigger">
							<a href="#"><div class="user-avatar status-online"><img src="<?php echo $user['profile_pic']; ?>" alt=""></div></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">

							<!-- User Status -->
							<div class="user-status">

								<!-- User Name / Avatar -->
								<div class="user-details">
									<div class="user-avatar status-online"><img src="<?php echo $user['profile_pic']; ?>" alt=""></div>
									<div class="user-name">
									<?php
									echo $user['first_name'] . " " . $user['last_name'];

									?> <span>Freelancer</span>
									</div>
								</div>
								
								<!-- User Status Switcher -->
								<div class="status-switch" id="snackbar-user-status">
									<label class="user-online current-status">Online</label>
									<label class="user-invisible">Invisible</label>
									<!-- Status Indicator -->
									<span class="status-indicator" aria-hidden="true"></span>
								</div>	
						</div>
						
						<ul class="user-menu-small-nav">
							<li><a href="includes/handlers/logout.php"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
						</ul>

						</div>
					</div>

				</div>
				<!-- User Menu / End -->

				<!-- Mobile Navigation Button -->
				<span class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</span>

			</div>
			<!-- Right Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->



<script>
    var userLoggedIn = "<?php echo $userLoggedIn; ?>";
</script>


<script>
	$(function(){
 
		var userLoggedIn = '<?php echo $userLoggedIn; ?>';
		var dropdownInProgress = false;
 
	    $(".dropdown_data_window").scroll(function() {
	    	var bottomElement = $(".dropdown_data_window a").last();
			var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();
 
	        // isElementInViewport uses getBoundingClientRect(), which requires the HTML DOM object, not the jQuery object. The jQuery equivalent is using [0] as shown below.
	        if (isElementInView(bottomElement[0]) && noMoreData == 'false') {
	            loadPosts();
	        }
	    });
 
	    function loadPosts() {
	        if(dropdownInProgress) { //If it is already in the process of loading some posts, just return
				return;
			}
			
			dropdownInProgress = true;
 
			var page = $('.dropdown_data_window').find('.nextPageDropdownData').val() || 1; //If .nextPage couldn't be found, it must not be on the page yet (it must be the first time loading posts), so use the value '1'
 
			var pageName; //Holds name of page to send ajax request to
			var type = $('#dropdown_data_type').val();
 
			if(type == 'notification')
				pageName = "ajax_load_notifications.php";
			else if(type == 'message')
				pageName = "ajax_load_messages.php";
 
			$.ajax({
				url: "includes/handlers/" + pageName,
				type: "POST",
				data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
				cache:false,
 
				success: function(response) {
 
					$('.dropdown_data_window').find('.nextPageDropdownData').remove(); //Removes current .nextpage 
					$('.dropdown_data_window').find('.noMoreDropdownData').remove();
 
					$('.dropdown_data_window').append(response);
 
					dropdownInProgress = false;
				}
			});
	    }
 
	    //Check if the element is in view
	    function isElementInView (el) {
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
