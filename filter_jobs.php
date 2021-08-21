<?php
require 'config/config.php';


if (isset($_POST['job_filter'])) {
	$sql = "SELECT jobs.*, users.* FROM jobs INNER JOIN users ON jobs.user_id=users.user_id WHERE users.user_closed='no' AND jobs.job_deleted='no' ";

	$items = ['job_position', 'job_category', 'job_type', 'job_sport', 'job_country', 'job_city', 'job_salary'];

	foreach ($items as $item){
		if (isset($_POST[$item])) {	
			if (is_array($_POST[$item])){	
				$sql .= sprintf("AND jobs.%s IN('%s') ", $item, implode("','", $_POST[$item]));
			}else{
				$sql .= sprintf("AND jobs.%s IN('%s') ", $item, implode("','", explode(',', $_POST[$item])));
			}
		}
	} 

	//  Job title search
	if (isset($_POST['job_title'])){
		$sql .= sprintf("AND (jobs.job_title LIKE '%%%s' OR jobs.job_title LIKE '%%%s%%' OR jobs.job_title LIKE '%s%%') ", $_POST['job_title'], $_POST['job_title'], $_POST['job_title']);
	}

	//  Job salary min/max	
	if (isset($_POST['job_salary_min'])){
		$sql .= sprintf("AND jobs.job_salary_min >= %d ", $_POST['job_salary_min']);
	}
	if (isset($_POST['job_salary_max'])){
		$sql .= sprintf("AND jobs.job_salary_max <= %d ", $_POST['job_salary_max']);
	}

  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  }elseif (isset($_POST['page'])) {
	$page = $_POST['page'];
  } else {
      $page = 1;
  }
  $no_of_records_per_page = 2;
  $offset = ($page-1) * $no_of_records_per_page;

  $all_query = $con->query($sql);
  $count_all = $all_query->rowCount();

  // Sort
  if (isset($_POST['sort'])){
	  switch($_POST['sort']){
		case 'Relevance':
			//  Don't know how to order when it's Relevance
			break;
		case 'Newest':
			$sql .= 'ORDER BY jobs.id DESC ';
			break;
		case 'Oldest':
			break;
			$sql .= 'ORDER BY jobs.id ASC ';
		case 'Random':
			$sql .= 'ORDER BY RAND() ';
	  }
  }

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

			  if($page >= 2){
				  echo "<li class='pagination-arrow'><a href=\"#\" data-page='".($page-1)."' class=\"ripple-effect pag_go\"><i class='icon-material-outline-keyboard-arrow-left'></i></a></li>";
			  }
			  
			  for ($i=1; $i<=$total_pages; $i++) {   
				if ($i == $page) {   
					echo "<li><a class=\"current-page pag_go\" href=\"#\" data-page='". $i. "'>".$i." </a></li>";   
				}               
				else  {   
					echo "<li><a class=\"pag_go\" href=\"#\" data-page='". $i. "'>".$i." </a></li>";     
				}   
			  };	  
			  
			  
			  if($page < $total_pages){
				  echo "<li class='pagination-arrow'><a ref=\"#\" class=\"pag_go\" data-page='".($page+1)."' class='ripple-effect'><i class='icon-material-outline-keyboard-arrow-right'></i></a></li>";
			  }			 

  echo "</ul>
      </nav>
    </div>";
}


?>



