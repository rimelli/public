<?php 
include("../../config/config.php");
include("../../includes/classes/User.php");

$output = '';
$sql = $con->query("SELECT * FROM users WHERE username LIKE '%" .$_POST["search"]. "%'");

if ($sql->rowCount() > 0) {
	$output .= "<div class='header-notifications-content'>
				<ul>
				<li class='notifications-not-read'>
				<a href='" . $row['username'] . "'>
					<span class='notification-icon'>
						<img src='" . $row['profile_pic'] ."'>
					</span>

					<div class='notification-text'>
						" . $row['first_name'] . " " . $row['last_name'] . "
						<p>" . $row['username'] ."</p>
					</div>
				</a>
				</li>
				</ul>
				</div>";

	while ($row = $sql->fetch()) {
		$output .= "<li class='notifications-not-read'>
				<a href='" . $row['username'] . "'>
					<span class='notification-icon'>
						<img src='" . $row['profile_pic'] ."'>
					</span>

					<div class='notification-text'>
						" . $row['first_name'] . " " . $row['last_name'] . "
						<p>" . $row['username'] ."</p>
					</div>
				</a>
				</li>";
	}
	echo $output;

} else {
	echo 'Data Not Found';
}

?>