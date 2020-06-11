<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	$comment= new Comment();
	 // debugger($_POST,true);
	if($_POST){
		$action='Add';
		$data=array(
					'name'=>sanitize($_POST['name']),
					'email'=>filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),		
					'website'=>sanitize($_POST['website']),
					'blogId'=>(int)$_POST['blogId'],
					'message'=>sanitize(htmlentities($_POST['message'])),
					'status'=>'Active',
					'commentStatus'=>'waiting'
					);
		// debugger($data,true);
		if(isset($_POST['commentId']) && !empty($_POST['commentId'])){
			// Reply
			$comment_id=(int)$_POST['commentId'];
			$data['commentId']=$comment_id;
			$data['commentType']='reply';
		}else{
			// Comment
			$comment_id=false;
			$data['commentType']='comment';
		}

		if($comment_id){
			$comment_info=$comment->getCommentById($comment_id);
			if($comment_info){
					$success=$comment->addComment($data);
			}else{
				redirect('../blog-post?id='.$data['blogId'],'error','Comment not found');

			}
		}else{
			$success=$comment->addComment($data);

		}
		if($success){
			redirect('../blog-post?id='.$data['blogId'],'success','Comment '.$action.'ed successfully');

		}else{
			redirect('../blog-post?id='.$data['blogId'],'error','Problem while '.$action.'ing comment');

		}
	
	}


?>