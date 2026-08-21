<div class="intro">
    <div class="intro-desc">
        <h2 class="intro-desc-title">
            <i class="fa fa-user"></i>
            Mon profil
        </h2>
        <p class="intro-desc-para">Gérez votres informations personnelles et vos activités sur la plateforme.</p>
    </div>
</div>
<section class="profile">
    <div class="profile-left">
        <div class="profile-left-imgcontent">
            <img <?php if (isset($_SESSION['profile_user']->image)) { ?>
                src="<?= $_SESSION['profile_user']->image ?>" alt="image-profile" class="profile-left-imgcontent-img">
        <?php } ?>
        </div>
        <div class="profile-left-info">
            <div class="profile-left-info-up">
                <h3 class="profile-left-info-up-title"><?= $_SESSION['user']->name ?></h3>

                <p class="profile-left-info-up-para profile-left-info-up-badge">Client depuis <?= $_SESSION['user']->createdAt ?></p>
            </div>
            <div class="profile-left-info-up">
                <p class="profile-left-info-up-para"><span class="profile-left-info-up-span">Email:</span> <?= $_SESSION['user']->email ?></p>

                <p class="profile-left-info-up-para">
                    <span class="profile-left-info-up-span">
                        Téléphone:
                        <?php if (isset($_SESSION['profile_user']->phone)) { ?>
                    </span> +261<?= $_SESSION['profile_user']->phone ?>
                <?php } ?>
                </p>

                <p class="profile-left-info-up-para">
                    <span class="profile-left-info-up-span">
                        Localisation:
                        <?php if (isset($_SESSION['profile_user']->city)) { ?>
                    </span> <?= $_SESSION['profile_user']->city ?>, Madagascar
                </p>
            <?php } ?>
            </div>
        </div>
    </div>
    <div class="profile-right">

        <a href="" class="profile-right-link">
            <i class="fa-solid fa-pen"></i>
            Modifier le profil
        </a>
        <div class="profile-right-status">
            <div class="profile-right-status-favoris profile-right-status-favoris-1">
                <i class="fa-solid fa-cart-shopping"></i>
                <div class="profile-right-status-favoris-stat">
                    <h3 class="profile-right-status-favoris-stat-title">12</h3>
                    <span class="profile-right-status-favoris-stat-para">Commandes</span>
                </div>
            </div>
            <div class="profile-right-status-favoris profile-right-status-favoris-2">
                <i class="fa-regular fa-heart"></i>
                <div class="profile-right-status-favoris-stat">
                    <h3 class="profile-right-status-favoris-stat-title">8</h3>
                    <span class="profile-right-status-favoris-stat-para">Favoris</span>
                </div>
            </div>
            <div class="profile-right-status-favoris profile-right-status-favoris-3">
                <i class="fa-regular fa-star"></i>
                <div class="profile-right-status-favoris-stat">
                    <h3 class="profile-right-status-favoris-stat-title">5</h3>
                    <span class="profile-right-status-favoris-stat-para">Avis</span>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once PATH . "/views/partials/_nav-profile.php" ?>