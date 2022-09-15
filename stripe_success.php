<?php
include("includes/header.php");

if(!empty($_GET['session_id'])) {
    $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);

    $tid = $GET['tid'];
  } else {
    header('Location: index.php');
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
<body>

<!-- Wrapper -->
<div id="wrapper">


<!-- Content
================================================== -->
<div id="titlebar" class="gradient"> </div>

<!-- Container -->
<div class="container">
  <div class="row">
    <div class="col-md-12">

      <div class="order-confirmation-page">
        <div class="breathing-icon"><i class="icon-feather-check"></i></div>
        <h2 class="margin-top-30">Thank you for your order!</h2>
        <p>Your payment has been processed successfully.</p>
        <a href="plans.php" class="button ripple-effect-dark button-sliding-icon margin-top-30">Go Back <i class="icon-material-outline-arrow-right-alt"></i></a>
      </div>

    </div>
  </div>
</div>
<!-- Container / End -->

</div>
<!-- Wrapper / End -->

<!-- Footer -->
<?php include("includes/index_footer.php"); ?>
<!-- Footer / End -->


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

</body>
</html>

