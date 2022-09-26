<?php
	include_once 'views/fixed/head.php';
	include_once 'views/fixed/header.php';
	include_once 'views/fixed/nav.php';
    include_once 'models/functions.php';
    logPageAcess();
?>

		<main>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">About Simple House</h2>
				<p class="col-12 text-center">If you want to find out more about the restaurant and it's employees you're in the right place</p>
			</header>

			<div class="tm-container-inner tm-persons">
				<div class="row" id="biographies">
				<article class="col-lg-6">
            <figure class="tm-person">
            <img src="assets/img/about-01.jpg" alt="${element.img.alt}" class="img-fluid tm-person-img" />
            <figcaption class="tm-person-description">
                <h4 class="tm-person-name">Jennifer Soft</h4>
                <p class="tm-person-title">Founder and CEO</p>
                <p class="tm-person-about">Jennifer founded the company with her friend Marc and is currently developing a revolutionary new sandwich</p>
                <div>
                    <a href="https://fb.com" class="tm-social-link"><i class="fab fa-facebook tm-social-icon"></i></a>
                    <a href="https://twitter.com" class="tm-social-link"><i class="fab fa-twitter tm-social-icon"></i></a>
                    <a href="https://instagram.com" class="tm-social-link"><i class="fab fa-instagram tm-social-icon"></i></a>
                </div>
            </figcaption>
            </figure>
        </article><article class="col-lg-6">
            <figure class="tm-person">
            <img src="assets/img/about-02.jpg" alt="${element.img.alt}" class="img-fluid tm-person-img" />
            <figcaption class="tm-person-description">
                <h4 class="tm-person-name">Daisy Walker</h4>
                <p class="tm-person-title">Executive Chef</p>
                <p class="tm-person-about">Daisy also known as Orchid is the one who will be overseeing the mouth watering food you'll be enjoying</p>
                <div>
                    <a href="https://fb.com" class="tm-social-link"><i class="fab fa-facebook tm-social-icon"></i></a>
                    <a href="https://twitter.com" class="tm-social-link"><i class="fab fa-twitter tm-social-icon"></i></a>
                    <a href="https://instagram.com" class="tm-social-link"><i class="fab fa-instagram tm-social-icon"></i></a>
                </div>
            </figcaption>
            </figure>
        </article><article class="col-lg-6">
            <figure class="tm-person">
            <img src="assets/img/about-03.jpg" alt="${element.img.alt}" class="img-fluid tm-person-img" />
            <figcaption class="tm-person-description">
                <h4 class="tm-person-name">Florence Nelson</h4>
                <p class="tm-person-title">Kitchen Manager</p>
                <p class="tm-person-about">Florence is the one who will actually be making your food. Also she is the reigning world champion in speed mini quiche making    </p>
                <div>
                    <a href="https://fb.com" class="tm-social-link"><i class="fab fa-facebook tm-social-icon"></i></a>
                    <a href="https://twitter.com" class="tm-social-link"><i class="fab fa-twitter tm-social-icon"></i></a>
                    <a href="https://instagram.com" class="tm-social-link"><i class="fab fa-instagram tm-social-icon"></i></a>
                </div>
            </figcaption>
            </figure>
        </article><article class="col-lg-6">
            <figure class="tm-person">
            <img src="assets/img/about-04.jpg" alt="${element.img.alt}" class="img-fluid tm-person-img" />
            <figcaption class="tm-person-description">
                <h4 class="tm-person-name">Valentina Martin</h4>
                <p class="tm-person-title">Culinary Director</p>
                <p class="tm-person-about">Valentina has been with the company since the start and is a decorated veteran of the industry</p>
                <div>
                    <a href="https://fb.com" class="tm-social-link"><i class="fab fa-facebook tm-social-icon"></i></a>
                    <a href="https://twitter.com" class="tm-social-link"><i class="fab fa-twitter tm-social-icon"></i></a>
                    <a href="https://instagram.com" class="tm-social-link"><i class="fab fa-instagram tm-social-icon"></i></a>
                </div>
            </figcaption>
            </figure>
        </article>
				</div>
			</div>
			<div class="tm-container-inner tm-featured-image">
				<div class="row">
					<div class="col-12">
						<div class="placeholder-2">
								
						</div>
					</div>
				</div>
			</div>

			<div class="tm-container-inner tm-history">
				<div class="row">
					<div class="col-12">
						<div class="tm-history-inner">
							<img src="assets/img/about-06.jpg" alt="Image" class="img-fluid tm-history-img" />
							<div class="tm-history-text"> 
								<h4 class="tm-history-title">History of our restaurant</h4>
								<p class="tm-mb-p">The restaurant was founded when Jennifer Soft and her Friend Mark Lester developed a new kind hardbread sandwich and decided to share it with the world. From it's humble origins as a food stand it has come a long way indeed!</p>
								<p>Currently we are working on opening at a new location. Please stay tuned and you might just get the limited first edition Grub Hub merch! </p>
							</div>
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