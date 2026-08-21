<?php

/** @var array $orders */
?>

<!-- passe à la commande -->
<section class="order">
    <h2 class="order-title">Mes commandes</h2>
    <?php if (empty($orders)) { ?>
        <p>Vous n'avez pas encore passé de commande.</p>
    <?php } else { ?>
        <div class="order-child">
            <table class="order-child-table">
                <thead>
                    <tr class="order-child-table">
                        <th class="order-child-table-title">Numero de commade</th>
                        <th class="order-child-table-title">Boutique</th>
                        <th class="order-child-table-title">Prix total</th>
                        <th class="order-child-table-title">Statut</th>
                        <th class="order-child-table-title">Date</th>
                        <th class="order-child-table-title">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) { ?>
                        <tr class="order-child-table-data">
                            <td class="order-child-table-data-title">
                                <?= $order->order_id ?>
                            </td>
                            <td class="order-child-table-data-title"><?= $order->shop_name ?></td>
                            <td class="order-child-table-data-title">
                                <?= $order->total_price ?> Ar
                            </td>
                            <td class="order-child-table-data-title">
                                <?= $order->status ?>
                            </td>
                            <td class="order-child-table-data-title">
                                <?= $order->createdAt ?>
                            </td>
                            <td class="order-child-table-data-title">
                                <a href="/user/profile/order/<?= $order->order_id ?>"
                                    class="order-child-table-data-title-link">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</section>