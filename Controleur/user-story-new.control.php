<?php
if(!isset($_SESSION['idx'])){
	header('Location: index.php');
}
require_once('Model/Manager/ProjectManager.php');
require_once('Model/Obj/Project.php');
require_once('Model/Manager/UserStoryManager.php');
require_once('Model/Obj/UserStory.php');

if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['complexity']) && isset($_POST['ProductBacklogIdx']) && isset($_POST['project'])){	
	$um = new UserStoryManager();
	$um->createUserStory(strip_tags(trim($_POST['title'])), strip_tags(trim($_POST['description'])), strip_tags(trim($_POST['complexity'])), addslashes(strip_tags(trim($_POST['ProductBacklogIdx']))));
	$projectManager = new ProjectManager();
	$crtProject = $projectManager->getProjectFromIdx($_POST['project']);
	if($crtProject->getIdx() != null){
		header('Location: index.php?page=product-backlog&project='.$_POST['project']);
	}else{
		header('Location: index.php?page=project');
	}
}


$projectManager = new ProjectManager();
$crtProject = $projectManager->getProjectFromIdx($_POST['project']);
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
	if($role == 1){
		require_once('Vue/user-story-new.view.php');
	}else{
		header('Location: index.php?page=product-backlog&project='.$_POST['project']);
	}		
}else{
	header('Location: index.php?page=project');
}




//require_once("Vue/Project-detail.view.php");
//Afficher les détails pour le projet passé en paramètre
//Tester si le projet existe et si l'utilisateur connecté a bien accès à ce sprint 
//Si oui, afficher les détails de ce sprint
//Tester si l'utilisateur est bien scrumMaster



?>