<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="homepage">
	<meta name="keywords" content ="home">
	<meta name="author" content ="Nguyen Nam Tung">
    <title>Delete Attempt Page</title>
</head>
<body>
<?php 
 if (isset($_POST["delete_id"]))  {
    $delete_id = trim($_POST["delete_id"]);
  }
  else {
    header ("location: manage.php");
    exit();
  }
  require_once "settings.php";
  $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
  if ($conn) {
    if ($delete_id)  {
      $query = "DELETE FROM attempts WHERE student_id = '$delete_id'";
      $result = mysqli_query($conn,$query);
      if ($result) {
        echo "<p>Attempts Deleted.</p>";
        echo "<p>There are ". mysqli_affected_rows($conn)." Attempts Deleted.</p>";
        echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";
        
      }
      else {
        echo "<p>Failed to delete Attempts.</p>";
        echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";
      }
    }
    else {
      echo "<p>Please Enter a Student ID</p>";
      echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";}
    mysqli_close($conn);
  }
  else {
    echo "<p>Database Connection Failed.</p>";
    echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";
  }

?>
</body>
</html>