<?php
include("includes/header.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = $con->prepare("SELECT fixtures.*, teams.* FROM fixtures LEFT JOIN teams ON fixtures.your_team=teams.team_id WHERE fixtures.id=? AND fixtures.user_id=? AND fixtures.fixture_deleted=?");
    $sql->execute([$id, $userLoggedIn, 'no']);
    $fixture = $sql->fetch();
    if($sql->rowCount() == 0) {
        echo "Match not found.";
        exit();
    }

    $player_sql = $con->prepare("SELECT * from  team_players WHERE team_id=?");
    $player_sql->execute([$fixture['team_id']]);
    $players= $player_sql->fetchAll();


    $kick_of_sql = $con->prepare("SELECT kick_off from  fixtures WHERE id=?");
    $kick_of_sql->execute([$id]);
    $kick_of = $kick_of_sql->fetch();

    $half_time_sql = $con->prepare("SELECT half_time from  fixtures WHERE id=?");
    $half_time_sql->execute([$id]);
    $half_time = $half_time_sql->fetch();

    $full_time_sql = $con->prepare("SELECT full_time from  fixtures WHERE id=?");
    $full_time_sql->execute([$id]);
    $full_time = $full_time_sql->fetch();

    $home_goal = $con->prepare("SELECT your_goal_score from  fixtures WHERE id=?");
    $home_goal->execute([$id]);
    $home_goal_val = $home_goal->fetch();
}
else {
    $id = 0;
}
?>




<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>Tryouts</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/colors/blue.css">
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>

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
        <div class="dashboard-content-inner" >
            
            <!-- Dashboard Headline -->
            <div class="dashboard-headline">
                <h3>Live Match</h3>
                <?php if ($fixture['user_id'] == $userLoggedIn): ?>
                    <a href='#small-dialog' class='popup-with-zoom-anim button ripple-effect margin-top-20'><i class='icon-feather-clock margin-right-10'></i>Kick Off</a>
                    <a href='#small-dialog-1' class='popup-with-zoom-anim button ripple-effect margin-top-20'><i class='icon-feather-clock margin-right-10'></i>Half-Time</a>
                    <a href='#small-dialog-2' class='popup-with-zoom-anim button ripple-effect margin-top-20'><i class='icon-feather-clock margin-right-10'></i>Full-Time</a>
                    <br>
                    <a href='#small-dialog-3' class='popup-with-zoom-anim button ripple-effect margin-top-20 margin-right-10'><i class='icon-feather-alert-circle margin-right-10'></i>Goal</a>
                    <a href='#small-dialog-4' class='popup-with-zoom-anim button ripple-effect margin-top-20'><i class='icon-feather-repeat margin-right-10'></i>Substitution</a>
                <?php endif ?>
            </div>

            <!-- Row -->
            <div class="row">

                <!-- Dashboard Box -->
                <div class="col-xl-12">
                    <div class="dashboard-box margin-top-0">

                        <!-- Headline -->
                        <div class="headline margin-bottom-20">
                            <?php if ($fixture['home_away'] == 'home'): ?>
                                <h3><i class="icon-feather-shield"></i> <?php echo $fixture['team_name'] ?>  <span class="your_goal"><?php echo $fixture['your_goal_score'] ?></span> x <span class="other_goal"><?php echo $fixture['other_goal_score'] ?> </span> <i class="icon-feather-shield"></i> <span class='account-span total-view margin-left-10' style='background-color: #2a41e8;'></span></h3>
                            <?php endif ?>
                            <?php if ($fixture['home_away'] == 'away'): ?>
                                <h3><i class="icon-feather-shield"></i> <?php echo $fixture['other_team_name'] ?> <?php echo $fixture['other_goal_score'] ?> x <?php echo $fixture['your_goal_score'] ?> <?php echo $fixture['team_name'] ?> <i class="icon-feather-shield"></i> <span class='account-span margin-left-10' style='background-color: #2a41e8;'>10 Viewing</span></h3>
                            <?php endif ?>
                        </div>

                        <div class="content">
                            <ul class="dashboard-box-list">
                                <div class="fun-facts-container" style="max-width: 50%; margin: auto;">
                                    <div class="fun-fact" data-fun-fact-color="#efa80f">
                                        <div class="fun-fact-text">
                                            <span>Substitution</span>
                                            <h3>Substitution</h3>
                                            <span class="subst_in"></span>
                                           <div>
                                               <span class="subst_out"></span>
                                        </div>
                                        </div>
                                        <div class="fun-fact-icon"><i class="icon-feather-repeat"></i></div>
                                    </div>
                                </div>
                                <div class="fun-facts-container" style="max-width: 50%; margin: auto;">
                                    <div class="fun-fact" data-fun-fact-color="#36bd78">
                                        <div class="fun-fact-text">
                                            <span>Goal!</span>
                                            <h3>Goal for Home Team!</h3>
                                            <span class="is_goal"></span>
                                        </div>
                                        <div class="fun-fact-icon"><i class="icon-feather-alert-circle"></i></div>
                                    </div>
                                </div>
                                <div class="fun-facts-container" style="max-width: 50%; margin: auto;">
                                    <div class="fun-fact" data-fun-fact-color="#2a41e8">
                                        <div class="fun-fact-text">
                                            <span>Kick Off</span>
                                            <span class="kick_off_val">
                                            </span>
                                        </div>
                                       <span class="is_kick_off"></span>
                                        <div class="fun-fact-icon"><i class="icon-feather-clock"></i></div>
                                    </div>
                                </div>
                                <div class="fun-facts-container" style="max-width: 50%; margin: auto;">
                                    <div class="fun-fact" data-fun-fact-color="#2a41e8">
                                        <div class="fun-fact-text">
                                            <span>Half time</span>
                                            <span class="kick_off_val">
                                            </span>
                                        </div>
                                        <span class="is_half_time"></span>
                                        <div class="fun-fact-icon"><i class="icon-feather-clock"></i></div>
                                    </div>
                                </div>
                                <div class="fun-facts-container" style="max-width: 50%; margin: auto;">
                                    <div class="fun-fact" data-fun-fact-color="#2a41e8">
                                        <div class="fun-fact-text">
                                            <span>Full time</span>
                                            <span class="kick_off_val">
                                            </span>
                                        </div>
                                        <span class="is_full_time"></span>
                                        <div class="fun-fact-icon"><i class="icon-feather-clock"></i></div>
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

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


