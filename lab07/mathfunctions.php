<?php
/* mathfunctions.php
   Collection of user-defined maths functions
   Like any code you should start your file with a header comment
   Author: Tran Duc Anh Dang
*/
 

function factorial ($n) {	// declare the factorial function
	$result = 1;		// declare and initialise the result variable
	$factor = $n;		// declare and initialise the factor variable
	while ($factor > 1) {	// loop to multiple all factors until 1
	  $result = $result * $factor;
	  $factor--;		// next factor
	}				// Note that the factor 1 is not multiplied
	return $result;
}

function isPositiveInteger ($n){
	$result = false;
		if (is_numeric($n))
			if ($n == floor($n))
				if ($n > 0)
					$result = true;
	return $result;
}
?>
