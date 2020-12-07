<?php
session_start();
$error_message = "";

$error_message_firstName = ""; $error_message_lastName = ""; $error_message_email = ""; $error_message_password = "";
$error_message_gender = ""; $error_message_passwordConfirm = ""; $error_message_instructorCode = "";

require("../model/database.php");

$action = filter_input(INPUT_GET, 'action');

if (isset($_SESSION['session_email'])) {
    $loggedIn = true;
    $type = $_SESSION['user_type'];
    $action = "loggedIn";
} else {
    $loggedIn = false;
    $type = "";
}

if ($action == null) {
    $action = "register";
}

switch ($action) {
    case "register":
        $page = "register";
        include("../view/register_view.php");
        break;
    case "loggedIn":
        include("../errors/loggedIn.php");
        break;
    default:
        $error_message = "Error";
}