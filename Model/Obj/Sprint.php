<?php

class Sprint{

	//Attributes 
	private $idx;
	private $objectif;
	private $name;
	private $duree;
	private $creation_date;
	private $sprintBacklog;

	public function __construct(){
		$arg = func_get_args();
		switch (func_num_args()) {
			case '6':
				$this->idx = $arg[0];
				$this->objectif = $arg[1];
				$this->name = $arg[2];
				$this->duree = $arg[3];
				$this->creation_date = $arg[4];
				$this->sprintBacklog = $arg[5];
				break;			
			default:
				$this->idx = 0;
				$this->objectif = null;
				$this->name = null;
				$this->duree = 0;
				$this->creation_date = null;
				$this->sprintBacklog = null;
				break;
		}
	}

	public function getIdx(){
		return $this->idx;
	}

	public function setIdx($idx){
		$this->idx = $idx;
	}

	public function getObjectif(){
		return $this->objectif;
	}

	public function setObjectif($objectif){
		$this->objectif = $objectif;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getDuree(){
		return $this->duree;
	}

	public function setDuree($duree){
		$this->duree = $duree;
	}

	public function getCreationDate(){
		return $this->creation_date;
	}

	public function setCreationDate($date){
		$this->creation_date = $date;
	}

	public function getSprintBacklog(){
		return $this->sprintBacklog;
	}

	public function setSprintBacklog($sprintBacklog){
		$this->sprintBacklog = $sprintBacklog;
	}

	public function getEndDate(){
		return date('d/m/Y', strtotime('+'.$this->duree.'days',strtotime($this->creation_date)));
	}

	public function getAvancee(){
		$datedebut = strtotime($this->creation_date);
		$datenow = strtotime(date('Y-m-d'));
		$nbJour = ($datenow - $datedebut)/86400;
		$advance = round($nbJour/$this->duree*100);
		if($advance < 0){
			return 0;
		}elseif($advance > 100){
			return 100;
		}else{
			return $advance;
		}
	}

	public function getTaskAvancee(){
		if(!empty($this->sprintBacklog)){
			if(!empty($this->sprintBacklog->getUserStories())){
				$nbTacheTotal = 0;
				$nbTacheOk = 0;
				foreach ($this->sprintBacklog->getUserStories() as $user_story) {
					foreach ($user_story->getTasks() as $task) {
						$nbTacheTotal ++;
						if($task->getState() == 2){
							$nbTacheOk++;
						}
					}
				}
				return round($nbTacheOk/$nbTacheTotal*100);
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}

	public function getNbTache(){
		if(!empty($this->sprintBacklog)){
			if(!empty($this->sprintBacklog->getUserStories())){
				$nbTacheTotal = 0;
				foreach ($this->sprintBacklog->getUserStories() as $user_story) {
					foreach ($user_story->getTasks() as $task) {
						$nbTacheTotal ++;
					}
				}
				return $nbTacheTotal;
			}
		}
		return 0;
	}

	public function getStatut(){
		$timeNow = strtotime(date('Y/m/d'));
		$timeCreation = strtotime($this->creation_date);
		$timeEnd = strtotime('+'.$this->duree.'days',strtotime($this->creation_date));

		if($timeNow<$timeCreation){
			return "Planned";
		}elseif($timeNow>=$timeCreation && $timeNow<$timeEnd){
			return "In progress";
		}elseif($timeNow>=$timeEnd){
			return "Completed";
		}		
	}

	public function getComplexity(){
		if(!empty($this->sprintBacklog)){
			if(!empty($this->sprintBacklog->getUserStories())){
				$totalComplexity = 0;
				foreach ($this->sprintBacklog->getUserStories() as $user_story) {
					$totalComplexity += $user_story->getComplexity();
				}
				return $totalComplexity;
			}
		}
		return 0;
	}

	public function getTasksToDo(){
		return $this->getTaskState(0);
	}

	public function getTasksInProgress(){
		return $this->getTaskState(1);
	}

	public function getTasksDone(){
		return $this->getTaskState(2);
	}

	private function getTaskState($state){
		$lstTask = array();
		if(!empty($this->sprintBacklog)){
			if(!empty($this->sprintBacklog->getUserStories())){
				foreach ($this->sprintBacklog->getUserStories() as $user_story) {
					foreach ($user_story->getTasks() as $task) {
						if($task->getState() == $state){
							$lstTask[]=$task;
						}
					}
				}
			}
		}
		return $lstTask;
	}
}

?>