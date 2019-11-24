<?php include ('includes/header.php'); ?>
<!-- Section: Contact -->
<div id="contact">
	<div class="contact-overlay contact">
		<div class="section-title p-4 text-center">
			<h1 class="h1-responsive">Contact</h1>
			<hr class="section">
		</div>
		<div class="container">
			<div class="white-text row">
				<div class="col-md-6 p-2 animated fadeInLeft">
					<h3 class="h3-responsive text-justify p-2">Reach out today!</h3>
					<p class="text-justify p-2">
						<ul class="list-unstyled mb-0 contact-details">
							<li class="p-2">
								<i class="px-2 fas fa-map-marker-alt fa-2x"></i>
								<span class="px-2">302, B-7, Sector-9, Shanti Nagar, Mira Road (E), Thane-401107</span>
							</li>

							<li class="p-2"> 
								<i class="px-2 fas fa-phone mt-4 fa-2x"></i>
								<span class="px-2">+91 82868 64601</span>
							</li>

							<li class="p-2">
								<i class="px-2 fas fa-envelope mt-4 fa-2x"></i>
								<span class="px-2"><a href="mailto:sksksharma0@gmail.com" class="white-text">sksksharma0@gmail.com</a></span>
							</li>
						</ul>
					</p>
					<div class="location">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1883.0897740917924!2d72.86277540807464!3d19.274556646743605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b05a0dd5123b%3A0xf9e5543510f58f4f!2sSector%209%2C%20Shanti%20Nagar%2C%20Mira%20Road%2C%20Mira%20Bhayandar%2C%20Maharashtra%20401107!5e0!3m2!1sen!2sin!4v1574403408310!5m2!1sen!2sin" height="300" frameborder="0" style="border:0;width: 100%" allowfullscreen=""></iframe>
					</div>
				</div>
				<div class="col-md-6 p-2 animated fadeInRight">
					<section class="contact-form">

						<!--Section heading-->
						<h3 class="h3-responsive text-justify p-2">Drop a message!</h3>
						<!--Section description-->
						<p class="text-justify w-responsive">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
						a matter of hours to help you.</p>

						<div>
							<form id="contact-form" name="contact-form" action="mail.php" method="POST">
								<div class="row">
									<div class="col-md-6">
										<div class="md-form mb-0">
											<input type="text" id="name" name="name" class="form-control">
											<label for="name" class="">Your name</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="md-form mb-0">
											<input type="text" id="email" name="email" class="form-control">
											<label for="email" class="">Your email</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="md-form mb-0">
											<input type="text" id="subject" name="subject" class="form-control">
											<label for="subject" class="">Subject</label>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="md-form">
											<textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
											<label for="message">Your message</label>
										</div>
									</div>
								</div>
							</form>

							<div class="text-center text-md-left">
								<a class="btn btn-outline-white" onclick="document.getElementById('contact-form').submit();">Send</a>
							</div>
							<div class="status"></div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include ('includes/footer.php');?>