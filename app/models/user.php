<?php
require_once PATH . "/database/database.php";

// register
function createNewUser(array $data)
{

    $query = "INSERT INTO users (name, firstname, email, password)
                VALUE (:name, :firstname, :email, :password)";

    $request = connectToDatabase()->prepare($query);
    $request->execute($data);
    return true;
}

// recperer user par email
function findUserByEmail(string $email)
{
    $query = "SELECT * FROM users WHERE email = :email";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        ["email" => $email]
    );
    return $request->fetch();
}


// update role
function updateRoleUser(int $user_id)
{
    $query = "UPDATE users SET role = 'seller' WHERE id = :id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        [
            "id" => $user_id
        ]
    );
    return true;
}
