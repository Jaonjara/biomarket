<?php

/** @var object $productsByShop */
/** @var object $shopProduct */
/** @var object $shop */
/** @var object $comments */
?>
<!-- <div class="retour">
    <a href="/boutiques/<?= $shop->id ?>" class="retour-link">
        <i class="fa-solid fa-arrow-left-long"></i>
        retour
    </a>
</div> -->
<section class="detail">
    <div class="detail-img">
        <img src="<?= $productsByShop->product_image ?>" alt="" class="detail-img-img">
    </div>
    <div class="detail-description">
        <div class="detail-description-info">

            <h4 class="detail-description-info-category"><?= $productsByShop->category_name ?></h4>
            <h2 class="detail-description-info-title">Boutique: <?= $shop->name ?></h2>
            <div class="detail-description-info-child">
                <h3 class="detail-description-info-child-title">Description :</h3>
                <p class="detail-description-info-child-para"><?= $productsByShop->product_description ?></p>
            </div>
            <p class="detail-description-info-para">Prix: <?= $productsByShop->product_price ?> Ar/Kg</p>
            <p class="detail-description-info-para">Quantité: <?= $productsByShop->product_quantity ?> Kg</p>
        </div>
        <!-- <div class="detail-description-link">
            <a href="/products/cart/add/<?= $productsByShop->id ?>" class="detail-description-link-link">Ajouter au panier</a>
        </div> -->
        <form
            action="/products/cart/add/<?= $productsByShop->id ?>"
            method="POST">
            <input type="hidden" name="redirect_cart" value="<?= $_SERVER['REQUEST_URI'] ?>">
            <button type="submit" class="product-card-item-description-item-link"><i class="fa-solid fa-cart-shopping"></i></button>
        </form>
    </div>
</section>
<section class="comments">
    <h3>Commentaires et notes</h3>
    <?php if (isset($_SESSION['user'])) { ?>
        <form action="/products/comment/<?= $productsByShop->id ?>" method="POST" class="comments-form">
            <div class="comments-form-rating">
                <h4 class="comments-form-rating-para">Votre notes :</h4>
                <div class="comments-form-rating-child">
                    <input
                        type="hidden"
                        name="redirect_url"
                        value="<?= $_SERVER['REQUEST_URI'] ?>">
                    <input
                        class="comments-form-rating-child-input"
                        type="radio"
                        name="rating" id="star5"
                        value="5">
                    <label for="star5" class="comments-form-rating-child-label"><i class="fa fa-star"></i></label>
                    <input
                        class="comments-form-rating-child-input"
                        type="radio"
                        name="rating" id="star4"
                        value="4">
                    <label for="star4" class="comments-form-rating-child-label"><i class="fa fa-star"></i></label>
                    <input
                        class="comments-form-rating-child-input"
                        type="radio"
                        name="rating" id="star3"
                        value="3">
                    <label for="star3" class="comments-form-rating-child-label"><i class="fa fa-star"></i></label>
                    <input
                        class="comments-form-rating-child-input"
                        type="radio"
                        name="rating" id="star2"
                        value="2">
                    <label for="star2" class="comments-form-rating-child-label"><i class="fa fa-star"></i></label>
                    <input
                        class="comments-form-rating-child-input"
                        type="radio"
                        name="rating" id="star1"
                        value="1">
                    <label for="star1" class="comments-form-rating-child-label"><i class="fa fa-star"></i></label>
                </div>
            </div>

            <div class="comments-form-texta">

                <textarea name="contents" placeholder="Votre commentaire..."
                    class="comments-form-texta-textarea"></textarea>

                <?php if (isset($errors['contents'])) { ?>
                    <span class="comments-form-texta-span"><?= $errors['contents'] ?></span>
                <?php } ?>
            </div>

            <div class="comments-form-btncontent">
                <button type="submit" class="comments-form-btncontent-btn">Noter/Commenter</button>
            </div>
        </form>
    <?php } else { ?>
        <div class="comments-child">
            <h3>Veuillez vous connectez pour pouvoir commenter</h3>
            <a href="/login" class="comments-child-link">Se connecter ici.</a>
        </div>
    <?php } ?>
    <div class="comments-container">
        <?php foreach ($comments as $comment) { ?>
            <div class="comments-container-profil">
                <h4 class="comments-container-profil-title"><?= $comment->user_name ?></h4>
                <div class="comments-container-profil-para">
                    <p><?= $comment->contents ?></p>
                </div>
                <?php if (isset($_SESSION['user']->id) && $comment->user_id === $_SESSION['user']->id) { ?>
                    <form
                        action="/products/<?= $productsByShop->id ?>/comment/delete/<?= $comment->comments_id ?>"
                        method="POST"
                        class="comments-container-form">
                        <button type="submit" class="comments-container-form-btn">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>