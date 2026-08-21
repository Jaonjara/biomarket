<?php

function homeController()
{
    $title = "Accueil";
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/home.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}
