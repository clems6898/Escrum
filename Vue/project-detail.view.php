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
			//Résumé du projet
			echo '<div class="row box-content justify-content-center">';
                echo '<div class="header-col py-0 col-6">';
                    echo '<h4>Project : '.$crtProject->getName().'</h4>';
                    	echo '<hr class="custom-hr mt-2 mb-2">';
                     	echo '<div class="row justify-content-center text-center">';
                            echo '<p class="mb-0 pb-1" ><strong>Description :</strong> '.$crtProject->getDescription()	.'</p>';
                        echo '</div>';
                        echo '<hr class="custom-hr mt-2">';
                        echo '<div class="row justify-content-center">';
                            echo '<p class="mb-0 pb-2" ><strong>Start date :</strong> '.date('d/m/Y', strtotime($crtProject->getCreationDate())).'</p>';
                        echo '</div>';                         
                        echo '<div class="row mx-auto justify-content-center" style="width:100%;">';
                            echo '<p class="mb-2 inline" style="line-height:13px;"><strong>Project progress : </strong></p>';
                            echo '<div class=" inline progress ml-1 mb-3" style="width:40%;">';
                                echo '<div class="progress-bar" role="progressbar" aria-valuenow="'.$crtProject->getEvolutionProject().'" aria-valuemin="0" aria-valuemax="100" style="width:'.$crtProject->getEvolutionProject().'%;">'.$crtProject->getEvolutionProject().'%</div>';
                            echo '</div>';
                        echo '</div>';
                        if(count($crtProject->getSprints())!=0){
	                        echo '<div class="row mx-auto justify-content-center" style="width:100%;">';
	                            echo '<p class="mb-2 inline" style="line-height:13px;"><strong>Current sprint progress : </strong></p>';
	                            echo '<div class=" inline progress ml-1 mb-3" style="width:40%;">';
	                                echo '<div class="progress-bar" role="progressbar" aria-valuenow="'.$crtProject->getSprints()[0]->getAvancee().'" aria-valuemin="0" aria-valuemax="100" style="width:'.$crtProject->getSprints()[0]->getAvancee().'%;">'.$crtProject->getSprints()[0]->getAvancee().'%</div>';
	                            echo '</div>';
	                        echo '</div>';
                    	}
                echo '</div>';
            echo '</div>';



			//Accéder au productBacklog
			echo '<div class="row box-content justify-content-center">';
				echo '<a href="index.php?page=product-backlog&project='.$crtProject->getIdx().'"" class="master-col col-6">';
					echo '<h4>Product Backlog</h4>';
					echo '<div class="row justify-content-around" style="height:20px;">';
						echo '<p><strong>Number of User Stories : </strong>'.count($crtProject->getProductBacklog()->getUserStories()).'</p>';
					echo '</div>';
				echo '</a>';
			echo '</div>';
			foreach ($crtProject->getSprints() as $sprint) {
				echo '<div class="row box-content justify-content-center">';
					echo '<a href="index.php?page=sprint-detail&project='.$crtProject->getIdx().'&sprint='.$sprint->getIdx().'" class="master-col col-6">';
						echo '<h4>'.$sprint->getName().'</h4>';
						echo '<div class="description text-center">';
							echo '<hr>';
							echo '<p><strong>Goal :</strong> '.$sprint->getObjectif().'</p>';
							echo '<hr>';
						echo '</div>';
						echo '<div class="row justify-content-around">';
							echo '<div class="sub-col col-10 col-lg-5">';
								echo '<div class="row">';
									echo '<p><strong>Start date : </strong>'.date('d/m/Y', strtotime($sprint->getCreationDate())).'</p>';
								echo '</div>';
								echo '<div class="row">';
									echo '<p><strong>End date : </strong>'.$sprint->getEndDate().'</p>';
								echo '</div>';
								echo '<div class="row">';
									echo '<p><strong>Number of tasks : </strong>'.$sprint->getNbTache().'</p>';
								echo '</div>';
								echo '<div class="row">';
									echo '<p><strong>Sprint complexity : </strong>'.$sprint->getComplexity().'</p>';
								echo '</div>';

								echo '<div class="row">';
									echo '<p><strong>Status :</strong> '.$sprint->getStatut().'</p>';
								echo '</div>';
								echo '<hr>';
							echo '</div>';
							echo '<div class="sub-col col-10 col-lg-5 text-center">';
								echo '<p class="mb-1">Sprint progress</p>';
								echo '<div class="progress mb-2">';
									echo '<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:'.$sprint->getAvancee().'%;">'.$sprint->getAvancee().'%</div>';
								echo '</div>';
								echo '<p class="mb-1">Tasks progress</p>';
								echo '<div class="progress mb-2">';
									echo '<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:'.$sprint->getTaskAvancee().'%;">'.$sprint->getTaskAvancee().'%</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</a>';
				echo '</div>';
			}

			if($role == 2){ //Ajout d'un sprint pour le scrum master
				echo '<div class="row plus-button mt-2 justify-content-center">';
                    echo '<form action="index.php?page=sprint-new" method="POST">';
                    	echo '<input type="hidden" name="project" value="'.$crtProject->getIdx().'">';
                        echo '<button class="btn" type="submit"><i class="fas fa-plus fa-lg"></i></button>';
                    echo '</form>';
                echo '</div>';
			}
			
	echo '</body>';
	
	include_once('/webserver/www/include/js.php');
	include_once('/webserver/www/include/theme.php');
	
echo '</html>';
?>