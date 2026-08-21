<?php

/** @var object $count*/
/** @var object $countSeller*/

?>


<section class="dashboard">

    <div class="description">
        <h2 class="description-title">Bonjour, admin!</h2>
        <p class="description-para">Voici votre tableau de bord pour gérer bioMarket</p>
    </div>

    <div class="card">
        <div class="card-item ">
            <div class="card-item-icon card-item-1">
                <i class="fa-solid fa-user-group"></i>
            </div>
            <div class="card-item-table">
                <h4 class="card-item-table-title">Utilisateurs total</h4>
                <p class="card-item-table-para"><?= $count->count_users ?? 0 ?></p>
            </div>
        </div>
        <div class="card-item ">
            <div class="card-item-icon card-item-2">

                <i class="fa-solid fa-store"></i>
            </div>
            <div class="card-item-table">
                <h4 class="card-item-table-title">Producteurs</h4>
                <p class="card-item-table-para"><?= $countSeller->count_sellers ?? 0 ?></p>
            </div>
        </div>

        <div class="card-item ">
            <div class="card-item-icon card-item-2">

                <i class="fa-solid fa-user"></i>
            </div>
            <div class="card-item-table">
                <h4 class="card-item-table-title">Clients</h4>
                <p class="card-item-table-para"><?= $count->count_users - $countSeller->count_sellers ?? 0 ?></p>
            </div>
        </div>
    </div>

</section>