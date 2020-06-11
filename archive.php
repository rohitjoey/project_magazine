<?php include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$archive_id=(int)$_GET['id'];
			if($archive_id){
				$archive = new Archive();
				$archive_info=$archive->getArchiveById($archive_id);
				// debugger($archive_info);
				if($archive_info){
					$archive_info=$archive_info[0];
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
					 
					<!-- aside -->
					<div class="col-md-8">
						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2><?php echo date("M d, Y",strtotime($archive_info->date)) ?></h2>
							</div>
							<?php 
								$blog_object = new Blog();
								$blogs=$blog_object->getBlogByArchiveDate($archive_info->date);
								// debugger($blogs);

								if($blogs){

									foreach ($blogs as $key => $blog) {
										if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOADS_PATH.'blog/'.$blog->image)){												
												$thumbnail=UPLOAD_URL.'blog/'.$blog->image;
											}else{
												$thumbnail=UPLOAD_URL.'logo.png';	
										}
							?>
									<div class="post post-widget">
										<a class="post-img" href="blog-post?id=<?php echo $blog->id ?>"><img style="width: 90px; height:90px; object-fit:cover;" src="<?php echo $thumbnail ?>" alt=""></a>
										<div class="post-body">
											<h3 class="post-title"><a href="blog-post?id=<?php echo $blog->id ?>"><?php echo $blog->title; ?></a></h3>
											<a href="category?id=<?php echo $blog->categoryid ?>"><?php echo $blog->category; ?></a>
											
										</div>
									</div>
							<?php			
									}
								}
							?>

							

							
							<div class="section-row">
									<?php randomAd('widead');?>
							</div>
						</div>
						<!-- /post widget -->
					</div>
					<!-- /aside -->
					
					<div class="col-md-4">
						<!-- ad -->
						<div class="aside-widget text-center">
							<?php randomAd('simplead');?>
						</div>
						<!-- /ad -->

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
		