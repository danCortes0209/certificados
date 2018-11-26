<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'certificados';

    try {
        $conexion = new PDO("mysql:host=$server;dbname=$database",$username,$password);
    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
?>