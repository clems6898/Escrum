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
                echo '<h4>My Projects</h4>';
            echo '</div>';
        echo '</div>';
			
			foreach ($lstProject as $project) {
				echo '<div class="row box-content justify-content-center">';
					echo '<a href="index.php?page=project-detail&project='.$project->getIdx().'" class="master-col col-6">';
						echo '<h4>'.$project->getName().'</h4>';
						echo '<div class="description text-center">';
							echo '<hr>';
							echo '<p><strong>Description :</strong> '.$project->getDescription().'</p>';
							echo '<hr>';
						echo '</div>';
						echo '<div class="row justify-content-around">';
							echo '<div class="sub-col col-10 col-lg-5">';
								echo '<div class="row">';
									echo '<p><strong>Start date : </strong>'.date('d/m/Y', strtotime($project->getCreationDate())).'</p>';
								echo '</div>';
								if(count($project->getSprints())!=0){
									echo '<div class="row">';
										echo '<p><strong>Sprint : </strong>n°'.$project->getCurrentSprintNumber().'</p>';
									echo '</div>';
									echo '<div class="row">';
										echo '<p><strong>Sprint start date : </strong>'.date('d/m/Y',strtotime($project->getSprints()[0]->getCreationDate())).'</p>';
									echo '</div>';
									echo '<div class="row">';
										echo '<p><strong>Sprint end date : </strong>'.$project->getSprints()[0]->getEndDate().'</p>';
									echo '</div>';
								}else{
									echo '<div class="row">';
										echo '<p><strong>No sprint has been created</strong></p>';
									echo '</div>';
								}								
								echo '<hr>';
							echo '</div>';
							echo '<div class="sub-col col-10 col-lg-5 text-center">';
								echo '<p class="mb-1">Project progress</p>';
								echo '<div class="progress mb-2">';
									echo '<div class="progress-bar" role="progressbar" aria-valuenow="'.$project->getEvolutionProject().'" aria-valuemin="0" aria-valuemax="100" style="width:'.$project->getEvolutionProject().'%;">'.$project->getEvolutionProject().'%</div>';
								echo '</div>';
								if(count($project->getSprints())!=0){
									echo '<p class="mb-1">Current sprint progress</p>';
									echo '<div class="progress mb-2">';
										echo '<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:'.$project->getSprints()[0]->getAvancee().'%;">'.$project->getSprints()[0]->getAvancee().'%</div>';
									echo '</div>';
									echo '<p class="mb-1">Current tasks progress</p>';
									echo '<div class="progress mb-2">';
										echo '<div class="progress-bar" role="progressbar" aria-valuenow="'.$project->getSprints()[0]->getTaskAvancee().'" aria-valuemin="0" aria-valuemax="100" style="width:'.$project->getSprints()[0]->getTaskAvancee().'%;">'.$project->getSprints()[0]->getTaskAvancee().'%</div>';
									echo '</div>';
								}								
							echo '</div>';
						echo '</div>';
					echo '</a>';
				echo '</div>';
			}	
		if($_SESSION['role'] == 1){
			echo '<div class="row plus-button mt-2 justify-content-center">';           
	            echo '<a href="index.php?page=project-new"><i style="padding-top:18px" class="fas fa-plus fa-lg"></i></a>';
	        echo '</div>';
		}		
	echo '</body>';
	
	include_once('/webserver/www/include/js.php');
	include_once('/webserver/www/include/theme.php');
	
echo '</html>';
?>