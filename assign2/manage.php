<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="UTF-8">
		<meta name="description" content="home page">
		<meta name="keywords" content ="home">
		<meta name="author" content ="Nguyen Nam Tung">
    <title>Quiz Managing Page</title>
</head>
<body>
<?php 
include('setting.php');
include('session.php'); 
$conn = mysqli_connect($host,$user,$pwd,$sql_db);
$result=mysqli_query($conn, "select * from users where user_id='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);

 ?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="form-wrapper"> 
    <center><h3>Welcome: <?php echo $row['name']; ?> </h3></center>
	 <div class="reminder">
    <p><a href="logout.php">Log out</a></p>
  </div>
</div>

</body>
</html>
<h1>All Attempts</h1>
<form action="manage.php" method="POST">
  <label>Sort by: </label>
  <button type="submit" name="order_by" value="student_id_sort">Student ID</button>
  <button type="submit" name="order_by" value="given_name_sort">Given Name</button>
  <button type="submit" name="order_by" value="family_name_sort">Family Name</button>
  <button type="submit" name="order_by" value="score_sort">Score</button>
</form>
<?php
#SORT 
  $query = "SELECT * FROM attempts";
   if (isset($_POST["order_by"])) {
    switch($_POST['order_by']) {
      case "student_id_sort":
        $query .= " ORDER BY student_id";
        break;
      case "given_name_sort":
        $query .= " ORDER BY given_name";
        break;
      case "family_name_sort":
        $query .= " ORDER BY family_name";
        break;
      case "score_sort":
        $query .= " ORDER BY score";
          break; 
      }
      } else {
          $query = "SELECT * FROM attempts";
      }
        
#RUNNING QUERY
require_once ("settings.php");
$conn = @mysqli_connect($host,$user,$pwd,$sql_db);
if (!$conn) {
  echo "<p>Database Connection Failed</p>";
} else {
  $result = mysqli_query($conn, $query);
  if (!$result) {
    echo "<p>Something is wrong with ", $query, "</p>";
  } else {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            echo "<table border = \"1\">\n";
            echo "<tr>\n"
            ."<th scope = \"col\">Attempt ID</th>\n "
            ."<th scope = \"col\">Attempt Date</th>\n "
            ."<th scope = \"col\">Attempt Time</th>\n "
            ."<th scope = \"col\">Student ID</th>\n "
            ."<th scope = \"col\">Given Name</th>\n "
            ."<th scope = \"col\">Family Name</th>\n "
            ."<th scope = \"col\">Attempt Number</th>\n "
            ."<th scope = \"col\">Score</th>\n "
            ."</tr>\n";
        while ($row){
            echo "<tr>\n";
            echo "<td>",$row["attempt_id"],"</td>\n";
            echo "<td>",$row["attempt_date"],"</td>\n";
            echo "<td>",$row["attempt_time"],"</td>\n";
            echo "<td>",$row["student_id"],"</td>\n";
            echo "<td>",$row["given_name"],"</td>\n";
            echo "<td>",$row["family_name"],"</td>\n";
            echo "<td>",$row["attempt_number"],"</td>\n";
            echo "<td>",$row["score"],"</td>\n";
            $row = mysqli_fetch_assoc($result);
      }
      echo "</table>\n";
      mysqli_free_result($result);
    }
    else {echo "<p>There are no attempts</p>";}
  }
  mysqli_close($conn);
}  
?>

<form action="search_attempt.php" method="POST">
  <h1>Search By Student ID</h1>
  <p><label>Student ID: <input type="text" name="search_id"></label></p>
  <input type="submit" value="Search by ID"/>
  <button type="reset">Reset</button>
  <h1>Search By Name</h1>
  <p><label>Name: <input type="text" name="search_name"></label></p>
  <input type="submit" value="Search by Name"/>
  <button type="reset">Reset</button>
</form>

<form action="list_attempt.php" method ="POST">
  <h1>Student Attempt</h1>
  <p><button type="submit" name="list" value="a">List of students who got 100% on their first attempt</button></p>
  <p><button type="submit" name="list" value="b">List of students who got less than 50% on their second attempts</button></p>
</form>

<form action="delete_attempt.php" method="POST"> 
<h1>Delete Attempt</h1>
<p><label>Student ID <input type="text" name="delete_id"></label></p>
<input type="submit" value="Delete"/>
</form>

<form action="change_attempt.php" method="POST">
<h1>Change Attempt</h1>
<p><label>Student ID: <input type="text" name="change_id"></label></p>
<p><label>Attempt Number: <input type="text" name="change_an"></label></p>
<p><label>Score: <input type="text" name="change_score"></label></p>
<input type="submit" value="Change"/>
</form>

</body>
</html> 