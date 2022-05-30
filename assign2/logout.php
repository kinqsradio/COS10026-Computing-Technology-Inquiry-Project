<?php
session_start();
session_destroy();
header('location:admin.php');// return to the admin page 
?>