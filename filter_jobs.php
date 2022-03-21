<?php
require 'config/config.php';
require 'includes/classes/Filter.php';
$filter = new Filter($con, $_SESSION['user_id']);

if (isset($_POST['job_filter'])) {
  $sql = "SELECT jobs.*, jobs.id AS job_id, users.*, bookmarks.id AS bookmark_id  
			FROM jobs 
			INNER JOIN users ON jobs.user_id=users.user_id  
			LEFT JOIN bookmarks ON (bookmarks.user_id = " . $_SESSION['user_id'] . " AND bookmarks.job_id = jobs.id) 
			WHERE users.user_closed='no'
			AND jobs.job_deleted='no' ";

  $items = ['job_position', 'job_category', 'job_type', 'job_country', 'job_salary'];

  foreach ($items as $item) {
    if (isset($_POST[$item])) {
      if (is_array($_POST[$item])) {
        $sql .= sprintf("AND jobs.%s IN('%s') ", $item, implode("','", $_POST[$item]));
      } else {
        $sql .= sprintf("AND jobs.%s IN('%s') ", $item, implode("','", explode(',', $_POST[$item])));
      }
    }
  }

  //  Job title search
  if (isset($_POST['job_title'])) {
    $sql .= sprintf("AND (jobs.job_title LIKE '%%%s' OR jobs.job_title LIKE '%%%s%%' OR jobs.job_title LIKE '%s%%') ", $_POST['job_title'], $_POST['job_title'], $_POST['job_title']);
  }

  //  Job city
  if (!isset($_POST['job_distance']) || empty($_POST['job_distance'])) {
    if (isset($_POST['job_city'])) {
      if (strpos($_POST['job_city'], ',') === FALSE) {
        $sql .= sprintf("AND jobs.job_city = '%s' ", trim($_POST['job_city']));
      } else {
        $city = explode(',', $_POST['job_city']);
        $sql .= sprintf("AND jobs.job_city = '%s' AND jobs.job_county = '%s' ", trim($city[0]), trim($city[1]));
      }
    }
  }


  //  Job salary min/max  
  if (isset($_POST['job_salary_min'])) {
    $sql .= sprintf("AND jobs.job_salary_min >= %d ", $_POST['job_salary_min']);
  }
  if (isset($_POST['job_salary_max'])) {
    $sql .= sprintf("AND jobs.job_salary_max <= %d ", $_POST['job_salary_max']);
  }


  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  } elseif (isset($_POST['page'])) {
    $page = $_POST['page'];
  } else {
    $page = 1;
  }
  $no_of_records_per_page = 2;
  $offset = ($page - 1) * $no_of_records_per_page;

  $all_query = $con->query($sql);
  $count_all = $all_query->rowCount();

  // Sort
  if (isset($_POST['sort'])) {
    switch ($_POST['sort']) {
      case 'Relevance':
        //  Don't know how to order when it's Relevance
        break;
      case 'Newest':
        $sql .= 'ORDER BY jobs.id ASC ';
        break;
      case 'Oldest':
        $sql .= 'ORDER BY jobs.id DESC ';
        break;
      case 'Random':
        $sql .= 'ORDER BY RAND() ';
    }
  }

  if(!isset($_POST['job_distance']) || empty($_POST['job_distance'])){
    $sql .= "LIMIT $offset, $no_of_records_per_page";
  }


  $result = $con->query($sql);
  $num_result = $result->rowCount();
  $output = '';
  $total_pages = ceil($num_result / $no_of_records_per_page);
  $pageLink = "";

  if ($result->rowCount() > 0) {
    $total_pages = ceil($count_all / $no_of_records_per_page);
    $rows = $result->fetchAll();
    if (isset($_POST['job_distance']) && !empty($_POST['job_distance']) && isset($_POST['job_city'])) {
      $filterrows = [];
      $city_from = $filter->get_towns($_POST['job_city']);
      foreach ($rows as $row) {
        $city = $row['job_city'] . ',' . $row['job_county'];
        $to_city = $filter->get_towns($city);
        $distance = $filter->distance($city_from['latitude'], $city_from['longitude'], $to_city['latitude'], $to_city['longitude'], "M");
        if ($distance <= (int) $_POST['job_distance']) {
          array_push($filterrows, $row);
        }
      }
      $rows = $filterrows;
      $count_all = count($filterrows);
      $total_pages = ceil($count_all / $no_of_records_per_page);
      $rows = array_slice($rows, $offset, $no_of_records_per_page);
    }
    $output .= '<h3 class="padding-10 filter-title">' . $count_all . " " . "Results" . '</h3>';

    if (empty($rows)) {
      $output = "<h3 class='filter-title'>No Jobs Found!</h3>";
    } else {

      foreach ($rows as $row) {

        $job_id = $row['job_id'];

        $date_time = $row['job_post_date'];
        //Timeframe
        $date_time_now = date("Y-m-d");
        $start_date = new DateTime($date_time); //Time of post
        $end_date = new DateTime($date_time_now); //Current time
        $interval = $start_date->diff($end_date); //Difference between dates
        if ($interval->y >= 1) {
          if ($interval == 1)
            $time_message = $interval->y . " year ago"; //1 year ago
          else
            $time_message = $interval->y . " years ago"; //1+ year ago
        } elseif ($interval->m >= 1) {
          if ($interval->d == 0) {
            $days = " ago";
          } else if ($interval->d == 1) {
            $days = $interval->d . " day ago";
          } else {
            $days = $interval->d . " days ago";
          }


          if ($interval->m == 1) {
            $time_message = $interval->m . " month ago";
          } else {
            $time_message = $interval->m . " months ago";
          }
        } else if ($interval->d >= 1) {
          if ($interval->d == 1) {
            $time_message = "Yesterday";
          } else {
            $time_message = $interval->d . " days ago";
          }
        } else if ($interval->d == 0) {
          $time_message = "Today";
        }

        $output .= '<a href="job_page.php?id=' . $job_id . '" class="job-listing">

          <!-- Job Listing Details -->
            <div class="job-listing-details">

              <!-- Logo -->
              <div class="job-listing-company-logo">
                <img src="' . $row['profile_pic'] . '" alt="Profile">
              </div>

              <!-- Details -->
              <div class="job-listing-description">
                <h3 class="job-listing-title">' . $row['job_title'] . '</h3>
                <!-- Job Listing Footer -->
                <div class="job-listing-footer">
                  <ul>
                    <li><i class="icon-material-outline-business"></i> ' . $row['first_name'] . ' ' . $row['last_name'] . ' ' . ($row['verified'] == "yes" ? '<div class="verified-badge" title="Verified" data-tippy-placement="top"></div>' : '') . '</li>
                    <li><i class="icon-material-outline-location-on"></i> ' . $row['job_city'] . ', ' . $row['job_country'] . '</li>
                    <li><i class="icon-material-outline-business-center"></i> ' . $row['job_category'] . '</li>
                    <li><i class="icon-material-outline-access-time"></i> ' . $time_message . '</li>
                  </ul>
                </div>
              </div>
              
              <!-- Bookmark -->
              <span class="bookmark-icon' . ($row['bookmark_id'] ? ' bookmarked' : '') . '" data-job_id="' . $job_id . '"></span>
            </div>
              </a>';
      }
    }
  } else {
    $output = "<h3 class='filter-title'>No Jobs Found!</h3>";
  }
  echo $output;

  echo "<div class='pagination-container margin-top-40 margin-bottom-60'>
            <nav class='pagination'>
              <ul>";

  if ($page >= 2) {
    echo "<li class='pagination-arrow'><a href=\"#\" data-page='" . ($page - 1) . "' class=\"ripple-effect pag_go\"><i class='icon-material-outline-keyboard-arrow-left'></i></a></li>";
  }

  for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $page) {
      echo "<li><a class=\"current-page pag_go\" href=\"#\" data-page='" . $i . "'>" . $i . " </a></li>";
    } else if (($i < $page && $i >= ($page - 4)) || ($i > $page && $i <= ($page + 4))) {
      echo "<li><a class=\"pag_go\" href=\"#\" data-page='" . $i . "'>" . $i . " </a></li>";
    }
  };


  if ($page < $total_pages) {
    echo "<li class='pagination-arrow'><a href=\"#\" class=\"pag_go\" data-page='" . ($page + 1) . "' class='ripple-effect'><i class='icon-material-outline-keyboard-arrow-right'></i></a></li>";
  }

  echo "</ul>
      </nav>
    </div>";

  //  Bookmark add here	
} else if (isset($_SESSION['user_id']) && isset($_GET['job_id']) && is_numeric($_GET['job_id'])) {
  $delete = $con->prepare("DELETE FROM bookmarks WHERE user_id = ? AND job_id = ? LIMIT 1");
  $delete->execute([$_SESSION['user_id'], $_GET['job_id']]);

  if ($delete->rowCount() == 0) {
    $insert = $con->prepare("INSERT INTO bookmarks (user_id, job_id) VALUES (?, ?)");
    $insert->execute([$_SESSION['user_id'], $_GET['job_id']]);
  }
}
