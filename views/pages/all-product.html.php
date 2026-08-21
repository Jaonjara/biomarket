<?php

/** @var array $products */
/** @var array $categories */
?>

<section class="badges">
    <a href="/produits" class="badges-item">
        <p class="badges-item-para">Tous les produits</p>
    </a>
    <?php foreach ($categories as $category) { ?>
        <a href="/categories/<?= $category->category_id ?>" class="badges-item">
            <?= $category->category_name ?>
        </a>
    <?php } ?>

</section>
<section class="product">
    <div class="product-desc">
        <?php  ?>
        <h3 class="product-desc-title">Nos produits</h3>
        <p class="product-desc-para">Découvrez notre sélection de produits.</p>
        <?php  ?>
    </div>
    <!-- <div class="search"> -->
    <form action="" class="form" method="GET">
        <input
            placeholder="Recherche un produit"
            type="search"
            name="searchproduct"
            value="<?php if (isset($_GET['searchproduct'])) {
                        echo $_GET['searchproduct'];
                    } ?>"
            class="form-input">
        <button type="submit" class="form-btn">
            <i class="fa-brands fa-sistrix"></i>
        </button>
        <a href="/produits" class="form-link">Annuler</a>

    </form>
    <!-- </div> -->
    <div class="product-card">
        <?php if (!empty($products)) { ?>
            <?php foreach ($products as $product) { ?>
                <div class="product-card-item">
                    <div class="product-card-item-imgContent">
                        <img src="<?= $product->product_image ?? "" ?>" alt="" class="product-card-item-imgContent-img">
                    </div>
                    <div class="product-card-item-description">
                        <span class="product-card-item-description-favoris">
                            <i class="fa-regular fa-heart"></i>
                        </span>
                        <!-- <span class="product-card-item-description-promo">Promo</span> -->
                        <span class="product-card-item-description-badge"><?= $product->category_name ?? "" ?></span>
                        <h4 class="product-card-item-description-title"><?= $product->product_name ?? "" ?></h4>
                        <span class="product-card-item-description-avis">
                            <i class="fa-solid fa-star"></i>
                            <?= $product->avg_rating ?? "" ?> (<?= $product->nb_comments ?? "" ?>)
                        </span>
                        <p class="product-card-item-description-price"><?= $product->product_price ?? "" ?> Ar/Kg</p>

                        <div class="product-card-item-description-item">

                            <a href="/produits/<?= $product->product_id ?>" class="product-card-item-description-item-link product-card-item-description-item-link-detail">
                                <!-- <i class="fa-solid fa-cart-shopping"></i> -->
                                Voir les détails

                            </a>
                            <form action="/products/cart/add/<?= $product->product_id ?>" method="POST">
                                <input
                                    type="hidden"
                                    name="redirect_cart"
                                    value="<?= $_SERVER['REQUEST_URI'] ?>">
                                <button type="submit" class="product-card-item-description-item-link">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </button>
                                <!-- Ajouter au panier -->
                            </form>
                        </div>
                    </div>
                </div>
            <?php }  ?>
        <?php } else { ?>
            <div class="empty">
                <p class="empty-para">Aucun produit ne correspond à votre recherche.</p>
            </div>
        <?php } ?>
    </div>