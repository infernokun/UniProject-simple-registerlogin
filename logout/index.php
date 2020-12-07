<?php

$action = filter_input(INPUT_GET, 'action');

if ($action == null) {
    $action = "logout";
}

switch ($action) {
    case "logout":
        include("../model/logout_model.php");
    default:
        $error_message = "Error";
}