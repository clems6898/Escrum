<?php

if(!isset($_SESSION['idx'])){
	header('Location: index.php');
}
require_once('Model/Manager/ProjectManager.php');
require_once('Model/Obj/Project.php');


$projectManager = new ProjectManager();
$crtProject = $projectManager->getProjectFromIdx($_GET['project']);
if($crtProject->getIdx() != null){
	if($crtProject->isMember($_SESSION['idx']) || $crtProject->isScrumMaster($_SESSION['idx']) || $crtProject->isProductOwner($_SESSION['idx']) ){
		$bool = false;
		$crtSprint = new Sprint();
		foreach($crtProject->getSprints() as $sprint){
			if($sprint->getIdx() == $_GET['sprint']){
				$bool = true;
				$crtSprint = $sprint;
			}
		}
		if($bool == true){
			require_once('Vue/sprint-detail.view.php');
		}else{
			//Page d'erreur 		
			header('Location: index.php?page=project-detail&project='.$_GET['project']);
		}
	}else{
		header('Location: index.php?page=project');
	}		
}else{
header('Location: index.php?page=project');
}



?>