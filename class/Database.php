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
				// echo "databse connected<br>";
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

		
		
		protected function addData($data,$is_die=false){

		/*	INSERT INTO TABLE SET
				columname=:columname,
				columname=:columname,
			...*/
			try{


				$this->sql="INSERT INTO ";	
				
			//table name starts
				if(isset($this->table) && !empty($this->table)){
					$this->sql.=$this->table;
					$this->sql.=" SET ";
				}else{
					throw new Exception("Data cannot be inserted in empty table");
				}
			//table name ends	
			
			if(isset($data) && !empty($data)){
				if(is_array($data)){
					$col=array();
					foreach ($data as $key => $value) {
						$col[]=$key.'= :'.$key;
					}

					$this->sql.=implode(', ', $col);	
				}else{
					$this->sql.=$data;
				}

			}else{
				throw new Exception("No data to enter into the table");
				
			}	
			
			
				
					//echo $this->sql;
		
			
			$this->stmt=$this->conn->prepare($this->sql);


			//value bind
			if(isset($data) && !empty($data)){
				if(is_array($data)){
					foreach ($data as $key => $value) {
						if(is_int($value)){
							$type=PDO::PARAM_INT;
						}else if(is_bool($value)){
							$type=PDO::PARAM_BOOL;
						}else{
							$type=PDO::PARAM_STR;
						}

						$this->stmt->bindValue( ':'.$key,$value,$type);
					}
				}
			}else{
				throw new Exception("No data to enter into the table");
				
			}	
			//value bind

			$success=$this->stmt->execute();
			return $success;


			}catch(PDOException $e){
				error_log(Date('M D Y h:i:s a').':(addData)'.$e->getMessage()."\r\n",3,ERROR_PATH.'error_log');
				echo "<br>";
				return false;
			}catch(Exception $e){
				error_log(Date('M D Y h:i:s a').':(addDataNonPDO)'.$e->getMessage()."\r\n",3,ERROR_PATH.'error_log');
				echo "<br>";
				return false;
			}

			

			
		}

		protected function getData($args,$is_die=false){
			/*SELECT fields(*) FROM tablename
				WHERE
					columname=columname or pani huna sakcha or pani
					columname=columname

				ORDER by columname asc|des
				LIMIT offset,no_of_data
				*/
			try{
				$this->sql="SELECT ";	

				//field start
					if(isset($args['field']) && !empty($args['field'])){
						if(is_array($args['field'])){
							$this->sql.=implode(", ", $args['field']);	
						}else{
							$this->sql.=$args['field']." ";
						}	
					}else{
						$this->sql.='*';
					}
				//field end
				$this->sql.=" FROM ";


				//table name starts
				if(isset($this->table) && !empty($this->table)){
					$this->sql.=$this->table;
					
				}else{
					throw new Exception("Data cannot be inserted in empty table");
				}
				//table name ends	
				

				//where 
					if(isset($args['where']) && !empty($args['where'])){
						if(is_array($args['where'])){
							$this->sql.=" WHERE ";  
							if(isset($args['where']['and']) && !empty($args['where']['and'])){
								$col_and=array();
								foreach ($args['where']['and'] as $key => $value) {
									$col_and[]=$key.'= :'.$key;
								}
								$this->sql.=implode(' and ', $col_and);

							}
							if(isset($args['where']['or']) &4& !empty($args['where']['or'])){
								$col_or=array();
								foreach ($args['where']['or'] as $key => $value) {
									$col_or[]=$key.'= :'.$key;
								}
								$this->sql.=implode(' or ', $col_or);

							}
						}else{
							$this->sql.=$args['where'];
						}
					}
				//where end

				//order start
					if(isset($args['order']) && !empty($args['order'])){
						if($args['order']=='DESC'){
							$this->sql.=' order by id DESC ';
						}else{
							$this->sql.=' order by id ASC ';
						}
					}else{
						$this->sql.=' order by id DESC ';
					}
				//order end	
		
				if(isset($args['limit']) && !empty($args['limit'])){
					$this->sql.="LIMIT ".$args['limit']['offset'].",".$args['limit']['no_of_data'];
				}

			// debugger($this->sql,true);

			
		
			
			$this->stmt=$this->conn->prepare($this->sql);


			//value bind
			if(isset($args['where']) && !empty($args['where'])){
						if(is_array($args['where'])){
							
							if(isset($args['where']['and']) && !empty($args['where']['and'])){
								foreach ($args['where']['and'] as $key => $value) {
									if(is_int($value)){
										$type=PDO::PARAM_INT;
									}else if(is_bool($value)){
										$type=PDO::PARAM_BOOL;
									}else{
										$type=PDO::PARAM_STR;
									}
									$this->stmt->bindValue( ':'.$key,$value,$type);
								}	
							}
							if(isset($args['where']['or']) &4& !empty($args['where']['or'])){
								foreach ($args['where']['or'] as $key => $value) {
									if(is_int($value)){
										$type=PDO::PARAM_INT;
									}else if(is_bool($value)){
										$type=PDO::PARAM_BOOL;
									}else{
										$type=PDO::PARAM_STR;
									}
									$this->stmt->bindValue( ':'.$key,$value,$type);
								}	
								
						}
						}
			}		 
			//value bind

			$this->stmt->execute();
			$data=$this->stmt->fetchAll(PDO::FETCH_OBJ);
			return $data;


			}catch(PDOException $e){
				error_log(Date('M D Y h:i:s a').':(addData)'.$e->getMessage()."\r\n",3,ERROR_PATH.'error_log');
				echo "<br>";
				return false;
			}catch(Exception $e){
				error_log(Date('M D Y h:i:s a').':(addDataNonPDO)'.$e->getMessage()."\r\n",3,ERROR_PATH.'error_log');
				echo "<br>";
				return false;
			}


			}

		protected function updateData($data,$args,$is_die=false){
			/*UPDATE tablename SET
				columname=:new_columname
				columname=:new_columname
			where
				columname=:columname
				columname=:columname
			*/
			try{


				$this->sql="UPDATE ";	
				
			//table name starts
				if(isset($this->table) && !empty($this->table)){
					$this->sql.=$this->table;
					$this->sql.=" SET ";
				}else{
					throw new Exception("Data cannot be inserted in empty table");
				}
			//table name ends

			if(isset($data) && !empty($data)){
				if(is_array($data)){
					$col=array();
					foreach ($data as $key => $value) {
						$col[]=$key.'= :'.$key."s";
					}

					$this->sql.=implode(', ', $col);	
				}else{
					$this->sql.=$data;
				}

			}else{
				throw new Exception("No data to enter into the table");
				
			}		
			
			//where 
					if(isset($args['where']) && !empty($args['where'])){
						if(is_array($args['where'])){
							$this->sql.=" WHERE ";  
							if(isset($args['where']['and']) && !empty($args['where']['and'])){
								$col_and=array();
								foreach ($args['where']['and'] as $key => $value) {
									$col_and[]=$key.'= :'.$key;
								}
								$this->sql.=implode(' and ', $col_and);

							}
							if(isset($args['where']['or']) &4& !empty($args['where']['or'])){
								$col_or=array();
								foreach ($args['where']['or'] as $key => $value) {
									$col_or[]=$key.'= :'.$key;
								}
								$this->sql.=implode(' or ', $col_or);

							}
						}else{
							$this->sql.=$args['where'];
						}
					}
				//where end	
			// echo $this->sql;
			
			$this->stmt=$this->conn->prepare($this->sql);


			//value bind
			if(isset($data) && !empty($data)){
				if(is_array($data)){
					foreach ($data as $key => $value) {
						if(is_int($value)){
							$type=PDO::PARAM_INT;
						}else if(is_bool($value)){
							$type=PDO::PARAM_BOOL;
						}else{
							$type=PDO::PARAM_STR;
						}

						$this->stmt->bindValue( ':'.$key."s",$value,$type);
					}
				}
			}else{
				throw new Exception("No data to enter into the table");
				
			}	
			//value bind

			if(isset($args['where']) && !empty($args['where'])){
						if(is_array($args['where'])){
							
							if(isset($args['where']['and']) && !empty($args['where']['and'])){
								foreach ($args['where']['and'] as $key => $value) {
									if(is_int($value)){
										$type=PDO::PARAM_INT;
									}else if(is_bool($value)){
										$type=PDO::PARAM_BOOL;
									}else{
										$type=PDO::PARAM_STR;
									}
									$this->stmt->bindValue( ':'.$key,$value,$type);
								}	
							}
							if(isset($args['where']['or']) &4& !empty($args['where']['or'])){
								foreach ($args['where']['or'] as $key => $value) {
									if(is_int($value)){
										$type=PDO::PARAM_INT;
									}else if(is_bool($value)){
										$type=PDO::PARAM_BOOL;
									}else{
										$type=PDO::PARAM_STR;
									}
									$this->stmt->bindValue( ':'.$key,$value,$type);
								}	
								
						}
						}
			}
			$success=$this->stmt->execute();
			return $success;
			
			}catch(PDOException $e){
				error_log(Date('M D Y h:i:s a').':(addData)'.$e->getMessage()."\r\n",3,ERROR_PATH.'error_log');
				echo "<br>";
				return false;
			}catch(Exception $e){
				error_log(Date('M D Y h:i:s a').':(addDataNonPDO)'.$e->getMessage()."\r\n",3,ERROR_PATH.'error_log');
				echo "<br>";
				return false;
			}
		}	

		protected function deleteData($args,$is_die=false){
			try{


				$this->sql="DELETE FROM ";	
				
			//table name starts
				if(isset($this->table) && !empty($this->table)){
					$this->sql.=$this->table;
					
				}else{
					throw new Exception("Data cannot be inserted in empty table");
				}
			//table name ends	
			
			
			//where 
					if(isset($args['where']) && !empty($args['where'])){
						if(is_array($args['where'])){
							$this->sql.=" WHERE ";  
							if(isset($args['where']['and']) && !empty($args['where']['and'])){
								$col_and=array();
								foreach ($args['where']['and'] as $key => $value) {
									$col_and[]=$key.'= :'.$key;
								}
								$this->sql.=implode(' and ', $col_and);

							}
							if(isset($args['where']['or']) &4& !empty($args['where']['or'])){
								$col_or=array();
								foreach ($args['where']['or'] as $key => $value) {
									$col_or[]=$key.'= :'.$key;
								}
								$this->sql.=implode(' or ', $col_or);

							}
						}else{
							$this->sql.=$args['where'];
						}
					}
				//where end
			
				
			if ($is_die) {
					echo $this->sql;
					exit();
				}		
			
			$this->stmt=$this->conn->prepare($this->sql);

			//value bind
			if(isset($args['where']) && !empty($args['where'])){
						if(is_array($args['where'])){
							
							if(isset($args['where']['and']) && !empty($args['where']['and'])){
								foreach ($args['where']['and'] as $key => $value) {
									if(is_int($value)){
										$type=PDO::PARAM_INT;
									}else if(is_bool($value)){
										$type=PDO::PARAM_BOOL;
									}else{
										$type=PDO::PARAM_STR;
									}
									$this->stmt->bindValue( ':'.$key,$value,$type);
								}	
							}
							if(isset($args['where']['or']) &4& !empty($args['where']['or'])){
								foreach ($args['where']['or'] as $key => $value) {
									if(is_int($value)){
										$type=PDO::PARAM_INT;
									}else if(is_bool($value)){
										$type=PDO::PARAM_BOOL;
									}else{
										$type=PDO::PARAM_STR;
									}
									$this->stmt->bindValue( ':'.$key,$value,$type);
								}	
								
						}
						}
			}		 
			//value bind
			

			$success=$this->stmt->execute();
			return $success;


			}catch(PDOException $e){
				error_log(Date('M D Y h:i:s a').':(addData)'.$e->getMessage()."\r\n",3,ERROR_PATH.'error_log');
				echo "<br>";
				return false;
			}catch(Exception $e){
				error_log(Date('M D Y h:i:s a').':(addDataNonPDO)'.$e->getMessage()."\r\n",3,ERROR_PATH.'error_log');
				echo "<br>";
				return false;
			}
		}	
	}

 ?>		
