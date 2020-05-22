<?php 
	class Database{
		protected $conn;
		protected $stmt;
		protected $sql;
		protected $table;

		function __construct(){
			try{
				$this->conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
				// $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$this->conn->exec('SET NAMES UTF8');
				echo "databse connected<br>";
				return true;
			}catch(PDOException $e){
				error_log(Date('M D Y h:i:s a').':(DB_CONNECTION)'.$e->getMessage()."\r\n",3,ERROR_PATH.'error_log');
				echo "<br>";
				return false;
			}
		}

		function runQuery($sql){
			try{
				$this->stmt=$this->conn->prepare($sql);
				$this->stmt->execute();
				return true;
			}catch(PDOException $e){
				error_log(Date('M D Y h:i:s a').':(QUERY_RUN_ERROR)'.$e->getMessage()."\r\n",3,ERROR_PATH.'error_log');
				echo "<br>";
				return false;
			}
		}

		function dataFromQuery($sql){
			try{
				$this->stmt=$this->conn->prepare($sql);
				$this->stmt->execute();
				$data=$this->stmt->fetchAll(PDO::FETCH_OBJ);
				return $data;
			}catch(PDOException $e){
				error_log(Date('M D Y h:i:s a').':(dataFromQuery)'.$e->getMessage()."\r\n",3,ERROR_PATH.'error_log');
				echo "<br>";
				return false;
			}
		}
	}

 ?>