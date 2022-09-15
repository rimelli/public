<?php
require 'config/config.php';
include("includes/classes/User.php");

$onlineUsers = [];

if(isset($_POST['connectedUsers']))
    foreach ($_POST['connectedUsers'] as $user_id) {
        $user = new User($con, $user_id);
        $onlineUsers[] =array(
            'user_id' => $user_id,
            'is_online' => $user->isOnline()
        );
    }

echo json_encode($onlineUsers);