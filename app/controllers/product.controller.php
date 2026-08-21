<?php

require_once PATH . "/app/models/product.php";

// page tous les produits
function listAllProducts()
{
    $searchproduct = null;

    if (isset($_GET['searchproduct'])) {
        $searchproduct = $_GET['searchproduct'];
        $products = searchProduct($searchproduct);
    } else {

        $products = findAllProducts();
    }
    $categories = findAllCategories();

    // $comments = findAllCommentsByProductId($id);
    $title = "Produits";
    require_once PATH . '/views/layouts/header.html.php';
    require_once PATH . "/views/pages/all-product.html.php";
    require_once PATH . '/views/layouts/footer.html.php';
}

// filtre par categories page liste produit
function filterByCategory(int $category_id)
{
    if ($category_id > 0) {
        // filtrage par category
        $products = findAllProductsByCategoryId($category_id);
    } else {
        // pas de filtre
        $products = findAllProducts();
    }
    $categories = findAllCategories();
    $title = "Produits";
    // var_dump($products[0]);
    // die;


    require_once PATH . '/views/layouts/header.html.php';
    require_once PATH . "/views/pages/all-product.html.php";
    require_once PATH . '/views/layouts/footer.html.php';
}

// detail product via liste produit
function showProductController(int $id, $errors = [])
{

    $product = findProductById($id);
    $categories = findAllCategories();

    if ($product === false) {
        redirectTo("/produits");
    }

    $comments = findAllCommentsByProductId($id);

    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/product-detail.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}
