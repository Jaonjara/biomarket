<?php

function userMiddleware()
{
    if (!isset($_SESSION['user'])) {
        redirectTo('/login');
    }

    if (
        $_SESSION['user']->role !== "user" &&
        $_SESSION['user']->role !== "admin" &&
        $_SESSION['user']->role !== "seller"
    ) {
        redirectTo('/login');
    }
}
