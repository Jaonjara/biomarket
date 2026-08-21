<?php

/** @var array $userSellers */
/** @var  */

?>

<main>

    <section class="head">
        <div class="head-description">
            <div class="head-description-icon">
                <i class="fa-solid fa-user-group"></i>
            </div>
            <div class="head-description-child">
                <h2 class="head-description-child-title">Gestion des vendeurs</h2>
                <p class="head-description-child-para">Gérez les comptes des vendeurs du plateforme</p>
            </div>
        </div>
        <div class="head-link">
            <a href="" class="head-link-link"><span class="head-link-span">+</span> Ajouter un vendeur</a>
        </div>
    </section>

    <section class="stats">
        <div class="stats-card">
            <div class="stats-card-item">
                <div class="stats-card-item-icon stats-card-item-icon-1">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <div class="stats-card-item-table">
                    <h4 class="stats-card-item-table-title">Total vendeur</h4>
                    <p class="stats-card-item-table-para">
                        <?= $countSeller->count_sellers ?? 0 ?>
                    </p>
                </div>
            </div>
            <div class="stats-card-item">
                <div class="stats-card-item-icon stats-card-item-icon-2">
                    <i class="fa-solid fa-store"></i>
                </div>
                <div class="stats-card-item-table">
                    <h4 class="stats-card-item-table-title">Vendeurs actifs</h4>
                    <p class="stats-card-item-table-para">100</p>
                </div>
            </div>
    </section>

    <section class="user">
        <div class="user-search">
            <form action="" class="user-search-form">
                <input
                    value=""
                    type="text"
                    name="name"
                    class="user-search-form-input"
                    placeholder="Rechercher un utilisateur...">
                <button type="submit" class="user-search-form-btn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <div class="user-search-form-linkcontainer">

                    <a href="/admin/users" class="user-search-form-linkcontainer-link">Annuler</a>
                </div>
            </form>
            <div class="user-filterParent">
                <div class="user-filterParent-filter">
                    <i class="fa-solid fa-filter"></i>
                    Filtrer
                </div>
            </div>
        </div>

        <table class="user-table">
            <thead class="user-table-head">
                <tr class="user-table-head-row">
                    <th class="user-table-head-row-title">
                        <input type="checkbox" name="" id="" class="user-table-head-row-title-checkbox">
                    </th>
                    <th class="user-table-head-row-title">VENDEUR</th>
                    <th class="user-table-head-row-title">SPECIALITE</th>
                    <th class="user-table-head-row-title">BOUTIQUE</th>
                    <th class="user-table-head-row-title">PRODUITS</th>
                    <th class="user-table-head-row-title">INSCRIPTION</th>
                    <th class="user-table-head-row-title">ACTIONS</th>
                </tr>
            </thead>
            <tbody class="user-table-body">
                <?php if (isset($_SESSION["delete-seller"])) { ?>
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "<?= $_SESSION["delete-seller"] ?>",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                    <?php unset($_SESSION["delete-seller"]); ?>
                <?php } ?>
                <?php foreach ($userSellers as $userSeller) { ?>
                    <tr class="user-table-body-row">
                        <td class="user-table-body-row-data">
                            <input type="checkbox" name="" id="">
                        </td>
                        <td class="user-table-body-row-data">
                            <div class="user-table-body-row-data-child">
                                <i class="fa-regular fa-user"></i>
                                <div class="user-table-body-row-data-child-nameContent">
                                    <h4 class="user-table-body-row-data-child-nameContent-name">

                                        <?= $userSeller->name ?>
                                    </h4>
                                    <span class="user-table-body-row-data-child-nameContent-email">
                                        <?= $userSeller->email ?>
                                    </span>

                                </div>
                            </div>
                        </td>
                        <td class="user-table-body-row-data">
                            <p class="user-table-body-row-data-para user-table-body-row-data-para">Fruits & Légumes</p>
                        </td>
                        <td class="user-table-body-row-data">
                            <p class="user-table-body-row-data-para user-table-body-row-data-para">Fruity</p>
                        </td>
                        <td class="user-table-body-row-data">
                            <p class="user-table-body-row-data-para">56</p>
                        </td>
                        <td class="user-table-body-row-data">
                            <p class="user-table-body-row-data-para">
                                <?= $userSeller->createdAt ?>
                            </p>
                        </td>
                        <td class="user-table-body-row-data">
                            <div class="user-table-body-row-data-icon">

                                <form action="" class="user-table-body-row-data-form">
                                    <button class="user-table-body-row-data-form-btn user-table-body-row-data-form-btn-view">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </form>
                                <form action="/admin/sellers/<?= $userSeller->id ?>"
                                    class="user-table-body-row-data-form"
                                    method="POST"
                                    id="delete-form-<?= $userSeller->id ?>">
                                    <button
                                        type="submit"
                                        class="user-table-body-row-data-form-btn"
                                        onclick="confirmDelete(<?= $userSeller->id ?>)">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </section>
</main>