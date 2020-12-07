<?php
    $dsn = 'mysql:host=localhost;dbname=aum_db';
    $username = 'aum_admin';
    $password = 'aum_password';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>