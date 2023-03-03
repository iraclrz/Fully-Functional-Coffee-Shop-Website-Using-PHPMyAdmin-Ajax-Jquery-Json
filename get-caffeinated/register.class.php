<?php
class RegisterUser{
	private $name;
	private $email;
	private $raw_password;
	private $encrypted_password;
	private $user_type = "user";
	public $error;
	public $success;
	private $storage = "data.json";
	private $stored_users;
	private $raw_user;
	private $new_user; //array
	
	public function __construct($name, $email, $pass){
		$this->name = trim($this->name);
		$this->name = filter_var($name, FILTER_SANITIZE_STRING);
		
		$this->email = trim($this->email);
		$this->email = filter_var($email, FILTER_SANITIZE_STRING);
		
		$this->raw_password = filter_var(trim($pass), FILTER_SANITIZE_STRING);
		$this->encrypted_password = password_hash($this->raw_password, PASSWORD_DEFAULT);
		
		$this->stored_users = json_decode(file_get_contents($this->storage), true);
		
		$this->new_user = [
			"name" => $this->name,
			"email" => $this->email,
			"pass" => $this->encrypted_password,
			"user_type" => $this->user_type,
		];
		
		if($this->checkFieldValues()){
			$this->insertUser();
		}
	}
	
	private function checkFieldValues(){
		if(empty($this->name) || empty($this->email) || empty($this->raw_password)){
			$this->error = "Fill out all the required fields.";
			return false;
		}else{
			return true;
		}
	}
	
	private function emailExists(){
		foreach($this->stored_users as $users){
			if($this->email == $users['email']){
				$this->error = "Email already taken, please choose a different one.";
				return true;
			}
		}
		return false;
	}
	
	private function insertUser(){
		if($this->emailExists()== FALSE){
			array_push($this->stored_users, $this->new_user);
			if(file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))){
				
			}else{
				return $this->error = "Something went wrong, please try again.";
			}
		}
	}
}
?>