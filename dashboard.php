<?php
include("includes/header.php");

/*  FAKE STATS DATA GENERATOR BELOW
function getNextDate(){
	global $y, $m, $d;

	$d--;

	if ($d == 0){
		$d = 31;
		$m--;
	}

	if ($m == 0){
		$m = 12;
		$y--;
	}

	return sprintf('%d-%02d-%02d', $y, $m, $d);

}

if (isset($_SESSION['user_id'])) {	
	$y = date('Y');
	$m = date('n');
	$d = date('j');
	$date = date('Y-n-j');

	for ($x = 0; $x <= 730; $x++){		
		$date = getNextDate();
		$hits = rand(10, 200);		

		while(!checkdate($m, $d, $y)){
			$date = getNextDate();
		}

		//  Update stats
		$stats = $con->prepare(sprintf("UPDATE stats SET hits = hits + %d WHERE day=? AND user_id=? LIMIT 1", $hits));
		$stats->execute([$date, $_SESSION['user_id']]);
		$id = $stats->rowCount();

		if (!$id){
			$stats = $con->prepare("INSERT INTO stats (day, user_id, hits) VALUES (?, ?, ?)");
			$stats->execute([$date, $_SESSION['user_id'], $hits]);

		}

	}	
	
}
END OF FAKE STATS DATA GENERATOR  */

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
<<<<<<< HEAD
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Dashboard</h3>
			</div>
			
			<!-- Row -->
			<div class="row">

				<div class="col-xl-8">
					<!-- Dashboard Box -->
					<div class="dashboard-box main-box-in-row">
						<div class="headline">
							<h3><i class="icon-feather-bar-chart-2"></i> Your Profile Views</h3>							
							<div class="sort-by">							
								<select class="selectpicker hide-tick" onChange="statsGet(this.value)">
									<option value="daily" selected>Daily</option>
									<option value="weekly">Weekly</option>
									<option value="monthly">Monthly</option>
									<option value="yearly">Yearly</option>
								</select>
							</div>
						</div>
						<div class="content">
							<!-- Chart -->
							<div class="chart">
								<canvas id="chart" width="100" height="45"></canvas>
=======
			<div class="dashboard-content-container" data-simplebar>
				<div class="dashboard-content-inner">

					<!-- Dashboard Headline -->
					<div class="dashboard-headline">
						<h3>Dashboard</h3>
					</div>

					<!-- Row -->
					<div class="row">

						<div class="col-xl-8">
							<!-- Dashboard Box -->
							<div class="dashboard-box main-box-in-row">
								<div class="headline">
									<h3><i class="icon-feather-bar-chart-2"></i> Your Profile Views</h3>
									<div class="sort-by">
										<select class="selectpicker hide-tick" onChange="statsGet(this.value)">
											<option value="daily" selected>Daily</option>
											<option value="weekly">Weekly</option>
											<option value="monthly">Monthly</option>
											<option value="yearly">Yearly</option>
											<!-- <option value="last_week">Last Week</option>
									<option value="this_month">This Month</option>
									<option value="last_month">Last Month</option>
									<option value="last_3_months">Last 3 Months</option>
									<option value="last_6_months">Last 6 Months</option>
									<option value="this_year">This Year</option>
									<option value="last_year">Last Year</option> -->
										</select>
									</div>
								</div>
								<div class="content">
									<!-- Chart -->
									<div class="chart">
										<canvas id="chart" width="100" height="45"></canvas>
									</div>
								</div>
>>>>>>> c83ad1adf003c16eb8b617847dbb07a2ba770983
							</div>
							<!-- Dashboard Box / End -->
						</div>

					</div>
					<!-- Row / End -->

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


	<!-- Apply for a job popup
