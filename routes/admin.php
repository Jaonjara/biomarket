<?php

require_once PATH . "/app/controllers/admin/adminDashboard.controller.php";
require_once PATH . "/app/controllers/admin/adminUser.controller.php";
require_once PATH . "/app/controllers/admin/adminSellers.controller.php";
require_once PATH . "/app/middlewares/adminMiddleware.php";


/**************************************************************** 
 ****************************** DASHBOARD ***************************
 ****************************************************************/

// dashboard
$router->map('GET', '/admin/dashboard', function () {
    adminMiddlerware();
    adminDashboardController();
});

/**************************************************************** 
 ****************************** USERS ***************************
 ****************************************************************/

// page list user
$router->map('GET', '/admin/users', function () {
    adminMiddlerware();
    adminUsersController();
});

// page create user
$router->map('GET', '/admin/users/create', function () {
    adminMiddlerware();
    createUserAdminController();
});

// action user create
$router->map('POST', '/admin/users/create', function () {
    adminMiddlerware();
    createUserActionController();
});

// action user delete
$router->map('POST', '/admin/users/create/[i:id]', function ($id) {
    adminMiddlerware();
    removeUserController($id);
});

// action seller delete
$router->map('POST', '/admin/sellers/[i:id]', function ($id) {
    adminMiddlerware();
    removeSellerController($id);
});



/**************************************************************** 
 ****************************** SHOPS ***************************
 ****************************************************************/
// sellers
$router->map('GET', '/admin/sellers', function () {
    adminMiddlerware();
    adminSellersController();
});
