<?php
session_start();
$_SESSION['message'] = '';

require_once('dbconfig/config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	//two password are equal
	if($_POST['password'] == $_POST['cpassword']) {
		$username = $mysqli->real_escape_string($_POST['username']);
		$email = $mysqli->real_escape_string($_POST['email']);
		$password = $mysqli->real_escape_string($_POST['password']);
		$avatar_path = $mysqli->real_escape_string('images/uploads/'.$_FILES['avatar']['name']);

		//make sure file type is image
		if(preg_match("!image!", $_FILES['avatar']['type'])) {
			//copy image to folder
			if(copy($_FILES['avatar']['tmp_name'], $avatar_path)) {
				$_SESSION['username'] = $username;
				$_SESSION['email'] = $email;
				$_SESSION['avatar'] = $avatar_path;

				$sql = "INSERT INTO users (username, email, password, avatar)". "VALUES('$username','$email','$password','$avatar_path')"; 

				//if query is successful redirect to home page
				if($mysqli->query($sql) === true) {
					$_SESSION['message'] = "<script type='text/javascript'>alert('Registration Successful! Added $username to the database!')</script>";
					header("location: home.php");
				} else {
					$_SESSION['message'] = "<script type='text/javascript'>alert('User could not be added to the daatbase!')</script>";
				}
			} else {
				$_SESSION['message'] = "<script type='text/javascript'>alert('File Uploade Fail!')</script>";
			}
		} else {
			$_SESSION['message'] = "<script type='text/javascript'>alert('Please only upload GIF, JPG or PNG images!')</script>";
		}
	} else {
		$_SESSION['message'] = "<script type='text/javascript'>alert('Two Password do not match!')</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Sign Up Page</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color:#bdc3c7">
	<div id="main-wrapper">
	<center><h2>Sign Up Form</h2></center>
		<form action="index.php" method="POST" enctype="multipart/form-data">
			<div class="inner_container">
				<div><?= $_SESSION['message'] ?></div>
				<label for="username"><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="username" required>
				<label for="email"><b>Email</b></label>
				<input type="email" placeholder="Enter Email" name="email" required>
				<label  for="password"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="password" required>
				<label  for="cpassword"><b>Confirm Password</b></label>
				<input type="password" placeholder="Enter Password" name="cpassword" required>
				<label>
					Select Your Avatar: <input type="file" name="avatar" accept="image/*" style="margin-bottom:15px" required>
				</label>

				<button class="sign_up_btn" type="submit">Sign Up</button>
				
				<a href="login.php"><button type="button" class="back_btn"><< Back to Login</button></a>
			</div>
		</form>
	</div>
</body>
</html>