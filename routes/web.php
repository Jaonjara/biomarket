<?php

require_once PATH . "/app/controllers/home.controller.php";
require_once PATH . "/app/controllers/contacts.controller.php";
require_once PATH . "/app/controllers/about.controller.php";
require_once PATH . "/app/controllers/shop.controller.php";
require_once PATH . "/app/controllers/product.controller.php";
require_once PATH . "/app/controllers/cart.controller.php";
require_once PATH . "/app/controllers/comments.controller.php";



// instance (initialisation)
$router = new AltoRouter();


// page home
$router->map('GET', '/', function () {
    homeController();
});

// page contacts
$router->map('GET', '/contacts', function () {
    contactsController();
});

// page about
$router->map('GET', '/apropos', function () {
    aboutController();
});


// page shop
$router->map('GET', '/boutiques', function () {
    shopController();
});

// page detail shop
$router->map('GET', '/boutiques/[i:id]', function ($id) {
    shopsDetailController($id);
});


// detail produit via shop
$router->map('GET', '/boutiques/[i:id]/produits/[i:shop_id]', function ($id, $shop_id) {
    shopProductDetail($id, $shop_id);
});

// list de tous les produit via boutique page
$router->map('GET', '/produits', function () {
    listAllProducts();
});

// filtre tous les produits via boutique page
$router->map('GET', '/produits/[i:shop_id]/category/[i:category_id]', function ($shop_id, $category_id) {
    shopFilterByCategory($shop_id, $category_id);
});

// detail product via tous les produits 
$router->map('GET', '/produits/[i:id]', function ($id) {
    showProductController($id);
});

// page product misy commentaire
$router->map('POST', '/products/comment/[i:id]', function ($id) {
    storeCommentsController($id);
});

// action delete commentaire
$router->map('POST', '/products/[i:product_id]/comment/delete/[i:id]', function ($product_id, $id) {
    removeCommentsController($id, $product_id);
});

// filtrer par categorie dans list produit
$router->map('GET', '/categories/[i:id]', function ($id) {
    filterByCategory($id);
});


// detail produits via tous les produits
$router->map('GET', '/produits/[i:id]', function ($id) {
    showProductController($id);
});

/***************************************************************************
 * ****************************CARTS****************************************
 ***************************************************************************/
// list cart
$router->map('GET', '/cart', function () {
    cartController();
});

// remove
$router->map('POST', '/cart/delete/[i:id]', function ($id) {
    deleteProductInCartController($id);
});

// cart action ajout
$router->map('POST', '/products/cart/add/[i:id]', function ($id) {
    addProductInCartController($id);
});

// reduire 
$router->map('POST', '/products/cart/decrement/[i:id]', function ($id) {
    decrementProductInCartController($id);
});




// autres routes
require_once PATH . "/routes/order.php";
require_once PATH . "/routes/shop.php";
require_once PATH . "/routes/admin.php";
require_once PATH . "/routes/account.php";
require_once PATH . "/routes/auth.php";


// match current request url
$match = $router->match();

// call closure or throw 404 status
if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // no route was matched
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    echo "404 Not Found";
    http_response_code(404);
}
