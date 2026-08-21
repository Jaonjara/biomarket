<?php

/** @var object $shop */
/** @var object $shopRating */
/** @var array $categories */
/** @var object $products */
?>

<main>
    <section class="heros">
        <div class="heros-desc">
            <div class="heros-desc-imgparent">
                <img src="<?= $shop->photo ?>" alt="" class="heros-desc-imgparent-img" width="100%">
            </div>
            <div class="heros-desc-info">
                <h2 class="heros-desc-info-title"><?= $shop->name ?></h2>
                <p class="heros-desc-info-para"><?= $shop->description ?></p>
                <p class="heros-desc-info-para">
                    <i class="fa-solid fa-star"></i> <?= $shopRating->shop_avg_rating ?> (<?= $shopRating->total_comments ?> Avis)
                </p>
            </div>
        </div>
        <a href="" class="heros-link">
            <i class="fa-regular fa-envelope"></i>
            Contacter la boutique
        </a>
    </section>

    <div class="badge">
        <div class="badge-category">
            <a href="/boutiques/<?= $shop->id ?>" class="badge-category-btn">Tous les produits</a>
            <?php foreach ($categories as $category) { ?>
                <a href="/produits/<?= $shop->id ?>/category/<?= $category->id ?>" class="badge-category-btn"><?= $category->name ?></a>
            <?php } ?>
        </div>
    </div>

    <section class="product">
        <div class="product-desc">
            <h3 class="product-desc-title">Nos produits</h3>
            <p class="product-desc-para">Découvrez notre sélection de produits.</p>
        </div>
        <div class="product-card">
            <?php if (isset($products)) { ?>
                <?php foreach ($products as $product) { ?>
                    <div class="product-card-item">
                        <div class="product-card-item-imgContent">
                            <img src="<?= $product->product_image ?>" alt="" class="product-card-item-imgContent-img">
                        </div>
                        <div class="product-card-item-description">
                            <span class="product-card-item-description-favoris">
                                <i class="fa-regular fa-heart"></i>
                            </span>
                            <!-- <span class="product-card-item-description-promo">Promo</span> -->
                            <span class="product-card-item-description-badge"><?= $product->category_name ?></span>
                            <h4 class="product-card-item-description-title"><?= $product->product_name ?></h4>
                            <span class="product-card-item-description-avis">
                                <i class="fa-solid fa-star"></i>
                                <?= $product->avg_rating ?? "" ?> (<?= $product->nb_comments ?? "" ?>)
                            </span>
                            <p class="product-card-item-description-price"><?= $product->product_price ?> Ar/Kg</p>

                            <div class="product-card-item-description-item">

                                <a href="/boutiques/<?= $shop->id ?>/produits/<?= $product->id ?>" class="product-card-item-description-item-link product-card-item-description-item-link-detail">
                                    <!-- <i class="fa-solid fa-cart-shopping"></i> -->
                                    Voir les détails
                                </a>
                                <form
                                    action="/products/cart/add/<?= $product->id ?>"
                                    method="POST">
                                    <input type="hidden" name="redirect_cart" value="<?= $_SERVER['REQUEST_URI'] ?>">
                                    <button type="submit" class="product-card-item-description-item-link"><i class="fa-solid fa-cart-shopping"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }  ?>
            <?php } else { ?>
                <h2>Aucun produit disponible pour l'instant.</h2>
            <?php } ?>
        </div>
    </section>

</main>