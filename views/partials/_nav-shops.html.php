<?php

require_once PATH . "/app/models/shop/category.php";

// $category = findCategoryShopById(int $id);


$url = $_SERVER["REQUEST_URI"];

$linksItems = [
    [
        "links" => [
            "/shop/dashboard"
        ],
        "title" => "Tableau de bord",
        "icon" => "fa-solid fa-house"
    ],

    [
        "links" => [
            "/shop/products",
            "/shop/products/create",
            "/shop/products/update/"
        ],
        "title" => "Mes produits",
        "icon" => "fa-solid fa-box"
    ],

    [
        "links" => [
            "/shop/category",
            "/shop/category/create"
        ],
        "title" => "Mes catégories",
        "icon" => "fa-solid fa-layer-group"
    ],

    [
        "links" => [
            // "/shop/order"
        ],
        "title" => "Mes commandes",
        "icon" => "fa-solid fa-cart-arrow-down"
    ],

    [
        "links" => [
            // "/shop/dashboard"
        ],
        "title" => "Messages",
        "icon" => "fa-regular fa-envelope"
    ],

    [
        "links" => [
            // "/shop/dashboard"
        ],
        "title" => "Mon profil",
        "icon" => "fa-regular fa-user"
    ],

    [
        "links" => [
            // "/shop/dashboard"
        ],
        "title" => "Paramètres",
        "icon" => "fa-solid fa-gear"
    ],

];


?>



<nav class="side side-visible" id="sidebar1">
    <div class="side-logo">
        <i class="fa-solid fa-seedling"></i>
        <div class="side-logo-description">
            <h2 class="side-logo-description-title"><span class="side-logo-description-span">Bio</span>Market</h2>
            <p class="side-logo-description-para">Shop DASHBOARD</p>
        </div>
    </div>
    <div class="side-nav">
        <ul class="side-nav-links">

            <?php foreach ($linksItems as $linkItem) { ?>
                <li class="side-nav-links-item">
                    <a
                        href="<?= $linkItem["links"][0] ?>"
                        class="side-nav-links-item-link
                    <?php
                    foreach ($linkItem["links"] as $link) {

                        if ($url == $link) {
                            echo "side-nav-links-item-link-active";
                        }
                    }
                    ?>
                        ">
                        <i class="<?= $linkItem["icon"] ?>"></i>
                        <?= $linkItem["title"] ?>
                    </a>
                </li>
            <?php } ?>




















            <!-- <li class="side-nav-links-item">
                <a href="/shop/dashboard" class="side-nav-links-item-link ">
                    <i class="fa-solid fa-house"></i>
                    Tableau de bord
                </a>
            </li>
            <li class="side-nav-links-item">
                <a href="/shop/products" class="side-nav-links-item-link ">
                    <i class="fa-solid fa-box"></i>
                    Mes produits
                </a>
            </li>
            <li class="side-nav-links-item">
                <a href="/shop/category" class="side-nav-links-item-link ">
                    <i class="fa-solid fa-layer-group"></i>
                    Mes catégories
                </a>
            </li>
            <li class="side-nav-links-item">
                <a href="" class="side-nav-links-item-link side-nav-links-item-link-active">
                    <i class="fa-solid fa-cart-arrow-down"></i>
                    Mes commandes
                </a>
            </li>
            <li class="side-nav-links-item">
                <a href="" class="side-nav-links-item-link ">
                    <i class="fa-regular fa-envelope"></i>
                    Messages
                </a>
            </li>
            <li class="side-nav-links-item">
                <a href="" class="side-nav-links-item-link ">
                    <i class="fa-regular fa-user"></i>
                    Mon profil
                </a>
            </li>
            <li class="side-nav-links-item">
                <a href="" class="side-nav-links-item-link ">
                    <i class="fa-solid fa-gear"></i>
                    Paramètres
                </a>
            </li> -->
        </ul>
    </div>
    <!-- active -->
    <!-- side-nav-links-item-link-active -->
    <div class="side-logout">
        <form action="/logout" method="POST">
            <button
                type="submit"
                class="side-icon"><i class="fa-solid fa-power-off"></i>
                Déconnexion
            </button>
        </form>
    </div>
</nav>