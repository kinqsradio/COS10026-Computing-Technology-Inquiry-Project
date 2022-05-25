<?php
    #SORT Query
    if ((isset($_POST["order_by"])))  {
     switch($_POST['order_by']) {
       case "student_id_sort":
         $query = "SELECT * FROM attempts ORDER BY student_id";
         break;
       case "given_name_sort":
         $query = "SELECT * FROM attempts ORDER BY given_name";
         break;
       case "family_name_sort":
         $query = "SELECT * FROM attempts ORDER BY family_name";
         break;
       case "score_sort":
         $query = "SELECT * FROM attempts ORDER BY CAST(score AS UNSIGNED) DESC";
           break; 
       }
       } else {
           $query = "SELECT * FROM attempts";
       }
?>