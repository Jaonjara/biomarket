<?php

require_once PATH . "/app/controllers/shop/shopCategory.controller.php";
require_once PATH . "/app/models/shop/category.php";
require_once PATH . "/app/models/shop/product.php";
require_once PATH . "/app/models/shop/shop.php";

// page list produit
function shopProductsController()
{
    $shop_id = $_SESSION['shop']->id;

    $searchproduct = null;

    if (!isset($_SESSION['shop'])) {
        redirectTo('/login');
    }

    if (isset($_GET['searchproduct'])) {
        $searchproduct = $_GET['searchproduct'];
        $products = searchProductByShop($shop_id, $searchproduct);
    } else {
        $products = findAllProductsByShopId($shop_id);
    }

    $title = "Produit";
    $totalProduct = productCount($shop_id)->total_product;
    require_once PATH . "/views/shop/layouts/sidebar.html.php";
    require_once PATH . "/views/shop/products/list.html.php";
    require_once PATH . "/views/shop/layouts/footer.html.php";
}

// page ajouter produit
function shopCreateProductController($errors = [])
{
    if (!isset($_SESSION['shop'])) {
        redirectTo('/login');
    }

    $shop_id = $_SESSION['shop']->id;
    // $categories = findAllCategoryShop();
    $categories = findAllCategoriesByShopId($shop_id);

    // var_dump($errors);
    $title = "Nouveau produit";
    require_once PATH . "/views/shop/layouts/sidebar.html.php";
    require_once PATH . "/views/shop/products/create.html.php";
    require_once PATH . "/views/shop/layouts/footer.html.php";
}

// create product action
function shopStoreProductController()
{
    $errors = [];

    // recupere user_id
    if (!isset($_SESSION['shop'])) {
        redirectTo('/login');
    }

    $shop_id = $_SESSION['shop']->id;


    $category_id = $_POST["category_id"] ?? null;
    $name = htmlspecialchars(trim($_POST['name'])) ?? "";
    $description = htmlspecialchars(trim($_POST['description'])) ?? "";
    $price = htmlspecialchars(trim($_POST['price'])) ?? 0;
    $quantity = htmlspecialchars(trim($_POST['quantity'])) ?? 0;
    $image = $_FILES['image'];

    // recuperer category_id
    $categoriesInDb = findAllCategoriesByShopId($shop_id);

    $categories = [];

    foreach ($categoriesInDb as $c) {
        array_push($categories, $c->id);
    }



    if (empty($category_id)) {
        $errors["category_id"] = "Sélectionner un catégorie!!";
    } elseif (!in_array($category_id, $categories)) {
        $errors["category_id"] = "Le catégorie est invalide!!";
    }

    if (empty($name)) {
        $errors['name'] = "Le nom est requis";
    } elseif (strlen($name) < 2) {
        $errors['name'] = "Le nom est doit contenir au moins 2 caractères";
    }

    if (empty($description)) {
        $errors['description'] = "Le description est requis";
    } elseif (strlen($description) < 2) {
        $errors['description'] = "Le description est doit contenir au moins 2 caractères";
    }

    if (empty($price)) {
        $errors['price'] = "Le price est requis";
    } elseif (strlen($description) < 0) {
        $errors['price'] = "Le price est doit être positif";
    }

    if (empty($quantity)) {
        $errors['quantity'] = "Le quantity est requis";
    } elseif (strlen($description) < 0) {
        $errors['quantity'] = "Le quantity est doit être positif";
    }

    $extensionImageAutoriser = [
        'png',
        'jpg',
        'jpeg',
        'gift'
    ];

    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);

    $correctName = uniqid() . mt_rand(60000, 9564120) . '.' . $extension;

    $sizeImg = 2097152;

    if ($image['name'] === "") {
        $errors['image'] = "L'image est requis";
    } elseif ($image['error'] !== 0) {
        $errors['image'] = "Veuillez vérifier votre fichier";
    } elseif ($image['size'] > $sizeImg) {
        $errors['image'] = "Votre image doit être inférieur à 2Mo";
    } elseif (!in_array($extension, $extensionImageAutoriser)) {
        $errors["image"] = "Les extensions requis sont seulement (png, jpg, jpeg, gif)!";
    }

    if (!empty($errors)) {
        shopCreateProductController($errors);
        return;
    }

    $pathImage = PATH . "/public/uploads/images/products/" . $correctName;
    $fullPathimage = "/uploads/images/products/" . $correctName;

    move_uploaded_file(
        $image['tmp_name'],
        $pathImage
    );

    $data = [
        "category_id" => $category_id,
        "name" => $name,
        "description" => $description,
        "image" => $fullPathimage,
        "price" => $price,
        "quantity" => $quantity,
        "shop_id" => $shop_id
    ];

    storeProductInDatabase($data);

    $_SESSION["add_product"] = "Le produit a été ajouté avec success";

    redirectTo('/shop/products/create');
}

