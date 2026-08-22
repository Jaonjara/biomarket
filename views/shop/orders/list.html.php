<?php

/** @var array $orders */
/** @var string $status */
/** @var object  $order */
/** @var object  $orderpending */
/** @var object  $orderValidate */
/** @var object  $orderCancel */
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


<main class="dashboard">
    <section class="head">
        <div class="head-child">
            <div class="head-child-left">
                <h2 class="head-child-title">Mes commandes</h2>
                <p class="head-child-para">Gérez la commande de votre client.</p>
            </div>
        </div>
        <div class="head-card">
            <div class="head-card-item">
                <div class="head-card-item-icon head-card-item-icon-5">
                    <i class="fa-solid fa-list"></i>
                </div>
                <div class="head-card-item-stat">
                    <span class="head-card-item-stat-span">Total commandes</span>
                    <p class="head-card-item-stat-title"><?= $order->order_count ?? 0 ?></p>

                    <!-- <span class="head-card-item-stat-span">Tous vos produits</span> -->
                </div>
            </div>
            <div class="head-card-item">
                <div class="head-card-item-icon head-card-item-icon-3">
                    <i class="fa-regular fa-circle-check"></i>
                </div>
                <div class="head-card-item-stat">
                    <span class="head-card-item-stat-span">Valider</span>
                    <p class="head-card-item-stat-title"><?= $orderValidate->order_count ?? 0 ?></p>
                    <span class="head-card-item-stat-span"></span
                        </div>
                </div>
            </div>
            <div class="head-card-item">
                <div class="head-card-item-icon head-card-item-icon-6">
                    <i class="fa-regular fa-circle-pause"></i>
                </div>
                <div class="head-card-item-stat">
                    <span class="head-card-item-stat-span">En attente</span>
                    <p class="head-card-item-stat-title"><?= $orderpending->order_count ?? 0 ?></p>
                    <!-- <span class="head-card-item-stat-span">Rupture de stock</span> -->
                </div>
            </div>
            <div class="head-card-item">
                <div class="head-card-item-icon head-card-item-icon-7">
                    <i class="fa-solid fa-ban"></i>
                </div>
                <div class="head-card-item-stat">
                    <span class="head-card-item-stat-span">Annuler</span>
                    <p class="head-card-item-stat-title"><?= $orderCancel->order_count ?? 0 ?></p>
                    <!-- <span class="head-card-item-stat-span">Non publiés</span> -->
                </div>
            </div>
        </div>

    </section>

    <section class="table">
        <div class="table-list">
            <h3 class="table-list-title">
                Liste des commandes
            </h3>
        </div>
        <div class="table-search">
            <!-- recherche -->
            <form action="/shop/order" class="table-search-form" method="GET">
                <input
                    value="<?php if (isset($_GET["searchOrder"])) {
                                echo $_GET["searchOrder"];
                            }
                            ?>"
                    type="search"
                    name="searchOrder"
                    class="table-search-form-input"
                    placeholder="Rechercher une commande...">
                <button type="submit" class="table-search-form-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <div class="table-search-form-linkcontainer">
                    <a href="/shop/order" class="table-search-form-linkcontainer-link">Annuler</a>
                </div>
            </form>
            <div class="table-filterParent">
                <!-- <div class="table-filterParent-filter">
                    <i class="fa-solid fa-filter"></i>
                    Filtrer
                </div> -->
            </div>
        </div>

        <table class="table-table">
            <thead class="table-table-head">
                <tr class="table-table-head-row">
                    <th class="table-table-head-row-title">
                        ID du commande
                    </th>
                    <th class="table-table-head-row-title">
                        Nom du clients
                    </th>
                    <th class="table-table-head-row-title">
                        Total
                    </th>
                    <th class="table-table-head-row-title">
                        Statut
                    </th>
                    <th class="table-table-head-row-title">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="table-table-body">
                <!-- alerte -->
                <?php if (isset($_SESSION["validate"])) { ?>
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "<?= $_SESSION["validate"] ?>",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                    <?php unset($_SESSION["validate"]); ?>
                <?php } ?>

                <?php if (isset($_SESSION["cancel"])) { ?>
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "<?= $_SESSION["cancel"] ?>",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                    <?php unset($_SESSION["cancel"]); ?>
                <?php } ?>

                <?php if (!isset($orders)) { ?>
                    <h2 class="vide">Aucun commande pour l'instant.</h2>
                <?php } else { ?>
                    <?php foreach ($orders as $order) { ?>
                        <tr class="table-table-body-row-data">
                            <td class="table-table-body-row-data"> <?= $order->id ?></td>
                            <td class="table-table-body-row-data">
                                <div class="table-table-body-row-data-product">
                                    <?= $order->client_name   ?> <?= $order->client_firstname   ?>
                                </div>

                            </td>
                            <td class="table-table-body-row-data"><?= $order->total_price ?> Ar</td>
                            <td class="table-table-body-row-data">
                                <!-- 4 -->
                                <span
                                    class="table-table-body-row-data-badge table-table-body-row-data-badge-<?= filterBgStatus($order->status) ?>">
                                    <?= $order->status ?>
                                </span>
                            </td>

                            <td class="table-table-body-row-data">
                                <div class="table-table-body-row-data-icon">
                                    <?php if ($order->status == "en_attente") { ?>
                                        <form
                                            action="/shop/order/validate/<?= $order->id ?>"
                                            class="table-table-body-row-data-form"
                                            method="POST">
                                            <button type="submit" class="table-table-body-row-data-form-btn table-table-body-row-data-form-btn-edit">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                        <form
                                            action="/shop/order/cancel/<?= $order->id ?>"
                                            method="POST">

                                            <button type="submit"
                                                class="table-table-body-row-data-form-btn">
                                                <i class="fa-solid fa-ban"></i>
                                            </button>
                                        </form>
                                    <?php }  ?>
                                    <!-- detail -->
                                    <form action="" class="table-table-body-row-data-form">
                                        <a href="/shop/order/detail/<?= $order->id ?>"
                                            class="table-table-body-row-data-form-btn table-table-body-row-data-form-btn-view">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                    </form>
                                    <!-- delete -->

                                </div>

                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
    </section>
</main>