<?php

    //DADOS DE CONEXÃO DO BD
    $host = "localhost";
    $db_name = "task";
    $username = "root";
    $password = "";

    //CONNECTION FACTORY
    try {
        $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
    }

    //CONNECTION ERROR HANDLER
    catch(PDOException $exception){
        echo "Connection error: " . $exception->getMessage();
    }
?>