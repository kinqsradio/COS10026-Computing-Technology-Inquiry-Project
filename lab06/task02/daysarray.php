<?php
    function main($input){
        for ($i = 0; $i < count($input); $i++) {
            echo $input[$i];
            if ($i != count($input)-1) {
                echo ", ";
            }else {
                echo ".";
            }
        }
    }
    $days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    $days_fr = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
    echo"The days of the week in English are:<br>";
    main($days);
    echo "<br><br>";
    echo"The days of the week in French are:<br>";
    $days = array_replace($days,$days_fr);
    main($days);
?>