<?php
require_once PATH . "/app/models/user.php";

//page
function registerController($errors = [])
{
    // var_dump($errors);
    $title = "Inscription";
    require_once PATH . "/views/layouts/header.html.php";
    require_once PATH . "/views/pages/auth/register.html.php";
    require_once PATH . "/views/layouts/footer.html.php";
}

// logic
function createAccountController()
{

    $errors = [];

    $name = htmlspecialchars(trim($_POST["name"])) ?? "";
    $firstname = htmlspecialchars(trim($_POST["firstname"])) ?? "";
    $email = htmlspecialchars(trim($_POST["email"])) ?? "";
    $password = htmlspecialchars(trim($_POST["password"])) ?? "";
    $password_confirm = htmlspecialchars(trim($_POST["password_confirm"])) ?? "";

    if (empty($name)) {
        $errors["name"] = "Le nom est requis";
    } elseif (strlen($name) < 2) {
        $errors["name"] = "Le nom doit contenir au moins 2 caractères";
    } elseif (strlen($name) > 25) {
        $errors["name"] = "Le nom est ne doit pas dépasser 25 caractères";
    }

    if (empty($firstname)) {
        $errors["firstname"] = "Le prénom est requis";
    } elseif (strlen($firstname) < 2) {
        $errors["firstname"] = "Le prénom doit contenir au moins 2 caractères";
    } elseif (strlen($firstname) > 25) {
        $errors["firstname"] = "Le prénom est ne doit pas dépasser 25 caractères";
    }

    if (empty($email)) {
        $errors["email"] = "L'email est requis";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "L'email est n'est pas valide";
    } elseif (findUserByEmail($email) !== false) {
        $errors["name"] = "Cet email est déjà utilisé!";
    }

    if (empty($password)) {
        $errors["password"] = "Le mot de pass est requis";
    } elseif (strlen($password) < 8) {
        $errors["password"] = "Le mot de passe doit contenir au moins 9 caractères";
    } elseif ($password !== $password_confirm) {
        $errors["password"] = "Le mot de pass ne correspond pas";
    }

    if (empty(trim($password_confirm))) {
        $errors["password_confirm"] = "Vous devez confirmez le mot de pass!";
    }

    if (!empty($errors)) {
        registerController($errors);
        return;
    }

    $data = [
        "name" => $name,
        "firstname" => $firstname,
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT)
    ];

    createNewUser($data);
    echo "Mety";
}
