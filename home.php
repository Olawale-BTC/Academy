<?php
	session_start();
	require_once('dbconfig/config.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="main-wrapper">
		<div><?= $_SESSION['message'] ?></div>
		<center><h2>Home Page</h2></center>
		<center><h3>Welcome <?php echo $_SESSION['username']; ?>, <br> Your Email Address Is <?php echo $_SESSION['email']; ?></h3></center>
		
		<form action="logout.php">
			<div class="imgcontainer">
				<img src="<?=$_SESSION['avatar'] ?>" alt="<?=$_SESSION['username'] ?>" class="avatar">
			</div>
			<div class="inner_container">
				<button class="logout_button" type="submit">Log Out</button>	
			</div>
		</form>
	</div>
</body>
</html>