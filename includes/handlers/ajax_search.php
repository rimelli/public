<?php 
include("../../config/config.php");
include("../../includes/classes/User.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$names = explode(" ", $query);

//If query contains an underscore, assume user is searching for username
if(strpos($query, '_') !== false)
	$usersReturnedQuery = $con->query("SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");

//If there are two words, assume they are first and last names respectively
else if(count($names) == 2)
	$usersReturnedQuery = $con->query("SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[1]%') AND user_closed='no' LIMIT 8");
//If query has one word only, search first names or last names
else
	$usersReturnedQuery = $con->query("SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%') AND user_closed='no' LIMIT 8");


if($query != "") {

	while($row = $usersReturnedQuery->fetch()) {
		$user = new User($con, $userLoggedIn);


		echo "<div class='header-notifications-content'>
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

	}
}

?>