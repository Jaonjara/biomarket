<?php
require_once PATH . '/app/models/notifications.php';
$shop_id = $_SESSION['shop']->id;

?>

<div class="main">
    <section class="header">


        <form action="" class="header-form" method="">
            <input

                type="search"
                name="name"
                class="header-form-input"
                placeholder="Rechercher un produit...">
            <!-- <button type="submit" class="header-form-btn">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <div class="header-form-linkcontainer">
                <a href="/dashboard" class="table-search-form-linkcontainer-link">Annuler</a>
            </div> -->
        </form>
        <div class="header-right">
            <div class="header-right-child">

                <div class="header-right-icon">
                    <i class="fa-regular fa-bell"></i>
                    <?php if (countUnreadNotificationsByShop($shop_id) > 0) { ?>
                        <span class="header-right-icon-span header-right-icon-span-notification">
                            <?= countUnreadNotificationsByShop($shop_id) ?>
                        </span>
                    <?php } ?>
                </div>
                <!-- <div class="header-right-icon">
                    <i class="fa-regular fa-envelope"></i>
                    <span class="header-right-icon-span">10</span>
                </div> -->
            </div>
            <div class="header-right-profile">
                <img
                    src="/assets/images/story-1.jpeg"
                    alt=""
                    width="60px"
                    height="60px"
                    class="header-right-profile-img">
                <div class="header-right-profile-role">
                    <button id="menu-btn" class="header-right-profile-role-btn">
                        <?= $_SESSION['user']->name ?>
                        <div class="header-right-profile-role" id="icon-list">
                            <i class="fa-solid fa-chevron-right "></i>
                        </div>
                    </button>
                    <ul id="menu-list" class="header-right-profile-role-list">
                        <li class="header-right-profile-role-list-item"><a href="" class="header-right-profile-role-list-item-link">Coucou</a></li>
                        <li class="header-right-profile-role-list-item"><a href="" class="header-right-profile-role-list-item-link">Coucou</a></li>
                        <li class="header-right-profile-role-list-item">
                            <a href="" class="header-right-profile-role-list-item-link">Coucou</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="header-hamberger" id="visible">
                <i class="fa-solid fa-bars"></i>
            </div>

        </div>
    </section>