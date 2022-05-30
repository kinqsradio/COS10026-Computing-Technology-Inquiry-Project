<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<?php 
		include_once "header.inc"; //include the head part 
	?>
	<meta name="descriptions" content="COS10026 Assignment Part 1" />
	<meta name="keywords" content="HTML, CSS, PHP"/>
	<meta name="author" content="Cafe Sua Da / Enton, Thanh, Oscar, Tung, Anh" />
	<title>Quiz | CoffeeScript</title>
</head>
<body oncontextmenu="return false;">
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
	
	<h1>An Unofficial Quiz on CoffeeScript</h1>
	<section class="form-format">

	<form method="post" action="markquiz.php" novalidate>
		<fieldset>
			<legend>Student details</legend>

			<p>
				<label for="uid">Student ID</label>
				<br />
				<input type="text" name="uid" id="uid" size="10" pattern="[0-9]{7,10}" maxlength="10" required/>
			</p>

			<p>
				<label for="fname">Given Name (optional)</label>
				<br />
				<input type="text" name="fname" id="fname" maxlength="15" size="15" pattern="^[a-zA-Z]+$" required/>
			</p>

			<p>
				<label for="lname">Family Name (optional)</label>
				<br />
				<input type="text" name="lname" id="lname" maxlength="15" size="15" pattern="^[a-zA-Z]+$" required/>
			</p>

		</fieldset>
		<br />

		<fieldset>
			<legend>What is CoffeeScript?</legend>

				<input type="checkbox" id="1" name="Question1[]" value="1"/> <!-- Correct -->
				<label for="1">A coding language</label> <!-- Correct -->
				<br />

				<input type="checkbox" id="2" name="Question1[]" value="2"/>
				<label for="2">A type of cold-brew coffee</label>
				<br />

				<input type="checkbox" id="3" name="Question1[]" value="3"/>
				<label for="3">An addon for a video game</label>
				<br />

				<input type="checkbox" id="4" name="Question1[]" value="4"/> <!-- Correct -->
				<label for="4">A simplified version of another coding language</label> <!-- Correct -->
				<br />

				<input type="checkbox" id="5" name="Question1[]" value="5"/>
				<label for="5">A more complicated version of another coding language</label>
				<br />
		</fieldset>
		<br />

		<fieldset>
			<legend>What language is CoffeeScript based on?</legend>

			<p>
				<input type="radio" id="html" name="lang" value="1"/>
				<label for="html">HTML</label>
				<br />

				<input type="radio" id="css" name="lang" value="2"/>
				<label for="css">CSS</label>
				<br />

				<input type="radio" id="js" name="lang" value="3"/> <!-- Correct -->
				<label for="js">JavaScript</label> <!-- Correct -->
				<br />

				<input type="radio" id="ts" name="lang" value="4"/>
				<label for="ts">TypeScript</label>
				<br />

				<input type="radio" id="none" name="lang" value="none"/>
				<label for="none">None of the above</label>
				<br />
			</p>

		</fieldset>
		<br />

		<fieldset>
			<legend>What year was CoffeeScript created?</legend>
			
			<p><label for="year"></label>
				<select name="year" id="year">
					<option value="" >Please Select</option>
					<option value="1">2005</option>
					<option value="2">2006</option>
					<option value="3">2007</option>
					<option value="4">2008</option>
					<option value="5">2009</option> <!-- Correct -->
					<option value="6">2010</option>
					<option value="7">2011</option>
					<option value="8">2012</option>
					<option value="9">2013</option>
					<option value="10">2014</option>
					<option value="1">2015</option>
				</select>
			</p>
		</fieldset>
		<br />

		<fieldset>
			<legend>Why was CoffeeScript created?</legend>
			<br />
			<p><label for="why"> </label>
				<textarea id="why" name="why" placeholder="Write your answer here..." rows="4" cols="40"></textarea>
			<!-- To enhance JavaScript's brevity and readability -->
			</p>

		</fieldset>
		<br />

		<fieldset>
			<legend>What was the biggest reason for the decline of CoffeeScript?</legend>
			<br />
			<p><label for="what"> </label>
				<textarea id="what" name="what" placeholder="Write your answer here..." rows="4" cols="40"></textarea>
			<!-- Answer -->
			</p>

		</fieldset>
		<br />

		<div class="submitButton">
			<input type= "submit" value="Submit"/>
			<input type= "reset" value="Reset"/>
		</div>

		<br/>
		<br/>
	</form>
	</section>
	
<?php
	include_once "footer.inc"; // includ the footer
?>

</body>