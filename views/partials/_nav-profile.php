<?php
$url = $_SERVER["REQUEST_URI"];

$linksItems = [
    [
        "links" => [
            "/user/profile/informations"
        ],
        "title" => "Informations",
        "icon" => "fa-solid fa-user"
    ],
    [
        "links" => [
            "/user/profile/order"
        ],
        "title" => "Commandes",
        "icon" => "fa-solid fa-cart-shopping"
    ],
    [
        "links" => [
            "/user/profile/favoris"
        ],
        "title" => "Favoris",
        "icon" => "fa-regular fa-heart"
    ],
    [
        "links" => [
            "/user/profile/avis"
        ],
        "title" => "Avis",
        "icon" => "fa-regular fa-star"
    ],
    [
        "links" => [
            "/user/profile/messages"
        ],
        "title" => "Messages",
        "icon" => "fa-regular fa-message"
    ],
    [
        "links" => [
            "/user/profile/parametres"
        ],
        "title" => "Paramètres",
        "icon" => "fa-solid fa-gear"
    ],
];

?>


<section class="navbar">
    <ul class="navbar-links">

        <?php foreach ($linksItems as $linkItem) { ?>
            <li class="navbar-item">
                <a
                    href="<?= $linkItem["links"][0] ?>"
                    class="navbar-link
                    <?php
                    foreach ($linkItem["links"] as $link) {

                        if ($url == $link) {
                            echo "navbar-link-active";
                        }
                    }
                    ?>
                        ">
                    <i class="<?= $linkItem["icon"] ?>"></i>
                    <?= $linkItem["title"] ?>
                </a>
            </li>
        <?php } ?>






        <!-- <li class="navbar-item">
            <a href="/user/informations" class="navbar-link ">
                <i class="fa fa-user"></i>
                Informations
            </a>
        </li>
        <li class="navbar-item">
            <a href="/user/order" class="navbar-link">
                <i class="fa-solid fa-cart-shopping"></i>
                Commandes
            </a>
        </li>
        <li class="navbar-item">
            <a href="" class="navbar-link">
                <i class="fa-regular fa-heart"></i>
                Favoris
            </a>
        </li>
        <li class="navbar-item">
            <a href="" class="navbar-link">
                <i class="fa-regular fa-star"></i>
                Avis
            </a>
        </li>
        <li class="navbar-item">
            <a href="" class="navbar-link">
                <i class="fa-regular fa-message"></i>
                Messages
            </a>
        </li>
        <li class="navbar-item">
            <a href="" class="navbar-link">
                <i class="fa-solid fa-gear"></i>
                Paramètres
            </a>
        </li> -->
    </ul>
</section>