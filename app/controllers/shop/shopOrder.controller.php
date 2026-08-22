<?php
require_once PATH . '/app/models/orders/order.php';
require_once PATH . '/app/models/cart.php';
require_once PATH . '/app/models/notifications.php';

// page list order
function shopOrdersController()
{
    // verifier si user connecter
    if (!isset($_SESSION['user'])) {
        redirectTo('/login');
    }

    if (!isset($_SESSION['shop'])) {
        redirectTo('/login');
    }

    $user_id = $_SESSION['user']->id;
    $shop_id = $_SESSION['shop']->id;

    // recherche
    $searchOrder = null;
    if (isset($_GET['searchOrder'])) {
        $searchOrder = $_GET['searchOrder'];
        $orders = searchOrderByShop($shop_id, $searchOrder);
    } else {
        $orders = findOrdersByShopId($shop_id);
    }

    // page order
    $order = orderCount($shop_id);
    $orderpending = orderPendingCount($shop_id);
    $orderValidate = orderValidateCount($shop_id);
    $orderCancel = orderCancelCount($shop_id);
    markAllNotificationsView($shop_id);
    $title = "Gestion de commandes";
    require_once PATH . "/views/shop/layouts/sidebar.html.php";
    require_once PATH . "/views/shop/orders/list.html.php";
    require_once PATH . "/views/shop/layouts/footer.html.php";
}

// valider order
function validateOrderController(int $order_id)
{
    if (!isset($_SESSION['shop'])) {
        redirectTo('/login');
    }

    if (!isset($_SESSION['user'])) {
        redirectTo('/login');
    }
    // altorouter capture paramatre id dynaùiquement
    $order_id = $order_id;
    validateOrder($order_id);
    $_SESSION["validate"] = "La commande est validée";
    redirectTo('/shop/order');
}

// annuler order
function cancelOrderController(int $order_id)
{
    if (!isset($_SESSION['shop'])) {
        redirectTo('/login');
    }

    if (!isset($_SESSION['user'])) {
        redirectTo('/login');
    }
    // altorouter capture paramatre id dynaùiquement
    $order_id = $order_id;
    cancelOrder($order_id);
    $_SESSION["cancel"] = "La commande est annulée";
    redirectTo('/shop/order');
}


// page detail
function showShopOrderController(int $order_id)
{
    if (!isset($_SESSION['shop'])) {
        redirectTo('/login');
    }

    if (!isset($_SESSION['user'])) {
        redirectTo('/login');
    }

    $shop_id = $_SESSION['shop']->id;

    // recupere info de commande
    $order = findOrderByIdAndShop($order_id, $shop_id);
    // var_dump($order);
    // pas de order
    // if (!$order) {
    //     redirectTo('/shop/order');
    // }

    $ordersItems = findOrderItemsByOrderId($order_id);

    $title = "Détail commande {$order_id}";
    require_once PATH . "/views/shop/layouts/sidebar.html.php";
    require_once PATH . "/views/shop/orders/detail.html.php";
    require_once PATH . "/views/shop/layouts/footer.html.php";
}
