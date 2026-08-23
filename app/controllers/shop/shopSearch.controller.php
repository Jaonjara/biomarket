<?php
require_once PATH . '/app/models/orders/order.php';
require_once PATH . '/app/models/shop/category.php';
require_once PATH . '/app/models/shop/product.php';

function shopGlobalSearchController()
{
    if (!isset($_SESSION['shop'])) {
        redirectTo('/login');
    }

    $shop_id = $_SESSION['shop']->id;
    $searchglobal = $_GET['searchglobal'] ?? "";

    $products = [];
    $categories = [];
    $orders = [];

    // total resultat

    // recherche
    if (!empty($searchglobal)) {
        $products = searchProductByShop($shop_id, $searchglobal);
        $categories = searchCategoryByShop($shop_id, $searchglobal);
        $orders = searchOrderByShop($shop_id, $searchglobal);
    };

    $totalResult = count($products) + count($categories) + count($orders);
    $title = "Recherche";
    require_once PATH . "/views/shop/layouts/sidebar.html.php";
    require_once PATH . "/views/shop/search-global.html.php";
    require_once PATH . "/views/shop/layouts/footer.html.php";
}
