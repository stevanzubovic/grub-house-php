<?php
    if(isset($_SESSION['user'])){
        if($_SESSION['user']->roleId !== '1') {
            header('Location: error.php');
        }
    }
    include_once 'views/fixed/head.php';
    include_once 'models/functions.php';
    logPageAcess();
?>
<body> 
    <div id="whole-window-popup">
        <div id="edit-form">
        <button id="close">&times;</button>
        <form id="edit-data" class="tm-contact-form">

        </form>

        </div>
    </div>
	<div class="container">
		<!-- Logo & Site Name -->
		<div class="placeholder">
			<div class="parallax-window" data-parallax="" data-image-src="assets/img/simple-house-01.jpg">
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
<div id="admin-pop-up" class="hidden">

	</div>
<main>
    <div id="admin-container">
        <div id="admin-nav">
            <ul>
                <li id="admin-products">
                    Products
                </li>
                <li id="admin-categories">
                    Categories
                </li>
                <li id="admin-contacts">
                    Contacts
                </li>
               <!--  <li id="admin-surveys">
                    Survey
                </li> -->
                <li id="admin-users">
                    Users
                </li>
                <li id="admin-page-access">
                    Page access records
                </li>
            </ul>
        </div>
        <div id="admin-controls" class="zui-table">
            <table product-table table-striped>
                <div id="product-error">
            <p>Select  an area to manage from the left menu</p>
        </div>
            </table>
        </div>
    </div>
    <div id="info" class="hidden">
        <select id="categories-hidden" class="form-control">
        <option value="" selected>Select Category</option>
        <?php
            $allCats = selectAll('categories');
            foreach($allCats as $category):
        ?>
            <option value="<?= $category->id ?>"> <?= $category->name ?> </option>
        <?php
            endforeach;
        ?>
            </select>
            <select class="form-control" id="prices-hidden">
            <option value="" selected>Select Price</option>
        <?php
            $allPrices = selectAll('price');
            //var_dump($allPrices);
            foreach($allPrices as $price):
        ?>
            <option value="<?= $price->id ?>"> <?= $price->amount ?> </option>
        <?php
            endforeach;
        ?>
        </select>
    </div>
    
</main>


<?php
    include_once 'views/fixed/scripts.php';
    include_once 'views/fixed/footer.php';
?>
	
</body>
</html> 