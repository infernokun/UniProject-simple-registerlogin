<?php

$studentID = filter_input(INPUT_POST, "studentID");
$instructorID = filter_input(INPUT_POST, "instructorID");
$firstName = filter_input(INPUT_POST, "firstName");
$lastName = filter_input(INPUT_POST, "lastName");
$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
$pass = filter_input(INPUT_POST, "password");
$passwordConfirm = filter_input(INPUT_POST, "passwordConfirm");
$instructorCode = filter_input(INPUT_POST, "instructorCode");
$isInstructor = filter_input(INPUT_POST, "isInstructor");
$gender = filter_input(INPUT_POST, "gender");
$type = "";

$error_message_firstName = "";
$error_message_lastName = "";
$error_message_email = "";
$error_message_password = "";
$error_message_gender = "";
$error_message_passwordConfirm = "";
$error_message_instructorCode = "";

$code = "ABC123";

if ($firstName == null || $lastName == null || $email == null || $email == false ||
        $pass == null || $gender == null || $pass != $passwordConfirm) {

    if ($email == null || $email == false) {
        $error_message_email = "Email does not meet the requirements!";
    }
    if ($gender == "") {
        $error_message_gender = "Choose a gender!";
    }
    if ($pass != $passwordConfirm) {
        $error_message_passwordConfirm = "Passwords do not match!";
    } else if ($pass == "") {
        $error_message_password = "Password does not meet the requirements!";
    }
    if ($firstName == null) {
        $error_message_firstName = "Must have first name!";
    }
    if ($lastName == null) {
        $error_message_lastName = "Must have last name!";
    }

    include("../view/register_view.php");
} else {
    if ($isInstructor) {
        if ($instructorCode != $code) {
            $error_message_instructorCode = "Instructor code is invalid!";
            include("../view/register_view.php");
        } else {
            require("database.php");

            $query = 'INSERT INTO instructor
                 (instructorID, firstName, lastName, email, pass, gender, birthday)
              VALUES
                 (instructorID, :firstName, :lastName, :email, :pass, :gender, :birthday)';
            $statement = $db->prepare($query);
            $statement->bindValue(':firstName', $firstName);
            $statement->bindValue(':lastName', $lastName);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':pass', $pass);
            $statement->bindValue(':gender', $gender);
            $statement->bindValue(':birthday', null);
            $statement->execute();
            $statement->closeCursor();
            
            $type = "Instructor";

            include('../register/register_success.php');
        }
    } else {
        include("database.php");

        $query = 'INSERT INTO student
                 (studentID, firstName, lastName, email, pass, gender, birthday)
              VALUES
                 (studentID, :firstName, :lastName, :email, :pass, :gender, :birthday)';
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':pass', $pass);
        $statement->bindValue(':gender', $gender);
        $statement->bindValue(':birthday', null);
        $statement->execute();
        $statement->closeCursor();
        
        $type = "Student";

        include('../register/register_success.php');
    }
}
    
    