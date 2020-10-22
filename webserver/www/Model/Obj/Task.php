<?php

class Task{

	//Attributes 
	private $idx;
	private $name;
	private $description;
	private $priority;
	private $state;
	private $listMembers;

	public function __construct(){
		$arg = func_get_args();
		switch (func_num_args()) {
			case '6': 
				$this->idx = $arg[0];
				$this->name = $arg[1];
				$this->description = $arg[2];
				$this->priority = $arg[3];
				$this->state = $arg[4];
				$this->listMembers = $arg[5];
				break;
			default:
				$this->idx = 0;
				$this->name = null;
				$this->description = null;
				$this->priority = null;
				$this->state = false;
				$this->listMembers = array();
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

	public function getPriority(){
		return $this->priority;
	}

	public function setPriority($priority){
		$this->priority = $priority;	
	}

	public function getMembers(){
		return $this->listMembers;
	}

	public function setMembers($m){
		$this->listMembers = $m;
	}

	public function getState(){
		return $this->state;
	}

	public function setState($state){
		$this->state = $state;
	}

	public function isMember($user_idx){
		foreach ($this->listMembers as $member) {
			if($member->getIdx() == $user_idx){
				return true;
			}
		}
		return false;
	}
}



?>