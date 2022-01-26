<?php
include("includes/header.php");
include("includes/form_handlers/settings_handler.php");
?>




<!doctype html>
<html lang="en">
<head>

<!-- Basic Page Needs
================================================== -->
<title>Hireo</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/colors/blue.css">
<link rel="stylesheet" href="assets/vendor/flatpickr/dist/flatpickr.css">

</head>
<body class="gray">

<!-- Wrapper -->
<div id="wrapper">


<!-- Dashboard Container -->
<div class="dashboard-container">

	<?php include("includes/side_menu.php"); ?>

	<!-- Dashboard Content
	================================================== -->
	<div class="dashboard-content-container" data-simplebar>
		<div class="dashboard-content-inner" >
			
			<!-- Dashboard Headline -->
			<div class="dashboard-headline">
				<h3>Settings</h3>
			</div>
	
			<!-- Row -->
			<div class="row">

				<?php 

					$attachments_query = $con->prepare("SELECT id, original, type FROM profile_attachments WHERE user_id=? ORDER BY id DESC");
					$attachments_query->execute([$userLoggedIn]);
					$attachments = $attachments_query->fetchAll();

					$user_data_query = $con->prepare("SELECT first_name, last_name, email FROM users WHERE user_id=?");
					$user_data_query->execute([$userLoggedIn]);
					$row = $user_data_query->fetch();

					$queryNationality = $con->prepare("SELECT nationality FROM nationalities WHERE user_id=? LIMIT 1");
					$queryNationality->execute([$userLoggedIn]);

					if ($queryNationality->rowCount() == 0) {
						$user_nationality = ['nationality' => ''];
					}else{
						$user_nationality = $queryNationality->fetch();
					}					

					$first_name = $row['first_name'];
					$last_name = $row['last_name'];
					$email = $row['email'];
					$username = $user['username'];
					$prof_type = $user['profile_type'];
					$sport = $user['sport'];
					$website = $user['website'];
					$tagline = $user['tagline'];
					$about = $user['about'];

					$coach = $individual_user['coach'];
					$scout = $individual_user['scout'];
					$agent = $individual_user['agent'];
				?>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div class="dashboard-box margin-top-0">

						<!-- Headline -->
						<div class="headline">
							<h3>Account</h3>
						</div>

						<div class="content with-padding padding-bottom-0">

							<div class="row">

								<div class="col-xl-12">
									<div class="submit-field">
									<h5>Profile Image</h5>
										<div class="media-body image-field">
											<form action="upload_profile_pic.php" method="POST" enctype="multipart/form-data" id="profile-img">
												<div class="avatar-wrapper" data-tippy-placement="bottom" title="Change Picture">
													<img class="profile-pic" src="<?php echo $user['profile_pic']; ?>" alt=""/>
													<div class="upload-button"></div>
													<input class="file-upload" type="file" accept="image/*" id="profile-img-file" name="image"/>
												</div>
											</form>
			                                <a class="btn btn-sm btn-white mb-2 mb-sm-0 popup-with-zoom-anim" href="#small-dialog">Remove</a>
			                             </div>
									</div>
								</div>

								<form class="settings-form" method="POST" style="display: contents;">
								<input type="hidden" name="update_details" value="1" />
								<div class="col">
									<div class="row">

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>First Name</h5>
												<input type="text" class="with-border" name="first_name" value="<?php echo $first_name; ?>" id="settings_input">
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Last Name</h5>
												<input type="text" class="with-border" name="last_name" value="<?php echo $last_name; ?>" id="settings_input">
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Email</h5>
												<input type="text" class="with-border" name="email" value="<?php echo $email; ?>" id="settings_input">
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Username</h5>
												<input type="text" class="with-border" name="username" value="<?php echo $username; ?>" id="settings_input">
											</div>
										</div>

										<div class="col-xl-12">
											<div class="submit-field">
												<h5>Select Your Profile</h5>
												<?php if ($prof_type == 1) { ?>
														<div>
															<div class="section-headline margin-top-25 margin-bottom-12">
																<h5>Professional</h5>
															</div>
															<div class="checkbox form-control">
																<input type="checkbox" name="coach" value="yes" id="checkbox2" <?php if ($coach == "yes") echo "checked=checked"; ?>>
																<label for="checkbox2"><span class="checkbox-icon"></span> Coach</label>
															</div>
															<div class="checkbox form-control">
																<input type="checkbox" name="scout" value="yes" id="checkbox3" <?php if ($scout == "yes") echo "checked=checked"; ?>>
																<label for="checkbox3"><span class="checkbox-icon"></span> Scout</label>
															</div>
															<div class="checkbox form-control">
																<input type="checkbox" name="agent" value="yes" id="checkbox4" <?php if ($agent == "yes") echo "checked=checked"; ?>>
																<label for="checkbox4"><span class="checkbox-icon"></span> Intermediary (Agent)</label>
															</div>
														</div>
													<?php } ?>

													<?php if ($prof_type == 2) { ?>
														<div class="col-xl-12 col-md-12">
															<div class="section-headline margin-top-25 margin-bottom-12">
																<h5>Organisation</h5>
															</div>
															<div class="checkbox form-control">
																<input type="checkbox" name="pro_club" value="yes" id="checkbox7">
																<label for="checkbox7"><span class="checkbox-icon"></span> Professional Club</label>
															</div>
															<div class="checkbox form-control">
																<input type="checkbox" name="amateur_club" value="yes" id="checkbox6">
																<label for="checkbox6"><span class="checkbox-icon"></span> Amateur Club</label>
															</div>
															<br>
															<div class="checkbox form-control">
																<input type="checkbox" name="academy" value="yes" id="checkbox8">
																<label for="checkbox8"><span class="checkbox-icon"></span> Academy</label>
															</div>
														</div>
													<?php } ?>
											</div>
										</div>

									<div class="col-xl-6">
										<div class="submit-field">
											<h5>Nationality</h5>
											<select class="selectpicker with-border" name="nationality" data-size="7" title="Select Nationality" data-live-search="true">
												<option value='|' selected>Select Your Nationality</option>
												<option value="ar|Argentina" <?php if ($user_nationality['nationality'] == 'ar') echo "selected=selected"; ?>>Argentina</option>
												<option value="am|Armenia" <?php if ($user_nationality['nationality'] == 'am') echo "selected=selected"; ?>>Armenia</option>
												<option value="aw|Aruba" <?php if ($user_nationality['nationality'] == 'aw') echo "selected=selected"; ?>>Aruba</option>
												<option value="au|Australia" <?php if ($user_nationality['nationality'] == 'au') echo "selected=selected"; ?>>Australia</option>
												<option value="at|Austria" <?php if ($user_nationality['nationality'] == 'at') echo "selected=selected"; ?>>Austria</option>
												<option value="az|Azerbaijan" <?php if ($user_nationality['nationality'] == 'az') echo "selected=selected"; ?>>Azerbaijan</option>
												<option value="bs|Bahamas" <?php if ($user_nationality['nationality'] == 'bs') echo "selected=selected"; ?>>Bahamas</option>
												<option value="bh|Bahrain" <?php if ($user_nationality['nationality'] == 'bh') echo "selected=selected"; ?>>Bahrain</option>
												<option value="bd|Bangladesh" <?php if ($user_nationality['nationality'] == 'bd') echo "selected=selected"; ?>>Bangladesh</option>
												<option value="bb|Barbados" <?php if ($user_nationality['nationality'] == 'bb') echo "selected=selected"; ?>>Barbados</option>
												<option value="by|Belarus" <?php if ($user_nationality['nationality'] == 'by') echo "selected=selected"; ?>>Belarus</option>
												<option value="be|Belgium" <?php if ($user_nationality['nationality'] == 'be') echo "selected=selected"; ?>>Belgium</option>
												<option value="bz|Belize" <?php if ($user_nationality['nationality'] == 'bz') echo "selected=selected"; ?>>Belize</option>
												<option value="bj|Benin" <?php if ($user_nationality['nationality'] == 'bj') echo "selected=selected"; ?>>Benin</option>
												<option value="bm|Bermuda" <?php if ($user_nationality['nationality'] == 'bm') echo "selected=selected"; ?>>Bermuda</option>
												<option value="bt|Bhutan" <?php if ($user_nationality['nationality'] == 'bt') echo "selected=selected"; ?>>Bhutan</option>
												<option value="bg|Bulgaria" <?php if ($user_nationality['nationality'] == 'bg') echo "selected=selected"; ?>>Bulgaria</option>
												<option value="bf|Burkina Faso" <?php if ($user_nationality['nationality'] == 'bf') echo "selected=selected"; ?>>Burkina Faso</option>
												<option value="bi|Burundi" <?php if ($user_nationality['nationality'] == 'bi') echo "selected=selected"; ?>>Burundi</option>
												<option value="kh|Cambodia" <?php if ($user_nationality['nationality'] == 'kh') echo "selected=selected"; ?>>Cambodia</option>
												<option value="cm|Cameroon" <?php if ($user_nationality['nationality'] == 'cm') echo "selected=selected"; ?>>Cameroon</option>
												<option value="ca|Canada" <?php if ($user_nationality['nationality'] == 'ca') echo "selected=selected"; ?>>Canada</option>
												<option value="cv|Cape Verde" <?php if ($user_nationality['nationality'] == 'cv') echo "selected=selected"; ?>>Cape Verde</option>
												<option value="ky|Cayman Islands" <?php if ($user_nationality['nationality'] == 'ky') echo "selected=selected"; ?>>Cayman Islands</option>
												<option value="co|Colombia" <?php if ($user_nationality['nationality'] == 'co') echo "selected=selected"; ?>>Colombia</option>
												<option value="km|Comoros" <?php if ($user_nationality['nationality'] == 'km') echo "selected=selected"; ?>>Comoros</option>
												<option value="cg|Congo" <?php if ($user_nationality['nationality'] == 'cg') echo "selected=selected"; ?>>Congo</option>
												<option value="ck|Cook Islands" <?php if ($user_nationality['nationality'] == 'ck') echo "selected=selected"; ?>>Cook Islands</option>
												<option value="cr|Costa Rica" <?php if ($user_nationality['nationality'] == 'cr') echo "selected=selected"; ?>>Costa Rica</option>
												<option value="ci|Côte d'Ivoire" <?php if ($user_nationality['nationality'] == 'ci') echo "selected=selected"; ?>>Côte d'Ivoire</option>
												<option value="hr|Croatia" <?php if ($user_nationality['nationality'] == 'hr') echo "selected=selected"; ?>>Croatia</option>
												<option value="cu|Cuba" <?php if ($user_nationality['nationality'] == 'cu') echo "selected=selected"; ?>>Cuba</option>
												<option value="cw|Curaçao" <?php if ($user_nationality['nationality'] == 'cw') echo "selected=selected"; ?>>Curaçao</option>
												<option value="cy|Cyprus" <?php if ($user_nationality['nationality'] == 'cy') echo "selected=selected"; ?>>Cyprus</option>
												<option value="cz|Czech Republic" <?php if ($user_nationality['nationality'] == 'cz') echo "selected=selected"; ?>>Czech Republic</option>
												<option value="dk|Denmark" <?php if ($user_nationality['nationality'] == 'dk') echo "selected=selected"; ?>>Denmark</option>
												<option value="dj|Djibouti" <?php if ($user_nationality['nationality'] == 'dj') echo "selected=selected"; ?>>Djibouti</option>
												<option value="dm|Dominica" <?php if ($user_nationality['nationality'] == 'dm') echo "selected=selected"; ?>>Dominica</option>
												<option value="do|Dominican Republic" <?php if ($user_nationality['nationality'] == 'do') echo "selected=selected"; ?>>Dominican Republic</option>
												<option value="ec|Ecuador" <?php if ($user_nationality['nationality'] == 'ec') echo "selected=selected"; ?>>Ecuador</option>
												<option value="eg|Egypt" <?php if ($user_nationality['nationality'] == 'eg') echo "selected=selected"; ?>>Egypt</option>
												<option value="gp|Guadeloupe" <?php if ($user_nationality['nationality'] == 'gp') echo "selected=selected"; ?>>Guadeloupe</option>
												<option value="gu|Guam" <?php if ($user_nationality['nationality'] == 'gu') echo "selected=selected"; ?>>Guam</option>
												<option value="gt|Guatemala" <?php if ($user_nationality['nationality'] == 'gt') echo "selected=selected"; ?>>Guatemala</option>
												<option value="gg|Guernsey" <?php if ($user_nationality['nationality'] == 'gg') echo "selected=selected"; ?>>Guernsey</option>
												<option value="gn|Guinea" <?php if ($user_nationality['nationality'] == 'gn') echo "selected=selected"; ?>>Guinea</option>
												<option value="gw|Guinea-Bissau" <?php if ($user_nationality['nationality'] == 'gw') echo "selected=selected"; ?>>Guinea-Bissau</option>
												<option value="gy|Guyana" <?php if ($user_nationality['nationality'] == 'gy') echo "selected=selected"; ?>>Guyana</option>
												<option value="ht|Haiti" <?php if ($user_nationality['nationality'] == 'ht') echo "selected=selected"; ?>>Haiti</option>
												<option value="hn|Honduras" <?php if ($user_nationality['nationality'] == 'hn') echo "selected=selected"; ?>>Honduras</option>
												<option value="hk|Hong Kong" <?php if ($user_nationality['nationality'] == 'hk') echo "selected=selected"; ?>>Hong Kong</option>
												<option value="hu|Hungary" <?php if ($user_nationality['nationality'] == 'hu') echo "selected=selected"; ?>>Hungary</option>
												<option value="is|Iceland" <?php if ($user_nationality['nationality'] == 'is') echo "selected=selected"; ?>>Iceland</option>
												<option value="in|India" <?php if ($user_nationality['nationality'] == 'in') echo "selected=selected"; ?>>India</option>
												<option value="id|Indonesia" <?php if ($user_nationality['nationality'] == 'id') echo "selected=selected"; ?>>Indonesia</option>
												<option value="no|Norway" <?php if ($user_nationality['nationality'] == 'no') echo "selected=selected"; ?>>Norway</option>
												<option value="om|Oman" <?php if ($user_nationality['nationality'] == 'om') echo "selected=selected"; ?>>Oman</option>
												<option value="pk|Pakistan" <?php if ($user_nationality['nationality'] == 'pk') echo "selected=selected"; ?>>Pakistan</option>
												<option value="pw|Palau" <?php if ($user_nationality['nationality'] == 'pw') echo "selected=selected"; ?>>Palau</option>
												<option value="pa|Panama" <?php if ($user_nationality['nationality'] == 'pa') echo "selected=selected"; ?>>Panama</option>
												<option value="pg|Papua New Guinea" <?php if ($user_nationality['nationality'] == 'pg') echo "selected=selected"; ?>>Papua New Guinea</option>
												<option value="py|Paraguay" <?php if ($user_nationality['nationality'] == 'py') echo "selected=selected"; ?>>Paraguay</option>
												<option value="pe|Peru" <?php if ($user_nationality['nationality'] == 'pe') echo "selected=selected"; ?>>Peru</option>
												<option value="ph|Philippines" <?php if ($user_nationality['nationality'] == 'ph') echo "selected=selected"; ?>>Philippines</option>
												<option value="pn|Pitcairn" <?php if ($user_nationality['nationality'] == 'pn') echo "selected=selected"; ?>>Pitcairn</option>
												<option value="pl|Poland" <?php if ($user_nationality['nationality'] == 'pl') echo "selected=selected"; ?>>Poland</option>
												<option value="pt|Portugal" <?php if ($user_nationality['nationality'] == 'pt') echo "selected=selected"; ?>>Portugal</option>
												<option value="pr|Puerto Rico" <?php if ($user_nationality['nationality'] == 'pr') echo "selected=selected"; ?>>Puerto Rico</option>
												<option value="qa|Qatar" <?php if ($user_nationality['nationality'] == 'qa') echo "selected=selected"; ?>>Qatar</option>
												<option value="re|Réunion" <?php if ($user_nationality['nationality'] == 're') echo "selected=selected"; ?>>Réunion</option>
												<option value="ro|Romania" <?php if ($user_nationality['nationality'] == 'ro') echo "selected=selected"; ?>>Romania</option>
												<option value="ru|Russian Federation" <?php if ($user_nationality['nationality'] == 'ru') echo "selected=selected"; ?>>Russian Federation</option>
												<option value="rw|Rwanda" <?php if ($user_nationality['nationality'] == 'rw') echo "selected=selected"; ?>>Rwanda</option>
												<option value="sz|Swaziland" <?php if ($user_nationality['nationality'] == 'sz') echo "selected=selected"; ?>>Swaziland</option>
												<option value="se|Sweden" <?php if ($user_nationality['nationality'] == 'se') echo "selected=selected"; ?>>Sweden</option>
												<option value="ch|Switzerland" <?php if ($user_nationality['nationality'] == 'ch') echo "selected=selected"; ?>>Switzerland</option>
												<option value="tr|Turkey" <?php if ($user_nationality['nationality'] == 'tr') echo "selected=selected"; ?>>Turkey</option>
												<option value="tm|Turkmenistan" <?php if ($user_nationality['nationality'] == 'tm') echo "selected=selected"; ?>>Turkmenistan</option>
												<option value="tv|Tuvalu" <?php if ($user_nationality['nationality'] == 'tv') echo "selected=selected"; ?>>Tuvalu</option>
												<option value="ug|Uganda" <?php if ($user_nationality['nationality'] == 'ug') echo "selected=selected"; ?>>Uganda</option>
												<option value="ua|Ukraine" <?php if ($user_nationality['nationality'] == 'ua') echo "selected=selected"; ?>>Ukraine</option>
												<option value="gb|United Kingdom" <?php if ($user_nationality['nationality'] == 'gb') echo "selected=selected"; ?>>United Kingdom</option>
												<option value="us|United States" <?php if ($user_nationality['nationality'] == 'us') echo "selected=selected"; ?>>United States</option>
												<option value="uy|Uruguay" <?php if ($user_nationality['nationality'] == 'uy') echo "selected=selected"; ?>>Uruguay</option>
												<option value="uz|Uzbekistan" <?php if ($user_nationality['nationality'] == 'uz') echo "selected=selected"; ?>>Uzbekistan</option>
												<option value="ye|Yemen" <?php if ($user_nationality['nationality'] == 'ye') echo "selected=selected"; ?>>Yemen</option>
												<option value="zm|Zambia" <?php if ($user_nationality['nationality'] == 'zm') echo "selected=selected"; ?>>Zambia</option>
												<option value="zw|Zimbabwe" <?php if ($user_nationality['nationality'] == 'zw') echo "selected=selected"; ?>>Zimbabwe</option>
											</select>
										</div>
									</div>


									<div class="col-xl-12">
										<div class="submit-field">
											<h5>Introduce Yourself</h5>
											<textarea cols="30" rows="5" class="with-border" name="about" placeholder="Write about yourself for users that visit your profile."><?php echo $about; ?></textarea>
										</div>
									</div>
									
									</div>
								</div>								
				
									<!-- Button -->
									<div class="col-xl-12 mb-4 save-submit">
										<div class="return-message"></div>
										<button class="btn btn-primary ripple-effect save-details" type="submit">											
											<i class="fas fa-sync fa-lg fa-spin"></i>
											<i class="fas fa-save fa-lg ico-save"></i>
											<span class="text">Save Changes</span>
										</button>										
									</div>

								</form>
							</div>

						</div>
					</div>
				</div>


				<?php if ($prof_type == 1) { ?>
					<div class="col-xl-12">
					<div class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-face"></i> Individual Profile</h3>
						</div>

						<div class="content with-padding padding-bottom-0">

							<div class="row">

								<form class="settings-form" method="POST" style="display: contents;">
								<input type="hidden" name="update_individual" value="1" />
								<div class="col">
									<div class="row">

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Birth Date</h5>
												<!-- Flatpickr -->

						                            <input type="date" value="<?php if ($individual_user['birth'] != '0000-00-00') echo $individual_user['birth']; ?>" class="flatpickr-custom-form-control form-control with-border" name="birth_date" placeholder="Select Birth Date" id="birthDate" data-input>
						                          
						                        <!-- End Flatpickr -->
						                    </div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Gender</h5>
												<select class="selectpicker with-border" name="gender" data-size="7">
													<option value="" selected>Select Your Gender</option>
													<option value="M" <?php if ($individual_user['gender'] == 'M') echo "selected=selected"; ?>>Male</option>
													<option value="F" <?php if ($individual_user['gender'] == 'F') echo "selected=selected"; ?>>Female</option>
												</select>
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Country & City  <i class="help-icon" data-tippy-placement="right" title="Where You Are Based In"></i></h5>


													<div class="submit-field">
														<select class="selectpicker with-border" name="country_based" data-size="7" title="Select Country" data-live-search="true" id="country_based">
															<option value='' selected>Select Country</option>
															<option value="England" <?php if ($individual_user['country_based'] == 'England') echo "selected=selected"; ?>>England</option>
															<option value="Northern Ireland" <?php if ($individual_user['country_based'] == 'Northern Ireland') echo "selected=selected"; ?>>Northern Ireland</option>
															<option value="Scotland" <?php if ($individual_user['country_based'] == 'Scotland') echo "selected=selected"; ?>>Scotland</option>
															<option value="Wales" <?php if ($individual_user['country_based'] == 'Wales') echo "selected=selected"; ?>>Wales</option>
														</select>
													</div>


												<div class="input-with-icon" id="city_div" style="display: none;">
													<div id="autocomplete-container" class="search-box">
														<i class="icon-material-outline-location-on"></i>
														<input type="text" value="<?php if ($individual_user['city_based'] != '') echo $individual_user['city_based'] . ', ' . $individual_user['county_based']; ?>" class="with-border" name="city_based" id="city_based" placeholder="Type..." autocomplete="off">
														<i class="icon-material-outline-location-on"></i>
														<div class="result"></div>
													</div>
													<i class="icon-material-outline-location-on"></i>
												</div>
												
											</div>
										</div>

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Attachments</h5>
												
												<!-- Attachments -->
												<div class="attachments-container margin-top-0 margin-bottom-0" id="attachments-container">
													<?php foreach($attachments AS $attachment){ ?>
														<div class="attachment-box ripple-effect" id="attachment_<?php echo $attachment['id']; ?>">
															<span><a href="settings_update.php?download_attachment_id=<?php echo $attachment['id']; ?>"><?php echo $attachment['original']; ?></a></span>
															<i><?php echo strtoupper($attachment['type']); ?></i>
															<button class="remove-attachment" data-tippy-placement="top" data-id="<?php echo $attachment['id']; ?>" title="Remove"></button>
														</div>													
													<?php } ?>
												</div>
												<div class="clearfix"></div>
												
												<!-- Upload Button -->
												<div class="uploadButton margin-top-0">
													<input class="uploadButton-input" type="file" accept=".png,.jpg,.jpeg,.gif,.pdf,.doc,.docx" id="attachment-upload" multiple />
													<label class="uploadButton-button ripple-effect" for="attachment-upload" id="attachment-upload-label">
														<i class="fas fa-sync fa-sm fa-spin"></i>
														<i class="fas fa-cloud-upload-alt fa-lg ico-save"></i>
														<span>Upload Files</span>
													</label>
													<span class="uploadButton-file-name">Maximum file size: 10 MB</span>
												</div>

											</div>
										</div>

									</div>
								</div>

								<!-- Button -->
								<div class="col-xl-12 mb-4 save-submit">
										<div class="return-message"></div>
										<button class="btn btn-primary ripple-effect save-details" type="submit">											
											<i class="fas fa-sync fa-lg fa-spin"></i>
											<i class="fas fa-save fa-lg ico-save"></i>
											<span class="text">Save Changes</span>
										</button>										
									</div>
								</form>
									
								
							</div>

						</div>
						
					</div>
				</div>
				<?php } ?>


				<?php if ($prof_type == 2) { ?>
					<div class="col-xl-12">
					<div class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-location-on"></i> Organisation Profile</h3>
						</div>

						<div class="content with-padding padding-bottom-0">

							<div class="row">

								<form class="settings-form" method="POST" style="display: contents;">
								<input type="hidden" name="update_individual" value="1" />

								<form action="settings.php" method="POST" style="display: contents;">
								<div class="col">
									<div class="row">

										<div class="col-xl-6">
											<div class="submit-field">
												<h5>Sport</h5>
												<select class="selectpicker with-border" data-size="7" title="Select Sport" data-live-search="true">
													<option value="Football">Football</option>
												</select>
											</div>
										</div>

									</div>
								</div>
								<!-- Button -->
								<div class="col-xl-12 mb-4 save-submit">
										<div class="return-message"></div>
										<button class="btn btn-primary ripple-effect save-details" type="submit">											
											<i class="fas fa-sync fa-lg fa-spin"></i>
											<i class="fas fa-save fa-lg ico-save"></i>
											<span class="text">Save Changes</span>
										</button>										
									</div>								
								</form>
							</div>

						</div>
						
					</div>
				</div>
				<?php } ?>



				<!-- Dashboard Box -->
				<?php if ($coach == 'yes' || $scout == 'yes' || $agent == 'yes') { ?>
				<div class="col-xl-12">
					<div class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-person-pin"></i> Professional Profile</h3>
						</div>

						<div class="content with-padding">
							<form class="settings-form" action="settings.php" method="POST">
							<input type="hidden" name="update_work" value="1" />
							<div class="row">

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Job Title</h5>
										<input type="text" name="pro_work_title" class="with-border" value="" required>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>Company</h5>
										<input type="text" name="pro_work_company" class="with-border" value="" required>
									</div>
								</div>

								<div class="col-xl-6">
									<div class="submit-field">
										<h5>From</h5>
										<div class="row">
											<div class="col-xl-6">
													<select class="selectpicker with-border" name="pro_work_from_month" data-size="7" title="Select Month">
														<option value="January">January</option>
														<option value="February">February</option>
														<option value="March">March</option>
														<option value="April">April</option>
														<option value="May">May</option>
														<option value="June">June</option>
														<option value="July">July</option>
														<option value="August">August</option>
														<option value="September">September</option>
														<option value="October">October</option>
														<option value="November">November</option>
														<option value="December">December</option>
													</select>
												</div>
												<div class="col-xl-6">
														<select class="selectpicker with-border" name="pro_work_from_year" data-size="7" title="Select Year">
															<option value="2021">2021</option>
															<option value="2020">2020</option>
															<option value="2019">2019</option>
															<option value="2018">2018</option>
															<option value="2017">2017</option>
															<option value="2016">2016</option>
															<option value="2015">2015</option>
															<option value="2014">2014</option>
															<option value="2013">2013</option>
															<option value="2012">2012</option>
															<option value="2011">2011</option>
															<option value="2010">2010</option>
															<option value="2009">2009</option>
															<option value="2008">2008</option>
															<option value="2007">2007</option>
															<option value="2006">2006</option>
															<option value="2005">2005</option>
															<option value="2004">2004</option>
															<option value="2003">2003</option>
															<option value="2002">2002</option>
															<option value="2001">2001</option>
															<option value="2000">2000</option>
															<option value="1999">1999</option>
															<option value="1998">1998</option>
															<option value="1997">1997</option>
															<option value="1996">1996</option>
															<option value="1995">1995</option>
															<option value="1994">1994</option>
															<option value="1993">1993</option>
															<option value="1992">1992</option>
															<option value="1991">1991</option>
															<option value="1990">1990</option>
															<option value="1989">1989</option>
															<option value="1988">1988</option>
															<option value="1987">1987</option>
															<option value="1986">1986</option>
															<option value="1985">1985</option>
															<option value="Older">Older</option>
														</select>
												</div>
											</div>
										</div>
									</div>

									<div class="col-xl-6">
									<div class="submit-field">
										<h5>To</h5>
										<div class="row">
											<div class="col-xl-6">
													<select class="selectpicker with-border option-req" name="pro_work_to_month" data-size="7" title="Select Month" required>
														<option value="January">January</option>
														<option value="February">February</option>
														<option value="March">March</option>
														<option value="April">April</option>
														<option value="May">May</option>
														<option value="June">June</option>
														<option value="July">July</option>
														<option value="August">August</option>
														<option value="September">September</option>
														<option value="October">October</option>
														<option value="November">November</option>
														<option value="December">December</option>
													</select>
												</div>
												<div class="col-xl-6">
														<select class="selectpicker with-border option-req" name="pro_work_to_year" data-size="7" title="Select Year" required>
															<option value="2021">2021</option>
															<option value="2020">2020</option>
															<option value="2019">2019</option>
															<option value="2018">2018</option>
															<option value="2017">2017</option>
															<option value="2016">2016</option>
															<option value="2015">2015</option>
															<option value="2014">2014</option>
															<option value="2013">2013</option>
															<option value="2012">2012</option>
															<option value="2011">2011</option>
															<option value="2010">2010</option>
															<option value="2009">2009</option>
															<option value="2008">2008</option>
															<option value="2007">2007</option>
															<option value="2006">2006</option>
															<option value="2005">2005</option>
															<option value="2004">2004</option>
															<option value="2003">2003</option>
															<option value="2002">2002</option>
															<option value="2001">2001</option>
															<option value="2000">2000</option>
															<option value="1999">1999</option>
															<option value="1998">1998</option>
															<option value="1997">1997</option>
															<option value="1996">1996</option>
															<option value="1995">1995</option>
															<option value="1994">1994</option>
															<option value="1993">1993</option>
															<option value="1992">1992</option>
															<option value="1991">1991</option>
															<option value="1990">1990</option>
															<option value="1989">1989</option>
															<option value="1988">1988</option>
															<option value="1987">1987</option>
															<option value="1986">1986</option>
															<option value="1985">1985</option>
															<option value="Older">Older</option>
														</select>
												</div>
											</div>
											<div class="checkbox form-control margin-top-10">
												<input type="checkbox" class="checkbox checkbox_work_current" name="pro_work_current" value="yes" id="checkbox_work_current">
												<label for="checkbox_work_current"><span class="checkbox-icon"></span> I currently work here</label>
											</div>
										</div>
									</div>

								<div class="col-xl-6">
										<div class="submit-field">
											<h5>Country</h5>
											<select class="selectpicker with-border" name="pro_work_country" data-size="7" title="Select Country" data-live-search="true" required>
												<option value="Argentina">Argentina</option>
												<option value="Armenia">Armenia</option>
												<option value="Aruba">Aruba</option>
												<option value="Australia">Australia</option>
												<option value="Austria">Austria</option>
												<option value="Azerbaijan">Azerbaijan</option>
												<option value="Bahamas">Bahamas</option>
												<option value="Bahrain">Bahrain</option>
												<option value="Bangladesh">Bangladesh</option>
												<option value="Barbados">Barbados</option>
												<option value="Belarus">Belarus</option>
												<option value="Belgium">Belgium</option>
												<option value="Belize">Belize</option>
												<option value="Benin">Benin</option>
												<option value="Bermuda">Bermuda</option>
												<option value="Bhutan">Bhutan</option>
												<option value="Bulgaria">Bulgaria</option>
												<option value="Burkina Faso">Burkina Faso</option>
												<option value="Burundi">Burundi</option>
												<option value="Cambodia">Cambodia</option>
												<option value="Cameroon">Cameroon</option>
												<option value="Canada">Canada</option>
												<option value="Cape Verde">Cape Verde</option>
												<option value="Cayman Islands">Cayman Islands</option>
												<option value="Colombia">Colombia</option>
												<option value="Comoros">Comoros</option>
												<option value="Congo">Congo</option>
												<option value="Cook Islands">Cook Islands</option>
												<option value="Costa Rica">Costa Rica</option>
												<option value="Côte d'Ivoire">Côte d'Ivoire</option>
												<option value="Croatia">Croatia</option>
												<option value="Cuba">Cuba</option>
												<option value="Curaçao">Curaçao</option>
												<option value="Cyprus">Cyprus</option>
												<option value="Czech Republic">Czech Republic</option>
												<option value="Denmark">Denmark</option>
												<option value="Djibouti">Djibouti</option>
												<option value="Dominica">Dominica</option>
												<option value="Dominican Republic">Dominican Republic</option>
												<option value="Ecuador">Ecuador</option>
												<option value="Egypt">Egypt</option>
												<option value="Guadeloupe">Guadeloupe</option>
												<option value="Guam">Guam</option>
												<option value="Guatemala">Guatemala</option>
												<option value="Guernsey">Guernsey</option>
												<option value="Guinea">Guinea</option>
												<option value="Guinea-Bissau">Guinea-Bissau</option>
												<option value="Guyana">Guyana</option>
												<option value="Haiti">Haiti</option>
												<option value="Honduras">Honduras</option>
												<option value="Hong Kong">Hong Kong</option>
												<option value="Hungary">Hungary</option>
												<option value="Iceland">Iceland</option>
												<option value="India">India</option>
												<option value="Indonesia">Indonesia</option>
												<option value="Norway">Norway</option>
												<option value="Oman">Oman</option>
												<option value="Pakistan">Pakistan</option>
												<option value="Palau">Palau</option>
												<option value="Panama">Panama</option>
												<option value="Papua New Guinea">Papua New Guinea</option>
												<option value="Paraguay">Paraguay</option>
												<option value="Peru">Peru</option>
												<option value="Philippines">Philippines</option>
												<option value="Pitcairn">Pitcairn</option>
												<option value="Poland">Poland</option>
												<option value="Portugal">Portugal</option>
												<option value="Puerto Rico">Puerto Rico</option>
												<option value="Qatar">Qatar</option>
												<option value="Réunion">Réunion</option>
												<option value="Romania">Romania</option>
												<option value="Russian Federation">Russian Federation</option>
												<option value="Rwanda">Rwanda</option>
												<option value="Swaziland">Swaziland</option>
												<option value="Sweden">Sweden</option>
												<option value="Switzerland">Switzerland</option>
												<option value="Turkey">Turkey</option>
												<option value="Turkmenistan">Turkmenistan</option>
												<option value="Tuvalu">Tuvalu</option>
												<option value="Uganda">Uganda</option>
												<option value="Ukraine">Ukraine</option>
												<option value="United Kingdom">United Kingdom</option>
												<option value="United States">United States</option>
												<option value="Uruguay">Uruguay</option>
												<option value="Uzbekistan">Uzbekistan</option>
												<option value="Yemen">Yemen</option>
												<option value="Zambia">Zambia</option>
												<option value="Zimbabwe">Zimbabwe</option>
											</select>
										</div>
									</div>

									<div class="col-xl-6">
										<div class="submit-field">
											<h5>Description</h5>
											<textarea cols="30" rows="4" class="with-border" name="pro_work_description" placeholder="Describe your position and any relevant accomplishments..."></textarea>
										</div>
									</div>

									<!-- Button -->
									<div class="col-xl-12 mb-4 save-submit">
											<div class="return-message"></div>
											<button class="btn btn-primary ripple-effect save-details" type="submit">											
												<i class="fas fa-sync fa-lg fa-spin"></i>
												<i class="fas fa-plus fa-lg ico-save"></i>
												<span class="text">Add Work Experience</span>
											</button>										
										</div>
									</form>

							</div>
							</form>
						</div>

					</div>
				</div>
				<?php } ?>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div id="test1" class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-lock"></i> Password & Security</h3>
						</div>

						<div class="content with-padding">
							<div class="row">
								<form class="settings-form" method="POST" style="display: contents;">
								<input type="hidden" name="update_password" value="1" />
									<div class="col-xl-4">
										<div class="submit-field">
											<h5>Current Password</h5>
											<input type="password" name="old_password" class="with-border">
										</div>
									</div>

									<div class="col-xl-4">
										<div class="submit-field">
											<h5>New Password</h5>
											<input type="password" name="new_password_1" class="with-border">
										</div>
									</div>

									<div class="col-xl-4">
										<div class="submit-field">
											<h5>Repeat New Password</h5>
											<input type="password" name="new_password_2" class="with-border">
										</div>
									</div>

									<!-- Button -->
									<div class="col-xl-12 mb-4 save-submit">
											<div class="return-message"></div>
											<button class="btn btn-primary ripple-effect save-details" type="submit">											
												<i class="fas fa-sync fa-lg fa-spin"></i>
												<i class="fas fa-lock fa-lg ico-save"></i>
												<span class="text">Save Password</span>
											</button>										
										</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				<!-- Dashboard Box -->
				<div class="col-xl-12">
					<div id="test1" class="dashboard-box">

						<!-- Headline -->
						<div class="headline">
							<h3><i class="icon-material-outline-highlight-off"></i> Close Account</h3>
						</div>

						<div class="content with-padding">
							<div class="row">

								<div class="social-login-buttons">
									<form action="settings.php" method="POST" style="display: contents;">
										<button class="google-login ripple-effect" type="submit" name="close_account" id="close_account"><i class="icon-material-outline-highlight-off"></i> Close Account</button>
									</form>
								</div>

							</div>
						</div>
					</div>
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



