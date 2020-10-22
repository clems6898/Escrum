<?php
echo '<!DOCTYPE html>';
echo '<html lang="fr">';
	include_once('/webserver/www/include/header.php');	
	echo '<header>';
		echo '<label id="switch" class="switch">';
			echo '<input type="checkbox" class="theme-switch" checked="true" id="slider">';
			echo '<span class="slider round"></span>';
		echo '</label>';
		echo '<div class="row justify-content-center">';
			echo '<div class="nav col-6">';
				echo '<a class="active" href="index.php?page=project" data-toggle="tooltip" data-placement="bottom" title="My projects"><i class="fas fa-chart-pie fa-lg"></i></a>';
				echo '<a href="index.php?page=my-tasks" data-toggle="tooltip" data-placement="bottom" title="My tasks"><i class="fas fa-tasks fa-lg"></i></a>';
				echo '<a href="index.php" data-toggle="tooltip" data-placement="bottom" title="Log out"><i class="fas fas fa-sign-out-alt fa-lg"></i></a>';
			echo '</div>';
		echo '</div>';
	echo '</header>';

	echo '<body class="background">';
		echo '<div class="row box-content justify-content-center">';
			echo '<div class="sprint-master-col col-6">';
				echo'<form action="index.php?page=sprint-new" method="POST">';
					//Titre
					echo '<div class="row mt-4 justify-content-center">';
							echo '<input type="text" class="form-control" placeholder="Sprint title" name="title" value="Sprint #'.(count($crtProject->getSprints())+1).'"required style="width:60%;">';
					echo '</div>';
					//Les dates
					echo '<div class="row justify-content-center">';
						echo '<div class="col-10 col-md-6 mt-4 text-center">';
							echo '<label for="start-date" class="text-center">Start date : </label>';
							echo '<input type="date" id="start-date" name="start-date" value="'.date('Y-m-d').'" min="'.date('Y-m-d').'" required class="form-control mx-auto" style="width:60%;min-width:120px;">';
						echo '</div>';						
						//date de fin
						echo '<div class="col-10 col-md-6 mt-4 text-center">';
							echo '<label for="end-date" class="text-center">End date : </label>';
							echo '<input type="date" name="end-date" class="form-control mx-auto" value="'.date('Y-m-d',strtotime('+1 month')).'" min="'.date('Y-m-d').'" required style="width:60%;min-width:120px;" >';
						echo '</div>';
					echo '</div>';
					//Objectif du sprint
					echo '<div class="row mt-4 justify-content-center">';
						echo '<textarea class="form-control" placeholder="Sprint goal" rows="3" style="width:80%;min-height:85px;" name="sprint-goal" required></textarea>';
					echo '</div>';
					echo '<hr class="custom-hr mt-4">';
					//sprint backlog
					echo '<div class="row mt-4 justify-content-center">';
							echo '<input type="text" class="form-control" placeholder="Sprint Backlog Name" value="Sprint-Backlog #'.(count($crtProject->getSprints())+1).'" name="sprintBacklog" required style="width:60%;">';
					echo '</div>';
					echo '<hr class="custom-hr mt-4" style="width:60%;">';
					//Une user story et ses taches
					echo '<div id="UserStoriesList">';
						echo '<div id="UserStory0">';
							echo '<div class="row justify-content-center">';
								//Sélection de l'user Story
								echo '<select class="form-control" id="SelectUserStory" name=userStory[0]" style="width:40%;" required>';
									echo '<option value="" selected>Choose User Story</option>';
									foreach ($crtProject->getProductBacklog()->getUserStories() as $userStory) {
										if($userStory->getStatut() !=2){
											echo '<option value="'.$userStory->getIdx().'">'.$userStory->getName().'</option>';
										} 										
									}
									 
								echo '</select>';
								echo '<button type="button" class="ml-2 btn custom-btn btn-minus-plus" id="deleteUserStory0"><i class="fas fa-minus"></i></button>';
							echo '</div>';
							echo '<div id="taskList0">'; //List des tâches pour l'user Story
								echo '<div class="row justify-content-center mt-4" id="task0x0">';
									//Nom de la tache
									echo '<input type="text" class="form-control mx-1 mt-2" placeholder="Task name" style="width:120px;" name="taskName[0][0]" required>';
									//description de la tache
									echo '<textarea class="form-control mx-1 mt-2" placeholder="Task description" rows="1" style="max-width:200px;width:80%;min-height:38px;" name="taskDescription[0][0]" required></textarea>';
									echo '<select class="form-control mx-1 mt-2" id="SelectTaskPriority" style="max-width:200px;width:80%;" required name="taskPriority[0][0]">';
										  echo '<option value="">Choose Priority</option>';
										  echo '<option value="1">Small</option>';
										  echo '<option value="2">Medium</option>';
										  echo '<option value="3">High</option>';
									echo '</select>';
									echo '<button type="button" class="mt-2 ml-2 btn custom-btn btn-minus-plus" id="deleteTask0x0"><i class="fas fa-minus"></i></button>';								
								echo '</div>';	
							echo '</div>';
							echo '<div class="row justify-content-center mt-2">';
                            	echo '<button type="button" class="mt-2 ml-2 btn custom-btn btn-minus-plus" id="addTask0"><i class="fas fa-plus"></i> Add Task</button>';
                       		echo '</div>';
							echo '<hr class="custom-hr mt-4" style="width:60%;">';
						echo '</div>';

					echo '</div>';

					echo '<div>';
						echo '<div class="row justify-content-center mt-4">';
							echo '<button type="button" class="btn custom-btn" id="addUserStory"><i class="fas fa-plus"></i>  Add UserStory</button>';
						echo '</div>';
					echo '</div>';
					echo '<div class="row justify-content-center mt-5 mb-2">';
						echo '<button type="submit" class="btn custom-btn"><i class="fas fa-check"></i>  Valider</button>';
					echo '</div>';
					echo '<input type="hidden" name="project" value="'.$crtProject->getIdx().'">';
				echo'</form>';
			echo '</div>';
		echo '</div>';
	echo '</body>';
	
	include_once('/webserver/www/include/js.php');
	include_once('/webserver/www/include/theme.php');
