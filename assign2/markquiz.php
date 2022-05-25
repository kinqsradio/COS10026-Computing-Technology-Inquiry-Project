<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="description" content="PHP function" />
  <meta name="keywords" content="HTML5,PHP" />
  <link rel="icon" href="./images/ico.jpeg">
  <meta name="author" content="Tran Duc Anh Dang"  />
  <link rel="stylesheet" href="styles/markquiz.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;1,400&family=Comfortaa&display=swap" rel="stylesheet">
  <title>Results Received</title>

</head>
<body>
	<section>
			<div class="topnav">
				<strong><a href="index.html">HOME</a></strong>
				<strong><a href="topic.html">TOPIC</a></strong>
				<strong><a href="quiz.html" class="active">QUIZ</a></strong>
				<strong><a href="enhancements.html">ENHANCEMENTS</a></strong>
				<strong><a href="admin.php">MANAGE</a></strong>
			</div>
	</section>
	<section class="article-section" id="article_section">
		<h1>Quiz Markup </h1>
		<?php
			function sanitise_input($data) {
				$data = trim($data);
				$data = stripcslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			$score = 0; //Set intial score
			$attempt = 0; //Set intial attempt
			if (isset($_POST["uid"])){
				//Getting input
				if (isset($_POST["uid"])) {
					$uid = sanitise_input($_POST["uid"]);
				}else{
					$uid = '';
				}
				if (isset($_POST["uid"])) {
					$fname = sanitise_input($_POST["fname"]);
				}else{
					$fname = '';
				}
				if (isset($_POST["lname"])) {
					$lname = sanitise_input($_POST["lname"]);
				}else{
					$lname = '';
				}
				if (isset($_POST["Question1"])) {
					$q1 = implode(' and ', $_POST['Question1']);
				}else{
					$q1 = "Not Answer"; //If not yet answer
				}if (isset($_POST["lang"])) {
					$q2 = $_POST["lang"];
				}else{
					$q2 = "Not Answer"; //If not yet answer
				}if (isset($_POST["year"])) {
					$q3 = $_POST["year"];
				}if ($q3 == ""){
				 	$q3 = "Not Answer"; //If not yet answer
				}if (isset($_POST["why"])) {
					$q4 = $_POST["why"];
					$q4 = sanitise_input($_POST["why"]);
				}if ($q4 == ""){
				 	$q4 = "Not Answer"; //If not yet answer
				}if (isset($_POST["what"])) {
					$q5 = $_POST["what"];
					$q5 = sanitise_input($_POST["what"]);
				}if ($q5 == ""){
				 	$q5 = "Not Answer"; //If not yet answer
					 
				}
				
				$q1 = sanitise_input($q1);
				$q2 = sanitise_input($q2);
				$q3 = sanitise_input($q3);
				
				


				//Check attemp number
				require_once("setting.php");
				$conn = @mysqli_connect($host,$user,$pwd,$sql_db);
				$sql_attempt = "attempt";
				$query = "select * from $sql_attempt where $uid;";
				$result = mysqli_query($conn, $query);
				if ($result === FALSE) {
					echo "<p>Invalid input</p>";
					echo "<a href=\"quiz.html\"><button type=\"button\">Return</button></a>";
					die();
				}
				while ($record = mysqli_fetch_assoc($result)){
					if ($uid == $record["uid"]){
						$attempt = $record['attempt'];
					}
				}
				$attempt++;
				
				if ($attempt <= 2){
					//insert first time
					$query = "insert into $sql_attempt (uid,attempt) values ('$uid','$attempt');";
					$result = mysqli_query($conn, $query);
				}
				mysqli_close($conn);



				if ($attempt <= 2) {
					if (!preg_match("#^[0-9]{7,10}#",$uid) OR !preg_match("/^[a-zA-Z'. -]*$/", $fname) OR !preg_match("/^[a-zA-Z'. -]*$/", $lname)) {
						echo "<p>Invalid input</p>";
						echo "<a href=\"quiz.html\"><button type=\"button\">Return</button></a>";
						require_once("setting.php");
						$conn = @mysqli_connect($host,$user,$pwd,$sql_db);
						$query = "DELETE FROM attempt WHERE uid= $uid and attempt=$attempt;";
						$result = mysqli_query($conn, $query);
						$query = "DELETE FROM attempts WHERE student_id= $uid and attempt_number=$attempt;";
						$result = mysqli_query($conn, $query);
						mysqli_close($conn);
					}else{
						//Checking results
						require_once("setting.php");
						$conn = @mysqli_connect($host,$user,$pwd,$sql_db);
						$sql_result = "results";
						$query = "select q1_ans, q2_ans, q3_ans from $sql_result";
						$result = mysqli_query($conn, $query);
						if (!$result){
							echo "<p>Something is wrong with $query command </p>";
						} else {
							while ($record = mysqli_fetch_assoc($result)){
								if ($q1 == $record["q1_ans"]) {
									$score++;
								}
								if ($q2 == $record["q2_ans"]) {
									$score++;
								}
								if ($q3 == $record["q3_ans"]) {
									$score++;
								}
							}
						mysqli_close($conn);
						}
						if ($score != 0 or $score <= 3){
							//Record to attempts
							 
							require_once("setting.php");
							$conn = @mysqli_connect($host,$user,$pwd,$sql_db);
							$sql_attempts = 'attempts';
							$query = "INSERT INTO $sql_attempts (attempt_date,attempt_time,student_id, given_name, family_name, attempt_number, score) VALUES (CURRENT_DATE,CURRENT_TIME,'$uid','$fname','$lname','$attempt','$score');";
							$result = mysqli_query($conn, $query);
							mysqli_close($conn);

							// Record users answers to database
							
							require_once("setting.php");
							$conn = @mysqli_connect($host,$user,$pwd,$sql_db);
							$sql_table = "markquiz";
							$query = "insert into $sql_table (uid,fname,lname,q1,q2,q3,q4,q5,score) values ('$uid','$fname','$lname','$q1','$q2','$q3','$q4','$q5','$score');";
							$result = mysqli_query($conn, $query);
							if (!$result){
								echo "<p>Something is wrong with $query command </p>";
							} else {
								// Print out users answers
								echo "<table id='table'>";
								echo "<tr>
										<th scope='col'>Student ID</th>
										<th scope='col'>First Name</th>
										<th scope='col'>Last Name</th>
										<th scope='col'>Question 1</th>
										<th scope='col'>Question 2</th>
										<th scope='col'>Question 3</th>
										<th scope='col'>Question 4</th>
										<th scope='col'>Question 5</th>
										<th scope='col'>Score</th>
									</tr>";
								//while ($record = mysqli_fetch_assoc($result)){
								echo "<tr>\n";
								echo "<td>", $uid, "</td>\n";
								echo "<td>", $fname, "</td>\n";
								echo "<td>", $lname, "</td>\n";
								echo "<td>", $q1, "</td>\n";
								echo "<td>", $q2, "</td>\n";
								echo "<td>", $q3, "</td>\n";
								echo "<td>", $q4, "</td>\n";
								echo "<td>", $q5, "</td>\n";
								echo "<td>", $score, "</td>\n";
								echo "</tr>\n";
								//}
								echo "</table>";
							}mysqli_close($conn);
							// if ($q1 == "Not Answer" or $q2 == "Not Answer" or $q3 == "Not Answer"){
							// 		echo "<p>You haven't answer 1 of the main questions</p>";
							// 		require_once("setting.php");
							// 		$conn = @mysqli_connect($host,$user,$pwd,$sql_db);
							// 		$query = "DELETE FROM attempt WHERE uid= $uid and attempt=$attempt;";
							// 		$result = mysqli_query($conn, $query);
							// 		mysqli_close($conn);
							// 		require_once("setting.php");
							// 		$conn = @mysqli_connect($host,$user,$pwd,$sql_db);
							// 		$query = "DELETE FROM attempts WHERE uid= $uid and attempt=$attempt;";
							// 		$result = mysqli_query($conn, $query);
							// 		mysqli_close($conn);
							// }
							// if ($attempt == 1 or $q1 == "Not Answer" or $q2 == "Not Answer" or $q3 == "Not Answer"){
							// 	if ($q1 == "Not Answer" or $q2 == "Not Answer" or $q3 == "Not Answer"){
							// 	echo "<p>You haven't answer 1 of the main questions</p>";}
							// 	if($score != 0){
							// 	echo "<a href=\"quiz.html\"><button type=\"button\">Return</button></a>";}
							// 	require_once("setting.php");
							// 	$conn = @mysqli_connect($host,$user,$pwd,$sql_db);
							// 	$query = "DELETE FROM attempt WHERE uid= $uid and attempt=$attempt;";
							// 	$result = mysqli_query($conn, $query);
							// 	mysqli_close($conn);
							// 	require_once("setting.php");
							// 	$conn = @mysqli_connect($host,$user,$pwd,$sql_db);
							// 	$query = "DELETE FROM attempts WHERE student_id= $uid and attempt_number=$attempt;";
							// 	$result = mysqli_query($conn, $query);
							// 	mysqli_close($conn);
							// 	// echo "test";
							// }
							//mysqli_free_result($result);
							
						}if($score == 1 and $score < 2 ){
							echo "<a href=\"quiz.html\"><button type=\"button\">Return</button></a>";}
						if ($score == 0){
							echo "<p>Invalid Answer since your score is 0</p>";
							echo "<a href=\"quiz.html\"><button type=\"button\">Return</button></a>";
							require_once("setting.php");
							$conn = @mysqli_connect($host,$user,$pwd,$sql_db);
							$query = "DELETE FROM attempt WHERE uid= $uid and attempt=$attempt;";
							$result = mysqli_query($conn, $query);
							mysqli_close($conn);
							require_once("setting.php");
							$conn = @mysqli_connect($host,$user,$pwd,$sql_db);
							$query = "DELETE FROM attempts WHERE student_id= $uid and attempt_number=$attempt;";
							$result = mysqli_query($conn, $query);
							mysqli_close($conn);
						}
					}
				}else{

					echo "<div align='center' class='paragraph'><p>You have no attempts left</p></div>";
				}

				
			}else{;
				header("location: quiz.html");
			}
		?>
	</section>
</body>
</html>