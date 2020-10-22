<?php
require_once('/webserver/www/Model/Manager/Manager.php');
require_once('/webserver/www/Model/Obj/User.php');

class UserManager extends Manager{


	public function addNewMember($firstname, $lastname, $email, $password, $age){
		//$member = new User($firstname, $lastname, $email, $password, $age);
		$rep = $this->pgExecute($this->dbConnect(), "INSERT INTO user_account(firstname, lastname, email, password, age, role_idx) VALUES($1, $2, $3, $4, $5, '1')",$firstname, $lastname, $email, $password, $age );
		return $rep;
	}

	public function getAllUsers(){
		$pgRes = $this->pgExecute($this->dbConnect(),"SELECT idx, firstname, lastname, email, password, age, role_idx FROM user_account");
		$lstUser = array();
		while($pgRow = @pg_fetch_assoc($pgRes)){
			$lstUser[] = new User($pgRow['idx'], $pgRow['firstname'], $pgRow['lastname'], $pgRow['email'], $pgRow['password'], $pgRow['age'], $pgRow['role_idx']);
		}
		return $lstUser;
	}

	public function getHashPassword($email){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT password FROM user_account WHERE email = $1", $email);
		return @pg_fetch_result($pgRes, 0, 0);
	}

	public function userExist($email){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT COUNT(*) FROM user_account WHERE email = $1", $email);
		$number = @pg_fetch_result($pgRes, 0, 0);
		if($number == 0){
			return false;
		}else{
			return true;
		}
	}

	public function getUserIdx($email){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT idx FROM user_account WHERE email = $1", $email);
		return @pg_fetch_result($pgRes, 0, 0);
	}

	public function createNewUser($user){
		$pgRes = $this->pgExecute($this->dbConnect(), "INSERT INTO user_account (idx, firstname, lastname, email, password, age, role_idx) VALUES( DEFAULT, $1, $2, $3, $4, $5, $6)",$user->getFirstname(),$user->getLastname(), $user->getEmail(), $user->getPassword(), $user->getAge(), $user->getRoleIdx());
		$idx = $this->getUserIdx($user->getEmail());
		$user->setIdx($idx);
		return $user;
	}

	public function getUserWithMail($email){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT idx, firstname, lastname, email, password, age, role_idx FROM user_account WHERE email = $1", $email);
		$row = @pg_fetch_row($pgRes);
		$us = new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
		return $us;
	}

	public function getUserWithIdx($idx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT idx, firstname, lastname, email, password, age, role_idx FROM user_account WHERE idx = $1", $idx);
		$row = @pg_fetch_row($pgRes);
		$us = new User($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6]);
		return $us;
	}
}


?>