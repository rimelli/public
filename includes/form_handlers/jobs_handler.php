<?php

//Declaring variables to prevent errors
$jb_title = ""; //Job title
$jb_category = ""; //Job category
$jb_position = ""; //Job position
$jb_type = ""; //Job type
$jb_country = ""; //Job country
$jb_city = ""; //Job city
$jb_salary = ""; //Job salary
$jb_salary_min = ""; //Job salary min
$jb_salary_max = ""; //Job salary max
$jb_description = ""; //Job description
$jb_employer_id = ""; //Job employer id
$jb_contact = ""; //Job employer contact email
$jb_website = ""; //Job employer website
$jb_employer_id = "";
$jb_date = ""; //Job post date
$error_array = array(); //Holds error messages

//  Remove job
if (isset($_GET['job_delete_id'])){	
	$query = $con->prepare("UPDATE jobs SET job_deleted = ? WHERE id = ? AND user_id = ? LIMIT 1");
	$query->execute(['yes', $_GET['job_delete_id'], $userLoggedIn]);	
	$id = $query->rowCount();

	if ($id){
		echo 'job_deleted';		
	}else{
		echo 'Could not delete the job';
	}

}

//  Add or Edit job
if(isset($_POST['post_job']) || (isset($_POST['edit_job']) && isset($_POST['job_id']) && is_numeric($_POST['job_id']))) {

	$type = isset($_POST['post_job']) ? 'add' : 'edit';

	//Job posting form values

	//Job Title
	$jb_title = strip_tags($_POST['reg_jbtitle']); //Remove html tags
	$_SESSION['reg_jbtitle'] = $jb_title; //Stores job title into session variable

	//Job Position
	$jb_position = strip_tags($_POST['reg_jbposition']); //Remove html tags
	$_SESSION['reg_jbposition'] = $jb_position; //Stores job position into session variable

	//Job Category
	$jb_category = strip_tags($_POST['reg_jbcategory']); //Remove html tags
	$_SESSION['reg_jbcategory'] = $jb_category; //Stores job category into session variable

	//Job Type
	$jb_type = strip_tags($_POST['reg_jbtype']); //Remove html tags
	$jb_type = str_replace(' ', '', $jb_type); //Remove spaces
	$_SESSION['reg_jbtype'] = $jb_type; //Stores job type into session variable

	//Job Country
	$jb_country = strip_tags($_POST['reg_jbcountry']); //Remove html tags
	$_SESSION['reg_jbcountry'] = $jb_country; //Stores job country into session variable

	//Job City
	$jb_city = strip_tags($_POST['reg_jbcity']); //Remove html tags
	$jb_city_explode = explode(',', $jb_city);
	$jb_city = trim($jb_city_explode[0]);
	$jb_county = trim($jb_city_explode[1]);

	//Job Salary
	$jb_salary = strip_tags($_POST['reg_jbsalary']); //Remove html tags
	$jb_salary = str_replace(' ', '', $jb_salary); //Remove spaces
	$_SESSION['reg_jbsalary'] = $jb_salary; //Stores job salary into session variable

	//Job Salary Min
	$jb_salary_min = strip_tags($_POST['reg_jbsalarymin']); //Remove html tags
	$jb_salary_min = str_replace(' ', '', $jb_salary_min); //Remove spaces
	$_SESSION['reg_jbsalarymin'] = $jb_salary_min; //Stores job salary min into session variable

	//Job Salary Max
	$jb_salary_max = strip_tags($_POST['reg_jbsalarymax']); //Remove html tags
	$jb_salary_max = str_replace(' ', '', $jb_salary_max); //Remove spaces
	$_SESSION['reg_jbsalarymax'] = $jb_salary_max; //Stores job salary max into session variable

	//Job Description
	$jb_description = strip_tags($_POST['reg_jbdescription']); //Remove html tags
	$_SESSION['reg_jbdescription'] = $jb_description; //Stores job description into session variable

	//Contact Email
	$jb_contact = filter_var($jb_contact, FILTER_SANITIZE_EMAIL);
	$jb_contact = strip_tags($_POST['reg_jbcontact']); //Remove html tags
	$jb_contact = str_replace(' ', '', $jb_contact); //Remove spaces
	$_SESSION['reg_jbcontact'] = $jb_contact; //Stores job contact email into session variable

	//Job Employer Website
	$jb_website = strip_tags($_POST['reg_jbwebsite']); //Remove html tags
	$jb_website = str_replace(' ', '', $jb_website); //Remove spaces
	$_SESSION['reg_jbwebsite'] = $jb_website; //Stores job employer website into session variable

	//Job Expiration Date
	$jb_exp_date = strip_tags($_POST['reg_jbexpdate']); //Remove html tags
	$jb_exp_date = str_replace(' ', '', $jb_exp_date); //Remove spaces
	if (empty($jb_exp_date)) {
		$jb_exp_date = '0000-00-00';
	}

	//
	$jb_employer_id = $userLoggedIn;

	//Date
	$jb_date = date("Y-m-d"); //Current date as posted date
	

		//Check if email is in valid format
		if(filter_var($jb_contact, FILTER_VALIDATE_EMAIL)) {

			$jb_contact = filter_var($jb_contact, FILTER_VALIDATE_EMAIL);

			if ($type == 'add'){
				$query = $con->prepare("INSERT INTO jobs VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', 'no')");
				$query->execute([$jb_employer_id, $jb_title, $jb_position, $jb_category, $jb_type, $jb_country, $jb_city, $jb_county, $jb_salary, $jb_salary_min, $jb_salary_max, $jb_description, $jb_contact, $jb_website, $jb_date, $jb_exp_date]);
				$id = $con->lastInsertId();

			}else{
				$query = $con->prepare("UPDATE jobs SET job_title = ?, job_position = ?, job_category = ?, job_type = ?, job_country = ?, 
										job_city = ?, job_county = ?, job_salary = ?, job_salary_min = ?, job_salary_max = ?, job_description = ?, employer_email = ?, 
										employer_website = ?, job_exp_date = ? WHERE id = ? AND user_id = ? LIMIT 1");
				$query->execute([$jb_title, $jb_position, $jb_category, $jb_type, $jb_country, $jb_city, $jb_county, $jb_salary, $jb_salary_min, 
								$jb_salary_max, $jb_description, $jb_contact, $jb_website, $jb_exp_date, $_POST['job_id'], $userLoggedIn]);
				$id = $query->rowCount();				

			}	

			//  Job added
			if ($id !== false){
				//Clear session variables
				$_SESSION['reg_jbtitle'] = "";
				$_SESSION['reg_jbposition'] = "";
				$_SESSION['reg_jbcategory'] = "";
				$_SESSION['reg_jbtype'] = "";
				$_SESSION['reg_jbcountry'] = "";
				$_SESSION['reg_jbsalary'] = "";
				$_SESSION['reg_jbsalarymin'] = "";
				$_SESSION['reg_jbsalarymax'] = "";
				$_SESSION['reg_jbdescription'] = "";
				$_SESSION['reg_jbcontact'] = "";
				$_SESSION['reg_jbwebsite'] = "";
				echo $type == 'add' ? 'job_added' : 'job_edited';

			}else{
				echo $type == 'add' ? "Could not create the job" : "Could not edit the job";
				
			}

		}
		else{
			echo "Invalid email format";
		}
	
	

		

	}


?>