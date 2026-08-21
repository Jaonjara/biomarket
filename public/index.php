<?php

//Racine du projet
define('PATH', dirname(__DIR__));
// require_once PATH . "/database/database.php";
// connectToDtabase();


session_start();

// stripe
require_once PATH . '/vendor/autoload.php';

$stripeconfig = require PATH . '/app/config/stripe.php';
\Stripe\Stripe::setApiKey($stripeconfig['secret_key']);

require PATH . "/vendor/altorouter/altorouter/AltoRouter.php";
require_once PATH . "/app/config/utils.php";
require_once PATH . "/app/config/session.php";
require_once PATH . "/routes/web.php";


// var_dump($_SESSION['shop']);
