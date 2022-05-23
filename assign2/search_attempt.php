<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="homepage">
	<meta name="keywords" content ="home">
	<meta name="author" content ="Nguyen Nam Tung">
    <title>Search</title>
</head>
<body>
<?php 
 if ((isset($_POST["search_id"])) or (isset($_POST["search_name"])))  {
    $search_id = trim($_POST["search_id"]);
    $search_name = trim($_POST["search_name"]);
 }
  else {
    header ("location: manage.php");
    exit();
  }
  require_once "settings.php";
  $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
  if (!$conn) {
    echo "<p>Database Connection Failed</p>";}
  else {
    if (($search_id) or ($search_name)) {
        $query = "SELECT * FROM attempts WHERE student_id LIKE '%$search_id%' AND given_name LIKE '%$search_name%'";
        $result = mysqli_query($conn,$query);
        if (!$result) {
          echo "<p>Failed to search for attempt</p>";
          echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";
        }
        else {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                echo "<h1>Attempts Founded</h1>";
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
          echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";
          mysqli_free_result($result);}
        else {
          echo "<p>No Attempt Matched</p>";
          echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";
        }
        }
      }
      else {
        echo "<p>Please Enter a Student ID or Name</p>";
        echo "<a href=\"manage.php\"><button type=\"button\">Return</button></a>";}
    mysqli_close($conn);
}
?>
</body>
</html>