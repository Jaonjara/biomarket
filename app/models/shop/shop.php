<?php

// create shop
function createShop(array $data)
{
    $query = "INSERT INTO shops (user_id, name, phone, description,address, photo, city)
VALUES (:user_id, :name, :phone, :description, :address, :photo, :city)";
    $request = connectToDatabase()->prepare($query);
    $request->execute($data);
    return true;
}


// recuperer le id du shop de user connecter
function findShopIdBySessionUser(int $user_id)
{
    $query = "SELECT * FROM shops WHERE user_id = :user_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        ["user_id" => $user_id]
    );
    return $request->fetch();
}

// recuperer tous les shop
function findAllShop()
{
    $query = "SELECT
                    shops.id,
                    shops.city,
                    shops.description,
                    shops.name,
                    shops.photo,
                    shops.address,
                    ROUND(AVG(comments.rating), 1) AS shop_avg_rating,
                    COUNT(comments.id) AS total_comments
                FROM shops
                LEFT JOIN products ON products.shop_id = shops.id
                LEFT JOIN comments ON comments.product_id = products.id
                GROUP BY shops.id
                ORDER BY shop_avg_rating DESC, shops.id DESC";
    $request = connectToDatabase()->prepare($query);
    $request->execute();
    return $request->fetchAll();
}


// function findShopById(int $id)
// {
//     $query = "SELECT DISTINCT
//                     shops.id,
//                     shops.address,
//                     shops.city,
//                     shops.createdAt,
//                     shops.description,
//                     shops.name,
//                     shops.phone,
//                     shops.photo,
//                     categories.name AS category_name,
//                     products.name AS product_name,
//                     products.price AS product_price,
//                     products.image AS product_image
//                 FROM
//                     shops
//                     INNER JOIN categories ON shops.id = categories.shop_id
//                     INNER JOIN products ON shops.id = products.shop_id
//                 WHERE
//                     shops.id = :id";
//     $request = connectToDatabase()->prepare($query);
//     $request->execute(
//         ["id" => $id]
//     );

//     return $request->fetchAll();
// };

// recuperer id de shop
function findShopById(int $id)
{
    $query = "SELECT * FROM shops WHERE id = :id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        ["id" => $id]
    );
    return $request->fetch();
}

// recuperer categories correspodant @ id du shop
function findCategoriesByShopId(int $shop_id)
{
    $query = "SELECT * FROM categories WHERE shop_id = :shop_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        ["shop_id" => $shop_id]
    );
    return $request->fetchAll();
}

// recuperer produit correspodant @ id du shop
function findProductsByShopId(int $shop_id)
{
    $query = "SELECT
    products.id,
    products.name AS product_name,
    products.image AS product_image,
    products.price AS product_price,
    products.quantity AS product_quantity,
    products.description AS product_description,
    categories.name AS category_name,
    COUNT(comments.id) AS nb_comments,
    ROUND(AVG(comments.rating), 1) AS avg_rating
FROM
    products
    LEFT JOIN categories ON categories.id = products.category_id
    LEFT JOIN comments ON comments.product_id = products.id
WHERE
    products.shop_id = :shop_id
    GROUP BY products.id
    ORDER BY avg_rating DESC, products.id DESC";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        ["shop_id" => $shop_id]
    );
    return $request->fetchAll();
}

// recuperer shop par id produit
function findProductByIdAndShopId(array $data)
{
    $query = "SELECT
    products.id,
    products.name AS product_name,
    products.image AS product_image,
    products.price AS product_price,
    products.quantity AS product_quantity,
    products.description AS product_description,
    products.shop_id,
    categories.name AS category_name
    
FROM
    products
    LEFT JOIN categories ON categories.id = products.category_id
WHERE
    products.id = :product_id
AND products.shop_id = :shop_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute($data);
    return $request->fetch();
}

// recuperer les moyenne de note et total commentaires
function shopRating(int $shop_id)
{
    $query = "SELECT 
                    ROUND(AVG(comments.rating), 1) AS shop_avg_rating,
                    COUNT(comments.id) AS total_comments
                    FROM comments
                    INNER JOIN products ON products.id = comments.product_id
                    WHERE products.shop_id = :shop_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "shop_id" => $shop_id
    ]);
    return $request->fetch();
}

// recuperer les produits en cas de filtre
function findProductsByShopIdAndCategoryId(int $shop_id, int $category_id)
{
    $query = "SELECT
    products.id,
    products.name AS product_name,
    products.image AS product_image,
    products.price AS product_price,
    products.quantity AS product_quantity,
    products.description AS product_description,
    categories.name AS category_name,
    COUNT(comments.id) AS nb_comments,
    ROUND(AVG(comments.rating), 1) AS avg_rating
FROM
    products
    LEFT JOIN categories ON categories.id = products.category_id
    LEFT JOIN comments ON comments.product_id = products.id
WHERE
    products.shop_id = :shop_id
AND products.category_id = :category_id
    GROUP BY products.id
    ORDER BY avg_rating DESC, products.id DESC";

    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "shop_id" => $shop_id,
        "category_id" => $category_id
    ]);
    return $request->fetchAll();
}
