<?php

require_once PATH . "/database/database.php";

// create
function shopStoreCategory(array $data)
{
    $query = "INSERT INTO categories (shop_id, name, description)
                VALUES (:shop_id, :name, :description)";

    $request = connectToDatabase()->prepare($query);
    $request->execute($data);
    return true;
}
// recuperation des categories et recherche categorie
// function findAllCategoryShop(string | null $nameCategory)
// {
//     $shop_id = $_SESSION['shop']->id;
//     if (is_null($nameCategory)) {
//         $query = "SELECT categories.id,
//                         categories.name,
//                         categories.description,
//                         categories.createdAt,
//                         COUNT(products.id) AS nb_product,
//                         shops.name AS shop_name
//                         FROM categories AS categories
//                         LEFT JOIN products AS products ON categories.id = products.category_id
//                         LEFT JOIN shops ON shops.id = categories.shop_id
//                         WHERE categories.shop_id = $shop_id
//                         GROUP BY categories.id, categories.name, categories.description, categories.createdAt";
//         $request = connectToDatabase()->prepare($query);
//         $request->execute();
//     } else {
//         $query = "SELECT    categories.id,
//                             categories.name,
//                             categories.description,
//                             categories.createdAt,
//                             COUNT(products.id) AS nb_product
//                     FROM categories AS categories
//                     LEFT JOIN products AS products ON categories.id = products.category_id
//                     WHERE categories.name LIKE :name
//                     GROUP BY categories.id, categories.name, categories.description, categories.createdAt";
//         $request = connectToDatabase()->prepare($query);
//         $request->execute(
//             ["name" => "%{$nameCategory}%"]
//         );
//     }
//     $data = $request->fetchAll();
//     return $data;
// };

// recuperer les categories par shop
function findAllCategoriesByShopId(int $shop_id)
{
    $query = "SELECT categories.id,
                   categories.name,
                   categories.description,
                   categories.createdAt,
                   COUNT(products.id) AS nb_product
              FROM categories AS categories
              LEFT JOIN products AS products ON categories.id = products.category_id
              WHERE categories.shop_id = :shop_id
              GROUP BY categories.id, categories.name, categories.description, categories.createdAt
              ORDER BY categories.id DESC";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "shop_id" => $shop_id
    ]);
    return $request->fetchAll();
}

// recherche category
function searchCategoryByShop(int $shop_id, string | null $searchCategory)
{
    $query = "SELECT    categories.id,
                        categories.name,
                        categories.description,
                        categories.createdAt,
                        COUNT(products.id) AS nb_product
                     FROM categories AS categories
                     LEFT JOIN products AS products ON categories.id = products.category_id
                     WHERE categories.shop_id = :shop_id
                     AND categories.name LIKE :searchCategory
                     GROUP BY categories.id, categories.name, categories.description, categories.createdAt
                     ORDER BY categories.id DESC";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "shop_id" => $shop_id,
        "searchCategory" => "%{$searchCategory}%"
    ]);
    return $request->fetchAll();
}



// delete 
function removeCategoryShopById(int $id)
{
    $query = "DELETE FROM categories WHERE id = :id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        [
            "id" => $id
        ]
    );
    return true;
}

// recuperer category par id
function findCategoryShopById(int $id)
{
    $query = "SELECT * FROM categories WHERE id = :id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        ["id" => $id]
    );
    return $request->fetch();
}


// update
function updateCategory(array $data)
{
    $query = "UPDATE categories SET name=:name, description=:description
                WHERE id=:id";
    $request = connectToDatabase()->prepare($query);
    $request->execute($data);
}

// compter category
function categoryCount(int $shop_id)
{
    $query = "SELECT COUNT(id) AS total_category 
                    FROM categories
                    WHERE shop_id = :shop_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "shop_id" => $shop_id
    ]);
    return $request->fetch();
}


// compter produit associé
function countProductInCategoryByShop(int $shop_id)
{
    $query = "SELECT COUNT(products.id) AS total_product 
                    FROM products AS products
                    INNER JOIN categories AS categories ON categories.id = products.category_id
                    WHERE categories.shop_id = :shop_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "shop_id" => $shop_id
    ]);
    return $request->fetch();
}
