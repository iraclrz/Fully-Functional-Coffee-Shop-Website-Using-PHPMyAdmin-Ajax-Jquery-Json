<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){
	$filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
	$pass = mysqli_real_escape_string($conn, md5($filter_pass));
	
	
	$select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
	
	if(mysqli_num_rows($select_users) > 0){
		
		$row = mysqli_fetch_assoc($select_users);
		
		if($row['user_type'] == 'admin'){
			$_SESSION['admin_name'] = $row['name'];
			$_SESSION['admin_email'] = $row['email'];
			$_SESSION['admin_id'] = $row['id'];
			header('location:admin_page.php');
			
		}elseif($row['user_type'] == 'user'){
			$_SESSION['user_name'] = $row['name'];
			$_SESSION['user_email'] = $row['email'];
			$_SESSION['user_id'] = $row['id'];
			header('location:home.php');
		}
			
	}else{
		$message[] = 'Incorrect email or password!';
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	
	<link rel="stylesheet" href="css/login_register.css">
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
		<img src="images/bg-final.jpg">
	</div>
	<div class="form-container">
		<div class="formBx">
			<h3>Login now</h3>
			<form action="" method="post">
				<div class="inputBx">
					<span>Email</span>
					<input type="email" name="email" placeholder="Enter your email" required class="box">
				</div>
				<div class="inputBx">
					<span>Password</span>
					<input type="password" name="pass" placeholder="Enter your password" required class="password">
					<span class="show">SHOW</span>
				</div>
				
				<div class="forgot-pass">
					<a href="forgot_password.php">Forgot Password?</a>
				</div>
				
				<!--<div class="remember">
					<label><input type="checkbox" name="">Remember me</label>
				</div>-->
				<div class="inputBx">
					<input type="submit" name="submit" value="Sign in" class="btn">
				</div>
				<div class="inputBx">
					<p>Don't have an account? <a href="register.php">Sign up</a></p>
				</div>
			</form>
		</div>
		
		
			<!--<form action="" method="post">
				<h3>Login now</h3>
				
					
				<input type="email" name="email" placeholder="Enter your email" required class="box">
				
				<input type="password" name="pass" placeholder="Enter your password" required class="box">
				
				
				<input type="submit" name="submit" value="login now" class="btn">
				
				<p>Don't have an account? <a href="register.php">Register now</a></p>
			
			</form>-->
		
	</div>
		
</section>

<script>
	const pass_field = document.querySelector('.password');
	const show_btn = document.querySelector('.show');
	show_btn.addEventListener('click', function(){
		if(pass_field.type ==="password"){
			pass_field.type = "text";
			show_btn.style.color = "#000000";
			show_btn.textContent = "HIDE";
		}
		else
		{
			pass_field.type = "password";
			show_btn.style.color = "#000000";
			show_btn.textContent = "SHOW";
		}
	});
</script>
</body>
</html>