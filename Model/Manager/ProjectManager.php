<?php

require_once('/webserver/www/Model/Manager/Manager.php');
require_once('/webserver/www/Model/Obj/Project.php');
require_once('/webserver/www/Model/Manager/ProductBacklogManager.php');
require_once('/webserver/www/Model/Manager/SprintManager.php');
require_once('/webserver/www/Model/Manager/UserManager.php');

class ProjectManager extends Manager{

	private $ProductBacklogManager;
	private $SprintManager;
	private $UserManager;

	public function __construct(){
		$this->ProductBacklogManager = new ProductBacklogManager();
		$this->SprintManager = new SprintManager();
		$this->UserManager = new UserManager();
	}

	public function getListProjectFromUser($user_idx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT DISTINCT project_idx FROM project_role_member WHERE member_idx = $1", $user_idx);
		$lstProjectIdx = @pg_fetch_all_columns($pgRes, 0);
		$lstProject = array();
		foreach ($lstProjectIdx as $value) {
			$lstProject[] = $this->getProjectFromIdx($value);
		}
		return $lstProject;
	}

	public function getProjectFromIdx($project_idx){
		$pgRes = $this->pgExecute($this->dbConnect(),"SELECT idx, name, description, creation_date FROM project WHERE idx = $1", $project_idx);
		$row = @pg_fetch_row($pgRes);
		$project = new Project($row[0], $row[1], $row[2], $row[3], $this->getProductOwner($project_idx), $this->getScrumMaster($project_idx), $this->getMembers($project_idx), $this->ProductBacklogManager->getProductBacklog($project_idx), $this->SprintManager->getSprints($project_idx));
		return $project;
	}

	public function getMembers($project_idx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT member_idx FROM project_role_member WHERE project_idx = $1 AND project_role_idx = 3", $project_idx);
		$lstUserIdx = @pg_fetch_all_columns($pgRes, 0);
		$lstUser = array();
		foreach ($lstUserIdx as $key => $value) {
			$lstUser[] = $this->UserManager->getUserWithIdx($value);
		}
		return $lstUser;
	}

	public function getProductOwner($project_idx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT member_idx FROM project_role_member WHERE project_idx = $1 AND project_role_idx = 1", $project_idx);
		$idx = @pg_fetch_result($pgRes, 0, 0);
		return $this->UserManager->getUserWithIdx($idx);	
	}

	public function getScrumMaster($project_idx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT member_idx FROM project_role_member WHERE project_idx = $1 AND project_role_idx = 2", $project_idx);
		$idx = @pg_fetch_result($pgRes, 0, 0);
		return $this->UserManager->getUserWithIdx($idx);
	}

	public function createProject($title, $description, $creation_date){
		$pgRes = $this->pgExecute($this->dbConnect(), "INSERT INTO project(name,description,creation_date) VALUES ($1, $2, $3) RETURNING Currval('project_idx_seq')", $title, $description, $creation_date);
		return @pg_fetch_result($pgRes, 0, 0);
	}

	public function setRole($project_idx, $user_idx, $role_idx){
		$this->pgExecute($this->dbConnect(),"INSERT INTO project_role_member(project_idx, member_idx, project_role_idx) VALUES ($1, $2, $3)",$project_idx, $user_idx, $role_idx);
	}

	public function setScrumMaster($project_idx, $user_idx){
		$this->setRole($project_idx, $user_idx, 2);
	}

	public function setProductOwner($project_idx, $user_idx){
		$this->setRole($project_idx, $user_idx, 1);
	}

	public function setMembers($project_idx, $user_list){
		foreach ($user_list as $value) {
			$this->setRole($project_idx, $value, 3);
		}
	}

	public function createProductBacklog($project_idx, $name){
		$this->pgExecute($this->dbConnect(),"INSERT INTO product_backlog(name, project_idx) VALUES($1, $2)", $name, $project_idx);
	}

}


?>