<?php
require '../config/config.php';

//Declaring variables to prevent errors
$proftype = ""; //Profile type
$fname = ""; //First name
$lname = ""; //Last name
$em = ""; //email
$password = ""; //password
$password2 = ""; //password 2
$date = ""; //Sign up date


    //Registration form values

    //Profile Type
    $proftype = $_POST['reg_proftype'];
    $_SESSION['reg_proftype'] = $proftype; //Stores profile type into session variable

    //First Name
    $fname = strip_tags($_POST['reg_fname']); //Remove html tags
    $fname = str_replace(' ', '', $fname); //Remove spaces
    $fname = ucfirst(strtolower($fname)); //Uppercase first letter
    $_SESSION['reg_fname'] = $fname; //Stores first name into session variable

    //Last Name
    $lname = strip_tags($_POST['reg_lname']); //Remove html tags
    $lname = str_replace(' ', '', $lname); //Remove spaces
    $lname = ucfirst(strtolower($lname)); //Uppercase first letter
    $_SESSION['reg_lname'] = $lname; //Stores last name into session variable

    //Email
    $em = strip_tags($_POST['reg_email']); //Remove html tags
    $em = str_replace(' ', '', $em); //Remove spaces
    $_SESSION['reg_email'] = $em; //Stores email into session variable

    //Password
    $password = strip_tags($_POST['reg_password']); //Remove html tags
    $password = str_replace(' ', '', $password); //Remove spaces

    //Password 2
    $password2 = strip_tags($_POST['reg_password2']); //Remove html tags
    $password2 = str_replace(' ', '', $password2); //Remove spaces

    //Date
    $date = date("Y-m-d"); //Current date


    //Check if email is in valid format
    if (filter_var($em, FILTER_VALIDATE_EMAIL)) {

        $em = filter_var($em, FILTER_VALIDATE_EMAIL);

        //Check if email already exists
        $e_check = $con->prepare("SELECT email FROM users WHERE email=?");
        $e_check->execute([$em]);

        //Count the number of rows returned
        $num_rows = $e_check->rowCount();

        if ($num_rows > 0) {
            echo json_encode(['status' => 400, 'message' => 'Email already in use.']);
            exit();
        }
    } else {
        echo json_encode(['status' => 400, 'message' => 'Invalid email format.']);
        exit();
    }


    if (strlen($fname) > 25 || strlen($fname) < 2) {
        echo json_encode(['status' => 400, 'message' => 'Your first name must be between 2 and 25 characters.']);
        exit();
    }

    if (strlen($lname) > 25 || strlen($lname) < 2) {
        echo json_encode(['status' => 400, 'message' => 'Your last name must be between 2 and 25 characters.']);
        exit();
    }

    if ($password != $password2) {
        echo json_encode(['status' => 400, 'message' => 'Your passwords do not match.']);
        exit();
    } else {
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            echo json_encode(['status' => 400, 'message' => 'Your password can only contain characters or numbers.']);
            exit();
        }
    }

    if (strlen($password) > 30 || strlen($password) < 5) {
        echo json_encode(['status' => 400, 'message' => 'Your password must be between 5 and 30 characters.']);
        exit();
    }


    $password = password_hash($password, PASSWORD_DEFAULT); //Hash password before sending to database

    //Generate username by concatenating first name and last name
    $username = strtolower($fname . $lname);
    $check_username_query = $con->prepare("SELECT username FROM users WHERE username=?");
    $check_username_query->execute([$username]);

    $i = 0;
    $temp_username = $username;
    //if username exists add number to username
    while ($check_username_query->rowCount() != 0) {
        $temp_username = $username;
        $i++; //Add 1 to i
        $temp_username = $username . $i;
        $check_username_query = $con->prepare("SELECT username FROM users WHERE username=?");
        $check_username_query->execute([$temp_username]);
    }
    $username = $temp_username;

    //Profile picture assignment
    $profile_pic = "assets/images/profile_pics/defaults/profileimg.png";
    $profile_background = "assets/images/profile_backgrounds/defaults/default_profile_background.jpg";


    $query = $con->prepare("INSERT INTO users VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0', '0', 'no')");
    $query->execute([$proftype, $fname, $lname, $username, $em, $password, $date, $profile_pic, $profile_background]);

    $user_id = $con->lastInsertId();


    if ($proftype == 1) {
        $query = $con->prepare("INSERT INTO individuals VALUES (NULL, ?)");
        $query->execute([$user_id]);
    }

    if ($proftype == 2) {
        $query = $con->prepare("INSERT INTO organisations VALUES (NULL, ?)");
        $query->execute([$user_id]);
    }

    $query2 = $con->prepare("INSERT INTO nationalities VALUES (NULL, ?, '', '')");
    $query2->execute([$user_id]);


    echo json_encode(['status' => 200, 'message' => "You're all set! Go ahead and login!"]);

    //Clear session variables
    $_SESSION['reg_proftype'] = "";
    $_SESSION['reg_fname'] = "";
    $_SESSION['reg_lname'] = "";
    $_SESSION['reg_email'] = "";

?>
