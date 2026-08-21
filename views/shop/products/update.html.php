<main>
    <?php /** @var array $categories */
    /** @var object $product */
    ?>
    <div class="headers">
        <div class="headers-child">
            <a href="/shop/products" class="headers-child-link"><i class="fa-solid fa-arrow-left"></i></a>
            <h2 class="headers-title">Modifier un produit.</h2>
        </div>
        <p class="headers-para">
            Modifiez les informations que vous voulez changer.
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

    <!-- <?php if (count($categories) > 0) { ?> -->

    <form action="/shop/products/update/<?= $product->id ?>" class="form" method="POST" enctype="multipart/form-data">

        <div class="form-info">
            <h3 class="form-info-title">Informations générales</h3>
            <div class="form-info-child">
                <label class="form-info-child-label">Catégorie <span class="form-info-child-span">*</span></label>
                <select name="category_id" id="" class="form-info-child-select">

                    <option
                        value=""
                        class="form-info-child-select-option" selected disabled>Sélectionner une catégorie</option>
                    <?php foreach ($categories as $category) { ?>
                        <option
                            value="<?= $category->id ?>">
                            <?= ($category->id == $product->category_id) ? 'selected' : '' ?>
                            <?= $category->name ?>
                        </option>
                    <?php } ?>

                </select>
                <?php if (isset($errors["category_id"])) { ?>
                    <span class="form-info-child-span"><?= $errors["category_id"] ?></span>
                <?php } ?>
            </div>
            <div class="form-info-child">
                <label class="form-info-child-label">Nom du produit <span class="form-info-child-span">*</span></label>
                <input
                    value="<?= $product->name ?? "" ?>"
                    name="name"
                    type="text"
                    class="form-info-child-input"
                    placeholder="Ex. carotte">
                <?php if (isset($errors["name"])) { ?>
                    <span class="form-info-child-span"><?= $errors["name"] ?></span>
                <?php } ?>
            </div>

            <div class="form-info-child">
                <label class="form-info-child-label">Description <span class="form-info-child-span">*</span></label>
                <textarea
                    name="description"
                    class="form-info-child-textarea"
                    placeholder="Décrivez votre produit, ses qualités, son origine"><?= $product->description ?? "" ?></textarea>
                <?php if (isset($errors["description"])) { ?>
                    <span class="form-info-child-span"><?= $errors["description"] ?></span>
                <?php } ?>
            </div>
        </div>
        <div class="form-file">
            <h3 class="form-file-title"><i class="fa-regular fa-image"></i> Image de la catégorie</h3>
            <div class="form-file-content">

                <label class="form-file-content-label">Ajouter une image</label>
                <input

                    type="file"
                    name="image"
                    class="form-file-content-input">
                <?php if (isset($errors["image"])) { ?>
                    <span class="form-info-child-span"><?= $errors["image"] ?></span>
                <?php } ?>
            </div>
        </div>

        <div class="form-info">
            <h3 class="form-info-title">Détails commerciaux</h3>
            <div class="form-info-child">
                <label class="form-info-child-label">Prix unitaire <span class="form-info-child-span">*</span></label>
                <input
                    value="<?= $product->price ?? "" ?>"
                    name="price"
                    type="number"
                    class="form-info-child-input"
                    placeholder="Ex. 4 500">
                <?php if (isset($errors["price"])) { ?>
                    <span class="form-info-child-span"><?= $errors["price"] ?></span>
                <?php } ?>
            </div>
            <div class="form-info-child">
                <label class="form-info-child-label">Quantités disponible <span class="form-info-child-span">*</span></label>
                <input
                    value="<?= $product->quantity ?? "" ?>"
                    name="quantity"
                    type="number"
                    class="form-info-child-input"
                    placeholder="Ex. 30">
                <?php if (isset($errors["quantity"])) { ?>
                    <span class="form-info-child-span"><?= $errors["quantity"] ?></span>
                <?php } ?>
            </div>
        </div>

        <div class="form-button">
            <a href="/shop/products/update/<?= $product->id ?>" class="form-button-link">
                <i class="fa-solid fa-x"></i>
                Annuler
            </a>
            <button type="submit" class="form-button-btn">
                <i class="fa-solid fa-check"></i>
                Modifier le produit
            </button>
        </div>
    </form>
<?php } else { ?>

<?php } ?>
</main>