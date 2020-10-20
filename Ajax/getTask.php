<?php
session_start();
require_once('/webserver/www/Model/Manager/TaskManager.php');
require_once('/webserver/www/Model/Manager/UserStoryManager.php');
$tm = new TaskManager();
$task = $tm->getTaskWithIdx($_POST['task']);
$um = new UserStoryManager();
$us = $um->getUserStoryWithTask($_POST['task']);
//en-tête
echo '<div class="modal-header">';
	echo '<h5 class="modal-title">'.$task->getName().'</h5>';
	echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
	echo '<span aria-hidden="true">&times;</span>';
	echo '</button>';
echo '</div>';
//corps
echo '<div class="modal-body">';
	echo '<div class="row justify-content-center">';
		echo '<h5><strong>Description : </strong></h5>';
	echo '</div>';
	echo '<div class="row justify-content-center">';
		echo '<p>'.$task->getDescription().'</p>';
	echo '</div>';
	echo'<hr class="custom-hr">';
	echo '<div class="row justify-content-center">';
		echo '<p><strong>Project : </strong>'.$tm->getProjectName($task->getIdx()).'</p>';
	echo '</div>';
	if($tm->getDeadline($task->getIdx()) != null){
		echo '<div class="row justify-content-center">';
			echo '<p><strong>Deadline : </strong>'.$tm->getDeadline($task->getIdx()).'</p>';
		echo '</div>';
	}
	
	echo '<div class="row justify-content-center">';
		echo '<div>';
			echo '<p class="inline"><strong>Priority :</strong></p>';
			switch($task->getPriority()){
				case '1' : echo '<div class="inline priority-box priority-high">High</div>';
					break;
				case '2' : echo '<div class="inline priority-box priority-medium">Medium</div>';
					break;
				case '3' : echo '<div class="inline priority-box priority-small">Small</div>';
					break;
				default : echo '<div class="inline priority-box priority-small">Small</div>';
					break;
			}
		echo '</div>';
	echo '</div>';	
	
	if($_POST['nb'] != 3){ //My Task et affichage dans le sprint
		echo '<div class="row justify-content-center">';
			echo '<p><strong>UserStory : </strong>'.$us->getName().'</p>';
		echo '</div>';	
		echo '<div class="row justify-content-center">';
			echo '<p class="mb-1">Avancement UserStory</p>';
		echo '</div>';
		echo '<div class="progress mx-auto mb-2" style="width:60%;">';
			echo '<div class="progress-bar" role="progressbar" aria-valuenow="'.$us->getAvancee().'" aria-valuemin="0" 	aria-valuemax="100" style="width:'.$us->getAvancee().'%;">'.$us->getAvancee().'%</div>';
		echo '</div>';
	}else{ //Product Backlog
		echo '<div class="row justify-content-center">';
			echo '<p><strong>State : </strong>';
			switch ($task->getState()) {
				case '0':echo 'Pending';
					break;
				case '1':echo 'In Progress';
					break;
				case '2':echo 'Completed';
					break;				
				default:
					echo 'In Progress';
					
					break;
			}
			echo '</p>';
		echo '</div>';
	}
	
	echo'<hr class="mt-2 custom-hr">';
	echo '<div class="row justify-content-center mb-2">';
		echo '<h5><strong>Participants : </strong></h5>';
	echo '</div>';
	echo '<div class="row justify-content-center" id="memberList">';
		if(count($task->getMembers()) != 0){
			foreach ($task->getMembers() as $value) {
				echo '<div class="col-4 text-center">';
					echo $value->getFirstname().' '.$value->getLastname()	;
				echo '</div>';
			}		
		}else{
			echo '<p><strong>No Participants</strong></p>';
		}
		
	echo '</div>';
echo '</div>';
//pied de page
echo '<div class="modal-footer justify-content-around">';
if($_POST['nb'] == 1){ //Page 'my task'
	if($task->getState() == 0){
		echo '<button type="button" id="progress" data-dismiss="modal" class="btn custom-btn"><i class="fas fa-arrow-circle-right"></i> In Progress</button>';
		echo '<button type="button" id="completed" data-dismiss="modal" class="btn custom-btn"><i class="fas fa-arrow-circle-right"></i> Completed</button>';
		
	}elseif($task->getState() == 1){
		echo '<button type="button" id="completed" data-dismiss="modal" class="btn custom-btn"><i class="fas fa-arrow-circle-right"></i> Completed</button>';
	}else{
		echo '<strong><p>Cette tache est terminée</p></strong>';
	}
}elseif($_POST['nb'] == 2){
	echo '<button type="button" data-dismiss="modal" class="btn custom-btn"><i class="fas fa-times"></i> Close</button>';
	if($task->isMember($_SESSION['idx'])){
		echo '<button type="button" style="display:none" class="btn custom-btn" id="participate"><i class="fas fa-angle-double-right"></i> Participate</button>';
		echo '<button type="button" class="btn custom-btn" id="leave"><i class="fas fa-angle-double-left"></i> Leave</button>';
	}else{
		echo '<button type="button" class="btn custom-btn" id="participate"><i class="fas fa-angle-double-right"></i> Participate</button>';
		echo '<button type="button" style="display:none" class="btn custom-btn" id="leave"><i class="fas fa-angle-double-left"></i> Leave</button>';
	}
}elseif ($_POST['nb'] == 3) {
	echo '<button type="button" data-dismiss="modal" class="btn custom-btn"><i class="fas fa-times"></i> Close</button>';
}


echo '</div>';
echo '<script>';
echo '$(function(){';
	if($_POST['nb']==1){
		echo '$("#progress").click(function(){';
			echo '$.ajax({';
				echo 'url : "Ajax/progressTask.php",';
				echo 'type : "POST",';
				echo 'data : "task="+'.$task->getIdx();
			echo '});';		
		echo '});';
		echo '$("#completed").click(function(){';
			echo '$.ajax({';
				echo 'url : "Ajax/completeTask.php",';
				echo 'type : "POST",';
				echo 'data : "task="+'.$task->getIdx();
			echo '});';		
		echo '});';
	}elseif($_POST['nb'] == 2){
		echo '$("#participate").click(function(){';
			echo '$.ajax({';
				echo 'url : "Ajax/participateTask.php",';
				echo 'data : "task="+'.$task->getIdx().',';
				echo 'dataType : "html",';
				echo 'type : "POST",';
				echo 'success : function(result){';
					echo '$("#memberList").empty();';
					echo '$("#memberList").append($(result));';
					echo '$("#participate").hide();';
					echo '$("#leave").show();';
				echo '}';
			echo '});';	
		echo '});';
		echo '$("#leave").click(function(){';
			echo '$.ajax({';
				echo 'url : "Ajax/participateTask.php",';
				echo 'data : "task="+'.$task->getIdx().',';
				echo 'dataType : "html",';
				echo 'type : "POST",';
				echo 'success : function(result){';
					echo '$("#memberList").empty();';
					echo '$("#memberList").append($(result));';
					echo '$("#leave").hide();';
					echo '$("#participate").show();';
				echo '}';
			echo '});';	
		echo '});';
	}	
echo '});';
echo '</script>';

?>