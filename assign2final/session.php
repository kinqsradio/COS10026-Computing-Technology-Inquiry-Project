<?php
//Start session
session_start();
//Check whether the session variable is present or not
if (!isset($_SESSION['user_id']) || (trim($_SESSION['user_id']) == '')) {
    header("location: admin.php");
    exit();
}
$session_id=$_SESSION['user_id'];
?>