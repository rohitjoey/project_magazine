<?php
	class User extends Database{
		function __construct(){
			$this->table='users';
			Database::__construct();
		}

		public function addUser($data=array(),$is_die=false){
			return $this->addData($data,$is_die);


		}

		public function getUserById($user_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$user_id,
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getUserByEmail($email,$is_die=false){
			$args = array(
						// 'field'=>'username,email,password',
						'where'=>array(
							'and'=>array(
									'email'=>$email,
									'status'=>'Active'	
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getUserBySessionToken($session_token,$is_die=false){
			$args = array(
						// 'field'=>'username,email,password',
						'where'=>array(
							'and'=>array(
									'session_token'=>$session_token,
									'status'=>'Active'	
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function updateUserByEmail($data,$email,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'email'=>$email
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
				return $this->updateData($data,$args,$is_die);
		}

		public function deleteUserByEmail($email,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'email'=>$email
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
				return $this->deleteData($args,$is_die);
		}
	}


// $args = array(
			// 	'fields' => array('id','username','email','password'),
			// 	'where' => array(
			// 			'and' => array(
			// 				columnname => value,
			// 				columnname => value,	
			// 			),
			// 			'or' => array(
			// 				columnname => value,
			// 				columnname => value,	
			// 			)
			// 		)
			// 	'order' => 'ASC|DESC',
			// 	'limit' => array(
			// 				'offset' => 6,
			// 				'no_of_data' =>7	
			// 	 		)
			// );
?>


<!-- logo
category
	name
	description
blogpost
	title
	recent post
		id desc
	most read
		view column(easy) or naya table(view time, view date, view count)
	featured post
		featured column

comment
	chuttai table
		comment by
		comment date(added_date)
		commenter email
		comment message
		reply try -->
		