// remove products action
function shopRemoveProductController(int $id)
{
    // var_dump($id);
    removeProductShopById($id);
    $_SESSION["delete-product"] = "Le produit est supprimée!";
    redirectTo("/shop/products");
}

// update page
function shopPageUpdateProductController(int $id, $errors = [])
{

    if (!isset($_SESSION['shop'])) {
        redirectTo("/login");
    }

    $shop_id = $_SESSION['shop']->id;

    $product = findProductShopById($id, $shop_id);
    // $categories = findAllCategoryShop($nameCategory);
    $categories = findAllCategoriesByShopId($shop_id);
    // var_dump($product);

    $title = "Modifier produit";
    require_once PATH . "/views/shop/layouts/sidebar.html.php";
    require_once PATH . "/views/shop/products/update.html.php";
    require_once PATH . '/views/shop/layouts/footer.html.php';
}


// action update product
function shopEditProductController(int $id, $errors = [])
{
    $errors = [];

    if (!isset($_SESSION['shop'])) {
        redirectTo("/login");
    }

    $shop_id = $_SESSION['shop']->id;

    $category_id = $_POST["category_id"] ?? null;
    $name = htmlspecialchars(trim($_POST['name'])) ?? "";
    $description = htmlspecialchars(trim($_POST['description'])) ?? "";
    $price = htmlspecialchars(trim($_POST['price'])) ?? 0;
    $quantity = htmlspecialchars(trim($_POST['quantity'])) ?? 0;
    $image = $_FILES['image'];

    $categoriesInDb = findAllCategoriesByShopId($shop_id);

    $categories = [];

    foreach ($categoriesInDb as $c) {
        array_push($categories, $c->id);
    }

    if (empty($category_id)) {
        $errors["category_id"] = "Sélectionner un catégorie!!";
    } elseif (!in_array($category_id, $categories)) {
        $errors["category_id"] = "Le catégorie est invalide!!";
    }

    if (empty($name)) {
        $errors['name'] = "Le nom est requis";
    } elseif (strlen($name) < 2) {
        $errors['name'] = "Le nom est doit contenir au moins 2 caractères";
    }

    if (empty($description)) {
        $errors['description'] = "Le description est requis";
    } elseif (strlen($description) < 2) {
        $errors['description'] = "Le description est doit contenir au moins 2 caractères";
    }

    if (empty($price)) {
        $errors['price'] = "Le price est requis";
    } elseif (strlen($description) < 0) {
        $errors['price'] = "Le price est doit être positif";
    }

    if (empty($quantity)) {
        $errors['quantity'] = "Le quantity est requis";
    } elseif (strlen($description) < 0) {
        $errors['quantity'] = "Le quantity est doit être positif";
    }

    $extensionImageAutoriser = [
        'png',
        'jpg',
        'jpeg',
        'gift'
    ];

    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);

    $correctName = uniqid() . mt_rand(60000, 9564120) . '.' . $extension;

    $sizeImg = 2097152;

    if ($image['name'] === "") {
        $errors['image'] = "L'image est requis";
    } elseif ($image['error'] !== 0) {
        $errors['image'] = "Veuillez vérifier votre fichier";
    } elseif ($image['size'] > $sizeImg) {
        $errors['image'] = "Votre image doit être inférieur à 2Mo";
    } elseif (!in_array($extension, $extensionImageAutoriser)) {
        $errors["image"] = "Les extensions requis sont seulement (png, jpg, jpeg, gif)!";
    }

    if (!empty($errors)) {
        shopPageUpdateProductController($id, $errors);
        return;
    }

    $pathImage = PATH . "/public/uploads/images/products/" . $correctName;
    $fullPathimage = "/uploads/images/products/" . $correctName;

    move_uploaded_file(
        $image['tmp_name'],
        $pathImage
    );

    $data = [
        "category_id" => $category_id,
        "name" => $name,
        "description" => $description,
        "image" => $fullPathimage,
        "price" => $price,
        "quantity" => $quantity,
        "id" => $id
    ];

    shopUpdateProduct($data);
    $_SESSION["update"] = "Modifier avec succès";

    redirectTo("/shop/products/update/{$id}");
}
