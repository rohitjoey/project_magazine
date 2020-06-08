<?php
	class Subscribe extends Database{
		function __construct(){
			$this->table='newsletter';
			Database::__construct();
		}

		public function addSubscribe($data=array(),$is_die=false){
			return $this->addData($data,$is_die);


		}

		public function getSubscribeNumberByBlog($blog_id,$is_die=false){
			$args = array(
						'field'=> ['COUNT(id) as count'],
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'blogid'=>$blog_id,
									'subscribeStatus'=>'accept'
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/

						);
						return $this->getData($args,$is_die);
		}

		public function getSubscribeById($subscribe_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$subscribe_id,
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getAllSubscribe($is_die=false){
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

		public function getAllWaitingSubscribe($is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'subscribeStatus'=>'waiting'
									)),
							'order'=>'ASC',
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getAllAcceptedSubscribeByBlog($blog_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'subscribeStatus'=>'accept',
									'subscribeType'=>'subscribe',
									'blogId'=>$blog_id
									)),
							'order'=>'ASC',
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getAllAcceptedReplyByBlogBySubscribe($blog_id,$subscribe_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'subscribeStatus'=>'accept',
									'blogId'=>$blog_id,
									'subscribeType'=>'reply',
									'subscribeId'=>$subscribe_id

									)),
							'order'=>'ASC',
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}
		public function updateSubscribeById($data,$subscribe_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$subscribe_id
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
				return $this->updateData($data,$args,$is_die);
		}

		

		public function deleteSubscribeById($subscribe_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$subscribe_id,
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
				return $this->deleteData($args,$is_die);
		}
	}



?>