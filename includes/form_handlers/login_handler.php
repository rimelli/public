<?php

if (isset($_POST['login_button'])) {
	
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

		if($user_closed_query->rowCount() == 1) {
			$reopen_account = $con->prepare("UPDATE users SET user_closed='no' WHERE email=?");
			$reopen_account->execute([$email]);
		}
	

		if (password_verify($password, $check_login_query['password'])) {
				$_SESSION['user_id'] = $user_id;
				header("Location: index.php");
				exit();
			}
			else {
				array_push($error_array, "Email or password was incorrect<br>");
			}
		}

	else {
		array_push($error_array, "Email or password was incorrect<br>");
	}
}
?>