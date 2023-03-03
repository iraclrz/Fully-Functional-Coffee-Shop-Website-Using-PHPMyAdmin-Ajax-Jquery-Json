<?php

include("config.php");

if(isset($_POST['email'])){
	$email = $_POST['email'];
	
	$query = "SELECT * FROM users WHERE email = '$email'";
	$r = mysqli_query($conn, $query);
	
	if(empty($email)){
		
		echo "Field is empty";
	}else{
		if(mysqli_num_rows($r) > 0){
			$token = uniqid(md5(time()));
			
			$insert_query = "INSERT INTO forgot_password(email, token) VALUES('$email', '$token')";
			$res = mysqli_query($conn, $insert_query);
			
			echo "Click <a href='reset.php?token=$token'>here<a/> to reset your password";
		}else{
			
			echo "User not found";
		}
	}
}

?>