<?php

/** @var object $shops */
?>

<section class="shop">
    <div class="top">
        <div class="top-header">
            <h2 class="top-header-title">Voir les boutiques de notre plateforme</h2>
        </div>
    </div>
    <div class="shop-card">
        <?php if (isset($shops)) { ?>
            <?php foreach ($shops as $shop) { ?>
                <div class="shop-card-item">
                    <div class="shop-card-item-imgcontainer">
                        <img src="<?= $shop->photo ?>" alt="" class="shop-card-item-imgcontainer-img" width="100%" height="auto">
                    </div>
                    <div class="shop-card-item-child">
                        <h3 class="shop-card-item-child-title"><?= $shop->name ?></h3>
                        <p class="shop-card-item-child-para">
                            <i class="fa-solid fa-location-dot"></i>
                            <?= $shop->city ?>, Madagascar
                        </p>
                        <p class="shop-card-item-child-para"><?= $shop->description ?></p>
                        <span class="shop-card-item-child-span">
                            <i class="fa-solid fa-star"></i>

                            <?= $shop->shop_avg_rating ?> (<?= $shop->total_comments ?>)
                        </span>
                        <a href="/boutiques/<?= $shop->id ?>" class="shop-card-item-child-link">
                            <i class="fa-solid fa-shop"></i>
                            Voir la boutique
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            <?php }  ?>
        <?php } else { ?>
            <h3>Il n' y a pas encore de boutique.</h3>
        <?php } ?>
    </div>
</section>