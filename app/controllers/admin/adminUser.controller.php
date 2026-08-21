<?php
require_once PATH . "/app/models/admin/user.php";

//page create user
function createUserAdminController($errors = [])
{
    $nameUser = null;
    // $userWithoutadmins = findRoleUserAndSellerOnly();
    $users = findAllUsers($nameUser);
    // var_dump($errors);
    $title = "Nouveau utilisateur";
    require_once PATH . "/views/admin/layouts/sidebar.html.php";
    require_once PATH . "/views/admin/users/create.html.php";
    require_once PATH . "/views/admin/layouts/footer.html.php";
}

// action create
function createUserActionController()
{

    $errors = [];
    $role = $_POST['role'] ?? "";
    $name = htmlspecialchars(trim($_POST["name"])) ?? "";
    $firstname = htmlspecialchars(trim($_POST["firstname"])) ?? "";
    $email = htmlspecialchars(trim($_POST["email"])) ?? "";
    $password = htmlspecialchars(trim($_POST["password"])) ?? "";
    $password_confirm = htmlspecialchars(trim($_POST["password_confirm"])) ?? "";

    // $roleWhoutInDb = findAllCategoryShop($nameCategory);
    $userWithoutadmins = findRoleUserAndSellerOnly();

    $usersRole = [];

    foreach ($userWithoutadmins as $c) {
        array_push($usersRole, $c->role);
    }

    if (empty($role)) {
        $errors["role"] = "Sélectionner votre rôle!!";
    } elseif (!in_array($role, $usersRole)) {
        $errors["role"] = "Le rôle est invalide!!";
    }


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
        createUserAdminController($errors);
        return;
    }

    $data = [
        "role" => $role,
        "name" => $name,
        "firstname" => $firstname,
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT)
    ];

    storeUser($data);
    $_SESSION["create"] = "Le compte a été crée!!";
    redirectTo('/admin/users/create');
}



// page list user et recherche
function adminUsersController()
{
    $nameUser = null;

    if (isset($_GET['name'])) {
        $nameUser = $_GET['name'];
    }

    $users = findAllUsers($nameUser);
    $count = usersCount();

    $title = "Utilisateurs";
    require_once PATH . "/views/admin/layouts/sidebar.html.php";
    require_once PATH . "/views/admin/users/list.html.php";
    require_once PATH . "/views/admin/layouts/footer.html.php";
}

// delete user action controller
function removeUserController(int $id)
{
    removeUserById($id);
    $_SESSION["delete-user"] = "L'utilisateur a été supprimé!";
    redirectTo('/admin/users');
}
