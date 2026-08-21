<?php



$url = $_SERVER["REQUEST_URI"];

$linksItems = [
    [
        "links" => [
            "/admin/dashboard"
        ],
        "title" => "Tableau de bord",
        "icon" => "fa-solid fa-house"
    ],

    [
        "links" => [
            "/admin/users",
            "/admin/users/create"
        ],
        "title" => "Utilisateurs",
        "icon" => "fa-solid fa-user-group"
    ],

    [
        "links" => [
            "/admin/sellers",
            "/admin/sellers/create"
        ],
        "title" => "Boutiques",
        "icon" => "fa-solid fa-layer-group"
    ],

    [
        "links" => [
            // "/shop/order"
        ],
        "title" => "Abonnements",
        "icon" => "fa-solid fa-user-plus"
    ],

    [
        "links" => [
            // "/shop/dashboard"
        ],
        "title" => "Paramètres",
        "icon" => "fa-solid fa-gear"
    ],
]
?>



<nav class="nav side" id="sidebar1">
    <div class="nav-logo">
        <i class="fa-solid fa-seedling"></i>
        <div class="nav-logo-description">
            <h2 class="nav-logo-description-title"><span class="nav-logo-description-span">Bio</span>Market</h2>
            <p class="nav-logo-description-para">Admin DASHBOARD</p>
        </div>
    </div>

    <div class="nav-card">
        <ul class="nav-card-links">

            <li class="nav-card-links-item nav-card-links-item-dash">
                <a
                    href="/admin/dashboard"
                    class="nav-card-links-item-link 
                    <?php if ($url == "/admin/dashboard") {
                        echo "nav-card-links-item-link-active";
                    } ?>
                    ">
                    <i class="fa-solid fa-house"></i>
                    Tableau de bord
                </a>
            </li>
        </ul>
    </div>
    <div class="nav-card">
        <h4 class="nav-card-title">GESTION</h4>
        <ul class="nav-card-links">
            <?php for ($i = 1; $i < 4; $i++) { ?>
                <li class="nav-card-links-item">
                    <a href="<?= $linksItems[$i]["links"][0] ?>"
                        class="nav-card-links-item-link 
                        <?php if (in_array($url, $linksItems[$i]["links"])) {
                            echo "nav-card-links-item-link-active";
                        } ?>
                        ">
                        <i class="<?= $linksItems[$i]["icon"] ?>"></i>
                        <?= $linksItems[$i]["title"] ?>
                    </a>
                </li>
            <?php } ?>

        </ul>
    </div>
    <div class="nav-card">
        <h4 class="nav-card-title">CONFIGURATION</h4>
        <ul class="nav-card-links">

            <li class="nav-card-links-item">
                <a
                    href=""
                    class="nav-card-links-item-link 
                <?php if ($url == "") {
                    echo "nav-card-links-item-link-active";
                } ?>
                ">
                    <i class="fa-solid fa-gear"></i>
                    Paramètres
                </a>
            </li>
        </ul>
    </div>































    <!-- <div class="nav-card">
        <ul class="nav-card-links">
            <li class="nav-card-links-item nav-card-links-item-dash">
                <a href="/admin/dashboard" class="nav-card-links-item-link ">
                    <i class="fa-solid fa-house"></i>
                    Tableau de bord
                </a>
            </li>
        </ul>
    </div>
    <div class="nav-card">
        <h4 class="nav-card-title">GESTION</h4>
        <ul class="nav-card-links">
            <li class="nav-card-links-item">
                <a href="/admin/users" class="nav-card-links-item-link nav-card-links-item-link-active">
                    <i class="fa-solid fa-user-group"></i>
                    Utilisateurs
                </a>
            </li>
            <li class="nav-card-links-item">
                <a href="/admin/sellers" class="nav-card-links-item-link ">
                    <i class="fa-solid fa-shop"></i>
                    Vendeurs
                </a>
            </li>
            <li class="nav-card-links-item">
                <a href="" class="nav-card-links-item-link">
                    <i class="fa-solid fa-user-plus"></i>
                    Abonnements
                </a>
            </li>
        </ul>
    </div>
    <div class="nav-card">
        <h4 class="nav-card-title">CONFIGURATION</h4>
        <ul class="nav-card-links">
            <li class="nav-card-links-item">
                <a href="" class="nav-card-links-item-link ">
                    <i class="fa-solid fa-gear"></i>
                    Paramètres
                </a>
            </li>
        </ul>
    </div> -->

    <div class="nav-logout">
        <form action="/logout" method="POST">
            <button
                type="submit"
                class="nav-icon"><i class="fa-solid fa-power-off"></i>
                Déconnexion
            </button>
        </form>
    </div>
</nav>