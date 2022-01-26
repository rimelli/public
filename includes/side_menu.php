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

					<ul data-submenu-title="Nav">
						<li class="active"><a href="index.php"></i> feed</a></li>
                        <li><a href="dashboard.php"> Dashboard</a></li>
						<li><a href="messages.php"></i> Messages
								<?php
								if($num_messages > 0)
								echo '<span class="nav-tag">' . $num_messages . '</span>';
								?>
							</a></li>
						<li><a href="bookmarks.php"> Bookmarks</a></li>
					</ul>
					
					<ul data-submenu-title="Jobs">
						<li><a href="#"><i class="icon-material-outline-business-center"></i> Jobs</a>
							<ul>
								<li><a href="jobs_manage.php">Manage Jobs <span class="nav-tag">3</span></a></li>
								<li><a href="jobs_candidates.php">Manage Candidates</a></li>
								<li><a href="jobs_post.php">Post a Job</a></li>
							</ul>	
						</li>
					</ul>

					<ul data-submenu-title="Account">
						<li><a href="settings.php"><i class="icon-material-outline-settings"></i> Settings</a></li>
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


