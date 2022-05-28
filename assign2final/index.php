<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		include_once "header.inc"; // include the head 
	?>
	<title>Introductory home page</title>
</head>
<body oncontextmenu="return false;">
<?php 
	include_once "menu.inc"; // include the navigation bar 
?>
	<section class="article-section" id="article_section">
        <h1>WELCOME TO COFFEE SCRIPT</h1>

        <h2>A brief introduction to coffescript</h2>
        <div class="paragraph">
            <p>Coffee script is programming language that compiles to JavaScript. 
				It was first introduced in December 13,2009, by American Computer 
				scientist Jeremy Ashkenas who produced Coffee Script as an attempt 
				to simplify and modernize an existing programming language known 
				as ‘Java Script’.
                <br><br>
            </p>
            <figure class="figures">
                <img src="images/download.jfif" alt="images">
                <figcaption>
                    Jeremy Ashkenas<br>
                    Creator of CoffeeScript
                </figcaption>
            </figure>
        </div>
        <div class="paragraph">
            <p> Now if you dont know what JavaScript is, this is what it is in a nutshell.
				It is a coding language used to develop and manage the behaviour of websites, 
				where programmers can implement features such as navigation buttons, imagery, 
				and other functions to allow users to interact with webpages.
				This is also where Coffee Script comes in. Coffee script is a compiling language 
				of JavaScript, which simply refers to the process of taking computer code for a 
				new program or language and transform this into a new language that can be understood 
				by the computer, almost like a translation. 
            </p>
        </div>
		<div class="paragraph">
			
			<a href="https://youtu.be/20g-QwlN6KU" target="_blank"><p>Watch Group Video Introduction About This Site YouTube</p></a>

		</div>
    </section>
<?php
	include_once "footer.inc"; //include the footer
?>

</body>