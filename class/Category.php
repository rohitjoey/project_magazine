<?php
	class Category extends Database{
		function __construct(){
			$this->table='categories';
			Database::__construct();
		}

		public function addCategory($data=array(),$is_die=false){
			return $this->addData($data,$is_die);


		}

		public function getCategoryById($category_id,$is_die){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$category_id,
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		

		public function deleteCategoryById($category_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$category_id,
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
				return $this->deleteData($args,$is_die);
		}
	}



?>