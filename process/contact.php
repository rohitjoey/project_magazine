<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	$contact= new Contact();
	// debugger($_POST,true);
	if($_POST){
		$data=array(
					'email'=>filter_var($_POST['email'],FILTER_VALIDATE_EMAIL),		
					'subject'=>$_POST['subject'],
					'message'=>$_POST['message'],
					'status'=>'Active',
					);
	 	// debugger($data,true);
		$success=$contact->addContact($data);
		if($success){
			redirect($_POST['url'],'success',"Thank You");
		}

	}
		

?>