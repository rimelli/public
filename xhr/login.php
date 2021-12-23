<?php
require '../config/config.php';

$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //Sanitize email

$_SESSION['log_email'] = $email; //Store email into session variable
$password = strip_tags($_POST['log_password']); //Get password

$check_database_query = $con->prepare("SELECT * FROM users WHERE email=?");
$check_database_query->execute([$email]);
$check_login_query = $check_database_query->fetch();



if ($check_database_query->rowCount() == 1) {
    $user_id = $check_login_query['user_id'];

    $user_closed_query = $con->prepare("SELECT * FROM users WHERE email=? AND user_closed='yes'");
    $user_closed_query->execute([$email]);

    if ($user_closed_query->rowCount() == 1) {
        $reopen_account = $con->prepare("UPDATE users SET user_closed='no' WHERE email=?");
        $reopen_account->execute([$email]);
    }


    if (password_verify($password, $check_login_query['password'])) {
        $_SESSION['user_id'] = $user_id;
        echo json_encode(['status' => 200, 'message' => 'Login Successfull.']);
    } else {
        echo json_encode(['message' => 'Email or password was incorrect.']);
    }
} else {
    echo json_encode(['message' => 'Email or password was incorrect.']);
}
