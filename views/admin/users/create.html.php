<?php

/** @var array $userWithoutadmins */
?>

<main>
    <div class="top">
        <a href="/admin/users" class="top-link">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div class="top-desc">
            <h2 class="top-desc-title">Ajouter un utilisateur</h2>
            <p class="top-desc-para">Remplissez les informations pour créer un nouvel utilisateur</p>
        </div>
    </div>
    <?php if (isset($_SESSION["create"])) { ?>
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "<?= $_SESSION["create"] ?>",
                showConfirmButton: false,
                timer: 2000
            });
        </script>
        <?php unset($_SESSION["create"]); ?>
    <?php } ?>

    <form action="/admin/users/create" class="form" method="POST">
        <div class="form-head">
            <i class="fa fa-user"></i>
            <h3 class="form-head-title">Informations générales</h3>
        </div>

        <div class="form-info">
            <div class="form-info-desc">
                <label for="name" class="form-info-desc-label">Type de votre compte <span class="form-info-desc-span">*</span></label>
                <select name="role" id="" class="form-info-desc-select">
                    <option value="" class="form-info-desc-select-option" selected disabled>Sélectionner le type de compte</option>
                    <option value="user" class="form-info-desc-select-option">Client</option>
                    <option value="seller" class="form-info-desc-select-option">Vendeur</option>

                </select>
                <?php if (isset($errors["role"])) { ?>
                    <span class="form-info-desc-span"><?= $errors["role"]; ?></span>
                <?php } ?>
            </div>
        </div>

        <div class="form-info">
            <div class="form-info-desc">
                <label for="name" class="form-info-desc-label">Nom <span class="form-info-desc-span">*</span></label>

                <input
                    value="<?= $_POST['name'] ?? "" ?>"
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Votre nom"
                    class="form-info-desc-input">
                <?php if (isset($errors["name"])) { ?>
                    <span class="form-info-desc-span"><?= $errors["name"]; ?></span>
                <?php } ?>
            </div>
            <div class="form-info-desc">
                <label for="firstname" class="form-info-desc-label">Prénom <span class="form-info-desc-span">*</span></label>

                <input
                    value="<?= $_POST['firstname'] ?? "" ?>"
                    type="text"
                    name="firstname"
                    id="firstname"
                    placeholder="Votre prénom"
                    class="form-info-desc-input">
                <?php if (isset($errors["firstname"])) { ?>
                    <span class="form-info-desc-span"><?= $errors["firstname"]; ?></span>
                <?php } ?>

            </div>
        </div>

        <div class="form-info">
            <div class="form-info-desc">
                <label for="email" class="form-info-desc-label">Email <span class="form-info-desc-span">*</span></label>

                <input
                    value="<?= $_POST['email'] ?? "" ?>"
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Votre email"
                    class="form-info-desc-input">
                <?php if (isset($errors["email"])) { ?>
                    <span class="form-info-desc-span"><?= $errors["email"]; ?></span>
                <?php } ?>

            </div>
            <div class="form-info-desc">
                <label for="phone" class="form-info-desc-label">Téléphone <span class="form-info-desc-span">*</span></label>

                <input
                    type="number"
                    name="phone"
                    id="phone"
                    placeholder="Votre téléphone"
                    class="form-info-desc-input">

            </div>
        </div>

        <div class="form-info">
            <div class="form-info-desc">
                <label for="password" class="form-info-desc-label">Mot de passe <span class="form-info-desc-span">*</span></label>

                <input
                    value="<?= $_POST['password'] ?? "" ?>"
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Votre mot de passe"
                    class="form-info-desc-input">
                <?php if (isset($errors["password"])) { ?>
                    <span class="form-info-desc-span"><?= $errors["password"]; ?></span>
                <?php } ?>

            </div>
            <div class="form-info-desc">
                <label for="password_confirm" class="form-info-desc-label">Confirmer le mot de passe <span class="form-info-desc-span">*</span></label>

                <input
                    value="<?= $_POST['password_confirm'] ?? "" ?>"
                    type="password"
                    name="password_confirm"
                    id="password_confirm"
                    placeholder="Confirmer le mot de passe"
                    class="form-info-desc-input">
                <?php if (isset($errors["password_confirm"])) { ?>
                    <span class="form-info-desc-span"><?= $errors["password_confirm"]; ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="form-button">
            <a href="/shop/category/create" class="form-button-link">
                <i class="fa-solid fa-x"></i>
                Annuler
            </a>
            <button type="submit" class="form-button-btn">
                <i class="fa-solid fa-check"></i>
                Créer l'utilisateur
            </button>
        </div>
    </form>
</main>