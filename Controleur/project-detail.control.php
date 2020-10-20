<?php
if(!isset($_SESSION['idx'])){
	header('Location: index.php');
}
require_once('Model/Manager/ProjectManager.php');
require_once('Model/Obj/Project.php');
$projectManager = new ProjectManager();
$crtProject = $projectManager->getProjectFromIdx($_GET['project']);
if($crtProject->getIdx() != null){
	if($crtProject->isMember($_SESSION['idx'])){
		$role = 3; //développeur
	}elseif($crtProject->isScrumMaster($_SESSION['idx'])){
		$role = 2; //scrum Master
	}
	elseif($crtProject->isProductOwner($_SESSION['idx'])){
		$role = 1; //Product owner
	}else{
		$role = 0; //N'est pas dans le projet
	}
	require_once('Vue/Project-detail.view.php');
}else{
	var_dump("existe pas");
}



//require_once("Vue/Project-detail.view.php");
//Afficher les détails pour le projet passé en paramètre
//Tester si le projet existe et si l'utilisateur connecté a bien accès à ce sprint 
//Si oui, afficher les détails de ce sprint
//Tester si l'utilisateur est bien scrumMaster



?>