<?php

/** @var object $order */
/** @var array $ordersItems */
?>

<?php

function filterBgStatus($status)
{
    switch ($status) {
        case "en_attente":
            return "yellow";
        case "valider":
            return "green";
        case "annuler":
            return "red";
    }
}

?>


<div class="detail">
    <a href="/shop/order" class="detail-link">
        <i class="fa-solid fa-left-long"></i>
    </a>
    <h2 class="detail-para">Détail de commande</h2>
</div>

<div class="description">
    <h4 class="description-title">Information de la commande</h4>
    <p class="description-para"><span class="description-span">Nom du client: </span><?= $order->client_name ?? '' ?> <?= $order->client_firstname ?? '' ?></p>
    <p class="description-para"><span class="description-span">Email du client: </span><?= $order->client_email ?? '' ?></p>
    <p class="description-para description-para-status">Status de la commande:
        <span
            class="table-table-body-row-data-badge table-table-body-row-data-badge-<?= filterBgStatus($order->status) ?>">
            <?= $order->status ?>
        </span>
    </p>
</div>

<section class="order">

    <div class="order-child">
        <table class="order-child-table">
            <thead>
                <tr class="order-child-table">
                    <th class="order-child-table-title">Image</th>
                    <th class="order-child-table-title">Produit</th>
                    <th class="order-child-table-title">Prix Unitaire</th>
                    <th class="order-child-table-title">Quantité</th>
                    <th class="order-child-table-title">Sous total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ordersItems as $item) { ?>
                    <tr class="order-child-table-data">
                        <td class="order-child-table-data-title">
                            <img src="<?= $item->product_image ?>" alt="" class="order-child-table-data-title-img">
                        </td>
                        <td class="order-child-table-data-title">
                            <?= $item->product_name ?>
                        </td>
                        <td class="order-child-table-data-title">
                            <?= $item->unit_price ?> Ar
                        </td>
                        <td class="order-child-table-data-title">
                            <?= $item->quantity ?> Kg
                        </td>
                        <td class="order-child-table-data-title">
                            <?= $item->unit_price * $item->quantity ?> Ar
                        </td>


                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="order-child-table-data-title-total">Total</td>
                    <td class="order-child-table-data-title">
                        <?= $order->total_price ?> Ar
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</section>