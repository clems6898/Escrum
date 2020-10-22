<?php

require_once('/webserver/www/Model/Manager/Manager.php');
require_once('/webserver/www/Model/Obj/UserStory.php');
require_once('/webserver/www/Model/Manager/TaskManager.php');

class UserStoryManager extends Manager{

	private $tm;

	public function __construct(){
		$this->tm = new TaskManager();
	}



	public function getUserStoryProductBacklog($productBacklogIdx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT idx, name, description, position, complexity, is_completed FROM user_stories WHERE product_backlog_idx = $1 ORDER BY position ASC", $productBacklogIdx);
		$array = array();
		while($pgRow = @pg_fetch_assoc($pgRes)){
			$array[] = new UserStory($pgRow['idx'], $pgRow['name'], $pgRow['description'], $pgRow['position'], $pgRow['complexity'], $pgRow['is_completed'], $this->tm->getTasks($pgRow['idx']));
		}

		return $array;
	}

	public function getUserStorySprintBacklog($sprintBacklogIdx){
		$pgRes = $this->pgExecute($this->dbConnect(),"SELECT user_story_idx FROM sprint_backlog_user_stories WHERE sprint_backlog_idx = $1", $sprintBacklogIdx);
		$lstIdx = @pg_fetch_all_columns($pgRes, 0);
		$lstUserStories = array();
		foreach ($lstIdx as $value) {
			$lstUserStories[] = $this->getUserStoryWithIdx($value);
		}
		return $lstUserStories;
	}

	public function getUserStoryWithIdx($idx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT idx, name, description, position, complexity, is_completed FROM user_stories WHERE idx = $1", $idx);
		$row = @pg_fetch_row($pgRes, 0);
		$us = new UserStory($row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $this->tm->getTasks($row[0]));
		return $us;
	}

	public function createUserStory($title, $description, $complexity, $productBacklogIdx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT max(position) as max_order FROM user_stories WHERE product_backlog_idx = $1", $productBacklogIdx);
		$max = @pg_fetch_result($pgRes, 0, 0);
		if(!empty($max)){
			$order = $max + 1;
		}else{
			$order = 1;
		}
		$this->pgExecute($this->dbConnect(),"INSERT INTO user_stories (name, description, position, complexity, product_backlog_idx) VALUES($1,$2,$3,$4,$5)",$title, $description, $order, $complexity, $productBacklogIdx);
	}

	public function getUserStoryWithTask($taskidx){
		$pgRes = $this->pgExecute($this->dbConnect(),"SELECT user_story_idx FROM tasks WHERE idx = $1",$taskidx);
		return $this->getUserStoryWithIdx(@pg_fetch_result($pgRes, 0, 0));
	}


}




?>