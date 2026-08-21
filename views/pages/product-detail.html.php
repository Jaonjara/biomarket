<?php

/** @var object $product */
/** @var array $categories */
/** @var array $comments */
?>


<div class="details">
    <p class="details-para">Detail du produit</p>
</div>

<section class="desc">
    <div class="desc-img">
        <img src="<?= $product->product_image ?>" alt="" class="desc-img" width="100%">
    </div>
    <div class="desc-info">
        <div class="desc-info-top">

            <h3 class="desc-info-top-category"><?= $product->category_name ?></h3>
            <h2 class="desc-info-top-name"><?= $product->product_name ?></h2>
        </div>

        <h2 class="desc-info-shop"><?= $product->shop_name ?></h2>
        <p class="desc-info-description"><?= $product->product_description ?></p>
        <!-- <form action="" method="POST" class="desc-info-form">
            <button type="submit" class="desc-info-form-btn">Ajouter</button>
        </form> -->
        <form action="/products/cart/add/<?= $product->product_id ?>" method="POST">
            <input
                type="hidden"
                name="redirect_cart"
                value="<?= $_SERVER['REQUEST_URI'] ?>">
            <button type="submit" class="article-table-data-price-btn article-table-data-price-btn-sucess">
                Ajouter au panier
            </button>
        </form>

    </div>
</section>
<section class="comments">
    <h3>Commentaires et notes</h3>
    <?php if (isset($_SESSION['user'])) { ?>
        <form action="/products/comment/<?= $product->product_id ?>" method="POST" class="comments-form">
            <div class="comments-form-rating">
                <h4 class="comments-form-rating-para">Votre notes :</h4>
                <!-- <input
                    type="hidden"
                    name="product_id"> -->
                <input
                    type="hidden"
                    name="redirect_url"
                    value="<?= $_SERVER['REQUEST_URI'] ?>">
                <div class="comments-form-rating-child">
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
                        action="/products/<?= $product->product_id ?>/comment/delete/<?= $comment->comments_id ?>"
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