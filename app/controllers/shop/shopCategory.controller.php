<?php

require_once PATH . "/app/models/shop/category.php";

// page list categ
function shopCategoryController()
{
    // $nameCategory = null;

    // if (isset($_GET["name"])) {
    //     $nameCategory = $_GET["name"];
    // }
    $shop_id = $_SESSION['shop']->id;

    $searchCategory = null;

    if (!isset($_SESSION['shop'])) {
        redirectTo('/login');
    }


    if (isset($_GET['searchCategory'])) {
        $searchCategory = $_GET['searchCategory'];
        $categories = searchCategoryByShop($shop_id, $searchCategory);
    } else {
        $categories = findAllCategoriesByShopId($shop_id);
    }

    // var_dump($_SESSION['shop']);
    // $categories = findAllCategoryShop($nameCategory);
    $total_categories = categoryCount($shop_id)->total_category;
    $total_product = countProductInCategoryByShop($shop_id)->total_product;
    $title = "Catégories";
    require_once PATH . "/views/shop/layouts/sidebar.html.php";
    require_once PATH . "/views/shop/category/list.html.php";
    require_once PATH . "/views/shop/layouts/footer.html.php";
}

// page create categ
function shopCreateCategoryController($errors = [])
{
    $title = "Nouveau catégorie";
    require_once PATH . "/views/shop/layouts/sidebar.html.php";
    require_once PATH . "/views/shop/category/create.html.php";
    require_once PATH . "/views/shop/layouts/footer.html.php";
}

// action create category
function shopStoreCategoryController()
{
    $errors = [];

    // user_id azo
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']->id;
    }

    // recuperer le id du shop correspodant @ user connecter mais encore obj
    $shopdata = findShopIdBySessionUser($user_id);

    // recupere id du shopdata pour avoir shop_id
    $shop_id = $shopdata->id;
    // var_dump($shop_id);
    // var_dump($user_id);

    $name = htmlspecialchars(trim($_POST["name"])) ?? "";
    $description = htmlspecialchars(trim($_POST["description"])) ?? "";

    if (empty($name)) {
        $errors["name"] = "Le nom est obligatoire!!";
    } elseif (strlen($name) < 2) {
        $errors["name"] = "Le nom doit contenir au moins 2 caractères!!";
    }

    if (empty($description)) {
        $errors["description"] = "La description est requis!!";
    } elseif (strlen($description) < 2) {
        $errors["description"] = "Le description doit contenir au moins 2 caractères!!";
    }

    if (!empty($errors)) {
        shopCreateCategoryController($errors);
        return;
    }

    $data = [
        "name" => $name,
        "description" => $description,
        "shop_id" => $shop_id
    ];

    shopStoreCategory($data);

    $_SESSION["add_category"] = "La catégories a été ajoutée";

    redirectTo("/shop/category/create");
}


// remove category
function shopRemoveCategoryController(int $id)
{
    removeCategoryShopById($id);
    $_SESSION["delete"] = "La catégorie est supprimée!";
    redirectTo("/shop/category");
}


// update page
function shopPageUpdateController(int $id, $errors = [])
{
    if (!isset($id)) {
        redirectTo("/shop/category");
    }

    $nameCategory = null;

    // $id = $_GET['id'];
    // $categories = findAllCategoryShop($nameCategory);
    $category = findCategoryShopById($id);
    // var_dump($errors);

    $title = "Mofifier le produit";
    require_once PATH . "/views/shop/layouts/sidebar.html.php";
    require_once PATH . "/views/shop/category/update.html.php";
    require_once PATH . '/views/shop/layouts/footer.html.php';
}

// action update
function shopEditController(int $id, $errors = [])
{
    $errors = [];

    $name = htmlspecialchars(trim($_POST["name"])) ?? "";
    $description = htmlspecialchars(trim($_POST["description"])) ?? "";

    if (empty($name)) {
        $errors["name"] = "Le nom est obligatoire!!";
    } elseif (strlen($name) < 2) {
        $errors["name"] = "Le nom doit contenir au moins 2 caractères!!";
    }

    if (empty($description)) {
        $errors["description"] = "La description est requis!!";
    } elseif (strlen($description) < 2) {
        $errors["description"] = "Le description doit contenir au moins 2 caractères!!";
    }

    if (!empty($errors)) {
        shopPageUpdateController($id, $errors);
        return;
    }

    // $id = $_GET['id'];

    $data = [
        "name" => $name,
        "description" => $description,
        "id" => $id
    ];

    updateCategory($data);
    $_SESSION["update"] = "Modifier avec succès";

    redirectTo("/shop/category/update/{$id}");
}
