<?php include $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
		$header="About";
		$bread='About us';
		include 'inc/header.php';	
				
?>
		
		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-8">
						<div class="section-row">
							<p>Lorem ipsum dolor sit amet, ea eos tibique expetendis, tollit viderer ne nam. No ponderum accommodare eam, purto nominavi cum ea, sit no dolores tractatos. Scripta principes quaerendum ex has, ea mei omnes eruditi. Nec ex nulla mandamus, quot omnesque mel et. Amet habemus ancillae id eum, justo dignissim mei ea, vix ei tantas aliquid. Cu laudem impetus conclusionemque nec, velit erant persius te mel. Ut eum verterem perpetua scribentur.</p>
							<figure class="figure-img">
								<img class="img-responsive" style="width: 750px; height:auto; object-fit:cover;" src="./assets/img/php.png" alt="">
							</figure>
							<p>Vix mollis admodum ei, vis legimus voluptatum ut, vis reprimique efficiendi sadipscing ut. Eam ex animal assueverit consectetuer, et nominati maluisset repudiare nec. Rebum aperiam vis ne, ex summo aliquando dissentiunt vim. Quo ut cibo docendi. Suscipit indoctum ne quo, ne solet offendit hendrerit nec. Case malorum evertitur ei vel.</p>
						</div>
						<div class="row section-row">
							<div class="col-md-6">
								<figure class="figure-img">
									<img class="img-responsive" style="width: 360px; height:270px; object-fit:cover;" src="./assets/img/php.png" alt="">
								</figure>
							</div>
							<div class="col-md-6">
								<h3>Our Mission</h3>
								<p>Id usu mutat debet tempor, fugit omnesque posidonium nec ei. An assum labitur ocurreret qui, eam aliquid ornatus tibique ut.</p>
								<ul class="list-style">
									<li><p>Vix mollis admodum ei, vis legimus voluptatum ut.</p></li>
									<li><p>Cu cum alia vide malis. Vel aliquid facilis adolescens.</p></li>
									<li><p>Laudem rationibus vim id. Te per illum ornatus.</p></li>
								</ul>
							</div>
						</div>
					</div>
					
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