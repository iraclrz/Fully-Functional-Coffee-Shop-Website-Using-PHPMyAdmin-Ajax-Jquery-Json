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
		<img src="images/forgot_pass_bg.jpg">
	</div>
	
	<div class="form-container">
		<div class="formBx">
			
			<form autocomplete="off" id="ForgotPasswordForm">
			<h3>Forgot Password</h3>
			<div class="form-message" id="msg"></div>
			
				<div class="inputBx">
					<span>Email</span>
					<input type="email" name="email" id="email" placeholder="Enter your email" required class="box">
				</div>
				
				<div class="inputBx">
					<input type="submit" style="width:100%;" name="submit_btn" value="Reset Password" class="btn">
				</div>
				
				
			</form>
		</div>
		
		
			
		
	</div>
		
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$("#ForgotPasswordForm").on('submit',function(e){
			e.preventDefault();
			
			var email = $("#email").val();
			
			//alert(email);
			
			$.ajax({
				type:"POST",
				url:"forgot_password_in.php",
				data:{email:email},
				
				success:function(data){
					$(".form-message").css("display", "block");
					$(".form-message").html(data);
					
				}
			});
		});
		
	});

</script>



</body>
</html>