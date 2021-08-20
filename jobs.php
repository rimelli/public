<?php
include("includes/header.php");


if (isset($_GET['page'])) {
    $page = $_GET['page'];
  } else {
      $page = 1;
  }
  $no_of_records_per_page = 2;
  $offset = ($page-1) * $no_of_records_per_page;

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

</head>
<body class="gray">

<!-- Wrapper -->
<div id="wrapper">

<?php
$sql_count = $con->query("SELECT jobs.*, users.* FROM jobs INNER JOIN users ON jobs.user_id=users.user_id WHERE users.user_closed='no' AND jobs.job_deleted='no'");
  $num_jobs = $sql_count->rowCount();

  $total_pages = ceil($num_jobs / $no_of_records_per_page);
  $pageLink = "";
?>

<!-- Titlebar
================================================== -->
<div class="single-page-header">
  <div class="container container-top">
    <div class="row">
      <div class="col-xl-12">
        <div class="row">
                <div class="col-xl-12">
                  <!-- Account Type -->
                    <h3 class="margin-bottom-10">Find Jobs</h3>
                </div>
            </div>
        <div class="dashboard-box margin-top-0">

          <div class="content with-padding padding-bottom-0">
            

                  <div class="row">

                    <!-- Category -->
                    <div class="col-xl-3 col-md-6">
                      <div class="margin-bottom-20">
                        <input type="text" value="" class="with-border" name="job_title" id="job_title" placeholder="Type Job Title..." autocomplete="off">
                      </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                      <div class="margin-bottom-20">
                        <select class="selectpicker with-border job_check" name="job_position" data-size="7">
                          <option value="" selected>Select Job Position</option>
                          <option value="Player" id="job_position">Player</option>
                          <option value="Head Coach" id="job_position">Head Coach</option>
                          <option value="Assistant Coach" id="job_position">Assistant Coach</option>
                          <option value="Physical Trainer" id="job_position">Physical Trainer</option>
                          <option value="Physiotherapist" id="job_position">Physiotherapist</option>
                          <option value="Goalkeeper Coach" id="job_position">Goalkeeper Coach</option>
                          <option value="Analyst" id="job_position">Analyst</option>
                          <option value="Other" id="job_position">Other</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                      <div class="margin-bottom-20">
                        <select class="selectpicker with-border job_check" name="job_category" data-size="7">
                          <option value="" selected>Select Category</option>
                          <option value="Full Time" id="job_category">Full Time</option>
                          <option value="Freelance" id="job_category">Freelance</option>
                          <option value="Part Time" id="job_category">Part Time</option>
                          <option value="Internship" id="job_category">Internship</option>
                          <option value="Temporary" id="job_category">Temporary</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                      <div class="margin-bottom-20">
                        <select class="selectpicker with-border job_check" name="job_type" data-size="7">
                          <option value="" selected>Select Job Type</option>
                          <option value="Onsite" id="job_type">Onsite</option>
                          <option value="Remote" id="job_type">Remote</option>
                          <option value="Any" id="job_type">Any</option>
                          <option value="Both" id="job_type">Both</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                      <div class="margin-bottom-20">
                        <select class="selectpicker with-border job_check" name="job_sport" data-size="7">
                          <option value="" selected>Select Job Sport</option>
                          <option value="Football" id="job_sport">Football</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                      <div class="margin-bottom-20">
                        <select class="selectpicker with-border job_check" name="job_country" data-size="7" data-live-search="true">
                          <option value="" selected>Select Job Country</option>
                          <option value="England" id="job_country">England</option>
                          <option value="Northern Ireland" id="job_country">Northern Ireland</option>
                          <option value="Scotland" id="job_country">Scotland</option>
                          <option value="Wales" id="job_country">Wales</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                      <div class="margin-bottom-20">
                        <input type="text" value="" class="with-border" name="job_city" id="job_city" placeholder="Type Job City..." autocomplete="off">
                      </div>
                    </div>

                    <div class="col-xl-6 col-md-6">
                      <div class="margin-bottom-20">
                        <div class="row">
                      <div class="col-xl-6">
                        <div class="input-with-icon">
                          <input class="with-border" name="reg_jobsalarymin" type="text" placeholder="Min">
                          <i class="currency">GBP</i>
                        </div>
                      </div>
                      <div class="col-xl-6">
                        <div class="input-with-icon">
                          <input class="with-border" name="reg_jobsalarymax" type="text" placeholder="Max">
                          <i class="currency">GBP</i>
                        </div>
                      </div>
                    </div>

                    <div class="feedback-yes-no margin-top-0">
                      <div class="radio job_check">
                        <input id="radio-1" name="job_salary" type="radio" value="Fixed">
                        <label for="radio-1"><span class="radio-label"></span> Fixed Salary</label>
                      </div>

                      <div class="radio job_check">
                        <input id="radio-2" name="job_salary" type="radio" value="Hourly">
                        <label for="radio-2"><span class="radio-label"></span> Hourly Salary</label>
                      </div>
                    </div>
                      </div>
                    </div>

                  </div>
                    
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Page Content
================================================== -->
<div class="container">
  <div class="row">

    <div class="col-xl-12 col-lg-12 margin-top-20">

      <div class="notify-box margin-top-15">
        <div class="switch-container">
          <label class="switch"><input type="checkbox"><span class="switch-button"></span><span class="switch-text">Turn on email alerts for this search</span></label>
        </div>

        <div class="sort-by">
          <span>Sort by:</span>
          <select class="selectpicker hide-tick">
            <option>Relevance</option>
            <option>Newest</option>
            <option>Oldest</option>
            <option>Random</option>
          </select>
        </div>
      </div>
      
      <!-- Jobs List Container -->
      <div class="listings-container compact-list-layout margin-top-35" id="results">

        <?php
            $sql = $con->query("SELECT jobs.*, users.* FROM jobs INNER JOIN users ON jobs.user_id=users.user_id WHERE users.user_closed='no' AND jobs.job_deleted='no' LIMIT $offset, $no_of_records_per_page");
            $jobs = $sql->fetchAll();
        ?>
        <!--Freelancer -->
        <h3 class="padding-10 filter-title"><?php echo $num_jobs . " " . 'Results'; ?></h3>
        <?php foreach ($jobs as $job) { 

          $date_time = $job['job_post_date'];
            //Timeframe
          $date_time_now = date("Y-m-d");
          $start_date = new DateTime($date_time); //Time of post
          $end_date = new DateTime($date_time_now); //Current time
          $interval = $start_date->diff($end_date); //Difference between dates
          if($interval->y >= 1) {
            if($interval == 1)
              $time_message = $interval->y . " year ago"; //1 year ago
            else
              $time_message = $interval->y . " years ago"; //1+ year ago
          }
          elseif ($interval->m >= 1) {
            if($interval->d == 0) {
              $days = " ago";
            }
            else if($interval->d == 1) {
              $days = $interval->d . " day ago";
            }
            else {
              $days = $interval->d . " days ago";
            }


            if ($interval->m == 1) {
              $time_message = $interval->m . " month ago";
            }
            else {
              $time_message = $interval->m . " months ago";
            }

          }
          else if($interval->d >= 1) {
            if($interval->d == 1) {
              $time_message = "Yesterday";
            }
            else {
              $time_message = $interval->d . " days ago";
            }
          }
          else if($interval->d == 0) {
              $time_message = "Today";
          }
          ?>

            <!-- Job Listing -->
          <a href="job_page.php" class="job-listing">

            <!-- Job Listing Details -->
            <div class="job-listing-details">

              <!-- Logo -->
              <div class="job-listing-company-logo">
                <img src="<?= $job['profile_pic']; ?>" alt="Img">
              </div>

              <!-- Details -->
              <div class="job-listing-description">
                <h3 class="job-listing-title"><?php echo $job['job_title']; ?></h3>

                <!-- Job Listing Footer -->
                <div class="job-listing-footer">
                  <ul>
                    <li><i class="icon-material-outline-business"></i> <?php echo $job['first_name'] . ' ' . $job['last_name']; ?> <?php if ($job['verified'] == "yes") echo '<div class="verified-badge" title="Verified" data-tippy-placement="top"></div>'; ?></li>
                    <li><i class="icon-material-outline-location-on"></i> <?php echo $job['job_city'] . ', ' . $job['job_country']; ?></li>
                    <li><i class="icon-material-outline-business-center"></i> <?php echo $job['job_category']; ?></li>
                    <li><i class="icon-material-outline-access-time"></i> <?php echo $time_message; ?></li>
                  </ul>
                </div>
              </div>

              <!-- Bookmark -->
              <span class="bookmark-icon"></span>
            </div>
          </a>
        <?php } ?>


          <div class="pagination-container margin-top-40 margin-bottom-60">
            <nav class="pagination">
              <ul>
                <?php

                if($page >= 2){
                    echo "<li class='pagination-arrow'><a href='jobs.php?page=".($page-1)."' class='ripple-effect'><i class='icon-material-outline-keyboard-arrow-left'></i></a></li>";
                }
                
                for ($i=1; $i<=$total_pages; $i++) {   
                  if ($i == $page) {   
                      $pageLink .= "<li><a class = 'current-page' href='jobs.php?page="  
                                                        .$i."'>".$i." </a></li>";   
                  }               
                  else  {   
                      $pageLink .= "<li><a href='jobs.php?page=".$i."'>   
                                                        ".$i." </a></li>";     
                  }   
                };
                echo $pageLink;
                
                
                if($page < $total_pages){
                    echo "<li class='pagination-arrow'><a href='jobs.php?page=".($page+1)."' class='ripple-effect'><i class='icon-material-outline-keyboard-arrow-right'></i></a></li>";
                }
                ?>
              </ul>
            </nav>
          </div>

  
      </div>
      <!-- Jobs Container / End -->

    </div>
  </div>
