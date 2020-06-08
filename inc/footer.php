<?php 
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
									         $url = "https://";   
									    else  
									         $url = "http://";   
									    // Append the host(domain name, ip) to the URL.   
									    $url.= $_SERVER['HTTP_HOST'];   
									    
									    // Append the requested resource location to the URL   
									    $url.= $_SERVER['REQUEST_URI'];    
									      
								?>

<!-- Footer -->
		<footer id="footer">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-5">
						<div class="footer-widget">
							<div class="footer-logo">
								<a href="index" class="logo"><img src="assets/img/logowhite-1.png" alt="" style="width:180px;height:auto;"></a>
							</div>
							<ul class="footer-nav">
								<li><a href="#">Privacy Policy</a></li>
							</ul>
							<div class="footer-copyright">
								<span>&copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved.
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div class="row">
							<div class="col-md-6">
								<div class="footer-widget">
									<h3 class="footer-title">About Us</h3>
									<ul class="footer-links">
										<li><a href="about">About Us</a></li>
										<li><a href="contact">Contacts</a></li>
									</ul>
								</div>
							</div>
							<div class="col-md-6">
								<div class="footer-widget">
									<h3 class="footer-title">Categories</h3>
									<ul class="footer-links">
									<?php
										$category = new Category();
										$categories=$category->getAllCategory();
										foreach ($categories as $key => $categories) {
									?>
										<li><a href="category?id=<?php echo $categories->id ?>"><?php echo $categories->categoryname;?></a></li>
									<?php		
									}
									?>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="footer-widget">
							<h3 class="footer-title">Join our Newsletter</h3>
							<div class="footer-newsletter">
								<form method="get" action="process/subscribe">
									<input class="input" type="email" name="newsletter" placeholder="Enter your email" required="">
									<input type="hidden" name="url" value="<?php echo $url ?>" >
									<button class="newsletter-btn" ><i class="fa fa-paper-plane"></i></button>
								</form>
							</div>
							<ul class="footer-social">
						<?php		
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
					</div>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</footer>
		<!-- /Footer -->

		<!-- jQuery Plugins -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/main.js"></script>

	</body>
</html>
