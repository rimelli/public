<?php 
class Message {
	private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}

	public function getMostRecentUser() {
		$userLoggedIn = $this->user_obj->getUserId();

		$query = $this->con->prepare("SELECT user_to, user_from FROM messages WHERE user_to=? OR user_from=? ORDER BY id DESC LIMIT 1");
		$query->execute([$userLoggedIn, $userLoggedIn]);

		if($query->rowCount() == 0)
			return false;

		$row = $query->fetch();
		$user_to = $row['user_to'];
		$user_from = $row['user_from'];

		if($user_to != $userLoggedIn)
			return $user_to;
		else
			return $user_from;
	}

	public function sendMessage($user_to, $body, $date) {
		if($body !== "") {
			$userLoggedIn = $this->user_obj->getUserId();
			$query = $this->con->prepare('INSERT INTO messages (user_to, user_from, body, sent_on, opened, viewed, deleted) VALUES (?,?,?,?,?,?,?)');
            $query->execute([$user_to, $userLoggedIn, $body, $date, 'no', 'no', 'no']);
        }
	}

	public function getMessages($otherUser) {
		$userLoggedIn = $this->user_obj->getUserId();
		$data = "";

		$query = $this->con->prepare("UPDATE messages SET opened='yes' WHERE user_to=? AND user_from=?");
		$query->execute([$userLoggedIn, $otherUser]);

		$get_messages_query = $this->con->prepare("SELECT * FROM messages WHERE (user_to=? AND user_from=?) OR (user_from=? AND user_to=?)");
		$get_messages_query->execute([$userLoggedIn, $otherUser, $userLoggedIn, $otherUser]);

		while($row = $get_messages_query->fetch()) {
			$id = $row['id'];
			$user_to = $row['user_to'];
			$user_from = $row['user_from'];
			$body = $row['body'];
			$date = $row['date'];

			$info = ($user_to === $userLoggedIn) ? $user_to . " on " . date("M d Y H:i", strtotime($date)) : 
													"You" .  " on " . date("M d Y H:i", strtotime($date));

			$div_top = ($user_to == $userLoggedIn) ? "<div class='message-bubble'><div class='message-bubble-inner'><div class='message-avatar'><img src='assets/images/profile_pics/defaults/default_profile_pic.svg'></div><div class='message-text'>" : "<div class='message-bubble me'><div class='message-bubble-inner'><div class='message-avatar'><img src='assets/images/profile_pics/defaults/profileimg.png'></div><div class='message-text'>";

			$body_array = preg_split("/\s+/", $body);
 
 
			foreach($body_array as $key => $value) {
 
				if(strpos($value, "www.youtube.com/watch?v=") !== false) {
 
					$link = preg_split("!&!", $value);
					$value = preg_replace("!watch\?v=!", "embed/", $link[0]);
					$value = "<p><iframe width='400' height='300' src='" . $value . "'></iframe></p>";
					$body_array[$key] = $value;
 
					$body = implode(" ", $body_array);
 
				}
				
			}

			$data = $data . $div_top . $body . "</div>$info</div></div><p></p><br><br>";
		}
		return $data;
	}


	public function getLatestMessage($userLoggedIn, $user2) {
		$details_array = array();

		$query = $this->con->prepare("SELECT body, user_to, date FROM messages WHERE (user_to=? AND user_from=?) OR (user_to=? AND user_from=?) ORDER BY id DESC LIMIT 1");
		$query->execute([$userLoggedIn, $user2, $user2, $userLoggedIn]);

		$row = $query->fetch();
		$sent_by = ($row['user_to'] == $userLoggedIn) ? "They said: " : "You said: ";

		//Timeframe
		$date_time_now = date("Y-m-d H:i:s");
		$start_date = new DateTime($row['date']); //Time of post
		$end_date = new DateTime($date_time_now); //Current time
		$interval = $start_date->diff($end_date); //Difference between dates

		if($interval->y >= 1) {
			if($interval == 1)
				$time_message = $interval->y . " year ago"; //1 year ago
			else
				$time_message = $interval->y . " years ago"; //1+ year ago
		}
		elseif ($interval-> m >= 1) {
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
				$time_message = $interval->m . " month". $days;
			}
			else {
				$time_message = $interval->m . " months". $days;
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
		else if($interval->h >= 1) {
			if($interval->h == 1) {
				$time_message = $interval->h . " hour ago";
			}
			else {
				$time_message = $interval->h . " hours ago";
			}
		}
		else if($interval->i >= 1) {
			if($interval->i == 1) {
				$time_message = $interval->i . " minute ago";
			}
			else {
				$time_message = $interval->i . " minutes ago";
			}
		}
		else {
			if($interval->s < 30) {
				$time_message = "Just now";
			}
			else {
				$time_message = $interval->s . " seconds ago";
			}
		}

		if(strpos($row['body'], "www.youtube.com") !== false) {
 
			$sent_by = ($row['user_to'] === $userLoggedIn) ? "They" : "You";
 
			$row['body'] = " sent a clip";
		}
 
		if(strpos($row['body'], "https://") !== false && strpos($row['body'], "www.youtube.com") === false) {
 
			$sent_by = ($row['user_to'] === $userLoggedIn) ? "They" : "You";
 
			$row['body'] = " sent a link";
		}

		array_push($details_array, $sent_by);
		array_push($details_array, $row['body']);
		array_push($details_array, $time_message);

		return $details_array;
	}

	public function getConvos() {
		$userLoggedIn = $this->user_obj->getUserId();
		$return_string = "";
		$convos = array();

		$query = $this->con->prepare("SELECT user_to, user_from FROM messages WHERE user_to=? OR user_from=? ORDER BY id DESC");
		$query->execute([$userLoggedIn, $userLoggedIn]);

		while ($row = $query->fetch()) {
			$user_to_push = ($row['user_to'] != $userLoggedIn) ? $row['user_to'] : $row['user_from'];

			if(!in_array($user_to_push, $convos)) {
				array_push($convos, $user_to_push);
			}
		}

		foreach($convos as $username) {

			$is_unread_query = $this->con->prepare("SELECT * FROM messages WHERE (user_to=? AND user_from=?) OR (user_from=? AND user_to=?) ORDER BY id DESC");
			$is_unread_query->execute([$userLoggedIn, $username, $userLoggedIn, $username]);
			$row = $is_unread_query->fetch();
			$style = ($row['opened'] == 'no') ? "background-color: #DDEDFF" : "";

			$user_found_obj = new User($this->con, $username);

			$details = new Message($this->con, $userLoggedIn);
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
								<i class='status-icon status-online'></i><img src='assets/images/profile_pics/defaults/profileimg.png'></div>
								<div class='message-by'><div class='message-by-headline'><h5>" . $user_found_obj->getFirstAndLastName() . "</h5><span class='timestamp_smaller' id='grey'> " . $latest_message_details[2] . "</span></div>
								<p id='grey' style='margin: 0;'>" . $latest_message_details[0] . $split . " </p>
								</div>
								</a></li>";

			} 
 
			else {
				
				$return_string .= "<li><a href='messages.php?u=$username'> <div class='message-avatar'>
								<i class='status-icon status-online'></i><img src='assets/images/profile_pics/defaults/profileimg.png'></div>
								<div class='message-by'><div class='message-by-headline'><h5>" . $user_found_obj->getFirstAndLastName() . "</h5><span class='timestamp_smaller' id='grey'> " . $latest_message_details[2] . "</span></div>
								<p id='grey' style='margin: 0;'>" . $latest_message_details[0] . $split . " </p>
								</div>
								</a></li>";
			}
		}

		return $return_string;

	}

	public function getConvosDropdown($data, $limit) {

		$page = $data['page'];
		$userLoggedIn = $this->user_obj->getUserId();
		$return_string = "";
		$convos = array();

		if($page == 1)
			$start = 0;
		else
			$start = ($page - 1) * $limit;

		$set_viewed_query = $this->con->prepare("UPDATE messages SET viewed='yes' WHERE user_to=?");
		$set_viewed_query->execute([$userLoggedIn]);


		$query = $this->con->prepare("SELECT user_to, user_from FROM messages WHERE user_to=? OR user_from=? ORDER BY id DESC");
		$query->execute([$userLoggedIn, $userLoggedIn]);

		while ($row = $query->fetch()) {
			$user_to_push = ($row['user_to'] != $userLoggedIn) ? $row['user_to'] : $row['user_from'];

			if(!in_array($user_to_push, $convos)) {
				array_push($convos, $user_to_push);
			}
		}

		$num_iterations = 0; //Number of messages checked
		$count = 1; //Number of messages posted

		foreach($convos as $username) {

			if($num_iterations++ < $start)
				continue;

			if($count > $limit)
				break;
			else
				$count++;


			$is_unread_query = $this->con->prepare("SELECT opened FROM messages WHERE user_to=? AND user_from=? ORDER BY id DESC");
			$is_unread_query->execute([$userLoggedIn, $username]);
			$row = $is_unread_query->fetch();
			$style = (isset($row['opened']) && $row['opened'] == 'no') ? "background-color: #DDEDFF;" : "";


			$user_found_obj = new User($this->con, $username);
			$latest_message_details = $this->getLatestMessage($userLoggedIn, $username);

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

			if(strpos($latest_message_details[1], "http://") !== false) {

				$return_string .= "<li class='notifications-not-read'>
									<a href='messages.php?u=$username'>
										<span class='notification-avatar status-offline'><img src='" . $user_found_obj->getProfilePic() . "'></span>
										<div class='notification-text'>
											<strong>" . $user_found_obj->getFirstAndLastName() . "</strong><br>
											<p class='notification-msg-text'>" . $latest_message_details[0] . $split . " </p><br>
											<span class='color'> " . $latest_message_details[2] . "</span>
										</div>
									</a>
								</li>";
			}

			else {
				$return_string .= "<li class='notifications-not-read'>
									<a href='messages.php?u=$username'>
										<span class='notification-avatar status-offline'><img src='" . $user_found_obj->getProfilePic() . "'></span>
										<div class='notification-text'>
											<strong>" . $user_found_obj->getFirstAndLastName() . "</strong><br>
											<p class='notification-msg-text'>" . $latest_message_details[0] . $split . " </p><br>
											<span class='color'> " . $latest_message_details[2] . "</span>
										</div>
									</a>
								</li>";
				}
				
			}


		//If posts were loaded
		if($count > $limit)
			$return_string .= "<input type='hidden' class='nextPageDropdownData' value='" . ($page + 1) . "'><input type='hidden' class='noMoreDropdownData' value='false'>";
		else
			$return_string .= "<input type='hidden' class='noMoreDropdownData' value='true'> <p style='text-align: center;'>No more messages to load!</p>";

		return $return_string;
	}

	public function getUnreadNumber() {
		$userLoggedIn = $this->user_obj->getUserId();
		$query = $this->con->prepare("SELECT * FROM messages WHERE viewed='no' AND user_to=?");
		$query->execute([$userLoggedIn]);
		return $query->rowCount();
	}
}

 ?>