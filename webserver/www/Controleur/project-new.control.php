<?php

if(!isset($_SESSION['idx'])){
	header('Location: index.php');
}

if(!$_SESSION['role'] == 1){
	header('Location: index.php');
}

require_once('/webserver/www/Model/Manager/ProjectManager.php');

if(isset($_POST['title']) && isset($_POST['start-date']) && isset($_POST['pbTitle']) && isset($_POST['scrumMaster']) && isset($_POST['productOwner']) && isset($_POST['member']) && isset($_POST['description'])){
	$pm = new ProjectManager();
	$projectIdx = $pm->createProject(strip_tags(trim($_POST['title'])),strip_tags(trim($_POST['description'])), strip_tags(trim($_POST['start-date'])));
	$pm->setScrumMaster($projectIdx, strip_tags(trim($_POST['scrumMaster'])));
	$pm->setProductOwner($projectIdx, strip_tags(trim($_POST['productOwner'])));
	$pm->setMembers($projectIdx, $_POST['member']);
	$pm->createProductBacklog($projectIdx, strip_tags(trim($_POST['pbTitle'])));
	header('Location: index.php?page=project-detail&project='.$projectIdx);

}


require_once('Model/Manager/UserManager.php');
$lstUser = array();
$um = new UserManager();
$lstUser = $um->getAllUsers();
require_once('Vue/project-new.view.php');

?>
