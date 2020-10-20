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
				echo'<form method="POST" action="index.php?page=user-story-new">';
					echo '<div class="row mt-4 justify-content-center">';;
							echo '<input type="text" class="form-control" name="title" placeholder="User Story title" style="width:50%;" required>';
					echo '</div>';
					echo '<hr class="custom-hr mt-4">';
					echo '<div class="row mt-3 justify-content-center">';						
						echo '<div class="col-10">';
							echo '<textarea class="form-control mx-auto" placeholder="Description" rows="4" style="width:80%;" name="description" required></textarea>';
						echo '</div>';
					echo '</div>';
					echo '<div class="row mt-3 justify-content-center">';
                        echo '<div class="col-10 text-center">';
                            echo 'Complexity : <span id="complexity-value">1</span>';
                        echo '</div>';
                        echo '<div class="col-10 text-center">';
                            echo '<input type="range" min="1" max="100" step="1" id="complexity-slider" name="complexity" value="1"  style="width:80%;min-width:120px;">';
                        echo '</div>';
                    echo '</div>';
					echo '<hr class="custom-hr mt-4">';
					echo '<div class="row justify-content-center mt-3 mb-2">';
						echo '<button type="submit" class="btn custom-btn"><i class="fas fa-check"></i>  Submit</button>';
					echo '</div>';
					echo '<input type="hidden" name="ProductBacklogIdx" value="'.$crtProject->getProductBacklog()->getIdx().'">';
					echo '<input type="hidden" name="project" value="'.$crtProject->getIdx().'">';
				echo'</form>';
			echo '</div>';
		echo '</div>';
	echo '</body>';
	
	include_once('/webserver/www/include/js.php');
	include_once('/webserver/www/include/theme.php');
echo '<script>';	
echo '$(function(){';
	echo '$("#complexity-slider").on("input", function(){';
		echo '$("#complexity-value").html($("#complexity-slider").val());';

	echo '});';

echo '});';
echo '</script>';	
echo '</html>';
?>