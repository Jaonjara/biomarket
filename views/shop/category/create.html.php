<main>
    <div class="headers">
        <div class="headers-child">
            <a href="/shop/category" class="headers-child-link"><i class="fa-solid fa-arrow-left"></i></a>
            <h2 class="headers-title">Ajouter une catégorie</h2>
        </div>
        <p class="headers-para">
            Créer une nouvelle catégorie pour vos produits.
        </p>
    </div>
    <!-- message success -->
    <?php if (isset($_SESSION["add_category"])) { ?>
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "<?= $_SESSION["add_category"] ?>",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        <?php unset($_SESSION["add_category"]); ?>
    <?php } ?>

    <form action="/shop/category/create" class="form" method="POST" enctype="multipart/form-data">
        <div class="form-info">
            <h3 class="form-info-title">Informations générales</h3>
            <div class="form-info-child">
                <label class="form-info-child-label">Nom de la catégorie <span class="form-info-child-span">*</span></label>
                <input
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
                    name="description"
                    class="form-info-child-textarea"
                    placeholder="Décrivez brièvement cette catégorie..."></textarea>
                <?php if (isset($errors["description"])) { ?>
                    <span class="form-info-child-span"><?= $errors["description"] ?></span>
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
                Enregistrer la catégorie
            </button>
        </div>
    </form>
</main>