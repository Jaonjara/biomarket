<?php

function shopDashboardController()
{
    // var_dump($_SESSION['user']);
    $title = "Dashboard";
    require_once PATH . "/views/shop/layouts/sidebar.html.php";
    require_once PATH . "/views/shop/dashboard.html.php";
    require_once PATH . "/views/shop/layouts/footer.html.php";
}
