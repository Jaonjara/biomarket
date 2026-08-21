<?php
require_once PATH . "/database/database.php";

function findInfoUserByUserId(array $data)
{
    $query = "SELECT * FROM profile_user WHERE user_id = :user_id";
    $request = connectToDatabase()->prepare($query);
    $request->execute($data);
    return $request->fetch();
}

function storeProfileUser(array $data)
{

    $query = "INSERT INTO profile_user (user_id, image, phone, address, city) 
                    VALUES (:user_id, :image, :phone, :address, :city)";
    $request = connectToDatabase()->prepare($query);
    $request->execute($data);
    return true;
}
