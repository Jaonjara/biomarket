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
function findAllCategoryShop(string | null $nameCategory)
{
    $shop_id = $_SESSION['shop']->id;
    if (is_null($nameCategory)) {
        $query = "SELECT categories.id,
                        categories.name,
                        categories.description,
                        categories.createdAt,
                        COUNT(products.id) AS nb_product,
                        shops.name AS shop_name
                        FROM categories AS categories
                        LEFT JOIN products AS products ON categories.id = products.category_id
                        LEFT JOIN shops ON shops.id = categories.shop_id
                        WHERE categories.shop_id = $shop_id
                        GROUP BY categories.id, categories.name, categories.description, categories.createdAt";
        $request = connectToDatabase()->prepare($query);
        $request->execute();
    } else {
        $query = "SELECT    categories.id,
                            categories.name,
                            categories.description,
                            categories.createdAt,
                            COUNT(products.id) AS nb_product
                    FROM categories AS categories
                    LEFT JOIN products AS products ON categories.id = products.category_id
                    WHERE categories.name LIKE :name
                    GROUP BY categories.id, categories.name, categories.description, categories.createdAt";
        $request = connectToDatabase()->prepare($query);
        $request->execute(
            ["name" => "%{$nameCategory}%"]
        );
    }

    $data = $request->fetchAll();
    return $data;
};

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
