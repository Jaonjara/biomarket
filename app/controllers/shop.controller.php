<?php
require_once PATH . "/app/models/shop/shop.php";

// page list shop 
function shopController()
{
    $title = "Boutiques";
    $shops = findAllShop();
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/shops.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}




// detail shop
function shopsDetailController(int $id)
{
    $shop = findShopById($id);
    $categories = findCategoriesByShopId($id);
    $products = findProductsByShopId($id);
    $shopRating = shopRating($id);


    if ($categories === false) {
        redirectTo('/categories');
    }
    if ($shop === false) {
        redirectTo('/categories');
    }
    if ($products === false) {
        redirectTo('/categories');
    }

    $title = "Detail";
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/shops-detail.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}

// filtre par categories
function shopFilterByCategory(int $shop_id, int $category_id)
{
    $shop = findShopById($shop_id);
    $categories = findCategoriesByShopId($shop_id);
    $shopRating = shopRating($shop_id);

    if ($category_id > 0) {
        $products = findProductsByShopIdAndCategoryId($shop_id, $category_id);
    } else {
        $products = findProductsByShopId($shop_id);
    }

    $title = "Detail";
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/shops-detail.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}

// detail produit dans shop
function shopProductDetail(int $shop_id, int $product_id)
{
    $title = "Produit detail";
    $shop = findShopById($shop_id);
    $data = [
        "product_id" => $product_id,
        "shop_id" => $shop_id
    ];
    $productsByShop = findProductByIdAndShopId($data);
    // var_dump($data);

    $comments = findAllCommentsByProductId($product_id);
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/shop-product-detail.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}
