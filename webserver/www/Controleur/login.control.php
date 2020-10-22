<?php
require_once('Model/Manager/UserManager.php');

session_destroy();
$um = new UserManager();
$error = false;
if(isset($_POST['logMail']) && isset($_POST['logPass'])){
	if($um->userExist(addslashes(strip_tags(trim($_POST['logMail']))))){
		if(password_verify(addslashes(strip_tags(trim($_POST['logPass']))),$um->getHashPassword(addslashes(strip_tags(trim($_POST['logMail'])))))){
			session_start();
			$user = $um->getUserWithMail(addslashes(strip_tags(trim($_POST['logMail']))));
			$_SESSION['idx'] = $user->getIdx();
			$_SESSION['role'] = $user->getRoleIdx();
			header('location: /index.php?page=project');
		}
		else{
			$error = true;
		}
	}else{
		$error = true;
	}
}
require_once('Vue/login.view.php');




?>