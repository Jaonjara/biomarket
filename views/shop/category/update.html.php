<?php

/** @var object $category */

?>

<main>
    <div class="headers">
        <div class="headers-child">
            <a href="/shop/category" class="headers-child-link"><i class="fa-solid fa-arrow-left"></i></a>
            <h2 class="headers-title">Modifier la catégorie.</h2>
        </div>
        <p class="headers-para">
            Veuillez effectuer votre modification.
        </p>
    </div>
    <!-- message success -->
    <?php if (isset($_SESSION["update"])) { ?>
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "<?= $_SESSION["update"] ?>",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        <?php unset($_SESSION["update"]); ?>
    <?php } ?>

    <form action="/shop/category/update/<?= $category->id ?>" class="form" method="POST" enctype="multipart/form-data">
        <div class="form-info">
            <h3 class="form-info-title">Informations générales</h3>
            <div class="form-info-child">
                <label class="form-info-child-label">Nom de la catégorie <span class="form-info-child-span">*</span></label>
                <input
                    value="<?= $category->name ?? "" ?>"
                    name="name"
                    type="text"
                    class="form-info-child-input"
                    placeholder="Ex. Riz, Légumes, Fruits...">
                <?php if (isset($errors["name"])) { ?>
                    <span class="form-info-child-span"><?= $errors["name"] ?></span>
                <?php } ?>
            </div>
            <div class="form-info-child">
                <label class="form-info-child-label">Description <span class="form-info-child-span">*</span></label>
                <textarea
                    value="<?= $category->description ?? "" ?>"
                    name="description"
                    class="form-info-child-textarea"
                    placeholder="Décrivez brièvement cette catégorie..."><?= $category->name ?? "" ?></textarea>
                <?php if (isset($errors["description"])) { ?>
                    <span class="form-info-child-span"><?= $errors["description"] ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="form-file">
            <h3 class="form-file-title"><i class="fa-regular fa-image"></i> Image de la catégorie</h3>
            <div class="form-file-content">

                <label class="form-file-content-label">Ajouter une image</label>
                <input type="file" name="image" class="form-file-content-input">
            </div>
        </div>
        <div class="form-button">
            <a href="/shop/category/update" class="form-button-link">
                <i class="fa-solid fa-x"></i>
                Annuler
            </a>
            <button type="submit" class="form-button-btn">
                <i class="fa-solid fa-check"></i>
                Modifier
            </button>
        </div>
    </form>
</main>