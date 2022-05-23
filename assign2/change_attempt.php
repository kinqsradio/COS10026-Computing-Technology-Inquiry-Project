<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="home page">
		<meta name="keywords" content ="home page">
		<meta name="author" content ="Nguyen Nam Tung">
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
    require_once "settings.php";
    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
    if ($conn) {
      if ($change_id == "") {
        echo "<p>Please enter a student ID </p>";
		echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";
      }
      else if ($change_score =="") {
        echo "<p>You need to enter a score</p>";
		echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";
	} else {
        $query = "UPDATE attempts SET score = '$change_score' WHERE student_id LIKE '%$change_id%' AND attempt_number LIKE '%$change_an%'";
        $result = mysqli_query($conn,$query);
        if ($result) {
          echo "<p>Score has been changed.</p>";
          echo "<p>There are ". mysqli_affected_rows($conn)." Attempts CHANGED.</p>";
          echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";
        }
        else {
          echo "<p>Failed to change attempt.</p>";
		  echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";
        }
      }
      mysqli_close($conn);
    }
    else {
		echo "<p>Database connection failed.</p> ";
	}
  ?>
</body>
</html> 






