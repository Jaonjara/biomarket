<?php
require_once PATH . '/app/models/orders/order.php';
require_once PATH . '/app/models/cart.php';


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

    try {
        // Récupérer la session Stripe
        $session = \Stripe\Checkout\Session::retrieve($session_id);

        // Vérifier que le paiement est bien payé
        if ($session->payment_status !== 'paid') {
            $_SESSION['error'] = 'Le paiement n\'a pas été validé.';
            redirectTo('/cart');
        }

        $user_id = $_SESSION['user']->id;

        // Sécurité : vérifier que c’est le bon utilisateur
        if ((int)$session->metadata->user_id !== $user_id) {
            redirectTo('/cart');
        }

        // Récupérer les produits encore dans le panier de cette boutique
        $products = findProductsInCartByShop($user_id, $shop_id);

        if (empty($products)) {
            // Déjà traité
            redirectTo('/user/profile/order');
        }

        // Calcul du total
        $total = 0;
        foreach ($products as $p) {
            $total += $p->quantity_in_cart * $p->product_price;
        }

        // 1. Créer la commande
        $orderId = storeOrder([$user_id, $shop_id, $total]);

        // 2. Créer les order_items
        foreach ($products as $p) {
            storeOrderItem(
                $orderId,
                $p->product_id,
                $p->quantity_in_cart,
                $p->product_price
            );
        }

        // 3. Vider le panier de cette boutique uniquement
        deleteCartProductsByShop($user_id, $shop_id);

        // 4. Afficher la page de succès
        $title = "Paiement réussi";
        require_once PATH . "/views/layouts/header.html.php";
        require_once PATH . "/views/pages/account/order-success.html.php";
        require_once PATH . "/views/layouts/footer.html.php";
    } catch (Exception $e) {
        $_SESSION['error'] = 'Erreur : ' . $e->getMessage();
        redirectTo('/cart');
    }
}




// action payer
// function checkoutController(int $shop_id)
// {
//     if (!isset($_SESSION['user'])) {
//         redirectTo('/login');
//     }

//     $user_id = $_SESSION['user']->id;
//     // recuperer produitdans panier
//     $rawProducts = findAllProductInCart($user_id);


//     // filter les produits du boutique uniquement
//     $shopProducts = [];
//     foreach ($rawProducts as $product) {
//         if ($product->shop_id == $shop_id) {
//             $shopProducts[] = $product;
//         }
//     }

//     //calcul total shop selectionner
//     $totalprice = 0;
//     foreach ($rawProducts as $product) {
//         if ($product->shop_id == $shop_id) {
//             $subtotal = $product->product_price * $product->quantity_in_cart;
//             $totalprice += $subtotal;
//         }
//     }

//     $data = [
//         "user_id" => $user_id,
//         "shop_id" => $shop_id,
//         "total_price" => $totalprice
//     ];


//     $order_id = storeOrder($data);

//     // verifie si items appartiint a shop
//     // foreach($item->shop_id == $shop_id)

//     // enregister chaque produit dans order_items
//     foreach ($rawProducts as $product) {
//         if ($product->shop_id == $shop_id) {
//             storeOrderItem(
//                 $order_id,
//                 $product->product_id,
//                 $product->quantity_in_cart,
//                 $product->product_price
//             );
//         };
//     };

//     // on supprime uniquements les produits du shop du panier
//     deleteCartProductsByShop($user_id, $shop_id);

//     redirectTo('/user/profile/order');
// }

// detail order
function showOrderController(int $id)
{
    if (!isset($_SESSION['user'])) {
        redirectTo('/login');
    }

    // recupere id du commande
    // if (!isset($_GET['id'])) {
    //     redirectTo('/cart');
    // }

    $order_id = $id;

    // recupere les detail produit du order
    $items = findOrderItemsByOrderId($order_id);

    $title = "Détail Commandes | {$_SESSION['user']->name}";
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/account/profile.html.php";
    require_once PATH . "/views/pages/account/order-detail.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}
