<?php
// session_start();
require '../../config/config.php';


if (isset($_SESSION['user_id']) && isset($_GET['job_id']) && is_numeric($_GET['job_id'])) {
    $delete = $con->prepare("DELETE FROM bookmarks WHERE user_id = ? AND job_id = ? LIMIT 1");
    $delete->execute([$_SESSION['user_id'], $_GET['job_id']]);
  
    if ($delete->rowCount() == 0) {
      $insert = $con->prepare("INSERT INTO bookmarks (user_id, job_id) VALUES (?, ?)");
      $insert->execute([$_SESSION['user_id'], $_GET['job_id']]);
    }

    echo "done";
}else{

    echo "something went wrong";
}