================================================== -->
	<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

		<!--Tabs -->
		<div class="sign-in-form">

			<ul class="popup-tabs-nav">
				<li><a href="#tab">Add Note</a></li>
			</ul>

			<div class="popup-tabs-container">

				<!-- Tab -->
				<div class="popup-tab-content" id="tab">

					<!-- Welcome Text -->
					<div class="welcome-text">
						<h3>Do Not Forget 😎</h3>
					</div>

					<!-- Form -->
					<form method="post" id="add-note">

						<select class="selectpicker with-border default margin-bottom-20" data-size="7" title="Priority">
							<option>Low Priority</option>
							<option>Medium Priority</option>
							<option>High Priority</option>
						</select>

						<textarea name="textarea" cols="10" placeholder="Note" class="with-border"></textarea>

					</form>

					<!-- Button -->
					<button class="button full-width button-sliding-icon ripple-effect" type="submit" form="add-note">Add Note <i class="icon-material-outline-arrow-right-alt"></i></button>

				</div>

			</div>
		</div>
	</div>
	<!-- Apply for a job popup / End -->


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

	<!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
	<script>
		// Snackbar for user status switcher
		$('#snackbar-user-status label').click(function() {
			Snackbar.show({
				text: 'Your status has been changed!',
				pos: 'bottom-center',
				showAction: false,
				actionText: "Dismiss",
				duration: 3000,
				textColor: '#fff',
				backgroundColor: '#383838'
			});
		});
	</script>

	<!-- Chart.js // documentation: http://www.chartjs.org/docs/latest/ -->
	<script src="assets/js/chart.min.js"></script>
	<script>
		Chart.defaults.global.defaultFontFamily = "Nunito";
		Chart.defaults.global.defaultFontColor = '#888';
		Chart.defaults.global.defaultFontSize = '14';

		//  NO VIEWS 
		Chart.plugins.register({
			afterDraw: function(chart) {
				if (chart.data.datasets[0].data.length === 0) {
					var ctx = chart.chart.ctx;
					chart.clear();
					ctx.save();
					ctx.textAlign = 'center';
					ctx.textBaseline = 'middle';
					ctx.font = "Bold 20px Nunito";
					ctx.fillText('No views yet', chart.chart.width / 2, chart.chart.height / 2);
					ctx.restore();
				}
			}
		});

		var ctx = document.getElementById('chart').getContext('2d');

		var chart = new Chart(ctx, {
			type: 'line',

			// The data for our dataset
			data: {
				labels: [],
				// Information about the dataset
				datasets: [{
					label: "Views",
					backgroundColor: 'rgba(42,65,232,0.08)',
					borderColor: '#2a41e8',
					borderWidth: "3",
					data: [],
					pointRadius: 5,
					pointHoverRadius: 5,
					pointHitRadius: 10,
					pointBackgroundColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointBorderWidth: "2",
				}]
			},

			// Configuration options
			options: {

				layout: {
					padding: 10,
				},

				legend: {
					display: false
				},
				title: {
					display: false
				},

				scales: {
					yAxes: [{
						scaleLabel: {
							display: false
						},
						gridLines: {
							borderDash: [6, 10],
							color: "#d8d8d8",
							lineWidth: 1,
						},
						ticks: {
							beginAtZero: true,
							userCallback: function(label, index, labels) {
								// when the floored value is the same as the value we have a whole number
								if (Math.floor(label) === label) {
									return label;
								}

							}
						},
					}],
					xAxes: [{
						scaleLabel: {
							display: false
						},
						gridLines: {
							display: false
						},
					}],
				},

				tooltips: {
					backgroundColor: '#333',
					titleFontSize: 13,
					titleFontColor: '#fff',
					bodyFontColor: '#fff',
					bodyFontSize: 13,
					displayColors: false,
					xPadding: 10,
					yPadding: 10,
					intersect: false
				}
			},


		});

		function statsGet(type) {
			$.getJSON(`stats.php?type=${type}`, function(json) {
				console.log(json);

				let labels = [],
					data = [];

				// for (x in json) {
				// 	labels.push(x);
				// 	data.push(json[x]);
				// }
				json.forEach(e => {
					labels.push(e.label);
					data.push(e.total);
				});

				chart.data.labels = labels;
				chart.data.datasets[0]['data'] = data;
				chart.update();

			});
		}

		$(document).ready(function() {
			statsGet('daily');
		});
	</script>

</body>

</html>