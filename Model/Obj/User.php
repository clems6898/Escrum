<?php

class User{

	//Members
	private $idx; 
	private $firstname;
	private $lastname;
	private $email;
	private $password;
	private $age;
	private $role_idx;


	public function __construct(){
		$arg = func_get_args();		
		switch (func_num_args()) {
			case '6': 
				$this->idx = 0;
				$this->firstname = $arg[0];
				$this->lastname = $arg[1];
				$this->email = $arg[2];
				$this->password = $arg[3];
				$this->age = $arg[4];
				$this->role_idx = $arg[5]; 
				break;
			case '7':
				$this->idx = $arg[0];
				$this->firstname = $arg[1];
				$this->lastname = $arg[2];
				$this->email = $arg[3];
				$this->password = $arg[4];
				$this->age = $arg[5];
				$this->role_idx = $arg[6];
				break;			
			default:
				$this->idx = 0;
				$this->firstname = null;
				$this->lastname = null;
				$this->email = null;
				$this->password = null;
				$this->age = 0;
				$this->role_idx = 0;
				break;
		}
	}

	public function getIdx(){
		return $this->idx;
	}

	public function setIdx($idx){
		$this->idx = $idx;
	}

	public function getFirstname(){
		return $this->firstname;
	}

	public function setFirstname($firstname){
		$this->firstname = $firstname;
	}

	public function getLastname(){
		return $this->lastname;
	}

	public function setLastname($lastname){
		$this->lastname = $lastname;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getAge(){
		return $this->age;
	}

	public function setAge($age){
		$this->age = $age;
	}

	public function getRoleIdx(){
		return $this->role_idx;
	}

	public function setRoleIdx($role_idx){
		$this->role_idx = $role_idx;
	}

	

}



?>