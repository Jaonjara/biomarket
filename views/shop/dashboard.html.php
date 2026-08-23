<?php

/** @var int $total_categories */
/** @var int $totalProduct */
/** @var int $orderpending */
?>

<main class="dashboard">
    <section class="head">
        <div class="head-child">
            <div class="head-child-left">
                <h2 class="head-child-title">Bonjour, <?= $_SESSION['user']->name ?></h2>

                <p class="head-child-para">Voici ce qui se passe dans votre boutique aujourd'hui</p>
            </div>
        </div>
        <div class="head-card">
            <div class="head-card-item">
                <div class="head-card-item-icon head-card-item-icon-1">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <div class="head-card-item-stat">
                    <span class="head-card-item-stat-span">Total catégories</span>
                    <p class="head-card-item-stat-title"><?= $total_categories ?? 0 ?></p>
                </div>
            </div>
            <div class="head-card-item">
                <div class="head-card-item-icon head-card-item-icon-2">
                    <i class="fa-solid fa-box"></i>
                </div>
                <div class="head-card-item-stat">
                    <span class="head-card-item-stat-span">Produits</span>
                    <p class="head-card-item-stat-title"><?= $totalProduct ?? 0 ?></p>
                </div>
            </div>
            <div class="head-card-item">
                <div class="head-card-item-icon head-card-item-icon-3">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div class="head-card-item-stat">
                    <span class="head-card-item-stat-span">Commandes en attente</span>
                    <p class="head-card-item-stat-title"><?= $orderpending ?? 0 ?></p>
                </div>
            </div>
            <div class="head-card-item">
                <div class="head-card-item-icon head-card-item-icon-4">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <div class="head-card-item-stat">
                    <span class="head-card-item-stat-span">Chiffre d'affaires</span>
                    <p class="head-card-item-stat-title">201 300Ar</p>
                </div>
            </div>
        </div>
    </section>
</main>