<?php
class LoginUser{
	private $email;
	private $pass;
	public $error;
	public $success;
	private $storage = "data.json";
	private $stored_users;
	
	public function __construct($email, $pass){
		$this->email = $email;
		$this->pass = $pass;
		$this->stored_users = json_decode(file_get_contents($this->storage), true);
		$this->login();
	}
	
	private function login(){
		foreach ($this->stored_users as $users){
			if($users['email'] == $this->email){
				if(password_verify($this->pass, $users['pass'])){
					session_start();
					$_SESSION['users'] = $this->email;
					if($users['user_type'] == 'admin'){
						header("location:admin_page.php"); exit();
					}elseif($users['user_type'] == 'user'){
						header("location:home.php"); exit();
					}
				}
			}
		}
		return $this->error = "Wrong email or password";
	}
	
}
?>