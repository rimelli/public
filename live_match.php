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
                                <h3><i class="icon-feather-shield"></i> <?php echo $fixture['team_name'] ?> 2 x 1 <?php echo $fixture['other_team_name'] ?> <i class="icon-feather-shield"></i> <span class='account-span margin-left-10' style='background-color: #2a41e8;'>10 Viewing</span></h3>
                            <?php endif ?>
                            <?php if ($fixture['home_away'] == 'away'): ?>
                                <h3><i class="icon-feather-shield"></i> <?php echo $fixture['other_team_name'] ?> 2 x 1 <?php echo $fixture['team_name'] ?> <i class="icon-feather-shield"></i> <span class='account-span margin-left-10' style='background-color: #2a41e8;'>10 Viewing</span></h3>
                            <?php endif ?>
                        </div>

                        <div class="content">
                            <ul class="dashboard-box-list">
                                <div class="fun-facts-container" style="max-width: 50%; margin: auto;">
                                    <div class="fun-fact" data-fun-fact-color="#efa80f">
                                        <div class="fun-fact-text">
                                            <span>Substitution</span>
                                            <h3>Substitution for Away Team</h3>
                                        </div>
                                        <div class="fun-fact-icon"><i class="icon-feather-repeat"></i></div>
                                    </div>
                                </div>
                                <div class="fun-facts-container" style="max-width: 50%; margin: auto;">
                                    <div class="fun-fact" data-fun-fact-color="#36bd78">
                                        <div class="fun-fact-text">
                                            <span>Goal!</span>
                                            <h3>Goal for Home Team!</h3>
                                        </div>
                                        <div class="fun-fact-icon"><i class="icon-feather-alert-circle"></i></div>
                                    </div>
                                </div>
                                <div class="fun-facts-container" style="max-width: 50%; margin: auto;">
                                    <div class="fun-fact" data-fun-fact-color="#2a41e8">
                                        <div class="fun-fact-text">
                                            <span>Kick Off</span>
                                        </div>
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
                <form id="" class="login-form">
                
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
                <form id="" class="login-form">
                
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
                <form id="" class="login-form">
                
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
                    
                <!-- Form -->
                <form id="" class="login-form">

                    <select class="selectpicker with-border default margin-bottom-20" name="" data-size="7" title="Goal For" required>
                        <option>Home Team</option>
                        <option>Away Team</option>
                    </select>
                
                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect" type="submit" name="">Submit <i class="icon-material-outline-arrow-right-alt"></i></button>
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
                <form id="" class="login-form">

                    <select class="selectpicker with-border default margin-bottom-20" name="" data-size="7" title="Player Out" required>
                        <option>Player 1</option>
                        <option>Player 2</option>
                        <option>Player 3</option>
                    </select>

                    <select class="selectpicker with-border default margin-bottom-20" name="" data-size="7" title="Player In" required>
                        <option>Player 1</option>
                        <option>Player 2</option>
                        <option>Player 3</option>
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
<script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>


</body>
</html>