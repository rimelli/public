<?php 
include("includes/header.php");

if(isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	$id = 0;
}

?>





<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>TRYOUTS</title>
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
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner">


			<!-- Single Post Container -->
			<div class="row">
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<div class="content">
							<ul class="dashboard-box-list">
								<li>
							
							<div class="posts_area">

								<?php 
									$post = new Post($con, $userLoggedIn);
									$post->getSinglePost($id);
								?>
								
							</div>

								</li>
							</ul>
						</div>

					</div>
				</div>
			</div>


			<!-- Footer -->
			<?php include("includes/footer.php"); ?>
			<!-- Footer / End -->

		</div>
	</div>
	<!-- Dashboard Content / End -->

</div>
<!-- Dashboard Container / End -->


</div>
<!-- End of wrapper -->


</body>
</html>








	