echo '<script>';

echo '$(function(){';
	//Supprimer l'user story
	echo '$("#deleteUserStory0").click(function(){';
		echo '$("#UserStory0").remove();';
	echo '});';
	//Ajouter une user story 
	echo 'var cptTask0 = 1;';
	echo 'var cptUserStories = 1;';
	echo '$("#addUserStory").click(function(){';
		echo '$.ajax({';
			echo 'type : "POST",';
			echo 'url : "Ajax/addUserStory.php",';
			echo 'data : "project="+'.$crtProject->getIdx().'+"&nb="+cptUserStories,';
			echo 'datatype : "html",';
			echo 'success : function(result){';
				echo '$("#UserStoriesList").append($(result));';
				echo 'cptUserStories++;';
			echo '}';
		echo '});';
	echo '});';
	//Ajoute une tache 
	echo '$("#addTask0").click(function(){';
		echo '$.ajax({';
			echo 'type : "POST",';
			echo 'url : "Ajax/addTask.php",';
			echo 'data : "project="+'.$crtProject->getIdx().'+"&nbUserStory="+0+"&nbTask="+cptTask0,';
			echo 'datatype : "html",';
			echo 'success : function(result){';
				echo '$("#taskList0").append($(result));';
				echo 'cptTask0++;';
			echo '}';
		echo '})';
	echo '});';

	//Suprimer la première tache
	echo '$("#deleteTask0x0").click(function(){';
		echo '$("#task0x0").remove();';
	echo '});';

	echo '$("#start-date").change(function(){';
		echo 'console.log($("#start-date").length);';
	echo '});';

echo '});';
echo '</script>';	
	
echo '</html>';
?>