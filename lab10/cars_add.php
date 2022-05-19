<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Creating web application lab 10">
	<meta name="keywords" content="PHP, MySQL">
	<title>Adding cars to MySQL</title>
</head>
<body>
	<?php
		function sanitise_input($data){
			$data = trim($data);				//remove spaces
			$data = stripslashes($data);		//remove backslashes in front of quotes
			$data = htmlspecialchars($data);	//convert HTML special characters to HTML code
			return $data;
		}
		if (isset($_POST["carmake"])){		//if successfully receive form data
			//get information from form
			$make = sanitise_input($_POST["carmake"]);
			$model = sanitise_input($_POST["carmodel"]);
			$price = sanitise_input($_POST["price"]);
			$yom = sanitise_input($_POST["yom"]);

			require_once("settings.php");	//database information
			$conn = @mysqli_connect($host,$user,$pwd,$sql_db);	//connect to database
			$sql_table = "cars";	//table's name
			$query = "insert into $sql_table (make, model, price, yom) values ('$make', '$model', '$price', '$yom');";		//MySQL command
			$result = mysqli_query($conn, $query);	//execute the query
			if (!$result){		//if execution fails
				echo "<p>Something is wrong with ", $query, "</p>";
			}
			else{		//if execution works
				echo "<p>Successfully added New Car record</p>";
			}
			mysqli_close($conn);		//close connection
		}
		else{
			header("location: addcar.html");
		}
	?>
</body>
</html>

!preg_match("/^[a-zA-Z'. -]*$/",$lname)