<!-- Close Account popup
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">

	<!--Tabs -->
	<div class="sign-in-form">

		<ul class="popup-tabs-nav">
			<li><a href="#tab">Delete Profile Image</a></li>
		</ul>

		<div class="popup-tabs-container">

			<!-- Tab -->
			<div class="popup-tab-content" id="tab">
				
				<!-- Welcome Text -->
				<div class="welcome-text">
					<h4>Are you sure you want to delete your profile image?</h4>
				</div>
				
				<!-- Button -->
				<form action="settings.php" method="POST">
					<button class="button full-width button-sliding-icon ripple-effect" type="submit" name="delete_prof_img">Yes <i class="icon-material-outline-arrow-right-alt"></i></button>
				</form>

			</div>

		</div>
	</div>
</div>
<!-- Close Account popup / End -->


<!-- Scripts
================================================== -->
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
<script src="assets/vendor/flatpickr/dist/flatpickr.min.js"></script>

<script src="assets/js/front/hs.core.js"></script>
<script src="assets/js/front/hs.select2.js"></script>
<script src="assets/js/front/hs.flatpickr.js"></script>



<script>

	$('#birthDate').flatpickr({
	enableTime: false,
	static: true,
	altInput: true,
	altFormat: "F j, Y",
	dateFormat: "Y-m-d"
});

</script>


<script>
	document.getElementById("profile-img-file").onchange = function() {
    	document.getElementById("profile-img").submit();
	};
</script>

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


<script>
	$(document).ready(function(){
		if ($(`#country_based`).val().length) {
        	$("#city_div").show();
    	}
	});
</script>

<script>
	$(function () {
  $("#country_based").change(function() {
    var val = $(this).val();
    $("#city_based").val("");
    if(val != "") {
        $("#city_div").show();
    }
    else if(val === "") {
        $("#city_div").hide();
    }
  });
});
</script>

<script>
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){

    	var countryBased = $("#country_based").val();
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("includes/handlers/ajax_query_cities.php", {term: inputVal, country: countryBased}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
				resultDropdown.addClass('search-results-box');
            });
        } else{
			resultDropdown.removeClass('search-results-box');
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>


<script>
	$(document).ready(function () {
    $('.checkbox_work_current').change(function () {
        if ($(this).is(':checked')) {
            $('.option-req').removeAttr('required');
        }
    })
});
</script>

<script>
	$(document).ready(function () {
    $('.checkbox_edu_current').change(function () {
        if ($(this).is(':checked')) {
            $('.option-req').removeAttr('required');
        }
    })
});
</script>




</body>
</html>