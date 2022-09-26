<?php
	include_once 'models/functions.php';
	include_once 'views/fixed/head.php';
	logPageAcess();
	//var_dump($_SESSION);
?>
<!DOCTYPE html>
<html>

<body> 
	<div id="pop-up" class="hidden">
		Added to cart
	</div>
	<div class="container">
		<!-- Logo & Site Name -->
		<div class="placeholder">
			<div class="parallax-window" data-parallax="scroll" data-image-src="assets/img/simple-house-01.jpg">
				<div class="tm-header">
					<div class="row tm-header-inner">
						<div class="col-md-6 col-12">
							<img src="assets/img/simple-house-logo.png" alt="Logo" class="tm-site-logo" /> 
							<div class="tm-site-text-box">
								<h1 class="tm-site-title">Grub House</h1>
								<h6 class="tm-site-description">Quick and delicious</h6>	
							</div>
						</div>
						<!-- Nav bar -->

						<?php
							include 'views/fixed/nav.php'
						?>
						
					</div>
				</div>
			</div>
		</div>

		<main>
			<header class="row tm-welcome-section">
				<h2 class="col-12 text-center tm-section-title">Welcome to Grub House</h2>
				<p class="col-12 text-center">Need a quick bite or a substantial meal? Come on down to the Grub House! 
					All of the food is delicious and served fresh - straight from the oven!
				</p>
			</header>
			
			
			<div class="tm-paging-links" >	
				<div id="survey" class="above-products">
					<form action="models/handleSurvey" method="post">
						<p>
							<?php
								$survey = getSurveyQuestions();
								echo $survey->question;	
							?>
						</p>	
						<div class="form-control">
							<ul>
								<?php
									$answers = getSurveyAnswers($survey->id);	
									foreach($answers as $answer):
								?>
								<li class="survey-option">
									<input type="radio" name="answer" value="<?= $answer->id ?>" id="<?= $answer->id ?>">
									<label for="<?= $answer->id ?>"><?= $answer->answer ?></label>
								</li>
								<?php
								endforeach
								?>							
							</ul>	
							<?php
								if(isset($_SESSION['user'])):
							?>
							<input type="button" data-id="<?= $survey->id ?>" id="submitSurvey" value="Submit" class="tm-btn">
							<?php
							else:
							?>
						
							<input type="button" data-id="<?= $survey->id ?>" id="loginToSubmit" value="Login" class="tm-btn">
							<label for="loginToSubmit" class="hidden">Login to participate</label>
							<?php
							endif
							?>
						</div>
						<span class="error-text hidden" id="surveyError">placeholder</span>
					</form>
				</div>
				<div class="above-products" id="product-controls">
					<div id="filterSort" >
						<ul class="buttoni">
							<p>Choose food type</p>
						<?php
						$categories = selectAll('categories');
						foreach($categories as $category):
						?>
						<li>
							<input type="checkbox" name="filter" id="<?= $category->name ?>" class="category ch-data"  data-id="<?= $category->id ?>" value="<?= $category->id ?>">
        					<label for="<?= $category->name ?>"><?= ucfirst($category->name) ?></label>
						</li>
						<?php endforeach ?>
						</ul>
						</div>
						<input type="search" name="search" id="search" class="ch-data" placeholder="Search...">
						<select name="sort1" id="sort" class="ch-data">
							<option value="no" selected="selected" >Sort by price...</option>
							<option value="asc">Ascending</option>
							<option value="desc">Descending</option>
						</select>

				</div>
			</div>
			<div class="row tm-gallery" id="gallery"> 
				<?php
					include 'views/sad/products.php'
				?>
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

		<footer class="tm-footer text-center">
			<p>Copyright &copy; 2021 Grub House </p>
		</footer>
	</div>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/parallax.min.js"></script>
	
</body>
</html>