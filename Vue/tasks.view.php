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
				echo '<a href="index.php?page=project" data-toggle="tooltip" data-placement="bottom" title="My projects"><i class="fas fa-chart-pie fa-lg"></i></a>';
				echo '<a class="active" href="index.php?page=my-tasks" data-toggle="tooltip" data-placement="bottom" title="My tasks"><i class="fas fa-tasks fa-lg"></i></a>';
				echo '<a href="index.php" data-toggle="tooltip" data-placement="bottom" title="Log out"><i class="fas fas fa-sign-out-alt fa-lg"></i></a>';
			echo '</div>';
		echo '</div>';
	echo '</header>';
	echo '<body class="background">';
		echo '<div class="row box-content justify-content-center">';
			echo '<div class="tasks-master-col col-10">';
				echo '<h4>My tasks</h4>';
				echo '<hr class="custom-hr">';
				echo '<div class="row justify-content-around">';
					echo '<div class="col-8 col-md-4 text-center">';
						echo '<h5>To do</h5>';
						echo '<hr class="custom-hr w-50">';
						echo'<div class="task-wrapper pt-1">';
							foreach ($lstTask as $task) {
								if ($task->getState() == '0'){
									echo '<div class="row mb-3">';
										echo '<a data-toggle="modal" data-target="#taskModal" class="col-10 mx-auto task-content" data-task="'.$task->getIdx().'">';
											echo '<div class="row">';
												echo '<p id="task-content-title">'.$task->getName().'</p>';
											echo '</div>';
											echo '<div class="row">';
												echo '<p id="task-content-project"><strong>Project : </strong> '.$TaskManager->getProjectName($task->getIdx()).'</p>';
											echo '</div>';
											echo '<div class="row justify-content-center" id="task-content-priority">';
												echo '<div>';
													echo '<p class="inline"><strong>Priority :</strong></p>';
													switch($task->getPriority()){
														case '1' : echo '<div class="inline priority-box priority-small">Small</div>';
															break;
														case '2' : echo '<div class="inline priority-box priority-medium">Medium</div>';
															break;
														case '3' : echo '<div class="inline priority-box priority-high">High</div>';
															break;
														default : echo '<div class="inline priority-box priority-small">Small</div>';
															break;
													}
												echo '</div>';
											echo '</div>';
										echo '</a>';
									echo '</div>';
								}
							}
						echo '</div>';
					echo '</div>';
					echo '<div class="col-8 col-md-4 text-center">';
						echo '<h5>In progress</h5>';
						echo '<hr class="custom-hr w-50">';
						echo'<div class="task-wrapper pt-1">';
							foreach ($lstTask as $task) {
								if ($task->getState() == '1'){
									echo '<div class="row mb-3">';
										echo '<a data-toggle="modal" data-target="#taskModal" class="col-10 mx-auto task-content" data-task="'.$task->getIdx().'">';
											echo '<div class="row">';
												echo '<p id="task-content-title">'.$task->getName().'</p>';
											echo '</div>';
											echo '<div class="row">';
												echo '<p id="task-content-project"><strong>Project : </strong> '.$TaskManager->getProjectName($task->getIdx()).'</p>';
											echo '</div>';
											echo '<div class="row justify-content-center" id="task-content-priority">';
												echo '<div>';
													echo '<p class="inline"><strong>Priority :</strong></p>';
													switch($task->getPriority()){
														case '1' : echo '<div class="inline priority-box priority-small">Small</div>';
															break;
														case '2' : echo '<div class="inline priority-box priority-medium">Medium</div>';
															break;
														case '3' : echo '<div class="inline priority-box priority-high">High</div>';
															break;
														default : echo '<div class="inline priority-box priority-small">Small</div>';
															break;
													}
												echo '</div>';
											echo '</div>';
										echo '</a>';
									echo '</div>';
								}
							}
						echo '</div>';
					echo '</div>';
					echo '<div class="col-8 col-md-4 text-center">';
						echo '<h5>Completed</h5>';
						echo '<hr class="custom-hr w-50">';
						echo'<div class="task-wrapper pt-1">';
							foreach ($lstTask as $task) {
								if ($task->getState() == '2'){
									echo '<div class="row mb-3">';
										echo '<a data-toggle="modal" data-target="#taskModal" class="col-10 mx-auto task-content" data-task="'.$task->getIdx().'">';
											echo '<div class="row">';
												echo '<p id="task-content-title">'.$task->getName().'</p>';
											echo '</div>';
											echo '<div class="row">';
												echo '<p id="task-content-project"><strong>Project : </strong> '.$TaskManager->getProjectName($task->getIdx()).'</p>';
											echo '</div>';
											echo '<div class="row justify-content-center" id="task-content-priority">';
												echo '<div>';
													echo '<p class="inline"><strong>Priority :</strong></p>';
													switch($task->getPriority()){
														case '1' : echo '<div class="inline priority-box priority-small">Small</div>';
															break;
														case '2' : echo '<div class="inline priority-box priority-medium">Medium</div>';
															break;
														case '3' : echo '<div class="inline priority-box priority-high">High</div>';
															break;
														default : echo '<div class="inline priority-box priority-small">Small</div>';
															break;
													}
												echo '</div>';
											echo '</div>';
										echo '</a>';
									echo '</div>';
								}
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		
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
				echo 'data : "task="+id+"&nb="+1,';
				echo 'success : function(result){';
					echo '$(".modal-content").empty();';
					echo '$(".modal-content").append($(result));';					
				echo '}';
			echo '});';				
		echo '});';

		echo '$("#taskModal").on("hide.bs.modal",function(e){';
			echo 'document.location.reload();';
		echo '});';	

	echo '});';
	echo '</script>';
echo '</html>';
?>