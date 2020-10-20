<?php
	
class Manager{

	protected function dbConnect(){
		$jsonSrc = file_get_contents('/webserver/www/json/pgConnect.json');
		$pgData = json_decode($jsonSrc, true);
		$srv = 'host='.$pgData['srv'];
		$port = 'port='.$pgData['port'];
		$db = 'dbname='.$pgData['db'];
		$usr = 'user='.$pgData['usr'];
		$pwd = 'password='.$pgData['pwd'];
		$options = 'options=--client_encoding=UTF8';
		$pgCnt = @pg_connect("$srv $port $db $usr $pwd $options");
		return $pgCnt;
	}

	protected function pgExecute($cnt, $qry) {
		//Exécuter sans paramètre
		if(func_num_args() == 2) {
		return @pg_query($cnt, $qry); 
		}

		//Exécuter avec paramètres
		$arg = func_get_args(); 
		$prm = array_splice($arg, 2); 
		return @pg_query_params($cnt, $qry, $prm); 
	}

}


?>