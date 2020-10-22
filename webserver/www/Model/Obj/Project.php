<?php

require_once('/webserver/www/Model/Obj/User.php');

class Project{

	private $idx;
	private $name;
	private $description;
	private $creation_date;

	private $product_owner; 
	private $scrum_master; 
	private $listMember;

	private $productBacklog;
	private $listSprint;


	public function __construct(){
		$arg = func_get_args();
		switch (func_num_args()) {
			case '4': 
				$this->idx = $arg[0];
				$this->name = $arg[1];
				$this->description = $arg[2];
				$this->creation_date = $arg[3];
				$this->product_owner = null;
				$this->scrum_master = null;
				$this->listMember = array();
				$this->productBacklog = null;
				$this->listSprint = array();
				break;
			case '9':
				$this->idx = $arg[0];
				$this->name = $arg[1];
				$this->description = $arg[2];
				$this->creation_date = $arg[3];
				$this->product_owner = $arg[4];
				$this->scrum_master = $arg[5];
				$this->listMember = $arg[6];
				$this->productBacklog = $arg[7];
				$this->listSprint = $arg[8];
				break;
			
			default:
				$this->idx = 0;
				$this->name = null;
				$this->description = null;
				$this->creation_date = null;
				$this->product_owner = null;
				$this->scrum_master = null;
				$this->listMember = array();
				$this->productBacklog = null;
				$this->listSprint = array();
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

	public function getCreationDate(){
		return $this->creation_date;
	}

	public function setCreationDate($creation_date){
		$this->creation_date = $creation_date;
	}

	public function getProductOwner(){
		return $this->product_owner;
	}

	public function setProductOwner($productOwner){
		$this->product_owner = $productOwner;
	}

	public function getScrumMaster(){
		return $this->scrum_master;
	}

	public function setScrumMaster($scrum_master){
		$this->scrum_master = $scrum_master;
	}

	public function getMembers(){
		return $this->listMember;
	}

	public function setMembers($listMembers){
		$this->listMember = $listMembers;
	}

	public function getProductBacklog(){
		return $this->productBacklog;
	}

	public function setProductBacklog($pb){
		$this->productBacklog = $pb;
	}

	public function getSprints(){
		return $this->listSprint;
	}

	public function setSprints($lstSprint){
		$this->listSprint = $lstSprint;
	}

	public function getCurrentSprintNumber(){
		return count($this->listSprint);
	}

	public function getEvolutionProject(){
		if(!empty($this->getProductBacklog())){
			$total = 0;
			$complet = 0;
			foreach ($this->getProductBacklog()->getUserStories() as $userStory) {
				$total += $userStory->getComplexity();
				if($userStory->getStatut() == 2){
					$complet += $userStory->getComplexity();
				}
			}
			if($total != 0){
				return round($complet/$total*100);
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	}

	public function isMember($user_idx){
		foreach ($this->listMember as $member) {
			if($member->getIdx() == $user_idx){
				return true;
			}
		}
		return false;
	}

	public function isProductOwner($user_idx){
		if($this->product_owner->getIdx() == $user_idx){
			return true;
		}
		return false;
	}

	public function isScrumMaster($user_idx){
		if($this->scrum_master->getIdx() == $user_idx){
			return true;
		}
		return false;	
	}
}





?>