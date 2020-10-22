<?php

require_once('/webserver/www/Model/Manager/Manager.php');
require_once('/webserver/www/Model/Manager/UserStoryManager.php');
require_once('/webserver/www/Model/Obj/ProductBacklog.php');

class ProductBacklogManager extends Manager{

	private $_usm;


	public function __construct(){
		$this->_usm = new UserStoryManager();
	}


	public function getProductBacklog($project_idx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT idx, name FROM product_backlog WHERE project_idx = $1", $project_idx);
		$idx = @pg_fetch_result($pgRes, 0, 0);
		$name = @pg_fetch_result($pgRes, 0, 1);
		$listUserStories = array();
		$listUserStories = $this->_usm->getUserStoryProductBacklog($idx);
		return new ProductBacklog($idx, $name, $listUserStories);
	}

}


?>