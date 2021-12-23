<?php

function conectarBanco()
{
    $host = "localhost";
    $dbname = "chat";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        return $conn;
    } catch (\Throwable $th) {
        throw $th;
    }
};
