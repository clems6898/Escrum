<?php

class UserStory{

	//Attributes
	private $idx;
	private $name;
	private $description;
	private $position;
	private $complexity;
	private $is_completed;
	private $listTask;
	//private $product_backlog_idx;

	public function __construct(){
		$arg = func_get_args();
		switch (func_num_args()) {
			case '7':
				$this->idx = $arg[0];
				$this->name = $arg[1];
				$this->description = $arg[2];
				$this->position = $arg[3];
				$this->complexity = $arg[4];
				$this->is_completed = $arg[5];
				$this->listTask = $arg[6];
				break;
			default:
				$this->idx = 0;
				$this->name = null;
				$this->description = null;
				$this->position = 0;
				$this->complexity = 0;
				$this->is_completed = false;
				$this->listTask = array();
				break;
		}
	}

	public function getIdx(){
		return $this->idx;
	}

	public function setIdx($idx){
		$this->idx = $idx;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getDescription(){
		return $this->description;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function getPosition(){
		return $this->position;
	}

	public function setPosition($position){
		$this->position = $position;
	}

	public function getComplexity(){
		return $this->complexity;
	}

	public function setComplexity($complexity){
		$this->complexity = $complexity;
	}

	public function isCompleted(){
		if($this->is_completed == 't'){
			return true;
		}elseif($this->is_completed == 'f'){
				return false;
		}else{
			return $this->is_completed;
		} 		
	}

	public function setCompleted($bool){
		$this->is_completed = $bool;
	}

	public function getTasks(){
		return $this->listTask;
	}

	public function setTasks($listTask){
		$this->listTask = $listTask;
	}

	public function getNbTache(){
		return count($this->listTask);
	}

	public function getAvancee(){
		if(!empty($this->listTask)){
			$taskOk = 0;
			foreach ($this->listTask as $task) {
				if($task->getState() == 2){
					$taskOk++;
				}
			}
			return round($taskOk/$this->getNbTache()*100);
		}
		return 0;
	}

	public function getStatut(){
		$totalState = 0;
		foreach ($this->listTask as $task) {
			$totalState += $task->getState();
		}
		if($totalState <= 0){
			return 0;
		}elseif(($totalState > 0) && ($totalState < (2*count($this->listTask)))){
			return 1;
		}else{
			return 2;
		}
	}

}


?>