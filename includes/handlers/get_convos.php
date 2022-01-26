<?php
 
include '../../config/config.php';
include '../classes/User.php';
include '../classes/Message.php';
 
		$userLoggedIn = $_POST['me'];
 
		$return_string = "";
		$convos = array();
 
		$query = $con->prepare("SELECT * FROM messages WHERE user_to=? OR user_from=? ORDER BY id DESC");
		$query->execute([$userLoggedIn, $userLoggedIn]);
 
		while($row = $query->fetch()) {
 
			$user_to_push = ($row['user_to'] != $userLoggedIn) ? $row['user_to'] : $row['user_from'];
 
			if(!in_array($user_to_push, $convos)) 
				array_push($convos, $user_to_push);
		}
 
		foreach($convos as $username) {
 
			$is_unread_query = $con->prepare("SELECT * FROM messages WHERE (user_to=? AND user_from=?) OR (user_from=? AND user_to=?) ORDER BY id DESC");
			$is_unread_query->execute([$userLoggedIn, $username, $userLoggedIn, $username]);
			$row = $is_unread_query->fetch();
			$style = ($row['opened'] == 'no') ? "background-color: #DDEDFF" : "";
 
			$user_found_obj = new User($con, $username);
 
			$details = new Message($con, $userLoggedIn);
			$latest_message_details = $details->getLatestMessage($userLoggedIn, $username);
			
 
			$dots = (strlen($latest_message_details[1]) >= 12) ? "..." : "";
			$split = str_split($latest_message_details[1], 12);
			$split = $split[0] . $dots;
 
			if($row['opened'] === 'yes' && $row['user_from'] === $userLoggedIn && $row['user_to'] === $username) {
 
				$latest_message_details[2] .= " <b>✓</b>";
			}
 
			if ($row['opened'] === 'no' && $row['user_from'] === $userLoggedIn && $row['user_to'] === $username) {
 
				$style = "";
				$latest_message_details[2] .= " <b>←</b>";
			}
 
			if($row['opened'] === 'no' && $row['user_to'] === $userLoggedIn && $row['user_from'] === $username) {
 
				$style = "background-color: #DDEDFF";
			}
 
			if(strpos($latest_message_details[1], "http://") !== false) {
 
				$return_string .= "<li><a href='messages.php?u=$username'> <div class='message-avatar'>
								<i class='status-icon status-online'></i><img src='" . $user_found_obj->getProfilePic() . "'></div>
								<div class='message-by'><div class='message-by-headline'><h5>" . $user_found_obj->getFirstAndLastName() . "</h5><span class='timestamp_smaller' id='grey'> " . $latest_message_details[2] . "</span></div>
								<p id='grey' style='margin: 0;'>" . $latest_message_details[0] . $split . " </p>
								</div>
								</a></li>";
			}
 
			
			else  {
				$return_string .= "<li><a href='messages.php?u=$username'> <div class='message-avatar'>
								<i class='status-icon status-online'></i><img src='" . $user_found_obj->getProfilePic() . "'></div>
								<div class='message-by'><div class='message-by-headline'><h5>" . $user_found_obj->getFirstAndLastName() . "</h5><span class='timestamp_smaller' id='grey'> " . $latest_message_details[2] . "</span></div>
								<p id='grey' style='margin: 0;'>" . $latest_message_details[0] . $split . " </p>
								</div>
								</a></li>";
			}
			
		}
 
		echo $return_string;


		