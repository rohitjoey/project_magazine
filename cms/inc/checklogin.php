<?php
	$user= new User();

	if(isset($_SESSION['token']) && !empty($_SESSION['token'])){
		
		$user_info=$user->getUserBySessionToken($_SESSION['token']);
		if(!isset($user_info[0]) || empty($user_info[0])){
			redirect('logout');
		}else{
			if(pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)=='login'){
				redirect('index','error','You are already logged in');
			}
		}	
	}else{
		if(pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)!='login'){
			redirect('login','error','You must login first');
		}
	}

?>