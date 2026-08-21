<?php

/** @var boolean $infoUser */
?>

<section class="information">
    <div class="information-desc">
        <h3 class="information-desc-title">Information personnelles</h3>
        <a href="" class="information-desc-link">
            <i class="fa-solid fa-pen"></i>
        </a>
    </div>

    <?php if ($infoUser === false) { ?>
        <p>Veuillez completer votre information s'il vous plaît. Ceci est obligatoire pour l'achat dans la plateforme. </p>
        <a href="/user/profile/informations/create">Completer mes informations</a>
    <?php } else { ?>


        <div class="information-card">
            <div class="information-card-item">
                <h3 class="information-card-item-title">
                    <i class="fa fa-user"></i>
                    Nom
                </h3>
                <p class="information-card-item-para"><?= $_SESSION['user']->name ?></p>
            </div>
            <div class="information-card-item">
                <h3 class="information-card-item-title">
                    <i class="fa fa-user"></i>
                    Prénom
                </h3>
                <p class="information-card-item-para"><?= $_SESSION['user']->firstname ?></p>
            </div>
            <div class="information-card-item">
                <h3 class="information-card-item-title">
                    <i class="fa-regular fa-envelope"></i>
                    Email
                </h3>
                <p class="information-card-item-para"><?= $_SESSION['user']->email ?></p>
            </div>
            <div class="information-card-item">
                <h3 class="information-card-item-title">
                    <i class="fa-solid fa-mobile-screen"></i>
                    Téléphone
                </h3>
                <p class="information-card-item-para">+261 <?= $_SESSION['profile_user']->phone ?></p>
            </div>
            <div class="information-card-item">
                <h3 class="information-card-item-title">
                    <i class="fa-solid fa-location-dot"></i>
                    Addresse
                </h3>
                <p class="information-card-item-para"><?= $_SESSION['profile_user']->address ?> <?= $_SESSION['profile_user']->city ?></p>
            </div>
        </div>
    <?php } ?>








</section>