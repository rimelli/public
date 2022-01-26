<?php
include("includes/header.php");
include("includes/form_handlers/jobs_handler.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])){
	$check = $con -> prepare("SELECT * FROM jobs WHERE id=? AND user_id=? LIMIT 1");
	$check -> execute([$_GET['id'], $userLoggedIn]);
	$jobs = $check->fetch();

	if (!$jobs){		
		exit();
	}
	
}else{	
	exit();

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
<link rel="stylesheet" href="assets/vendor/flatpickr/dist/flatpickr.css">

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
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Edit Job #<?php echo $_GET['id']; ?></h3>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-feather-folder-plus"></i> Edit Job</h3>
						</div>

						<form method="POST" id="jobs-post-submit">
						<input type="hidden" name="edit_job" value="1" />
						<input type="hidden" name="job_id" value="<?php echo $jobs['id']; ?>" />
						<div class="content with-padding padding-bottom-10">
							<div class="row">

								
								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Job Title</h5>
										<input type="text" class="with-border" name="reg_jbtitle" value="<?php echo $jobs['job_title']; ?>"  required>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Job Position</h5>
										<select class="selectpicker with-border" name="reg_jbposition" data-size="7" title="Select Position" required>
											<option <?php if ($jobs['job_position'] == 'Player') echo 'selected'; ?>>Player</option>
											<option <?php if ($jobs['job_position'] == 'Head Coach') echo 'selected'; ?>>Head Coach</option>
											<option <?php if ($jobs['job_position'] == 'Assistant Coach') echo 'selected'; ?>>Assistant Coach</option>
											<option <?php if ($jobs['job_position'] == 'Physical Trainer') echo 'selected'; ?>>Physical Trainer</option>
											<option <?php if ($jobs['job_position'] == 'Physiotherapist') echo 'selected'; ?>>Physiotherapist</option>
											<option <?php if ($jobs['job_position'] == 'Goalkeeper Coach') echo 'selected'; ?>>Goalkeeper Coach</option>
											<option <?php if ($jobs['job_position'] == 'Analyst') echo 'selected'; ?>>Analyst</option>
											<option <?php if ($jobs['job_position'] == 'Other') echo 'selected'; ?>>Other</option>
										</select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Job Category</h5>
										<select class="selectpicker with-border" name="reg_jbcategory" data-size="7" title="Select Job Category" required>
											<option <?php if ($jobs['job_category'] == 'Full Time') echo 'selected'; ?>>Full Time</option>
											<option <?php if ($jobs['job_category'] == 'Freelance') echo 'selected'; ?>>Freelance</option>
											<option <?php if ($jobs['job_category'] == 'Part Time') echo 'selected'; ?>>Part Time</option>
											<option <?php if ($jobs['job_category'] == 'Internship') echo 'selected'; ?>>Internship</option>
											<option <?php if ($jobs['job_category'] == 'Temporary') echo 'selected'; ?>>Temporary</option>
										</select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Job Type</h5>
										<select class="selectpicker with-border" name="reg_jbtype" data-size="7" title="Select Job Type" required>
											<option <?php if ($jobs['job_type'] == 'Onsite') echo 'selected'; ?>>Onsite</option>
											<option <?php if ($jobs['job_type'] == 'Remote') echo 'selected'; ?>>Remote</option>
											<option <?php if ($jobs['job_type'] == 'Any') echo 'selected'; ?>>Any</option>
											<option <?php if ($jobs['job_type'] == 'Both') echo 'selected'; ?>>Both</option>
										</select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Sport</h5>
										<select class="selectpicker with-border" name="reg_jbsport" data-size="7" title="Select Sport" required>
											<option <?php if ($jobs['job_sport'] == 'Football') echo 'selected'; ?>>Football</option>
										</select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Country</h5>
										<select class="selectpicker with-border" name="reg_jbcountry" data-size="7" title="Select Country" id="job_country" data-live-search="true" required>
					                          <option value="England" <?php if ($jobs['job_country'] == 'England') echo 'selected'; ?>>England</option>
					                          <option value="Northern Ireland" <?php if ($jobs['job_country'] == 'Northern Ireland') echo 'selected'; ?>>Northern Ireland</option>
					                          <option value="Scotland" <?php if ($jobs['job_country'] == 'Scotland') echo 'selected'; ?>>Scotland</option>
					                          <option value="Wales" <?php if ($jobs['job_country'] == 'Wales') echo 'selected'; ?>>Wales</option>
										</select>
									</div>
								</div>

								<div class="col-xl-4" id="job_city" style="display: none;">
									<div class="submit-field">
										<h5>City</h5>
										<div class="input-with-icon">
											<div id="autocomplete-container" class="search-box">
												<input id="autocomplete-input" class="with-border" name="reg_jbcity" id="job_city_based" type="text" placeholder="Type City" value="<?php echo $jobs['job_city']; ?>, <?php echo $jobs['job_county']; ?>" required>
												<div class="result search-results-box"></div>
											</div>
											<i class="icon-material-outline-location-on"></i>
										</div>
									</div>
								</div>

								

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Salary</h5>
										<div class="row">
											<div class="col-xl-6">
												<div class="input-with-icon">
													<input class="with-border" value="<?php echo $jobs['job_salary_min']; ?>" name="reg_jbsalarymin" type="text" placeholder="Min" required>
													<i class="currency">GBP</i>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="input-with-icon">
													<input class="with-border" value="<?php echo $jobs['job_salary_max']; ?>" name="reg_jbsalarymax" type="text" placeholder="Max" required>
													<i class="currency">GBP</i>
												</div>
											</div>
										</div>

										<div class="feedback-yes-no margin-top-0">
											<div class="radio">
												<input id="radio-1" name="reg_jbsalary" type="radio" value="Fixed" <?php if ($jobs['job_salary'] == 'Fixed') echo 'checked'; ?> required>
												<label for="radio-1"><span class="radio-label"></span> Fixed Salary</label>
											</div>

											<div class="radio">
												<input id="radio-2" name="reg_jbsalary" type="radio" value="Hourly" <?php if ($jobs['job_salary'] == 'Hourly') echo 'checked'; ?> required>
												<label for="radio-2"><span class="radio-label"></span> Hourly Salary</label>
											</div>
										</div>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Expiration Date <span>(if any)</span></h5>
										<!-- Flatpickr -->
				                        <input type="date" value="<?php echo $jobs['job_exp_date'] != '0000-00-00' ? $jobs['job_exp_date'] : ''; ?>" class="flatpickr-custom-form-control form-control with-border input" name="reg_jbexpdate" placeholder="Select Expiration Date" id="jobExpDate" data-input>				                          
				                        <!-- End Flatpickr -->
				                    </div>
								</div>

								<div class="col-xl-12">
									<div class="submit-field">
										<h5>Job Description</h5>
										<textarea cols="30" rows="5" class="with-border" name="reg_jbdescription" required><?php echo $jobs['job_description']; ?></textarea>
									</div>
								</div>

							</div>
						</div>

						<div class="headline">
							<h3 class="margin-bottom-10"><i class="icon-feather-folder-plus"></i> Employer Details</h3>
							<span>Posting as <strong><?php echo $user['first_name'] . ' ' . $user['last_name'] ?></strong></span>
						</div>

						<div class="content with-padding padding-bottom-10">
							<div class="row">

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Contact Email</h5>
										<input type="text" class="with-border" name="reg_jbcontact" value="<?php echo $jobs['employer_email']; ?>" required>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Website</h5>
										<input type="text" class="with-border" name="reg_jbwebsite" value="<?php echo $jobs['employer_website']; ?>">
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>

				<div class="col-xl-12">
					<button type="submit" class="button ripple-effect big margin-top-30 save-details"><i class="far fa-edit fa-xs" style="font-size:18px;top:0"></i> Edit Job</button>
					<?php if (in_array("<span style='color: #14C800;'>You're all set! Your job is posted!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Your job is posted!</span><br>"; ?>
				</div>
				</form>

			</div>
			<!-- Row / End -->

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

<!-- Job Post Overlay / Loader -->
<div id="job-post-overlay"></div>
<div id="job-post-loader">	
	<i class="fas fa-circle-notch fa-spin"></i>
	<ul>
		<li>Editing job</li>
		<li>Please wait ...</li>
	</ul>		
</div>


<!-- Scripts
================================================== -->
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
<script src="assets/vendor/flatpickr/dist/flatpickr.min.js"></script>
<script src="assets/js/front/hs.flatpickr.js"></script>

<script>

	$('#jobExpDate').flatpickr({
	enableTime: false,
	static: true,
	altInput: true,
	altFormat: "F j, Y",
	dateFormat: "Y-m-d"
});

</script>


<script>
	$(document).ready(function(){
		if ($(`#job_country`).val().length) {
        	$("#job_city").show();
    	}
	});
</script>

<script>
	$(function () {
  $("#job_country").change(function() {
    var val = $(this).val();
    $("#job_city_based").val("");
    if(val != "") {
        $("#job_city").show();
    }
    else if(val === "") {
        $("#job_city").hide();
    }
  });
});
</script>

<script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
    	var countryBased = $("#job_country").val();
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("includes/handlers/ajax_query_cities.php", {term: inputVal, country: countryBased}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
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


</body>
</html>