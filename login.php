<?php
	session_start();
	$_SESSION['message'] = '';

	$server = "localhost";
	$dusername = "root";
	$dpassword = "";
	$database = "academy";

	$conn = mysqli_connect($server, $dusername, $dpassword, $database);
	if (!$conn) {
		die ('Failed to connect to MySQL: ' . mysqli_connect_error());	
	}

	if(isset($_POST['username'])) {

		$username = $_POST['username'];
		$password = $_POST['password'];

		$_SESSION['username'] = $username;

		$sql="SELECT * FROM users WHERE username='".$username."'AND password='".$password."' limit 1"; 

		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result)==1) {
			$_SESSION['message'] = '<script type="text/javascript">alert("You Have Successfully Logged In")</script>';
			header("location: lhome.php");
		} else {
			$_SESSION['message'] = '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
		}
		
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>Login Form</h2></center>
			<div class="imgcontainer">
				<img src="images/avatar.png" alt="Avatar" class="avatar">
			</div>
		<form action="#" method="post">
		
			<div class="inner_container">
			<div><?= $_SESSION['message'] ?></div>
				<label><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="username" required>
				<label><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" required>
				<button class="login_button" name="login" type="submit">Login</button>
				<a href="index.php"><button type="button" class="register_btn">Register</button></a>
			</div>
		</form>
	</div>
</body>
</html>