<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Booking Confirmation</title>
</head>
	
<body>
	<h1>Rohirrim Tour Booking Confirmation </h1>
<?php 
	if (isset($_POST["firstname"])) {
		$firstname = $_POST["firstname"];
	} else {
		header ("location: register.html");
		$firstname = "";
	}
	
	if (isset($_POST["lastname"])) {
			$lastname = $_POST["lastname"];
	} else {
		header ("location: register.html");
		$$lastname = "";
	}
	
	if (isset($_POST['species'])){
		$species = implode(' and ', $_POST['species']);
	}else{
		$species = "";
	}
	

	if (isset($_POST["age"])) {
		$age = $_POST["age"];
	} else {
		header ("location: register.html");
	}
	
	if (isset($_POST['tour'])){
		$tour = implode(' and ', $_POST['tour']);
	}else{
		$tour = "";
	}
	
	if (isset($_POST["food"])) {
		$food = $_POST["food"];
	} else {
		header ("location: register.html");
	}
	
	if (isset($_POST["partySize"])) {
		$partySize = $_POST["partySize"];
	} else {
		header ("location: register.html");
		$partySize = "";
	}


	function sanitise_input($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
		
	$firstname = sanitise_input($firstname);
	$$lastname = sanitise_input($lastname);
	$species = sanitise_input($species);
	$age = sanitise_input($age);
	$food = sanitise_input($food);
	$partySize = sanitise_input($partySize);
	
	$errMSg1 = $errMSg2 = $errMSg3 =  $errMSg4 =  $errMSg5 = $errMSg6 =  "";
	
	if ($firstname == "") {
		$errMSg1 .= "<p>You must enter your first name </p>";
	}
	else if (!preg_match("/^[a-zA-Z]*$/", $firstname)) {
		$errMSg1 .= "<p>Only alpha letter in your first name </p>";
	}
	if ($lastname == "") {
		$errMSg2 .= "<p>You must enter your last name </p>";
	}
	else if (!preg_match("/^[a-zA-Z-]*$/", $lastname)) {
		$errMSg2 .= "<p>Only alpha letter and hyphen in your last name </p>";
	}
	if ($age==""){
		$errMSg3 .= "<p>You must enter a number</p>";
	}
	else if (is_numeric($age) == False){
		$errMSg3 .= "<p> You must enter a number from 18 to </p>";
	}
	else {
		if ($age < 18 or $age > 10000) {
			$errMSg3 .= "<p> The number must be in range 18 to 10000 </p>";
		}
	}
	if ($tour == "") {
		$errMSg4 .= "<p>You must pick your booking </p>";
	}

	if ($species == "") {
		$errMSg5 .= "<p>You must pick your species </p>";
	}

	if ($partySize == "") {
		$errMSg6 .= "<p>You must enter the number of traveller </p>";
	}

	if ($errMSg1 != "" or $errMSg2 != "" or $errMSg3 != "" or $errMSg4 != ""){
		echo $errMSg1;
		echo $errMSg4;
		echo $errMSg5;
		echo $errMSg2;
		echo $errMSg3;
		echo $errMSg6;
	}else {
		echo "<p>Welome ".$firstname." ".$lastname."!</p>";
		echo "<p>You are now booked on the ".$tour."<p>";
		echo "<p>Species: ".$species."<p>";
		echo "<p>Age: $age</p>";
		echo "<p>Meal Preference: ".$food."<p>";
		echo "<p>Number of traveller: ".$partySize."<p>";
	}

?>
</body>
</html>