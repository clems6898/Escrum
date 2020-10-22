<?php
require_once('Model/Manager/UserManager.php');
require_once('Model/Obj/User.php');
session_destroy();


if(isset($_POST['logMail']) && isset($_POST['logName']) && isset($_POST['logFirstName']) && isset($_POST['logPass'])){
	$um = new UserManager();
	if(!$um->userExist(addslashes(strip_tags(trim($_POST['logMail']))))){
		$newUser = new User(addslashes(strip_tags(trim($_POST['logFirstName']))),addslashes(strip_tags(trim($_POST['logName']))),addslashes(strip_tags(trim($_POST['logMail']))),password_hash(addslashes(strip_tags(trim($_POST['logPass']))), PASSWORD_DEFAULT) ,'0','2');
		$newUser = $um->createNewUser($newUser);
		$_SESSION['idx'] = $newUser->getIdx();
		header('Location: /index.php?page=accueil');
	}
}

include_once('Vue/register.view.php');

?>