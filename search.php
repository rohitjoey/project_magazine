<?php 
	include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
	// $header=$_POST['search'];
	include 'inc/header.php';
	
?>

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row"> 
					<div class="col-md-8">
					<?php flashMessage(); ?>
						<?php 
							// debugger($_SESSION['find'],true);
							$blogs=$_SESSION['find'];
							// debugger($blogs);
							if(isset($blogs) & !empty($blogs)){
								foreach ($blogs as $key => $blog) {
									if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOADS_PATH.'blog/'.$blog->image)) {
										$thumbnail = UPLOAD_URL.'blog/'.$blog->image;
									}else{
										$thumbnail = UPLOAD_URL.'noimg.jpg';
									}
							
						?>
						<div class="post post-widget">
							<a class="post-img" href="blog-post?id=<?php echo $blog->id ?>"><img style="width: 90px; height:90px; object-fit:cover;" src="<?php echo $thumbnail; ?>" alt=""></a>
							<div class="post-body">
								<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id ?>"><?php echo $blog->title; ?></a></h3>
							</div>
						</div>

						<?php
								}
							}
						?>
					</div>
					<!-- aside -->
					<div class="col-md-4">
						<!-- ad -->
						<div class="aside-widget text-center">
							<?php  randomAd('simplead');?>
						</div>
						<!-- /ad -->
						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>
							<?php 
								$blog_object = new Blog();
								$popularBlog = $blog_object->getBlogByViews(0,4);
								if ($popularBlog) {
									foreach ($popularBlog as $key => $blog) {
										if (isset($blog->image) && !empty($blog->image) && file_exists(UPLOADS_PATH.'blog/'.$blog->image)) {
											$thumbnail = UPLOAD_URL.'blog/'.$blog->image;
										}else{
											$thumbnail = UPLOAD_URL.'noimg.jpg';
										}
							?>
							<div class="post post-widget">
								<a class="post-img" href="blog-post?id=<?php echo $blog->id ?>"><img style="width: 90px; height:90px; object-fit:cover;" src="<?php echo($thumbnail); ?>" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id ?>"><?php echo $blog->title; ?></a></h3>
								</div>
							</div>
							<?php
									}
								}
							?>
						</div>
						<!-- /post widget -->
					</div>
					<!-- /aside -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		<?php include 'inc/footer.php'; ?>