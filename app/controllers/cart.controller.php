<?php

require_once PATH . "/app/models/cart.php";
require_once PATH . "/app/models/product.php";
require_once PATH . "/app/models/shop/shop.php";

// page cart
function cartController()
{
    // $products = findProductsByShopId($id);
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']->id;

        // produits sans bases sans regroupement par shop
        $rawProducts = findAllProductInCart($user_id);

        // regrouper par nom shop
        $productsInCarts = [];

        foreach ($rawProducts as $product) {
            $shopName = $product->shop_name;
            $productsInCarts[$shopName][] = $product;
        }
    } else {
        $productsInCarts = [];
    }

    // var_dump($productsInCarts);
    // die;

    $title = "Panier";
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/cart/carts.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}



// id product_id
function addProductInCartController(int $product_id)
{
    // if (isset($_POST['path'])) {
    //     $path = htmlspecialchars($_POST['path']) ?? null;
    //     $path = htmlspecialchars($_POST['shopDetail']) ?? null;
    // } else {
    //     $path = null;
    // }

    $redirect_cart = htmlspecialchars($_POST['redirect_cart']);

    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']->id;
    }

    // nombre de produit disponible du vendeur
    $product_quantity = findProductShopById($product_id)->product_quantity;
    // nombre de produit ajouté dans panier
    $product_quantity_in_cart = findProductByIdInCart($product_id)->quantity ?? 0;
    // nom du shop

    $shop_id = findProductShopById($product_id)->shop_id;
    // var_dump($shop_id);
    // die;

    if ($product_quantity_in_cart < $product_quantity) {
        $data = [
            "user_id" => $user_id,
            "product_id" => $product_id,
            "shop_id" => $shop_id

        ];
        storeProductInCart($data);
    };

    redirectTo("$redirect_cart");

    // if ($path === "cart") {
    //     redirectTo('/cart');
    // } else {
    //     redirectTo('/produits');
    //     // redirectTo('/boutiques/[i:id]');
    // }
}

function decrementProductInCartController(int $product_id)
{


    $user_id = $_SESSION['user']->id;

    $shop_id = findProductShopById($product_id)->shop_id;

    $data = [
        "user_id" => $user_id,
        "product_id" => $product_id,
        "shop_id" => $shop_id
    ];

    decrementProductInCart($data);

    redirectTo('/cart');
}

// supprimer produit dans panier
function deleteProductInCartController(int $cart_id)
{
    $user_id = $_SESSION['user']->id;
    $cart_id = $cart_id;
    $data = [
        "id" => $cart_id,
        "user_id" => $user_id
    ];
    // var_dump($data);
    // die;

    removeProductInCartById($data);
    redirectTo('/cart');
}
