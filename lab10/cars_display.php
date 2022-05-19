<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Creating web application lab 10">
	<meta name="keywords" content="PHP, MySQL">
	<title>Retrieving records to HTML</title>
</head>
<body>
	<h1>Creating web application - lab 10</h1>
	<?php
		require_once ("settings.php");	//database info
		$conn = @mysqli_connect($host,$user,$pwd,$sql_db);
		if (!$conn){
			echo "<p>Database connection failure.</p>";		//connection failed
		}
		else{
			$sql_table = "cars";
			$query = "select make, model, price from $sql_table order by make, model;";		//query command
			$result = mysqli_query($conn, $query);				//execute the query and store the result into result pointer
			if (!$result){			//if execution was not successful
				echo "<p>Something is wrong with ", $query, "</p>";
			}
			else{			//display table
				echo "<table border='1'>";
				echo "<tr>
							<th scope='col'>Make</th>
							<th scope='col'>Model</th>
							<th scope='col'>Price</th>
					  </tr>";
				while ($record = mysqli_fetch_assoc($result)){
					echo "<tr>\n";
					echo "<td>", $record["make"], "</td>\n";
					echo "<td>", $record["model"], "</td>\n";
					echo "<td>", $record["price"], "</td>\n";
					echo "</tr>\n";
				}
				echo "</table>";
				mysqli_free_result($result);		//free the memory
			}
			mysqli_close($conn);
		}
	?>
</body>
</html>