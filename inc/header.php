<?php define("BREADCRUMS", ['contact','category','about','blank']);
	  define("COLOR", ['cat-1','cat-2','cat-3','cat-4']);?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Magazine <?php echo (isset($header) && !empty($header))?$header:"Home";?></title>


		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet"> 

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="assets/css/style.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>
		
		<!-- Header -->
		<header id="header">
			<!-- Nav -->
			<div id="nav">
				<!-- Main Nav -->
				<div id="nav-fixed">
					<div class="container">
						<!-- logo -->
						<div class="nav-logo">
							<a href="index" class="logo"><img src="assets/img/logowhite-1.png" style="width:180px;height:auto;" alt=""></a>
						</div>
						<!-- /logo -->

						<!-- nav -->
						<ul class="nav-menu nav navbar-nav">
						<?php 
							$category = new Category();
							$categories=$category->getAllCategory();
							// debugger($categories);
							foreach ($categories as $key => $category) {
						?>
							<li style="font-size:13.5px; " class="<?php echo(COLOR[$category->id%4]);?>"><a href="category?id=<?php echo $category->id ?>"><?php echo $category->categoryname;?></a></li>
								

						<?php		
							}
						?>	
							
						</ul>
						<!-- /nav -->

						<!-- search & aside toggle -->
						<div class="nav-btns">
							<button class="aside-btn"><i class="fa fa-bars"></i></button>
							<button class="search-btn"><i class="fa fa-search"></i></button>
							<form action="process/search" method="post">
								<div class="search-form">
									<input class="search-input" type="text" name="search" placeholder="Enter Your Search ...">
									<button class="search-close"><i class="fa fa-times"></i></button>
								</div>
							</form>
						</div>
						<!-- /search & aside toggle -->
					</div>
				</div>
				<!-- /Main Nav -->

				<!-- Aside Nav -->
				<div id="nav-aside">
					<div>
						<a href="index" class="logo"><img src="assets/img/logowhite-1.png" style="width:180px;height:auto; padding-bottom: 25px;"></a>

					</div>
					<!-- nav -->
					<div class="section-row">
						<ul class="nav-aside-menu">
							<li><a href="index">Home</a></li>
							<li><a href="about">About Us</a></li>
							<li><a href="contact">Contacts</a></li>
						</ul>
					</div>
					<!-- /nav -->

					

					<!-- social links -->
					<div class="section-row">
						<h3>Follow us</h3>
						
						<ul class="nav-aside-social">
						<?php 
							$share_object = new Share();
							$shares=$share_object->getAllShare();
							// debugger($shares);
							if ($shares) {
								foreach ($shares as $key => $share) {
						?>

							<li><a href="<?php echo $share->url?>"><i class="<?php echo $share->class ?>"></i></a></li>

						<?php 			
								}
							}	
						?>
							
						</ul>
					</div>
					<!-- /social links -->

					<!-- aside nav close -->
					<button class="nav-aside-close"><i class="fa fa-times"></i></button>
					<!-- /aside nav close -->
				</div>
				<!-- Aside Nav -->
			</div>
			<!-- /Nav -->
			
			
			<?php if(in_array(pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME), BREADCRUMS)){
			?>
				<!-- Page Header -->
			<div class="page-header">
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<ul class="page-header-breadcrumb">
								<li><a href="index">Home</a></li>
								<li><?php echo (isset($bread) && !empty($bread))?$bread:"Home";?></li>
							</ul>
							<h1><?php echo (isset($bread) && !empty($bread))?$bread:"Home";?></h1>
						</div>
					</div>
				</div>
			</div>
			<!-- /Page Header -->
			<?php
				}else if(pathinfo($_SERVER['PHP_SELF'],PATHINFO_FILENAME)=='blog-post'){
			?>
			<div id="post-header" class="page-header">
				<?php	
						if(isset($blog_info->image) && !empty($blog_info->image) && file_exists(UPLOADS_PATH.'blog/'.$blog_info->image)){
							$thumbnail=UPLOAD_URL.'blog/'.$blog_info->image;


						}else{
							$thumbnail=UPLOAD_URL.'logo.png';	
						}
				?>
				<div class="background-img" style="background-image: url('<?php echo $thumbnail?>'); "></div>
				<div class="container">
					<div class="row">
						<div class="col-md-10">
							<div class="post-meta">
								<a class="post-category <?php echo(COLOR[$blog_info->categoryid%4]);?>" href="category?id=<?php echo $blog_info->categoryid ?>"><?php echo $blog_info->category;?></a>
								<span class="post-date" style="color:black;"><?php echo date("M d, Y",strtotime($blog_info->created_date));?></span>
							</div>
							<h1><?php echo $blog_info->title ?></h1>
						</div>
					</div>
				</div>
			</div>

			<?php	
				}
			?>
			
		</header>
		<!-- /Header -->

		