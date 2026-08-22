<?php

/** @var object $total_categories */
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

?>



<main class="dashboard">
    <section class="head">
        <div class="head-child">
            <div class="head-child-left">
                <h2 class="head-child-title">Mes catégories</h2>
                <p class="head-child-para">Gérez les catégories de vos produits pour mieux organiser votre boutique.</p>
            </div>
            <div class="head-child-right">
                <a href="/shop/category/create" class="head-child-right-link">+ Ajouter une catégorie</a>
            </div>
        </div>
        <div class="head-card">
            <div class="head-card-item">
                <div class="head-card-item-icon head-card-item-icon-3">
                    <i class="fa-solid fa-cube"></i>
                </div>
                <div class="head-card-item-stat">
                    <?php /** @var array $categories */
                    /** @var int $categoryId */
                    /** @var object $total_categories */
                    ?>
                    <p class="head-card-item-stat-title"><?= $total_categories ?></p>
                    <span class="head-card-item-stat-span">Catégories actives</span>

                    <!-- <span class="head-card-item-stat-span">Tous vos produits</span> -->
                </div>
            </div>
            <div class="head-card-item">
                <div class="head-card-item-icon head-card-item-icon-5">
                    <i class="fa-regular fa-circle-check"></i>
                </div>
                <div class="head-card-item-stat">
                    <p class="head-card-item-stat-title"><?= $total_product ?></p>
                    <span class="head-card-item-stat-span">Produits associés</span>
                    <span class="head-card-item-stat-span"></span
                        </div>
                </div>
            </div>

        </div>
    </section>

    <section class="table">
        <div class="table-list">
            <h3 class="table-list-title">
                Liste des catégories (<?= count($categories) ?>)
            </h3>
        </div>
        <div class="table-search">
            <!-- recherche -->
            <form action="/shop/category" class="table-search-form" method="GET">
                <input
                    value="<?php if (isset($_GET["searchCategory"])) {
                                echo $_GET["searchCategory"];
                            }
                            ?>"
                    type="search"
                    name="searchCategory"
                    class="table-search-form-input"
                    placeholder="Rechercher un produit...">
                <button type="submit" class="table-search-form-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <div class="table-search-form-linkcontainer">
                    <a href="/shop/category" class="table-search-form-linkcontainer-link">Annuler</a>
                </div>
            </form>
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
                <!-- alerte -->
                <?php if (isset($_SESSION["delete"])) { ?>
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "<?= $_SESSION["delete"] ?>",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                    <?php unset($_SESSION["delete"]); ?>
                <?php } ?>

                <?php foreach ($categories as $category) { ?>

                    <?php $status = categoryStatus($category->nb_product);
                    $colorclass = filterBgStatus($status);
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
    </section>
</main>