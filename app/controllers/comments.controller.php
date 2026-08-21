<?php
require_once PATH . "/app/models/comment.php";

// create comments
function storeCommentsController(int $product_id)
{
    $errors = [];

    $rating = $_POST['rating'] ?? null;
    if ($rating !== null) {
        $rating = $rating;
    }

    $user_id = $_SESSION['user']->id;

    $redirect_url = htmlspecialchars($_POST['redirect_url']) ?? "/produits";

    $contents = htmlspecialchars(trim($_POST['contents'])) ?? "";
    if (empty($contents)) {
        $errors['contents'] = "Entrez votre commentaire svp";
    }
    // var_dump($user_id, $product_id, $contents);
    if (!empty($errors)) {
        showProductController($product_id, $errors);
        return;
    }

    $data = [
        "user_id" => $user_id,
        "product_id" => $product_id,
        "contents" => $contents,
        "rating" => $rating
    ];
    storeComment($data);

    // redirectTo("/produits/{$product_id}");
    redirectTo("$redirect_url");
}

// remove products action
function removeCommentsController(int $id, int $product_id)
{
    removeCommentsById($id);
    // $_SESSION["delete-product"] = "Le produit est supprimée!";
    redirectTo("/produits/{$product_id}");
}
