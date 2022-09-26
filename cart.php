<?php
	  include_once 'views/fixed/head.php';
	  include_once 'views/fixed/header.php';
	  include_once 'views/fixed/nav.php';
	  include_once 'models/functions.php';
	  logPageAcess();
?>

		<main>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Grub house cart</h2>
				<p class="col-12 text-center">Need a quick bite or a substantial meal? Come on down to the Grub House! 
					All of the food is delicious and served fresh - straight from the oven!
					Our delivery personnel strive to deliver your food in the shortest time possible
				</p>
			</header>
			
			<div class="row tm-gallery zui-table" id="product-cart"> </div>
			<div id="checkout" class="hidden">
				<input type="button" class="tm-btn tm-btn-success tm-btn-right" id="checkout-button" value="Checkout"/>
			</div>
			

			<div class="tm-section tm-container-inner" id="about">
				<div class="row">
					<div class="col-md-6">
						<figure class="tm-description-figure">
							<img src="assets/img/img-01.jpg" alt="Image" class="img-fluid" />
						</figure>
					</div>
					<div class="col-md-6">
						<div class="tm-description-box"> 
							<h4 class="tm-gallery-title">About Grub Hub</h4>
							<p class="tm-mb-45">Grub hub was founded when two broke college students decided to make sandwiches affordable to anyone who wanted sandwiches
								To find out more about Grub Hub and it's staff click the button below
							</p>
							<a href="about.html" class="tm-btn tm-btn-default tm-right">Read More</a>
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