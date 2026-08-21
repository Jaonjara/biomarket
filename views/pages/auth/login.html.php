<section class="register">
    <div class="register-card">
        <i class="fa-solid fa-seedling"></i>
        <h2 class="register-card-title">Connexion à votre <span class="register-card-span">compte</span></h2>
        <p class="register-card-para">
            Bienvenue! Connectez-vous pour effectuer vos achats et se faire livrer à domicile.
        </p>
    </div>
    <form action="/login" class="register-form" method="POST">

        <div class="register-form-child">
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
        </div>

        <button type="submit" class="register-form-btn">Se connecter &rarr;</button>

        <div class="register-form-login">
            <p class="register-form-login-para">Vous n'avez pas de compte?</p>
            <a href="/login" class="register-form-login-link">Créer compte</a>
        </div>

    </form>
</section>