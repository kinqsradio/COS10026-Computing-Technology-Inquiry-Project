<?php session_start(); ?>
<?php include('setting.php');
$con = @mysqli_connect($host,$user,$pwd,$sql_db); ?>
<html>
<head>
<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
	<meta charset="utf-8" />
	<meta name="description" content="Assignment 2"/>
	<meta name="keywords" content="HTML5,PHP" />
	<link rel="icon" href="./images/ico.jpeg">
	<meta name="author" content="Tran Duc Anh Dang, Nguyen Nam Tung, Tran Quang Thanh"  />
	<link rel="stylesheet" href="styles/admin.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,400;1,400&family=Comfortaa&display=swap" rel="stylesheet">
  <title>Admin Page</title>
</head>
<body>
<section>
		<div class="topnav">
			<strong><a href="index.php">HOME</a></strong>
			<strong><a href="topic.php">TOPIC</a></strong>
			<strong><a href="quiz.php">QUIZ</a></strong>
			<strong><a href="enhancements.php">ENHANCEMENTS</a></strong>
			<strong><a href="phpenhancements.php">ENHANCEMENTS 2</a></strong>
			<strong><a href="admin.php"  class="active">MANAGE</a></strong>
		</div>
</section>
	<section class="article-section">
		<div class="form-wrapper">
		
		<form action="#" method="post">
			
			<div class="form-item">
				<input type="text" name="user" required="required" placeholder="Username" autofocus required></input>
			</div>
			
			<div class="form-item">
				<input type="password" name="pass" required="required" placeholder="Password" required></input>
			</div>
			
			<div class="button-panel">
				<input type="submit" class="button" title="Log In" name="login" value="Login"></input>
			</div>
		</form>
		<?php
			//username: admin, password: admin
			if (isset($_POST['login']))
				{
					$username = mysqli_real_escape_string($con, $_POST['user']);
					$password = mysqli_real_escape_string($con, $_POST['pass']);
					$query 		= mysqli_query($con, "SELECT * FROM users WHERE password='$password' and username='$username'");
					$row		= mysqli_fetch_array($query);
					$num_row 	= mysqli_num_rows($query);
					
					if ($num_row > 0) 
						{			
							$_SESSION['user_id']=$row['user_id'];
							header('location:manage.php'); //Redirect to manage
						}
					else
						{
							echo 'Invalid Username and Password Combination'; // Error message
						}
				}
		?>
		</div>
	</section>
<?php
	include_once "footer.inc";
?>
</body>
</html>