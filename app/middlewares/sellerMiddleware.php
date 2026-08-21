<?php

function sellerMiddleware()
{

    if (!isset($_SESSION['user'])) {
        redirectTo('/login');
    }

    if ($_SESSION['user']->role !== "seller") {
        redirectTo('/login');
    }
}
