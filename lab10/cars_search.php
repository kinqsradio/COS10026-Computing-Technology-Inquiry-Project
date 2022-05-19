<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Creating web application lab 10">
	<meta name="keywords" content="PHP, MySQL">
	<title>Search result</title>
</head>
<body>
	<h1>Creating web application - lab 10</h1>
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

			//condition to extract the data from the table
			$condition = "";
			if ($make != "")		
				$condition .= "make='$make'";
			if ($model != ""){
				if ($condition != "")
					$condition .= "and model='$model'";
				else
					$condition .= "model='$model'";
			}
			if ($price != ""){
				if ($condition != "")
					$condition .= "and price='$price'";
				else
					$condition .= "price='$price'";
			}
			if ($yom != ""){
				if ($condition != "")
					$condition .= "and yom='$yom'";
				else
					$condition .= "yom='$yom'";
			}



			require_once("settings.php");	//database information
			$conn = @mysqli_connect($host,$user,$pwd,$sql_db);	//connect to database
			$sql_table = "cars";	//table's name
			$query = "select * from $sql_table where $condition;";		//MySQL command
			$result = mysqli_query($conn, $query);	//execute the query
			if (!$result){		//if execution fails
				echo "<p>Something is wrong with ", $query, "</p>";
			}
			else{		//if execution works
				echo "<table border='1'>";
				echo "<tr>
							<th scope='col'>Make</th>
							<th scope='col'>Model</th>
							<th scope='col'>Price</th>
							<th scope='col'>Year</th>
					  </tr>";
				while ($record = mysqli_fetch_assoc($result)){		
					echo "<tr>\n";
					echo "<td>", $record["make"], "</td>\n";
					echo "<td>", $record["model"], "</td>\n";
					echo "<td>", $record["price"], "</td>\n";
					echo "<td>", $record["yom"], "</td>\n";
					echo "</tr>\n";
				}
				echo "</table>";
				mysqli_free_result($result);		//free the memory
			}
			mysqli_close($conn);		//close connection
		}
		else{
			header("location: searchcar.html");		//redirect to form
		}
	?>
</body>
</html>