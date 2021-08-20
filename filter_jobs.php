<?php
require 'config/config.php';


if (isset($_POST['job_filter'])) {
	$sql = "SELECT jobs.*, users.* FROM jobs INNER JOIN users ON jobs.user_id=users.user_id WHERE users.user_closed='no' AND jobs.job_deleted='no'";

  if (isset($_POST['job_title'])) {
    $job_title = implode("','", $_POST['job_title']);
    $sql .="AND jobs.job_title IN('".$job_title."')";
  }
  if (isset($_POST['job_position'])) {
    $job_position = implode("','", $_POST['job_position']);
    $sql .="AND jobs.job_position IN('".$job_position."')";
  }
  if (isset($_POST['job_category'])) {
    $job_category = implode("','", $_POST['job_category']);
    $sql .="AND jobs.job_category IN('".$job_category."')";
  }
  if (isset($_POST['job_type'])) {
    $job_type = implode("','", $_POST['job_type']);
    $sql .="AND jobs.job_type IN('".$job_type."')";
  }
  if (isset($_POST['job_sport'])) {
    $job_sport = implode("','", $_POST['job_sport']);
    $sql .="AND jobs.job_sport IN('".$job_sport."')";
  }
  if (isset($_POST['job_country'])) {
    $job_country = implode("','", $_POST['job_country']);
    $sql .="AND jobs.job_country IN('".$job_country."')";
  }
  if (isset($_POST['job_city'])) {
    $job_city = implode("','", $_POST['job_city']);
    $sql .="AND jobs.job_city IN('".$job_city."')";
  }
  if (isset($_POST['job_salary'])) {
    $job_salary = implode("','", $_POST['job_salary']);
    $sql .="AND jobs.job_salary IN('".$job_salary."')";
  }


  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  } else {
      $page = 1;
  }
  $no_of_records_per_page = 2;
  $offset = ($page-1) * $no_of_records_per_page;

  $all_query = $con->query($sql);
  $count_all = $all_query->rowCount();

  $sql .="LIMIT $offset, $no_of_records_per_page";


	$result = $con->query($sql);
  $num_result = $result->rowCount();
	$output ='';
  $total_pages = ceil($num_result / $no_of_records_per_page);
  $pageLink = "";

	if ($result->rowCount() > 0) {
    $total_pages = ceil($count_all / $no_of_records_per_page);
    $rows = $result->fetchAll();
    $output .='<h3 class="padding-10 filter-title">'.$count_all . " " . "Results" .'</h3>';
    for ($i=1; $i<=$total_pages; $i++) {   
      if ($i == $page) {   
          $pageLink .= "<li><a class='current-page' href='jobs.php?page=".$i."'>".$i." </a></li>";   
      }               
      else  {   
          $pageLink .= "<li><a href='jobs.php?page=".$i."'>".$i." </a></li>";     
      }   
    };

		foreach ($rows as $row) {
      
      $date_time = $row['job_post_date'];
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

			$output .='<a href="job_page.php" class="job-listing">

          <!-- Job Listing Details -->
            <div class="job-listing-details">

              <!-- Logo -->
              <div class="job-listing-company-logo">
                <img src="'.$row['profile_pic'].'" alt="Img">
              </div>

              <!-- Details -->
              <div class="job-listing-description">
                <h3 class="job-listing-title">'.$row['job_title'].'</h3>
                <!-- Job Listing Footer -->
                <div class="job-listing-footer">
                  <ul>
                    <li><i class="icon-material-outline-business"></i> '.$row['first_name'] . ' ' . $row['last_name'].' '.($row['verified'] == "yes" ? '<div class="verified-badge" title="Verified" data-tippy-placement="top"></div>' : '').'</li>
                    <li><i class="icon-material-outline-location-on"></i> '.$row['job_city'] . ', ' . $row['job_country'].'</li>
                    <li><i class="icon-material-outline-business-center"></i> '.$row['job_category'].'</li>
                    <li><i class="icon-material-outline-access-time"></i> '.$time_message.'</li>
                  </ul>
                </div>
              </div>
              
              <!-- Bookmark -->
              <span class="bookmark-icon"></span>
            </div>
              </a>';

		}
	}
	else {
		$output = "<h3 class='filter-title'>No Jobs Found!</h3>";
	}
	echo $output;

  echo "<div class='pagination-container margin-top-40 margin-bottom-60'>
            <nav class='pagination'>
              <ul>";

  if ($page >= 2) {
      echo "<li class='pagination-arrow'><a href='jobs.php?page=".($page-1)."' class='ripple-effect'><i class='icon-material-outline-keyboard-arrow-left'></i></a></li>";
  }
  echo $pageLink;

  if($page < $total_pages){
      echo "<li class='pagination-arrow'><a href='jobs.php?page=".($page+1)."' class='ripple-effect'><i class='icon-material-outline-keyboard-arrow-right'></i></a></li>";
  }

  echo "</ul>
      </nav>
    </div>";
}


?>



