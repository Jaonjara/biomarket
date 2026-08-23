<?php

require_once PATH . "/database/database.php";

// create
function storeProductInDatabase(array $data)
{
    $query = "INSERT INTO products (category_id, shop_id, name, description, image, price, quantity)
                    VALUES (:category_id, :shop_id, :name, :description, :image, :price, :quantity)";
    $request = connectToDatabase()->prepare($query);
    $request->execute($data);
    return true;
}

// recuperer produit avec category correspondant et recherche
// function findAllProduct(string | null $nameProduct)
// {
//     $shop_id = $_SESSION['shop']->id;
//     if (is_null($nameProduct)) {
//         $query = "SELECT products.id,
//                         products.category_id,
//                         products.name,
//                         products.description,
//                         products.image,
//                         products.price,
//                         products.quantity,
//                         products.createdAt,
//                         categories.name AS category_name
//                         FROM products
//                         LEFT JOIN categories ON categories.id = products.category_id
//                         LEFT JOIN shops ON shops.id = products.shop_id
//                         WHERE products.shop_id = $shop_id";
//         $request = connectToDatabase()->prepare($query);
//         $request->execute();
//     } else {
//         $query = "SELECT products.id,
//                         products.category_id,
//                         products.name,
//                         products.description,
//                         products.image,
//                         products.price,
//                         products.quantity,
//                         products.createdAt,
//                         categories.name AS category_name
//                 FROM products
//                 LEFT JOIN categories ON categories.id = products.category_id
//                 WHERE products.name LIKE :name";
//         $request = connectToDatabase()->prepare($query);
//         $request->execute(
//             ["name" => "%{$nameProduct}%"]
//         );
//     }

//     $data = $request->fetchAll();
//     return $data;
// }

// recuperer les produits du shop
function findAllProductsByShopId(int $shop_id)
{
    $query = "SELECT products.id,
                     products.category_id,
                     products.name,
                     products.description,
                     products.image,
                     products.price,
                     products.quantity,
                     products.createdAt,
                     categories.name AS category_name
                     FROM products
                     LEFT JOIN categories ON categories.id = products.category_id
                     WHERE products.shop_id = :shop_id
                     ORDER BY products.id DESC";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "shop_id" => $shop_id
    ]);

    return $request->fetchAll();
}

// recherche produit
function searchProductByShop(int $shop_id, string | null $searchproduct)
{
    $query = "SELECT products.id,
                     products.category_id,
                     products.name,
                     products.description,
                     products.image,
                     products.price,
                     products.quantity,
                     products.createdAt,
                     categories.name AS category_name
             FROM products
             LEFT JOIN categories ON categories.id = products.category_id
             WHERE products.shop_id = :shop_id 
             AND (products.name LIKE :searchproduct
             OR products.description LIKE :searchproduct
            OR categories.name LIKE :searchproduct)
            ORDER BY products.id DESC";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        [
            "shop_id" => $shop_id,
            "searchproduct" => "%{$searchproduct}%"
        ]
    );
    return $request->fetchAll();
}

// delete 
function removeProductShopById(int $id)
{
    $query = "DELETE FROM products WHERE id = :id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        [
            "id" => $id
        ]
    );
    return true;
}

// recuperer product par id
function findProductShopById(int $id, int $shop_id)
{
    $query = "SELECT products.id,
                    products.category_id,
                    products.name,
                    products.description,
                    products.image,
                    products.price,
                    products.quantity AS product_quantity,
                    products.createdAt,
                    categories.name AS category_name,
                    shops.id AS shop_id,
                    shops.name AS shop_name
                FROM products
                INNER JOIN categories ON categories.id = products.category_id
                INNER JOIN shops ON shops.id = products.shop_id
                WHERE products.id = :id
                AND products.shop_id = :shop_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "id" => $id,
        "shop_id" => $shop_id
    ]);
    return $request->fetch();
}


// update
function shopUpdateProduct(array $data)
{
    $query =   "UPDATE products
                SET 
                    category_id = :category_id,
                    name = :name,
                    description = :description,
                    image = :image,
                    price = :price,
                    quantity = :quantity
                WHERE id = :id";
    $request = connectToDatabase()->prepare($query);
    $request->execute($data);
    return true;
}

// compter product
function productCount(int $shop_id)
{
    $query = "SELECT COUNT(id) AS total_product 
                    FROM products
                    WHERE shop_id = :shop_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "shop_id" => $shop_id
    ]);
    return $request->fetch();
}
