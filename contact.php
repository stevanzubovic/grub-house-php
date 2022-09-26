<?php 
	 include_once 'views/fixed/head.php';
	 include_once 'views/fixed/header.php';
	 include_once 'views/fixed/nav.php';
?>
<body> 	
		<main>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Contact Page</h2>
				<p class="col-12 text-center">If you wish to contact us you may do so by using the below form or by conntacting us directly.
					 We will respond to any inquiries promptly.
				</p>
			</header>

			<div class="tm-container-inner-2 tm-contact-section">
				<div class="row">
					<div class="col-md-6">
						<form action="" method="POST" class="tm-contact-form" id="contact-form">	
					        <div class="form-group">
								<label for="username">Name</label>
					          	<input type="text" name="name" class="form-control" id="username" />
								<span class="error-text hidden">placeholder</span>
					        </div>
					        
					        <div class="form-group">
								<label for="usermail">Email</label>
					          	<input type="email" name="email" class="form-control" id="usermail"/>
								<span class="error-text hidden">placeholder</span>
					        </div>
				
					        <div class="form-group">
								<label for="message">Message</label>
					          	<textarea rows="5" name="message" class="form-control" id="message"></textarea>
								<span class="error-text hidden"></span>
					        </div>
					
					        <div class="form-group tm-d-flex">
					          <button type="button" id="contact-button" class="tm-btn tm-btn-success tm-btn-right">
					            Send
					          </button>
					        </div>
						</form>
					</div>
				</div>
			</div>
            

			<div class="tm-container-inner-2 tm-map-section">
				<div class="row">
					<div class="col-12">
						<div class="tm-map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11196.961132529668!2d-43.38581128725845!3d-23.011063013218724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9bdb695cd967b7%3A0x171cdd035a6a9d84!2sAv.%20L%C3%BAcio%20Costa%20-%20Barra%20da%20Tijuca%2C%20Rio%20de%20Janeiro%20-%20RJ%2C%20Brazil!5e0!3m2!1sen!2sth!4v1568649412152!5m2!1sen!2sth" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
						</div>
					</div>
				</div>
			</div>
		</main>

		<?php
        include_once 'views/fixed/scripts.php';
		include_once 'views/fixed/footer.php';
    	?>
</body>
</html>