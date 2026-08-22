<?php
require_once PATH . "/app/models/notifications.php";

function readNotificationController(int $notification_id, int $shop_id)
{
    if (!isset($_SESSION['shop'])) {
        redirectTo('/login');
    }

    $shop_id = $_SESSION['shop']->id;

    notificationsView($notification_id, $shop_id);
    redirectTo("/shop/order/detail/{$shop_id}");
}
