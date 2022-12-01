<!doctype html>
<html lang="en">
<head>


</head>


<!-- Dashboard Sidebar
================================================== -->
<div class="dashboard-sidebar">
	<div class="dashboard-sidebar-inner" data-simplebar>
		<div class="dashboard-nav-container">

			<!-- Responsive Navigation Trigger -->
			<a href="#" class="dashboard-responsive-nav-trigger">
				<span class="hamburger hamburger--collapse" >
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</span>
				<span class="trigger-title">Dashboard Navigation</span>
			</a>
			
			<!-- Navigation -->
			<div class="dashboard-nav" id="myDIV">
				<div class="dashboard-nav-inner">
                    <?php
                        $message_obj = new Message($con, $userLoggedIn);
                        $user_to = $message_obj->getMostRecentUser();
                    ?>
					<ul data-submenu-title="Start">
						<li><a href="index.php"><i class="icon-material-outline-home"></i> Home</a></li>
						<li><a href="dashboard.php"><i class="icon-material-outline-dashboard"></i>Dashboard</a></li>
                        <?php
                            if ($user_to) {
                                echo '<li><a href="messages.php?user_to='.$user_to.'"><i class="icon-material-outline-speaker-notes"></i> Messages</a></li>';
                                } else {
                                echo '<li><a href="messages.php"><i class="icon-material-outline-speaker-notes"></i> Messages</a></li>';
                            }
                        ?>
                        <li><a href="settings.php"><i class="icon-material-outline-group"></i>Settings</a></li>
                        <li><a href="users.php"><i class="icon-material-outline-group"></i>All Users</a></li>
                    </ul>

					<ul data-submenu-title="Account">
						<li><a href="includes/handlers/logout.php"><i class="icon-material-outline-power-settings-new"></i> Logout</a></li>
					</ul>
					
				</div>
			</div>
			<!-- Navigation / End -->

		</div>
	</div>
</div>
<!-- Dashboard Sidebar / End -->



</html>


