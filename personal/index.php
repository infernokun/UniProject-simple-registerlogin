<?php

session_start();
require("../model/student_model.php");

$action = filter_input(INPUT_POST, 'action');

$error_message_firstName = "";
$error_message_lastName = "";
$error_message_email = "";
$error_message_password = "";
$error_message_gender = "";
$error_message_passwordNew = "";
$error_message_birthday = "";
$success = "";

if (isset($_SESSION['session_email'])) {
    $loggedIn = true;
    $type = $_SESSION['user_type'];

    if ($_SESSION['user_type'] == "instructor") {
        $courseID = "";
    }
} else {
    $loggedIn = false;
    $type = "";
    $action = "notLoggedIn";
}

if ($action == null) {
    $action = "personalInfo";
}

switch ($action) {
    case "personalInfo":
        require("../model/database.php");

        $page = "personalInfo";
        if ($type == "student") {
            include("../view/personal_info_student.php");
        } else {
            include("../view/personal_info_instructor.php");
        }
        break;
    case "drop":
        require("../model/database.php");

        $studentID = filter_input(INPUT_POST, 'studentID');
        $courseID = filter_input(INPUT_POST, 'courseID');

        require("../model/enroll_model.php");

        dropStudent($studentID, $courseID);

        header("Location: ../personal");
        exit();
        break;
    case "change":
        require("../model/database.php");

        $firstName = filter_input(INPUT_POST, 'firstName');
        $lastName = filter_input(INPUT_POST, 'lastName');
        $birthday = filter_input(INPUT_POST, 'birthday');
        $gender = filter_input(INPUT_POST, 'gender');
        $email = filter_input(INPUT_POST, 'email');
        $cPassword = filter_input(INPUT_POST, 'cPassword');
        $nPassword = filter_input(INPUT_POST, 'nPassword');

        $profileType = filter_input(INPUT_POST, 'profileType');

        $id = $_SESSION['session_id'];

        if ($profileType == "student") {
            $person = get_student($id);
        } else {
            $person = get_instructor($id);
        }


        if ($firstName == null || $lastName == null || $email == null || $email == false ||
                $cPassword == null || $gender == null || $cPassword != $person['pass'] || $birthday == false || $birthday == null) {

            if ($email == null || $email == false) {
                $error_message_email = "Email does not meet the requirements!";
            }
            if ($gender == "") {
                $error_message_gender = "Choose a gender!";
            }

            if ($cPassword != $person['pass']) {
                $error_message_passwordNew = "Wrong password!";
            }

            if ($firstName == null) {
                $error_message_firstName = "Must have first name!";
            }
            if ($lastName == null) {
                $error_message_lastName = "Must have last name!";
            }
            if ($birthday == null || $birthday == false) {
                $error_message_birthday = "Must enter valid birthday!";
            }
        } else {
            global $db;

            if ($nPassword == "") {
                $query = "UPDATE " . $profileType . " SET firstName = :firstName, lastName = :lastName, "
                        . "birthday = :birthday, gender = :gender, email = :email "
                        . "WHERE " . $profileType . "ID = :profileType";
            } else {
                $query = "UPDATE " . $profileType . " SET firstName = :firstName, lastName = :lastName, "
                        . "birthday = :birthday, gender = :gender, email = :email, pass = :pass "
                        . "WHERE " . $profileType . "ID = :profileType";
            }
            $statement = $db->prepare($query);
            $statement->bindValue(':firstName', $firstName);
            $statement->bindValue(':lastName', $lastName);
            $statement->bindValue(':birthday', $birthday);
            $statement->bindValue(':gender', $gender);
            $statement->bindValue(':email', $email);
            if ($nPassword != "") {
                $statement->bindValue(':pass', $nPassword);
            }
            $statement->bindValue(':profileType', $id);
            $statement->execute();
            $statement->closeCursor();

            $success = "Changes successful!";
        }

        if ($profileType == "student") {
            include("../view/personal_info_student.php");
        } else {
            include("../view/personal_info_instructor.php");
        }
        break;
    case "notLoggedIn":
        include("../errors/notLoggedIn.php");
        break;
    case "show":
        require("../model/database.php");

        $courseID = filter_input(INPUT_POST, 'courseID');
        include("../view/personal_info_instructor.php");
        break;
    case "changeGrade":
        require("../model/database.php");
        $gradeSelect = filter_input(INPUT_POST, 'gradeSelect');
        $studentID = filter_input(INPUT_POST, 'studentID');
        $courseID = filter_input(INPUT_POST, 'courseID');

        global $db;

        $query = 'UPDATE enrolledCourses SET grade = :gradeSelect WHERE studentID = :studentID AND courseID = :courseID';
        $statement = $db->prepare($query);
        $statement->bindValue(':gradeSelect', $gradeSelect);
        $statement->bindValue(':studentID', $studentID);
        $statement->bindValue(':courseID', $courseID);
        $statement->execute();
        $statement->closeCursor();
        
        $action = "show";
        
        include("../view/personal_info_instructor.php");
        break;
    default:
        $error_message = "Error";
        break;
}

if (isset($_SESSION["error_full"])) {
    unset($_SESSION["error_full"]);
}    