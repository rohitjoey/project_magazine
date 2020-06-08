<?php include $_SERVER['DOCUMENT_ROOT'].'config/init.php';
		
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){   
         $url = "https://";   
    }else{
         $url = "http://";   }
    // Append the host(domain name, ip) to the URL.   
    $url.= $_SERVER['HTTP_HOST'];   
    
    // Append the requested resource location to the URL   
    $url.= $_SERVER['REQUEST_URI']; 
    // echo $url;   
									      
								
    	$bread="Contact Us";
		include 'inc/header.php';	

		
?>


		<!-- section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-6">
						<div class="section-row">
							<h3>Contact Information</h3>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<ul class="list-style">
								<li><p><strong>Email:</strong> <a href="#">magazine_admin@email.com</a></p></li>
								<li><p><strong>Phone:</strong> 213-520-7376</p></li>
								<li><p><strong>Address:</strong> Thimi, Bhaktapur</p></li>
							</ul>
						</div>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<div class="section-row">
							<h3>Send A Message</h3>
							<form action="process/contact" method="post">
								<div class="row">
									<div class="col-md-7">
										<div class="form-group">
											<span>Email</span>
											<input class="input" type="email" name="email" required="">
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<span>Subject</span>
											<input class="input" type="text" name="subject" required="">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="input" name="message" placeholder="Message" required=""></textarea>
										</div>
										<input type="hidden" name="url" value="<?php echo $url ?>">
										<button class="primary-button" type="Submit">Submit</button><?php flashMessage(); ?>
									</div>
								</div>
							</form>
						</div>
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
