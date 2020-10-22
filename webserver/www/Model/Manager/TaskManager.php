<?php

require_once("/webserver/www/Model/Manager/Manager.php");
require_once("/webserver/www/Model/Manager/UserManager.php");
require_once("/webserver/www/Model/Obj/Task.php");


class TaskManager extends Manager{

	private $um;

	public function __construct(){
		$this->um = new UserManager();
	}

	public function getTasks($userStory_idx){
		$lstTask = array();
		$pgRes = $this->pgExecute($this->dbConnect(),"SELECT idx, name, description, priority, state FROM tasks WHERE user_story_idx = $1 ORDER BY priority ASC ", $userStory_idx);
		while ($pgRow = @pg_fetch_assoc($pgRes)){
			$lstTask[] = new Task($pgRow['idx'], $pgRow['name'], $pgRow['description'], $pgRow['priority'], $pgRow['state'], $this->getTaskMember($pgRow['idx']));
		}
		return $lstTask;
	}

	public function getTaskWithIdx($taskidx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT idx, name, description, priority, state FROM tasks WHERE idx = $1", $taskidx);
		$pgRow = @pg_fetch_assoc($pgRes);
		return new Task($pgRow['idx'], $pgRow['name'], $pgRow['description'], $pgRow['priority'], $pgRow['state'], $this->getTaskMember($pgRow['idx']));
	}

	public function getTaskMember($task_idx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT user_account_idx FROM task_developement WHERE task_idx = $1", $task_idx);
		$lstUserIdx = @pg_fetch_all_columns($pgRes, 0);
		$lstUser = array();
		foreach ($lstUserIdx as $value) {
			$lstUser[] = $this->um->getUserWithIdx($value);
		}
		return $lstUser;
	}

	public function getTaskUser($user_idx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT DISTINCT task_idx FROM task_developement WHERE user_account_idx = $1", $user_idx);
		$lstTaskIdx = @pg_fetch_all_columns($pgRes,0);
		$lstTask = array();
		foreach ($lstTaskIdx as $task_idx) {
			$pgRes = $this->pgExecute($this->dbConnect(), "SELECT idx, name, description, priority, state FROM tasks WHERE idx = $1", $task_idx);
			$row = @pg_fetch_row($pgRes);
			$lstTask[] = new Task($row[0], $row[1], $row[2], $row[3], $row[4], $this->getTaskMember($row[0]));
		}
		return $lstTask;
	}

	public function getProjectName($task_idx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT project.name FROM tasks INNER JOIN user_stories ON (user_stories.idx = user_story_idx) INNER JOIN product_backlog ON (product_backlog.idx = product_backlog_idx) INNER JOIN project ON (project_idx = project.idx) WHERE tasks.idx = $1", $task_idx);
		return @pg_fetch_result($pgRes, 0, 0);

	}

	public function createTask($name, $description, $priority, $userStory_idx){
		$this->pgExecute($this->dbConnect(),"INSERT INTO tasks(name, description, priority, user_story_idx, state) VALUES($1, $2, $3, $4, $5)", $name, $description, $priority, $userStory_idx, 0);
	}

	public function getDeadline($task_idx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT sprint.creation_date, sprint.duree FROM tasks INNER JOIN sprint_backlog_user_stories ON (sprint_backlog_user_stories.user_story_idx = tasks.user_story_idx) INNER JOIN sprint_backlog ON (sprint_backlog_user_stories.sprint_backlog_idx = sprint_backlog.idx) INNER JOIN sprint ON (sprint_idx = sprint.idx) WHERE tasks.idx = $1", $task_idx);
		if($pgRes){
			$duree = @pg_fetch_result($pgRes, 0, 1);
			$creation_date = @pg_fetch_result($pgRes, 0, 0);
			return date('d/m/Y', strtotime('+'.$duree.'days',strtotime($creation_date)));
		}
		else{
			return null;
		}
	}

	public function changeState($taskidx, $state){
		$this->pgExecute($this->dbConnect(), "UPDATE tasks SET state=$1 WHERE idx = $2",$state, $taskidx);
	}

	public function addMember($taskIdx, $user_idx){
		$this->pgExecute($this->dbConnect(), "INSERT INTO task_developement(task_idx, user_account_idx) VALUES($1, $2) ", $taskIdx, $user_idx);
	}

	public function removeMember($taskIdx, $user_idx){
		$this->pgExecute($this->dbConnect(), "DELETE FROM task_developement WHERE task_idx = $1 AND user_account_idx = $2 ", $taskIdx, $user_idx);
	}
}


?>