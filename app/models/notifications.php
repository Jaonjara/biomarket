<?php
require_once PATH . "/database/database.php";

function storeNotificationOrder(int $shop_id, int $order_id, string $message)
{
    $query = "INSERT INTO notifications (shop_id, order_id, message)
                    VALUES (:shop_id, :order_id, :message)";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "shop_id" => $shop_id,
        "order_id" => $order_id,
        "message" => $message
    ]);
    return true;
}

// compter notif
function countUnreadNotificationsByShop(int $shop_id)
{
    $query = "SELECT COUNT(*) AS unread_count
                    FROM notifications
                    WHERE shop_id = :shop_id
                    AND is_view = 0";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "shop_id" => $shop_id
    ]);
    return $request->fetch()->unread_count;
}

// recupere les notifications dans shop
function findNotificationsByShop(int $shop_id)
{
    $query = "SELECT * FROM notifications
                    WHERE shop_id = :shop_id
                    ORDER BY createdAt DESC";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "shop_id" => $shop_id
    ]);
    return $request->fetchAll();
}

// notifications specifique
function notificationsView(int $notification_id, int $shop_id)
{
    $query = "UPDATE notifications SET is_view = 1
                    WHERE id = :id
                    AND shop_id = :shop_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "id" => $notification_id,
        "shop_id" => $shop_id
    ]);
    return true;
}

// vue tous les notifications
function markAllNotificationsView(int $shop_id)
{
    $query = "UPDATE notifications SET is_view = 1
                    WHERE shop_id = :shop_id
                    AND is_view = 0";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "shop_id" => $shop_id
    ]);
    return true;
}
