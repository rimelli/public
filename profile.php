<?php
include("includes/header.php");
require __DIR__ . '/vendor/autoload.php';

$message_obj = new Message($con, $userLoggedIn);

if (isset($_GET['profile_username'])) {
    $username = $_GET['profile_username'];
    $user_details_query = $con->prepare("SELECT * FROM users WHERE username=?");
    $user_details_query->execute([$username]);

    if ($user_details_query->rowCount() == 0) {
        echo "User does not exist";
        exit();
    }

    $user_array = $user_details_query->fetch();
    $user_id = $user_array['user_id'];

    $individual_array_query = $con->prepare("SELECT * FROM individuals WHERE user_id=?");
    $individual_array_query->execute([$user_id]);
    $individual_array = $individual_array_query->fetch();
}
?>


<!doctype html>
<html lang="en">
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/colors/blue.css">
    <link rel="stylesheet" href="assets/icon-set/style.css">
    <style>
        .alert {
            padding: 20px;
            color: white;
        }
        .success {
            background-color: green;
        }
        .error {
            background-color: red;

        }
        .closeBtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }
        .closeBtn:hover {
            color: black;
        }
    </style>
</head>
<body class="gray">

<?php
if (isset($_GET['message']) && isset($_GET['type'])) {
    echo '
        <div class="alert '.$_GET['type'].'">
            <span class="closeBtn" onclick="window.history.pushState({}, document.title, \'/profile.php?profile_username='.$_GET['profile_username'].'\')">&times;</span>
            '.$_GET['message'].'
        </div>
    ';
}
?>
<script>
    $('.closeBtn').click(function () {
        this.parentElement.style.display='none'
    })
</script>
<!-- Wrapper -->
<div id="wrapper">


    <!-- Component Block -->
    <div id="component-7" class="hs-docs-content-divider">

        <!-- Tab Wrapper -->
        <div class="tab-wrapper">

            <!-- Tab Content -->
            <div class="tab-content" id="pills-tabContent-7">
                <div class="tab-pane fade p-4 show active" id="pills-result-7" role="tabpanel"
                     aria-labelledby="pills-result-tab-7">
                    <!-- Page Header -->
                    <div class="container space-1">
                        <div>

                            <!-- Media -->
                            <div class="d-sm-flex align-items-lg-center pt-1 px-3 pb-3">
                                <div class="mb-2 mb-sm-0 mr-4 profile-header-pic">
                                    <img src="<?php echo $user_array['profile_pic']; ?>" alt="Image Description">
                                </div>

                                <div class="media-body">
                                    <div class="row">
                                        <div class="col-lg mb-3 mb-lg-0">
                                            <?php
                                            echo $user_array['first_name']; ?>

                                            <!-- Details -->
                                            <div class="mb-2">
                                                <span><img class="profile-flag" src="" alt=""></span>
                                            </div>
                                            <div class="row text-body font-size-1 mb-2">
                                                <div class="col-auto">
                                                </div>
                                                <div class="col-auto">
                                                </div>
                                            </div>
                                            <div class="align-self-lg-end text-lg-right">
                                                <form action="<?php echo $username; ?>" method="POST">
                                                    <?php
                                                    $profile_user_obj = new User($con, $user_id);
                                                    if ($profile_user_obj->isClosed()) {
                                                        header("Location: user_closed.php");
                                                    }

                                                    $logged_in_user_obj = new User($con, $userLoggedIn);

                                                    if ($userLoggedIn != $user_id) {

                                                        echo '<a href="#small-dialog" class="popup-with-zoom-anim button dark ripple-effect"><i class="icon-feather-mail"></i> Send Message</a>';
                                                    } ?>
                                                </form>
                                            </div>
                                            <!-- End Details-->
                                        </div>


                                    </div>
                                    <!-- End Row -->
                                </div>
                            </div>
                            <!-- End Media -->
                        </div>
                    </div>
                    <!-- End Page Header -->
                </div>
                <div class="tab-pane fade" id="pills-html-7" role="tabpanel" aria-labelledby="pills-html-tab-7">
                  <pre>
                    <code class="language-html" data-lang="html">
                      
                    </code>
                  </pre>
                </div>
            </div>
            <!-- End Tab Content -->
        </div>
        <!-- End Tab Wrapper -->
    </div>
    <!-- End Component Block -->


    <!-- Page Content
    ================================================== -->

    <!-- Tabs & Toggles
    ================================================== -->
    <!-- Container -->
    <div class="container mb-5">
        <div class="row">

            <div class="col-xl-12 col-md-12">

                <!-- Nav -->
                <?php include("partials/profile_menu.php"); ?>
                <!-- End Nav -->

            </div>

        </div>
    </div>
    <!-- Container / End -->


    <!-- Footer
    ================================================== -->
    <?php include("includes/menu_footer.php"); ?>
    <!-- Footer / End -->

</div>
<!-- Wrapper / End -->


<!-- Send Direct Message Popup
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

    <!--Tabs -->
    <div class="sign-in-form">

        <ul class="popup-tabs-nav">
            <li><a href="#tab">Send Message</a></li>
        </ul>

        <div class="popup-tabs-container">

            <!-- Tab -->
            <div class="popup-tab-content" id="tab">

                <!-- Welcome Text -->
                <div class="welcome-text">
                    <h3>Direct Message To <?php echo $user_array['first_name'] ?></h3>
                </div>

                <p id="profile-msg-result" class="notification" style="display: none;"></p>

                <!-- Form -->
                <form method="POST" id="profile-message-form" action="php-send-message.php">
                    <input type="hidden" name="name" value="<?php echo (new User($con, $user_id))->getUsername(); ?>">
                    <input type="hidden" name="message_box" value="<?php echo $userLoggedIn.'-'.$user_id; ?>">
                    <input type="hidden" name="userfrom" value="<?php echo $userLoggedIn ?>"/>
                    <input type="hidden" name="pagefrom" value="profile"/>
                    <textarea name='message' cols="10" placeholder="Message" class="with-border" id="message_area"
                              required></textarea>
                    <!-- Button -->
                    <input type="submit" name="post_message" class="info" value="Send" style="width: 100%;">
                </form>

            </div>

        </div>
    </div>
</div>
<!-- Send Direct Message Popup / End -->


<!-- Scripts
================================================== -->
<script src="assets/js/mmenu.min.js"></script>
<script src="assets/js/tippy.all.min.js"></script>
<script src="assets/js/simplebar.min.js"></script>
<script src="assets/js/bootstrap-select.min.js"></script>
<script src="assets/vendor/hs-unfold/dist/hs-unfold.min.js"></script>
<script src="assets/js/snackbar.js"></script>
<script src="assets/js/clipboard.min.js"></script>
<script src="assets/js/counterup.min.js"></script>
<script src="assets/js/magnific-popup.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/custom.js"></script>
<script src="assets/js/script.js"></script>

<script src="assets/js/front/hs.core.js"></script>

<!-- JS Plugins Init. -->
<script>
    $(document).on('ready', function () {


        // INITIALIZATION OF UNFOLD
        // =======================================================
        $('.js-hs-unfold-invoker').each(function () {
            var unfold = new HSUnfold($(this)).init();
        });

        // INITIALIZATION OF NAV SCROLLER
        // =======================================================
        $('.js-nav-scroller').each(function () {
            new HsNavScroller($(this)).init()
        });

    });

</script>

</body>
</html>