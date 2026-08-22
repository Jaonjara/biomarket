<?php
require_once PATH . '/app/models/notifications.php';

function countUnreadNotificationsByShopController()
{
    if (!isset($_SESSION['shop'])) {
        redirectTo('/login');
    }

    $shop_id = $_SESSION['shop']->id;

    $unreadCount = countUnreadNotificationsByShop($shop_id);
    return $unreadCount;
}
