<main>
    <header class="hero">
        <div class="hero-child">

            <h3 class="hero-subtitle">Bio & Frais</h3>
            <h1 class="hero-title">
                <span class="hero-span">
                    <span class="nav-logo-span">Bio</span>Market :
                </span><br>Le meilleur des produits <br>agricoles <span class="nav-logo-span">locaux.</span>
            </h1>
            <div>
                <p class="hero-para">Consommez sain et bio pour être en forme.</p>
                <p class="hero-para">Soutenez nos producteurs locaux.</p>
            </div>

            <div class="hero-links">
                <a href="" class="hero-links-link">Voir les Catégories &rarr;</a>
                <?php if (isset($_SESSION['user'])) { ?>
                    <a href="/seller" class="hero-links-link">Créer ma boutique &rarr;</a>
                <?php } ?>
            </div>
        </div>
    </header>

    <section class="service">
        <div class="service-head">
            <h2 class="service-head-title">NOS SERVICES</h2>
            <p class="service-head-para">Nous offrons des services de qualités, garanties. Respectes les normes de sécurités alimentaires.</p>

        </div>

        <div class="service-card">
            <div class="service-card-item">
                <i class="fa-solid fa-medal"></i>
                <h4 class="service-card-item-title">100% FRAIS</h4>
                <p class="service-card-item-para">Produits frais.</p>
            </div>
            <div class="service-card-item">
                <i class="fa-solid fa-truck"></i>
                <h4 class="service-card-item-title">LIVRAISON</h4>
                <p class="service-card-item-para">Livraison rapide</p>
            </div>
            <div class="service-card-item">
                <i class="fa-solid fa-headset"></i>
                <h4 class="service-card-item-title">SUPPORTS CLIENTS</h4>
                <p class="service-card-item-para"> Disponibles 7j/7</p>
            </div>
            <div class="service-card-item">
                <i class="fa-solid fa-seedling"></i>
                <h4 class="service-card-item-title">BIO ET LOCAL</h4>
                <p class="service-card-item-para">Produits sans intrants</p>
            </div>
        </div>

    </section>
</main>