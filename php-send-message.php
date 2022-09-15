<?php
require 'config/config.php';
require __DIR__ . '/vendor/autoload.php';

// get the input
$name = trim(htmlspecialchars($_POST['name'] ?? ''));
$message = trim(htmlspecialchars($_POST['message'] ?? ''));
$message_box = trim(htmlspecialchars($_POST['message_box'] ?? ''));
$userfrom = trim(htmlspecialchars($_POST['userfrom'] ?? ''));
$pagefrom = trim(htmlspecialchars($_POST['pagefrom'] ?? ''));

$id_query = $con->prepare("SELECT user_id FROM users WHERE username=?");
$id_query->execute([$name]);
$id_to_user = $id_query->fetchColumn();

if (!$name || !$message || !$userfrom)
	die;

// insert data into the database
$stmt = $con->prepare('INSERT INTO messages (user_to, user_from, body, sent_on, opened, viewed, deleted) VALUES (?,?,?,?,?,?,?)');
$date_sent = date("Y-m-d H:i:s");
$stmt->execute([$id_to_user, $userfrom, $message, $date_sent, 'no', 'no', 'no']);

$options = array(
    'cluster' => $cluster,
    'encrypted' => true
);


$pusher = new Pusher\Pusher(
    $auth_key,
    $secret,
    $app_id,
    $options
);

if (!empty($message)) {
    $data = array(
        'message' => $message,
        'message_box' => $message_box,
        'user_from' => $userfrom,
    );
    if ($pusher->trigger($chanel_name, 'message_sent', $data)) {
        if(isset($pagefrom) && $pagefrom === 'profile')
            header('Location: profile.php?type=success&message=Message sent successfully.&profile_username='.$name);
    } else {
        if(isset($pagefrom) && $pagefrom === 'profile')
            header('Location: profile.php?type=error&message=Message was not send.&profile_username='.$name);
    }
}
