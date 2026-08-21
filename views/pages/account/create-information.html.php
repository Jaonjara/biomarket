<section class="register">

    <form action="/user/profile/informations/create" class="register-form" method="POST" enctype="multipart/form-data">

        <div class="register-form-child">
            <div class="register-form-child-inputParent">
                <label for="" class="register-form-child-inputParent-label">Photo de profile</label>
                <input
                    name="image"
                    type="file"
                    class="register-form-child-inputParent-input">
                <?php if (isset($errors["image"])) { ?>
                    <span class="register-form-child-inputParent-span"><?= $errors["image"]; ?></span>
                <?php } ?>
            </div>
            <div class="register-form-child-inputParent">
                <label for="" class="register-form-child-inputParent-label">Numéro de téléphone</label>
                <input
                    name="phone"
                    value="<?= $_POST["phone"] ?? "" ?>"
                    type="number"
                    placeholder="Votre numéro de téléphone"
                    class="register-form-child-inputParent-input">
                <?php if (isset($errors["phone"])) { ?>
                    <span class="register-form-child-inputParent-span"><?= $errors["phone"]; ?></span>
                <?php } ?>
            </div>
            <div class="register-form-child-inputParent">
                <label for="" class="register-form-child-inputParent-label">Addresse</label>
                <input
                    name="address"
                    value="<?= $_POST["address"] ?? "" ?>"
                    placeholder="Votre addresse"
                    type="text"
                    class="register-form-child-inputParent-input">
                <?php if (isset($errors["address"])) { ?>
                    <span class="register-form-child-inputParent-span"><?= $errors["address"]; ?></span>
                <?php } ?>
            </div>
            <div class="register-form-child-inputParent">
                <label for="" class="register-form-child-inputParent-label">Votre ville</label>
                <input
                    name="city"
                    value="<?= $_POST["city"] ?? "" ?>"
                    type="text"
                    placeholder="Votre mot de passe"
                    class="register-form-child-inputParent-input">
                <?php if (isset($errors["city"])) { ?>
                    <span class="register-form-child-inputParent-span"><?= $errors["city"]; ?></span>
                <?php } ?>
            </div>

        </div>


        <button type="submit" class="register-form-btn">Ajouter mes informations &rarr;</button>

    </form>
</section>