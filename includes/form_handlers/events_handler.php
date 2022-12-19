<?php

//Declaring variables to prevent errors
$ev_name = ""; //Event name
$ev_category = ""; //Event category
$ev_sport = ""; //Sport
$ev_gender = ""; //gender
$ev_agemin = ""; //Age Range from month
$ev_agemax = ""; //Age Range from year
$ev_online = ""; //Event online
$ev_country = ""; //Event country
$ev_city = ""; //Event city
$ev_date = ""; //Event date
$ev_fee = ""; //Event fee
$ev_description = ""; //Event description
$ev_organiser_id = ""; //Event organiser id
$ev_contact = ""; //Event organiser contact email
$ev_website = ""; //Event organiser website

$ev_post_date = ""; //Event post date
$error_array = array(); //Holds error messages

//  Remove event
if (isset($_GET['event_delete_id'])){	
	$query = $con->prepare("UPDATE events SET event_deleted = ? WHERE id = ? AND user_id = ? LIMIT 1");
	$query->execute(['yes', $_GET['event_delete_id'], $userLoggedIn]);	
	$id = $query->rowCount();

	if ($id){
		echo 'event_deleted';		
	}else{
		echo 'Could not delete the event';
	}

}

//  Add or Edit event
if(isset($_POST['post_event']) || (isset($_POST['edit_event']) && isset($_POST['event_id']) && is_numeric($_POST['event_id']))) {

	$type = isset($_POST['post_event']) ? 'add' : 'edit';

	//form values

	//Event Name
	$ev_name = strip_tags($_POST['reg_evtitle']); //Remove html tags
	$_SESSION['reg_ev_name'] = $ev_name; //Stores name into session variable

	//Category
	$ev_category = strip_tags($_POST['reg_evcategory']); //Remove html tags
	$_SESSION['reg_evcategory'] = $ev_category; //Stores event category into session variable

	//Sport
	$ev_sport = strip_tags($_POST['reg_evsport']); //Remove html tags
	$_SESSION['reg_evsport'] = $ev_sport; //Stores sport into session variable

	//Gender
	$ev_gender = strip_tags($_POST['reg_evgender']); //Remove html tags
	$_SESSION['reg_evgender'] = $ev_gender; //Stores gender into session variable

	//Age min
	$ev_agemin = strip_tags($_POST['reg_agemin']); //Remove html tags
	$_SESSION['reg_agemin'] = $ev_agemin; //Stores month from into session variable

	//Age max
	$ev_agemax = strip_tags($_POST['reg_agemax']); //Remove html tags
	$_SESSION['reg_agemax'] = $ev_agemax; //Stores year from into session variable

	//Online
	$ev_online = strip_tags($_POST['reg_evonline']); //Remove html tags
	$_SESSION['reg_evonline'] = $ev_online; //Stores online into session variable

	//Country
	$ev_country = strip_tags($_POST['reg_evcountry']); //Remove html tags
	$_SESSION['reg_evcountry'] = $ev_country; //Stores country into session variable

	//City
	$ev_city = strip_tags($_POST['reg_evcity']); //Remove html tags
	$ev_city_explode = explode(',', $ev_city);
	$ev_city = trim($ev_city_explode[0]);
	$ev_county = trim($ev_city_explode[1]);

	//Event Date
	$ev_date = strip_tags($_POST['reg_evdate']); //Remove html tags

	//Fee
	$ev_fee = strip_tags($_POST['reg_evfee']); //Remove html tags
	$ev_fee = str_replace(' ', '', $ev_fee); //Remove spaces
	$_SESSION['reg_evfee'] = $ev_fee; //Stores into session variable

	//Description
	$ev_description = strip_tags($_POST['reg_evdescription']); //Remove html tags
	$ev_description = nl2br($ev_description);
	$_SESSION['reg_evdescription'] = $ev_description; //Stores into session variable

	//Contact Email
	$ev_contact = strip_tags($_POST['reg_evcontact']); //Remove html tags
	$ev_contact = filter_var($ev_contact, FILTER_SANITIZE_EMAIL);
	$ev_contact = str_replace(' ', '', $ev_contact); //Remove spaces
	$_SESSION['reg_evcontact'] = $ev_contact; //Stores contact email into session variable

	//Organiser Website
	$ev_website = strip_tags($_POST['reg_evwebsite']); //Remove html tags
	$ev_website = str_replace(' ', '', $ev_website); //Remove spaces
	$_SESSION['reg_evwebsite'] = $ev_website; //Stores website into session variable

	//Date
	$ev_post_date = date("Y-m-d"); //Current date

	$ev_organiser_id = $userLoggedIn;


	//Check if email is in valid format
	if(filter_var($ev_contact, FILTER_VALIDATE_EMAIL)) {

		$ev_contact = filter_var($ev_contact, FILTER_VALIDATE_EMAIL);

		if ($type == 'add'){
			$city_query = $con->prepare("SELECT * FROM uk_towns WHERE name=? AND county=?");
		    $city_query->execute([$ev_city, $ev_county]);
		    $city_event = $city_query->fetch(PDO::FETCH_ASSOC);
		    $ev_latitude = $city_event['latitude'];
		    $ev_longitude = $city_event['longitude'];

			$query = $con->prepare("INSERT INTO events VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'approved', 'no')");
			$query->execute([$ev_organiser_id, $ev_name, $ev_category, $ev_sport, $ev_gender, $ev_agemin, $ev_agemax, $ev_online, $ev_city, $ev_county, $ev_country, $ev_latitude, $ev_longitude, $ev_fee, $ev_description, $ev_contact, $ev_website, $ev_date, $ev_post_date]);
			$id = $con->lastInsertId();


		}else{
			$city_query = $con->prepare("SELECT * FROM uk_towns WHERE name=? AND county=?");
		    $city_query->execute([$ev_city, $ev_county]);
		    $city_event = $city_query->fetch(PDO::FETCH_ASSOC);
		    $ev_latitude = $city_event['latitude'];
		    $ev_longitude = $city_event['longitude'];

			$query = $con->prepare("UPDATE events SET event_title = ?, event_category = ?, event_sport = ?, event_gender = ?, event_age_min = ?, event_age_max = ?, event_online = ?, event_city = ?, event_county = ?, event_country = ?, event_latitude = ?, event_longitude = ?, event_fee = ?, event_description = ?, event_email = ?, event_website = ?, event_date = ? WHERE id = ? AND user_id = ? LIMIT 1");
			$query->execute([$ev_name, $ev_category, $ev_sport, $ev_gender, $ev_agemin, $ev_agemax, $ev_online, $ev_city, $ev_county, $ev_country, $ev_latitude, $ev_longitude, $ev_fee, $ev_description, $ev_contact, $ev_website, $ev_date, $_POST['event_id'], $userLoggedIn]);
			$id = $query->rowCount();				

		}

		//  Event added
		if ($id !== false){
			//Clear session variables
			$_SESSION['reg_ev_name'] = "";
			$_SESSION['reg_evcategory'] = "";
			$_SESSION['reg_evsport'] = "";
			$_SESSION['reg_evgender'] = "";
			$_SESSION['reg_agemin'] = "";
			$_SESSION['reg_agemax'] = "";
			$_SESSION['reg_evonline'] = "";
			$_SESSION['reg_evcountry'] = "";
			$_SESSION['reg_evfee'] = "";
			$_SESSION['reg_evdescription'] = "";
			$_SESSION['reg_evcontact'] = "";
			$_SESSION['reg_evwebsite'] = "";
			echo $type == 'add' ? 'event_added' : 'event_edited';

		}else{
			echo $type == 'add' ? "Could not create the event" : "Could not edit the event";
			
		}

	}
	else{
		echo "Invalid email format";
	}


}

?>