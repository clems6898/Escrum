<?php
session_start();
if(isset($_GET['page']) && is_file('Controleur/'.$_GET['page'].'.control.php')){
	include_once('Controleur/'.$_GET['page'].'.control.php');

}else{
	include_once('Controleur/login.control.php');
}

?>