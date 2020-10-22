<?php

if(!isset($_SESSION['idx'])){
	header('Location: index.php');
}
require_once('Model/Obj/Project.php');
require_once('Model/Manager/ProjectManager.php');
$ProjectManager = new ProjectManager();
$lstProject = $ProjectManager->getListProjectFromUser($_SESSION['idx']);
require_once('Vue/project.view.php');


//Afficher les différents projets pour l'utilisateur connecté 

?>