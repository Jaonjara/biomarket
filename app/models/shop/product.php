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
function findAllProduct(string | null $nameProduct)
{
    $shop_id = $_SESSION['shop']->id;
    if (is_null($nameProduct)) {

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
                        LEFT JOIN shops ON shops.id = products.shop_id
                        WHERE products.shop_id = $shop_id";

        $request = connectToDatabase()->prepare($query);
        $request->execute();
    } else {

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
                WHERE products.name LIKE :name";

        $request = connectToDatabase()->prepare($query);
        $request->execute(
            ["name" => "%{$nameProduct}%"]
        );
    }

    $data = $request->fetchAll();
    return $data;
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
function findProductShopById(int $id)
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
                WHERE products.id = :id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        ["id" => $id]
    );
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
