<?php
    $marks = array(85, 81, 95);
    $ave = ($marks[0]+ $marks[1] + $marks[2])/3;
    $marks[1] = 90;
    if ($ave >= 50)
        $status = "PASSED";
    else
        $status = "FAILED";
    echo "<p>The average is $ave. You $status.</p>"

?>