<?php
require_once PATH . "/database/database.php";

// creer commande
function storeOrder(array $data)
{
    $db = connectToDatabase();
    $query = "INSERT INTO orders (user_id, shop_id, total_price) VALUES
                    (:user_id, :shop_id, :total_price)";
    $request = $db->prepare($query);
    $request->execute([
        "user_id" => $data['user_id'],
        "shop_id" => $data['shop_id'],
        "total_price" => $data['total_price'],
    ]);
    // return true;
    return $db->lastInsertId();
}

// creer order_item
function storeOrderItem(int $orderId, int $productId, int $quantity, int $unitPrice)
{
    $db = connectToDatabase();
    $query = "INSERT INTO order_items (order_id, product_id, quantity, unit_price) VALUES
                    (:order_id, :product_id, :quantity, :unit_price)";
    $request = $db->prepare($query);
    $request->execute([
        "order_id" => $orderId,
        "product_id" => $productId,
        "quantity" => $quantity,
        "unit_price" => $unitPrice
    ]);
    // return true;
    return $db->lastInsertId();
}


// supprimer du panier les produit de shop
function deleteCartProductsByShop(int $user_id, int $shop_id)
{
    $query = "DELETE carts FROM carts
                    INNER JOIN products ON carts.product_id = products.id
                    WHERE carts.user_id = :user_id
                    AND products.shop_id = :shop_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "user_id" => $user_id,
        "shop_id" => $shop_id
    ]);
}

// recuperer tous les order de user
function findAllOrdersByUserId(int $user_id)
{
    $query = "SELECT orders.id AS order_id,
                    orders.total_price,
                    orders.status, 
                    orders.createdAt,
                    shops.name AS shop_name
                FROM orders 
                INNER JOIN shops ON orders.shop_id = shops.id
                WHERE orders.user_id = :user_id
                ORDER BY orders.createdAt DESC";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "user_id" => $user_id
    ]);
    return $request->fetchAll();
}

// recuperer les details de articles items
function findOrderItemsByOrderId(int $order_id)
{
    $query = "SELECT order_items.quantity,
                    order_items.unit_price,
                    products.name AS product_name,
                    products.image AS product_image
                    FROM order_items
                    LEFT JOIN products ON order_items.product_id = products.id
                    WHERE order_items.order_id = :order_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "order_id" => $order_id
    ]);
    return $request->fetchAll();
}
