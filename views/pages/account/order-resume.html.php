<?php

/** @var int $total */
?>

<!-- payer eto -->
<section class="order">
    <h2 class="order-title">Mes commandes</h2>
    <?php if (empty($products)) { ?>
        <p>Vous n'avez pas encore passé de commande.</p>
    <?php } else { ?>
        <div class="order-child">
            <table class="order-child-table">
                <thead>
                    <tr class="order-child-table">
                        <th class="order-child-table-title">Image</th>
                        <th class="order-child-table-title">Boutique</th>
                        <th class="order-child-table-title">Nom</th>
                        <th class="order-child-table-title">Quantity</th>
                        <th class="order-child-table-title">Sous total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product) { ?>
                        <tr class="order-child-table-data">
                            <td class="order-child-table-data-title">
                                <img
                                    src="<?= $product->product_image ?>" alt=""
                                    class="order-child-table-data-title-img">
                            </td>
                            <td class="order-child-table-data-title">
                                <?= $product->shop_name ?>
                            </td>
                            <td class="order-child-table-data-title">
                                <?= $product->product_name ?>
                            </td>
                            <td class="order-child-table-data-title">
                                <?= $product->quantity_in_cart ?> Kg
                            </td>
                            <td class="order-child-table-data-title">
                                <?= $product->product_price  ?> Ar
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="order-child-table-data-title-total">Total</td>
                        <td class="order-child-table-data-title">
                            <!-- <?= $product->product_price * $product->quantity_in_cart ?> -->
                            <?= $total ?> AR
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php } ?>
</section>
<!-- <section class="payement">
    <h2 class="payement-para">Les informations de livraison</h2>
    <p class="payement-para"></p>
</section> -->
<?php

/** @var boolean $infoUser */
/** @var int $shop_id */
/** @var string $shop_name */
?>

<section class="information">

    <div class="information-card">
        <h2>Les informations de livraison</h2>
        <div class="information-card-item">
            <h3 class="information-card-item-title">
                <i class="fa-solid fa-mobile-screen"></i>
                Téléphone
            </h3>
            <p class="information-card-item-para">+261 <?= $_SESSION['profile_user']->phone ?></p>
        </div>
        <div class="information-card-item">
            <h3 class="information-card-item-title">
                <i class="fa-solid fa-location-dot"></i>
                Addresse
            </h3>
            <p class="information-card-item-para"><?= $_SESSION['profile_user']->address ?> <?= $_SESSION['profile_user']->city ?></p>
        </div>
    </div>
    <form action="/user/profile/order/payements/<?= $shop_id ?>" method="POST">
        <button type="submit" class="article-recap-btn">Confirmer et payer chez <?= $shop_name ?></button>
    </form>

</section>