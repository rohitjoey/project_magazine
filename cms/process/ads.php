<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	$ads= new Ads();
	// debugger($_POST,true);
	if($_POST){
		$data=array(
					'URL'=>filter_var($_POST['url'],FILTER_SANITIZE_URL),
					'adType'=>$_POST['adType'],		
					'added_by'=>$_SESSION['user_id']
					);
		 // debugger($data,true);
		if(isset($_FILES) && !empty($_FILES) && !empty($_FILES['image']) && $_FILES['image']['error'] ==0){
			$success=uploadImage($_FILES['image'],'ads');
			if($success){
				$data['image']=$success;
				if(isset($_POST['old_image']) && !empty($_POST['old_image']) && file_exists(UPLOADS_PATH.'ads/'.$_POST['old_image'])){
					unlink(UPLOADS_PATH.'ads/'.$_POST['old_image']);
				}
			}else{
				redirect('../ads','error','Error uploading image');
			}
		}
		// debugger($_FILES,true);
		if(isset($_POST['id']) && !empty($_POST['id'])){
			// update
			$action='Updat';
			$ads_id=(int)$_POST['id'];
		}else{
			// add
			$action='Add';
			$ads_id=false;

		}

		if($ads_id){
			$ads_info=$ads->getAdsById($ads_id);
			if($ads_info){
				if($_SESSION['user_id'] == $ads_info[0]->added_by){
					$success=$ads->updateAdsById($data,$ads_id);
				}else{
					redirect('../ads','error','You are not allowed');

				}
			}else{
				redirect('../ads','error','Ads not found');

			}
		}else{
			$success=$ads->addAds($data);

		}
		if($success){
			redirect('../ads','success','Ads '.$action.'ed successfully');

		}else{
			redirect('../ads','error','Problem while '.$action.'ing ads');

		}
	
	}elseif ($_GET) {
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$ads_id=(int)$_GET['id'];
			if($ads_id){
				$action=substr(md5("Delete Ads".$ads_id.$_SESSION['token']), 3, 10);
					// debugger($action,true);
					if($action == $_GET['act']){
					$ads_info=$ads->getAdsById($ads_id);
					if($ads_info){
						$data=array(
								'status'=>'Passive'
									);
						$success=$ads->updateAdsById($data,$ads_id);
						if($success){
							redirect('../ads','success','Ads deleted successfully');

						}else{
							redirect('../ads','error','Error while deleting ad');

						}
					}else{
						redirect('../ads','error','Ads not found');

					}
				}else{
					redirect('../ads','error','Invalid Action');

				}
			}else{
				redirect('../ads','error','Id is invalid');

			}
		}else{
			redirect('../ads','error','Id is required');
		}	
	

	}else{
		redirect('../ads','error','No data');
	}


?>