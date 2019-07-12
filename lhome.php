<?php
	session_start();
	require_once('dbconfig/config.php');
	//phpinfo();
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
		<center><h3>Welcome Back <?php echo $_SESSION['username']; ?></h3></center>
		
		<form action="logout.php">
			<div class="inner_container">
				<button class="logout_button" type="submit">Log Out</button>	
			</div>
		</form>
	</div>
</body>
</html>