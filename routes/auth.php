<?php
require_once PATH . "/app/controllers/auth/register.controller.php";
require_once PATH . "/app/controllers/auth/login.controller.php";
require_once PATH . "/app/controllers/auth/seller.controller.php";
require_once PATH . "/app/controllers/account.controller.php";

// register
$router->map('GET', '/register', function () {
    registerController();
});

$router->map('POST', '/register', function () {
    createAccountController();
});


// login
$router->map('GET', '/login', function () {
    loginController();
});

$router->map('POST', '/login', function () {
    checkAccountController();
});

//logout
$router->map('POST', '/logout', function () {
    logoutController();
});


// becomeseller page
$router->map('GET', '/seller', function () {
    sellerController();
});

// become seller action
$router->map('POST', '/seller', function () {
    becomeSellerController();
});
