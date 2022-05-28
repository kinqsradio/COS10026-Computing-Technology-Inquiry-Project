<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
  <meta name="description" content="PHP function" />
  <meta name="keywords" content="HTML5,PHP" />
  <link rel="icon" href="./images/ico.jpeg">
  <link rel="stylesheet" href="styles/markquiz.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;1,400&family=Comfortaa&display=swap" rel="stylesheet">
    <title>Quiz Managing Page</title>
</head>
<body>
<section>
      <div class="topnav">
        <strong><a href="index.php">HOME</a></strong>
        <strong><a href="topic.php">TOPIC</a></strong>
        <strong><a href="quiz.php">QUIZ</a></strong>
        <strong><a href="enhancements.php">ENHANCEMENTS</a></strong>
        <strong><a href="phpenhancements.php">ENHANCEMENTS 2</a></strong>
        <strong><a href="admin.php" class="active">MANAGE</a></strong>
      </div>
</section>
<?php
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
include('setting.php');
include('session.php'); 
$conn = mysqli_connect($host,$user,$pwd,$sql_db);
$result=mysqli_query($conn, "select * from users where user_id='$session_id'") or die('Error In Session');
$row=mysqli_fetch_array($result);
?>
<section class="article-section" id="article_section">
  <h1>All Attempts</h1> 
  <form action="manage.php" method="POST"> 
    <label>Sort by: </label> <!-- Sorting buttons -->
    <button type="submit" name="funciton_button" value="student_id_sort">Student ID</button>
    <button type="submit" name="funciton_button" value="given_name_sort">Given Name</button>
    <button type="submit" name="funciton_button" value="family_name_sort">Family Name</button>
    <button type="submit" name="funciton_button" value="score_sort">Score</button>
  </form>
  <form action="manage.php" method ="POST">
   <label>Student Attempt</label>
    <button type="submit" name="funciton_button" value="a">List of students who got 100% on their first attempt</button>
    <button type="submit" name="funciton_button" value="b">List of students who got less than 50% on their second attempt</button>
</form>
<form action="manage.php" method="POST"> <!-- Search -->
    <p><label>Search (Given Name): <input type="text" name="search_name"></label></p>
    <p><label>Search (Student ID): <input type="text" name="search_id"></label></p>
    <input type="submit" value="Search"/>
</form>

  <div class="reminder"> <!-- Log out button -->
    <p><a href="logout.php">Log out</a></p>
  </div>

  <?php
  //Main Function to sort  
  if (isset($_POST["search_name"]) || isset($_POST["search_id"])) {
    $search_name = trim($_POST["search_name"]);
    $search_id = trim($_POST["search_id"]);
    $query = "SELECT * FROM attempts WHERE student_id LIKE '%$search_id%' AND given_name LIKE '%$search_name%'";} #search query 
  else {
  $query = "SELECT * FROM attempts ";
  if ((isset($_POST["funciton_button"]))) {
    switch($_POST['funciton_button']) {
      case "student_id_sort": //Sort by student ID
        $query = "SELECT * FROM attempts ORDER BY student_id";
        break;
      case "given_name_sort": //Sort by given name 
        $query = "SELECT * FROM attempts ORDER BY given_name";
        break;
      case "family_name_sort": //Sort by faminy name
        $query = "SELECT * FROM attempts ORDER BY family_name";
        break;
      case "score_sort": //Sort by score
        $query = "SELECT * FROM attempts ORDER BY CAST(score AS UNSIGNED) DESC";
          break; 
      case "a": //Sort by 100% on first attempt
        $query = "SELECT * FROM attempts WHERE attempt_number = 1 and score = 100";
        break;
      case "b": //Sort by less than 50% on second atempt
        $query = "SELECT * FROM attempts WHERE attempt_number = 2 and score < 50";
        break;
      }
    }else{
    $query = "SELECT * FROM attempts";}
  }     
  #Running query and create attempt table
  require_once ("setting.php");
  $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
  if (!$conn) {
    echo "<p>Database Connection Failed</p>";
  } else {
    $result = mysqli_query($conn, $query);
    if (!$result) {
      echo "<p>No Results</p>";
    } else {
          $row = mysqli_fetch_assoc($result);
          if ($row) {
              echo "<table id='table'>";
              echo "<tr>\n"
              ."<th scope = \"col\">Attempt ID</th>\n "
              ."<th scope = \"col\">Attempt Date</th>\n "
              ."<th scope = \"col\">Attempt Time</th>\n "
              ."<th scope = \"col\">Student ID</th>\n "
              ."<th scope = \"col\">Given Name</th>\n "
              ."<th scope = \"col\">Family Name</th>\n "
              ."<th scope = \"col\">Attempt Number</th>\n "
              ."<th scope = \"col\">Score</th>\n "
              ."<th scope = \"col\">Change Score</th>\n "
              ."<th scope = \"col\">Delete Attempt</th>\n "
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
              echo "<td><form action='change_attempt.php' method='POST'><input type='hidden' type='text' name='change_id' value=",$row['student_id'],"><input type='hidden' type='text' name='change_an' value=",$row['attempt_number'],"><input type='text' name='change_score'><input type='submit' value='Save'/></form></td>";
              echo "<td><form action='delete_attempt.php' method='GET'><input type='hidden' name='delete_id' value=",$row['student_id'],"><input type='submit' value='Delete'/></form></td>\n";
              $row = mysqli_fetch_assoc($result);
        }
        echo "</table>\n";
        mysqli_free_result($result);
      }
      else {echo "<p>No Results</p>";}
    }
    mysqli_close($conn);
  }  
  ?>
</section>
</body>
</html> 