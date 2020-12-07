<?php
session_start();
$error_message = ""; $error_message_email = ""; $error_message_password = "";
$action = filter_input(INPUT_GET, 'action');

if (isset($_SESSION['session_email'])) {
    $loggedIn = true;
    $type = $_SESSION['user_type'];
    $action = "loggedIn";
} else {
    $loggedIn = false;
    $type = "";
    $action = "login";
}


if ($action == null) {
    $action = "login";
}

switch ($action) {
    case "login":
        require("../model/database.php");
        
        $page = "login";
        include("../view/login_view.php");
        break;
    case "loggedIn":
        include("../errors/loggedIn.php");
        break;
    default:
        $error_message = "Error";
}