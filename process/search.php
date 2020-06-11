<?php 
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	unset($_SESSION['find']);
	if(isset($_POST['search']) && !empty($_POST['search'])){
		$key=$_POST['search'];
		$Blog = new Blog();
		$blogs = $Blog->getBlogbyKey($key);
		// debugger($blogs,true);
		if (isset($blogs) && !empty($blogs)) {

			$_SESSION['find']=$blogs;
			redirect('../search','success',sizeof($blogs).' Result(s) Found');
		}else{
			$_SESSION['find']='';
			redirect('../search','error','No result found');
		}	
	}else{
		$_SESSION['find']='';
		redirect('../search','error','Please enter a keyword');
	}
?>	