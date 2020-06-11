
<?php 
	include 'config/init.php';
	include 'inc/header.php' ?> 

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">	
					
					<!-- post -->
							<?php
								$blog_object= new Blog();
								$featured_info=$blog_object->getAllFeaturedBlog();
								if($featured_info){
									 	for ($i=0; $i <2 ; $i++) { 
										$random=rand(0,sizeof($featured_info)-1);
										// echo $random;
										if(isset($featured_info[$random]->image) && !empty($featured_info[$random]->image) && file_exists(UPLOADS_PATH.'blog/'.$featured_info[$random]->image)){
												$thumbnail=UPLOAD_URL.'blog/'.$featured_info[$random]->image;


											}else{
												$thumbnail=UPLOAD_URL.'logo.png';	
											}
									// debugger($featured_info[$random]);
								?>
					<div class="col-md-6">
						<div class="post post-thumb">
							<a class="post-img" href="blog-post?id=<?php echo $featured_info[$random]->id; ?>"><img style="width: 100%; height:350px; object-fit:cover;" src="<?php echo $thumbnail ?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?php echo(COLOR[$featured_info[$random]->categoryid%4]);?>" href="category?id=<?php echo $featured_info[$random]->categoryid ?>"><?php echo $featured_info[$random]->category ?></a>
										<span class="post-date" style="color:black;"><?php echo date("M d, Y",strtotime($featured_info[$random]->created_date));?></span>
								</div>
								<h3 class="post-title"><a href="blog-post?id=<?php echo $featured_info[$random]->id; ?>"><?php echo $featured_info[$random]->title; ?></a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->
				<?php 
								}		
							}
						?>		
				</div>
				<!-- /row -->

				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h2>Recent Posts</h2>
						</div>
					</div>
					<?php
						$offset=0;
						for ($i=0; $i <2 ; $i++) { 
								$recent_info=$blog_object->getAllRecentBlog($offset,3);
								// debugger($recent_info,true);
								if($recent_info){
									 	foreach ($recent_info as $key => $recent) {
										if(isset($recent->image) && !empty($recent->image) && file_exists(UPLOADS_PATH.'blog/'.$recent->image)){
												$thumbnail=UPLOAD_URL.'blog/'.$recent->image;


											}else{
												$thumbnail=UPLOAD_URL.'logo.png';	
											}
									// debugger($featured_info[$random]);
								?>

					<!-- post -->
					<div class="col-md-4">
						<div class="post">
							<a class="post-img" href="blog-post?id=<?php echo $recent->id; ?>"><img style="width: 360px; height:216px; object-fit:cover;" src="<?php echo $thumbnail ?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?php echo(COLOR[$recent->categoryid%4]);?>" href="category?id=<?php echo $recent->categoryid ?>"><?php echo $recent->category ?></a>
									<span class="post-date" style="color:black;"><?php echo date("M d, Y",strtotime($recent->created_date));?></span>
								</div>
								<h3 class="post-title"><a href="blog-post?id=<?php echo $recent->id; ?>"><?php echo $recent->title; ?></a></h3>
							</div>
						</div>
					</div>
					<!-- /post -->
					<?php 
								}
							}	
					?>
					<div class="clearfix visible-md visible-lg"></div>
					<?php 
						$offset=3;
						}?>

					

				</div>
				<!-- /row -->

				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<!-- post -->
							<?php
								$recent=$blog_object->getAllRecentBlog(6,1);
								// echo $offset;
								$recent_big=$recent[0];
								// debugger($recent_info);
								if($recent_big){
										if(isset($recent_big->image) && !empty($recent_big->image) && file_exists(UPLOADS_PATH.'blog/'.$recent_big->image)){
												$thumbnail=UPLOAD_URL.'blog/'.$recent_big->image;


											}else{
												$thumbnail=UPLOAD_URL.'logo.png';	
											}
									// debugger($featured_info[$random]);
							?>

							<div class="col-md-12">
								<div class="post post-thumb">
									<a class="post-img" href="blog-post?id=<?php echo $recent_big->id; ?>"><img style="width: 750px; height:450px; object-fit:cover;" src="<?php echo $thumbnail ?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?php echo(COLOR[$recent_big->categoryid%4]);?>" href="category?id=<?php echo $recent_big->categoryid ?>"><?php echo $recent_big->category ?></a>
											<span class="post-date"style="color:black;"><?php echo date("M d, Y",strtotime($recent_big->created_date));?></span>
										</div>
										<h3 class="post-title"><a href="blog-post?id=<?php echo $recent_big->id; ?>"><?php echo $recent_big->title; ?></a></h3>
									</div>
								</div>
							</div>
							<?php 
								}
							?>

							<!-- /post -->

							<!-- post -->
							<?php 
								$offset=7;
								for ($i=0; $i <3 ; $i++) { 
								$recent_info=$blog_object->getAllRecentBlog($offset,2);
								// debugger($recent_info,true);
								if($recent_info){
									 	foreach ($recent_info as $key => $recent) {
										if(isset($recent->image) && !empty($recent->image) && file_exists(UPLOADS_PATH.'blog/'.$recent->image)){
												$thumbnail=UPLOAD_URL.'blog/'.$recent->image;


											}else{
												$thumbnail=UPLOAD_URL.'logo.png';	
											}
									// debugger($featured_info[$random]);
								?>
							<div class="col-md-6">
								<div class="post">
									<a class="post-img" href="blog-post?id=<?php echo $recent->id; ?>"><img style="width: 360px; height:216px; object-fit:cover;" src="<?php echo $thumbnail ?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?php echo(COLOR[$recent->categoryid%4]);?>" href="category?id=<?php echo $recent->categoryid ?>"><?php echo $recent->category ?></a>
									<span class="post-date" style="color:black;"><?php echo date("M d, Y",strtotime($recent->created_date));?></span>
								</div>
								<h3 class="post-title"><a href="blog-post?id=<?php echo $recent->id; ?>"><?php echo $recent->title; ?></a></h3>
									</div>
								</div>
							</div>
							<?php 
									}
								}
							?>
							<div class="clearfix visible-md visible-lg"></div>
							<?php
								$offset+=2;
								}
							?>			
							<!-- /post -->
						</div>
					</div>

					<div class="col-md-4">
						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>
							<?php 
								$blog_object = new Blog();
								$blog_most=$blog_object->getBlogByViews(0,4);
								// debugger($blog_most);
								if($blog_most){
									foreach ($blog_most as $key => $blog) {
										if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOADS_PATH.'blog/'.$blog->image)){												
												$thumbnail=UPLOAD_URL.'blog/'.$blog->image;
											}else{
												$thumbnail=UPLOAD_URL.'logo.png';	
											}
							?>


							<div class="post post-widget">
								<a class="post-img" href="blog-post?id=<?php echo $blog->id ?>"><img style="width: 90px; height:90px; object-fit:cover;"  src="<?php echo $thumbnail ?>" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id ?>"><?php echo $blog->title ?></a></h3>
								</div>
							</div>

							<?php				
									}
								}
							?>

							<!-- <div class="post post-widget">
								<a class="post-img" href="blog-post.html"><img src="./assets/img/widget-1.jpg" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post.html">Tell-A-Tool: Guide To Web Design And Development Tools</a></h3>
								</div>
							</div>

							<div class="post post-widget">
								<a class="post-img" href="blog-post.html"><img src="./assets/img/widget-2.jpg" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post.html">Pagedraw UI Builder Turns Your Website Design Mockup Into Code Automatically</a></h3>
								</div>
							</div>

							<div class="post post-widget">
								<a class="post-img" href="blog-post.html"><img src="./assets/img/widget-3.jpg" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post.html">Why Node.js Is The Coolest Kid On The Backend Development Block!</a></h3>
								</div>
							</div>

							<div class="post post-widget">
								<a class="post-img" href="blog-post.html"><img src="./assets/img/widget-4.jpg" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post.html">Tell-A-Tool: Guide To Web Design And Development Tools</a></h3>
								</div>
							</div> -->
						</div>
						<!-- /post widget -->

						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Featured Posts</h2>
							</div>
							<?php
								
								$featured_info=$blog_object->getAllFeaturedBlog();
								if($featured_info){
									for ($i=0; $i < 2; $i++) { 
										$random=rand(0,sizeof($featured_info)-1);
										// echo $random;
										if(isset($featured_info[$random]->image) && !empty($featured_info[$random]->image) && file_exists(UPLOADS_PATH.'blog/'.$featured_info[$random]->image)){
												$thumbnail=UPLOAD_URL.'blog/'.$featured_info[$random]->image;


											}else{
												$thumbnail=UPLOAD_URL.'logo.png';	
											}
									// debugger($featured_info[$random]);
								?>

							

							<div class="post post-thumb">
								<a class="post-img" href="blog-post?id=<?php echo $featured_info[$random]->id; ?>"><img style="width: 360px; height:216px; object-fit:cover;" src="<?php echo $thumbnail ?>" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category <?php echo(COLOR[$featured_info[$random]->categoryid%4]);?>" href="category?id=<?php echo $featured_info[$random]->categoryid ?>"><?php echo $featured_info[$random]->category ?></a>
										<span class="post-date" style="color:black;"><?php echo date("M d, Y",strtotime($featured_info[$random]->created_date));?></span>
									</div>
									<h3 class="post-title"><a href="blog-post?id=<?php echo $featured_info[$random]->id; ?>"><?php echo $featured_info[$random]->title; ?></a></h3>
								</div>
							</div>

							<?php		
									}
								}
							 ?>
						</div>
						<!-- /post widget -->
						
						<!-- ad -->
						<div class="aside-widget text-center">
							<?php randomAd('simplead');	 ?>
						</div>
						<!-- /ad -->
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
		
		<!-- section -->
		<div class="section section-grey">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="section-title text-center">
							<h2>Featured Posts</h2>
						</div>
					</div>
					<?php
						$featured_info=$blog_object->getAllFeaturedBlog();
						if($featured_info){
							 	for ($i=0; $i <3 ; $i++) { 
								$random=rand(0,sizeof($featured_info)-1);
								// echo $random;
								if(isset($featured_info[$random]->image) && !empty($featured_info[$random]->image) && file_exists(UPLOADS_PATH.'blog/'.$featured_info[$random]->image)){
										$thumbnail=UPLOAD_URL.'blog/'.$featured_info[$random]->image;


									}else{
										$thumbnail=UPLOAD_URL.'logo.png';	
									}
					?>

					<div class="col-md-4">
						<div class="post">
							<a class="post-img" href="blog-post?id=<?php echo $featured_info[$random]->id; ?>"><img style="width: 360px; height:216px; object-fit:cover;" src="<?php echo $thumbnail ?>" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category <?php echo(COLOR[$featured_info[$random]->categoryid%4]);?>" href="category?id=<?php echo $featured_info[$random]->categoryid ?>"><?php echo $featured_info[$random]->category ?></a>
										<span class="post-date" style="color:black;"><?php echo date("M d, Y",strtotime($featured_info[$random]->created_date));?></span>
								</div>
								<h3 class="post-title"><a href="blog-post?id=<?php echo $featured_info[$random]->id; ?>"><?php echo $featured_info[$random]->title; ?></a></h3>
							</div>
						</div>
					</div>
					<?php
							}
						}	
					?>
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-12">
								<div class="section-title">
									<h2>Most Read</h2>
								</div>
							</div>
							<?php 
								$blog_most=$blog_object->getBlogByViews(0,4);
								// debugger($blog_most);
								if($blog_most){
									foreach ($blog_most as $key => $blog) {
										if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOADS_PATH.'blog/'.$blog->image)){												
												$thumbnail=UPLOAD_URL.'blog/'.$blog->image;
											}else{
												$thumbnail=UPLOAD_URL.'logo.png';	
											}
							?>
							<div class="col-md-12">
								<div class="post post-row">
									<a class="post-img" href="blog-post?id=<?php echo $blog->id ?>"><img style="width: 300px; height:180px; object-fit:cover;" src="<?php echo $thumbnail ?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?php echo COLOR[$blog->categoryid%4] ?>" href="category?id=<?php echo $blog->categoryid  ?>"><?php echo $blog->category ?></a>
											<span class="post-date" style="color:black;"><?php echo date("M d, Y",strtotime($blog->created_date));?></span>
										</div>
										<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id ?>"><?php echo $blog->title; ?></a></h3>
										<p><?php echo substr(html_entity_decode($blog->content),0,100),'...'; ?>
													<a href="blog-post?id=<?php echo $blog->id; ?>">read more</a></p>
									</div>
								</div>
							</div>
							<?php 
									}
								}	
							?>
							
							
						</div>
					</div>

					<div class="col-md-4">
						<!-- ad -->
						<div class="aside-widget text-center">
							<?php randomAd('simplead');	 ?>
						</div>
						<!-- /ad -->
						
						<!-- catagories -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Categories</h2>
							</div>
							<div class="category-widget">
								<ul>
									<?php 
										if($categories){
											foreach ($categories as $key => $category) {
									?>
												<li><a href="category?id=<?php echo $category->id ?>"  class="<?php echo COLOR[$category->id%4] ?>"><?php echo $category->categoryname;?>
												<span>
												<?php

													 echo ($blog_object->getBlogNumberByCategory($category->id)[0]->count);
												?>
												</span></a></li>
									<?php			
											}
										}
									?>	
									
								</ul>
							</div>
						</div>
						<!-- /catagories -->
						
						
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->

<?php include 'inc/footer.php' ?>