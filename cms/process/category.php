<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	$category= new Category;
	// debugger($_POST,true);
	if($_POST){
		$data=array(
					'categoryname'=>sanitize($_POST['categoryname']),
					'description'=>htmlentities($_POST['description']),		
					'status'=>'Active',
					'added_by'=>$_SESSION['user_id']
					);
		// debugger($data);
		if(isset($_POST['id']) && !empty($_POST['id'])){
			// update
			$action='Updat';
			$category_id=(int)$_POST['id'];
		}else{
			// add
			$action='Add';
			$category_id=false;

		}

		if($category_id){
			$category_info=$category->getCategoryById($category_id);
			if($category_info){
				if($_SESSION['user_id'] == $category_info[0]->added_by){
					$success=$category->updateCategoryById($data,$category_id);
				}else{
					redirect('../category','error','You are not allowed');

				}
			}else{
				redirect('../category','error','Category not found');

			}
		}else{
			$success=$category->addCategory($data);

		}
		if($success){
			redirect('../category','success','Category '.$action.'ed successfully');

		}else{
			redirect('../category','error','Problem while '.$action.'ing category');

		}
	
	}elseif ($_GET) {
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$category_id=(int)$_GET['id'];
			if($category_id){
				$action=substr(md5("Delete Category".$category_id.$_SESSION['token']), 3, 10);
					// debugger($action,true);
					if($action == $_GET['act']){
					$category_info=$category->getCategoryById($category_id);
					if($category_info){
						$data=array(
								'status'=>'Passive'
									);
						$success=$category->updateCategoryById($data,$category_id);
						if($success){
							redirect('../category','success','Category deleted successfully');

						}else{
							redirect('../category','error','Error while deleting data');

						}
					}else{
						redirect('../category','error','Category not found');

					}
				}else{
					redirect('../category','error','Invalid Action');

				}
			}else{
				redirect('../category','error','Id is invalid');

			}
		}else{
			redirect('../category','error','Id is required');
		}	
	

	}else{
		redirect('../category','error','No data');
	}


?>