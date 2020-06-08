 <?php
	function debugger($data,$is_die=false){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		if($is_die){
			exit();
		}
	} 

	function sanitize($str){
		return trim(stripcslashes(strip_tags($str)));

	}

	function tokenize($length=100){
		$char='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$token='';
		$len=strlen($char);
		for ($i=0; $i < $length; $i++) { 
				$token.=$char[rand(0,$len-1)];
		}
		return $token;	
	}

	function redirect($loc,$key=" ",$message=""){
		$_SESSION[$key]=$message;
		@header('location: '.$loc);
		exit();
	
	}

	function randomAd($type){	
		$ad= new Ads();
		$ads_info=$ad->getAdsByadType($type);
		$random=rand(0,sizeof($ads_info)-1)	;
		if(isset($ads_info[$random]->image) && !empty($ads_info[$random]->image) && file_exists(UPLOADS_PATH.'ads/'.$ads_info[$random]->image)){												
						$thumbnail=UPLOAD_URL.'ads/'.$ads_info[$random]->image;
					}else{
						$thumbnail=UPLOAD_URL.'logo.png';	
					}
	?>
			<a href="<?php echo $ads_info[$random]->URL?>" style="display: inline-block;margin: auto;">
				<img class="img-responsive" src="<?php echo $thumbnail ?>" alt="">
			</a>
	<?php
	}

	
	function flashMessage(){

		if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {

			echo "<span class='alert alert-danger'>".$_SESSION['error']."</span>";
			
			unset($_SESSION['error']);
		}else if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
			echo "<span class='alert alert-success'>".$_SESSION['success']."</span>";
			unset($_SESSION['success']);
		}else if (isset($_SESSION['warning']) && !empty($_SESSION['warning'])) {
			echo "<span class='alert alert-warning'>".$_SESSION['warning']."</span>";
			unset($_SESSION['warning']);
		}
	

?>
		
		<script type="text/javascript">
			setTimeout(function(){
				$('.alert').slideUp('slow');
			},2000);
		</script>
<?php		

	}

	function uploadImage($data,$loc='image'){
		if($data){
			if(!$data['error']){
				if($data['size']<5000000){
					$ext=pathinfo($data['name'],PATHINFO_EXTENSION);
					if(in_array(strtolower($ext), ALLOWED_EXTENSION)){
						$destination=UPLOADS_PATH.strtolower($loc).'/';
						if(!is_dir($destination)){
							mkdir($destination,0777,true);	
						}
						$filename=ucfirst(strtolower($loc)).'-'.date('Ymdhisa').rand(0,999).'.'.$ext;
						$success=move_uploaded_file($data['tmp_name'], $destination.$filename);
						if($success){
							return $filename;
						}else{
							return false;
						}
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}

		}else{
			return false;
		}
	}
 ?>