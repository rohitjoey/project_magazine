<?php
	class Archive extends Database{
		function __construct(){
			$this->table='archives';
			Database::__construct();
		}

		public function addArchive($data=array(),$is_die=false){
			return $this->addData($data,$is_die);


		}

		public function getArchiveById($archive_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$archive_id,
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getArchiveNumberByDate($is_die=false){
			$args = array(
						'field'=> ['(SELECT COUNT(id) as count FROM `blogpost` WHERE date(created_date)=date) as count'],
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									)),
							'order'=>'ASC',
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/

						);
						return $this->getData($args,$is_die);
		}

		public function getAllArchive($is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									)),
							'order'=>'ASC',
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		
		public function updateArchiveById($data,$archive_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$archive_id
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
				return $this->updateData($data,$args,$is_die);
		}

		

		public function deleteArchiveById($archive_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$archive_id,
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
				return $this->deleteData($args,$is_die);
		}
	}



?>