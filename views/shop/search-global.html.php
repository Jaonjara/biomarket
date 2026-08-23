<?php






// order
function filterBgStatus($status)
{
    switch ($status) {
        case "stock faible":
            return "yellow";
        case "disponible":
            return "green";
        case "rupture":
            return "red";
    }
}

// category
function categoryStatus(int $nb_product)
{
    if ($nb_product == 0) {
        return "rupture";
    } elseif ($nb_product <= 5) {
        return "stock faible";
    } else {
        return "disponible";
    }
}

function filterBgStatusCategory($status)
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

// products
function filterBgStatusProduct($status)
{
    switch ($status) {
        case "stock faible":
            return "yellow";
        case "disponible":
            return "green";
        case "rupture":
            return "red";
    }
}
function productStatus(int $totalProduct)
{
    /** @var array $products */
    if ($totalProduct == 0) {
        return "rupture";
    } elseif ($totalProduct <= 5) {
        return "stock faible";
    } else {
        return "disponible";
    }
}

?>


<section class="search">

    <?php
    /** @var int $totalResult */
    if ($totalResult === 0) { ?>
        <div>
            <h2>Aucun résultat pour la recherche</h2>
        </div>
    <?php } else { ?>

        <?php if (!empty($products)) { ?>
            <!-- produit -->
            <div class="head-child-left">
                <h2 class="head-child-title">Mes produits</h2>
            </div>
            <table class="table-table">
                <thead class="table-table-head">
                    <tr class="table-table-head-row">
                        <th class="table-table-head-row-title">
                            Image
                        </th>
                        <th class="table-table-head-row-title">
                            Produit
                        </th>
                        <th class="table-table-head-row-title">
                            Catégorie
                        </th>
                        <th class="table-table-head-row-title">
                            Prix
                        </th>
                        <th class="table-table-head-row-title">
                            Quantité
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

                    <?php
                    /** @var array $products */
                    foreach ($products as $product) { ?>

                        <?php $status = productStatus($product->quantity);
                        $colorclass = filterBgStatusProduct($status);
                        ?>
                        <tr class="table-table-body-row-data">
                            <td class="table-table-body-row-data">
                                <div class="table-table-body-row-data-image">
                                    <img src="<?= $product->image ?>" alt="" height="80px" width="100%">
                                </div>
                            </td>
                            <td class="table-table-body-row-data">
                                <div class="table-table-body-row-data-product">
                                    <?= $product->name ?>
                                </div>

                            </td>
                            <td class="table-table-body-row-data">
                                <?= $product->category_name ?>
                            </td>
                            <!-- <td class="table-table-body-row-data">
                            <?= $product->description ?>
                        </td> -->
                            <td class="table-table-body-row-data">
                                <?= $product->price ?>Ar / Kg
                            </td>
                            <td class="table-table-body-row-data">
                                <?= $product->quantity ?> Kg
                            </td>
                            <!-- <td class="table-table-body-row-data">Disponible</td> -->
                            <td class="table-table-body-row-data">

                                <span
                                    class="table-table-body-row-data-badge
                                table-table-body-row-data-badge-<?= $colorclass ?>"><?= $status ?>
                                </span>
                            </td>
                            <td class="table-table-body-row-data">

                                <div class="table-table-body-row-data-icon">
                                    <!-- detail -->
                                    <!-- <form action="" class="table-table-body-row-data-form">
                                    <button class="table-table-body-row-data-form-btn table-table-body-row-data-form-btn-view">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </form> -->
                                    <!-- delete -->
                                    <form
                                        action="/shop/products/remove/<?= $product->id ?>"
                                        method="POST"
                                        id="delete-form-<?= $product->id ?>">

                                        <button
                                            type="button"
                                            class="table-table-body-row-data-form-btn"
                                            onclick="confirmDelete(<?= $product->id ?>)">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                    <!-- edit -->
                                    <form action="" class="table-table-body-row-data-form">

                                        <a href="/shop/products/update/<?= $product->id ?>"
                                            class="table-table-body-row-data-form-btn table-table-body-row-data-form-btn-edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>

        <!-- Category -->
        <?php if (!empty($categories)) { ?>
            <div class="head-child-left">
                <h2 class="head-child-title">Mes categories</h2>
            </div>
            <table class="table-table">
                <thead class="table-table-head">
                    <tr class="table-table-head-row">
                        <th class="table-table-head-row-title">
                            Nom de la catégorie
                        </th>
                        <th class="table-table-head-row-title">
                            Description
                        </th>
                        <th class="table-table-head-row-title">
                            Nombre de produits
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
                    <?php
                    /** @var array $categories */
                    foreach ($categories as $category) { ?>

                        <?php $status = categoryStatus($category->nb_product);
                        $colorclass = filterBgStatusCategory($status);
                        ?>

                        <tr class="table-table-body-row-data">
                            <td class="table-table-body-row-data">
                                <?= $category->description ?>
                            </td>
                            <td class="table-table-body-row-data">
                                <div class="table-table-body-row-data-product">
                                    <?= $category->name ?>
                                </div>

                            </td>
                            <td class="table-table-body-row-data">
                                <!-- 4 -->
                                <?= $category->nb_product ?>
                            </td>
                            <td class="table-table-body-row-data">

                                <span
                                    class="table-table-body-row-data-badge
                            table-table-body-row-data-badge-<?= $colorclass ?>"><?= $status ?></span>
                            </td>
                            <td class="table-table-body-row-data">
                                <div class="table-table-body-row-data-icon">
                                    <!-- detail -->
                                    <!-- <form action="" class="table-table-body-row-data-form">
                                    <button class="table-table-body-row-data-form-btn table-table-body-row-data-form-btn-view">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </form> -->
                                    <!-- delete -->
                                    <form
                                        action="/shop/category/remove/<?= $category->id ?>"
                                        method="POST"
                                        id="delete-form-<?= $category->id ?>">

                                        <button
                                            type="button"
                                            class="table-table-body-row-data-form-btn"
                                            onclick="confirmDelete(<?= $category->id ?>)">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                    <!-- edit -->
                                    <form action="" class="table-table-body-row-data-form">
                                        <a href="/shop/category/update/<?= $category->id ?>" class="table-table-body-row-data-form-btn table-table-body-row-data-form-btn-edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>

        <!-- order -->
        <?php if (!empty($orders)) { ?>
            <div class="head-child-left">
                <h2 class="head-child-title">Mes commandes</h2>
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

                    <?php
                    /** @var array $orders */
                    foreach ($orders as $order) { ?>
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
                                    class="table-table-body-row-data-badge 
                                    table-table-body-row-data-badge-<?= filterBgStatus($order->status) ?>">
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
                </tbody>
            </table>
        <?php } ?>

    <?php } ?>
</section>