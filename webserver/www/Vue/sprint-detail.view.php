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
			echo '<a href="index.php?page=sprint-backlog&project='.$crtProject->getIdx().'&sprint='.$crtSprint->getIdx().'" class="master-col col-6">';
				echo '<h4>'.$crtSprint->getSprintBacklog()->getName().'</h4>';
				echo '<div class="row justify-content-around">';
					echo '<p><strong>Number of User Stories choosen : </strong> '.count($crtSprint->getSprintBacklog()->getUserStories()).'</p>';
				echo '</div>';
			echo '</a>';
		echo '</div>';
		echo '<div class="row box-content justify-content-center">';
			echo '<div class="sprint-master-col col-6">';
				echo '<h4>'.$crtSprint->getName().'</h4>';
				echo '<div class="description text-center">';
					echo '<p><strong>Goal :</strong> '.$crtSprint->getObjectif().'</p>';
				echo '</div>';
				echo '<div class="row justify-content-around">';
					echo '<hr class="custom-hr">';
					echo '<div class="sub-col col-10 col-lg-5 text-center">';
							echo '<p><strong>Start date : </strong>'.date('d/m/Y', strtotime($crtSprint->getCreationDate())).'</p>';
					echo '</div>';
					echo '<div class="sub-col col-10 col-lg-5 text-center">';
							echo '<p><strong>End date : </strong>'.$crtSprint->getEndDate().'</p>';	
					echo '</div>';
					echo '<div class="sub-col col-10 col-lg-5 text-center">';
							echo '<p><strong>Number of tasks : </strong>'.$crtSprint->getNbTache().'</p>';
					echo '</div>';
					echo '<div class="sub-col col-10 col-lg-5 text-center">';
							echo '<p><strong>Sprint complexity : </strong>'.$crtSprint->getComplexity().'</p>';
					echo '</div>';
					echo '<div class="sub-col col-10 col-lg-5 text-center">';
							echo '<p><strong>Status : </strong>'.$crtSprint->getStatut().'</p>';
					echo '</div>';
					echo '<hr class="custom-hr">';
				echo '</div>';
				echo '<div class="sub-col col-10 col-lg-5 text-center">';
					echo '<p class="mb-1">Sprint progress</p>';
					echo '<div class="progress mb-2">';
						echo '<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:'.$crtSprint->getAvancee().'%;">'.$crtSprint->getAvancee().'%</div>';
					echo '</div>';
					echo '<p class="mb-1">Tasks progress</p>';
						echo '<div class="progress mb-2">';
						echo '<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:'.$crtSprint->getTaskAvancee().'%;">'.$crtSprint->getTaskAvancee().'%</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="row justify-content-around mt-4">';
					echo '<hr class="custom-hr">';
				echo '</div>';
				echo '<div class="row justify-content-center sprint-tasks">';
				
					echo '<div class="col-12">';
						echo '<p class="text-center mb-1"><strong>To Do :  </strong></p>';
						echo '<div class="text-center mb-2">';
						if ($crtSprint->getTasksToDo() == null){
							echo '<p>No task !</p>';
						}else{
							foreach ($crtSprint->getTasksToDo() as $task) {
								echo '<a data-toggle="modal" data-task="'.$task->getIdx().'" data-target="#taskModal" class="inline priority-box priority-';
								if($task->getPriority() == 1){
									echo 'small';
								}elseif($task->getPriority() == 2){
									echo 'medium';
								}else{
									echo 'high';
								}										
								echo '">'.$task->getName().'</a>';
							}
					}
						echo '</div>';
					echo '</div>';
					echo '<div class="col-12">';
						echo '<p class="text-center mb-1"><strong>In Progress :  </strong></p>';
						echo '<div class="text-center mb-2">';
						if ($crtSprint->getTasksInProgress() == null){
							echo '<p>No task !</p>';
						}else{								
							foreach ($crtSprint->getTasksInProgress() as $task) {
								echo '<a data-toggle="modal" data-task="'.$task->getIdx().'" data-target="#taskModal" class="inline priority-box priority-';
								if($task->getPriority() == 1){
									echo 'small';
								}elseif($task->getPriority() == 2){
									echo 'medium';
								}else{
									echo 'high';
								}										
								echo '">'.$task->getName().'</a>';
							}	
						}
						echo '</div>';
					echo '</div>';
					echo '<div class="col-12">';
						echo '<p class="text-center mb-1"><strong>Completed :  </strong></p>';
						echo '<div class="text-center mb-2">';
						if ($crtSprint->getTasksDone() == null){
								echo '<p>No task !</p>';
						}else{							
							foreach ($crtSprint->getTasksDone() as $task) {
								echo '<a data-toggle="modal" data-task="'.$task->getIdx().'" data-target="#taskModal" class="inline priority-box priority-';
								if($task->getPriority() == 1){
									echo 'small';
								}elseif($task->getPriority() == 2){
									echo 'medium';
								}else{
									echo 'high';
								}										
								echo '">'.$task->getName().'</a>';
							}
						}	
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		//Modal
		echo '<div class="modal fade" id="taskModal" tabindex="-1" role="dialog">';
		  	echo '<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">';
		    	echo '<div class="modal-content">';
			      	
		    	echo '</div>';
		  	echo '</div>';
		echo '</div>';
	echo '</body>';
	
	include_once('/webserver/www/include/js.php');
	include_once('/webserver/www/include/theme.php');
	echo '<script>';
	echo '$(function(){';	
		echo '$("#taskModal").on("show.bs.modal", function(e){';
			echo 'var id= $(e.relatedTarget).data("task");';			
			echo '$.ajax({';
				echo 'type : "POST",';
				echo 'url : "Ajax/getTask.php",';
				echo 'data : "task="+id+"&nb="+2,';
				echo 'success : function(result){';
					echo '$(".modal-content").empty();';
					echo '$(".modal-content").append($(result));';					
				echo '}';
			echo '});';				
		echo '});';
	echo '});';
	echo '</script>';
	
echo '</html>';
?>