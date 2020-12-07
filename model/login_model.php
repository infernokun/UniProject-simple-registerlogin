<?php

$email = filter_input(INPUT_POST, "email");
$pass = filter_input(INPUT_POST, "password");

$error_message_email = "";
$error_message_password = "";

session_start();

if (isset($_SESSION['session_email'])) {
    $loggedIn = true;
    $type = $_SESSION['user_type'];
    include("../errors/loggedIn.php");
}


if ($email == null || $email == false || $pass == null) {
    if ($email == null || $email == false) {
        $error_message_email = "Not a valid email!";
    }
    if ($pass == "") {
        $error_message_password = "Enter a password!";
    }

    include("../view/login_view.php");
} else {
    require("database.php");

    $foundStudent = findStudent($email);
    $foundInstructor = findInstructor($email);

    if ($foundStudent == null && $foundInstructor == null) {
        $error_message_email = "Email not found!";
        include("../view/login_view.php");
    } else {
        $person = null;
        if ($foundStudent != null) {
            $person = $foundStudent[0];
            $type = "student";
            $_SESSION['session_id'] = $person['studentID'];
        } else {
            $person = $foundInstructor[0];
            $type = "instructor";
            $_SESSION['session_id'] = $person['instructorID'];
        }

        if ($pass == $person['pass']) {
            $_SESSION['session_email'] = $email;
            $_SESSION['user_type'] = $type;

            include("../login/login_success.php");
        } else {
            $error_message_password = "Wrong password!";
            include("../view/login_view.php");
        }
    }
}

function findStudent($email) {
    global $db;
    $query = "SELECT * FROM student where email = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $found = $statement->fetchAll();
    $statement->closeCursor();

    return $found;
}

function findInstructor($email) {
    global $db;
    $query = "SELECT * FROM instructor where email = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $found = $statement->fetchAll();
    $statement->closeCursor();

    return $found;
}
