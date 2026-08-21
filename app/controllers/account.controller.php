<?php
require_once PATH . "/app/models/profile_user.php";

function profileUserController()
{
    if (!isset($_SESSION["user"])) {
        redirectTo("/login");
    }

    $title = "{$_SESSION['user']->name}";
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/account/profile.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}

function userInformationController()
{
    $user_id = $_SESSION['user']->id;

    $data = ["user_id" => $user_id];

    $infoUser = findInfoUserByUserId($data);
    // var_dump($info);
    $title = "{$_SESSION['user']->name}";
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/account/profile.html.php";
    require_once PATH . "/views/pages/account/information.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}

// page create profil
function createInformationController($errors = [])
{
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/account/profile.html.php";
    require_once PATH . "/views/pages/account/create-information.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}

function storeInformationController()
{
    $errors = [];

    $user_id = $_SESSION['user']->id;
    $image = $_FILES['image'];
    $phone = htmlspecialchars(trim($_POST['phone'])) ?? "";
    $address = htmlspecialchars(trim($_POST['address'])) ?? "";
    $city = htmlspecialchars(trim($_POST['city'])) ?? "";

    $extension_autorise = [
        'png',
        'jpg',
        'jpeg',
        'gif'
    ];

    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $correctName = uniqid() . "-" . mt_rand(1000, 4520000) . "." . $extension;
    $size_img = 2097152;


    if ($image['name'] === "") {
        $errors['image'] = "L'image est requis!!";
    } elseif ($image['error'] !== 0) {
        $errors['image'] = "Vérifier votre fichier";
    } elseif (!in_array($extension, $extension_autorise)) {
        $errors['image'] = "Les extenssion requis sont seulement(png,jpg,jpeg,gif)";
    } elseif ($image['size'] > $size_img) {
        $errors['image'] = "L'images doit etre inférieur à 2Mo!";
    }

    if (empty($phone)) {
        $errors['phone'] = "Le phone est requis!!";
    }

    if (empty($address)) {
        $errors['address'] = "L'addresse est requis!!";
    }

    if (empty($city)) {
        $errors['city'] = "Le city est requis!!";
    }

    if (!empty($errors)) {
        createInformationController($errors);
        return;
    }


    $pathImage = PATH . "/public/uploads/images/user/" . $correctName;
    $fullPathImage = "/uploads/images/user/" . $correctName;

    move_uploaded_file(
        $image["tmp_name"],
        $pathImage
    );

    $data = [
        "user_id" =>  $user_id,
        "image" =>  $fullPathImage,
        "phone" =>  $phone,
        "address" =>  $address,
        "city" =>  $city
    ];

    // insert db
    storeProfileUser($data);

    // créer session profile_user
    $profile_user = findInfoUserByUserId([
        "user_id" => $user_id
    ]);
    createSession("profile_user", $profile_user);
    redirectTo("/user/profile/informations");
}

// page order
// function userOrderController()
// {
//     $title = "{$_SESSION['user']->name}";
//     require_once PATH . "/views/layouts/header.html.php";
//     require_once PATH . "/views/pages/account/profile.html.php";
//     require_once PATH . "/views/pages/account/order.html.php";
//     require_once PATH . "/views/layouts/footer.html.php";
// }
