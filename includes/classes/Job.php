<?php 
class Job {
	private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}


	public function getSingleJob($job_id) {

		$userLoggedIn = $this->user_obj->getUserId();


		$str = ""; //String to return
		$data_query = $this->con->prepare("SELECT * FROM jobs WHERE job_deleted='no' AND id=?");
		$data_query->execute([$job_id]);

		if($data_query->rowCount() > 0) {


			$row = $data_query->fetch();
				$id = $row['job_id'];
				$body = $row['job_description'];
				$user_id = $row['user_id'];
				$date_time = $row['job_post_date'];
				$job_title = $row['job_title'];
				$job_category = $row['job_category'];
				$job_city = $row['job_city'];
				$job_county = $row['job_county'];
				$job_country = $row['job_country'];
				$job_min = $row['job_salary_min'];
				$job_max = $row['job_salary_max'];

				//Check if user who posted, has their account closed
				$added_by_obj = new User($this->con, $user_id);
				if($added_by_obj->isClosed()) {
					return;
				}

				$user_logged_obj = new User($this->con, $userLoggedIn);

					$bookmark_query = $this->con->prepare("SELECT * FROM bookmarks WHERE user_id=? AND job_id=?");
					$bookmark_query->execute([$userLoggedIn, $job_id]);
					$bookmarks = $bookmark_query->fetchAll();

					$user_details_query = $this->con->prepare("SELECT * FROM users WHERE user_id=?");
					$user_details_query->execute([$user_id]);
					$user_row = $user_details_query->fetch();
					$first_name = $user_row['first_name'];
					$last_name = $user_row['last_name'];
					$profile_pic = $user_row['profile_pic'];
					$username = $user_row['username'];
					$verified = $user_row['verified'];


					//Timeframe
					$date_time_now = date("Y-m-d H:i:s");
					$start_date = new DateTime($date_time); //Time of post
					$end_date = new DateTime($date_time_now); //Current time
					$interval = $start_date->diff($end_date); //Difference between dates
					if($interval->y >= 1) {
						if($interval == 1)
							$time_message = $interval->y . " year ago"; //1 year ago
						else
							$time_message = $interval->y . " years ago"; //1+ year ago
					}
					elseif ($interval-> m >= 1) {
						if($interval->d == 0) {
							$days = " ago";
						}
						else if($interval->d == 1) {
							$days = $interval->d . " day ago";
						}
						else {
							$days = $interval->d . " days ago";
						}


						if ($interval->m == 1) {
							$time_message = $interval->m . " month ago";
						}
						else {
							$time_message = $interval->m . " months ago";
						}

					}
					else if($interval->d >= 1) {
						if($interval->d == 1) {
							$time_message = "Yesterday";
						}
						else {
							$time_message = $interval->d . " days ago";
						}
					}
					else if($interval->h >= 1) {
						if($interval->h == 1) {
							$time_message = $interval->h . " hour ago";
						}
						else {
							$time_message = $interval->h . " hours ago";
						}
					}
					else if($interval->i >= 1) {
						if($interval->i == 1) {
							$time_message = $interval->i . " minute ago";
						}
						else {
							$time_message = $interval->i . " minutes ago";
						}
					}
					else {
						if($interval->s < 30) {
							$time_message = "Just now";
						}
						else {
							$time_message = $interval->s . " seconds ago";
						}
					}

					$str .= "<div class='single-page-header' data-background-image='assets/images/profile_backgrounds/defaults/default_profile_background.jpg'>
									<div class='container'>
										<div class='row'>
											<div class='col-md-12'>
												<div class='single-page-header-inner'>
													<div class='left-side'>
														<div class='header-image' style='border-radius: 50%; padding:0;'><a href='$username'><img src='$profile_pic' alt=''></a></div>
														<div class='header-details'>
															<h3>$job_title</h3>
															<h5>About the Job</h5>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class='container'>
									<div class='row'>
										<div class='col-xl-8 col-lg-8 content-right-offset'>
											<div class='single-page-section'>
												<h3 class='margin-bottom-25'>Job Description</h3>
												<p>$body</p>
											</div>
										</div>
									
								<div class='col-xl-4 col-lg-4'>
									<div class='sidebar-container'>
										<a href='#' class='apply-now-button'>Apply Now <i class='icon-material-outline-arrow-right-alt'></i></a>
							
										<div class='sidebar-widget'>
											<h3>Bookmark</h3>
											<button class='bookmark-button margin-bottom-25'>
												<span class='bookmark-icon'></span>
												<span class='bookmark-text'>Bookmark</span>
												<span class='bookmarked-text'>Bookmarked</span>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>";
				
				?>
				<script>
				
					$(document).ready(function() {

						$('#job<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to delete this job?", function(result) {

								$.job("includes/form_handlers/delete_post.php?job_id=<?php echo $id; ?>", {result:result});

								if(result)
									location.reload();

							})
						})



					});	

				</script>
				<?php

		}
		else {
			echo "<p>No job found.</p>";
			return;
		}

		echo $str;

	}

	public function getSingleJobApplicants($job_id) {

		$userLoggedIn = $this->user_obj->getUserId();

		$str = ""; //String to return
		$data_query = $this->con->prepare("SELECT * FROM job_applications WHERE job_id=?");
		$data_query->execute([$job_id]);
		$applicants = $data_query->fetchAll();

		if($data_query->rowCount() > 0) {

				//Check if user who posted, has their account closed
				$added_by_obj = new User($this->con, $user_id);
				if($added_by_obj->isClosed()) {
					return;
				}

				$user_logged_obj = new User($this->con, $userLoggedIn);

					//Timeframe
					$date_time_now = date("Y-m-d H:i:s");
					$start_date = new DateTime($date_time); //Time of post
					$end_date = new DateTime($date_time_now); //Current time
					$interval = $start_date->diff($end_date); //Difference between dates
					if($interval->y >= 1) {
						if($interval == 1)
							$time_message = $interval->y . " year ago"; //1 year ago
						else
							$time_message = $interval->y . " years ago"; //1+ year ago
					}
					elseif ($interval-> m >= 1) {
						if($interval->d == 0) {
							$days = " ago";
						}
						else if($interval->d == 1) {
							$days = $interval->d . " day ago";
						}
						else {
							$days = $interval->d . " days ago";
						}


						if ($interval->m == 1) {
							$time_message = $interval->m . " month ago";
						}
						else {
							$time_message = $interval->m . " months ago";
						}

					}
					else if($interval->d >= 1) {
						if($interval->d == 1) {
							$time_message = "Yesterday";
						}
						else {
							$time_message = $interval->d . " days ago";
						}
					}
					else if($interval->h >= 1) {
						if($interval->h == 1) {
							$time_message = $interval->h . " hour ago";
						}
						else {
							$time_message = $interval->h . " hours ago";
						}
					}
					else if($interval->i >= 1) {
						if($interval->i == 1) {
							$time_message = $interval->i . " minute ago";
						}
						else {
							$time_message = $interval->i . " minutes ago";
						}
					}
					else {
						if($interval->s < 30) {
							$time_message = "Just now";
						}
						else {
							$time_message = $interval->s . " seconds ago";
						}
					}

					foreach ($applicants as $row) {

					$applicant_id = $row['user_id'];
					$user_details_query = $this->con->prepare("SELECT users.*, nationalities.* FROM users 
					INNER JOIN nationalities ON users.user_id=nationalities.user_id 
					WHERE users.user_id=?");
					$user_details_query->execute([$applicant_id]);
					$user_row = $user_details_query->fetch();
					$first_name = $user_row['first_name'];
					$last_name = $user_row['last_name'];
					$profile_pic = $user_row['profile_pic'];
					$username = $user_row['username'];
					$verified = $user_row['verified'];
					$country_flag = $user_row['nationality'];
					$country_name = $user_row['country_name'];

					echo "<li>
							<!-- Overview -->
							<div class='freelancer-overview manage-candidates'>
								<div class='freelancer-overview-inner'>

									<!-- Avatar -->
									<div class='freelancer-avatar'>
										<div class=''></div>
										<a href='$username'><img src='$profile_pic' alt=''></a>
									</div>

									<!-- Name -->
									<div class='freelancer-name'>
										<h4><a href='$username'>$first_name $last_name <img class='flag' src='assets/images/flags/$country_flag.svg' alt='' title='$country_name' data-tippy-placement='top'></a></h4>

										<!-- Buttons -->
										<div class='buttons-to-right always-visible margin-top-25 margin-bottom-5'>
											<a href='#' class='button ripple-effect'><i class='icon-feather-file-text'></i> Download CV</a>
											<a href='#small-dialog' class='popup-with-zoom-anim button dark ripple-effect'><i class='icon-feather-mail'></i> Send Message</a>
											<a href='#' class='button gray ripple-effect ico' title='Remove Candidate' data-tippy-placement='top'><i class='icon-feather-trash-2'></i></a>
										</div>
									</div>
								</div>
							</div>
						</li>";
						}
				
				?>
				<script>
				
					$(document).ready(function() {

						$('#job<?php echo $id; ?>').on('click', function() {
							bootbox.confirm("Are you sure you want to delete this job?", function(result) {

								$.job("includes/form_handlers/delete_post.php?job_id=<?php echo $id; ?>", {result:result});

								if(result)
									location.reload();

							})
						})



					});	

				</script>
				<?php

		}
		else {
			echo "<h3>No Applicants yet.</h3>";
			return;
		}

		echo $str;

	}

	}

 ?>