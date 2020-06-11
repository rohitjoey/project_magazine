<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	$comment= new Comment();
	 // debugger($_GET,true);
	if ($_GET) {
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$comment_id=(int)$_GET['id'];
			if($comment_id){
				$accept_action=substr(md5("Accept Comment".$comment_id.$_SESSION['token']), 3, 10);
				$reject_action=substr(md5("Reject Comment".$comment_id.$_SESSION['token']), 3, 10);

					// debugger($action,true);
				if($accept_action == $_GET['act']){
						$comment_info=$comment->getCommentById($comment_id);
						if($comment_info){
							$data=array(
									'commentStatus'=>'accept'
										);
							$success=$comment->updateCommentById($data,$comment_id);
							if($success){
								redirect('../comment','success','Comment accepted successfully');

							}else{
								redirect('../comment','error','Error while accepting comment');

							}
				}else{
					redirect('../comment','error','Comment not found');

				}
			}else if($reject_action == $_GET['act']){
					$comment_info=$comment->getCommentById($comment_id);
					if($comment_info){
						$data=array(
								'commentStatus'=>'reject'
									);
						$success=$comment->updateCommentById($data,$comment_id);
						if($success){
							redirect('../comment','error','Comment rejected successfully');

						}else{
							redirect('../comment','error','Error while rejecting comment');

						}
					}else{
					redirect('../comment','error','Comment not found');

					}
			}else{
				redirect('../comment','error','Invalid Action');

				}
			}else{
				redirect('../comment','error','Id is invalid');

			}
		}else{
			redirect('../comment','error','Id is required');
		}	
	

	}else{
		redirect('../comment','error','No data');
	}


?>