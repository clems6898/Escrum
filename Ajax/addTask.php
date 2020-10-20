<?php
session_start();
require_once('/webserver/www/Model/Manager/ProjectManager.php');

if(isset($_POST['project'])){
	$ProjectManager = new ProjectManager();
	$crtProject = $ProjectManager->getProjectFromIdx($_POST['project']);
}

if(isset($_POST['nbUserStory'])){
	$crtUserStory = $_POST['nbUserStory'];
}

if(isset($_POST['nbTask'])){
	$crtTask = $_POST['nbTask'];
}

if($crtProject){
	if($crtProject->getIdx() != null && $crtProject->isScrumMaster($_SESSION['idx'])){
	
		echo '<div class="row justify-content-center mt-4" id="task'.$crtUserStory.'x'.$crtTask.'">';
			//Nom de la tache
			echo '<input type="text" class="form-control mx-1 mt-2" placeholder="Task name" style="width:120px;" name="taskName['.$crtUserStory.']['.$crtTask.'] required">';
			//description de la tache
			echo '<textarea class="form-control mx-1 mt-2" placeholder="Task description" rows="1" style="max-width:200px;width:80%;min-height:38px;" name="taskDescription['.$crtUserStory.']['.$crtTask.']" required></textarea>';
			echo '<select class="form-control mx-1 mt-2" style="max-width:200px;width:80%;" required name="taskPriority['.$crtUserStory.']['.$crtTask.']">';
				  echo '<option value="">Choose Priority</option>';
				  echo '<option value="1">Small</option>';
				  echo '<option value="2">Medium</option>';
				  echo '<option value="3">High</option>';
			echo '</select>';
			echo '<button type="button" class="mt-2 ml-2 btn custom-btn btn-minus-plus" id="deleteTask'.$crtUserStory.'x'.$crtTask.'"><i class="fas fa-minus"></i></button>';								
		echo '</div>';				
			
		echo '<script>';
		echo '$(function(){';
			//Supprimer la tâche
			echo '$("#deleteTask'.$crtUserStory.'x'.$crtTask.'").click(function(){';
				echo '$("#task'.$crtUserStory.'x'.$crtTask.'").remove();';
			echo '});';
		
		echo '});';
		echo '</script>';	
	}
}




?>