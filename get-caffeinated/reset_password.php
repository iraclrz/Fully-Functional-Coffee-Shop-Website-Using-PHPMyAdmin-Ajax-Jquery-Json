<?php

include("config.php");
if(isset($_POST['email']) || ($_POST['password']) || ($_POST['confirmpassword'])){
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirmpassword = $_POST['confirmpassword'];
	
	if(empty($password)|| empty($confirmpassword)){
		
		echo "Empty fields";
	}else{
		if($password == $confirmpassword){
			$hashed = md5($password);
			
			$query = "UPDATE users SET password = '$hashed' WHERE email = '$email'";
			$res = mysqli_query($conn,$query);
			
			$query_dlt = "DELETE FROM forgot_password WHERE email = '$email'";
			$res_dlt = mysqli_query($conn,$query_dlt);
			
			
			echo "Password is updated successfully! Click <a href='login.php'>here</a> to login again. ";
			
			
		}else{
			echo "Passwords do not match";
		}
	}
}
?>