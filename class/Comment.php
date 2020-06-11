<?php
	class Comment extends Database{
		function __construct(){
			$this->table='comments';
			Database::__construct();
		}

		public function addComment($data=array(),$is_die=false){
			return $this->addData($data,$is_die);


		}

		public function getCommentNumberByBlog($blog_id,$is_die=false){
			$args = array(
						'field'=> ['COUNT(id) as count'],
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'blogid'=>$blog_id,
									'commentStatus'=>'accept'
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/

						);
						return $this->getData($args,$is_die);
		}

		public function getCommentById($comment_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$comment_id,
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getAllComment($is_die=false){
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

		public function getAllWaitingComment($is_die=false){
			$args = array(
						'field'=>['id',
						            'name',
						            'email',
						            'website',
						            'message',
						            'commentType',
						            'commentId',
						            'blogId',
						            'commentStatus',
						            'created_date',
						        	'(SELECT title FROM blogpost where id=blogId) as blogname'	],
						            
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'commentStatus'=>'waiting'
									)),
							'order'=>'ASC',
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getAllAcceptedCommentByBlog($blog_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'commentStatus'=>'accept',
									'commentType'=>'comment',
									'blogId'=>$blog_id
									)),
							'order'=>'ASC',
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}

		public function getAllAcceptedReplyByBlogByComment($blog_id,$comment_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'status'=>'Active',
									'commentStatus'=>'accept',
									'blogId'=>$blog_id,
									'commentType'=>'reply',
									'commentId'=>$comment_id

									)),
							'order'=>'ASC',
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
						return $this->getData($args,$is_die);
		}
		public function updateCommentById($data,$comment_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$comment_id
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
				return $this->updateData($data,$args,$is_die);
		}

		

		public function deleteCommentById($comment_id,$is_die=false){
			$args = array(
						
						'where'=>array(
							'and'=>array(
									'id'=>$comment_id,
									)),
							/*'or'=>array(
									'columnname'=>'value',
									'columnname'=>'value')*/
						

						);
				return $this->deleteData($args,$is_die);
		}
	}



?>