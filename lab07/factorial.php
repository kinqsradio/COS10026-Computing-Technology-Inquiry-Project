<body>
<?php
	include ("mathfunctions.php");
?>
<h1>Factorial</h1>
<?php
	$num = 1;
		if (isPositiveInteger($num)) {
			echo "<p>", $num, "! is ", factorial ($num), ".</p>";} else {
			echo "<p>Please enter a positive integer.</p>";}
		echo "<p><a href='factorial.html'>Return to the Entry Page</a></p>";

?>
</body>