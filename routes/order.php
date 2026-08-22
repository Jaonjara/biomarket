<?php
require_once PATH . '/app/controllers/orders/orders.controller.php';

// verifier commandes et confirmer
$router->map('POST', '/user/profile/order/payements/[i:shop_id]', function ($shop_id) {
    userMiddleware();
    // checkoutController($shop_id);
    createStripeCheckoutController($shop_id);
});

// webhook
$router->map('POST', '/stripe/webhook', function () {
    stripeWebhookController();
});

// stripe success
$router->map('GET', '/user/profile/order/success', function () {
    userMiddleware();
    stripeSuccessController();
});




// page order
// $router->map('GET', '/order', function () {
//     ordersController();
// });

$router->map('GET', '/user/profile/order', function () {
    userMiddleware();
    ordersController();
});

// resume order
$router->map('GET', '/user/profile/order/payements/[i:shop_id]', function ($shop_id) {
    userMiddleware();
    checkoutResumeOrderController($shop_id);
});



$router->map('GET', '/user/profile/order/[i:id]', function ($id) {
    userMiddleware();
    showOrderController($id);
});