</div>


</div>
<!-- Wrapper / End -->

<!-- Footer -->
<?php include("includes/menu_footer.php"); ?>
<!-- Footer / End -->


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


<script>
  $(document).ready(function() {

      $(".job_check").on('change', function() {

        var job_filter = 'data';
        var job_title = get_filter_text('job_title');
        var job_position = get_filter_text('job_position');
        var job_category = get_filter_text('job_category');
        var job_type = get_filter_text('job_type');
        var job_sport = get_filter_text('job_sport');
        var job_country = get_filter_text('job_country');
        var job_city = get_filter_text('job_city');
        var job_salary = get_filter_text('job_salary');

        $.ajax({
          url:'filter_jobs.php',
          method:'POST',
          data:{job_filter:job_filter,job_title:job_title,job_position:job_position,job_category:job_category,job_type:job_type,job_sport:job_sport,job_country:job_country,job_city:job_city,job_salary:job_salary},
          success:function(response){
            $("#results").html(response);
          }
        });

      });
      
      function get_filter_text(text_id) {
        var filterData = [];
        $('#'+text_id+':checked').each(function() {
            filterData.push($(this).val());
        });
        $('#'+text_id+':selected').each(function() {
            filterData.push($(this).val());
        });
        return filterData;
      }

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


</body>
</html>

