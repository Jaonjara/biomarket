<?php

//creer session
function createSession(string $key, mixed $value)
{
    return $_SESSION[$key] = $value;
}
// var_dump($_SESSION['user']);
function removeSession(string $key)
{
    session_destroy();
    unset($_SESSION[$key]);
}
