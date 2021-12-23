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

					<ul data-submenu-title="Start">
						<li><a href="index.php"><i class="icon-material-outline-speaker-notes"></i> Newsfeed</a></li>
						<li><a href="messages.php"><i class="icon-material-outline-question-answer"></i> Messages
								<?php
								if($num_messages > 0)
								echo '<span class="nav-tag">' . $num_messages . '</span>';
								?>
							</a></li>
						<li><a href="notifications.php"><i class="icon-material-outline-notifications"></i> Notifications 
								<?php
								if($num_notifications > 0)
								echo '<span class="nav-tag">' . $num_notifications . '</span>';
								?>
							</a></li>
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


