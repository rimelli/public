<?php 
include("../../config/config.php");
include("../../includes/classes/User.php");


if(isset($_POST['query'])) {

    $retval = '';

    $retval .= '<div class="search-results-box" style="max-height: 250px; border-radius:6px;">';
     
    $result = $con->query("SELECT * FROM users WHERE (first_name LIKE '%{$_POST['query']}%' OR last_name LIKE '%{$_POST['query']}%') AND user_closed='no' LIMIT 10");
 
    if ($result->rowCount() > 0) {

        while ($row = $result->fetch()) {
            
            $retval .= '<p style="margin-top: 10px;"><img src="'.$row['profile_pic'].'" class="img-search-result"><a href="#">'.$row['first_name'].' ' . $row['last_name'] . ' @' . $row['username'] . '</a></p>';

        }

    }

    $retval .= '</div>';

    echo $retval;
 
}

?>