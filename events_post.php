<?php
include("includes/header.php");
include("includes/form_handlers/events_handler.php");
?>



<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>Tryouts</title>
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
				<h3>Post an Event</h3>
			</div>
	
			<!-- Row -->
			<div class="row">

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-feather-folder-plus"></i> Event Submission</h3>
						</div>

						<form method="POST" id="events-post-submit" autocomplete="off">
						<input type="hidden" name="post_event" value="1" />
						<div class="content with-padding padding-bottom-10">
							<div class="row">

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Event Name</h5>
										<input type="text" class="with-border" name="reg_evtitle" required>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Event Category</h5>
										<select class="selectpicker with-border" name="reg_evcategory" data-size="7" title="Select Event Category" required>
											<option>Trial</option>
											<option>Camp</option>
											<option>Tournament</option>
											<option>Other</option>
										</select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Sport</h5>
										<select class="selectpicker with-border" name="reg_evsport" data-size="7" title="Select Sport" required>
											<option>Football</option>
										</select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Gender</h5>
										<select class="selectpicker with-border" name="reg_evgender" data-size="7" title="Select Gender" required>
											<option>Male</option>
											<option>Female</option>
										</select>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Age Range</h5>
										<div class="row">
											<div class="col-xl-6">
												<div class="input-with-icon">
													<input class="with-border" name="reg_agemin" type="text" placeholder="Min" required>
												</div>
											</div>
											<div class="col-xl-6">
												<div class="input-with-icon">
													<input class="with-border" name="reg_agemax" type="text" placeholder="Max" required>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Online Event</h5>
										<select class="selectpicker with-border" name="reg_evonline" id="reg_evonline" data-size="7" title="Select Option" required>
											<option selected>No</option>
											<option>Yes</option>
										</select>
									</div>
								</div>

								<div class="col-xl-4" id="event_link" style="display: none;">
									<div class="submit-field">
										<h5>Event Link</h5>
										<input type="text" class="with-border" name="reg_evlink">
									</div>
								</div>

								<div class="col-xl-4" id="country_div">
									<div class="submit-field">
										<h5>Country</h5>
										<select class="selectpicker with-border" name="reg_evcountry" data-size="7" title="Select Country" id="event_country" data-live-search="true" required>
											<option value="none" style="display: none;"></option>
											<option value="England">England</option>
					                        <option value="Northern Ireland">Northern Ireland</option>
					                        <option value="Scotland">Scotland</option>
					                        <option value="Wales">Wales</option>
										</select>
									</div>
								</div>

								<div class="col-xl-4" id="event_city" style="display: none;">
									<div class="submit-field">
										<h5>City</h5>
										<div class="input-with-icon">
											<div id="autocomplete-container" class="search-box">
												<input id="autocomplete-input" class="with-border" name="reg_evcity" id="event_city_based" type="text" placeholder="Type City">
												<div class="result"></div>
											</div>
											<i class="icon-material-outline-location-on"></i>
										</div>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Event Date</h5>
										
										<!-- Flatpickr -->
				                            <input type="date" value="" class="flatpickr-custom-form-control form-control with-border input" name="reg_evdate" placeholder="Select Event Date" id="eventDate" data-input required>
				                          
				                        <!-- End Flatpickr -->
				                    </div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>What is the registration fee?</h5>
										<div class="row">
											<div class="col-xl-12">
												<div class="input-with-icon">
													<input class="with-border" name="reg_evfee" type="text" placeholder="Price" required>
													<i class="currency">GBP</i>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="col-xl-12">
									<div class="submit-field">
										<h5>Event Description</h5>
										<textarea cols="30" rows="5" class="with-border" name="reg_evdescription" required></textarea>
									</div>
								</div>

							</div>
						</div>

						<div class="headline">
							<h3><i class="icon-feather-folder-plus"></i> Organizer Details</h3>
							<span>Posting as <strong><?php echo $user['first_name'] . ' ' . $user['last_name'] ?></strong></span>
						</div>

						<div class="content with-padding padding-bottom-10">
							<div class="row">

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Contact Email</h5>
										<input type="text" class="with-border" name="reg_evcontact" value="<?php echo $user['email'] ?>" required>
									</div>
								</div>

								<div class="col-xl-4">
									<div class="submit-field">
										<h5>Website</h5>
										<input type="text" class="with-border" name="reg_evwebsite" value="<?php echo $user['website'] ?>">
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>

				<div class="col-xl-12">
					<button type="submit" name="post_event" class="button ripple-effect big margin-top-30 save-details"><i class="icon-feather-plus"></i> Post an Event</button>
					<?php if (in_array("<span style='color: #14C800;'>You're all set! Your event is posted!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Your event is posted!</span><br>"; ?>
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

<!-- Post Overlay / Loader -->
<div id="post-overlay"></div>
<div id="post-loader">	
	<i class="fas fa-circle-notch fa-spin"></i>
	<ul>
		<li>Creating a new event</li>
		<li>Please wait ...</li>
	</ul>		
</div>


<!-- Scripts
================================================== -->
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
<script src="assets/vendor/flatpickr/dist/flatpickr.min.js"></script>
<script src="assets/js/front/hs.flatpickr.js"></script>

<script>

	$('#eventDate').flatpickr({
	enableTime: true,
	static: true,
	altInput: true,
	altFormat: "F j, Y",
	dateFormat: "Y-m-d H:i:s",
	minDate: "today"
});

</script>

<script>
	$(document).ready(function(){
	  $('#reg_evonline').on('change',function(){
	    if($(this).val() == 'Yes'){
	    	$('#country_div').hide();
	    	$('#event_city').hide();
	    	$('#event_link').show();
	    	$('#event_link').prop('required',true);
	    	$('#event_country').prop('required',false);
	    	$('#event_city_based').prop('required',false);
	    } else{
	      	$('#country_div').show();
	    	$('#event_link').hide();
	    	$('#event_link').prop('required',true);
	    	$('#event_country').prop('required',true);
	    	$('#event_city_based').prop('required',true);
	    }
	  });
	});
</script>

<script>
	$(document).ready(function(){
		if ($(`#event_country`).val().length) {
        	$("#event_city").show();
    	}
	});
</script>

<script>
	$(function () {
  $("#event_country").change(function() {
    var val = $(this).val();
    $("#event_city_based").val("");
    if(val != "") {
        $("#event_city").show();
    }
    else if(val === "") {
        $("#event_city").hide();
    }
  });
});
</script>


<script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
    	var countryBased = $("#event_country").val();
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("includes/handlers/ajax_search_cities.php", {term: inputVal, country: countryBased}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
                resultDropdown.addClass('search-results-box');
            });
        } else{
        	resultDropdown.removeClass('search-results-box');
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").removeClass('search-results-box');
        $(this).parent(".result").empty();
    });
});
</script>


</body>
</html>