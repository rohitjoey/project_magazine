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
						'field'=> ['id',
						            'title',
						            'content',
						            'featured',
						            'categoryid',
						            'created_date',
						            'added_by',
						            '(SELECT categoryname FROM categories where id=categoryid) as category',
						            'views',
						            'image'],
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

		public function getBlogByArchiveDate($date,$is_die=false){
			$args = array(
						'field'=> ['id',
						            'title',
						            'content',
						            'featured',
						            'categoryid',
						            'created_date',
						            'added_by',
						            '(SELECT categoryname FROM categories where id=categoryid) as category',
						            'views',
						            'image','created_date'],
						'where'=>" where created_date like '".$date."%'"
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

		public function getBlogByViews($offset,$no_of_data,$is_die=false){
			$args = array(
						'field'=> ['id',
						            'title',
						            'content',
						            'featured',
						            'categoryid',	
						            'created_date',
						            '(SELECT categoryname FROM categories where id=categoryid) as category',
						            'views',
						            'image'],
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									)),
						'limit'=>array(
							'offset'=>$offset,
							'no_of_data'=>$no_of_data	
						),
						'order'=>array(
									'columnname'=>'views',
									'orderType'=>'DESC'
									),					

						);
						return $this->getData($args,$is_die);
		}
		public function getAllFeaturedBlog($is_die=false){
			$args = array(
						'field'=> ['id',
						            'title',
						            'content',
						            'featured',
						            'categoryid',
						            'created_date',
						            '(SELECT categoryname FROM categories where id=categoryid) as category',
						            'views',
						            'image'],
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'featured'=>'Featured'
									)),
						
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}
		public function getAllRecentBlog($offset,$no_of_data,$is_die=false){
			$args = array(
						'field'=> ['id',
						            'title',
						            'content',
						            'featured',
						            'categoryid',
						            'created_date',
						            '(SELECT categoryname FROM categories where id=categoryid) as category',
						            'views',
						            'image'],
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									)),
						'limit'=>array(
							'offset'=>$offset,
							'no_of_data'=>$no_of_data	
								),
						'order'=>array(
									'columnname'=>'created_date',
									'orderType'=>'DESC'
									),
						
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getAllFeaturedBlogOfCategoryWithLimit($cat_id,$offset,$no_of_data,$is_die=false){
			$args = array(
						'field'=> ['id',
						            'title',
						            'content',
						            'featured',
						            '(SELECT categoryname FROM categories where id=categoryid) as category',
						            'views',
						            'image',
						        	'created_date'],
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'featured'=>"Featured",
									'categoryid'=>$cat_id
									)),
						'limit'=>array(
							'offset'=>$offset,
							'no_of_data'=>$no_of_data	
						),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}
		// SELECT COUNT(id) as count FROM `blogpost` WHERE `categoryid`=8

		public function getBlogNumberByCategory($cat_id,$is_die=false){
			$args = array(
						'field'=> ['COUNT(id) as count'],
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'categoryid'=>$cat_id
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/

						);
						return $this->getData($args,$is_die);
		}

		public function getAllRecentBlogOfCategoryWithLimit($cat_id,$offset,$no_of_data,$is_die=false){
			$args = array(
						'field'=> ['id',
						            'title',
						            'content',
						            'featured',
						            '(SELECT categoryname FROM categories where id=categoryid) as category',
						            'views',
						            'image',
						        	'created_date'],
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'categoryid'=>$cat_id
									)),
						'limit'=>array(
							'offset'=>$offset,
							'no_of_data'=>$no_of_data	
						),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getAllMostViewedBlogOfCategoryWithLimit($cat_id,$offset,$no_of_data,$is_die=false){
			$args = array(
						'field'=> ['id',
						            'title',
						            'content',
						            'featured',
						            '(SELECT categoryname FROM categories where id=categoryid) as category',
						            'views',
						            'image',
						        	'created_date'],
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'categoryid'=>$cat_id
									)),
						'order'=>array(
									'columnname'=>'views',
									'orderType'=>'DESC'
									),
						'limit'=>array(
							'offset'=>$offset,
							'no_of_data'=>$no_of_data	
						),
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