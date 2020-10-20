<?php

if(!isset($_SESSION['idx'])){
	header('Location: index.php');
}
require_once('Model/Obj/Task.php');
require_once('Model/Manager/TaskManager.php');
$TaskManager = new TaskManager();
$lstTask = $TaskManager->getTaskUser($_SESSION['idx']);
require_once('Vue/tasks.view.php');


//Afficher les différents projets pour l'utilisateur connecté 

?>