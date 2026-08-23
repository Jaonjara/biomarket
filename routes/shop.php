<?php
require_once PATH . "/app/controllers/shop/shopDashboard.controller.php";
require_once PATH . "/app/controllers/shop/shopProducts.controller.php";
require_once PATH . "/app/controllers/shop/shopCategory.controller.php";
require_once PATH . "/app/middlewares/sellerMiddleware.php";
require_once PATH . '/app/controllers/shop/shopOrder.controller.php';
require_once PATH . '/app/controllers/shop/shopHeader.controller.php';
require_once PATH . '/app/controllers/notifications/notifications.controller.php';
require_once PATH . '/app/controllers/shop/shopSearch.controller.php';



// page dashboard
$router->map('GET', '/shop/dashboard', function () {
    shopDashboardController();
    // countUnreadNotificationsByShopController();
});

/***********************
 * PRODUIT
 ***********************/

// create shop
$router->map('GET', '/shop/products', function () {

    shopProductsController();
});



// page list produit
$router->map('GET', '/shop/products', function () {
    shopProductsController();
});

// page create produit
$router->map('GET', '/shop/products/create', function () {
    sellerMiddleware();
    shopCreateProductController();
});

//formulaire action produit
$router->map('POST', '/shop/products/create', function () {
    sellerMiddleware();
    shopStoreProductController();
});

// remove product
$router->map('POST', '/shop/products/remove/[i:id]', function ($id) {
    sellerMiddleware();
    shopRemoveProductController($id);
});

// page update products
$router->map('GET', '/shop/products/update/[i:id]', function ($id) {
    sellerMiddleware();
    shopPageUpdateProductController($id);
});

// action update
$router->map('POST', '/shop/products/update/[i:id]', function ($id) {
    sellerMiddleware();
    shopEditProductController($id);
});


/***********************
 * CATEGORY
 ***********************/
// page list category
$router->map('GET', '/shop/category', function () {
    shopCategoryController();
});

// page create category
$router->map('GET', '/shop/category/create', function () {
    sellerMiddleware();
    shopCreateCategoryController();
});

// store action
$router->map('POST', '/shop/category/create', function () {
    sellerMiddleware();
    shopStoreCategoryController();
});

// remove category
$router->map('POST', '/shop/category/remove/[i:id]', function ($id) {
    sellerMiddleware();
    shopRemoveCategoryController($id);
});

// update page category
$router->map('GET', '/shop/category/update/[i:id]', function ($id) {
    sellerMiddleware();
    shopPageUpdateController($id);
});

// action update category
$router->map('POST', '/shop/category/update/[i:id]', function ($id) {
    sellerMiddleware();
    shopEditController($id);
});


/***********************
 * ORDER
 ***********************/

// page order
$router->map('GET', '/shop/order', function () {
    sellerMiddleware();
    shopOrdersController();
});

// valider order
$router->map('POST', '/shop/order/validate/[i:order_id]', function ($order_id) {
    sellerMiddleware();
    validateOrderController($order_id);
});

// annuler order
$router->map('POST', '/shop/order/cancel/[i:order_id]', function ($order_id) {
    sellerMiddleware();
    cancelOrderController($order_id);
});

// recherche
$router->map('POST', '/shop/order/cancel/[i:order_id]', function ($order_id) {
    sellerMiddleware();
    cancelOrderController($order_id);
});

// recherche
$router->map('GET', '/shop/order/detail/[i:order_id]', function ($order_id) {
    sellerMiddleware();
    showShopOrderController($order_id);
});


/***************************************************************************
 * *************************** NOTIFICATIONS ****************************************
 ***************************************************************************/
$router->map('POST', '/shop/notifications/read/[i:notification_id][i:shop_id]', function ($notification_id, $shop_id) {
    notificationsView($notification_id, $shop_id);
});



/*************************************************************************
 **************************** SEARCH ************************************
 *************************************************************************/
$router->map('GET', '/shop/search', function () {
    shopGlobalSearchController();
});
