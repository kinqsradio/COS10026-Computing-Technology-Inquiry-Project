<!DOCTYPE html>
<html lang="en">
    <head>
            <meta charset="utf-8" />
            <meta name="description" content="Assignment 2 COS10026" />
            <meta name="keywords" content="HTML5,PHP" />
            <link rel="icon" href="./images/ico.jpeg">
            <meta name="author" content="Tran Duc Anh Dang, Nguyen Nam Tung, Tran Quang Thanh"  />
            <link rel="stylesheet" href="styles/markquiz.css">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;1,400&family=Comfortaa&display=swap" rel="stylesheet">
        <title>Results Received</title></head>
<body>
<section>
        <div class="topnav">
            <strong><a href="index.php">HOME</a></strong>
            <strong><a href="topic.php">TOPIC</a></strong>
            <strong><a href="quiz.php" class="active">QUIZ</a></strong>
            <strong><a href="enhancements.php">ENHANCEMENTS</a></strong>
            <strong><a href="phpenhancements.php">ENHANCEMENTS 2</a></strong>
            <strong><a href="admin.php">MANAGE</a></strong>
        </div>
</section>
    <section class="article-section" id="article_section">
        <h1>Quiz Markup </h1>
        <?php 
        error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
        function sanitise_input($data) {
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);return $data;
        }
        $score = 0;$attempt = 0;
        require_once ("setting.php");
        $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
        if (!$conn) {
            echo "<p>Database Connection Failed</p>";
        }
        else { // Create table if not exist 
            $query = "CREATE TABLE IF NOT EXISTS attempts (
                attempt_id INT(11) AUTO_INCREMENT PRIMARY KEY,
                attempt_date DATE,
                attempt_time TIME,
                student_id INT(11),
                given_name VARCHAR(50),
                family_name VARCHAR(50),
                attempt_number INT(11),
                score INT(11) )";
                $result = mysqli_query($conn,$query);

                $query = "CREATE TABLE IF NOT EXISTS attempt (
                uid INT(11),
                fname VARCHAR(50),
                lname VARCHAR(50),
                attempt INT(11) )"; 
                $result = mysqli_query($conn,$query);
        
                $query = "CREATE TABLE IF NOT EXISTS markquiz (
                uid INT(11),
                fname VARCHAR(50),
                lname VARCHAR(50),
                q1 VARCHAR(50),
                q2 VARCHAR(50),
                q3 VARCHAR(50),
                q4 VARCHAR(50),
                q5 VARCHAR(50),
                score INT(11) )";
                $result = mysqli_query($conn,$query);
        }
        mysqli_close($conn);
        if (isset($_POST["uid"])){
            if ((isset($_POST["uid"])) or (isset($_POST["fname"])) or (isset($_POST["lname"])) or (isset($_POST["lang"])) or (isset($_POST["year"])) or (isset($_POST["why"])) or (isset($_POST["what"])) or (isset($_POST["Question1"])) ) {
                $uid = sanitise_input($_POST["uid"]);
                $fname = sanitise_input($_POST["fname"]);
                $lname = sanitise_input($_POST["lname"]);
                $q1 = sanitise_input(implode(' and ', $_POST['Question1']));
                $q2 = sanitise_input($_POST["lang"]);
                $q3 = sanitise_input($_POST["year"]);
                $q4 = sanitise_input($_POST["why"]);
                $q5 = sanitise_input($_POST["what"]); //santinise input
                }
            require_once("setting.php");
            $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
            $sql_attempt = "attempt";
            $query = "select * from $sql_attempt where $uid;";
            $result = mysqli_query($conn, $query);
            if ($result === FALSE) {
                echo "<p>Invalid input</p>";
                echo "<a href=\"quiz.php\"><button type=\"button\">Return</button></a>";
                die();
            }
            while ($record = mysqli_fetch_assoc($result)){
                if ($uid == $record["uid"]){
                    $attempt = $record['attempt'];}}
                    $attempt++;
                    if ($attempt <= 2){
                        $query = "insert into $sql_attempt (uid,attempt) values ('$uid','$attempt');";
                        $result = mysqli_query($conn, $query);}
                        mysqli_close($conn);
                        if ($attempt <= 2) {
                            if (!preg_match("#^[0-9]{7,10}#",$uid) OR !preg_match("/^[a-zA-Z'. -]*$/", $fname) OR !preg_match("/^[a-zA-Z'. -]*$/", $lname)) { //Validate student detail
                                echo "<p>Invalid input</p>";
                                echo "<a href=\"quiz.php\"><button type=\"button\">Return</button></a>";
                                require_once("setting.php");
                                $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                                $query = "DELETE FROM attempt WHERE uid= $uid and attempt=$attempt;";
                                $result = mysqli_query($conn, $query);
                                $query = "DELETE FROM attempts WHERE student_id= $uid and attempt_number=$attempt;";
                                $result = mysqli_query($conn, $query);
                                mysqli_close($conn);}else{
                                    require_once("setting.php");
                                    $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                                    $sql_result = "results";$query = "select * from $sql_result";
                                    $result = mysqli_query($conn, $query);
                                    if (!$result){
                                        echo "<p>Something is wrong with $query command </p>";} 
                                        else {
                                            while ($record = mysqli_fetch_assoc($result)){ // Check score for the question
                                                if ($q1 == $record["q1_ans"]) {
                                                    $score+=60;}
                                                if ($q1 == $record["q1_ans_1"]) {
                                                    $score+=30;}
                                                if ($q1 == $record["q1_ans_4"]) {
                                                    $score+=30;}
                                                if ($q2 == $record["q2_ans"]) {
                                                    $score+=30;}
                                                if ($q3 == $record["q3_ans"]) {
                                                    $score+=10;}}
                                                mysqli_close($conn);}
                                            if ($score != 0 or $score <= 3){
                                                require_once("setting.php");
                                                $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                                                $sql_attempts = 'attempts';
                                                $query = "INSERT INTO $sql_attempts (attempt_date,attempt_time,student_id, given_name, family_name, attempt_number, score) VALUES (CURRENT_DATE,CURRENT_TIME,'$uid','$fname','$lname','$attempt','$score');";
                                                $result = mysqli_query($conn, $query);
                                                mysqli_close($conn);
                                                require_once("setting.php");
                                                $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                                                $sql_table = "markquiz";
                                                $query = "insert into $sql_table (uid,fname,lname,q1,q2,q3,q4,q5,score) values ('$uid','$fname','$lname','$q1','$q2','$q3','$q4','$q5','$score');";
                                                $result = mysqli_query($conn, $query);
                                                if (!$result){
                                                    // echo "<p>Something is wrong with $query command </p>";
                                                } 
                                                else {
                                                    echo "<table id='table'>";
                                                    echo "<tr><th scope='col'>Student ID</th><th scope='col'>First Name</th><th scope='col'>Last Name</th><th scope='col'>Question 1</th><th scope='col'>Question 2</th><th scope='col'>Question 3</th><th scope='col'>Question 4</th><th scope='col'>Question 5</th><th scope='col'>Score</th></tr>";
                                                    echo "<tr>\n";echo "<td>", $uid, "</td>\n";echo "<td>", $fname, "</td>\n";echo "<td>", $lname, "</td>\n";echo "<td>", $q1, "</td>\n";echo "<td>", $q2, "</td>\n";echo "<td>", $q3, "</td>\n";echo "<td>", $q4, "</td>\n";echo "<td>", $q5, "</td>\n";echo "<td>", $score, "</td>\n";echo "</tr>\n";echo "</table>";}
                                                    mysqli_close($conn);}
                                                    if($attempt == 1 and $q1 != "" or $q2 != "" or $q3 != "" or $q4 != "" or $q5 != ""){ //error when questions are not filled up
                                                        echo "<a href=\"quiz.php\"><button type=\"button\">Return</button></a>";}
                                                    if ($q1 == "" or $q2 == "" or $q3 == "" or $q4 == "" or $q5 == ""){
                                                        echo "<p>You must answer all the questions!</p>";
                                                        echo "<a href=\"quiz.php\"><button type=\"button\">Return</button></a>";
                                                        require_once("setting.php");
                                                        $conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                                                        $query = "DELETE FROM attempt WHERE uid= $uid and attempt=$attempt;";
                                                        $result = mysqli_query($conn, $query);
                                                        mysqli_close($conn);require_once("setting.php");$conn = @mysqli_connect($host,$user,$pwd,$sql_db);
                                                        $query = "DELETE FROM attempts WHERE student_id= $uid and attempt_number=$attempt;";
                                                        $result = mysqli_query($conn, $query);mysqli_close($conn);}}}
                                                        else{
                                                            echo "<div align='center' class='paragraph'><p>You have no attempts left</p></div>";}} // No attempt left                                                           
                                                        else{header("location: quiz.php");}?></section></body></html>