<!-- Popup
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab">
                
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Confirm Kick Off?</h3>
                </div>
                    
                <!-- Form -->
                <form action="fixture_updates.php?id=<?php echo $fixture['id']?> " method="POST" class="login-form">
                    <input type="hidden" name="step" value="kick_off" />
                    <!-- Button -->
                    <button class="button full-width button-sliding-icon ripple-effect" type="submit" name="">Yes <i class="icon-material-outline-arrow-right-alt"></i></button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Popup / End -->

<!-- Popup
================================================== -->
<div id="small-dialog-1" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab">
                
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Confirm Half-Time?</h3>
                </div>
                    
                <!-- Form -->
                <form action="fixture_updates.php?id=<?php echo $fixture['id']?> " method="post" id="" class="login-form">
                    <input type="hidden" name="step" value="half_time" />
                    <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect" type="submit" name="">Yes <i class="icon-material-outline-arrow-right-alt"></i></button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Popup / End -->

<!-- Popup
================================================== -->
<div id="small-dialog-2" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab">
                
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Confirm Full-Time?</h3>
                </div>
                    
                <!-- Form -->
                <form id="" action="fixture_updates.php?id=<?php echo $fixture['id']?> " method="post" class="login-form">
                    <input type="hidden" name="step" value="full_time" />
                    <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect" type="submit" name="">Yes <i class="icon-material-outline-arrow-right-alt"></i></button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Popup / End -->

<!-- Popup
================================================== -->
<div id="small-dialog-3" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab">
                
                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Goal</h3>
                </div>
                <form id="" action="fixture_updates.php?id=<?php echo $fixture['id']?> " method="post" class="login-form">
                        <input type="hidden" name="step" value="goal" />
                        <select class="selectpicker with-border default margin-bottom-20" name="goals" data-size="7" title="Goal For" required>
                            <option value="home">Home Team</option>
                            <option value="away">Away Team</option>
                        </select>
                    <!-- Button -->
                    <button class="button full-width button-sliding-icon ripple-effect" type="submit" name="">Yes <i class="icon-material-outline-arrow-right-alt"></i></button>
                </form>

            </div>

        </div>
    </div>
</div>
<!-- Popup / End -->


<!-- Popup
================================================== -->
<div id="small-dialog-4" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab">

                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Substitution</h3>
                </div>

                <!-- Form -->
                <form id="" action="fixture_updates.php?id=<?php echo $fixture['id']?> " method="post" class="login-form">
                    <input type="hidden" name="step" value="substitution" />
                    <select class="selectpicker with-border default margin-bottom-20" name="player_out" data-size="7" title="Player Out">
                        <?php foreach ($players as $player) :?>
                        <option value="<?php echo $player['id']?>"><?php echo $player['player_name']?></option>
                        <?php endforeach;?>
                    </select>

                    <select class="selectpicker with-border default margin-bottom-20" name="player_in" data-size="7" title="Player In">
                        <?php foreach ($players as $player) :?>
                            <option value="<?php echo $player['id']?>"><?php echo $player['player_name']?></option>
                        <?php endforeach;?>
                    </select>

                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect" type="submit" name="">Submit <i class="icon-material-outline-arrow-right-alt"></i></button>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Popup / End -->


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

<!--<script type="text/javascript" src="js-index.js"></script>-->

<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    var pusher = new Pusher('5506c128345d2a429a4d', {
        cluster: 'ap2'
    });

    var channel = pusher.subscribe('demo_pusher');


   channel.bind('add_goals', function (data) {
        let your_goal = data['goals']['your_goal_score'];
        let other_goal = data['goals']['other_goal_score'];
        if(your_goal) {
            $('.your_goal').html(your_goal);
            $('.is_goal').html('There is a goal in the home team');
        }
        if(other_goal) {
            $('.other_goal').html(other_goal);
        }
    });
    channel.bind('kick_off', function (data) {

        if(data === "kick_off") {
            $('.is_kick_off').html('There is a kick off');
        }
    });
    channel.bind('half_time', function (data) {
        if(data === "half_time") {
            $('.is_half_time').html('There is a half time');
        }
    });
    channel.bind('full_time', function (data) {
        if(data === "full_time") {
            $('.is_full_time').html('There is a full time');
        }
    });
    channel.bind('subst', function (data) {
        let player_in = data['players']['player_in'];
        let player_out = data['players']['player_out'];
        if(player_in) {
            $('.subst_in').html(player_in);
        }
        if(player_out)  {
            $('.subst_out').html(player_out);
        }
    });
    channel.bind('visits', function (data) {

        if(data) {
            $('.total-view').html(data);
        }
    });
</script>
</body>
</html>