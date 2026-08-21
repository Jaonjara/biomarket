<?php
require_once PATH . "/app/models/user.php";

function loginController(array $errors = [])
{
    if (isset($_SESSION["user"])) {
        redirectTo("/user/profile");
    }

    // var_dump($_SESSION["user"]);

    $title = "Connexion";
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/auth/login.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}

function checkAccountController()
{
    $errors = [];

    $email = htmlspecialchars(trim($_POST["email"])) ?? "";
    $password = htmlspecialchars(trim($_POST["password"])) ?? "";

    if (empty($email)) {
        $errors["email"] = "L'email est obligatoire!";
    }

    if (empty($password)) {
        $errors["password"] = "Le mot de passe est obligatoire!";
    }

    $userExist = findUserByEmail($email);

    //verifie email entré si il existe dans db
    if ($userExist === false) {
        $errors["email"] = "L'email ou mot de passe incorrect";
    }

    //verifie le password entré si dans db et le compare avec password hash
    if (password_verify($password, $userExist->password) === false) {
        $errors["password"] = "L'email ou mot de passe incorrect";
    }

    if (!empty($errors)) {
        loginController($errors);
        return;
    }

    // session profile_user
    $data = ["user_id" => $userExist->id];
    $profile_user = findInfoUserByUserId($data);

    // créer session user
    createSession("user", $userExist);
    // créer session shop
    $shop = findShopIdBySessionUser($userExist->id);
    // créer session profile
    createSession("profile_user", $profile_user);

    // créer session shop
    if ($shop != false) {
        $_SESSION['shop'] = $shop;
    }

    if ($userExist->role === "user") {
        redirectTo("user/profile");
        redirectTo("/");
    } elseif ($userExist->role === "admin") {
        redirectTo("/admin/dashboard");
    } else {
        redirectTo("/shop/dashboard");
    }
}


// logout
function logoutController()
{
    removeSession("user");
    redirectTo("/login");
}
