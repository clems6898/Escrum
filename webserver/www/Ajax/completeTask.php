<?php
session_start();
if(isset($_POST['task'])){
	$crtTaskIdx = strip_tags(trim($_POST['task']));
}
require_once('/webserver/www/Model/Manager/TaskManager.php');
$tm = new TaskManager();
$crtTask = $tm->getTaskWithIdx($crtTaskIdx);
if($crtTask->isMember($_SESSION['idx'])){
	$tm->changeState($crtTask->getIdx(), 2);
}
echo 'couco';
?>