<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");
include("includes/classes/Notification.php");

if (isset($_SESSION['user_id'])) {
	$userLoggedIn = $_SESSION['user_id'];
	$user_details_query = $con->prepare("SELECT * FROM users WHERE user_id=?");
	$user_details_query->execute([$userLoggedIn]);
	$user = $user_details_query->fetch();

	$individual_user_details_query = $con->prepare("SELECT * FROM individuals WHERE user_id=?");
	$individual_user_details_query->execute([$userLoggedIn]);
	$individual_user = $individual_user_details_query->fetch();

	$org_user_details_query = $con->prepare("SELECT * FROM organisations WHERE user_id=?");
	$org_user_details_query->execute([$userLoggedIn]);
	$org_user = $org_user_details_query->fetch();
	
}
else {
	header("Location: index.php");
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

<!-- CSS
================================================== -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/colors/blue.css">
<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css">
<link rel="stylesheet" href="assets/css/docs.css">
<link rel="stylesheet" href="assets/css/theme.css">

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
                    <?php
                    $message_obj = new Message($con, $userLoggedIn);
                    $user_to = $message_obj->getMostRecentUser();
                    ?>
					<ul id="responsive">
                        <?php
                            $page = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
                        ?>
						<li><a href="index.php" class="<?= $page === 'index.php' ? 'current' : '' ?>">Home</a></li>
                        <?php
                        $class = $page === "messages.php" ? "current" : "";
                        if ($user_to) {
                            echo '<li><a href="messages.php?user_to='.$user_to.'" class="'.$class.'">Messages</a></li>';
                        } else {
                            echo '<li><a href="messages.php" class="'.$class.'">Messages</a></li>';
                        }
                        ?>
                        <li><a href="users.php" class="<?= $page === 'users.php' ? 'current' : '' ?>">All Users</a></li>

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


				<!-- User Menu -->
				<div class="header-widget">

					<!-- Messages -->
					<div class="header-notifications user-menu">
						<div class="header-notifications-trigger">
							<a href="#"><div class="user-avatar status-online"><img src="<?php echo $user['profile_pic']; ?>" alt=""></div></a>
						</div>

						<!-- Dropdown -->
						<div class="header-notifications-dropdown">
						
						<ul class="user-menu-small-nav">
							<li><a href="logout.php?user_id=<?= $_SESSION['user_id']?>"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
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
