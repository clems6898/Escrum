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
				echo'<form method="POST" action="index.php?page=project-new">';
					echo '<div class="row mt-4 justify-content-center">';;
							echo '<input type="text" class="form-control" placeholder="Project title" name="title" style="width:60%;" required></input>';
					echo '</div>';
					echo '<div class="row justify-content-center">';
						echo '<div class="col-10 col-md-6 mt-4 text-center">';
							echo '<label for="start-date" class="text-center inline mr-3">Start date : </label>';
							echo '<input type="date" id="start-date" name="start-date" value="'.date("Y-m-d").'" min="'.date("Y-m-d").'"class="form-control mx-auto inline" style="width:60%;min-width:120px;" required></input>';
						echo '</div>';
					echo '</div>';
					echo '<div class="row mt-4 justify-content-center">';
							echo '<textarea class="form-control" placeholder="Project description" rows="3" style="width:80%;min-height:85px;" required name="description"></textarea>';
					echo '</div>';
					echo '<div class="row mt-4 justify-content-center">';;
							echo '<input type="text" class="form-control" placeholder="Product Backlog Title" name="pbTitle" style="width:80%;" required></input>';
					echo '</div>';
					echo '<hr class="custom-hr mt-4">';
					echo '<div>';
						echo '<div class="row justify-content-center">';
							echo '<select class="form-control" id="SelectScrumMaster" name="scrumMaster" style="width:40%;" required>';
								echo '<option value="">-- Choose ScrumMaster --</option>';
								foreach ($lstUser as $user) {
									echo '<option value="'.$user->getIdx().'">'.$user->getLastname()." ".$user->getFirstName().'</option>';
								}
							echo '</select>';
						echo '</div>';
						echo '<div class="row justify-content-center mt-3">';
							echo '<select class="form-control" id="SelectProductOwner" style="width:40%;" required name="productOwner">';
								echo '<option value="">-- Choose ProductOwner --</option>';
								foreach ($lstUser as $user) {
									echo '<option value="'.$user->getIdx().'">'.$user->getLastname()." ".$user->getFirstName().'</option>';
								}
							echo '</select>';
						echo '</div>';
						echo' <hr class="custom-hr mt-3 w-50">';
						echo '<div id="memberList">';
							echo '<div class="row justify-content-center mt-3" id="member0">';
								echo '<select required class="form-control" name="member[]" style="width:40%;">';
									echo '<option value="">-- Choose Dev Member --</option>';
									foreach ($lstUser as $user) {
										echo '<option value="'.$user->getIdx().'">'.$user->getLastname()." ".$user->getFirstName().'</option>';
									}
								echo '</select>';
								echo '<button type="button" class="ml-2 btn custom-btn btn-minus-plus" id="deleteMember0"><i class="fas fa-minus"></i></button>';
							echo '</div>';							
						echo '</div>';
						echo '<div class="row justify-content-center mt-4">';
							echo '<button type="button" class="btn custom-btn" id="addMember"><i class="fas fa-plus"></i>  Add Dev Member</button>';
						echo '</div>';
					echo '</div>';	
					echo '<div class="row justify-content-center mt-5 mb-2">';
						echo '<button type="submit" class="btn custom-btn"><i class="fas fa-check"></i>  Submit</button>';
					echo '</div>';
				echo'</form>';
			echo '</div>';
		echo '</div>';
	echo '</body>';
	
	include_once('/webserver/www/include/js.php');
	include_once('/webserver/www/include/theme.php');

echo '<script>';
echo '$(function(){';
	//Supprimer l'user story
	echo '$("#deleteMember0").click(function(){';
		echo '$("#member0").remove();';
	echo '});';

	echo 'var cptMember = 1;';
	//Ajouter une user story 
	echo '$("#addMember").click(function(){';
		echo '$.ajax({';
			echo 'type : "POST",';
			echo 'url : "Ajax/addMember.php",';
			echo 'data : "nb="+cptMember,';
			echo 'datatype : "html",';
			echo 'success : function(result){';
				echo '$("#memberList").append($(result));';
				echo 'cptMember++;';
			echo '}';
		echo '});';
	echo '});';
echo '});';
echo '</script>';	
	
echo '</html>';
?>