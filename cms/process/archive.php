<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$archive= new Archive;
	// debugger($_POST,true);
	if($_POST){
		$data=array(
					'date'=>sanitize($_POST['date']),
					'status'=>'Active',
					'added_by'=>$_SESSION['user_id']
					);
		// debugger($data);
		if(isset($_POST['id']) && !empty($_POST['id'])){
			// update
			$action='Updat';
			$archive_id=(int)$_POST['id'];
		}else{
			// add
			$action='Add';
			$archive_id=false;

		}

		if($archive_id){
			$archive_info=$archive->getArchiveById($archive_id);
			if($archive_info){
				if($_SESSION['user_id'] == $archive_info[0]->added_by){
					$success=$archive->updateArchiveById($data,$archive_id);
				}else{
					redirect('../archive','error','You are not allowed');

				}
			}else{
				redirect('../archive','error','Archive not found');

			}
		}else{
			$success=$archive->addArchive($data);

		}
		if($success){
			redirect('../archive','success','Archive '.$action.'ed successfully');

		}else{
			redirect('../archive','error','Problem while '.$action.'ing archive');

		}
	
	}elseif ($_GET) {
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$archive_id=(int)$_GET['id'];
			if($archive_id){
				$action=substr(md5("Delete Archive".$archive_id.$_SESSION['token']), 3, 10);
					// debugger($action,true);
					if($action == $_GET['act']){
					$archive_info=$archive->getArchiveById($archive_id);
					if($archive_info){
						$data=array(
								'status'=>'Passive'
									);
						$success=$archive->updateArchiveById($data,$archive_id);
						if($success){
							redirect('../archive','success','Archive deleted successfully');

						}else{
							redirect('../archive','error','Error while deleting data');

						}
					}else{
						redirect('../archive','error','Archive not found');

					}
				}else{
					redirect('../archive','error','Invalid Action');

				}
			}else{
				redirect('../archive','error','Id is invalid');

			}
		}else{
			redirect('../archive','error','Id is required');
		}	
	

	}else{
		redirect('../archive','error','No data');
	}


?>