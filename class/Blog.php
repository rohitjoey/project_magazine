<?php
	class Blog extends Database{
		function __construct(){
			$this->table='blogpost';
			Database::__construct();
		}

		public function addBlog($data=array(),$is_die=false){
			return $this->addData($data,$is_die);


		}

		public function getBlogById($blog_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$blog_id,
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getAllBlog($is_die=false){
			$args = array(
						'field'=> ['id',
						            'title',
						            'content',
						            'featured',
						            
						            '(SELECT categoryname FROM categories where id=categoryid) as category',
						            'views',
						            'image'],
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function updateBlogById($data,$blog_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$blog_id
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
				return $this->updateData($data,$args,$is_die);
		}

		

		public function deleteBlogById($blog_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$blog_id,
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
				return $this->deleteData($args,$is_die);
		}
	}



?>