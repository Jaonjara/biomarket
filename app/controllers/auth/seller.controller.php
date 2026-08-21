<?php
require_once PATH . "/app/models/user.php";
require_once PATH . "/app/models/shop/shop.php";

function sellerController($errors = [])
{
    $title = "Devenir un vendeur";
    require_once PATH . "/views/pages/auth/seller.html.php";
}

function becomeSellerController()
{
    $errors = [];

    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']->id;
    }

    $name = htmlspecialchars(trim($_POST['name'])) ?? "";
    $phone = htmlspecialchars(trim($_POST['phone'])) ?? "";
    $description = htmlspecialchars(trim($_POST['description'])) ?? "";
    $address = htmlspecialchars(trim($_POST['address'])) ?? "";
    $city = htmlspecialchars(trim($_POST['city'])) ?? "";
    $photo = $_FILES['photo'];

    if (empty($name)) {
        $errors['name'] = "Le nom est requis";
    } elseif (strlen($name) < 2) {
        $errors['name'] = "Le nom est doit contenir au moins 2 caractères";
    }

    if (empty($description)) {
        $errors['description'] = "Le description est requis";
    } elseif (strlen($description) < 2) {
        $errors['description'] = "Le description est doit contenir au moins 2 caractères";
    }

    if (empty($phone)) {
        $errors['phone'] = "Le numero de téléphone est requis";
    } elseif (strlen($phone) < 10 || strlen($phone) > 15) {
        $errors['phone'] = "Le numero de téléphone est entre 10 à 15 chiffres";
    } elseif (strlen($phone) < 0) {
        $errors['phone'] = "Le numero de téléphone est doit être positif";
    }

    if (empty($city)) {
        $errors['city'] = "La ville est requis";
    }

    if (empty($address)) {
        $errors['address'] = "L'addresse est requis";
    }

    $extensionImageAutoriser = [
        'png',
        'jpg',
        'jpeg',
        'gift'
    ];

    $extension = pathinfo($photo['name'], PATHINFO_EXTENSION);

    $correctName = uniqid() . mt_rand(60000, 9964120) . '.' . $extension;

    $sizeImg = 2097152;

    if ($photo['name'] === "") {
        $errors['photo'] = "L'image est requis";
    } elseif ($photo['error'] !== 0) {
        $errors['photo'] = "Veuillez vérifier votre fichier";
    } elseif ($photo['size'] > $sizeImg) {
        $errors['photo'] = "Votre image doit être inférieur à 2Mo";
    } elseif (!in_array($extension, $extensionImageAutoriser)) {
        $errors["photo"] = "Les extensions requis sont seulement (png, jpg, jpeg, gif)!";
    }

    if (!empty($errors)) {
        sellerController($errors);
        return;
    }

    $pathImage = PATH . "/public/uploads/images/shop/" . $correctName;
    $fullPathimage = "/uploads/images/shop/" . $correctName;

    move_uploaded_file(
        $photo['tmp_name'],
        $pathImage
    );

    $data = [
        "user_id" => $user_id,
        "name" => $name,
        "description" => $description,
        "address" => $address,
        "photo" => $fullPathimage,
        "city" => $city,
        "phone" => $phone
    ];

    // creer shop
    createShop($data);

    // update role
    updateRoleUser($user_id);

    redirectTo('/seller');
}
