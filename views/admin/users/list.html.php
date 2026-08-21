<?php

/** @var array $users */
?>

<main>

    <section class="head">
        <div class="head-description">
            <div class="head-description-icon">
                <i class="fa-solid fa-user-group"></i>
            </div>
            <div class="head-description-child">
                <h2 class="head-description-child-title">Gestion des utilisateurs</h2>
                <p class="head-description-child-para">Gérez les comptes des utilisateurs de la plateforme</p>
            </div>
        </div>
        <div class="head-link">
            <a href="/admin/users/create" class="head-link-link"><span class="head-link-span">+</span> Ajouter un utilisateur</a>
        </div>
    </section>

    <section class="stats">
        <div class="stats-card">
            <div class="stats-card-item">
                <div class="stats-card-item-icon stats-card-item-icon-1">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <div class="stats-card-item-table">
                    <h4 class="stats-card-item-table-title">Total utilisateurs</h4>
                    <p class="stats-card-item-table-para">
                        <?= $count->count_users ?? 0 ?>
                    </p>
                </div>
            </div>
            <div class="stats-card-item">
                <div class="stats-card-item-icon stats-card-item-icon-1">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <div class="stats-card-item-table">
                    <h4 class="stats-card-item-table-title">Total utilisateurs</h4>
                    <p class="stats-card-item-table-para">
                        <?= $count->count_users ?? 0 ?>
                    </p>
                </div>
            </div>
            <div class="stats-card-item">
                <div class="stats-card-item-icon stats-card-item-icon-1">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <div class="stats-card-item-table">
                    <h4 class="stats-card-item-table-title">Total utilisateurs</h4>
                    <p class="stats-card-item-table-para">
                        <?= $count->count_users ?? 0 ?>
                    </p>
                </div>
            </div>
            <div class="stats-card-item">
                <div class="stats-card-item-icon stats-card-item-icon-1">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <div class="stats-card-item-table">
                    <h4 class="stats-card-item-table-title">Total utilisateurs</h4>
                    <p class="stats-card-item-table-para">
                        <?= $count->count_users ?? 0 ?>
                    </p>
                </div>
            </div>
    </section>

    <section class="user">
        <div class="user-search">
            <form action="/admin/users" class="user-search-form" method="GET">
                <input
                    value="<?php if (isset($_GET["name"])) {
                                echo $_GET["name"];
                            }
                            ?>"
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
                    <th class="user-table-head-row-title">UTILISATEUR</th>
                    <th class="user-table-head-row-title">EMAIL</th>
                    <th class="user-table-head-row-title">ROLE</th>
                    <th class="user-table-head-row-title">INSCRIPTION</th>
                    <th class="user-table-head-row-title">ACTIONS</th>
                </tr>
            </thead>
            <tbody class="user-table-body">
                <?php if (isset($_SESSION["delete-user"])) { ?>
                    <script>
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "<?= $_SESSION["delete-user"] ?>",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                    <?php unset($_SESSION["delete-user"]); ?>
                <?php } ?>
                <?php foreach ($users as $user) { ?>
                    <tr class="user-table-body-row">
                        <td class="user-table-body-row-data">
                            <input type="checkbox" name="" id="">
                        </td>
                        <td class="user-table-body-row-data">
                            <div class="user-table-body-row-data-child">
                                <i class="fa-regular fa-user"></i>
                                <div class="user-table-body-row-data-child-nameContent">
                                    <h4 class="user-table-body-row-data-child-nameContent-name"><?= $user->name ?> <?= $user->firstname ?></h4>
                                    <p class="user-table-body-row-data-child-nameContent-email"></p>
                                </div>
                            </div>
                        </td>
                        <td class="user-table-body-row-data">
                            <p class="user-table-body-row-data-para"><?= $user->email ?></p>
                        </td>
                        <td class="user-table-body-row-data">
                            <span class="user-table-body-row-data-para user-table-body-row-data-para-badge"><?= $user->role ?></span>
                        </td>
                        <td class="user-table-body-row-data">
                            <p class="user-table-body-row-data-para"><?= $user->createdAt ?></p>
                        </td>
                        <td class="user-table-body-row-data">
                            <div class="user-table-body-row-data-icon">

                                <form action="" class="user-table-body-row-data-form">
                                    <button class="user-table-body-row-data-form-btn user-table-body-row-data-form-btn-view">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                </form>
                                <form action="/admin/users/create/<?= $user->id ?>"
                                    class="user-table-body-row-data-form"
                                    method="POST"
                                    id="delete-form-<?= $user->id ?>">
                                    <button
                                        type="submit"
                                        class="user-table-body-row-data-form-btn"
                                        onclick="confirmDelete(<?= $user->id ?>)">
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