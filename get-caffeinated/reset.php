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
	<title>Reset Password</title>
	
	<link rel="stylesheet" href="css/login_register.css">
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
	<link rel="shortcut icon" type="x-icon" href="images/shop_icon.png">
</head>
<body>



<?php

include("config.php");

if(isset($_GET['token'])){
	$token = $_GET['token'];
	$query = "SELECT * FROM forgot_password WHERE token = '$token'";
	$r = mysqli_query($conn, $query);
	
	if(mysqli_num_rows($r) > 0){
		$row = mysqli_fetch_array($r);
		$email = $row['email'];
	}
}

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
			
			<form autocomplete="off" id="ResetPasswordForm">
			<h3>Reset Password</h3>
			<div class="form-message" id="msg"></div>
			<!--<form action="" method="post">-->
				<div class="inputBx">
					<span>Email</span>
					<input type="email" name="email" id="email" value="<?php echo $email;?>" placeholder="Enter your email" required class="box">
				</div>
				
				<div class="inputBx">
					<span>Password</span>
					<input type="password" name="pass" id="password" placeholder="Enter your password" required class="password">
					<span class="show_pass">SHOW</span>
				</div>
				<div class="inputBx">
					<span>Confirm your password</span>
					<input type="password" name="cpass" id="confirmpassword" placeholder="Confirm your password" required class="cpassword">
					<span class="show_cpass">SHOW</span>
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
		
		$("#ResetPasswordForm").on('submit',function(e){
			e.preventDefault();
			var email = $("#email").val();
			var password = $("#password").val();
			var confirmpassword = $("#confirmpassword").val();
			
			$.ajax({
				type:"POST",
				url:"reset_password.php",
				data:{email:email,password:password,confirmpassword:confirmpassword},
				
				success:function(data){
					$(".form-message").css("display","block");
					$(".form-message").html(data);
					$("#ResetPasswordForm")[0].reset();
				}
			});
			
		});
	});
	
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

	

	
	/*let input2 = document.querySelector('.password');
	let show_btn = document.querySelector('.show_btn');
	
	show_btn.addEventListener('click', () => {
		if(input2.type ==="password"){
			input2.type = "text";
			shoe_btn.style.color: "#000000";
			show_btn.textContent = "HIDE";
		}
	});
		/*if(btn.innerText === "SHOW"){
			btn.innerText = "HIDE";
			input2.type = "text";
		}
		else{
			btn.innerText = "SHOW";
			input2.type = "password";
		}
	})*/
	/*let input3 = document.querySelector('.cpassword');
	let btn2 = document.querySelector('.show_btn2');
	
	btn2.addEventListener('click', () => {
		if(btn2.innerText === "SHOW"){
			btn2.innerText = "HIDE";
			input3.type = "text";
		}
		else{
			btn2.innerText = "SHOW";
			input3.type = "password";
		}
	})*/
	
	
	
	
</script>
</body>
</html>