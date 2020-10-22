<?php
if(!isset($_SESSION['idx'])){
	header('Location: index.php');
}
require_once('Model/Manager/ProjectManager.php');
require_once('Model/Obj/Project.php');


if(isset($_POST['title']) &&  isset($_POST['start-date']) && isset($_POST['end-date']) && isset($_POST['sprint-goal']) && isset($_POST['project']) && isset($_POST['sprintBacklog'])){
	//Créer un nouveau sprint 
	$sprintManager = new SprintManager();
	$sprintIdx = $sprintManager->createSprint(strip_tags(trim($_POST['title'])),strip_tags(trim($_POST['sprint-goal'])),strip_tags(trim($_POST['start-date'])),strip_tags(trim($_POST['end-date'])),strip_tags(trim($_POST['project'])));
	//Créer un nouveau sprint Backlog
	$sprintBacklogManager = new SprintBacklogManager();
	$sprintBacklogIdx = $sprintBacklogManager->createSprintBacklog(strip_tags(trim($_POST['sprintBacklog'])),$sprintIdx);
	$taskManager = new TaskManager();
	foreach ($_POST['userStory'] as $key => $userStory) {
		$sprintBacklogManager->addUserStory($userStory, $sprintBacklogIdx);
		foreach ($_POST['taskName'][$key] as $taskKey => $task) {
			$taskManager->createTask(strip_tags(trim($task)),strip_tags(trim($_POST['taskDescription'][$key][$taskKey])),strip_tags(trim($_POST['taskPriority'][$key][$taskKey])),$userStory);
		}

	}	
	header('Location: index.php?page=project-detail&project='.$_POST['project']);
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
	if($role == 2){
		require_once('Vue/sprint-new.view.php');
	}else{
		header('Location: index.php?page=project-detail&project='.$_POST['project']);
	}		
}else{
	header('Location: index.php?page=project');
}

?>



