<?php

function connectToDatabase()
{
    $instance = null;

    try {

        $instance = new PDO(
            "mysql:host=localhost;
            dbname=biomarket",
            "root",
            ""
        );

        // echo "réussi";
        $instance->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        $instance->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_OBJ
        );
    } catch (PDOException $e) {
        $e->getMessage();
    }

    return $instance;
}
