<?php
require 'config/config.php';
include("includes/classes/User.php");

$user = new User($con, $_POST['currentUser']);
$updatedUserConnects = [];

$userConnects = $user->getUserConnects($_POST['currentUser']);
foreach ($userConnects as $u) {
    $u = new User($con, $u['connected_user']);
    $updatedUserConnects[] = array(
        'userId' => $u->getUserId(),
        'lastMessageInfo' => $u->getLastMessageInfo($_POST['currentUser']),
        'firstAndLastName' => $u->getFirstAndLastName(),
        'profilePic' => $u->getProfilePic()
    );
}

echo json_encode($updatedUserConnects);