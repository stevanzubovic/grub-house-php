<div id="tm-gallery-page-pizza" class="tm-gallery-page">
<?php
    //include __DIR__.'/../../config/connection.php';
    $query = 'SELECT *, products.id as productId FROM products  INNER JOIN images_for_products ON products.image_id = images_for_products.id INNER JOIN price ON price_id = price.id';

    $products = $conn->query($query);

    foreach($products as $p):
?>
    <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
            <figure>
                <img src="assets/img/gallery/<?= $p->url ?>" alt="<?= $p->alt ?>" class="img-fluid tm-gallery-img" />
                <figcaption>
                    <h4 class="tm-gallery-title"><?= $p->name ?></h4>
                    <p class="tm-gallery-description"><?= $p->description ?></p>
                    <div class="price-cart">
                        <p class="tm-gallery-price"><?= $p->amount ?>$</p>
                        <input type="button" data-id="<?= $p->productId ?>" class="tm-btn tm-btn-success tm-btn-right add-to-cart" value="Add to cart"/>
                    </div>
                </figcaption>
            </figure>
         
            </article>

<?php
    endforeach
?>