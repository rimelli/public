<?php
include("includes/header.php");

$message_obj = new Message($con, $userLoggedIn);

if (isset($_GET['u']))
    $user_to = $_GET['u'];
else {
    if (isset($_GET['user_to'])) {
        $user_to = (int)$_GET['user_to'];
        $connected_users_arr = (new User($con, $userLoggedIn))->getUserConnects($userLoggedIn);
    }
}
if ($user_to)
    $user_to_obj = new User($con, $user_to);

$msgs_query = $con->prepare("SELECT * FROM messages WHERE (user_to=? AND user_from=?) OR (user_from=? AND user_to=?)");
$msgs_query->execute([$userLoggedIn, $user_to, $userLoggedIn, $user_to]);
?>

<!DOCTYPE html>
<html>
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/colors/blue.css">

    <style type="text/css">
        * {
            box-sizing: border-box;
        }

        #content {
            width: 600px;
            max-width: 100%;
            margin: 30px auto;
            background-color: #fafafa;
            padding: 20px;
        }

        #message-box {
            min-height: 400px;
            overflow: auto;
        }

        .author {
            margin-right: 5px;
            font-weight: 600;
        }

        .text-box {
            width: 100%;
            border: 1px solid #eee;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>

</head>
<body class="gray">

<!-- Wrapper -->
<div id="wrapper">


    <!-- Dashboard Container -->
    <div class="dashboard-container">

        <?php include("includes/side_menu.php"); ?>

        <!-- Dashboard Content
        ================================================== -->
        <div class="dashboard-content-container">
            <div class="dashboard-content-inner">

                <!-- Dashboard Headline -->
                <div class="dashboard-headline">
                    <?php
                        $current_user = new User($con, $userLoggedIn);
                    ?>
                    <h3><?= $current_user->getFirstAndLastName() ?> - Messages</h3>
                </div>

                <div class="messages-container margin-top-0">

                    <div class="messages-container-inner">

                        <!-- Messages -->
                        <div class="messages-inbox">
                            <ul>
                                <?php
                                if($user_to) :
                                        foreach ($connected_users_arr as $row) :
                                            $user = new User($con, $row['connected_user']);
                                ?>
                                            <li class="<?= $row['connected_user'] === $user_to_obj->getUserId() ? 'active-message' : '' ?>">
                                                <a href="messages.php?user_to=<?= $row['connected_user'] ?>">
                                                    <div class="message-avatar"><i class="status-icon <?= $user->isOnline() ? 'status-online' : '' ?>" id="user_<?= $row['connected_user'] ?>_status"></i><img
                                                                src="<?= $user->getProfilePic() ?>" alt=""/>
                                                    </div>

                                                    <div class="message-by">
                                                        <div class="message-by-headline">
                                                            <h5><?= $user->getFirstAndLastName() ?></h5>
                                                            <span><?= $user->getLastMessageInfo($userLoggedIn)['sent_on'] ?> ago</span>
                                                        </div>
                                                        <p><?= $user->getLastMessageInfo($userLoggedIn)['body'] ?></p>
                                                    </div>
                                                </a>
                                            </li>
                                <?php
                                        endforeach;
                                    endif;
                                ?>
                            </ul>
                        </div>
                        <!-- Messages / End -->

                        <!-- Message Content -->
                        <div class="message-content" id="content">

                            <div class="messages-headline">
                                <?php
                                if ($user_to) {
                                    $user_to_obj_username = $user_to_obj->getUsername();
                                    echo "<h4>You and <a href='/profile.php?profile_username=$user_to_obj_username'>" . $user_to_obj->getFirstAndLastName() . "</a></h4><br>";
                                } else {
                                    echo "<h4>No Messages</h4>";
                                }
                                ?>
                            </div>

                            <?php
                            if ($user_to) { ?>
                                <!-- Message Content Inner -->
                                <div class="message-content-inner <?=$userLoggedIn.'-'.$_GET['user_to']?>-message-box <?=$_GET['user_to'].'-'.$userLoggedIn?>-message-box" id="<?=$_GET['user_to']?>-message-box">
                                    <?php foreach ($msgs_query as $row) : ?>
                                        <div class="message-bubble <?php if ($row['user_from'] == $userLoggedIn): echo 'me '; ?>

                                            <?php endif ?>">
                                            <span class="message-text"><?= $row['body'] ?></span>
                                            <div class="message-avatar"><img
                                                        src="assets/images/profile_pics/defaults/profileimg.png"></div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <!-- Message Content Inner / End -->

                                <div>
                                    <input hidden value="<?php echo $userLoggedIn; ?>" id="userfrom-input">
                                    <?php
                                        $queries = array();
                                        parse_str($_SERVER['QUERY_STRING'], $queries);
                                    ?>
                                    <input hidden value="<?php echo $userLoggedIn.'-'.$queries['user_to']; ?>" id="message-box-input">
                                    <input hidden type="text" class="text-box" id="name-input"
                                           value="<?php echo $user_to_obj_username ?>">
                                    <input type="text" class="text-box" id="message-input" placeholder="Your Message"
                                           onkeyup="handleKeyUp(event)">
                                    <p>Press enter to send message</p>
                                </div>
                            <?php }
                            ?>

                        </div>
                        <!-- Message Content -->

                    </div>
                </div>
                <!-- Messages Container / End -->

                <!-- Current user id -->
                <input type="hidden" id="current_user" value="<?= $userLoggedIn ?>">
                <!-- Current connect id -->
                <input type="hidden" id="current_connect" value="<?= $_GET['user_to'] ?>">
                <?php
                    foreach ($connected_users_arr as $u) {
                        $users_str .= $u['connected_user'].' ';
                    }
                ?>
                <!-- Current connect id -->
                <input type="hidden" id="connected_users" value="<?= $users_str ?>">

                <!-- Footer -->
                <?php include("includes/footer.php"); ?>
                <!-- Footer / End -->

            </div>
        </div>
        <!-- Dashboard Content / End -->

    </div>
    <!-- Dashboard Container / End -->

</div>
<!-- Wrapper / End -->

<!-- Scripts
================================================== -->
<script src="assets/js/jquery-migrate-3.3.1.min.js"></script>
<script src="assets/js/mmenu.min.js"></script>
<script src="assets/js/tippy.all.min.js"></script>
<script src="assets/js/simplebar.min.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script>
<script src="assets/js/bootstrap-select.min.js"></script>
<script src="assets/js/snackbar.js"></script>
<script src="assets/js/clipboard.min.js"></script>
<script src="assets/js/counterup.min.js"></script>
<script src="assets/js/magnific-popup.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/custom.js"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>


<script type="text/javascript" src="js-index.js"></script>


</body>
</html>