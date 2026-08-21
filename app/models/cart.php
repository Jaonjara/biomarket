<?php
require_once PATH . "/database/database.php";

function cartCount()
{
    // on a besoin de id du user connecter et id du produit

    if (isset($_SESSION['user'])) {

        // id user connecter
        $user_id = $_SESSION['user']->id;
        // pour id du produit efa azo @ le ajout au panier satria produit efa misy id ao

        // requete ici on sait deja le id produit mais pas user qui va ajouter, pour ça WHERE c.user_id = :user_id
        $query = "SELECT SUM(carts.quantity) AS nb_product
                        FROM carts
                        INNER JOIN users ON users.id = carts.user_id
                        INNER JOIN products ON products.id = carts.product_id
                        WHERE carts.user_id = :user_id";
        $request = connectToDatabase()->prepare($query);
        $request->execute(
            ["user_id" => $user_id]
        );
        return $request->fetch()->nb_product;
    }
}

// verifier si le produit existe dans base
function checkIfProductExistInCarts(array $data)
{

    $query = "SELECT * FROM carts
                        WHERE user_id = :user_id
                        AND product_id = :product_id
                        AND shop_id = :shop_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        // $data
        [
            "user_id" => $data['user_id'],
            "product_id" => $data['product_id'],
            "shop_id" => $data['shop_id'],
        ]
    );
    return $request->fetch();
}


function storeProductInCart(array $data)
{

    $existingProduct = checkIfProductExistInCarts($data);


    if ($existingProduct == false) {
        $query = "INSERT INTO carts (user_id, product_id, shop_id)
                        VALUES (:user_id, :product_id, :shop_id)";
        $request = connectToDatabase()->prepare($query);
        $request->execute($data);
    } else {
        $quantity = $existingProduct->quantity + 1;
        $query = "UPDATE carts SET quantity = :quantity
                            WHERE user_id = :user_id
                            AND product_id = :product_id
                            AND shop_id = :shop_id";
        $request = connectToDatabase()->prepare($query);
        $request->execute(
            [
                "user_id" => $data['user_id'],
                "product_id" => $data['product_id'],
                "shop_id" => $data['shop_id'],
                "quantity" => $quantity
            ]
        );
        return true;
    }

    return true;
}

// reduire nombre produit
function decrementProductInCart(array $data)
{

    //Vérifier si le produit existe dans le panier
    $existingProduct = checkIfProductExistInCarts($data);

    if ($existingProduct->quantity > 1) {
        $quantity = $existingProduct->quantity - 1;
        $query = "UPDATE carts SET quantity=:quantity 
                WHERE user_id=:user_id 
                AND product_id =:product_id
                AND shop_id = :shop_id";
        $request = connectToDatabase()->prepare($query);
        $request->execute([
            "user_id" => $data['user_id'],
            "product_id" => $data['product_id'],
            "shop_id" => $data['shop_id'],
            "quantity" => $quantity
        ]);
    } else {
        $query = "DELETE FROM carts WHERE  product_id=:product_id";
        $request = connectToDatabase()->prepare($query);
        $request->execute([
            "product_id" => $data['product_id'],
        ]);
    }

    return true;
}

// delete produit
function removeProductInCartById(array $data)
{
    $query = "DELETE FROM carts WHERE  id= :id AND user_id = :user_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute($data);
}

// recuperer les produit par id dans cart
function findProductByIdInCart(int $product_id)
{
    $query = "SELECT * FROM carts WHERE product_id = :product_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        ["product_id" => $product_id]
    );
    return $request->fetch();
}

// recuperer tous les produit dans cart
function findAllProductInCart(int $user_id)
{
    $query = "SELECT
    p.id AS product_id,
    p.name AS product_name,
    p.price AS product_price,
    p.quantity AS product_quantity,
    p.image AS product_image,
    c.quantity AS quantity_in_cart,
    c.id AS cart_id,
    s.id AS shop_id,
    s.name AS shop_name
FROM
    carts AS c
    INNER JOIN products AS p ON c.product_id = p.id
    INNER JOIN shops AS s ON s.id = p.shop_id
WHERE
    c.user_id = :user_id";

    $request = connectToDatabase()->prepare($query);
    $request->execute(
        [
            "user_id" => $user_id
        ]
    );
    return $request->fetchAll();
}

function findProductsInCartByShop(int $user_id, int $shop_id)
{
    $query = "SELECT
    p.id AS product_id,
    p.name AS product_name,
    p.price AS product_price,
    p.quantity AS product_quantity,
    p.image AS product_image,
    c.quantity AS quantity_in_cart,
    c.id AS cart_id,
    s.id AS shop_id,
    s.name AS shop_name
FROM
    carts AS c
    INNER JOIN products AS p ON c.product_id = p.id
    INNER JOIN shops AS s ON s.id = p.shop_id
WHERE
    c.user_id = :user_id
AND p.shop_id = :shop_id";

    $request = connectToDatabase()->prepare($query);
    $request->execute(
        [
            "user_id" => $user_id,
            "shop_id" => $shop_id
        ]
    );
    return $request->fetchAll();
}
