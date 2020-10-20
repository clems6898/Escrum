<?php
	
require_once('/webserver/www/Model/Manager/Manager.php');
require_once('/webserver/www/Model/Obj/Sprint.php');
require_once('/webserver/www/Model/Manager/SprintBacklogManager.php');

class SprintManager extends Manager{

	private $sbm;

	public function __construct(){
		$this->sbm = new SprintBacklogManager();
	}

	public function getSprints($project_idx){
		$pgRes = $this->pgExecute($this->dbConnect(), "SELECT idx, objectif, name, duree, creation_date FROM sprint WHERE project_idx = $1 ORDER BY idx DESC", $project_idx);
		$lstSprint = array();
		while($pgRow = @pg_fetch_assoc($pgRes)){
			$lstSprint[] = new Sprint($pgRow['idx'], $pgRow['objectif'], $pgRow['name'], $pgRow['duree'], $pgRow['creation_date'], $this->sbm->getSprintBacklog($pgRow['idx']));

		}
		return $lstSprint;
	}

	public function createSprint($title, $goal, $creation_date, $end_date, $project_idx){
		$end = strtotime($end_date);
		$start = strtotime($creation_date);
		$duration = $end-$start;
		if($duration<0){
			$duration = $start-$end;
		}
		$nbJour = $duration/86400;
		$pgRes = $this->pgExecute($this->dbConnect(), "INSERT INTO sprint(name, objectif, project_idx, duree, creation_date) VALUES($1, $2, $3, $4, $5) RETURNING Currval('sprint_idx_seq')", $title, $goal, $project_idx, $nbJour, $creation_date);
		return @pg_fetch_result($pgRes, 0, 0);
	}
}

?>