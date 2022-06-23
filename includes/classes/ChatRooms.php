<?php

/**
 * ChatRooms &mdash;
 * Contains Methods for Handling Chat Messages
 * @author Muhammad Saif
 * @link m.saifmumtaz@gmail.com
 * @copyright 2022 Muhammad Saif
 */
class ChatRooms
{
    private $user_obj;
    private $con;

    /**
     * Construct Function
     *
     * @param mysqli $con
     * @param int|string $user
     */
    public function __construct($con, $user_id)
    {
        $this->con = $con;
        $this->user_obj = new User($con, $user_id);
    }
    
    /**
     * Calculate Time Ago FUnction
     *
     * @param string|timestamp $datetime
     * @param boolean $full
     * @return void
     */
    public function calculateTimeAgo($datetime,$full=false){
        //Timeframe
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';

    }

    public function getUserObject($user_id){
        $user_details_query = $this->con->prepare("SELECT * FROM users WHERE user_id=?");
        $user_details_query->execute([$user_id]);
        $user = $user_details_query->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    /**
     * Search User using First Name, Last Name, Email, Username
     *
     * @param string $search The term you want to search
     * @param boolean $friends_only set true or false if you want to 
     * enable site wise user search or friends only search
     * @return array
     */
    public function searchUser($search,$friends_only=true)
    {
        $user_id=$this->user_obj['user_id'];
        $sql = $this->con->prepare("SELECT * FROM users WHERE first_name LIKE ? OR last_name LIKE ?  OR email LIKE ? OR username LIKE ?");
        $sql->execute(["%$search%", "%$search%", "%strtolower($search)%", "%strtolower($search)%"]);
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($friends_only===true){
            $final_results = [];
            foreach ($results as $r) {
                $sql = $this->con->prepare('SELECT * FROM user_follow WHERE (user_id=? AND following=?) OR (user_id=? AND following=?)');
                $sql->execute([$user_id, $r['user_id'], $r['user_id'], $user_id]);
                $data=$sql->fetch(PDO::FETCH_ASSOC);
                // print_r($data);
                if($data){
                    array_push($final_results,$r);
                }
            }
            return $final_results;
        }else{
            return $results;
        }

    }

    public function createRoom($group_slug,$e2e_key,$group_name='',$group_type='private',$group_avater=''){
        $query=$this->con->prepare('INSERT into groups (group_slug,group_name,group_type,e2e_key,group_avater) VALUES (?,?,?,?,?)');
        $data=[$group_slug,$group_name,$group_type,$e2e_key,$group_avater];
        $r=$query->execute($data);
        $id=$this->con->lastInsertId();
        if($r){
            return $id;
        }else{
            return false;
        }
    }

    public function getUsersRooms($user_id){
        $query='SELECT * FROM groups LEFT JOIN group_users ON groups.group_id=group_users.group_id WHERE group_users.user_id=?';
        $pdo=$this->con->prepare($query);
        $pdo->execute([$user_id]);

        $results=$pdo->fetchAll(PDO::FETCH_ASSOC);
        if($results){
            return $results;
        }else{
            return false;
        }
    }
    public function addUsertoRoom($group_id,$user_id){

        $query='INSERT INTO group_users (user_id,group_id) VALUES (?,?)';
        $pdo=$this->con->prepare($query);
        if($pdo->execute([$user_id,$group_id])){
            return true;
        }else{
            return false;
        }

    }

    public function deleteRoom($group_slug){
        $query='UPDATE groups SET status=? WHERE group_slug=?';
        $pdo=$this->con->prepare($query);
        if($pdo->execute(['deleted',$group_slug])){
            return true;
        }else{
            return false;
        }
    }

    public function sendMessage($message, $group_id,$user_id,$image=null){
        $query='INSERT INTO messages (body,group_id,user_id,image) VALUES (?,?,?,?)';
        $pdo=$this->con->prepare($query);
        $data=[$message,$group_id,$user_id,$image];

        if($pdo->execute($data)){
            return true;
        }else{
            return false;
        }
    }
    
    public function checkPrivateChatRoom($user_id1,$user_id2){
        $query='SELECT * FROM  groups LEFT JOIN group_users ON group_users.group_id=groups.group_id WHERE groups.group_type=? AND (group_users.user_id=? AND groups.group_id IN (SELECT group_id FROM group_users WHERE user_id=?))';
        // $query='SELECT * FROM  group_users GROUP BY group_id HAVING COUNT(user_id)<2';
        $pdo=$this->con->prepare($query);
        $data=['private',$user_id1,$user_id2];
        $pdo->execute($data);
        $results=$pdo->fetch(PDO::FETCH_ASSOC);
        if($results){
            return $results;
        }else{
            return false;
        }
    }

    public function getChatMessages($conversation_id){
        $query='SELECT * FROM messages LEFT JOIN groups ON messages.group_id=groups.group_id WHERE groups.group_slug=? ORDER BY date';
        $pdo=$this->con->prepare($query);
        $pdo->execute([$conversation_id]);
        $results=$pdo->fetchAll(PDO::FETCH_ASSOC);
        if($results){
            return $results;
        }else{
            return false;
        }
    }

    public function getChatRooms($user_id){
        $query='SELECT * FROM groups LEFT JOIN group_users ON groups.group_id=group_users.group_id WHERE group_users.user_id=?';
        $pdo=$this->con->prepare($query);
        $pdo->execute([$user_id]);
        $results=$pdo->fetchAll(PDO::FETCH_ASSOC);
        if($results){
            return $results;
        }else{
            return false;
        }
    }

    public function getChatUserProfile($group_id,$logged_user_id){
        $query='SELECT users.user_id,users.first_name,users.last_name,users.email,users.username,users.profile_pic,users.connection_id FROM group_users LEFT JOIN users ON group_users.user_id=users.user_id WHERE group_users.group_id=? AND group_users.user_id != ?';
        $pdo=$this->con->prepare($query);
        $pdo->execute([$group_id,$logged_user_id]);
        $results=$pdo->fetch(PDO::FETCH_ASSOC);
        if($results){
            return $results;
        }else{
            return false;
        }
    }

    public function getLastGroupMessage($group_id){
        $query='SELECT * FROM messages WHERE group_id=? ORDER BY id DESC LIMIT 1';
        $pdo=$this->con->prepare($query);
        $pdo->execute([$group_id]);
        $results=$pdo->fetch(PDO::FETCH_ASSOC);
        if($results){
            return $results;
        }else{
            return false;
        }
    }

    public function getChatRoomInfo($group_slug){
        $query='SELECT * FROM groups WHERE group_slug=?';
        $pdo=$this->con->prepare($query);
        $pdo->execute([$group_slug]);
        $results=$pdo->fetch(PDO::FETCH_ASSOC);
        if($results){
            return $results;
        }else{
            return false;
        }
    }

    public function getChatKey($group_id){
        $query='SELECT e2e_key FROM groups WHERE group_id=?';
        $pdo=$this->con->prepare($query);
        $pdo->execute([$group_id]);
        $results=$pdo->fetch(PDO::FETCH_ASSOC);
        if($results){
            return $results;
        }else{
            return false;
        }
    }
}
