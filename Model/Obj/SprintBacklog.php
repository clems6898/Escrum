<?php

class SprintBacklog{

	private $idx;
	private $name; 
	private $listUserStories; 

	public function __construct(){
		$arg = func_get_args();
		switch (func_num_args()) {
			case '3':
			    $this->idx = $arg[0];
			    $this->name = $arg[1];
			    $this->listUserStories = $arg[2];
				break;			
			default:
				$this->idx = 0;
				$this->name = null;
				$this->listUserStories = array();
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

	public function getUserStories(){
		return $this->listUserStories;
	}

	public function setUserStories($userStories){
		$this->listUserStories = $userStories;
	}
}


?>