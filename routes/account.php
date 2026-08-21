<?php
require_once PATH . "/app/controllers/account.controller.php";
require_once PATH . "/app/middlewares/userMiddleware.php";

// page profile
$router->map('GET', '/user/profile', function () {
    userMiddleware();
    profileUserController();
});

// page information
$router->map('GET', '/user/profile/informations', function () {
    userMiddleware();
    userInformationController();
});

// create profile
$router->map('GET', '/user/profile/informations/create', function () {
    userMiddleware();
    createInformationController();
});


// create profile
$router->map('POST', '/user/profile/informations/create', function () {
    userMiddleware();
    storeInformationController();
});

// page order
// $router->map('GET', '/user/profile/orders', function () {
//     userMiddleware();
//     userOrderController();
// });
