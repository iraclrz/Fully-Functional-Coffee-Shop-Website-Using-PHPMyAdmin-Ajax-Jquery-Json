<?php require("register.class.php") ?>
<?php
	if(isset($_POST['submit'])){
		$users = new RegisterUser($_POST['name'], $_POST['email'], $_POST['pass']);
	}
?>
<?php

include 'config.php';

if(isset($_POST['submit'])){
	$filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$name = mysqli_real_escape_string($conn, $filter_name);
	$filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
	$email = mysqli_real_escape_string($conn, $filter_email);
	$filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
	$pass = mysqli_real_escape_string($conn, md5($filter_pass));
	$filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
	$cpass = mysqli_real_escape_string($conn, md5($filter_cpass));
	
	
	$select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');
	
	if(mysqli_num_rows($select_users) > 0){
		$message[] = 'User already exist!';
	}else{
		if($pass != $cpass){
			$message[] = 'Confirm password not matched!';
		}else{
			mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
			$message[] = 'Registered sucessfully!';
			//header('location:login.php');
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link rel="stylesheet" href="css/login_register.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<link rel="shortcut icon" type="x-icon" href="images/shop_icon.png">

</head>
<body>



<?php

if(isset($message)){
	foreach($message as $message){
		echo '
		<div class="message">
			<span>'.$message.'</span>
			<i class="fas fa-times" onclick="this.parentElement.remove();"></i>
		</div>
		';
	}
}
?>

<section>
	<div class="imgBx">
		<img src="images/register-fbg.jpg">
	</div>
	<div class="form-container">
		<div class="formBx">
			<h3>Create an account</h3>
			<form action="" method="post" id="myForm">
			
				<div class="inputBx">
					<span>Name</span>
					<input type="text" name="name" placeholder="Enter your name" required class="box">
				</div>
				<div class="inputBx">
					<span>Email</span>
					<input type="email" name="email" placeholder="Enter your email" required class="box">
				</div>
				<div class="inputBx">
					<span>Password</span>
					<input type="password" name="pass" placeholder="Enter your password" required class="password">
					<span class="show_pass">SHOW</span>
				</div>
				<div class="inputBx">
					<span>Confirm your password</span>
					<input type="password" name="cpass" placeholder="Confirm your password" required class="cpassword">
					<span class="show_cpass">SHOW</span>
				</div>
				<div class="inputBx">
					<input type="submit" name="submit" value="Sign up" class="btn">
				</div>
				<div class="inputBx">
					<p>Already have an account? <a href="login.php">Sign in</a></p>
				</div>
				
				<p class="error"></p>
				<p class="success"></p>
			</form>
		</div>
	</div>
		
</section>

<script>
	
	const pass_field = document.querySelector('.password');
	const cpass_field = document.querySelector('.cpassword');
	const showpass_btn = document.querySelector('.show_pass');
	const showcpass_btn = document.querySelector('.show_cpass');
	
	showpass_btn.addEventListener('click', function(){
		if(pass_field.type ==="password"){
			pass_field.type = "text";
			showpass_btn.style.color = "#000000";
			showpass_btn.textContent = "HIDE";
		}
		else
		{
			pass_field.type = "password";
			showpass_btn.style.color = "#000000";
			showpass_btn.textContent = "SHOW";
		}
	});
	showcpass_btn.addEventListener('click', function(){
		if(cpass_field.type ==="password"){
			cpass_field.type = "text";
			showcpass_btn.style.color = "#000000";
			showcpass_btn.textContent = "HIDE";
		}
		else
		{
			cpass_field.type = "password";
			showcpass_btn.style.color = "#000000";
			showcpass_btn.textContent = "SHOW";
		}
	});
</script>
		
		<!--<input type="text" name="name" placeholder="Enter your name" required class="box">
		<input type="email" name="email" placeholder="Enter your email" required class="box">
		<input type="password" name="pass" placeholder="Enter your password" required class="box">
		<input type="password" name="cpass" placeholder="Confirm your password" required class="box">
		<!--<select name="user_type" class="box">
			<option value="user">User</option>
			<option value="admin">Admin</option>
		</select>-->
		<!--<input type="submit" name="submit" value="register now" class="btn">
		<p>Already have an account? <a href="login.php">Login now</a></p>
	</form>
</div>-->
</body>
</html>