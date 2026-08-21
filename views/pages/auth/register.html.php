<section class="register">
    <div class="register-card">
        <i class="fa-solid fa-seedling"></i>
        <h2 class="register-card-title">Créer un <span class="register-card-span">compte</span></h2>
        <p class="register-card-para">
            Rejoignez BioMarket et accéder à des produits frais et bio directements des producteurs locaux.
        </p>
    </div>
    <form action="/register" class="register-form" method="POST">

        <div class="register-form-child">
            <div class="register-form-child-info">
                <i class="fa-solid fa-user"></i>
                <h4 class="register-form-child-info-title">Informations personnelles</h4>
            </div>
            <div class="register-form-child-inputParent">
                <label for="" class="register-form-child-inputParent-label">Nom</label>
                <input
                    name="name"
                    value="<?= $_POST["name"] ?? "" ?>"
                    type="text"
                    placeholder="Votre nom"
                    class="register-form-child-inputParent-input">
                <?php if (isset($errors["name"])) { ?>
                    <span class="register-form-child-inputParent-span"><?= $errors["name"]; ?></span>
                <?php } ?>
            </div>
            <div class="register-form-child-inputParent">
                <label for="" class="register-form-child-inputParent-label">Prénom</label>
                <input
                    name="firstname"
                    value="<?= $_POST["firstname"] ?? "" ?>"
                    type="text"
                    placeholder="Votre prénom"
                    class="register-form-child-inputParent-input">
                <?php if (isset($errors["firstname"])) { ?>
                    <span class="register-form-child-inputParent-span"><?= $errors["firstname"]; ?></span>
                <?php } ?>
            </div>
            <div class="register-form-child-inputParent">
                <label for="" class="register-form-child-inputParent-label">Email</label>
                <input
                    name="email"
                    value="<?= $_POST["email"] ?? "" ?>"
                    placeholder="Votre email"
                    type="email"
                    class="register-form-child-inputParent-input">
                <?php if (isset($errors["email"])) { ?>
                    <span class="register-form-child-inputParent-span"><?= $errors["email"]; ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="register-form-child">
            <div class="register-form-child-info">
                <i class="fa-solid fa-lock"></i>
                <h4 class="register-form-child-info-title">Sécurité</h4>
            </div>
            <div class="register-form-child-inputParent">
                <label for="" class="register-form-child-inputParent-label">Mot de passe</label>
                <input
                    name="password"
                    value="<?= $_POST["password"] ?? "" ?>"
                    type="password"
                    placeholder="Votre mot de passe"
                    class="register-form-child-inputParent-input">
                <?php if (isset($errors["password"])) { ?>
                    <span class="register-form-child-inputParent-span"><?= $errors["password"]; ?></span>
                <?php } ?>
            </div>
            <div class="register-form-child-inputParent">
                <label for="" class="register-form-child-inputParent-label">Confirmer le mot de passe</label>
                <input
                    name="password_confirm"
                    value="<?= $_POST["password_confirm"] ?? "" ?>"
                    type="password"
                    placeholder="Confirmer le mot de passe"
                    class="register-form-child-inputParent-input">
                <?php if (isset($errors["password_confirm"])) { ?>
                    <span class="register-form-child-inputParent-span"><?= $errors["password_confirm"]; ?></span>
                <?php } ?>
            </div>
            <div class="register-form-check">
                <input
                    name="checkbox"
                    type="checkbox"
                    class="register-form-check-checkbox">
                <p class="register-form-check-para">J'accepte les termes et <a href="" class="register-form-check-link">conditions d'utilisations.</a></p>
            </div>
        </div>

        <button type="submit" class="register-form-btn">Créer mon compte &rarr;</button>

        <div class="register-form-login">
            <p class="register-form-login-para">Vous avez déjà un compte?</p>
            <a href="/login" class="register-form-login-link">Se connecter</a>
        </div>

    </form>
</section>