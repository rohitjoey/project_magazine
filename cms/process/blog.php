<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	$blog= new Blog;
	/*debugger($_POST);
	debugger($_FILES,true);*/

	if($_POST){
		$data=array(
					'title'=>sanitize($_POST['title']),
					'content'=>htmlentities($_POST['content']),
					'featured'=>sanitize($_POST['featured']),
					'categoryid'=>(int)$_POST['categoryid'],
					'status'=>'Active',
					'added_by'=>$_SESSION['user_id']
					);
	
		if(isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'] ==0){
			$success=uploadImage($_FILES['image'],'blog');
			if($success){
				$data['image']=$success;
				if(isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOADS_PATH.'blog/'.$_POST['old_image'])){
					unlink(UPLOADS_PATH.'blog/'.$_POST['old_image']);
				}
			}else{
				redirect('../addblog','error','Error uploading image');
			}
		} 

		// debugger($data);
		if(isset($_POST['id']) && !empty($_POST['id'])){
			// update
			$action='Updat';
			$blog_id=(int)$_POST['id'];
		}else{
			// add
			$action='Add';
			$blog_id=false;

		}

		if($blog_id){
			$blog_info=$blog->getBlogById($blog_id);
			if($blog_info){
				if($_SESSION['user_id'] == $blog_info[0]->added_by){
					$success=$blog->updateBlogById($data,$blog_id);
				}else{
					redirect('../addblog','error','You are not allowed');

				}
			}else{
				redirect('../addblog','error','Blog not found');

			}
		}else{
			$success=$blog->addBlog($data);

		}
		if($success){
			redirect('../blog','success','Blog '.$action.'ed successfully');

		}else{
			redirect('../addblog','error','Problem while '.$action.'ing blog');

		}
	
	}elseif ($_GET) {
		// debugger($_GET,true);
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$blog_id=(int)$_GET['id'];
			if($blog_id){
				$action=substr(md5("Delete Blog".$blog_id.$_SESSION['token']), 3, 10);
					// debugger($action,true);
					if($action == $_GET['act']){
					$blog_info=$blog->getBlogById($blog_id);
					if($blog_info){
						$data=array(
								'status'=>'Passive'
									);
						$success=$blog->updateBlogById($data,$blog_id);
						if($success){
							redirect('../blog','success','Blog deleted successfully');

						}else{
							redirect('../blog','error','Error while deleting data');

						}
					}else{
						redirect('../blog','error','Blog not found');

					}
				}else{
					redirect('../blog','error','Invalid Action');

				}
			}else{
				redirect('../blog','error','Id is invalid');

			}
		}else{
			redirect('../blog','error','Id is required');
		}	
	

	}else{
		redirect('../blog','error','No data');
	}


?>