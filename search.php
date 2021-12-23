<?php 
include("includes/header.php");

if(isset($_GET['q'])) {
	$query = $_GET['q'];
}
else {
	$query = "";
}

if(isset($_GET['type'])) {
	$type = $_GET['type'];
}
else {
	$type = "name";
}

?>


<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>TRYOUTS</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/colors/blue.css">

</head>
<body class="gray">



	<div class="container-fluid">
		<div class="row" id="profile_details">
			<div class="main_column column" id="main_column">

	<?php 
	if($query == "")
		echo "You must enter something in the search box.";
	else {



		//If query contains an underscore, assume user is searching for username
		if($type == "username")
			$usersReturnedQuery = $con->query("SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");

		//If there are two words, assume they are first and last names respectively
		else {

			$names = explode(" ", $query);

			if(count($names) == 3)
				$usersReturnedQuery = $con->query("SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[2]%') AND user_closed='no'");
			//If query has one word only, search first names or last names
			else if(count($names) == 2)
				$usersReturnedQuery = $con->query("SELECT * FROM users WHERE (first_name LIKE '$names[0]%' AND last_name LIKE '$names[1]%') AND user_closed='no'");
			else 
				$usersReturnedQuery = $con->query("SELECT * FROM users WHERE (first_name LIKE '$names[0]%' OR last_name LIKE '$names[0]%') AND user_closed='no'");

		}

		//Check if results were found
		if ($usersReturnedQuery->rowCount() == 0)
			echo "We can't find anyone with a " . $type . " like: " .$query;
		else
			echo $usersReturnedQuery->rowCount() . " results found: <br> </br>";


		echo "<p id='grey'>Try searching for:</p>";
		echo "<a href='search.php?q=" . $query ."&type=name'>Names</a>, <a href='search.php?q=" . $query ."&type=username'>Usernames</a><br><br><hr id='search_hr'>";

		while($row = $usersReturnedQuery->fetch()) {
			$user_obj = new User($con, $user['username']);

			$button = "";

			if($user['username'] != $row['username']) {

				//Generate button depending on following status
				if($user_obj->isFollowing($row['username']))
					$button = "<input type='submit' name='" . $row['username'] . "' class='danger' value='Unfollow'>";
				else
					$button = "<input type='submit' name='" . $row['username'] . "' class='success' value='Follow'>";


				//Button forms
				if(isset($_POST[$row['username']])) {

					if($user_obj->isFollowing($row['username'])) {
						$user_obj->removeFollowing($row['username']);
						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					}
					else {
						$user_obj->sendFollow($row['username']);
						header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
					}

				}


			}

			echo "<div class='search_result'>
					<div class='searchPageFriendButtons'>
						<form action='' method='POST'>
							" . $button . "
							<br>
					</div>


					<div class='result_profile_pic'>
						<a href='" . $row['username'] ."'><img src='" . $row['profile_pic'] ."' style='height: 100px;'></a>
					</div>

						<a href='" . $row['username'] ."'> " . $row['first_name'] . " " . $row['last_name'] . "
						<p id-'grey'> " . $row['username'] ."</p>
						</a>
						<br>


				</div>
				<hr id='search_hr'>";

		} //End while
	}


	?>


	
</div>

</div>
</div>


</body>
</html>