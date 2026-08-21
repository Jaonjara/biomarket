<?php

function adminMiddlerware()
{

    if (!isset($_SESSION['user'])) {
        redirectTo('/login');
    }

    if ($_SESSION['user']->role !== "admin") {
        redirectTo('/login');
    }
}
