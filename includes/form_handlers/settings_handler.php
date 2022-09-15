<?php


if(isset($_POST['delete_prof_img'])) {

	$query = $con->prepare("UPDATE users SET profile_pic='assets/images/profile_pics/defaults/profileimg.png' WHERE user_id=?");
	$query->execute([$userLoggedIn]);
	header("Location: settings.php");
}


//******************************************

//******************************************


if(isset($_POST['add_team'])) {

	$team_name = strip_tags($_POST['team_name']);

	$query = $con->prepare("INSERT INTO teams VALUES (NULL, ?, ?, ?)");
	$query->execute([$userLoggedIn, $team_name, 'no']);

	echo "Team Added!";

}
else
	echo "";


//******************************************


if(isset($_POST['remove_team'])) {

	$team_id = strip_tags($_POST['team_id']);

	$query = $con->prepare("UPDATE teams SET team_deleted=? WHERE team_id=? AND user_id=?");
	$query->execute(['yes', $team_id, $userLoggedIn]);

	echo "Team Removed!";

}
else
	echo "";


//******************************************


if(isset($_POST['add_player'])) {

	$player_name = strip_tags($_POST['player_name']);
	$player_position = strip_tags($_POST['player_position']);
	$team_id = strip_tags($_POST['team_id']);
	if (explode('@', $player_name)) {
		$player_explode = explode('@', $player_name);
		$player_name = trim($player_explode[0]);
		$names_explode = explode(' ', $player_name);
		$first_name = trim($names_explode[0]);
		$last_name = trim($names_explode[1]);
		$username = trim($player_explode[1]);
	} else {
		$username = $player_name;
	}

	$check = $con->prepare("SELECT user_id FROM users WHERE username=? AND first_name=? AND last_name=?");
	$check->execute([$username, $first_name, $last_name]);
	$row = $check->fetchColumn();
	if ($row) {
		$player_id = $row;
	} else {
		$player_id = $userLoggedIn;
	}
	
	$query = $con->prepare("INSERT INTO team_players VALUES (NULL, ?, ?, ?, ?, ?)");
	$query->execute([$team_id, $player_id, $player_name, $player_position, 'no']);

	echo "Player Added!";

}
else
	echo "";


//******************************************


if(isset($_POST['remove_player'])) {

	$team_id = strip_tags($_POST['team_id']);
	$player_id = strip_tags($_POST['player_id']);

	$query = $con->prepare("UPDATE team_players SET player_deleted=? WHERE team_id=? AND id=?");
	$query->execute(['yes', $team_id, $player_id]);

	echo "Player Removed!";

}
else
	echo "";



//******************************************


if(isset($_POST['add_fixture'])) {

	$home_away = strip_tags($_POST['home_away']);
	$team_id = strip_tags($_POST['team_id']);
	$fixture_date = strip_tags($_POST['fixture_date']);
	$other_team = strip_tags($_POST['other_team']);

	if (explode('@', $other_team)) {
		$explode = explode('@', $other_team);
		$other_team = trim($explode[0]);
		$names_explode = explode(' ', $other_team);
		$first_name = trim($names_explode[0]);
		$last_name = trim($names_explode[1]);
		$username = trim($explode[1]);
	} else {
		$username = $other_team;
	}

	$check = $con->prepare("SELECT user_id FROM users WHERE username=? AND first_name=? AND last_name=?");
	$check->execute([$username, $first_name, $last_name]);
	$row = $check->fetchColumn();
	if ($row) {
		$other_team_id = $row;
	} else {
		$other_team_id = $userLoggedIn;
	}
	
	$query = $con->prepare("INSERT INTO fixtures VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
	$query->execute([$userLoggedIn, $home_away, $team_id, $fixture_date, $other_team, $other_team_id, 'no']);

	echo "Fixture Added!";

}
else
	echo "";


//******************************************


if(isset($_POST['remove_fixture'])) {

	$fixture_id = strip_tags($_POST['fixture_id']);

	$query = $con->prepare("UPDATE fixtures SET fixture_deleted=? WHERE id=? AND user_id=?");
	$query->execute(['yes', $fixture_id, $userLoggedIn]);

	echo "Fixture Removed!";

}
else
	echo "";


if(isset($_POST['close_account'])) {
	header("Location: close_account.php");
}


?>

