<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	$subscribe= new Subscribe();
	 // debugger($_GET,true);
	if($_GET){
		$data=array(
					'email'=>filter_var($_GET['newsletter'],FILTER_VALIDATE_EMAIL),		
					'status'=>'Active',
					);
	 	// debugger($data,true);
		$success=$subscribe->addSubscribe($data);
		if($success){
			redirect($_GET['url'],'succes',"Thank You for subscription");
		}

	}
		

?>