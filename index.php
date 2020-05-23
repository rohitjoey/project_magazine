<?php
	include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
	//redirect('cms/index');

	$user= new User();
	$data=array(
				'username'=>"khwopassdffa",
				// 'email'=>"fsdsdfasdfasdfsff1@gmail.com",
				// 'password'=>"sdfsdf",
				'session_token'=>tokenize()
				
				); 
	// debugger($user->getUserbyId(4));
		debugger($user->updateUserByEmail($data,'fsdf@gmail.com'));

?>
