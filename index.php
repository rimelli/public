<?php
include("includes/header.php");

if (isset($_POST['post'])) {	
	$error = NULL;
	$images = [];

	if (is_uploaded_file($_FILES['images']['tmp_name'][0])) {

		// Allowed file mime-types below
		$allowed = [
			'image/png' => 'png', 
			'image/jpeg' => 'jpg', 
			'image/gif' => 'gif', 
			'application/pdf' => 'pdf'			
		];

		$targetBaseName = sprintf('assets/images/posts/%d-%s', $userLoggedIn, uniqid());
		
		for ($x = 0, $l = count($_FILES['images']['type']); $x < $l; $x++){
			if (!$error){
				if (isset($allowed[$_FILES['images']['type'][$x]]) && $_FILES['images']['size'][$x] <= 10000000){
					$fileName = sprintf('%s-%d.%s', $targetBaseName, $x, $allowed[$_FILES['images']['type'][$x]]);

					if (move_uploaded_file($_FILES['images']['tmp_name'][$x], $fileName)){
						$images[] = $fileName; 
					}else{
						$error = "Sorry, could not save an image";
					}

				}else{
					$error = "Sorry, only JPG, PNG and GIF files with less than 10 MB are allowed";
				}

			}		

		}

	}
	
	if (!$error){
		$post = new Post($con, $userLoggedIn);
		$post->submitPost($_POST['post_text'], $userLoggedIn, implode(';', $images));
		header("Location: index.php");

	}else{
		echo "<div style='text-align:center;' class='alert alert-danger'>$error</div>";

	}

}
?>




<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>Feed</title>
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

			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Profile-> <a class="name_profile" href="<?php echo $user['username']; ?>">
                    <?php
                    echo $user['first_name'];

                    ?>
			    </a></h3>
			</div>
	
			<!-- Post Container -->
			<div class="messages-container margin-top-0">

					<div class="messages-container-inner">
					

						<!-- Message Content -->
						<div class="message-content">

							<!-- Upload Button -->
							<div class="messages-headline">
								<div class="uploadButton margin-top-0">
									<input form="index-post" class="uploadButton-input" type="file" name="images[]" id="fileToUpload" accept=".gif, .jpg, .jpeg, .png" multiple />
									<label class="uploadButton-button ripple-effect" for="fileToUpload">Upload</label>
									<span class="uploadButton-file-name">Maximum file size: 10 MB</span>
								</div>
							</div>
							<!-- Reply Area -->
							<form class="message-reply" action="index.php" method="POST" enctype="multipart/form-data" id="index-post">
								<textarea name="post_text" id="post_text" cols="1" rows="1" placeholder="Post Something..." data-autoresize required></textarea>
								<button class="button ripple-effect" name="post" id="post_button">Send</button>
							</form>

						</div>
						<!-- End of Message Content -->

					</div>

			</div>		


			<!-- Posts Container -->
			<div class="row">
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<div class="content">
							<ul class="dashboard-box-list">
								<li>
									<div class="posts_area"></div>
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
<script src="assets/js/snackbar.js"></script>
<script src="assets/js/clipboard.min.js"></script>
<script src="assets/js/counterup.min.js"></script>
<script src="assets/js/magnific-popup.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/custom.js"></script>



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

<!-- Chart.js // documentation: http://www.chartjs.org/docs/latest/ -->
<script src="assets/js/chart.min.js"></script>
<script>
	Chart.defaults.global.defaultFontFamily = "Nunito";
	Chart.defaults.global.defaultFontColor = '#888';
	Chart.defaults.global.defaultFontSize = '14';

	var ctx = document.getElementById('chart').getContext('2d');

	var chart = new Chart(ctx, {
		type: 'line',

		// The data for our dataset
		data: {
			labels: ["January", "February", "March", "April", "May", "June"],
			// Information about the dataset
	   		datasets: [{
				label: "Views",
				backgroundColor: 'rgba(42,65,232,0.08)',
				borderColor: '#2a41e8',
				borderWidth: "3",
				data: [196,132,215,362,210,252],
				pointRadius: 5,
				pointHoverRadius:5,
				pointHitRadius: 10,
				pointBackgroundColor: "#fff",
				pointHoverBackgroundColor: "#fff",
				pointBorderWidth: "2",
			}]
		},

		// Configuration options
		options: {

		    layout: {
		      padding: 10,
		  	},

			legend: { display: false },
			title:  { display: false },

			scales: {
				yAxes: [{
					scaleLabel: {
						display: false
					},
					gridLines: {
						 borderDash: [6, 10],
						 color: "#d8d8d8",
						 lineWidth: 1,
	            	},
				}],
				xAxes: [{
					scaleLabel: { display: false },  
					gridLines:  { display: false },
				}],
			},

		    tooltips: {
		      backgroundColor: '#333',
		      titleFontSize: 13,
		      titleFontColor: '#fff',
		      bodyFontColor: '#fff',
		      bodyFontSize: 13,
		      displayColors: false,
		      xPadding: 10,
		      yPadding: 10,
		      intersect: false
		    }
		},


});

</script>


<script>
		
	$(function(){
	 
		var userLoggedIn = '<?php echo $userLoggedIn; ?>';
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
	        if(inProgress) { //If it is already in the process of loading some posts, just return
				return;
			}
			
			inProgress = true;
			$('#loading').show();
	 
			var page = $('.posts_area').find('.nextPage').val() || 1; //If .nextPage couldn't be found, it must not be on the page yet (it must be the first time loading posts), so use the value '1'
	 
			$.ajax({
				url: "includes/handlers/ajax_load_posts.php",
				type: "POST",
				data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
				cache:false,
	 
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
	
    $(document).ready(function(){		
      	$('.carousel').slick({
			dots: true,
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3
		});
    });  	
 
</script>




</body>
</html>