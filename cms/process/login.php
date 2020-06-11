<?php
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	debugger($_POST);
	$data=array();
	// redirect(../) ek step back
	if($_POST){
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$data['email']=filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
			if($data['email']){
				if(isset($_POST['password']) && !empty($_POST['password'])){
					$data['password']=sha1($_POST['password'].$_POST['email']);
					$user= new User();
					echo $data['password'];
					$user_info=$user->getUserByEmail($data['email']);
					debugger($user_info);

					if(isset($user_info[0]->email) && !empty($user_info[0]->email)){
						if($user_info[0]->password==$data['password']){
							if($user_info[0]->role=='Admin'){
								if($user_info[0]->status=="Active"){
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
									if(isset($_POST['rme']) && !empty($_POST['rme']) && $_POST['rme']=='on'){
										setcookie('_auth_user',$token,time()+(60*60*24*7),'/');
									}
									redirect('../index','success','Welcome to the dashboard');
								}else{
									redirect('../login','error','You account is not active');
								}
							}else{
								redirect('../login','error','You cannot login here');
							}
						}else{
							redirect('../login','error','You entered the incorrect password');
						}
					}redirect('../login','error','Email not found, please register first');
					

				}else{
					redirect('../login','error','Password is required');	
				 }
			}else{
				redirect('../login','error','Enter valid email');	
			}
		}else{
			redirect('../login','error','Email is required');	
		}

	}else{
		redirect('../login','error','Unauthorized access');	
	}
	
?>