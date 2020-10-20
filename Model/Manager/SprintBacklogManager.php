<?php

require_once('/webserver/www/Model/Manager/Manager.php');
require_once('/webserver/www/Model/Obj/SprintBacklog.php');
require_once('/webserver/www/Model/Manager/UserStoryManager.php');

class SprintBacklogManager extends Manager{

	private $usm;

	public function __construct(){
		$this->usm = new UserStoryManager();
	}


	public function getSprintBacklog($sprint_idx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT idx, name FROM sprint_backlog WHERE sprint_idx = $1", $sprint_idx);
		$row = @pg_fetch_row($pgRes, 0);
		$sb = new SprintBacklog($row[0], $row[1], $this->usm->getUserStorySprintBacklog($row[0]));
		return $sb;
	}

	public function createSprintBacklog($title, $sprint_idx){
		$pgRes = $this->pgExecute($this->dbConnect(), "INSERT INTO sprint_backlog (sprint_idx, name) VALUES($1, $2) RETURNING Currval('sprint_backlog_idx_seq')",$sprint_idx, $title);
		return @pg_fetch_result($pgRes, 0, 0);
	}

	public function addUserStory($user_story_idx, $sprint_backlog_idx){
		$this->pgExecute($this->dbConnect(), "INSERT INTO sprint_backlog_user_stories(sprint_backlog_idx, user_story_idx) VALUES($1,$2)",$sprint_backlog_idx, $user_story_idx);
	}

}

?>