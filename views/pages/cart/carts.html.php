<?php

/** @var array $productsInCarts */;
// var_dump($productsInCarts);

?>
<!-- <?php
        $total_product = 0;
        $total_price = 0;

        foreach ($productsInCarts as $shopName => $products) {

            foreach ($products as $p) {
                $total_product += $p->quantity_in_cart;
                $total_price +=  ($p->product_price * $p->quantity_in_cart);
            }
        }

        ?> -->


<div class="info">
    <h2 class="info-title">Mon panier</h2>
    <p class="info-para">Vérifier vos articles et passez votre commande en toute simplicité</p>
</div>

<section class="article">
    <?php if (empty($productsInCarts)) { ?>

        <h2>Votre panier est vide pour le moment</h2>
    <?php } else { ?>

        <div class="article-shop">

            <?php foreach ($productsInCarts as $shopName => $products) { ?>

                <?php
                $shop_total_products  = 0;
                $shop_total_price = 0;
                $shop_id = $products[0]->shop_id ?? null;

                ?>
                <div class="article-child">
                    <h3 class="article-title">Nom du boutique: <?= $shopName ?></h3>
                    <table class="article-table">
                        <thead>
                            <tr class="article-table">
                                <th class="article-table-title">Produit</th>
                                <th class="article-table-title">Prix Unitaire</th>
                                <th class="article-table-title">Quantité</th>
                                <th class="article-table-title">Sous-total</th>
                                <th class="article-table-title">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $productsInCart) { ?>
                                <?php
                                $subtotal = $productsInCart->product_price * $productsInCart->quantity_in_cart;
                                $shop_total_products += $productsInCart->quantity_in_cart;
                                $shop_total_price += $subtotal;

                                ?>
                                <tr>
                                    <td class="article-table-data">
                                        <div class="article-table-data-child">
                                            <img src="<?= $productsInCart->product_image ?>" alt="" class="article-table-data-child-img">
                                            <div class="article-table-data-child-desc">
                                                <h3 class="article-table-data-child-desc-title"><?= $productsInCart->product_name ?></h3>
                                                <p class="article-table-data-child-desc-para"><?= $productsInCart->shop_name ?></p>
                                                <p class="article-table-data-child-desc-para"></p>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="article-table-data">
                                        <p class="article-table-data-para"><?= $productsInCart->product_price ?> Ar/Kg</p>
                                    </td>
                                    <td class="article-table-data">
                                        <div class="article-table-data-price">
                                            <form action="/products/cart/decrement/<?= $productsInCart->product_id ?>" method="POST">
                                                <button type="submit" class="article-table-data-price-btn">
                                                    -
                                                </button>
                                            </form>
                                            <p class="article-table-data-quantity"><?= $productsInCart->quantity_in_cart ?></p>
                                            <form action="/products/cart/add/<?= $productsInCart->product_id ?>" method="POST">
                                                <input
                                                    type="hidden"
                                                    name="redirect_cart"
                                                    value="<?= $_SERVER['REQUEST_URI'] ?>">
                                                <button type="submit" class="article-table-data-price-btn article-table-data-price-btn-sucess">
                                                    +
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                    <td class="article-table-data">
                                        <p class="article-table-data-quantity"><?= $subtotal ?> Ar</p>
                                    </td>
                                    <td class="article-table-data">
                                        <form action="/cart/delete/<?= $productsInCart->cart_id ?>" method="POST">
                                            <button type="submit" class="article-table-data-price-btn">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                    <div class="article-recap">
                        <h3 class="article-recap-title">Recapitulatif de commande</h3>
                        <p class="article-recap-para">Total produit: (<?= $shop_total_products ?>)</p>
                        <p class="article-recap-para">Prix total: <?= $shop_total_price ?> Ar</p>
                        <?php if (count($productsInCarts) > 0) { ?>
                            <!-- <form action="/order/checkout/<?= $shop_id ?>" method="POST">
                                <?= $shop_id ?>
                            <button type="submit" class="article-recap-btn">Commander chez <?= $shopName ?></button>
                            </form> -->
                            <a href="/user/profile/order/payements/<?= $shop_id ?>" class="article-recap-btn">Commander chez <?= $shopName ?></a>
                        <?php } else { ?>
                            <p>Veuillez compléter votre informations pour commander.</p>
                            <a href="/user/profile/informations/create">Completer mes informations</a>
                        <?php } ?>
                    </div>
                </div>

            <?php } ?>

        </div>
    <?php } ?>

</section>