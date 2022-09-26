<?php
    include 'views/fixed/head.php';
    include 'views/fixed/header.php';
	if(isset($_SESSION['user'])){
        header('Location: 404.php');
    }
?>


<div class="tm-container-inner-2 tm-contact-section">
				<div class="row">

						<div class="" id="form-hold">
							<form action="" method="POST" class="tm-contact-form" id="">	
								<div class="form-group">
									<label for="username">User name</label>
									<input type="text" name="name" class="form-control" id="username" />
									<span class="error-text hidden">placeholder</span>
								</div>
								
								<div class="form-group">
									<label for="usermail">Email</label>
									<input type="email" name="email" class="form-control" id="usermail"/>
									<span class="error-text hidden">placeholder</span>
								</div>
					
								<div class="form-group">
									<label for="message">Password</label>
									<input type="password" name="password" class="form-control" id="userpassword"/>
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


    <?php
        include 'views/fixed/scripts.php';
    ?>
</body>
</html>