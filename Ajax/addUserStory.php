<?php
session_start();
require_once('/webserver/www/Model/Manager/ProjectManager.php');

if(isset($_POST['project'])){
	$ProjectManager = new ProjectManager();
	$crtProject = $ProjectManager->getProjectFromIdx($_POST['project']);
}

if(isset($_POST['nb'])){
	$crtNumber = $_POST['nb'];
}

if($crtProject){
	if($crtProject->getIdx() != null && $crtProject->isScrumMaster($_SESSION['idx'])){
		echo '<div id="UserStory'.$crtNumber.'">';
			echo '<div class="row justify-content-center">';
				//Sélection de l'user Story
				echo '<select class="form-control" name=userStory['.$crtNumber.']" style="width:40%;" required>';
					echo '<option value="" selected>-- Choose User Story --</option>';
					foreach ($crtProject->getProductBacklog()->getUserStories() as $userStory) {
						if($userStory->getStatut() != 2){
							echo '<option value="'.$userStory->getIdx().'">'.$userStory->getName().'</option>';
						} 										
					}
					 
				echo '</select>';
				echo '<button type="button" class="ml-2 btn custom-btn btn-minus-plus" id="deleteUserStory'.$crtNumber.'"><i class="fas fa-minus"></i></button>';
			echo '</div>';
			echo '<div id="taskList'.$crtNumber.'">'; //List des tâches pour l'user Story
				echo '<div class="row justify-content-center mt-4" id="task'.$crtNumber.'x0">';
					//Nom de la tache
					echo '<input type="text" class="form-control mx-1 mt-2" placeholder="Task name" style="width:120px;" name="taskName['.$crtNumber.'][0] required">';
					//description de la tache
					echo '<textarea class="form-control mx-1 mt-2" placeholder="Task description" rows="1" style="max-width:200px;width:80%;min-height:38px;" name="taskDescription['.$crtNumber.'][0]" required></textarea>';
					echo '<select class="form-control mx-1 mt-2" style="max-width:200px;width:80%;" required name="taskPriority['.$crtNumber.'][0]">';
						  echo '<option value="">Choose Priority</option>';
						  echo '<option value="1">Small</option>';
						  echo '<option value="2">Medium</option>';
						  echo '<option value="3">High</option>';
					echo '</select>';
					echo '<button type="button" class="mt-2 ml-2 btn custom-btn btn-minus-plus" id="deleteTask'.$crtNumber.'x0"><i class="fas fa-minus"></i></button>';								
				echo '</div>';				
			echo '</div>';
			echo '<div class="row justify-content-center mt-2">';
            	echo '<button type="button" class="mt-2 ml-2 btn custom-btn btn-minus-plus" id="addTask'.$crtNumber.'"><i class="fas fa-plus"></i> Add Task</button>';
       		echo '</div>';
			echo '<hr class="custom-hr mt-4" style="width:60%;">';
		echo '</div>';


		echo '<script>';
		echo '$(function(){';
			//Supprimer l'user story
			echo '$("#deleteUserStory'.$crtNumber.'").click(function(){';
				echo '$("#UserStory'.$crtNumber.'").remove();';
			echo '});';
			//Ajouter une user tache 
			echo 'var cptTask'.$crtNumber.' = 1;';
			echo '$("#addTask'.$crtNumber.'").click(function(){';
				echo '$.ajax({';
					echo 'type : "POST",';
					echo 'url : "Ajax/addTask.php",';
					echo 'data : "project="+'.$crtProject->getIdx().'+"&nbUserStory="+'.$crtNumber.'+"&nbTask="+cptTask'.$crtNumber.',';
					echo 'datatype : "html",';
					echo 'success : function(result){';
						echo '$("#taskList'.$crtNumber.'").append($(result));';
						echo 'cptTask'.$crtNumber.'++;';
					echo '}';
				echo '})';
			echo '});';

			echo '$("#deleteTask'.$crtNumber.'x0").click(function(){';
				echo '$("#task'.$crtNumber.'x0").remove();';
			echo '});';
		
		echo '});';
		echo '</script>';	
	}
}




?>