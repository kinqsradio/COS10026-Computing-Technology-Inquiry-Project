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
if (isset($_POST["list"])) {
  $list = trim($_POST["list"]);
}
else {
  header ("location: manage.php");
  exit();
}
  require_once "settings.php";
  $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
  if (!$conn) {
    echo "<p>Database Connection Failed</p>";
  } else {
    if ($list)  {
        $query = "SELECT student_id, given_name, family_name FROM attempts";
        switch($list) {
          case "a":
            $query .= " WHERE attempt_number = 1 and score = 10";
            break;
          case "b":
            $query .= " WHERE attempt_number = 2 and score < 5";
            break;}
        $result = mysqli_query($conn,$query);
        if (!$result) {
          echo "<p>Failed to search for attempt</p>";
          echo "<a href=\"manage2.php\"><button type=\"button\">Return</button></a>";
        }
        else {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                echo "<h1>List of attempts</h1>";
                echo "<table border = \"1\">\n";
                echo "<tr>\n"
                ."<th scope = \"col\">Student ID</th>\n "
                ."<th scope = \"col\">Given Name</th>\n "
                ."<th scope = \"col\">Family Name</th>\n "
                ."</tr>\n";
            while ($row){
                echo "<tr>\n";
                echo "<td>",$row["student_id"],"</td>\n";
                echo "<td>",$row["given_name"],"</td>\n";
                echo "<td>",$row["family_name"],"</td>\n";
                $row = mysqli_fetch_assoc($result);
          }
          echo "</table>\n";
          echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";
          mysqli_free_result($result);}
        else {
          echo "<p>No Attempt Matched</p>";
          echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";
         }
         }
      }
    mysqli_close($conn);
}
?>
</body>
</html>