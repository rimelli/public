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

	public function getLastMessageInfo($userLoggedIn): array
    {
        $user_id = $this->user['user_id'];
        $query = $this->con->prepare("SELECT * FROM messages WHERE (user_to=? AND user_from=?) OR (user_from=? AND user_to=?) ORDER BY sent_on DESC LIMIT 1");
        $query->execute([$userLoggedIn, $user_id, $userLoggedIn, $user_id]);
        $row = $query->fetch();
        $now = new DateTime();
        $sent_on = new DateTime($row['sent_on']);
        $interval = $sent_on->diff($now);

        switch ($interval) {
            case $interval->y !== 0:
                $sent_on = $interval->y.' years';
                break;
            case $interval->m !== 0:
                $sent_on = $interval->m.' months';
                break;
            case $interval->d !== 0:
                $sent_on = $interval->d.' days';
                break;
            case $interval->h !== 0:
                $sent_on = $interval->h.' hours';
                break;
            case $interval->i !== 0:
                $sent_on = $interval->i.' minutes';
                break;
            case $interval->s !== 0:
                $sent_on = $interval->s.' seconds';
                break;
            default:
                $sent_on = '1 seconds';
        }
        return array(
            'body' => $row['body'],
            'sent_on' => $sent_on
        );
	}

    public function getUserConnects($currentUser): array
    {
        $connected_users_id_arr = [];
        $connected_users_arr = [];
        $user_to_query = $this->con->prepare("SELECT distinct user_to as connected_user FROM messages WHERE user_from=?");
        $user_to_query->execute([$currentUser]);

        foreach ($user_to_query->fetchAll() as $row)
        {
            $connected_users_id_arr[] = $row['connected_user'];
        }
        $user_from_query = $this->con->prepare("SELECT distinct user_from as connected_user FROM messages WHERE user_to=?");
        $user_from_query->execute([$currentUser]);

        foreach ($user_from_query->fetchAll() as $row)
        {
            $connected_users_id_arr[] = $row['connected_user'];
        }
        foreach (array_unique($connected_users_id_arr) as $user_id)
        {
            $sent_on_query = $this->con->prepare("SELECT sent_on FROM messages WHERE (user_to=? AND user_from=?) OR (user_from=? AND user_to=?) ORDER BY sent_on DESC LIMIT 1");
            $sent_on_query->execute([$currentUser, $user_id, $currentUser, $user_id]);
            $connected_users_arr[] = array(
                'connected_user' => $user_id,
                'sent_on' => $sent_on_query->fetchObject()->sent_on,
            );
        }

        $sent_on = [];
        foreach ($connected_users_arr as $key => $row)
        {
            $sent_on[$key] = $row['sent_on'];
        }

        array_multisort($sent_on, SORT_DESC, $connected_users_arr);
        return $connected_users_arr;
    }

    public function isOnline() {
        $user_id = $this->user['user_id'];
        $query = $this->con->prepare("SELECT is_online FROM users WHERE user_id=?");
        $query->execute([$user_id]);
        $row = $query->fetch();

        if($row['is_online'])
            return true;
        else
            return false;
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

	public function isFollowing($id_to_check) {
		$user_id = $this->user['user_id'];
		$query = $this->con->prepare("SELECT * FROM user_follow WHERE user_id=? AND following=?");
		$query->execute([$user_id, $id_to_check]);

		if($query->rowCount() > 0)
			return true;
		else
			return false;
	}

	public function removeFollowing($user_to_remove) {
		$user_id = $this->user['user_id'];
		$query = $this->con->prepare("DELETE FROM user_follow WHERE user_id=? AND following=?");
		$query->execute([$user_id, $user_to_remove]);
	}

	public function sendFollow($user_to) {
		$user_id = $this->user['user_id'];
		$query = $this->con->prepare("INSERT INTO user_follow VALUES (NULL, ?, ?)");
		$query->execute([$user_id, $user_to]);
	}



}

 ?>