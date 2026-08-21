<?php
require_once PATH . "/database/database.php";

function storeComment(array $data)
{
    $query = "INSERT INTO comments (user_id, product_id, contents, rating)
                    VALUES (:user_id, :product_id, :contents, :rating)";
    $request = connectToDatabase()->prepare($query);
    $request->execute($data);
    return true;
}

function findAllCommentsByProductId(int $product_id)
{
    $query = "SELECT comments.id AS comments_id,
                    comments.contents,
                    comments.user_id,
                    comments.product_id,
                    comments.createdAt,
                    users.id AS user_id,
                    users.name AS user_name
                FROM comments
                INNER JOIN users ON users.id = comments.user_id
                INNER JOIN products ON products.id = comments.product_id
                WHERE comments.product_id = :product_id
                ORDER BY createdAt DESC";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "product_id" => $product_id
    ]);
    return $request->fetchAll();
}

// delete 
function removeCommentsById(int $id)
{
    $query = "DELETE FROM comments WHERE id = :id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        [
            "id" => $id
        ]
    );
    // var_dump($id);
    return true;
}

// compter commentaire et moyenne de note
function countCommentsByProductsId(int $product_id)
{
    $query = "SELECT COUNT(*) AS total,
                    FROM comments
                    WHERE product_id = :product_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute([
        "product_id" => $product_id
    ]);
    $request->fetch()->total;
}
