<?php
require_once PATH . "/app/controllers/shop/shopDashboard.controller.php";
require_once PATH . "/app/controllers/shop/shopProducts.controller.php";
require_once PATH . "/app/controllers/shop/shopCategory.controller.php";
require_once PATH . "/app/middlewares/sellerMiddleware.php";



// page dashboard
$router->map('GET', '/shop/dashboard', function () {
    shopDashboardController();
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
