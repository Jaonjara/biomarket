<?php
require_once PATH . '/app/models/cart.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BioMarket |
        <?php /** @var string $title */ ?>
        <?= $title ?? "" ?>
    </title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    <link rel="shortcut icon" href="/assets/images/logo/icon.png" type="image/x-icon">
</head>

<body>

    <nav class="nav">
        <div class="nav-logo">
            <a href="/" class="nav-logo-link">
                <span class="nav-logo-span">Bio</span>Market
            </a>
        </div>
        <label for="menu-label" class="nav-menu-label"><i class="fas fa-bars"></i></label>
        <input type="checkbox" id="menu-label" class="nav-menu-input">
        <?php require_once PATH . "/views/partials/_nav-site.html.php" ?>

        <?php if (isset($_SESSION["user"])) { ?>
            <div class="nav-icon">
                <a href="/user/profile" class="nav-icon-account"><i class="fa-regular fa-user"></i></a>
                <a href="/cart" class="nav-icon-account">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="nav-icon-account-span"><?= cartCount() ?? 0 ?></span>
                </a>
                <form action="/logout" method="POST">
                    <button
                        type="submit"
                        class="nav-icon-account-btn"><i class="fa-solid fa-power-off"></i></button>
                </form>
            </div>
        <?php } else { ?>

            <div class="nav-icon">
                <a href="/register" class="nav-icon-account">
                    <i class="fa-regular fa-user"></i>
                </a>
                <a href="/cart" class="nav-icon-account nav-icon-account-carts">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="nav-icon-account-span"><?= cartCount() ?? 0 ?></span>

                </a>
            </div>
        <?php } ?>

    </nav>