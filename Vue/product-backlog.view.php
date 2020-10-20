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
            echo '<div class="header-col py-0 col-6">';
                echo '<h4>'.$crtProject->getProductBacklog()->getName().'</h4>';
            echo '</div>';
        echo '</div>';
		
		if($role !=0){
			foreach ($crtProject->getProductBacklog()->getUserStories() as $key => $user_story) {
				echo '<div class="row box-content justify-content-center">';
					echo '<div class="user-story-master-col col-6">';
						echo '<div class="row justify-content-center">';
							switch ($user_story->getStatut()) {
								case '0': echo'<div class="inline user-story-status status-none" title="Pending"></div>';									
									break;
								case '1': echo'<div class="inline user-story-status status-inprogress" title="In progress"></div>';									
									break;
								case '2': echo'<div class="inline user-story-status status-completed" title="Completed"></div>';									
									break;
								
								default:
									echo'<div class="inline user-story-status status-none" data-toggle="tooltip" data-placement="bottom" title="Pending"></div>';	
									break;
							}							
							echo '<h4 class="inline ml-2">'.$user_story->getName().'</h4>';
						echo '</div>';
						echo '<div class="row justify-content-center">';
							echo '<hr class="custom-hr">';
							echo '<div class="sub-col col-10">';								
								echo '<div class="row">';
									echo '<p><strong>Description : </strong>'.$user_story->getDescription().'</p>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="row justify-content-center">';
							echo '<hr class="custom-hr">';
							echo '<div class="sub-col col-10">';							
								echo '<div class="row">';
									echo '<p><strong>Number of tasks : </strong>'.$user_story->getNbTache().'</p>';
								echo '</div>';
								echo '<div class="row">';
									echo '<p><strong>Complexity : </strong>'.$user_story->getComplexity().'</p>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="row justify-content-center sprint-tasks">';
							echo '<hr class="custom-hr">';
							echo '<div class="col-12">';
								echo '<div class="text-center mb-3">';
								if($user_story->getTasks()!=null){
									foreach ($user_story->getTasks() as $task) {		
										switch ($task->getPriority()) {
											case '1': echo '<a data-toggle="modal" data-task="'.$task->getIdx().'" data-target="#taskModal" class="inline priority-box priority-small">'.$task->getName().'</a>';
												break;
											case '2': echo '<a data-toggle="modal" data-task="'.$task->getIdx().'" data-target="#taskModal" class="inline priority-box priority-medium">'.$task->getName().'</a>';
												break;
											case '3': echo '<a data-toggle="modal" data-task="'.$task->getIdx().'" data-target="#taskModal" class="inline priority-box priority-high">'.$task->getName().'</a>';
												break;											
											default:
												echo '<a data-toggle="modal" data-task="'.$task->getIdx().'" data-target="#taskModal" class="inline priority-box priority-small">'.$task->getName().'</a>';
												break;
										}
									}
								}else{
									echo '<p><strong>No task !</strong></p>';
								}
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="row justify-content-center">';
							echo '<hr class="custom-hr">';
							echo '<div class="sub-col col-10 text-center">';
								echo '<p class="mb-1">User Story progress</p>';
								echo '<div class="progress mb-2">';
									echo '<div class="progress-bar" role="progressbar" aria-valuenow="'.$user_story->getAvancee().'" aria-valuemin="0" aria-valuemax="100" style="width:'.$user_story->getAvancee().'%;">'.$user_story->getAvancee().'%</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
			
			if($role == 1){
				echo '<div class="row plus-button mt-2 justify-content-center">';
                    echo '<form action="index.php?page=user-story-new" method="POST">';
                    	echo '<input type="hidden" name="project" value="'.$crtProject->getIdx().'">';
                        echo '<button class="btn" type="submit" title="Add User Story"><i class="fas fa-plus fa-lg"></i></button>';
                    echo '</form>';
                echo '</div>';
			}	
		}		
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
				echo 'data : "task="+id+"&nb="+3,';
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