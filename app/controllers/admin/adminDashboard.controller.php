<?php

function adminDashboardController()
{
    $countSeller = sellerCount();
    $count = usersCount();
    $title = "Admin";
    require_once PATH . "/views/admin/layouts/sidebar.html.php";
    require_once PATH . "/views/admin/dashboard.html.php";
    require_once PATH . "/views/admin/layouts/footer.html.php";
}
