<?php
	class Schema extends Database{
		function __construct(){
			Database::__construct();

		}

		function create($sql){
			return $this->runQuery($sql);
		}

	}
	
?>