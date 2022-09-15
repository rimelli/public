<?php 
class Notification {
	private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}

	public function getUnreadNumber() {
		$userLoggedIn = $this->user_obj->getUserId();
		$query = $this->con->prepare("SELECT * FROM notifications WHERE viewed='no' AND user_to=?");
		$query->execute([$userLoggedIn]);
		return $query->rowCount();
	}


	public function getNotifications($data, $limit) {

		$page = $data['page'];
		$userLoggedIn = $this->user_obj->getUserId();
		$return_string = "";

		if($page == 1)
			$start = 0;
		else
			$start = ($page - 1) * $limit;

		$set_viewed_query = $this->con->prepare("UPDATE notifications SET viewed='yes' WHERE user_to=?");
		$set_viewed_query->execute([$userLoggedIn]);


		$query = $this->con->prepare("SELECT * FROM notifications WHERE user_to=? ORDER BY id DESC");
		$query->execute([$userLoggedIn]);

		if($query->rowCount() == 0) {
			echo "You have no notifications!";
			return;
		}

		$num_iterations = 0; //Number of messages checked
		$count = 1; //Number of messages posted

		while($row = $query->fetch()) {

			if($num_iterations++ < $start)
				continue;

			if($count > $limit)
				break;
			else
				$count++;


			$user_from = $row['user_from'];

			$user_data_query = $this->con->prepare("SELECT * FROM users WHERE user_id=?");
			$user_data_query->execute([$user_from]);
			$user_data = $user_data_query->fetch();


			//Timeframe
			$date_time_now = date("Y-m-d H:i:s");
			$start_date = new DateTime($row['datetime']); //Time of post
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


			$opened = $row['opened'];
			$style = (isset($row['opened']) && $row['opened'] == 'no') ? "background-color: #DDEDFF;" : "";


			$return_string .= "<li class='notifications-not-read'>
									<a href='" . $row['link'] . "'>
									<span class='notification-avatar'><img src='" . $user_data['profile_pic'] . "'></span>
									<span class='notification-text'>
										<p>" . $time_message . "</p>" . $row['message'] . "
									</span>
									</a>
								</li>";
		}


		//If posts were loaded
		if($count > $limit)
			$return_string .= "<input type='hidden' class='nextPageDropdownData' value='" . ($page + 1) . "'><input type='hidden' class='noMoreDropdownData' value='false'>";
		else
			$return_string .= "<input type='hidden' class='noMoreDropdownData' value='true'> <p style='text-align: center;'>No more notifications to load!</p>";

		return $return_string;
	}

	public function insertNotification($post_id, $user_to, $type) {

		$userLoggedIn = $this->user_obj->getUserId();
		$userLoggedInName = $this->user_obj->getFirstAndLastName();

		$date_time = date("Y-m-d H:i:s");

		switch($type) {
			case 'comment':
				$message = $userLoggedInName . " commented on your post";
				break;
			case 'like':
				$message = $userLoggedInName . " liked your post";
				break;
			case 'profile_post':
				$message = $userLoggedInName . " posted on your profile";
				break;
			case 'comment_non_owner':
				$message = $userLoggedInName . " commented on a post you commented on";
				break;
			case 'profile_comment':
				$message = $userLoggedInName . " commented on your profile post";
				break;
		}

		$link = "post.php?id=" . $post_id;

		$insert_query = $this->con->prepare("INSERT INTO notifications VALUES(NULL, ?, ?, ?, ?, ?, 'no', 'no')");
		$insert_query->execute([$user_to, $userLoggedIn, $message, $link, $date_time]);
	}

	public function getNotificationsPage($data, $limit) {

		$page = $data['page'];
		$userLoggedIn = $this->user_obj->getUserId();
		$return_string = "";

		if($page == 1)
			$start = 0;
		else
			$start = ($page - 1) * $limit;

		$set_viewed_query = $this->con->prepare("UPDATE notifications SET viewed='yes' WHERE user_to=?");
		$set_viewed_query->execute([$userLoggedIn]);


		$query = $this->con->prepare("SELECT * FROM notifications WHERE user_to=? ORDER BY id DESC");
		$query->execute([$userLoggedIn]);

		if($query->rowCount() == 0) {
			echo "You have no notifications!";
			return;
		}

		$num_iterations = 0; //Number of messages checked
		$count = 1; //Number of messages posted

		while($row = $query->fetch()) {

			if($num_iterations++ < $start)
				continue;

			if($count > $limit)
				break;
			else
				$count++;


			$user_from = $row['user_from'];

			$user_data_query = $this->con->prepare("SELECT * FROM users WHERE user_id=?");
			$user_data_query->execute([$user_from]);
			$user_data = $user_data_query->fetch();


			//Timeframe
			$date_time_now = date("Y-m-d H:i:s");
			$start_date = new DateTime($row['datetime']); //Time of post
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
					$time_message = $interval->m . " month ago";
				}
				else {
					$time_message = $interval->m . " months ago";
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


			$opened = $row['opened'];
			$style = (isset($row['opened']) && $row['opened'] == 'no') ? "background-color: #DDEDFF;" : "";


			$return_string .= "<li>
									<a href='" . $row['link'] . "'>
									<span class='notification-icon'><img src='" . $user_data['profile_pic'] . "'></span>
									<span class='notification-text'>
										" . $row['message'] . "
									</span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
									$time_message
									</a>
								</li>";
		}


		//If posts were loaded
		if($count > $limit)
			$return_string .= "<input type='hidden' class='nextPageDropdownData' value='" . ($page + 1) . "'><input type='hidden' class='noMoreDropdownData' value='false'>";
		else
			$return_string .= "<input type='hidden' class='noMoreDropdownData' value='true'> <p style='text-align: center;'>No more notifications to load!</p>";

		return $return_string;
	}


}

?>