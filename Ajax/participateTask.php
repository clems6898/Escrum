<?php
session_start();
if(isset($_POST['task'])){
	$crtTaskIdx = strip_tags(trim($_POST['task']));
}
require_once('/webserver/www/Model/Manager/TaskManager.php');
$tm = new TaskManager();
$crtTask = $tm->getTaskWithIdx($crtTaskIdx);
if($crtTask->isMember($_SESSION['idx'])){
	$tm->removeMember($crtTaskIdx, $_SESSION['idx']);
}else{
	$tm->addMember($crtTaskIdx, $_SESSION['idx']);
}
$crtTask = $tm->getTaskWithIdx($crtTaskIdx);
if(count($crtTask->getMembers()) != 0){
	foreach ($crtTask->getMembers() as $value) {
		echo '<div class="col-4 text-center">';
			echo $value->getFirstname().' '.$value->getLastname()	;
		echo '</div>';
	}		
}else{
	echo '<p><strong>No Participants</strong></p>';
}	
?>