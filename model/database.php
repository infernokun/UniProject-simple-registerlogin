<?php
    $dsn = 'mysql:host=us-cdbr-east-03.cleardb.com;dbname=heroku_1a36e5c5f5ecb77';
    $username = 'b14ae626e4c908';
    $password = '853192af';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>