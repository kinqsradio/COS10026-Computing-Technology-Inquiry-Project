<!DOCTYPE html>
<html lang="en">
	<head>
		<?php 
      include_once "header.inc"; //include the head part
    ?>
		<title>Score Change Confirmation Page</title>
	</head>
  <body>
  <?php
    if (isset($_POST["change_id"]) or isset($_POST["change_an"])) {
      $change_id = trim($_POST["change_id"]);
      $change_an = trim($_POST["change_an"]); 
	    $change_score = trim($_POST["change_score"]);
    }
    else {
      header ("location: manage.php"); 
      exit();
    }
    require_once "setting.php";
    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
    if ($conn) {
        $query = "UPDATE attempts SET score = '$change_score' WHERE student_id LIKE '%$change_id%' AND attempt_number LIKE '%$change_an%'"; 
        $result = mysqli_query($conn,$query); // query to change score based on student ID and attempt_number
        if ($result) {
          echo "<p>Score has been changed.</p>";
          echo "<p>There are ". mysqli_affected_rows($conn)." Attempts CHANGED.</p>";
          echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";
          header ("location: manage.php");
      mysqli_close($conn);}}
  ?>
</body>
</html> 







