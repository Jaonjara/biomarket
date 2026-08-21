<?php
require_once PATH . "/app/controllers/admin/adminUser.controller.php";
require_once PATH . '/app/models/admin/user.php';

// page list vendeur
function adminSellersController()
{
    $nameUser = null;
    $userSellers = findUserSellerOnly();
    $countSeller = sellerCount();
    $title = "Vendeurs";
    require_once PATH . "/views/admin/layouts/sidebar.html.php";
    require_once PATH . '/views/admin/shops/list.html.php';
    require_once PATH . "/views/admin/layouts/footer.html.php";
}

// delete seller action
function removeSellerController(int $id)
{
    removeSellerById($id);
    $_SESSION["delete-seller"] = "Le vendeur a été supprimé!";
    redirectTo('/admin/sellers');
}
