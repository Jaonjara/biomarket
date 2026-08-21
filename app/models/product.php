<?php

require_once PATH . "/database/database.php";


// recuperer tous les produits
function findAllProducts()
{

    $query = "SELECT
                    products.id AS product_id,
                    products.name AS product_name,
                    products.image AS product_image,
                    products.price AS product_price,
                    products.quantity AS product_quantity,
                    products.description AS product_description,
                    products.shop_id,
                    categories.name AS category_name,
                    shops.name AS shop_name,
                    COUNT(comments.id) AS nb_comments,
                    ROUND(AVG(comments.rating), 1) AS avg_rating
                FROM
                    products
                    LEFT JOIN categories ON categories.id = products.category_id
                    LEFT JOIN shops ON shops.id = products.shop_id
                    LEFT JOIN comments ON comments.product_id = products.id
                    GROUP BY products.id
                    ORDER BY avg_rating DESC, products.id DESC";
    $request = connectToDatabase()->prepare($query);
    $request->execute();
    return $request->fetchAll();
}

function findAllCategories()
{
    $query = "SELECT DISTINCT categories.id AS category_id,
                            categories.name AS category_name
                            -- products.id AS product_id
                            FROM categories
                            INNER JOIN products ON categories.id = products.category_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute();
    return $request->fetchAll();
}

// recherche produit
function searchProduct(string | null $searchproduct)
{
    $query = "SELECT    products.id AS product_id,
                        products.name AS product_name,
                        products.image AS product_image,
                        products.price AS product_price,
                        products.quantity AS product_quantity,
                        products.description AS product_description,
                        products.shop_id,
                        categories.name AS category_name,
                        shops.name AS shop_name,
                        COUNT(comments.id) AS nb_comments,
                        ROUND(AVG(comments.rating), 1) AS avg_rating                      
                        FROM products
                        LEFT JOIN categories ON categories.id = products.category_id
                        LEFT JOIN shops ON shops.id = products.shop_id
                        LEFT JOIN comments ON comments.product_id = products.id
                        WHERE products.name LIKE :searchproduct
                        OR products.description LIKE :searchproduct
                        OR categories.name LIKE :searchproduct
                        OR shops.name LIKE :searchproduct
                        GROUP BY products.id
                        ORDER BY avg_rating DESC, products.id DESC";

    $request = connectToDatabase()->prepare($query);
    $request->execute(
        [
            "searchproduct" => "%{$searchproduct}%"
        ]
    );

    return $request->fetchAll();
}

// recuperer produits selon sa categorie
function findAllProductsByCategoryId(int $category_id)
{
    $query = "SELECT products.id AS product_id,
                    products.name AS product_name,
                    products.image AS product_image,
                    products.price AS product_price,
                    products.quantity AS product_quantity,
                    categories.name AS category_name,
                    products.description AS product_description,
                    COUNT(comments.id) AS nb_comments,
                    ROUND(AVG(comments.rating), 1) AS avg_rating                  
                    FROM products
                    LEFT JOIN categories ON categories.id = products.category_id
                    LEFT JOIN comments ON comments.product_id = products.id
                    WHERE category_id = :category_id
                    GROUP BY products.id
                    ORDER BY avg_rating DESC, products.id DESC";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        [
            "category_id" => $category_id
        ]
    );
    return $request->fetchAll();
}

// recuperer produits selon id
function findProductById(int $product_id)
{
    $query = "SELECT DISTINCT
                    products.id AS product_id,
                    products.name AS product_name,
                    products.image AS product_image,
                    products.price AS product_price,
                    products.quantity AS product_quantity,
                    products.description AS product_description,
                    products.shop_id,
                    categories.name AS category_name,
                    shops.name AS shop_name
                FROM
                    products
                    LEFT JOIN categories ON categories.id = products.category_id
                    LEFT JOIN shops ON shops.id = products.shop_id
                    WHERE products.id = :product_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        [
            ":product_id" => $product_id
        ]
    );
    return $request->fetch();
}
