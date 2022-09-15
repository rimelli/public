<?php
include("includes/header.php");

$users_query = $con->query("SELECT * FROM users");
$users = $users_query->fetchAll();
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
</head>
<body class="gray">

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
                            <div class="d-sm-fslex align-items-lg-center pt-1 px-3 pb-3">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Firstname</th>
                                        <th scope="col">Lastname</th>
                                        <th scope="col">Email</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach ($users as $user) :
                                    ?>
                                        <tr>
                                            <th scope="row"><?= $user['user_id'] ?></th>
                                            <td><?= $user['first_name'] ?></td>
                                            <td><?= $user['last_name'] ?></td>
                                            <td><?= $user['email'] ?></td>
                                            <td><a href="profile.php?profile_username=<?= $user['username']?>">Profile Page</a></td>
                                        </tr>
                                    <?php
                                        endforeach;
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Media -->
                        </div>
                    </div>
                    <!-- End Page Header -->
                </div>
            </div>
            <!-- End Tab Content -->
        </div>
        <!-- End Tab Wrapper -->
    </div>
    <!-- End Component Block -->

    <!-- Footer
    ================================================== -->
    <?php include("includes/menu_footer.php"); ?>
    <!-- Footer / End -->

</div>
<!-- Wrapper / End -->


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
<script src="assets/js/script.js"></script>


</body>
</html>