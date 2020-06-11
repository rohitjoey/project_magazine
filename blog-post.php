<?php include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
		if(isset($_GET['id']) && !empty($_GET['id'])){
			$blog_id=(int)$_GET['id'];
			if($blog_id){
				$blog_object= new BLog();
				$blog_info=$blog_object->getBLogById($blog_id);
					// debugger($blog_info);
				if($blog_info){
					$blog_info=$blog_info[0];
					$data=array(
							'views'=>$blog_info->views+1
						);
					$blog_object->updateBlogById($data,$blog_info->id);
				}else{
					redirect('index');
				}
			}else{
					redirect('index');
			}
		}else{
					redirect('index');
		}
		$header='BlogPost';
		include 'inc/header.php';	
		
?>

		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Post content -->
					<div class="col-md-8">
						<div class="section-row sticky-container">
							<div class="main-post">
								<?php echo html_entity_decode($blog_info->content);?> 
							</div>
							<!-- <div class="post-shares sticky-shares">
								<a href="#" class="share-facebook"><i class="fa fa-facebook"></i></a>
								<a href="#" class="share-twitter"><i class="fa fa-twitter"></i></a>
								<a href="#" class="share-google-plus"><i class="fa fa-google-plus"></i></a>
								<a href="#" class="share-pinterest"><i class="fa fa-pinterest"></i></a>
								<a href="#" class="share-linkedin"><i class="fa fa-linkedin"></i></a>
								<a href="#"><i class="fa fa-envelope"></i></a>
							</div> -->
						</div>

						<!-- ad -->
						<div class="section-row text-center">
							<?php randomAd('widead');?>
						</div>
						<!-- ad -->
						
						

						<!-- comments -->
						<div class="section-row">
							<div class="section-title">
								<h2>
								<?php 
									$comment_object = new Comment();
									$count=$comment_object->getCommentNumberByBlog($blog_id);
									echo (($count[0]->count)>1)?$count[0]->count.' Comments':$count[0]->count.' Comment';
								?>	
								</h2>
							</div>

							<div class="post-comments">
								<!-- comment -->
								
								<!-- /comment -->

								<!-- comment -->
								<?php 
									$comment_info=$comment_object->getAllAcceptedCommentByBlog($blog_id);
									// debugger($comment_info,true);
									if($comment_info){
										foreach ($comment_info as $key => $comments) {
									?>
									<div class="media">
										<div class="media-left">
											<img class="media-object" src="./assets/img/avatar.png" alt="">
									</div>
									<div class="media-body">
										<div class="media-heading">
											<h4><?php echo $comments->name?></h4>
											<span class="time" ><?php echo date('M d,Y h:i:s a',strtotime($comments->created_date)) ?></span>
											<a href="#ReplySection" class="reply" onclick="comment(this);" data-commentID='<?php echo $comments->id ?>'>Reply</a>
										</div>
										<p ><?php echo html_entity_decode($comments->message)?></p>
										
										<?php 
											$comment_reply=$comment_object->getAllAcceptedReplyByBlogByComment($blog_id,$comments->id);
											// debugger($comment_reply,true);
											if($comment_reply){
												foreach ($comment_reply as $key => $reply) {
											
										?>
										<!-- Reply -->
										<div class="media">
											<div class="media-left">
												<img class="media-object" src="./assets/img/avatar.png" alt="">
											</div>
											<div class="media-body">
												<div class="media-heading">
													<h4><?php echo $reply->name;?></h4>
													<span class="time"><?php echo date('M d,Y h:i:s a',strtotime($reply->created_date)) ?></span>
													<a href="#ReplySection" class="reply" onclick="comment(this);" data-commentID='<?php echo $comments->id ?>'>Reply</a>
												</div>
												<p><?php echo html_entity_decode($reply->message)?></p>
											</div>
										</div>
								<!-- /Reply -->

										<?php			
										
												}
											}
										?>
									</div>
								</div >
									<?php		
										}
									}

								?>
								
								<!-- /comment -->
							</div>
						</div>
						<!-- /comments -->

						<!-- reply -->
						<div class="section-row" id="ReplySection" >
							<div class="section-title">
								<h2>Leave a reply</h2>
								<p>your email address will not be published. required fields are marked *</p>
							</div>
							<form class="post-reply" action="process/comment" method="post">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<span>Name *</span>
											<input class="input" type="text" name="name">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span>Email *</span>
											<input class="input" type="email" name="email">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span>Website</span>
											<input class="input" type="text" name="website">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="input" name="message" placeholder="Message"></textarea>
										</div>
										<input type="hidden" name="commentId" id="commentId" value="">
										<input type="hidden" name="blogId" value="<?php echo $blog_id?>">
										<button class="primary-button" type="Submit">Submit</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /reply -->
					</div>
					<!-- /Post content -->

					<!-- aside -->
					<div class="col-md-4">
						<!-- ad -->
						<div class="aside-widget text-center">
							<?php randomAd('simplead');?>
						</div>
						<!-- /ad -->

						<!-- post widget -->
						<div class="aside-widget">
							<div class="section-title">
								<h2>Most Read</h2>
							</div>
							<?php 
								$mostViewed = new Blog();
								$mostViewed_info=$mostViewed->getBlogByViews(0,3);
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
								<a class="post-img" href="blog-post?id=<?php echo $blog->id ?>"><img style="width: 90px; height:90px; object-fit:cover;" src="<?php echo $thumbnail ?>" alt=""></a>
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

						<!-- Featured -->
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
								<a class="post-img" href="blog-post?id=<?php echo $featured_info[$random]->id; ?>"><img style="width: 100%; height:216px; object-fit:cover;"src="<?php echo $thumbnail ?>" alt=""></a>
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
						<!-- /Featured -->

						
						
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
					<!-- /aside -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /section -->
<?php 
		include 'inc/footer.php';
?>
<script>
	$('blockquote').addClass('blockquote');
	function comment(element){
		var comment_id=$(element).data();
		// console.log(comment_id.commentid);
		$('#commentId').val(comment_id.commentid);
	}

</script>
		