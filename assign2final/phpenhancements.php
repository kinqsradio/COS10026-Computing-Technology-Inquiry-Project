<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		include_once "header.inc"; //include the head part
	?>
	<title>Enhancements | CoffeeScript</title>
</head>
<body oncontextmenu="return false;">

	<section>
	<div class="topnav">
		<strong><a href="index.php">HOME</a></strong>
		<strong><a href="topic.php">TOPIC</a></strong>
		<strong><a href="quiz.php">QUIZ</a></strong>
		<strong><a href="enhancements.php">ENHANCEMENTS</a></strong>
		<strong><a href="phpenhancements.php" class="active">ENHANCEMENTS 2</a></strong>
		<strong><a href="admin.php">MANAGE</a></strong>
	</div>
</section>
<section class="article-section" id="article_section">
		<h1>WEBSITE ENHANCEMENTS</h1>
		<div class="paragraph-enhancements">
			<ul>
				<li>
				In order to have access to the manage page, the users have to have a valid combination of username (admin) and password (admin)
				If the users type in an invalid combination, an error message will show up and the users are unable to navigate to the supervisor page 
				In the manager page, the user can log out to the admin page (login page)
				</li><br>
				<li>
				In the Manager page, there are buttons above the table 
				for the managers to sort the attempts. 
				To create them, I have developed a form with multiple submit buttons, each of which has a unique value.
          		When any button is pressed, it will assign its value to the switch-case statements
	
				</li>
				
			</ul>
		</div>
	</section>
<?php
	include_once "footer.inc"; // include the footer 
?>
</body>
</html>