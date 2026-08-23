<?php
require_once PATH . '/app/controllers/shop/shopCategory.controller.php';
require_once PATH . '/app/controllers/shop/shopProducts.controller.php';
require_once PATH . '/app/controllers/shop/shopOrder.controller.php';

function shopDashboardController()
{
    if (!isset($_SESSION['shop']->id)) {
        redirectTo('/login');
    }

    $shop_id = $_SESSION['shop']->id;
    // var_dump($_SESSION['user']);
    $title = "Dashboard";
    $total_categories = categoryCount($shop_id)->total_category;
    $totalProduct = productCount($shop_id)->total_product;
    $orderpending = orderPendingCount($shop_id)->order_count;
    require_once PATH . "/views/shop/layouts/sidebar.html.php";
    require_once PATH . "/views/shop/dashboard.html.php";
    require_once PATH . "/views/shop/layouts/footer.html.php";
}
