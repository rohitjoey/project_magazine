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
		//no session_token
		if(isset($_COOKIE['_auth_user']) && !empty($_COOKIE['_auth_user'])){				
			//no session but there is cookie
			$token= $_COOKIE['_auth_user'];
			$user_info=$user->getUserBySessionToken($token);
			if(isset($user_info[0]->session_token) && !empty($user_info[0]->session_token)){
				$_SESSION['user_id']=$user_info[0]->id;
				$_SESSION['user_name']=$user_info[0]->username;
				$_SESSION['user_email']=$user_info[0]->email;
				$_SESSION['user_role']=$user_info[0]->role;
				$_SESSION['user_status']=$user_info[0]->status;
				$token=tokenize();
				$_SESSION['token']=$token;
				$datas=array(
						'session_token'=>$token
							);
				$user->updateUserByEmail($datas,$_SESSION['user_email']);
				setcookie('_auth_user',$token,time()+(60*60*24*7),'/');
				if(pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)=='login'){
					redirect('../index','success','Welcome to the dashboard');
				}
				
				
			}else{
				//logout
				setcookie('_auth_user',$token,time()-(60*60*24*7),'/');
				if(pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)!='login'){
					redirect('login','error','You must login first');
				}

			}
		}
		if(pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)!='login'){
			//no cookie and session
			redirect('login','error','You must login first');
		}
	}

?>