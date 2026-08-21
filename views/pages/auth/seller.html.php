<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BioMarket</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    <link rel="shortcut icon" href="/assets/images/logo/icon.png" type="image/x-icon">
</head>

<body>
    <!-- <div class="back">
        <a href="" class="back-link">
            <i class="fa-solid fa-arrow-left-long"></i>
        </a>
    </div> -->
    <section class="container">
        <form
            action="/seller"
            class="container-form"
            method="POST"
            enctype="multipart/form-data">
            <div class="container-form-head">
                <h2 class="container-form-head-title">Devenez vendeur chez <span class="container-form-head-span">Bio</span>Market</h2>
                <p class="container-form-head-para">
                    Créez votre boutique et commencez à vendre vos produits sur la plateforme
                </p>
            </div>
            <div class="container-form-info">
                <div class="container-form-info-desc">
                    <h3 class="container-form-info-desc-title">Information de votre boutique</h3>
                    <p class="container-form-info-desc-title">Renseignez les informations qui présenteront votre activité sur le site.</p>
                </div>
                <!-- nom et phone -->
                <div class="container-form-info-child">
                    <div class="container-form-info-child-content">
                        <label
                            for=""
                            class="container-form-info-child-content-label">Nom de votre boutique <span class="container-form-info-child-content-span">*</span></label>
                        <input
                            value="<?= $_POST["name"] ?? "" ?>"
                            type="text"
                            name="name"
                            id=""
                            class="container-form-info-child-content-input"
                            placeholder="Nom de la boutique">
                        <?php if (isset($errors["name"])) { ?>
                            <span class="container-form-info-child-content-span"><?= $errors["name"] ?></span>
                        <?php } ?>
                    </div>
                    <div class="container-form-info-child-content">
                        <label
                            for=""
                            class="container-form-info-child-content-label">Numéro de télephone <span class="container-form-info-child-content-span">*</span></label>
                        <input
                            value="<?= $_POST["phone"] ?? "" ?>"
                            type="number"
                            name="phone"
                            id=""
                            class="container-form-info-child-content-input"
                            placeholder="Coordonnés téléphoniques">
                        <?php if (isset($errors["phone"])) { ?>
                            <span class="container-form-info-child-content-span"><?= $errors["phone"] ?></span>
                        <?php } ?>
                    </div>
                </div>
                <!-- ville et adresse -->
                <div class="container-form-info-child">
                    <div class="container-form-info-child-content">
                        <label
                            for=""
                            class="container-form-info-child-content-label">Votre ville <span class="container-form-info-child-content-span">*</span></label>
                        <input
                            value="<?= $_POST["city"] ?? "" ?>"
                            type="text"
                            name="city"
                            id=""
                            class="container-form-info-child-content-input"
                            placeholder="Ville">
                        <?php if (isset($errors["city"])) { ?>
                            <span class="container-form-info-child-content-span"><?= $errors["city"] ?></span>
                        <?php } ?>
                    </div>
                    <div class="container-form-info-child-content">
                        <label
                            for=""
                            class="container-form-info-child-content-label">Adresse <span class="container-form-info-child-content-span">*</span></label>
                        <input
                            value="<?= $_POST["address"] ?? "" ?>"
                            type="text"
                            name="address"
                            id=""
                            class="container-form-info-child-content-input"
                            placeholder="L'adresse">
                        <?php if (isset($errors["address"])) { ?>
                            <span class="container-form-info-child-content-span"><?= $errors["address"] ?></span>
                        <?php } ?>
                    </div>
                </div>
                <!-- description -->
                <div class="container-form-info-child container-form-info-child-textaracontent">

                    <label
                        for=""
                        class="container-form-info-child-content-label">Bio / Description <span class="container-form-info-child-content-span">*</span></label>
                    <textarea

                        name="description"
                        id=""
                        class="container-form-info-child-textaracontent-textarea"
                        placeholder="Décrire votre boutique"><?= $_POST["description"] ?? "" ?></textarea>
                    <?php if (isset($errors["description"])) { ?>
                        <span class="container-form-info-child-content-span"><?= $errors["description"] ?></span>
                    <?php } ?>
                </div>


                <!-- pdp -->
                <div class="container-form-info-child">
                    <div class="container-form-info-child-content">
                        <label
                            for=""
                            class="container-form-info-child-content-label">Votre logo <span class="container-form-info-child-content-span">*</span></label>
                        <input
                            value="<?= $_POST["photo"] ?? "" ?>"
                            type="file"
                            name="photo"
                            id=""
                            class="container-form-info-child-content-input">
                        <?php if (isset($errors["photo"])) { ?>
                            <span class="container-form-info-child-content-span"><?= $errors["photo"] ?></span>
                        <?php } ?>

                    </div>
                </div>
            </div>

            <div class="container-form-button">
                <button type="submit" class="container-form-button-btn">
                    Créer ma boutique
                </button>
            </div>
            <div class="back">
                <a href="/" class="back-link">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    retour
                </a>
            </div>
        </form>
    </section>

</body>

</html>