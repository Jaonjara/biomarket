<?php

/** @var array $items */
?>
<!-- vita payements -->
<section class="order">
    <a href="/user/profile/order" class="order-back"></a>
    <h2 class="order-title">Détails de mes commandes</h2>


    <div class="order-child">
        <table class="order-child-table">
            <thead>
                <tr class="order-child-table">
                    <th class="order-child-table-title">Image</th>
                    <th class="order-child-table-title">Produit</th>
                    <th class="order-child-table-title">Quantité</th>
                    <th class="order-child-table-title">Prix Unitaire</th>
                    <th class="order-child-table-title">Sous total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item) { ?>
                    <tr class="order-child-table-data">
                        <td class="order-child-table-data-title">
                            <img src="<?= $item->product_image ?>" alt="" class="order-child-table-data-title-img">
                        </td>
                        <td class="order-child-table-data-title">
                            <?= $item->product_name ?>
                        </td>
                        <td class="order-child-table-data-title">
                            <?= $item->quantity ?> Kg
                        </td>
                        <td class="order-child-table-data-title">
                            <?= $item->unit_price ?> Ar
                        </td>
                        <td class="order-child-table-data-title">
                            <?= $item->unit_price * $item->quantity ?> Ar
                        </td>

                        <!-- <td class="order-child-table-data-title">
                        <a href="/user/profile/order/coucou"
                            class="order-child-table-data-title-link">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                    </td> -->
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>