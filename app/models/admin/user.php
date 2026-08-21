<?php
require_once PATH . '/database/database.php';

// requte recuperer 2 role only user et seller
function findRoleUserAndSellerOnly()
{
    $query = "SELECT DISTINCT role FROM users WHERE role != 'admin'";
    $request = connectToDatabase()->prepare($query);
    $request->execute();
    $data = $request->fetchAll();
    return $data;
}

// requette recuperer vendeur seulement
function findUserSellerOnly()
{
    $query = "SELECT * FROM users WHERE role = 'seller'";
    $request = connectToDatabase()->prepare($query);
    $request->execute();
    $data = $request->fetchAll();
    return $data;
}


// create users
function storeUser(array $data)
{

    $query = "INSERT INTO users (role, name, firstname, email, password)
                VALUE (:role, :name, :firstname, :email, :password)";

    $request = connectToDatabase()->prepare($query);
    $request->execute($data);
    return true;
}


// recuperer all users
function findAllUsers(string | null $nameUser)
{

    if (is_null($nameUser)) {
        $query = "SELECT * FROM users";
        $request = connectToDatabase()->prepare($query);
        $request->execute();
    } else {
        $query = "SELECT * FROM users WHERE name LIKE :name
                        OR firstname LIKE :name";
        $request = connectToDatabase()->prepare($query);
        $request->execute(
            ["name" => "%{$nameUser}%"]
        );
    }

    $data = $request->fetchAll();
    return $data;
}

// compter user
function usersCount()
{
    $query = "SELECT COUNT(*) AS count_users FROM users";
    $request = connectToDatabase()->prepare($query);
    $request->execute();
    return $request->fetch();
}

// recuperer id user
function findUserById(int $id)
{
    $query = "SELECT * FROM users WHERE id = :id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        ["id" => $id]
    );
    return $request->fetch();
}

// delete
function removeUserById(int $id)
{
    $query = "DELETE FROM users WHERE id = :id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        ["id" => $id]
    );
    return true;
}

/*****************************************************************************************************
 * ****************************************** SELLERS ***********************************************
 ****************************************************************************************************/


// delete seller
function removeSellerById(int $id)
{
    $query = "DELETE FROM users WHERE id = :id";
    $request = connectToDatabase()->prepare($query);
    $request->execute(
        ["id" => $id]
    );
    return true;
}

// compter user
function sellerCount()
{
    $query = "SELECT COUNT(*) AS count_sellers FROM users WHERE role = 'seller'";
    $request = connectToDatabase()->prepare($query);
    $request->execute();
    return $request->fetch();
}
