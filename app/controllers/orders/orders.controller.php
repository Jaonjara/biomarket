<?php
require_once PATH . '/app/models/orders/order.php';
require_once PATH . '/app/models/cart.php';
require_once PATH . '/app/models/notifications.php';


// page commande
function ordersController()
{
    if (!isset($_SESSION['user'])) {
        redirectTo('/login');
    }

    $user_id = $_SESSION['user']->id;


    // recupere tous les order user
    $orders = findAllOrdersByUserId($user_id);
    $title = "Commandes | {$_SESSION['user']->name}";
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/account/profile.html.php";
    require_once PATH . "/views/pages/account/order.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}

// page de payement
function checkoutResumeOrderController(int $shop_id)
{
    if (!isset($_SESSION['user'])) {
        redirectTo('/login');
    }
    $user_id = $_SESSION['user']->id;
    $products = findProductsInCartByShop($user_id, $shop_id);
    $shop_id = $shop_id;
    $shop_name = $products[0]->shop_name;

    // calcul total
    $total = 0;
    foreach ($products as $p) {
        $total += $p->quantity_in_cart * $p->product_price;
    }

    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/account/profile.html.php";
    require_once PATH . "/views/pages/account/order-resume.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
};

// stripe
function createStripeCheckoutController(int $shop_id)
{
    // var_dump($shop_id);
    // die;
    if (!isset($_SESSION['user'])) {
        redirectTo('/login');
    };
    $user_id = $_SESSION['user']->id;

    $products = findProductsInCartByShop($user_id, $shop_id);

    if (empty($products)) {
        redirectTo('/cart');
    };

    // prepare stripe
    $line_items = [];
    foreach ($products as $product) {
        $line_items[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $product->product_name,
                ],
                'unit_amount' => $product->product_price * 100,
            ],
            'quantity' => $product->quantity_in_cart,
        ];
    };

    try {
        $stripeConfig = require PATH . '/app/config/stripe.php';
        \Stripe\Stripe::setApiKey($stripeConfig['secret_key']);
        $basesUrl = 'http://localhost:8000';


        $checkout_session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => $basesUrl . '/user/profile/order/success?session_id={CHECKOUT_SESSION_ID}&shop_id=' . $shop_id,
            'cancel_url' => $basesUrl . '/user/profile/order/payements/' . $shop_id,
            'metadata' => [
                'user_id' => $user_id,
                'shop_id' => $shop_id
            ]
        ]);

        // redirect stripe
        header('Location: ' . $checkout_session->url);
        exit;
    } catch (Exception $e) {

        $_SESSION['error'] = 'Erreur de paiements : ' . $e->getMessage();
        redirectTo('/user/profile/order/payements/' . $shop_id);
    };
};

// webhook pour eviter les erreur du client
function stripeWebhookController()
{
    // charge la clé
    $stripeConfig = require PATH . '/app/config/stripe.php';
    \Stripe\Stripe::setApiKey($stripeConfig['secret_key']);

    // recupere le contenue de requete stripe
    $payload = @file_get_contents('php://input');
    $event = null;

    try {
        $event = \Stripe\Event::constructFrom(
            json_decode($payload, true)
        );
    } catch (\UnexpectedValueException $e) {
        // payeload invalide
        http_response_code(400);
        exit();
    }

    // event paiement reussie
    if ($event->type === 'checkout.session.completed') {

        $session = $event->data->object;
        // recupere metadata lors chechkout
        $user_id = ($session->metadata->user_id ?? 0);
        $shop_id = ($session->metadata->shop_id ?? 0);

        if ($user_id > 0 && $shop_id > 0) {
            // recupere panier et boutique
            $products = findProductsInCartByShop($user_id, $shop_id);

            if (!empty($products)) {
                // Calcul du total
                $total = 0;
                foreach ($products as $p) {
                    $total += $p->quantity_in_cart * $p->product_price;
                }

                // 1. Créer la commande
                $orderId = storeOrder([
                    "user_id" => $user_id,
                    "shop_id" => $shop_id,
                    "total_price" => $total
                ]);

                // créer Notification
                $message = "Nouvelle commande " . $orderId . " à valider";
                storeNotificationOrder($shop_id, $orderId, $message);

                //  Créer les order_items
                foreach ($products as $p) {
                    storeOrderItem(
                        $orderId,
                        $p->product_id,
                        $p->quantity_in_cart,
                        $p->product_price
                    );
                }
                // Vider le panier de cette boutique uniquement
                deleteCartProductsByShop($user_id, $shop_id);
            }
        }
    }
    // reponse à stripe
    http_response_code(200);
};


// stripe success
function stripeSuccessController()
{
    if (!isset($_SESSION['user'])) {
        redirectTo('/login');
    }

    $session_id = $_GET['session_id'] ?? null;
    $shop_id    = (int)($_GET['shop_id'] ?? 0);

    if (!$session_id || !$shop_id) {
        redirectTo('/cart');
    }

    $title = "Paiement réussi";
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/account/order-success.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}


// detail order
function showOrderController(int $id)
{
    if (!isset($_SESSION['user'])) {
        redirectTo('/login');
    }

    $order_id = $id;

    // recupere les detail produit du order
    $items = findOrderItemsByOrderId($order_id);

    $title = "Détail Commandes | {$_SESSION['user']->name}";
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/account/profile.html.php";
    require_once PATH . "/views/pages/account/order-detail.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}
