<?php
session_start();
require_once('/webserver/www/Model/Manager/UserManager.php');

if(isset($_POST['nb'])){
	$crtNb = $_POST['nb'];
}

if($_SESSION['role'] == 1 ){
	$lstUser = array();
	$um = new UserManager();
	$lstUser = $um->getAllUsers();
	echo '<div class="row justify-content-center mt-3" id="member'.$crtNb.'">';
		echo '<select required class="form-control" name="member[]" style="width:40%;">';
			echo '<option value="">-- Choose Dev Member --</option>';
			foreach ($lstUser as $user) {
				echo '<option value="'.$user->getIdx().'">'.$user->getLastname()." ".$user->getFirstName().'</option>';
			}
		echo '</select>';
		echo '<button type="button" class="ml-2 btn custom-btn btn-minus-plus" id="deleteMember'.$crtNb.'"><i class="fas fa-minus"></i></button>';
	echo '</div>';

	echo '<script>';
	echo '$(function(){';
		//Supprimer l'user story
		echo '$("#deleteMember'.$crtNb.'").click(function(){';
			echo '$("#member'.$crtNb.'").remove();';
		echo '});';		
	echo '});';
	echo '</script>';
}

?>	