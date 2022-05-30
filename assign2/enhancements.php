<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		include_once "header.inc";
	?>
	<title>Enhancements | CoffeeScript</title>
</head>
<body oncontextmenu="return false;">
<section>
		<div class="topnav">
			<strong><a href="index.php">HOME</a></strong>
			<strong><a href="topic.php">TOPIC</a></strong>
			<strong><a href="quiz.php">QUIZ</a></strong>
			<strong><a href="enhancements.php" class="active">ENHANCEMENTS</a></strong>
			<strong><a href="phpenhancements.php">ENHANCEMENTS 2</a></strong>
			<strong><a href="admin.php">MANAGE</a></strong>
		</div>
</section>
	<section class="article-section" id="article_section">
		<h1>WEBSITE ENHANCEMENTS</h1>
		<div class="paragraph-enhancements">
			<ul>
				<li>
					A number amount of CSS has been added to top nav bar. 
					For example, in this case padding has been added so it 
					can appear in the middle of the view and every time a 
					mouse is hover on it, text-colour is changed and its 
					background colour. Also, text-decoration has been set 
					to none so after visited it will look much cleaner. 
					Furthermore, it also shows which tab is being active 
					(a tab that is being open).
				</li>
				<li>
					A CSS for list has been added while lectures and tutorials 
					haven't covered. In this case, they will show horizontally 
					together and appears in a block.
				</li>
				<li>
					In HTML file, the website has been added an icon, and a line 
					of code to prevent right click happening on the website as 
					this feature might protecting not only the creator of the 
					site or others.
				</li>
				<li>
					To make a website looks more professional, all of the class 
					"article-section" and "paragraph" has been centring in the 
					middle by reducing the width of its section make it looks
					 much cleaner. Furthermore, on class "article-section" 
					 heading has been align right in the middle with 
					 transform:translate(-50%) and left:50% and this hasn't been 
					 covered in the tutorials or lectures
				</li>
			</ul>
		</div>
	</section>

<?php
	include_once "footer.inc";
?>
</body>
</html>