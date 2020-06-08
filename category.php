<?php include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
		$header="Category";
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$cat_id=(int)$_GET['id'];
			if($cat_id){
				$category = new Category();
				$category_info=$category->getCategoryById($cat_id);
				if($category_info){
					$category_info=$category_info[0];
					$bread=$category_info->categoryname;

				}else{
					redirect('index');
				}
			}else{
					redirect('index');

			}
		}else{
					redirect('index');

		}
		include 'inc/header.php';	

		
?>
		
		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							
							<?php
								$blogO = new Blog();
								$featured_blog_info=$blogO->getAllFeaturedBlogOfCategoryWithLimit($cat_id,0,3);
								// debugger($featured_blog_info,true);
								if(isset($featured_blog_info[0]) && !empty($featured_blog_info[0])){
							?>	
								<!-- post -->
							<div class="col-md-12">
								<div class="post post-thumb">
									<?php	
											if(isset($featured_blog_info[0]->image) && !empty($featured_blog_info[0]->image) && file_exists(UPLOADS_PATH.'blog/'.$featured_blog_info[0]->image)){
												$thumbnail=UPLOAD_URL.'blog/'.$featured_blog_info[0]->image;


											}else{
												$thumbnail=UPLOAD_URL.'logo.png';	
											}
									?>		
									<a class="post-img" href="blog-post?id=<?php echo $featured_blog_info[0]->id; ?>"><img src="<?php echo $thumbnail;?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?php echo(COLOR[$cat_id%4]);?>" href=""><?php echo $bread ?></a>
											<span class="post-date" style="color:black;"><?php echo date("M d, Y",strtotime($featured_blog_info[0]->created_date));?></span>
										</div>
										<h3 class="post-title"><a href="blog-post?id=<?php echo $featured_blog_info[0]->id; ?>"><?php echo $featured_blog_info[0]->title; ?></a></h3>
									</div>
								</div>
							</div>
							<!-- /post -->
								
							<?php		
								}if(isset($featured_blog_info[1]) && !empty($featured_blog_info[1]) && isset($featured_blog_info[2]) && !empty($featured_blog_info[2])){
							?>	
								<!-- post -->
							<div class="col-md-6">
								<div class="post">
									<?php	
											if(isset($featured_blog_info[1]->image) && !empty($featured_blog_info[1]->image) && file_exists(UPLOADS_PATH.'blog/'.$featured_blog_info[1]->image)){
												$thumbnail=UPLOAD_URL.'blog/'.$featured_blog_info[1]->image;


											}else{
												$thumbnail=UPLOAD_URL.'logo.png';	
											}
									?>	
									<a class="post-img" href="blog-post?id=<?php echo $featured_blog_info[1]->id; ?>"><img src="<?php echo $thumbnail;?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?php echo(COLOR[$cat_id%4]);?>" href=""><?php echo $bread ?></a>
											<span class="post-date" style="color:black;"><?php echo date("M d, Y",strtotime($featured_blog_info[1]->created_date));?></span>
										</div>
										<h3 class="post-title"><a href="blog-post?id=<?php echo $featured_blog_info[1]->id; ?>"><?php echo $featured_blog_info[1]->title; ?></a></h3>
									</div>
								</div>
							</div>
							<!-- /post -->
						
							<!-- post -->
							<div class="col-md-6">
								<div class="post">
									<?php	
											if(isset($featured_blog_info[2]->image) && !empty($featured_blog_info[2]->image) && file_exists(UPLOADS_PATH.'blog/'.$featured_blog_info[2]->image)){
												$thumbnail=UPLOAD_URL.'blog/'.$featured_blog_info[2]->image;


											}else{
												$thumbnail=UPLOAD_URL.'logo.png';	
											}
									?>	
									<a class="post-img" href="blog-post?id=<?php echo $featured_blog_info[2]->id; ?>"><img src="<?php echo $thumbnail;?>" alt=""></a>
									<div class="post-body">
										<div class="post-meta">
											<a class="post-category <?php echo(COLOR[$cat_id%4]);?>" href=""><?php echo $bread ?></a>
											<span class="post-date" style="color:black;"><?php echo date("M d, Y",strtotime($featured_blog_info[2]->created_date));?></span>
										</div>
										<h3 class="post-title"><a href="blog-post?id=<?php echo $featured_blog_info[2]->id; ?>"><?php echo $featured_blog_info[2]->title; ?></a></h3>
									</div>
								</div>
							</div>
							<!-- /post -->

							<?php		
								}
							?>
							
							<div class="clearfix visible-md visible-lg"></div> 
							
							<!-- ad -->
							<div class="col-md-12">
								<div class="section-row">
									<?php randomAd('widead');?>
								</div>
							</div>
							<!-- ad -->
							
							<?php 
								$recent=$blogO->getAllRecentBlogOfCategoryWithLimit($cat_id,0,4);
									if($recent){
										foreach ($recent as $key => $blog) {
											if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOADS_PATH.'blog/'.$blog->image)){
												$thumbnail=UPLOAD_URL.'blog/'.$blog->image;
											}else{
												$thumbnail=UPLOAD_URL.'logo.png';	
											}
							?>		
										<!-- post -->
									<div class="col-md-12">
										<div class="post post-row">
											<a class="post-img" href="blog-post?id=<?php echo $blog->id; ?>"><img src="<?php echo $thumbnail;?>" alt=""></a>
											<div class="post-body">
												<div class="post-meta">
													<a class="post-category <?php echo(COLOR[$cat_id%4]);?>" href=""><?php echo $bread ?></a>
													<span class="post-date" style="color:black;"><?php echo date("M d, Y",strtotime($blog->created_date));?></span>
												</div>
												<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id; ?>"><?php echo $blog->title; ?></a></h3>
												<p>
													<?php echo substr(html_entity_decode($blog->content),0,100),'...'; ?>
													<a href="blog-post?id=<?php echo $blog->id; ?>"><i class="fa fa-info"></i></a>
												</p>
											</div>
										</div>
									</div>
									<!-- /post -->						

							
							<?php		
										}
									}	
							?>


							
							
							
							
							<div class="col-md-12">
								<div class="section-row">
									<button class="primary-button center-block">Load More</button>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-4">
						<!-- ad -->
						<div class="aside-widget text-center">
							<?php randomAd('simplead');?>
						</div>
						<!-- /ad -->
						<!-- ./assets/img/ad-1.jpg -->
						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>
							<?php 
								$mostViewed = new Blog();
								$mostViewed_info=$mostViewed->getAllMostViewedBlogOfCategoryWithLimit($cat_id,0,3);
								// debugger($mostViewed_info,true);
								if($mostViewed_info){
									foreach ($mostViewed_info as $key => $blog) {
											if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOADS_PATH.'blog/'.$blog->image)){												
												$thumbnail=UPLOAD_URL.'blog/'.$blog->image;
											}else{
												$thumbnail=UPLOAD_URL.'logo.png';	
											}
							?>
							<div class="post post-widget">
								<a class="post-img" href="blog-post?id=<?php echo $blog->id ?>"><img src="<?php echo $thumbnail ?>" alt=""></a>
								<div class="post-body">
									<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id ?>"><?php echo $blog->title ?></a></h3>
								</div>
							</div>
							<?php
									}
								}
							?>
						</div>
						<!-- /post widget -->
						
						<!-- categories -->
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

													 echo ($blogO->getBlogNumberByCategory($category->id)[0]->count);
												?>
												</span></a></li>
									<?php			
											}
										}
									?>	
									
								</ul>
							</div>
						</div>
						<!-- /categories -->
						
						
						
						<!-- archive -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Archive</h2>
							</div>
							<div class="archive-widget">
								<ul>
							<?php 
								$archive_object = new Archive();
								$archives=$archive_object->getAllArchive();
								$number=$archive_object->getArchiveNumberByDate();
								// debugger($number,true);
								foreach ($archives as $key => $archive) {
									if($number[$key]->count!=0){
							?>			
									<li><a href="archive?id=<?php echo $archive->id ?>"><?php echo date("M d, Y",strtotime($archive->date)) ?></a></li>
							<?php
									}
							}
							?>
									
								</ul>
							</div>
						</div>
						<!-- /archive -->
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
<?php 
		include 'inc/footer.php';
?>	
