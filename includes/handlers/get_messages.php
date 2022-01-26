<?php
include '../../config/config.php';
include '../classes/User.php';
 
		$userLoggedIn = $_POST['me'];
		$otherUser = $_POST['friend'];
		
		
		$data = "";
 
		$query = $con->prepare("UPDATE messages SET opened='yes' WHERE user_to=? AND user_from=?");
		$query->execute([$userLoggedIn, $otherUser]);
 
		$get_messages_query = $con->prepare("SELECT messages.*
							  FROM messages
							  JOIN (  
							        SELECT MAX(id) id
							        FROM messages
							        WHERE (user_to=? AND user_from=?) OR (user_from=? AND user_to=?)
							        ) x ON messages.id = x.id");
		$get_messages_query->execute([$userLoggedIn, $otherUser, $userLoggedIn, $otherUser]);
 
		
		while($row = $get_messages_query->fetch()) {
 
			$id = $row['id'];
			$user_to = $row['user_to'];
			$body = $row['body'];
			$date = $row['date'];
			$image = $row['image'];
			$friend = new User($con, $otherUser);
			$friend_name = $friend->getFirstName();
			$pic = $friend->getProfilePic();
 
			if($image != "") {
 
				$imageDiv = "<div class='postedImage'>
								<img src='$image'>
							</div>";
			}
 
			else {
 
				$imageDiv = "";
			}
 
			
			
			$info = ($user_to === $userLoggedIn) ? $friend_name . " on " . date("M d Y H:i", strtotime($date)) : 
													"You" .  " on " . date("M d Y H:i", strtotime($date));
 
 
			$div_top = ($user_to === $userLoggedIn) ? "<div class='message-bubble'><div class='message-bubble-inner'><div class='message-avatar'><img src='assets/images/profile_pics/defaults/default_profile_pic.svg'></div><div class='message-text'>" : "<div class='message-bubble me'><div class='message-bubble-inner'><div class='message-avatar'><img src='" . $this->user_obj->getProfilePic() . "'></div><div class='message-text'>";
 
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
 
			
			$data = $data . $div_top . "<span>" . $info . "</span>" . nl2br($body) . $imageDiv . "</div><br><br>";
			
		}
	
			if($data !== "")
				echo "<div id='$id'>" . $data . "</div><div class='checkSeen'></div>";

