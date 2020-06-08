<?php
	class Contact extends Database{
		function __construct(){
			$this->table='contactus';
			Database::__construct();
		}

		public function addContact($data=array(),$is_die=false){
			return $this->addData($data,$is_die);


		}

		public function getContactNumberByBlog($blog_id,$is_die=false){
			$args = array(
						'field'=> ['COUNT(id) as count'],
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'blogid'=>$blog_id,
									'contactStatus'=>'accept'
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/

						);
						return $this->getData($args,$is_die);
		}

		public function getContactById($contact_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$contact_id,
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getAllContact($is_die=false){
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

		public function getAllWaitingContact($is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'contactStatus'=>'waiting'
									)),
							'order'=>'ASC',
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getAllAcceptedContactByBlog($blog_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'contactStatus'=>'accept',
									'contactType'=>'contact',
									'blogId'=>$blog_id
									)),
							'order'=>'ASC',
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getAllAcceptedReplyByBlogByContact($blog_id,$contact_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'contactStatus'=>'accept',
									'blogId'=>$blog_id,
									'contactType'=>'reply',
									'contactId'=>$contact_id

									)),
							'order'=>'ASC',
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}
		public function updateContactById($data,$contact_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$contact_id
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
				return $this->updateData($data,$args,$is_die);
		}

		

		public function deleteContactById($contact_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$contact_id,
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
				return $this->deleteData($args,$is_die);
		}
	}



?>