<?php

class User {
	private $user;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$user_details_query = $con->prepare("SELECT * FROM users WHERE user_id=?");
		$user_details_query->execute([$user]);
		$this->user = $user_details_query->fetch();
	}

	public function getUserId() {
		return $this->user['user_id'];
	}

	public function getUsername() {
		return $this->user['username'];
	}

	public function getNumPosts() {
		$user_id = $this->user['user_id'];
		$query = $this->con->prepare("SELECT num_posts FROM users WHERE user_id=?");
		$query->execute([$user_id]);
		$row = $query->fetch();
		return $row['num_posts'];
	}

	public function getFirstAndLastName() {
		$user_id = $this->user['user_id'];
		$query = $this->con->prepare("SELECT first_name, last_name FROM users WHERE user_id=?");
		$query->execute([$user_id]);
		$row = $query->fetch();
		return $row['first_name'] . " " . $row['last_name'];
	}

	public function getFirstName() { 
    	return $this->user['first_name'];
	}

	public function getProfilePic() {
		$user_id = $this->user['user_id'];
		$query = $this->con->prepare("SELECT profile_pic FROM users WHERE user_id=?");
		$query->execute([$user_id]);
		$row = $query->fetch();
		return $row['profile_pic'];
	}

	public function isClosed() {
		$user_id = $this->user['user_id'];
		$query = $this->con->prepare("SELECT user_closed FROM users WHERE user_id=?");
		$query->execute([$user_id]);
		$row = $query->fetch();

		if($row['user_closed'] =='yes')
			return true;
		else
			return false;
	}

	public function isVerified() {
		$user_id = $this->user['user_id'];
		$query = $this->con->prepare("SELECT verified FROM users WHERE user_id=?");
		$query->execute([$user_id]);
		$row = $query->fetch();

		if($row['verified'] =='yes')
			return true;
		else
			return false;
	}



}

 ?>